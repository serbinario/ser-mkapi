<?php
/**
 * Created by PhpStorm.
 * User: serbinario
 * Date: 06/08/18
 * Time: 18:14
 */

namespace Serbinario\Http\Controllers;


use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  Dados que irão preencher o relatório gerado em pdf
     *  Retorna todos os clientes que nao tem debitos passando como parametro a data e s dia de vencimento
     *  Menu > relatorios > por agenda > gerar pdf
     */
    public function reportPdfFinanceiro(Request $request)
    {
        //dd("sss");
        try {

            $clientes = \DB::table('mk_clientes')
                ->select([
                    'mk_clientes.nome'
                ])
                ->where('is_ativo', '1')
                ->where('vencimento_dia_id', '6')
                ->orderBy('nome', 'ASC')
                ->whereNotIn('id', function($q){
                $q->select('fin_debitos.mk_cliente_id')
                    ->whereBetween('data_vencimento', ['2018-11-01', '2018-11-05'])
                    ->from('fin_debitos');
            })->get();

            //dd($result);
            return \PDF::loadView('reports.viewPdfFinanceiro', compact('clientes'))->stream();
            # Retornando para página
            // return $PDF->stream();

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }


}