<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Router;
use Serbinario\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Exception;

class RouterController extends Controller
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
     * Display a listing of the routers.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $routers = Router::paginate(25);

        return view('router.index', compact('routers'));
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
            $rows = \DB::table('mk_routers');

            #Editando a grid
            return Datatables::of($rows)->addColumn('action', function ($row) {
                return '<form id="' . $row->id   . '" method="POST" action="router/' . $row->id   . '/destroy" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            <input name="_token" value="'.$this->token .'" type="hidden">
                            <div class="btn-group btn-group-xs pull-right" role="group">
                                <a href="router/show/'.$row->id.'" class="btn btn-info" title="Show">
                                    <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                </a>
                                <a href="router/'.$row->id.'/edit" class="btn btn-primary" title="Edit">
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
     * Show the form for creating a new router.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('router.create');
    }

    /**
     * Store a new router in the storage.
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
            
            Router::create($data);

            return redirect()->route('router.router.index')
                             ->with('success_message', 'Router was successfully added!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }
    }

    /**
     * Display the specified router.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $router = Router::findOrFail($id);

        return view('router.show', compact('router'));
    }

    /**
     * Show the form for editing the specified router.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id)
    {
        $router = Router::findOrFail($id);
        

        return view('router.edit', compact('router'));
    }

    /**
     * Update the specified router in the storage.
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
            
            $router = Router::findOrFail($id);
            $router->update($data);

            return redirect()->route('router.router.index')
                             ->with('success_message', 'Router was successfully updated!');

        } catch (Exception $exception) {

            return back()->withInput()
                         ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request!']);
        }        
    }

    /**
     * Remove the specified router from the storage.
     *
     * @param  int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $router = Router::findOrFail($id);
            $router->delete();

            return redirect()->route('router.router.index')
                             ->with('success_message', 'Router was successfully deleted!');

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
            'ip_address' => 'required|string|min:1|max:20',
            'port' => 'nullable|string|min:0|max:10',
            'username' => 'required|string|min:1|max:20',
            'password' => 'required|string|min:1|max:20',
            'descricao' => 'nullable',
            'is_ativo' => 'nullable|boolean',
     
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
        $data = $request->only(['nome','ip_address','port','username','password','descricao','is_ativo']);
        $data['is_ativo'] = $request->has('is_ativo');

        return $data;
    }

}
