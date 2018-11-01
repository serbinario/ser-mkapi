<?php
namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinBoleto;
use Serbinario\Entities\LogDb;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacilApi;
use Serbinario\Http\Controllers\MikrotikController;

class NotificationUrl extends Controller
{
    //Recebe a notificaçao com um parametro do codigo do boleto + paymentToken
    //Localizo o boleto pelo codigo dele e dou um insert no campo paymentToken
    //e coloco o debito como pago
    //Ha um problema, pois ele so coloca como pago nao retorna qual valor foi pago e nem  dia
    //Ai tem que fazer uma consulta com o paymentToken para saber os dados desse boleto
    // Regra RN-0002
    public function notificationUrl(Request $request)
    {
        try {

            $resp = $request->all();

            //Loga no banco para fazer um debug, depois pode desativar
            $this->LogBanco($resp);

            $boleto = FinBoleto::with('debito')->where('code', '=', $resp['chargeCode'])->first();
            //$boleto = FinBoleto::with('debito')->where('code', '=', '20748944')->first();


            //$boleto->paymentToken = '1B2128554368D6A339A49E0B76F993FECCD99D894826DC58';
            $boleto->paymentToken = $resp['paymentToken'];
            //$boleto->fee =;

            //dd($boleto);
            $boletoFacilApi = new BoletoFacilApi();

            //Consulta a um boleto para saber o status4
            $paymentDetails = $boletoFacilApi->fetchPaymentDetails($resp['paymentToken']);
            //$paymentDetails = $boletoFacilApi->fetchPaymentDetails('CD3DA4F76EB4867643B9AEFB9852D814');
            //dd($paymentDetails);
            //Loga no banco
            $this->LogBanco($paymentDetails);

            //Transforma em uma array
            $array = json_decode($paymentDetails, true);

            //Falta terminar abaixo, pegar os dados de retorno do pagameto e jogar no banco,
            //colocar isso dentro de fetchPaymentDetails
            if($array['success'])
            {
                //dd($array);
                //Data do pagamento
                $boleto->debito->data_pagamento = $array['data']['payment']['date'];
                //Valor Pago
                $boleto->debito->valor_pago = $array['data']['payment']['amount'];
                //Local Pagamento
                $boleto->debito->local_pagamento_id = 5;

                //Forma de pagamento Pagamento
                $boleto->debito->forma_pagamento_id = 2;

                //Taxa
                $boleto->fee = $array['data']['payment']['fee'];

                $boleto->save();

                //Coloco o debito como pago
                $boleto->debito->status_id = '3';
                $boleto->debito->save();

                //Desbloqueia o cliente se estiver bloqueado
                $mk = new MikrotikController();
                //dd($boleto->debito->mk_cliente_id);
                $mk->enableSecret($boleto->debito->mk_cliente_id);
            }


            return \Illuminate\Support\Facades\Response::json(['success' => true]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }


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