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
                {{ csrf_field() }}
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
                                <div class="card-head card-head-xs collapsed"" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                                <header>Filtro</header>
                                <div class="tools">
                                    <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                                </div>
                            </div>
                            <div id="accordion7-1" class="collapse">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="login" class="col-sm-1 control-label">Nome:</label>
                                                <div class="col-md-11">
                                                    <input class="form-control input-sm" name="nome" type="text" id="nome" maxlength="20" placeholder="nome">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
                                                <label for="login" class="col-sm-4 control-label">Data Ini.:</label>
                                                <div class="col-md-8">
                                                    <input class="form-control input-sm date" name="data_inicio" type="text" id="data_inicio" value="{{ old('login', isset($cliente->login) ? $cliente->login : null) }}" maxlength="20" placeholder="Data Inicio">
                                                    {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
                                                <label for="login" class="col-sm-4 control-label">Data Fim.:</label>
                                                <div class="col-md-8">
                                                    <input class="form-control input-sm date" name="data_inicio" type="text" id="data_inicio" value="{{ old('login', isset($cliente->login) ? $cliente->login : null) }}" maxlength="20" placeholder="Data Inicio">
                                                    {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
                                                <label for="login" class="col-sm-4 control-label">Data Ini.:</label>
                                                <div class="col-md-8">
                                                    <input class="form-control input-sm date" name="data_inicio" type="text" id="data_inicio" value="{{ old('login', isset($cliente->login) ? $cliente->login : null) }}" maxlength="20" placeholder="Data Inicio">
                                                    {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="select13" class="col-md-4 control-label">Status</label>
                                                <div class="col-md-8">
                                                    <select id="select13" name="status" class="form-control input-sm">
                                                        <option value="">Todos</option>
                                                        <option value="Pago">Pago</option>
                                                        <option value="Aguardando">Aguardando</option>
                                                        <option value="Cancelado">Cancelado</option>
                                                        <option value="Marcado como pago">Marcado como pago</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="col-md-8">
                                                    <p><button type="button" id="search" class="btn ink-reaction btn-flat btn-primary">Aplicar</button></p>
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
                                            <th>Valor</th>
                                            <th>Data Compet.</th>
                                            <th>Data Venc.</th>
                                            <th>Data Pag.</th>
                                            <th>Valor Pago</th>
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
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection

@section('javascript')
    <script src="{{ asset('/js/debito/index.js')}}" type="text/javascript"></script>
@stop