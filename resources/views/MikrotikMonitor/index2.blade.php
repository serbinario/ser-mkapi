@extends('layouts.menu')

@section("css")
    <style type="text/css">

        body {
            margin: 0;
            padding: 10px 20px 20px;
            font-family: Arial;
            font-size: 16px;
        }

        #mapa {
            padding: 6px;
            border-width: 1px;
            border-style: solid;
            border-color: #ccc #ccc #999 #ccc;
            -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
            box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
            width: 600px;
        }

        #map {
            width: 600px;
            height: 400px;
        }
        .my-custom-class-for-label {
            height: 20px;

            border: 1px solid #eb3a44;
            border-radius: 5px;
            background: #fee1d7;

            text-align: center;
            line-height: 20px;
            font-weight: bold;
            font-size: 14px;
            color: #eb3a44;
        }

        .labels {
            color: red;
            background-color: white;
            font-family: "Lucida Grande", "Arial", sans-serif;
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            width: 40px;
            border: 2px solid black;
            white-space: nowrap;
        }

        .infoBox { background-color: #FFF; width: 300px; font-family: Arial, Helvetica, sans-serif; font-size: 14px; border: 2px solid #3fa7d8; border-radius: 3px; margin-top: 10px }
        .infoBox p { padding: 0 15px }
        .infoBox:before { border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 10px solid #3fa7d8; top: -10px; content: ""; height: 0; position: absolute; width: 0; left: 138px }
    </style>
@stop

@section('content')

    <!-- BEGIN SITE ACTIVITY -->
    <div class="col-md-12">
        <div class="card monitoramento">
            <div id="mapa" style="height: 500px; width: 100%">
            </div>



        </div><!--end .card-head -->

    </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->



    <!-- BEGIN SITE ACTIVITY -->







@endsection

@section('javascript')
    <!-- Maps API Javascript -->
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCZB16vnGtmRiSrSSuOV8E_vmWqhj8yqyw&amp;sensor=false"></script>

    <!-- Caixa de informação -->
    <script src="{{ asset('/js/MikrotikMonitor/infobox.js')}}" type="text/javascript"></script>


    <!-- Agrupamento dos marcadores -->
    <script src="{{ asset('/js/MikrotikMonitor/markerclusterer.js')}}" type="text/javascript"></script>

    <!-- Agrupamento dos marcadores -->
    <script src="{{ asset('/js/MikrotikMonitor/markerwithlabel.js')}}" type="text/javascript"></script>



    <!-- Arquivo de inicialização do mapa -->
    <script src="{{ asset('/js/MikrotikMonitor/mapa2.js')}}" type="text/javascript"></script>
@stop