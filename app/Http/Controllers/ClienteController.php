<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinCarne;
use Serbinario\Entities\FinContasBancaria;
use Serbinario\Entities\FinFormasPagamento;
use Serbinario\Entities\FinLocaisPagamento;
use Serbinario\Entities\Grupo;
use Serbinario\Entities\PessoaFisica;
use Serbinario\Entities\PessoaJuridica;
use Serbinario\Entities\Router;
use Serbinario\Entities\Profile;
use Serbinario\Entities\VencimentoDia;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class ClienteController extends Controller
{
    private $token;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $mkClientes = Cliente::pluck('nome','id')->all();
        $finContasBancarias = FinContasBancaria::pluck('nome','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('nome','id')->all();
        $finCarnes = FinCarne::pluck('id','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('nome','id')->all();

        return view('cliente.index', compact('clientes','mkClientes','finContasBancarias','finFormasPagamentos','finCarnes','finLocaisPagamentos'));
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
        $rows = \DB::table('mk_clientes')
            ->leftJoin('mk_profiles', 'mk_profiles.id', '=', 'mk_clientes.profile_id')
            ->leftJoin('mk_grupos', 'mk_grupos.id', '=', 'mk_clientes.grupo_id')
            ->select([
                'mk_clientes.nome', 'mk_clientes.id', 'mk_clientes.cpf', 'mk_clientes.login',
                'mk_profiles.nome as profile', 'mk_clientes.status_secret', 'mk_grupos.nome as grupo'

            ]);

        #Editando a grid
        return Datatables::of($rows)

            ->filter(function ($query) use ($request) {
                # recuperando o valor da requisição
                $localizar = $request->get('localizar');
                $status = $request->get('status');
                #condição
                $query->where(function ($where) use ($localizar) {
                    $where->orWhere('mk_clientes.nome', 'like', "%$localizar%")
                        ->orWhere('mk_clientes.cpf', 'like', "%$localizar%")
                        ->orWhere('mk_clientes.login', 'like', "%$localizar%")
                        ->orWhere('mk_profiles.nome', 'like', "%$localizar%");
                });

                if ($request->has('status')){
                    $query->where('mk_clientes.status_secret', '=', $status);
                }
            })

            ->addColumn('status', function ($row) {

                if($row->status_secret == 1) {
                    $html = '<div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="" class="btn btn-default-light enableDisableSecret" id="' . $row->id . '" title="Bloquear">
                                        <span class="glyphicon md-thumb-up" aria-hidden="true"></span>
                                    </a>
                                </div>';
                }else{
                    $html       = '<div class="btn-group btn-group-xs pull-right" role="group">
                                    <a href="" class="btn btn-danger enableDisableSecret" id="' . $row->id   . '" title="Desbloquear">
                                        <span class="glyphicon md-thumb-down" aria-hidden="true"></span>
                                    </a>
                                </div>';
                }



                return $html;
            })->escapeColumns([])

            ->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="cliente/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="cliente/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="cliente/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
                                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                </a>
                                <button type="button" class="btn btn-primary btnModalFinanceiro" id="' . $row->id   . '" data-toggle="modal" title="Financeiro">
                                    <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-primary btnModalFinanceiroDebito" id="' . $row->id   . '" data-toggle="modal" title="Lançamento">
                                    <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
                                </button>
                            </div>
                        
                        </form>';
            })->make(true);
    }

    /**
     * Show the form for creating a new cliente.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        $mkRouters = Router::pluck('nome','id')->all();
        $mkProfiles = Profile::pluck('nome','id')->all();
        $mkGrupos = Grupo::pluck('nome','id')->all();
        $mkVencimentoDia = VencimentoDia::where('is_ativo', '=' ,'1')->pluck('nome','id')->all();
        return view('cliente.create', compact('mkRouters','mkProfiles','mkVencimentoDia', 'mkGrupos'));
    }

    /**
     * Store a new cliente in the storage.
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

            Cliente::create($data);

            return redirect()->route('cliente.cliente.index')
                ->with('success_message', 'Cliente was successfully added!');

        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Display the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cliente = Cliente::with('mkrouter','mkprofile','mkvencimentodium')->findOrFail($id);

        return view('cliente.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified cliente.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cliente = Cliente::with('mkGrupo', 'mkProfile')->findOrFail($id);
        $mkRouters = Router::pluck('nome','id')->all();
        $mkProfiles = Profile::pluck('nome','id')->all();
        $mkGrupos = Grupo::pluck('nome','id')->all();
        $mkVencimentoDia = VencimentoDia::where('is_ativo', '=' ,'1')->pluck('nome','id')->all();

        return view('cliente.edit', compact('cliente','mkRouters','mkProfiles','mkVencimentoDia', 'mkGrupos'));
    }

    /**
     * Update the specified cliente in the storage.
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

            //dd($data);
            $cliente = Cliente::findOrFail($id);
            //$pessoaFisica = PessoaFisica::find($cliente->clienteable_id);
            $cliente->update($data);

            return redirect()->route('cliente.cliente.index')
                ->with('success_message', 'Cliente was successfully updated!');

        } catch (Exception $e) {
            return redirect()->back()->with('error_message', $e->getMessage());
        }
    }

    /**
     * Remove the specified cliente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            return redirect()->route('cliente.cliente.index')
                ->with('success_message', 'Cliente was successfully deleted!');

        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Remove the specified cliente from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function getCliente($id)
    {
        try {
            $cliente = Cliente::with('mkGrupo', 'mkProfile')->findOrFail($id);
            //dd($cliente);
            $cpf = $cliente->cpf;
            $descricao = $cliente->mkProfile->descricao;
            $valor = $cliente->mkProfile->valor;
            $diaVencimento = $cliente->mkVencimentoDium->nome;
            $date = date('m/Y');
            $diaVencimento = $diaVencimento . "/" . $date;

            return \Illuminate\Support\Facades\Response::json(['success' => true,'descricao' => $descricao, 'diaVenci' => $diaVencimento, 'valor' => $valor,
                'cpf' => $cpf
            ]);
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
        //dd($request->all());

        $rules = [
            'nome' => 'required|string|min:1|max:255',
            'login' => 'required|string|min:0|max:20',
            'senha' => 'required|string|min:0|max:20',
            'email' => 'nullable|string|min:0|max:50',
            'tipo' => 'nullable',
            'phone01', 'nullable|string|min:0|max:20',
            'phone02', 'nullable|string|min:0|max:20',
            'data_nascimento' => 'required|string|min:0',
            'cep' => 'nullable|string|min:0|max:10',
            'logradouro' => 'nullable|string|min:0|max:200',
            'complemanto' => 'nullable|string|min:0|max:200',
            'bairro' => 'nullable|string|min:0|max:50',
            'cidade' => 'nullable|string|min:0|max:50',
            'data_instalacao' => 'required|string|min:0',
            'grupo_id' => 'required',
            'router_id' => 'required',
            'profile_id' => 'required',
            'tipo_autenticacao' => 'nullable',
            'ip_pppoe' => 'nullable|string|min:0|max:20',
            'ip_hotspot' => 'nullable|string|min:0|max:20',
            'mac' => 'nullable|string|min:0|max:20',
            'vencimento_dia_id' => 'required',
            'dias_bloqueio' => 'required|numeric|min:-2147483648|max:2147483647',
            'dias_msg_pendencia' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'inseto_mensalidade' => 'nullable|boolean',
            'mensalidade_automatica' => 'nullable|boolean',
            'msg_bloqueio_automatica' => 'nullable|boolean',
            'msg_pendencia_automatica' => 'nullable|boolean',
            'perm_alter_senha' => 'nullable|boolean',
            'desconto_mensalidade' => 'nullable|numeric|min:-999.99|max:999.99',
            'desconto_mensali_ate_venci' => 'nullable|numeric|min:-999.99|max:999.99',
            'is_ativo' => 'nullable|boolean',
            'obs' => 'nullable',
            'cpf' =>  'required_if:tipo,!=,Fisica',
            'cnpj' =>  'required_if:tipo,!=,Juridico',

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
        $data = $request->only(['nome','login','senha','email','cpf', 'rg', 'insc_estadual','tipo','data_nascimento','cep', 'phone01', 'phone02','logradouro','complemanto','bairro','cidade', 'estado', 'numero_casa','data_instalacao','router_id', 'grupo_id','profile_id','tipo_autenticacao','ip_pppoe','ip_hotspot','mac','vencimento_dia_id','dias_bloqueio','dias_msg_pendencia','inseto_mensalidade','mensalidade_automatica','msg_bloqueio_automatica','msg_pendencia_automatica','perm_alter_senha','desconto_mensalidade','desconto_mensali_ate_venci','is_ativo','obs']);
        $data['inseto_mensalidade'] = $request->has('inseto_mensalidade');
        $data['mensalidade_automatica'] = $request->has('mensalidade_automatica');
        $data['msg_bloqueio_automatica'] = $request->has('msg_bloqueio_automatica');
        $data['msg_pendencia_automatica'] = $request->has('msg_pendencia_automatica');
        $data['perm_alter_senha'] = $request->has('perm_alter_senha');
        $data['is_ativo'] = $request->has('is_ativo');

        return $data;
    }

    protected function getTypePeople($people)
    {
        if($people == "Fisica"){
            return PessoaFisica::class;

        }else{
            return PessoaJuridica::class;
        }

    }

}
