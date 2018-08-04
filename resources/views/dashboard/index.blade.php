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

    <!-- BEGIN SITE ACTIVITY -->
    <div class="col-md-8">
        <div class="card ">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-head">
                        <header>Historico Instalaçao Clientes</header>
                    </div><!--end .card-head -->
                    <div class="card-body height-8">
                        <div id="flot-visitors-legend" class="flot-legend-horizontal stick-top-right no-y-padding"></div>
                        <div id="placeholder" class="flot height-7" data-title="Activity entry" data-color="#7dd8d2,#0aa89e"></div>
                    </div><!--end .card-body -->
                </div><!--end .col -->
            </div><!--end .row -->
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->

   <div class="col-md-6">
        <div class="card">
            <div class="card-head">
                <header>Registration history</header>
            </div><!--end .card-head -->
            <div class="card-body no-padding height-8">

                <div class="stick-bottom-left-right force-padding">
                    <div id="" class="flot height-5" data-title="Registration history" data-color="#0aa89e"></div>
                </div>
            </div><!--end .card-body -->
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END REGISTRATION HISTORY -->


  {{--  @include('cliente.modal_financeiro')
    @include('cliente.modal_financeiro_debito')
--}}

@endsection

@section('javascript')

    {{--<script src="{{ asset('/js/cliente/index.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/modal_financeiro_debito.js')}}" type="text/javascript"></script>--}}

    <script src="{{ asset('/assets/js/libs/flot/jquery.flot.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/dashboard/index.js')}}" type="text/javascript"></script>
@stop