@extends('layouts.menu')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Financeiro</header>
                        <div class="tools">
                            <div class="btn-group">

                            </div>
                        </div>
                    </div>
                    <br>

                    <!--Accordion -->
                    <div class="col-md-12">
                        <div class="panel-group" id="accordion">
                            <div class="card panel">
                                <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                                <header>Filtro</header>
                                <div class="tools">
                                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div id="accordion7-1" class="collapse">
                                <div class="card-body">


                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="nome" class="col-sm-2 control-label">Nome:</label>
                                                <div class="col-md-10">
                                                    <input class="form-control input-sm" name="nome" type="text" id="nome" maxlength="20" placeholder="nome">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="code" class="col-sm-4 control-label">N. Cobra.</label>
                                                <div class="col-md-7">
                                                    <input class="form-control input-sm" name="code" type="text" id="code" maxlength="20" placeholder="N. Cobrança">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="select13" class="col-md-4 control-label">Status</label>
                                                <div class="col-md-8">
                                                    <select id="status" name="status" class="form-control input-sm">
                                                        <option value="">Todos</option>
                                                        <option value="3">Pago</option>
                                                        <option value="2">Aguardando</option>
                                                        <option value="7">Cancelado</option>
                                                        <option value="4">Nao Pagos</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="select13" class="col-md-4 control-label">L. Pag.</label>
                                                <div class="col-md-8">
                                                    <select id="loc_pagamento" name="loc_pagamento" class="form-control input-sm">
                                                        <option value="">Todos</option>
                                                        <option value="5">Boletofacil</option>
                                                        <option value="4">Caixa NetStart</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="data_pag_ini" class="col-sm-6 control-label">Pag. De.:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm date" name="data_pag_ini" type="text" id="data_pag_ini" value="{{ old('data_pag_ini',  null) }}" maxlength="20" placeholder="PAG. DE">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="data_pag_fim" class="col-sm-6 control-label">Pag. Até:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm date" name="data_pag_fim" type="text" id="data_pag_fim" value="{{ old('login',  null) }}" maxlength="20" placeholder="PAG. ATE">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="data_venc_ini" class="col-sm-6 control-label">Venc. De:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm date" name="data_venc_ini" type="text" id="data_venc_ini" value="{{ old('data_venc_ini',  null) }}" maxlength="20" placeholder="VENC. DE">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="data_venc_fim" class="col-sm-6 control-label">Venc. Até:</label>
                                                <div class="col-md-6">
                                                    <input class="form-control input-sm date" name="data_venc_fim" type="text" id="data_venc_fim" value="{{ old('login', null) }}" maxlength="20" placeholder="VENC. ATE">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <a href="#" type="button" id="search" class="btn btn-flat btn-primary ink-reaction">Localizar</a>
                                                    <input class="btn btn-primary"  id="clear" type="button" value="Limpar">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--end .panel -->
                    </div><!--end .panel-group -->


                    <div class="row">
                        <!-- BEGIN ALERT - REVENUE -->
                        <div class="col-md-3 col-sm-6">
                            <!-- BEGIN SERVER STATUS -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <em class="text-primary">Pagas</em>
                                    <br/>
                                    <div class="knob knob-support2 knob-inverse-track size-2">
                                        <input id="pagas" ata-fgColor="chartreuse" data-height="100%" data-thickness=".2" readonly value="">

                                    </div>
                                    <br>
                                    <em class="text-primary pagas">Temperature</em>

                                </div><!--end .col -->
                            </div><!-- END SERVER STATUS -->
                        </div><!--end .col -->
                        <!-- END ALERT - REVENUE -->

                        <!-- BEGIN ALERT - REVENUE -->
                        <div class="col-md-3 col-sm-6">
                            <!-- BEGIN SERVER STATUS -->
                            <div class="col-md-12">
                                <div class=" text-center">
                                    <em class="text-primary">A Receber</em>
                                    <br/>
                                    <div class="knob knob-support2 knob-inverse-track size-2">
                                        <input id="aReceber" ata-fgColor="chartreuse" data-height="100%" data-thickness=".2" readonly>

                                    </div>
                                    <br>
                                    <em class="text-primary areceber"></em>

                                </div><!--end .col -->
                            </div><!-- END SERVER STATUS -->
                        </div><!--end .col -->
                        <!-- END ALERT - REVENUE -->

                        <!-- BEGIN ALERT - REVENUE -->
                        <div class="col-md-3 col-sm-6">
                            <!-- BEGIN SERVER STATUS -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <em class="text-primary">Inadiplentes</em>
                                    <br/>
                                    <div class="knob knob-support2 knob-inverse-track size-2">
                                        <input id="inadiplentes" ata-fgColor="chartreuse" data-height="100%" data-thickness=".2" readonly value="">

                                    </div>
                                    <br>
                                    <em class="text-primary inadiplentes"></em>

                                </div><!--end .col -->
                            </div><!-- END SERVER STATUS -->
                        </div><!--end .col -->
                        <!-- END ALERT - REVENUE -->

                        <!-- BEGIN ALERT - REVENUE -->
                        <div class="col-md-3 col-sm-6">
                            <!-- BEGIN SERVER STATUS -->
                            <div class="col-md-12">
                                <div class="text-center">
                                    <em class="text-primary">Pagos Dinheiro</em>
                                    <br/>
                                    <div class="knob knob-support2 knob-inverse-track size-2">
                                        <input id="dinheiro" ata-fgColor="chartreuse" data-height="100%" data-thickness=".2" readonly value="">

                                    </div>
                                    <br>
                                    <em class="text-primary dinheiro"></em>

                                </div><!--end .col -->
                            </div><!-- END SERVER STATUS -->
                        </div><!--end .col -->
                        <!-- END ALERT - REVENUE -->
                    </div><!--end .row -->



                    <!-- DATATABLE 1 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel-body panel-body-with-table">
                                <div class="table-responsive">
                                    <table id="debitos" class="table order-column hover">
                                        <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Cobr. N</th>
                                            <th>Valor</th>
                                            <th>Data Compet.</th>
                                            <th>Data Venc.</th>
                                            <th>Data Pag.</th>
                                            <th>V. Pago</th>
                                            <th>Form Pag.</th>
                                            <th>Status</th>
                                            <th>Acao</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div><!--end .table-responsive -->
                            </div>
                        </div><!--end .col -->
                    </div><!--end .row -->
                    <!-- END DATATABLE 1 -->
                   {{-- <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('debitos.debitos.create') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Novo Fornecedor</a>
                        </div>
                    </div>--}}
                </div><!--end .card -->

            </form>

            <!--Accordion -->
            <div class="col-md-12">
                <div class="panel-group" id="accordion">
                    <div class="card panel">
                        <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-12">
                            <header>Relatorio</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div id="accordion7-12" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control input-sm date" name="data_ini" type="text" id="data_ini" value="{{ old('data_pag_ini',  null) }}" maxlength="20" placeholder="DATA INI.">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control input-sm date" name="data_fim" type="text" id="data_fim" value="{{ old('login',  null) }}" maxlength="20" placeholder="DATA FIM.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="select13" class="col-md-4 control-label">Por data de</label>
                                            <div class="col-md-8">
                                                <select id="data_de" name="data_de" class="form-control input-sm">
                                                    <option value="data_vencimento">Vencimento</option>
                                                    <option value="data_pagamento">Pagamento</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ordePor" class="col-md-4 control-label">Ordenar Por:</label>
                                            <div class="col-md-8">
                                                <select id="ordePorC" name="ordePorC" class="form-control input-sm">
                                                    <option value="mk_clientes.nome">Nome</option>
                                                    <option value="fin_boletos.code">Cobrança</option>
                                                    <option value="fin_debitos.data_vencimento">Data Vencimento</option>
                                                    <option value="fin_debitos.data_pagamento">Data Pagamento</option>
                                                    <option value="status">Status</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group" id="status">
                                            <label class="col-sm-2 control-label">Status</label>
                                            <label class="checkbox-inline checkbox-styled checkbox-primary">
                                                <input type="checkbox" value="3" checked><span>Pagos</span>
                                            </label>
                                            <label class="checkbox-inline checkbox-styled checkbox-success">
                                                <input type="checkbox" value="2" checked><span>Aguardando</span>
                                            </label>
                                            <label class="checkbox-inline checkbox-styled checkbox-warning">
                                                <input type="checkbox" value="7" checked><span>Cancelados</span>
                                            </label>
                                            <label class="checkbox-inline checkbox-styled checkbox-warning">
                                                <input type="checkbox" value="4" checked><span>Nao Pagos</span>
                                            </label>
                                        </div><!--end .col -->
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <a href="{{ route('report.financeiroCliente') }}" type="button" id="gerarRelatorioCliente" class="btn btn-primary ink-reaction">Gerar Relatorio</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end .panel -->
                </div><!--end .panel-group -->
            </div><!--end .col -->

            <!--Accordion -->
            <div class="col-md-12">
                <div class="panel-group" id="accordion">
                    <div class="card panel">
                        <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-13">
                            <header>Relatorio - Clientes sem boleto</header>
                            <div class="tools">
                                <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                            </div>
                        </div>
                        <div id="accordion7-13" class="collapse">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control input-sm date" name="vencimento_ini" type="text" id="vencimento_ini" value="{{ old('data_pag_ini',  null) }}" maxlength="20" placeholder="DATA INI PAG.">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input class="form-control input-sm date" name="vencimento_fim" type="text" id="vencimento_fim" value="{{ old('login',  null) }}" maxlength="20" placeholder="DATA FIM PAG.">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="ordePor" class="col-md-4 control-label">Ordenar Por:</label>
                                            <div class="col-md-8">
                                                <select id="ordePor" name="ordePor" class="form-control input-sm">
                                                    <option value="mk_vencimento_dia.nome">Vencimento</option>
                                                    <option value="mk_clientes.nome">Nome</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <a href="{{ route('report.financeiro') }}" type="button" id="gerarRelatorio" class="btn btn-primary ink-reaction">Gerar Relatorio</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end .panel -->
                </div><!--end .panel-group -->
            </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/debito/index.js')}}" type="text/javascript"></script>
@stop