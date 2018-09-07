<?php

namespace Serbinario\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Serbinario\Entities\Debito;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\SendMessage;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron {var : The ID of the user}';

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

        $var = $this->argument('var');

        switch($var){
            case "updateInadiplentes":
                $this->updateInadiplentes();
                break;
            case "listclients":
                $this->listClients();
                break;
            case "ssh";
                $this->ssh2();
                //$this->cfgssh('170.245.65.134', 'NetSerb', 'nets@2017#', 'ppp active print  without-paging', '22', 'TUDO');
                break;
            default:
                echo "not commands \n";


        }

        //RN-0004
        //Pega o dia atual + 10 dias
        // msg = 1 vencendo
        // msg = 2 Vencido
        // msg = 3 bloqueio
        /*$dateNow = Carbon::now()->addDays(10)->format('Y-m-d');
        $debitos = Debitos::with('mkCliente')->where('data_vencimento','<=', $dateNow)
            ->whereIn('status_id', [4,2])
            ->orderBy('data_vencimento', 'asc')
            ->get();

        foreach ($debitos as $debito)
        {
            $now = Carbon::now();
            $end = Carbon::parse($debito->data_vencimento);


            //dd($end->isWeekend());
            //Retorna a diferença entre as duas datas
            $length = $end->diffInDays($now);

            //echo $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;


            if($now > $end){
                //Clientes que ainda vai vencer
                //$length = -$length;
                $this->vencidos($debito, $length);
                echo   "Vencidos " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;


            }else{
                $this->aVencer($debito, $length);
                //echo   $debito->mkCliente->nome ." - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
            }
        }*/
    }

    /*
     * Atualiza a tabela fin_debitos se algum debito na data atual + 2 dias, nao estiver como pago, e colocado como inadimplente
     */
    public function updateInadiplentes()
    {
        $rows = \DB::table('fin_debitos')
            ->where('status_id', 2)
            ->whereRaw('data_vencimento = CURRENT_DATE()-2')
            ->update(['status_id' => 4]);
    }

    public function vencidos($debito, $length)
    {
        if($length == "2")  $this->geraMsgBanco($debito, "2");
        if($length == "10") $this->geraMsgBanco($debito, "4");
    }

    public function aVencer($debito, $length)
    {
        if($length == "5") {
            echo   "A Vencer ---- " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
            $this->geraMsgBanco($debito, "1");
        }
        if($length == "0"){
            echo   "A Vencer ---- " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
            $this->geraMsgBanco($debito, "1");
        }
        //if($length == "10")  echo   "Bloqueio --- " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;

    }

    public function geraMsgBanco($debito, $mgs)
    {
        SendMessage::create(['nome' => $debito->mkCliente->nome, 'debito_id' => $debito->id, 'mensagem_id' => $mgs]);
        $this->printTela($debito, $mgs);
    }

    public function printTela($debito, $mgs)
    {
        echo   " ---- " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $mgs . "\n" ;
    }
}
