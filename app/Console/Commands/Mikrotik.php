<?php

namespace Serbinario\Console\Commands;

use Illuminate\Console\Command;
use Serbinario\Entities\Cobranca;
use Serbinario\Entities\Debitos;
use Serbinario\Http\Controllers\RouterosApi;
use Serbinario\Entities\Cliente;

class Mikrotik extends Command
{
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
    public function __construct()
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

        $router = new RouterosApi();
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

        $router = new RouterosApi();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

        $router->write('/ppp/active/print',false);
        $router->write('=count-only=',true);

        $READ = $router->read(false);
        $countQueues = $router->parseResponse($READ);

        dd($countQueues);

    }

    public function listClients()
    {


        $router = new RouterosApi();
        $router->debug = false;

        $router->connect('170.245.65.134', 'NetSerb', 'nets@2017#');

        $router->write('/ppp/active/print',true);
        $READ = $router->read(false);
        $ARRAY = $router->parseResponse($READ);

        $list = array();

        for ($i = 0; $i < count($ARRAY); $i ++)
        {
            $login = $ARRAY[$i]['name'];
            echo $i . ";" . $login . ";";

            //$login = "ewertton";
            //Verifico na tabela mk_cliente se existe o login
            $clientes =  Cliente::where('login', '=' , $login)->limit(1)->get();



            if($clientes->isNotEmpty()){
                foreach ($clientes as $cliente){
                    echo $cliente->nome . ";";
                    $this->cobranca($cliente);
                };
            }else{
                echo ";" . "\n";
            }
        }

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
