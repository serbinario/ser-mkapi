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
    private $vencimento_ini;
    private $vencimento_fim;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function reportPdfFinanceiroIndex()
    {
        return view('report.index');
    }

    /**
     *  Dados que irão preencher o relatório gerado em pdf
     *  Retorna todos os clientes que nao tem debitos passando como parametro a data e s dia de vencimento
     *  Menu > relatorios > por agenda > gerar pdf
     */
    public function reportPdfFinanceiro(Request $request)
    {
        //dd($request->all());
        try {

            $vencimento_ini = $request->get('vencimento_ini');
            $vencimento_fim = $request->get('vencimento_fim');
            $ordePor = $request->get('ordePor');
            //dd($ordePor);
            //dd($this->vencimento_ini, $this->vencimento_fim);

            $clientes = \DB::table('mk_clientes')
                ->join('mk_vencimento_dia', 'mk_vencimento_dia.id', '=', 'mk_clientes.vencimento_dia_id')
                ->select([
                    'mk_clientes.nome',
                    'mk_vencimento_dia.nome as dia',
                    \DB::raw('DATE_FORMAT(mk_clientes.data_instalacao,"%d/%m/%Y") as data_instalacao')
                ])
                ->where('mk_clientes.is_ativo', '1')
                ->whereIn('vencimento_dia_id', [2,6,11,16,21,26,31,33])
                ->orderBy($ordePor, 'ASC')
                ->whereNotIn('mk_clientes.id', function($q) use ($vencimento_fim, $vencimento_ini) {
                $q->select('fin_debitos.mk_cliente_id')
                    ->whereBetween('data_vencimento', [$vencimento_ini, $vencimento_fim])
                    ->from('fin_debitos');
            })->get();

            //dd($clientes);
            return \PDF::loadView('reports.viewPdfFinanceiro', compact('clientes', 'vencimento_ini', 'vencimento_fim'))->stream();
            # Retornando para página
            // return $PDF->stream();

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    /**
     *  Dados que irão preencher o relatório gerado em pdf
     *
     *  Menu > relatorios > por agenda > gerar pdf
     */
    public function reportPdfFinanceiroCliente(Request $request)
    {
        //dd($request->all());
        try {

            $vencimento_ini = $request->get('vencimento_ini');
            $vencimento_fim = $request->get('vencimento_fim');
            //dd($this->vencimento_ini, $this->vencimento_fim);

            $cur_date = Carbon::now();

            $rows = \DB::table('fin_debitos')
                ->leftJoin('mk_clientes', 'fin_debitos.mk_cliente_id', '=', 'mk_clientes.id')
                ->leftJoin('fin_boletos', 'fin_boletos.id', '=', 'fin_debitos.boleto_id')
                //->where('fin_debitos.data_vencimento', '<=', $cur_date)
                ->where('fin_debitos.status_id', '=', '4')
                ->orderBy('dias_atraso', 'DESC')
                ->select([
                    'fin_debitos.id',
                    'mk_clientes.nome',
                    'mk_clientes.login',
                    \DB::raw('IF(mk_clientes.status_secret = 0, "Bloqueado", "Ativo") as status_secret'),
                    \DB::raw('DATE_FORMAT(fin_debitos.data_vencimento,"%d/%m/%Y") as data_vencimento'),
                    'fin_debitos.valor_debito',
                    'fin_boletos.link',
                    'fin_boletos.code',
                    \DB::raw('DATEDIFF(data_vencimento, NOW()) AS dias_atraso')
                    //\DB::raw('DATE_FORMAT(bib_emprestimos.data,"%d/%m/%Y") as data'),
                ])->get();

            //dd($clientes);
            return \PDF::loadView('reports.viewPdfFinanceiro', compact('clientes', 'vencimento_ini', 'vencimento_fim'))->stream();
            # Retornando para página
            // return $PDF->stream();

        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }


}