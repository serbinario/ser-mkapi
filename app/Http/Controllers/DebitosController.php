<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Serbinario\Entities\Debito;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinBoleto;
use Serbinario\Entities\FinCarne;
use Serbinario\Entities\Cliente;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacil;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacilApi;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Entities\FinContasBancaria;
use Serbinario\Entities\FinFormasPagamento;
use Serbinario\Entities\FinLocaisPagamento;
use serbinario\Services\teste;
use Yajra\DataTables\DataTables;
use Exception;

class DebitosController extends Controller
{
    private $token;
    private $boletoFacilApi;

    /**
     * Create a new controller instance.
     *
     * @param BoletoFacilApi $boletoFacil
     */
    public function __construct(BoletoFacilApi $boletoFacilApi)
    {
        $this->middleware('auth');
        $this->boletoFacilApi = $boletoFacilApi;
        // check if session expired for ajax request


    }

    /**
     * Display a listing of the debitos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $debitosObjects = Debitos::with('mkcliente','fincontasbancaria','finformaspagamento','fincarne','finlocaispagamento')->paginate(25);

        return view('debitos.index', compact('debitosObjects'));
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function grid(Request $request)
    {
        //dd($request->all());
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('fin_debitos')
            ->Join('mk_clientes', 'mk_clientes.id', '=', 'fin_debitos.mk_cliente_id')
            ->Join('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
            ->Join('fin_status', 'fin_status.id', '=', 'fin_debitos.status_id')
            ->leftJoin('fin_formas_pagamentos', 'fin_formas_pagamentos.id', '=', 'fin_debitos.forma_pagamento_id')
            ->select([
                'fin_debitos.id',
                'fin_debitos.numero_cobranca',
                'fin_debitos.valor_debito',
                'fin_status.nome as status',
                \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                \DB::raw('DATE_FORMAT(fin_debitos.data_pagamento,"%d/%m/%Y") as data_pagamento'),
                'fin_debitos.valor_pago',
                'mk_clientes.nome',
                \DB::raw('DATE_FORMAT(fin_debitos.data_competencia,"%d/%m/%Y") as data_competencia'),
                'fin_boletos.code',
                'fin_debitos.status_id',
                'fin_debitos.boleto_id',
                'fin_formas_pagamentos.nome as form_pag_nome'
            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('status')) {
                    $query->where('status_id', '=', $request->get('status'));
                }
                if ($request->has('nome')) {
                    $query->where('mk_clientes.nome', 'like', "%" . $request->get('nome') . "%");
                }
                if ($request->has('data_pag_ini')) {
                    $query->whereBetween('fin_debitos.data_pagamento', [$request->get('data_pag_ini'), $request->get('data_pag_fim')])->get();
                }
                if ($request->has('data_venc_ini')) {
                    $query->whereBetween('fin_debitos.data_vencimento', [$request->get('data_venc_ini'), $request->get('data_venc_fim')])->get();
                }
            })
            ->addColumn('action', function ($row) {
                $html       = '<form id="' . $row->id   . '" method="POST" action="#' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="debitos/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>';
                //Se o boleto ja foi pago nao aparece o botao para cancelar
                // RN-0003
                if($row->status_id != '3' && $row->status_id != '7') {
                    $html .= '<button type="button" class="btn btn-danger cancelBoleto" id="' . $row->code   . '" title="Cancelar">
                                    <span class="glyphicon md-cancel" aria-hidden="true"></span>
                                </button>';
                }
                //$disciplina = $this->service->find($row->id);
                # Verificando se existe vinculo com o currículo

                if($row->boleto_id == "") {
                    $html .= '<button class="btn btn-danger delete" id="' . $row->id . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                              ';
                }

                $html .= '</div></form>';
                return $html;
            })->make(true);
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     * Carrega a modal com os debitos do cliente
     */
    public function modalGrid(Request $request)
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('fin_debitos')
            ->leftJoin('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
            ->leftJoin('fin_status', 'fin_status.id', '=', 'fin_debitos.status_id')
            ->select([
                'fin_debitos.id',
                'fin_debitos.status_id',
                'fin_boletos.code',
                'fin_debitos.valor_debito',
                \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                'fin_debitos.valor_pago',
                \DB::raw('DATE_FORMAT(fin_debitos.data_pagamento,"%d/%m/%Y") as data_pagamento'),
                'fin_status.nome',
                'fin_boletos.link'
                //\DB::raw('DATE_FORMAT(bib_emprestimos.data,"%d/%m/%Y") as data'),


            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('cliente_id')){
                    $query->where('fin_debitos.mk_cliente_id', '=', $request->get('cliente_id'));
                }
            })

