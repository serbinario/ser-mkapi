<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('fin_debitos')
            ->Join('mk_clientes', 'mk_clientes.id', '=', 'fin_debitos.mk_cliente_id')
            ->Join('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
            ->Join('fin_status', 'fin_status.id', '=', 'fin_debitos.status_id')
            ->select([
                'fin_debitos.id', 'fin_debitos.numero_cobranca', 'fin_debitos.valor_debito', 'fin_status.nome as status',
                'fin_debitos.data_vencimento', 'fin_debitos.data_pagamento', 'fin_debitos.valor_pago' , 'mk_clientes.nome',
                'fin_debitos.data_competencia'
            ]);

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('status')) {
                    $query->where('status', '=', $request->get('status'));
                }
                if ($request->has('nome')) {
                    $query->where('mk_clientes.nome', 'like', "%" . $request->get('nome') . "%");
                }
            })
            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="debitos/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="debitos/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="debitos/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                        </form>
                        ';
        })->make(true);
    }

    /**
     * Display a listing of the fornecedors.
     *
     * @return Illuminate\View\View
     * @throws Exception
     */
    public function modalGrid(Request $request)
    {
        $this->token = csrf_token();
        #Criando a consulta
        $rows = \DB::table('fin_debitos')
            ->leftJoin('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
            ->leftJoin('fin_status', 'fin_status.id', '=', 'fin_debitos.status_id');

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('cliente_id')){
                    $query->where('fin_debitos.mk_cliente_id', '=', $request->get('cliente_id'));
                }
            })

            ->addColumn('action', function ($row) {
            return '<form id="' . $row->id   . '" method="POST" action="debitos/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="debitos/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="debitos/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                        </form>
                        ';
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
     * @return Illuminate\View\View
     */
    public function knob()
    {

        $rows = \DB::table('fin_debitos')
            ->select([
                \DB::raw('
                        COUNT(IF(status_id="2","2", 0)) "aguardando", 
                        COUNT(IF(status_id="3","3", 0)) "pagos",
                        COUNT(IF(status_id="4","4", 0)) "inadiplentes",
                        SUM(IF(status_id="3",valor_pago, NULL)) "total_pagos",
                        SUM(IF(status_id="2",valor_debito, NULL)) "total_aguardando",
                        SUM(IF(status_id="4",valor_debito, NULL)) "total_inadiplentes",
                        COUNT(*) "total"
                    ')
            ])

        ->get();

       /* COUNT(IF(status_id='2',2, NULL)) 'aguardando',
COUNT(IF(status_id='3',3, NULL)) 'pagos' */

       foreach ($rows as $row){
           return \Illuminate\Support\Facades\Response::json([
               'success' => true, 'total' => $row->total, 'pagas' => $row->pagos, 'inadiplentes' => $row->inadiplentes,
               'aReceber' => $row->aguardando, 'dinheiro' => '10',
               'total_pagos' => $row->total_pagos, 'total_aguardando' => $row->total_aguardando, 'total_inadiplentes' => $row->total_inadiplentes
           ]);
       }




    }

    /**
     * Store a new debitos in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
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
        $finContasBancarias = FinContasBancaria::pluck('id','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('id','id')->all();
        $finCarnes = FinCarne::pluck('id','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('id','id')->all();

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
     * Remove the specified debitos from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $debitos = Debitos::findOrFail($id);
            $debitos->delete();

            return redirect()->route('debitos.debitos.index')
                ->with('success_message', 'Debitos was successfully deleted!');

        } catch (Exception $exception) {

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
            'valor_pago' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
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
        $data = $request->only(['mk_cliente_id','status_id','boleto_id','code', 'numero_cobranca', 'cpf', 'nome','conta_bancaria_id','valor_debito','descricao','valor_pago','valor_desconto', 'data_competencia','data_vencimento','data_pagamento','pago','forma_pagamento_id','carne_id','local_pagamento_id','status']);

        return $data;
    }

}
