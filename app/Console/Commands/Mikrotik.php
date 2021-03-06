<?php

namespace Serbinario\Console\Commands;

use Illuminate\Console\Command;
use MikrotikAPI\MikrotikAPI;
use Serbinario\Entities\Cobranca;
use Serbinario\Entities\Debitos;
use Serbinario\Http\Controllers\RouterosApi;
use Serbinario\Entities\Cliente;
use Serbinario\Services\MikrotikAPI\PPP\TraitSecret;
use Serbinario\Services\MikrotikAPI\RouterosService;
use Serbinario\Services\teste;

use Ssh\Client;
use Ssh\Auth\Password;

class Mikrotik extends Command
{

    protected $teste;
    use TraitSecret;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mikrotik:list {list : The ID of the user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(teste $teste)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $list = $this->argument('list');

        switch($list){
            case "countqueues":
                $this->queuesCount();
                break;
            case "listclients":
                $this->listClients();
                break;
            case "ssh";
                $this->ssh2();
                //$this->cfgssh('170.245.65.134', 'NetSerb', 'nets@2017#', 'ppp active print  without-paging', '22', 'TUDO');
                break;
            case "activeclients":
                $this->activeClients();
            case "teste":
                $this->teste();
            default:
                echo "not commands \n";


        }

        $router = new RouterosService();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetRb', 'nets!2010#');

        $router->write('/ppp/secret/print',true);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);

        $list = array();

