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
    public function cobrancasPendentes(Request $request)
    {
        try {
            Log::info(
                $request->all()
            );
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

    public function inadimplentes(Request $request)
    {
        //dd(array($request->get('status')));
        try {

            $data_ini = $request->get('data_ini');
            $data_fin = $request->get('data_fin');
            //dd($status[0]);
            //dd($this->vencimento_ini, $this->vencimento_fim);

            $cur_date = Carbon::now();

            $clientes = \DB::table('fin_debitos')
                ->leftJoin('mk_clientes', 'fin_debitos.mk_cliente_id', '=', 'mk_clientes.id')
                ->leftJoin('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
                ->leftJoin('fin_status', 'fin_status.id', '=', 'fin_debitos.status_id')
                ->whereBetween('fin_debitos.data_vencimento', [$data_ini, $data_fin])
                ->where('fin_debitos.status_id', '4')
                ->where('mk_clientes.is_ativo', '1')
                ->orderBy('fin_debitos.data_vencimento', 'ASC')
                ->select([
                    'fin_debitos.id',
                    'mk_clientes.nome',
                    'mk_clientes.phone01',
                    \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    \DB::raw('DATE_FORMAT(fin_debitos.data_pagamento,"%d/%m/%Y") as data_pagamento'),
                    'fin_debitos.valor_debito',
                    'fin_debitos.valor_pago',
                    'fin_boletos.link',
                    'fin_boletos.code',
                    'fin_status.nome as status'
                    //\DB::raw('DATE_FORMAT(bib_emprestimos.data,"%d/%m/%Y") as data'),
                ])->get();

            //dd($clientes);
            //dd($clientes);
            return \Illuminate\Support\Facades\Response::json(['success' => true, 'data' => $clientes]);
            # Retornando para página

        } catch (\Throwable $e) {
            return $e->getMessage();
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