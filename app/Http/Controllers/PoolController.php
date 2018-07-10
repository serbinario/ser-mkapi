<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Pool;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class PoolController extends Controller
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
     * Display a listing of the pools.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $pools = Pool::paginate(25);

        return view('pool.index', compact('pools'));
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
            $rows = \DB::table('mk_pools');

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="pool/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="pool/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="pool/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new pool.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('pool.create');
    }

    /**
     * Store a new pool in the storage.
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
            
            Pool::create($data);

            return redirect()->route('pool.pool.index')
                             ->with('success_message', 'Pool was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified pool.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $pool = Pool::findOrFail($id);

        return view('pool.show', compact('pool'));
    }

    /**
     * Show the form for editing the specified pool.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $pool = Pool::findOrFail($id);
        

        return view('pool.edit', compact('pool'));
    }

    /**
     * Update the specified pool in the storage.
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
            
            $pool = Pool::findOrFail($id);
            $pool->update($data);

            return redirect()->route('pool.pool.index')
                             ->with('success_message', 'Pool was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified pool from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $pool = Pool::findOrFail($id);
            $pool->delete();

            return redirect()->route('pool.pool.index')
                             ->with('success_message', 'Pool was successfully deleted!');

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
            'nome' => 'required|string|min:1|max:200',
            'ip_inicial' => 'required|string|min:1|max:20',
            'ip_final' => 'required|string|min:1|max:20',
     
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
        $data = $request->only(['nome','ip_inicial','ip_final']);

        return $data;
    }

}
