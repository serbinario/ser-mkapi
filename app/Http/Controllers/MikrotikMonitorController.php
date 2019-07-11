<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 06/08/18
 * Time: 18:14
 */

namespace Serbinario\Http\Controllers;


use Serbinario\Entities\Cliente;
use Serbinario\Services\MikrotikAPI\RouterosService;
use Ssh\Auth\Password;
use Ssh\Client;

class MikrotikMonitorController extends Controller
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

        return view('MikrotikMonitor.index');
    }
    /**
     * Display a listing of the clientes.
     *
     * @return Illuminate\View\View
     */
    public function index2()
    {

        return view('MikrotikMonitor.index2');
    }

    /*
     * Este metodo retrona o status do pppoe de cada cliente a partir da tabela SystemEvents, que ela e
     * populado pelo log do mikrotik, esta tabela foi criado um trigger chamado syslog, que antes de inserir
     * um registro ela inseri altera o campo pppoe_user e adiciona o login do cliente.
     */
    public function pppoeStatus()
    {

        try {

            $query = \DB::table('SystemEvents')
                ->join('mk_clientes', 'mk_clientes.login', '=', 'SystemEvents.pppoe_user')
                ->join('mk_grupos', 'mk_clientes.grupo_id', '=', 'mk_grupos.id')
                ->select([
                    'mk_clientes.nome',
                    'mk_grupos.nome as grupo',
                    'SystemEvents.pppoe_user',
                    \DB::raw('SPLIT_STRING(SystemEvents.Message, \',\', 1) as STATUS'),
                    \DB::raw('SPLIT_STRING(SystemEvents.Message, \',\', 3) as IP'),
                    \DB::raw('CONCAT(DATEDIFF(ReceivedAt, curdate()),\'d \',DATE_FORMAT(ReceivedAt, \'%H:%i\'))  as DATA'),
                    'SystemEvents.ReceivedAt'
                ])
                ->whereIn('SystemEvents.id', function($query)
                {
                    $query->select(\DB::raw('MAX(SystemEvents.id)'))
                        ->from('SystemEvents')
                        ->where('FromHost' ,'=' ,'170.245.65.134')
                        ->groupBy('SystemEvents.pppoe_user');
                })
                ->get();

            //Retorna a quantidade de clientes por grupo
            $qtdPorGrupo = \DB::table('mk_clientes')
                ->join('mk_grupos', 'mk_clientes.grupo_id', '=', 'mk_grupos.id')
                ->where('mk_clientes.is_ativo', '=', '1')
                ->select([
                    'mk_grupos.nome',
                    \DB::raw('COUNT(*) as qtdGrupo')
                ])
                ->groupBy('mk_grupos.nome')
                ->get();

            return \Illuminate\Support\Facades\Response::json(['success' => true, 'query' => $query, 'qtdPorGrupo' => $qtdPorGrupo ]);

        } catch (Exception $exception) {

            return \Illuminate\Support\Facades\Response::json(['error' => true ]);
        }

    }

}