@extends('layouts.menu')

@section("css")
    <style type="text/css">
        .list .tile .tile-text{
            padding: 8px 0px;
            font-size: 10px;
            padding-right: 0px;

        }
        .list .tile .tile-text small {
            font-size: 10px;
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
        .tile {
            margin: 2px;
        }
        .col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, .col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, .col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, .col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, .col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, .col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, .col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, .col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, .col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, .col-xs-10, .col-sm-10, .col-md-10, .col-lg-10, .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, .col-xs-12, .col-sm-12, .col-md-12, .col-lg-12{
            padding-left: 3px;
            padding-right: 6px;
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



    <div class="col-md-12">
        <div class="card">
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
        </div><!--end .card -->
    </div><!--end .col -->


    <div class="col-md-12">
        <div class="card">
            <div class="card-head">
                <header>Cruz de Rebolsas - 68</header>
            </div><!--end .card-head -->
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abnerssdsdS
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>
            <div class="col-md-1">
                <div class="card-body no-padding">
                    <ul class="list divider-full-bleed" data-sortable="true">
                        <li class="tile">
                            <a class="tile-content ink-reaction" href="#2">
                                <div class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile ">
                            <a class="tile-content ink-reaction style-danger" href="#2">
                                <div class="tile-text ">
                                    abner
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                        <li class="tile">
                            <a class="tile-content ink-reaction style-info" href="#2">
                                <div style="font-size: 10px" class="tile-text">
                                    emersonb
                                    <small>-10d 10:51</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div><!--end .card-body -->
            </div>


        </div><!--end .card -->
    </div><!--end .col -->
    <!-- END SITE ACTIVITY -->



@endsection

@section('javascript')
    <script src="{{ asset('/js/MikrotikMonitor/index.js')}}" type="text/javascript"></script>
@stop