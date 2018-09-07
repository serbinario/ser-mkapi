<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Cobranca;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class CobrancaController extends Controller
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
     * Display a listing of the cobrancas.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $cobrancas = Cobranca::paginate(25);

        return view('cobranca.index', compact('cobrancas'));
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
            $rows = \DB::table('cobrancas')
                ->leftJoin('mk_clientes', 'mk_clientes.nome', '=', 'cobrancas.nome')
                ->orderBy('cobrancas.nome','ASC')
                ->select([
                    'cobrancas.id',
                    'cobrancas.nome as nomec',
                    'mk_clientes.nome',
                    'mk_clientes.phone01',
                    'cobrancas.valor',
                    \DB::raw('DATE_FORMAT(cobrancas.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'cobrancas.status',
                    'cobrancas.obs',
                    'cobrancas.data_envio',

                ]);

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="cobranca/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="cobranca/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="cobranca/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new cobranca.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('cobranca.create');
    }

    /**
     * Store a new cobranca in the storage.
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
            
            Cobranca::create($data);

            return redirect()->route('cobranca.cobranca.index')
                             ->with('success_message', 'Cobranca was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified cobranca.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $cobranca = Cobranca::findOrFail($id);

        return view('cobranca.show', compact('cobranca'));
    }

    /**
     * Show the form for editing the specified cobranca.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $cobranca = Cobranca::findOrFail($id);
        

        return view('cobranca.edit', compact('cobranca'));
    }

    /**
     * Update the specified cobranca in the storage.
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
            
            $cobranca = Cobranca::findOrFail($id);
            $cobranca->update($data);

            return redirect()->route('cobranca.cobranca.index')
                             ->with('success_message', 'Cobranca was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified cobranca from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $cobranca = Cobranca::findOrFail($id);
            $cobranca->delete();

            return redirect()->route('cobranca.cobranca.index')
                             ->with('success_message', 'Cobranca was successfully deleted!');

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
            'numero_cobranca' => 'nullable|string|min:0|max:20',
            'valor' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'status' => 'nullable|string|min:0|max:20',
            'identificador' => 'nullable|string|min:0|max:50',
            'nome' => 'nullable|string|min:0|max:200',
            'data_vencimento' => 'nullable|date_format:j/n/Y g:i A',
            'valor_pago' => 'nullable|string|min:0|max:10',
            'data_pagamento' => 'nullable|date_format:j/n/Y g:i A',
            'login' => 'nullable|string|min:0|max:20',
            'link_pagamento' => 'nullable|string|min:0|max:255',
     
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
        $data = $request->only(['numero_cobranca','valor','status','identificador','nome','data_vencimento','valor_pago','data_pagamento','login','link_pagamento', 'obs', 'data_envio']);

        return $data;
    }

}
