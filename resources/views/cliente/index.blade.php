@extends('layouts.menu')
@section("css")
    <style type="text/css">
        .carregamento{
            display:    none;
            position:   fixed;
            z-index:    1000000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255, 255, 255, .8 )
            url("{{ asset('/img/pre-loader/load.gif') }}")
            50% 50%
            no-repeat;
        }
    </style>
@stop

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

    @if(Session::has('error_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('error_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif






    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="GET" action="#" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Lista de Clientes</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="" class="btn btn-primary" title="Novo Cliente">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <br>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="localizar"  class="col-sm-4 control-label">Localizar</label>
                                    <div class="col-md-8">
                                        <input class="form-control input-sm"  name="localizar" type="text" id="localizar" value="{{ old('localizar') }}" placeholder="Localizar">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="status" class="col-sm-4 control-label">Status</label>
                                    <div class="col-md-8">
                                        <select id="status" name="status" class="form-control input-sm">
                                            <option value="">Selecione</option>
                                            <option value="1">Ativos</option>
                                            <option value="0">Bloqueados</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group {{ $errors->has('vencimento') ? 'has-error' : '' }}">
                                    <label for="vencimento" class="col-sm-4 control-label">Vencimento.:</label>
                                    <div class="col-md-8">
                                        <select id="vencimento" name="vencimento" class="form-control input-sm">
                                            <option value="">Selecione</option>
                                            <option value="NULL">Sem Vencimento</option>
                                            <option value="01">01</option>
                                            <option value="05">05</option>
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="29">20</option>
                                            <option value="25">25</option>
                                            <option value="30">30</option>
                                            <option value="31">31</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="cliente" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th>+</th>
                                                    <th>Id</th>
                                                    <th style="width: 30%;" >Nome</th>
                                                    <th>CPF/CNPJ</th>
                                                    <th>Login</th>
                                                    <th>Profile</th>
                                                    <th>Status</th>
                                                    <th style="width: 15%;">Acao</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!--end .table-responsive -->
                                </div>
                            </div><!--end .col -->
                        </div><!--end .row -->
                        <!-- END DATATABLE 1 -->




                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a href="{{ route('cliente.cliente.create') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Novo Cliente</a>
                            </div>
                        </div>
                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->



    @include('cliente.modal_financeiro')
    @include('cliente.modal_financeiro_debito')
    @include('cliente.modal_financeiro_baixa_debito')


@endsection

@section('javascript')

    <script src="{{ asset('/js/cliente/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/boqueioDesbloqueio.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro_debito.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro_baixa_debito.js')}}" type="text/javascript"></script>

    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
@stop