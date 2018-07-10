@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_debitos_form" name="edit_debitos_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('debitos.debitos.index') }}" class="btn btn-primary" title="Show All Debitos">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Mk Cliente</dt>
            <dd>{{  isset($debitos->mkCliente->nome) ? $debitos->mkCliente->nome : ''  }}</dd>
            <dt>Numero Cobranca</dt>
            <dd>{{ $debitos->numero_cobranca }}</dd>
            <dt>Conta Bancaria</dt>
            <dd>{{  isset($debitos->finContasBancaria->id) ? $debitos->finContasBancaria->id : ''  }}</dd>
            <dt>Valor Debito</dt>
            <dd>{{ $debitos->valor_debito }}</dd>
            <dt>Valor Pago</dt>
            <dd>{{ $debitos->valor_pago }}</dd>
            <dt>Valor Desconto</dt>
            <dd>{{ $debitos->valor_desconto }}</dd>
            <dt>Data Vencimento</dt>
            <dd>{{ $debitos->data_vencimento }}</dd>
            <dt>Data Pagamento</dt>
            <dd>{{ $debitos->data_pagamento }}</dd>
            <dt>Pago</dt>
            <dd>{{ $debitos->pago }}</dd>
            <dt>Created At</dt>
            <dd>{{ $debitos->created_at }}</dd>
            <dt>Updated At</dt>
            <dd>{{ $debitos->updated_at }}</dd>
            <dt>Forma Pagamento</dt>
            <dd>{{  isset($debitos->finFormasPagamento->id) ? $debitos->finFormasPagamento->id : ''  }}</dd>
            <dt>Carne</dt>
            <dd>{{  isset($debitos->finCarne->id) ? $debitos->finCarne->id : ''  }}</dd>
            <dt>Local Pagamento</dt>
            <dd>{{  isset($debitos->finLocaisPagamento->id) ? $debitos->finLocaisPagamento->id : ''  }}</dd>
            <dt>Status</dt>
            <dd>{{ $debitos->status }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('debitos.debitos.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection