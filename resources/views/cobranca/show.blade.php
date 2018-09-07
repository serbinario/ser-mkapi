@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_cobranca_form" name="edit_cobranca_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('cobranca.cobranca.index') }}" class="btn btn-primary" title="Show All Cobranca">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Numero Cobranca</dt>
            <dd>{{ $cobranca->numero_cobranca }}</dd>
            <dt>Valor</dt>
            <dd>{{ $cobranca->valor }}</dd>
            <dt>Status</dt>
            <dd>{{ $cobranca->status }}</dd>
            <dt>Identificador</dt>
            <dd>{{ $cobranca->identificador }}</dd>
            <dt>Nome</dt>
            <dd>{{ $cobranca->nome }}</dd>
            <dt>Data Vencimento</dt>
            <dd>{{ $cobranca->data_vencimento }}</dd>
            <dt>Valor Pago</dt>
            <dd>{{ $cobranca->valor_pago }}</dd>
            <dt>Data Pagamento</dt>
            <dd>{{ $cobranca->data_pagamento }}</dd>
            <dt>Login</dt>
            <dd>{{ $cobranca->login }}</dd>
            <dt>Link Pagamento</dt>
            <dd>{{ $cobranca->link_pagamento }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('cobranca.cobranca.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection