@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_log_form" name="edit_log_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('log.log.index') }}" class="btn btn-primary" title="Show All Log">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Customer I D</dt>
            <dd>{{ $log->CustomerID }}</dd>
            <dt>Received At</dt>
            <dd>{{ $log->ReceivedAt }}</dd>
            <dt>Device Reported Time</dt>
            <dd>{{ $log->DeviceReportedTime }}</dd>
            <dt>Facility</dt>
            <dd>{{ $log->Facility }}</dd>
            <dt>Priority</dt>
            <dd>{{ $log->Priority }}</dd>
            <dt>From Host</dt>
            <dd>{{ $log->FromHost }}</dd>
            <dt>Message</dt>
            <dd>{{ $log->Message }}</dd>
            <dt>N T Severity</dt>
            <dd>{{ $log->NTSeverity }}</dd>
            <dt>Importance</dt>
            <dd>{{ $log->Importance }}</dd>
            <dt>Event Source</dt>
            <dd>{{ $log->EventSource }}</dd>
            <dt>Event User</dt>
            <dd>{{ $log->EventUser }}</dd>
            <dt>Event Category</dt>
            <dd>{{ $log->EventCategory }}</dd>
            <dt>Event I D</dt>
            <dd>{{ $log->EventID }}</dd>
            <dt>Event Binary Data</dt>
            <dd>{{ $log->EventBinaryData }}</dd>
            <dt>Max Available</dt>
            <dd>{{ $log->MaxAvailable }}</dd>
            <dt>Curr Usage</dt>
            <dd>{{ $log->CurrUsage }}</dd>
            <dt>Min Usage</dt>
            <dd>{{ $log->MinUsage }}</dd>
            <dt>Max Usage</dt>
            <dd>{{ $log->MaxUsage }}</dd>
            <dt>Info Unit I D</dt>
            <dd>{{ $log->InfoUnitID }}</dd>
            <dt>Sys Log Tag</dt>
            <dd>{{ $log->SysLogTag }}</dd>
            <dt>Event Log Type</dt>
            <dd>{{ $log->EventLogType }}</dd>
            <dt>Generic File Name</dt>
            <dd>{{ $log->GenericFileName }}</dd>
            <dt>System I D</dt>
            <dd>{{ $log->SystemID }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('log.log.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection