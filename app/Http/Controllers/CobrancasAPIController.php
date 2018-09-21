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


class CobrancasAPIController extends Controller
{

    /*
     * RN-0001
     * Retorna as cobranças importados pelo command "Clientes" metodo importCsv()
     */
    public function gerenciant()
    {
        try {
            $rows = \DB::table('cobrancas')
                ->leftJoin('mk_clientes', 'mk_clientes.nome', '=', 'cobrancas.nome')
                ->whereNull('cobrancas.obs')
                ->orderBy('cobrancas.nome','ASC')
                ->select([
                    'cobrancas.nome as nomec',
                    'mk_clientes.nome',
                    'mk_clientes.phone01',
                    'cobrancas.valor',
                    \DB::raw('DATE_FORMAT(cobrancas.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'cobrancas.status',
                    'cobrancas.id',
                    'cobrancas.link_pagamento'
                ]);

            //$path = storage_path() . "/json/file}.json"; // ie: /var/www/laravel/app/storage/json/filename.json

            //$json = json_decode(file_get_contents($path), true);

            Log::info(
               $rows->get()->toJson()
            );

            return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $rows->get()]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }
    }


    /*
     * Retorna os debitos
     *
     */
    public function cobrancasPendentes()
    {
        try {
            $rows = \DB::table('send_messages')
                ->leftJoin('fin_debitos', 'fin_debitos.id', '=', 'send_messages.debito_id')
                ->leftJoin('mk_clientes', 'mk_clientes.id', '=', 'fin_debitos.mk_cliente_id')
                ->leftJoin('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
                ->select([
                    'send_messages.id',
                    'send_messages.mensagem_id',
                    'mk_clientes.nome',
                    'mk_clientes.phone01',
                    'fin_debitos.valor_debito',
                    \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'fin_boletos.link'
                ]);


            return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $rows->get()]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }
    }

    public function cobrancasAPISend(Request $request)
    {

        try {

            $now = new Carbon();
            $dateNow = $now->format('Y-m/d');

            $cobranca = Cobranca::where('id', '=', $request->get('cobranca_id'))->first();
            $cobranca->obs = "Enviado com sucesso";
            $cobranca->data_envio = $dateNow;
            $cobranca->save();

            Log::info(
                $request->all()
            );



            return \Illuminate\Support\Facades\Response::json(['success' => true]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }
    }

    /*
     * Responsavel por salvar o status do envio da msg pelo whatsaap
     * #################
     * #### RN-0002 ####
     * #################
     */
    public function cobrancasAPIMsg(Request $request)
    {

        try {
            $now = new Carbon();
            $dateNow = $now->format('Y-m/d');

            $cobranca = Cobranca::where('id', '=', $request->get('cobranca_id'))->first();
            $cobranca->obs = $request->get('msg');
            $cobranca->data_envio = $dateNow;
            $cobranca->save();
            Log::info(
                'errotttt',
                $request->all()
            );
            return \Illuminate\Support\Facades\Response::json(['success' => true]);

        } catch (Exception $exception) {
            return \Illuminate\Support\Facades\Response::json(['success' => false]);
        }
    }

    public function cobrancasAPIMsgBoleto(Request $request)
    {

        try {
            $now = new Carbon();
            $dateNow = $now->format('Y-m/d');

            $cobranca = SendMessage::where('id', '=', $request->get('cobranca_id'))->first();
            $cobranca->obs = $request->get('msg');
            $cobranca->data_envio = $dateNow;
            $cobranca->save();
            Log::info(
                'SendMessage',
                $request->all()
            );
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