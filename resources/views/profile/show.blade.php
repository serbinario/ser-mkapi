@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_profile_form" name="edit_profile_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('profile.profile.index') }}" class="btn btn-primary" title="Show All Profile">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Nome</dt>
            <dd>{{ $profile->nome }}</dd>
            <dt>Local Address</dt>
            <dd>{{ $profile->local_address }}</dd>
            <dt>Pool</dt>
            <dd>{{  isset($profile->pool->nome) ? $profile->pool->nome : ''  }}</dd>
            <dt>Dns1 Server</dt>
            <dd>{{ $profile->dns1_server }}</dd>
            <dt>Dns2 Server</dt>
            <dd>{{ $profile->dns2_server }}</dd>
            <dt>Rate Limit Tx Tx</dt>
            <dd>{{ $profile->rate_limit_tx_tx }}</dd>
            <dt>Queue Parent</dt>
            <dd>{{ $profile->queue_parent }}</dd>
            <dt>Queue Type</dt>
            <dd>{{ $profile->queue_type }}</dd>
            <dt>Script On Up</dt>
            <dd>{{ $profile->script_on_up }}</dd>
            <dt>Script On Down</dt>
            <dd>{{ $profile->script_on_down }}</dd>
            <dt>Is Ativo</dt>
            <dd>{{ ($profile->is_ativo) ? 'Yes' : 'No' }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('profile.profile.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection