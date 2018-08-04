<?php
namespace Serbinario\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use Serbinario\Entities\Debitos;
use Serbinario\Entities\FinBoleto;
use Serbinario\Http\Controllers\BoletoFacil\BoletoFacilApi;


class NotificationUrl extends Controller
{
    //Recebe a notificaçao com um parametro do codigo do boleto + paymentToken
    //Localizo o boleto pelo codigo dele e dou um insert no campo paymentToken
    //e coloco o debito como pago
    //Ha um problema, pois ele so coloca como pago nao retorna qual valor foi pago e nem  dia
    //Ai tem que fazer uma consulta com o paymentToken para saber os dados desse boleto
    public function notificationUrl(Request $request)
    {
        try {

            $resp = $request->all();

            Log::info(
                $resp
            );
            $boletos = FinBoleto::with('debito')->where('code', '=', $resp['chargeCode'])->get();
            //$boletos = FinBoleto::with('debito')->where('code', '=', '30031043')->get();


            foreach ($boletos as $boleto){
               //$boleto->paymentToken = 'CD3DA4F76EB4867643B9AEFB9852D814';
               $boleto->paymentToken = $resp['paymentToken'];
               //$boleto->fee =;


                $boletoFacilApi = new BoletoFacilApi();

                //Consulta a um boleto para saber o status
                $paymentDetails = $boletoFacilApi->fetchPaymentDetails($resp['paymentToken']);
                //$paymentDetails = $boletoFacilApi->fetchPaymentDetails('CD3DA4F76EB4867643B9AEFB9852D814');


                //Transforma em uma array
                $array = json_decode($paymentDetails, true);

                Log::info(
                    $array
                );



                //Falta terminar abaixo, pegar os dados de retorno do pagameto e jogar no banco,
                //colocar isso dentro de fetchPaymentDetails
                if($array['success'])
                {
                    //dd($array);
                    //Data do pagamento
                    $boleto->debito->data_pagamento = $array['data']['payment']['date'];
                    //Valor Pago
                    $boleto->debito->valor_pago = $array['data']['payment']['amount'];
                    //Taxa
                    $boleto->fee = $array['data']['payment']['fee'];

                    $boleto->save();

                    //Coloco o debito como pago
                    $boleto->debito->status_id = '3';
                    $boleto->debito->save();
                }



            }

            return \Illuminate\Support\Facades\Response::json(['success' => true]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }
    }

}