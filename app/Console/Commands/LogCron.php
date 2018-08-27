<?php

namespace Serbinario\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Serbinario\Entities\Debito;
use Serbinario\Entities\Debitos;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

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

        $dateNow = Carbon::now()->addDays(10)->format('Y-m-d');
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
            if($now > $end){
                //Clientes que ainda vai vencer
                $length = -$length;
                echo   "Vencidos " . $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
            }else{
                echo   $debito->mkCliente->nome ." - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
            }

            //dd($debito);
            //$intervalo = $dateNow->diff( $debito->data_vencimento );
            //echo $debito->mkCliente->nome . " - " . $debito->id . " - ". $debito->status_id . " - ". $debito->data_vencimento . " - " . $length . "\n" ;
        }
    }
}