            ->addColumn('action', function ($row) {

                //Se o status_id do debito = 3 "Pago"
                if($row->status_id == 3){
                    return '';
                }else{
                    return '<form id="' . $row->id   . '" method="POST" action="debitos/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">                              
                                <button type="button" class="btn btn-danger cancelBoleto" id="' . $row->code   . '" title="Cancelar"  >
                                    <span class="glyphicon md-cancel" aria-hidden="true"></span>
                                </button>                                
                                <button type="button" class="btn btn-primary btModalBaixaDebito" id="' . $row->code   . '" title="Baixar Debito">
                                    <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
                                </button>
                            </div>
                        </form>';
                }

            })->make(true);
    }

    /**
     * Show the form for creating a new debitos.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $mkClientes = Cliente::pluck('nome','id')->all();
        $finContasBancarias = FinContasBancaria::pluck('nome','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('nome','id')->all();
        $finCarnes = FinCarne::pluck('id','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('nome','id')->all();
        return view('debitos.create', compact('mkClientes','finContasBancarias','finFormasPagamentos','finCarnes','finLocaisPagamentos'));
    }


    /**
     * Show the form for creating a new debitos.
     *
     * Retorna com a quantidade de boletos pagos, a receber inadiplente
     */
    public function knob(Request $request)
    {
        $rows = \DB::table('fin_debitos');
        if ( $request->has('data_venc_ini') && $request->has('data_venc_fim')) {
            $rows->whereBetween('data_vencimento', [$request->get('data_venc_ini'), $request->get('data_venc_fim')]);
        }else{
            $date_ini = date('Y-m-01');
            $date_fim = date('Y-m-t');
            $rows->whereBetween('data_vencimento', [$date_ini, $date_fim]);
        }

        //->where(\DB::raw('data_vencimento BETWEEN  DATE_FORMAT(NOW() ,\'%Y-%m-01\') AND DATE_FORMAT(NOW() ,\'%Y-%m-31\')'))
        $rows->select([
            \DB::raw('
                        COUNT(IF(status_id="2","2", NULL)) "aguardando", 
                        COUNT(IF(status_id="3","3", NULL)) "pagas",
                        COUNT(IF(status_id="4","4", NULL)) "inadiplentes",
                        SUM(IF(status_id="3",valor_pago, NULL)) "total_pagos",
                        SUM(IF(status_id="2",valor_debito, NULL)) "total_aguardando",
                        SUM(IF(status_id="4",valor_debito, NULL)) "total_inadiplentes",
                        COUNT(*) "total"
                    ')
        ]);

        $rows = $rows->get();
        //dd($rows);

        foreach ($rows as $row){
            return \Illuminate\Support\Facades\Response::json([
                'success' => true, 'total' => $row->total, 'pagas' => $row->pagas, 'inadiplentes' => $row->inadiplentes,
                'aReceber' => $row->aguardando, 'dinheiro' => '10',
                'total_pagos' => $row->total_pagos, 'total_aguardando' => $row->total_aguardando, 'total_inadiplentes' => $row->total_inadiplentes
            ]);
        }
    }
    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception RN-0003
     */
    public function cancelCharge($code)
    {
        //dd($code);
        //$code = $request->get('code');

        $return = $this->boletoFacilApi->cancelCharge($code);
        if($return['success'])
        {
            $boleto = FinBoleto::with('debito')->where('code', '=' , $code)->first();
            //($boleto->debito);
            $boleto->debito->status_id = '7';
            $boleto->debito->save();
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Boleto Cancelado com sucesso!']);
        }else{
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => $return['msg']]);
        }
    }


    /**
     * Store a new debitos in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     * Regra de negocio - RN-0001
     */
    public function store(Request $request)
    {
        try {

            $this->affirm($request);
            $data = $this->getData($request);

            //$this->boletoFacilApi->fetchPaymentDetails();
            //dd("www");
            //Cria um boleto Pelo BoletoFacil
            $boleto = $this->boletoFacilApi->createBoleto($data);

            //Se falhar a criaçao do boleto, retorna um erro e a mensagem do erro
            if(!$boleto['success']) return Response::json(['success' => false, 'msg' => $boleto['msg']]);

            //Gera um boleto a partir dos daos de retorno do BoletoFacil
            $boletoGerado = FinBoleto::create($boleto);

            //Com os dados do formulario, adiciono o id do boleto + o status de aguardando que e 2 ao debito
            $data = array_merge($data, [ 'boleto_id' => $boletoGerado->id, 'status_id' => '2']);

            //Salva o debito vinculado ao boleto gerado
            Debitos::create($data);


            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Edição realizada com sucesso!']);

        } catch (Exception $exception) {
            dd($exception->getMessage());
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Salva  um baixa de debito
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     * Regra de negocio - RN-0001
     */
    public function debitoBaixa(Request $request)
    {
        try {

            $this->affirm($request);
            //$data = $this->getData($request);
            //dd($request->all());
            $debito = Debitos::find($request->get('id_debito'));
            //dd($debito);
            $debito->valor_pago = $request->get('valor_pago');
            $debito->data_pagamento = $request->get('data_pagamento');
            $debito->conta_bancaria_id = $request->get('conta_bancaria_id');
            $debito->forma_pagamento_id = $request->get('forma_pagamento_id');
            $debito->multa = $request->get('multa');
            $debito->desconto = $request->get('desconto');
            $debito->local_pagamento_id = 4;
            $debito->status_id = 3;
            $debito->save();

            return \Illuminate\Support\Facades\Response::json(['success' => true, 'msg' => 'Edição realizada com sucesso!']);

        } catch (Exception $exception) {
            dd($exception->getMessage());
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }



    /**
     * Display the specified debitos.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $debitos = Debitos::with('mkcliente','fincontasbancaria','finformaspagamento','fincarne','finlocaispagamento')->findOrFail($id);

        return view('debitos.show', compact('debitos'));
    }

    /**
     * Show the form for editing the specified debitos.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $debitos = Debitos::with('mkCliente.mkProfile')->findOrFail($id);
        $mkClientes = Cliente::pluck('nome','id')->all();
        $finContasBancarias = FinContasBancaria::pluck('nome','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('nome','id')->all();
        $finCarnes = FinCarne::pluck('nome','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('nome','id')->all();


        //dd($debitos->mkCliente->mkProfile->descricao);
        return view('debitos.edit', compact('debitos','mkClientes','finContasBancarias','finFormasPagamentos','finCarnes','finLocaisPagamentos'));
    }

    /**
     * Update the specified debitos in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            $this->affirm($request);
            $data = $this->getData($request);

            $debitos = Debitos::findOrFail($id);
            $debitos->update($data);

            return redirect()->route('debitos.debitos.index')
                ->with('success_message', 'Debitos was successfully updated!');

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Update the specified debitos in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     *
     * ############################
     * ######### RN-0005 ##########
     * ############################
     */
    public function inadimplentesIndex(Request $request)
    {
        try {
            return view('inadimplente.index');

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Update the specified debitos in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     * ############################
     * ######### RN-0005 ##########
     * ############################
     * Retorna a quantidade de dias que o cliente esta inadimplente
     */
    public function inadimplentes(Request $request)
    {
        try {

            $cur_date = Carbon::now();

            $rows = \DB::table('fin_debitos')
                ->leftJoin('mk_clientes', 'fin_debitos.mk_cliente_id', '=', 'mk_clientes.id')
                ->where('fin_debitos.data_vencimento', '<=', $cur_date)
                ->where('fin_debitos.status_id', '=', '4')
                ->orderBy('dias_atraso', 'DESC')
                ->select([
                    'fin_debitos.id',
                    'mk_clientes.nome',
                    \DB::raw('IF(mk_clientes.status_secret < 0, "Bloqueado", "Ativo") as status_secret'),
                    \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'fin_debitos.valor_debito',
                    \DB::raw('DATEDIFF(data_vencimento, NOW()) AS dias_atraso')
                    //\DB::raw('DATE_FORMAT(bib_emprestimos.data,"%d/%m/%Y") as data'),
                ]);
            #Editando a grid
            return Datatables::of($rows)->make(true);
        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => 'Error']);
        }
    }

    /**
     * Update the specified debitos in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     *
     * ############################
     * ######### RN-0005 ##########
     * ############################
     */
    public function paidDayIndex(Request $request)
    {
        try {
            return view('paidDay.index');

        } catch (Exception $exception) {
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }


    /**
     * Update the specified debitos in the storage.
     *
     * @param  int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     * ############################
     * ######### RN-000x ##########
     * ############################
     * Retorna os clientes que pagaram da data atual
     */
    public function paidDay(Request $request)
    {
        try {

            $cur_date = Carbon::now();

            $rows = \DB::table('fin_debitos')
                ->leftJoin('mk_clientes', 'fin_debitos.mk_cliente_id', '=', 'mk_clientes.id')
                ->leftJoin('fin_formas_pagamentos', 'fin_formas_pagamentos.id', '=', 'fin_debitos.forma_pagamento_id')
                ->where('fin_debitos.data_pagamento', '<=', $cur_date)
                ->where('fin_debitos.status_id', '=', '3')
                ->select([
                    'fin_debitos.id',
                    'mk_clientes.nome',
                    'fin_formas_pagamentos.nome as form_pag_nome',
                    \DB::raw('IF(mk_clientes.status_secret < 0, "Bloqueado", "Ativo") as status_secret'),
                    \DB::raw('DATE_FORMAT(fin_debitos.data_pagamento,"%d/%m/%Y") as data_pagamento'),
                    \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'fin_debitos.valor_debito'
                    //\DB::raw('DATE_FORMAT(bib_emprestimos.data,"%d/%m/%Y") as data'),
                ]);
            #Editando a grid
            return Datatables::of($rows)->make(true);
        } catch (Exception $e) {
            return \Illuminate\Support\Facades\Response::json(['success' => false, 'msg' => 'Error']);
        }
    }


    /**
     * Remove the specified debitos from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {

            //Corrigir isso por nao estar funcionando o o with, ai tive que colocar para localizar o boleto_id em boletos de depois deletar
            $debitos = Debitos::findOrFail($id);
            $result = FinBoleto::findOrFail($debitos->boleto_id);

            return redirect()->route('debitos.debitos.index')
                ->with('success_message', 'Debitos was successfully deleted!');

        } catch (Exception $exception) {
            dd("ssss");
            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        $rules = [
            'mk_cliente_id' => 'nullable',
            'numero_cobranca' => 'nullable|string|min:0|max:50',
            'conta_bancaria_id' => 'nullable',
            'valor_debito' => 'nullable',
            'valor_pago' => 'nullable|min:-99999999.99|max:99999999.99',
            'valor_desconto' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'data_vencimento' => 'nullable|date_format:d/m/Y',
            'data_pagamento' => 'nullable|date_format:d/m/Y',
            'pago' => 'nullable|string|min:0',
            'forma_pagamento_id' => 'nullable',
            'carne_id' => 'nullable',
            'local_pagamento_id' => 'nullable',
            'status' => 'nullable|string|min:0|max:50',

        ];
        return $this->validate($request, $rules);
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $data = $request->only(['mk_cliente_id','status_id','multa', 'desconto','boleto_id','code', 'numero_cobranca', 'cpf', 'nome','conta_bancaria_id','valor_debito','descricao','valor_pago','valor_desconto', 'data_competencia','data_vencimento','data_pagamento','pago','forma_pagamento_id','carne_id','local_pagamento_id','status']);

        return $data;
    }

}
