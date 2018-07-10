<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cliente;
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
        $clientes = Cliente::with('mkrouter','mkprofile','mkvencimentodium')->paginate(25);

        return view('cliente.index', compact('clientes'));
    }

    /**
         * Display a listing of the fornecedors.
         *
         * @return Illuminate\View\View
         * @throws Exception
         */
        public function grid()
        {
            $this->token = csrf_token();
            #Criando a consulta
            $rows = \DB::table('mk_clientes')
                ->leftJoin('mk_profiles', 'mk_profiles.id', '=', 'mk_clientes.profile_id')
                ->select(['mk_clientes.nome', 'mk_clientes.id', 'mk_clientes.login', 'mk_profiles.nome as profile']);

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
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
                                <button type="submit" class="btn btn-danger delete" id="' . $row->id   . '" title="Delete">
                                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                </button>
                        </form>
                        ';
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

            $entitiePeople = $this->getTypePeople($request->get('tipo'));
            $pessoaTipo = $entitiePeople::create($request->all());
            $pessoaTipo->clienteable()->create($request->all());

            return redirect()->route('cliente.cliente.index')
                             ->with('success_message', 'Cliente was successfully added!');

        } catch (Exception $exception) {
            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
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

            $data = $this->getData($request);

            $cliente = Cliente::findOrFail($id);
            //$pessoaFisica = PessoaFisica::find($cliente->clienteable_id);
            $cliente->update($data);

            //dd($data, $id);

            //$pessoaFisica->clienteable->update($request->all());
            //$pessoaFisica->update($request->all());



            return redirect()->route('cliente.cliente.index')
                             ->with('success_message', 'Cliente was successfully updated!');

        } catch (Exception $exception) {
            dd($exception->getMessage());
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
     * Validate the given request with the defined rules.
     *
     * @param  Illuminate\Http\Request  $request
     *
     * @return boolean
     */
    protected function affirm(Request $request)
    {
        $rules = [
            'nome' => 'required|string|min:1|max:255',
            'login' => 'nullable|string|min:0|max:20',
            'senha' => 'nullable|string|min:0|max:20',
            'email' => 'nullable|string|min:0|max:50',
            'tipo' => 'nullable',
            'phone01', 'nullable|string|min:0|max:20',
            'phone02', 'nullable|string|min:0|max:20',
            'data_nascimento' => 'nullable|string|min:0',
            'cep' => 'nullable|string|min:0|max:10',
            'logradouro' => 'nullable|string|min:0|max:200',
            'complemanto' => 'nullable|string|min:0|max:200',
            'bairro' => 'nullable|string|min:0|max:50',
            'cidade' => 'nullable|string|min:0|max:50',
            'data_instalacao' => 'nullable|string|min:0',
            'grupo_id' => 'nullable',
            'router_id' => 'nullable',
            'profile_id' => 'nullable',
            'tipo_autenticacao' => 'nullable',
            'ip_pppoe' => 'nullable|string|min:0|max:20',
            'ip_hotspot' => 'nullable|string|min:0|max:20',
            'mac' => 'nullable|string|min:0|max:20',
            'vencimento_dia_id' => 'nullable',
            'dias_bloqueio' => 'nullable|numeric|min:-2147483648|max:2147483647',
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
        $data = $request->only(['nome','login','senha','email','cpf', 'rg', 'insc_estadual','tipo','data_nascimento','cep', 'phone01', 'phone02','logradouro','complemanto','bairro','cidade','data_instalacao','router_id', 'grupo_id','profile_id','tipo_autenticacao','ip_pppoe','ip_hotspot','mac','vencimento_dia_id','dias_bloqueio','dias_msg_pendencia','inseto_mensalidade','mensalidade_automatica','msg_bloqueio_automatica','msg_pendencia_automatica','perm_alter_senha','desconto_mensalidade','desconto_mensali_ate_venci','is_ativo','obs']);
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