        for ($i = 0; $i < count($ARRAY); $i ++)
        {
            $list['login'] = $ARRAY[$i]['name'];
            $list['senha'] = $ARRAY[$i]['password'];
            //$coment = " \" " .  $ARRAY[$i]['comment'] . "\" ";
            //S$list['obs'] = $coment;
            // dd($list);
            Cliente::firstOrCreate($list);
            $list = '';
        }

    }

    public function teste()
    {

        $cpf = "02850179426";
        $queries = \DB::select("SELECT pppoe_user, SPLIT_STRING(Message, ',', 1) AS STATUS, SPLIT_STRING(Message, ',', 3) AS ip, ReceivedAt 
                                FROM SystemEvents 
                                WHERE id IN(SELECT MAX(id) FROM SystemEvents WHERE  FromHost = '170.245.65.134' GROUP BY pppoe_user)");
        //$queries = \DB::select("SPLIT_STRING($cpf)");
        dd($queries);

    }

    public function queuesCount()
    {


        $router = new RouterosService();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetRb', 'nets!2010#');

        $router->write('/ppp/secret/print',true);
        //$router->write('=count-only=',true);

        $READ = $router->read(false);
        $countQueues = $router->parseResponse($READ);

        dd($countQueues);

    }

    public function activeClients()
    {

        $router = new RouterosService();
        $router->debug = false;
        $router->connect('170.245.65.134', 'NetRb', 'nets!2010#');


        $router->write('/ppp/active/print', false);
        $router->write('=.proplist=name,address,uptime,caller-id,service');

        $READ = $router->read(false);
        $actives = $router->parseResponse($READ);

        //Retorna os clients ativos
        $users = \DB::table('mk_clientes')
            ->where('is_ativo', 1)
            ->select('login', 'senha')->get();


        $clientes_full = array();
        //dd($actives);
        foreach ($users as $user){

            //Retorna a chave
            $key = array_search($user->login, array_column($actives, 'name'));

            if($key){
                array_push($clientes_full,
                    [
                        'nome' => $user->login,
                        'senha' => $user->senha,
                        'uptime' => $actives[$key]['uptime'],
                        'address' => $actives[$key]['address'],
                        'Latitude' => 'Latitude',
                        'Longitude' => 'Longitude',
                        'status' => 'conectado'
                    ] );
            }else{
                array_push($clientes_full,
                    [
                        'nome' => $user->login,
                        'senha' => $user->senha,
                        'status' => 'desconectado',
                        'Latitude' => 'Latitude',
                        'Longitude' => 'Longitude'
                    ] );
            }

            //$clientes_full['1'] = $actives[$key]['name'];


        }

        dd(json_encode($clientes_full));
        return response()->json(
            $clientes_full
        );

        dd($clientes_full);


        //Fim dos clientes ativos
        dd("teste");

        $list = array();

        $actives = $this->array_enkeyize($actives, 'name');

        //dd($actives);

        //dd($secrets);
        //$actives = $this->array_dekeyize($actives, 'name');





    }

    public function check_diff_multi($array1, $array2){
        $result = array();
        foreach($array1 as $key => $val) {
            if(isset($array2[$key])){
                if(is_array($val) && $array2[$key]){
                    $result[$key] = $this->check_diff_multi($val, $array2[$key]);
                }
            } else {
                $result[$key] = $val;
            }
        }

        return $result;
    }

    public function array_enkeyize($array, $iten) {
        foreach ($array as $key => $value) {
            foreach ($value as $v_key => $v_value) {
                if ($v_key === $iten){
                    $keized[$v_value] = $array[$key];
                    unset($keized[$v_value][$iten]);
                }
            }
        }

        return $keized;
    }


    public function array_dekeyize($array, $iten) {
        $i = 0;
        dd($array);
        foreach ($array as $key => $value) {
            $dekeized[$i] = $array[$key];
            $dekeized[$i++][$iten] = $key;
        }

        return $dekeized;
    }

    public function seExisteNaBase($login, $i)
    {
        //echo $i . " N " . $login . "\n";

        $cliente = Cliente::where('login', '=', $login)->limit(1)->first();
        if(!empty($cliente)){

            $debitos = Debitos::where('mk_cliente_id', '=', $cliente->id)
                ->whereBetween('data_vencimento', ["2018-10-01", "2018-10-31"])
                ->get();
            if(!$debitos->count()){
                echo $i . ";" . "NULL" . ";" . $login . ";" . $cliente->nome . ";" . $cliente->id . "\n";
            }
            foreach ($debitos as $debito){
                if(!empty($debito)){
                    echo $i . ";" . $debito->valor_debito . ";" . $login . ";" . $cliente->nome . ";" . $cliente->id . "\n";
                }else{
                    echo $i . ";" . "NULL" . ";" . $login . ";" . $cliente->nome . ";" . $cliente->id . "\n";
                }

            }

        }else{
            //echo $i . " N " . $login . "\n";
        }

    }

    public function listClients()
    {

        $router = new RouterosService();
        $router->debug = false;
        $router->connect('170.245.65.134', 'NetRb', 'nets!2010#');



        $router->write('/ppp/secret/print',true);
        $READ = $router->read(false);
        dd($READ);
        $ARRAY = $router->parseResponse($READ);

        $list = array();

        for ($i = 0; $i < count($ARRAY); $i ++)
        {
            //$list['login'] = $ARRAY[$i]['name'];
            //$list['senha'] = $ARRAY[$i]['password'];
            //$coment = " \" " .  $ARRAY[$i]['comment'] . "\" ";
            //S$list['obs'] = $coment;
            // dd($list);
            //$this->seExisteCobranca($ARRAY[$i]['name'], $i);

            //$list = '';
        }



        //$router->write('/ppp/active/remove', false);
        //$router->write('=.id=' . $return['0']['.id']);
        //$READ = $router->read();
        //var_dump($READ);




        dd("dddd");
        //Esse funciona
        $rest = $router->comm("/ppp/secret/set", array(
            "numbers"     => "paulovaz",
            "profile" => "Bloqueados",
        ));

        dd($rest);
        //dd("wwwwwwwwww");
        $this->set($router);
        // $rest = $secret->getAll($router);



        /* //Esse funciona
         $router->comm("/ppp/secret/add", array(
             "numbers"     => "paulovaz",
             "profile" => "Bloqueados",
             "remote-address" => "172.16.1.10",
             "comment"  => "{new VPN user}",
             "service"  => "pptp",
         ));*/

    }

    public function seExisteCobranca($login, $i)
    {

        $cliente =  Cliente::where('login', '=' , $login)->limit(1)->first();
        //dd($cliente->nome);
        if(!empty($cliente)){

            $cobranca =  Cobranca::where('nome', '=' , $cliente->nome)->limit(1)->first();
            if(empty($cobranca)){
                echo "Sem Cobranca: " . $cliente->nome . " " . $login . "\n";
            }



        }else{
            //Imprimi  o que nao econtrou
            echo $i . " " . $login . " --- " . "\n";
        };




        /* $cobrancas =  Cobranca::where('mk_cliente_id', '=' , $cliente)->limit(1)->get();
         //dd($cobrancas);
         if($cobrancas->isNotEmpty()){
             foreach ($cobrancas as $cobranca){
                 echo $cobranca->numero_cobranca . ";" . $cobranca->valor_debito . ";" . $cobranca->status . ";" . $cobranca->data_vencimento . ";" . $cobranca->data_pagamento . ";" . "\n";
             };
         }else{

             echo ";;;;;" . "\n";
         }*/
    }

    public function cobranca($cliente)
    {
        $cobrancas =  Debitos::where('mk_cliente_id', '=' , $cliente->id)->limit(1)->get();
        //dd($cobrancas);
        if($cobrancas->isNotEmpty()){
            foreach ($cobrancas as $cobranca){
                echo $cobranca->numero_cobranca . ";" . $cobranca->valor_debito . ";" . $cobranca->status . ";" . $cobranca->data_vencimento . ";" . $cobranca->data_pagamento . ";" . "\n";
            };
        }else{

            echo ";;;;;" . "\n";
        }
    }


    /**
     * @param $host
     * @param $login
     * @param $pass
     * @param $cmnd
     * @param int $port
     * @param bool $filter
     * @return bool|string
     */
    public function cfgssh ($host, $login, $pass, $cmnd, $port=22, $filter=FALSE) {
        $headr = array(	'kex'	=>	'diffie-hellman-group1-sha1'	);
        set_time_limit(4);

        if(!$sock = ssh2_connect($host, $port, $headr)) return(FALSE);
        if(!ssh2_fingerprint($sock)) return(FALSE);
        if(!ssh2_auth_password($sock, $login, $pass)) return(FALSE);


        if($rsrc = ssh2_exec($sock, $cmnd)) {
            stream_set_blocking($rsrc, 1);
            $gets = fgets($rsrc);
            if($filter) {
                dd($rsrc);
                if($filter=='TUDO') {
                    $outs = "";
                    while($gets) {
                        $outs.= $gets . "\n";
                        $gets = fgets($rsrc);
                    }	$gets = $outs;
                } else {
                    while($gets) {
                        if(strstr($gets, $filter)) break;
                        else $gets = fgets($rsrc);
                    }
                }
            }	fclose($rsrc);
        } else $gets = "command not executed";

        if(strstr($gets, 'bad command name') OR
            strstr($gets, 'expected end of command') OR
            strstr($gets, 'command not executed') OR
            strstr($gets, "sed: can't read") OR
            strstr($gets, 'No such command'))
            return(FALSE);
        if($gets==FALSE) return(TRUE);
        return($gets);
    }

    public function ssh2()
    {
        $teste = "";
        \SSH::run('ppp active print detail', function($line)
        {
            $this->teste .= $line;
            //echo $line . "\n";
        });
        dd($this->teste);
        /*\SSH::run([
            'ppp active print without-paging',
        ]);*/
        dd("");
        //'170.245.65.134', 'NetSerb', 'nets@2017#'
        $auth = new Password('NetSerb', 'nets@2017#');
        $client = new Client('170.245.65.134');

        try {
            $client->connect()->authenticate($auth);
            dd($client->exec(' ppp active print without-paging'));
        } catch (\RuntimeException $e) {
            echo $e->getMessage();
        }
    }
}
