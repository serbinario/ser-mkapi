<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 04/08/18
 * Time: 10:39
 */

namespace serbinario\Http\Controllers;
use Serbinario\Http\Controllers\Controller;


class Dashboard extends Controller
{
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
        return view('dashboard.index');
    }

    /**
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function clientesPorMes()
    {
        return \Illuminate\Support\Facades\Response::json(['label' => "Teste", 'data' => [['1', 22.0], ['2', 30.0], ['3', 35.3]] ]);
    }



}