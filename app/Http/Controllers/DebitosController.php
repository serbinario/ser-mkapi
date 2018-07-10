<?php

namespace Serbinario\Http\Controllers;


//meu teste

use Illuminate\Http\Request;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinCarne;
use Serbinario\Entities\MkCliente;
use Serbinario\Http\Controllers\Controller;
use Serbinario\Entities\FinContasBancaria;
use Serbinario\Entities\FinFormasPagamento;
use Serbinario\Entities\FinLocaisPagamento;
use Yajra\DataTables\DataTables;
use Exception;

class DebitosController extends Controller
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
            ->select([
                'fin_debitos.id', 'fin_debitos.numero_cobranca', 'fin_debitos.valor_debito', 'fin_debitos.status as status',
                'fin_debitos.data_vencimento', 'fin_debitos.data_pagamento', 'fin_debitos.valor_pago' , 'mk_clientes.nome'
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
        $rows = \DB::table('fin_debitos');

        #Editando a grid
        return Datatables::of($rows)
            ->filter(function ($query) use ($request) {
                # Filtranto por disciplina
                if ($request->has('cliente_id')) {
                    $query->where('mk_cliente_id', '=', $request->get('cliente_id'));
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
        $mkClientes = MkCliente::pluck('nome','id')->all();
        $finContasBancarias = FinContasBancaria::pluck('id','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('id','id')->all();
        $finCarnes = FinCarne::pluck('id','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('id','id')->all();

        return view('debitos.create', compact('mkClientes','finContasBancarias','finFormasPagamentos','finCarnes','finLocaisPagamentos'));
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

            Debitos::create($data);

            return redirect()->route('debitos.debitos.index')
                ->with('success_message', 'Debitos was successfully added!');

        } catch (Exception $exception) {

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
        $debitos = Debitos::findOrFail($id);
        $mkClientes = MkCliente::pluck('nome','id')->all();
        $finContasBancarias = FinContasBancaria::pluck('id','id')->all();
        $finFormasPagamentos = FinFormasPagamento::pluck('id','id')->all();
        $finCarnes = FinCarne::pluck('id','id')->all();
        $finLocaisPagamentos = FinLocaisPagamento::pluck('id','id')->all();

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
            'valor_debito' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'valor_pago' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'valor_desconto' => 'nullable|numeric|min:-99999999.99|max:99999999.99',
            'data_vencimento' => 'nullable|date_format:j/n/Y g:i A',
            'data_pagamento' => 'nullable|date_format:j/n/Y g:i A',
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
        $data = $request->only(['mk_cliente_id','numero_cobranca','conta_bancaria_id','valor_debito','valor_pago','valor_desconto','data_vencimento','data_pagamento','pago','forma_pagamento_id','carne_id','local_pagamento_id','status']);

        return $data;
    }

}
