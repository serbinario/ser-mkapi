<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Grupo;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class GrupoController extends Controller
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
     * Display a listing of the grupos.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $grupos = Grupo::paginate(25);

        return view('grupo.index', compact('grupos'));
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
            $rows = \DB::table('mk_grupos');

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="grupo/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="grupo/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="grupo/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new grupo.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('grupo.create');
    }

    /**
     * Store a new grupo in the storage.
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
            
            Grupo::create($data);

            return redirect()->route('grupo.grupo.index')
                             ->with('success_message', 'Grupo was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified grupo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $grupo = Grupo::findOrFail($id);

        return view('grupo.show', compact('grupo'));
    }

    /**
     * Show the form for editing the specified grupo.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $grupo = Grupo::findOrFail($id);
        

        return view('grupo.edit', compact('grupo'));
    }

    /**
     * Update the specified grupo in the storage.
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
            
            $grupo = Grupo::findOrFail($id);
            $grupo->update($data);

            return redirect()->route('grupo.grupo.index')
                             ->with('success_message', 'Grupo was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified grupo from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $grupo = Grupo::findOrFail($id);
            $grupo->delete();

            return redirect()->route('grupo.grupo.index')
                             ->with('success_message', 'Grupo was successfully deleted!');

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
        $data = $request->only(['nome']);

        return $data;
    }

}
