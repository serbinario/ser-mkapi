<?php
namespace Serbinario\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Log;
use Serbinario\Entities\Cliente;
use Serbinario\Entities\Cobranca;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinBoleto;
use Serbinario\Entities\LogDb;
use Serbinario\Entities\SendMessage;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacilApi;


class SyslogAPIController extends Controller
{

    public function logMikrotik(Request $request)
    {

        $manage = (array) json_decode($request->get('data'));
        //echo "eeeeeeee";
        Log::info(
            $manage
        );
        $ip = $request->get('ip');
        $pppoeUser = $request->get('user');
        $status = $request->get('status');
        \Serbinario\Entities\Log::create(['ip' => $ip, 'pppoe_user' => $pppoeUser, 'status' => $status ]);
        return \Response::make('message', 200);
    }


    public function LogBanco($array)
    {
        Log::info(
            $array
        );

        $date = date("Y-m-d h:i:s");
        $log = new LogDb();
        $log->log = json_encode($array);
        $log->date = $date;
        $log->save();
    }

}