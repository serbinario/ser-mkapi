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

class Mikrotik extends Command
{
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
            default:
                echo "not commands \n";


        }

        $router = new RouterosService();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

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

    public function queuesCount()
    {


        $router = new RouterosService();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

        $router->write('/ppp/secret/print',true);
        //$router->write('=count-only=',true);

        $READ = $router->read(false);
        $countQueues = $router->parseResponse($READ);

        dd($countQueues);

    }

    public function listClients()
    {

        $router = new RouterosService();
        $router->debug = false;
        $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');



        $router->write("/ppp/active/getall",false);
        $router->write('?name=davi',true);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);
        if(count($ARRAY)>0){ // si el usuario esta activo lo pateo.
            $router->write("/ppp/active/remove",false);
            $router->write("=.id=".$ARRAY[0]['.id'],true);
            $READ = $router->read(false);
            $ARRAY = $router->parseResponse($READ);
        }
        var_dump($ARRAY);



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



        //Esse funciona
        $router->comm("/ppp/secret/add", array(
            "numbers"     => "paulovaz",
            "profile" => "Bloqueados",
            "remote-address" => "172.16.1.10",
            "comment"  => "{new VPN user}",
            "service"  => "pptp",
        ));






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
}
