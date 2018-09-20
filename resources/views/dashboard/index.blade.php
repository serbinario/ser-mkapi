@extends('layouts.menu')

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

    <!-- BEGIN ALERT - REVENUE -->
    <div class="col-md-12 col-sm-6">
        <div class="card">
            <div class="card-body no-padding">
                <div class="alert alert-callout alert-info no-margin">
                    <strong class="pull-right text-success text-lg">0,38% <i class="md md-trending-up"></i></strong><br>
                    <strong class="text-xl">$ 32,829</strong><br/>
                    <span class="opacity-50">Revenue</span>
                </div>
            </div><!--end
        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END ALERT - REVENUE -->

        <!-- BEGIN ALERT - REVENUE -->
        <div class="col-sm-12">
            <div class="">
                <div class="card-body no-padding">
                    <div class="alert alert-callout alert-info no-margin">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="col-sm-4">
                                    <strong class="text-success">Cobrança: 20445889</strong>
                                </div>
                                <div class="col-sm-3">
                                    <strong class="text">Valor: 59,90</strong>
                                </div>


                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-3">
                                    <strong class="pull-right text-success text">0,38% <i class="md md-trending-up"></i></strong>
                                </div>

                            </div>

                        </div>



                    </div>
                </div><!--end .card-body -->
            </div><!--end .card -->
        </div><!--end .col -->
        <!-- END ALERT - REVENUE -->



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