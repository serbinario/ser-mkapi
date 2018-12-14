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