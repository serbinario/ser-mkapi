@extends('layouts.menu')

@section("css")
    <style type="text/css">
        .list .tile .tile-text{
            padding: 8px 0px;
            font-size: 12px;
            padding-right: 0px;
        }
        .list .tile .tile-text small {
            font-size: 12px;
        }

        .list .tile .tile-content:last-child {
            padding-right: 0px;
        }
        .list .tile .tile-content {
            padding-left: 7px;
        }
        .list {
            line-height: 15px;
        }
    </style>
@stop

@section('content')


    <!-- BEGIN SITE ACTIVITY -->
    <div class="col-md-6">
        <div class="card ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-head">
                        <header>Histórico de Instalações por Mês</header>
                    </div><!--end .card-head -->
                    <div class="card-body height-8">
                        <div id="flot-visitors-legend" class="flot-legend-horizontal stick-top-right no-y-padding"></div>
                        <div id="IcecastGraph" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>
                    </div><!--end .card-body -->
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->

    <!-- BEGIN SITE ACTIVITY -->
    <div class="col-md-2">
        <div class="card">
            <div class="card-head">
                <header>Centro</header>
            </div><!--end .card-head -->
            <div class="card-body no-padding">
                <ul class="list" data-sortable="true">
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile ">
                        <a class="tile-content ink-reaction style-danger" href="#2">
                            <div class="tile-text ">
                                abner
                                <small>08:80:2019</small>
                            </div>
                        </a>
                    </li>

                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile ">
                        <a class="tile-content ink-reaction style-danger" href="#2">
                            <div class="tile-text ">
                                abner
                                <small>08:80:2019</small>
                            </div>
                        </a>
                    </li>

                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile ">
                        <a class="tile-content ink-reaction style-danger" href="#2">
                            <div class="tile-text ">
                                abner
                                <small>08:80:2019</small>
                            </div>
                        </a>
                    </li>

                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile ">
                        <a class="tile-content ink-reaction style-danger" href="#2">
                            <div class="tile-text ">
                                abner
                                <small>08:80:2019</small>
                            </div>
                        </a>
                    </li>

                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile ">
                        <a class="tile-content ink-reaction style-danger" href="#2">
                            <div class="tile-text ">
                                abner
                                <small>08:80:2019</small>
                            </div>
                        </a>
                    </li>

                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="tile-content ink-reaction" href="#2">
                            <div style="font-size: 10px" class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!--end .card-body -->
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->


    <div class="col-md-2">
        <div class="card">
            <div class="card-head">
                <header>Centro</header>
            </div><!--end .card-head -->
            <div class="card-body no-padding">
                <ul class="list">
                    <li class="tile">
                        <a class="btn btn-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                        <a class="tile-content ink-reaction" href="#2">
                            <div class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-success">
                            <i class="glyphicon glyphicon-ok"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                Alex Nelson
                                <small>Last visit: Yesterday</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-flat btn-danger ink-reaction">
                            <i class="glyphicon glyphicon-heart"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!--end .card-body -->
        </div><!--end .card -->


    </div><!--end .card -->

    <div class="col-md-3">
        <div class="card">
            <div class="card-head">
                <header>Centro</header>
            </div><!--end .card-head -->
            <div class="card-body no-padding">
                <ul class="list">
                    <li class="tile">
                        <a class="btn btn-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                        <a class="tile-content ink-reaction" href="#2">
                            <div class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-success">
                            <i class="glyphicon glyphicon-ok"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                Alex Nelson
                                <small>Last visit: Yesterday</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-flat btn-danger ink-reaction">
                            <i class="glyphicon glyphicon-heart"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!--end .card-body -->
        </div><!--end .card -->
    </div><!--end .card -->

    <div class="col-md-3">
        <div class="card">
            <div class="card-head">
                <header>Centro</header>
            </div><!--end .card-head -->
            <div class="card-body no-padding">
                <ul class="list">
                    <li class="tile">
                        <a class="btn btn-danger">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                        <a class="tile-content ink-reaction" href="#2">
                            <div class="tile-text">
                                Abbey Johnson
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-success">
                            <i class="glyphicon glyphicon-ok"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                Alex Nelson
                                <small>Last visit: Yesterday</small>
                            </div>
                        </a>
                    </li>
                    <li class="tile">
                        <a class="btn btn-flat btn-danger ink-reaction">
                            <i class="glyphicon glyphicon-heart"></i>
                        </a>
                        <a class="tile-content ink-reaction">
                            <div class="tile-text">
                                <small>Last visit: Today</small>
                            </div>
                        </a>
                    </li>
                </ul>
            </div><!--end .card-body -->
        </div><!--end .card -->
    </div><!--end .card -->







  {{--  @include('cliente.modal_financeiro')
    @include('cliente.modal_financeiro_debito')
--}}

@endsection

@section('javascript')

    {{--<script src="{{ asset('/js/cliente/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro_debito.js')}}" type="text/javascript"></script>--}}
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/prettify/r224/prettify.min.css">


    <script src="{{ asset('/assets/js/libs/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/dashboard/index.js')}}" type="text/javascript"></script>
@stop