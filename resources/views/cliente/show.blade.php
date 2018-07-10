@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_cliente_form" name="edit_cliente_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('cliente.cliente.index') }}" class="btn btn-primary" title="Show All Cliente">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Nome</dt>
            <dd>{{ $cliente->nome }}</dd>
            <dt>Login</dt>
            <dd>{{ $cliente->login }}</dd>
            <dt>Senha</dt>
            <dd>{{ $cliente->senha }}</dd>
            <dt>Email</dt>
            <dd>{{ $cliente->email }}</dd>
            <dt>Tipo</dt>
            <dd>{{ $cliente->tipo }}</dd>
            <dt>Data Nascimento</dt>
            <dd>{{ $cliente->data_nascimento }}</dd>
            <dt>Cep</dt>
            <dd>{{ $cliente->cep }}</dd>
            <dt>Logradouro</dt>
            <dd>{{ $cliente->logradouro }}</dd>
            <dt>Complemanto</dt>
            <dd>{{ $cliente->complemanto }}</dd>
            <dt>Bairro</dt>
            <dd>{{ $cliente->bairro }}</dd>
            <dt>Cidade</dt>
            <dd>{{ $cliente->cidade }}</dd>
            <dt>Data Instalacao</dt>
            <dd>{{ $cliente->data_instalacao }}</dd>
            <dt>Router</dt>
            <dd>{{  isset($cliente->mkRouter->nome) ? $cliente->mkRouter->nome : ''  }}</dd>
            <dt>Profile</dt>
            <dd>{{  isset($cliente->mkProfile->nome) ? $cliente->mkProfile->nome : ''  }}</dd>
            <dt>Tipo Autenticacao</dt>
            <dd>{{ $cliente->tipo_autenticacao }}</dd>
            <dt>Ip Pppoe</dt>
            <dd>{{ $cliente->ip_pppoe }}</dd>
            <dt>Ip Hotspot</dt>
            <dd>{{ $cliente->ip_hotspot }}</dd>
            <dt>Mac</dt>
            <dd>{{ $cliente->mac }}</dd>
            <dt>Vencimento Dia</dt>
            <dd>{{  isset($cliente->mkVencimentoDium->id) ? $cliente->mkVencimentoDium->id : ''  }}</dd>
            <dt>Dias Bloqueio</dt>
            <dd>{{ $cliente->dias_bloqueio }}</dd>
            <dt>Dias Msg Pendencia</dt>
            <dd>{{ $cliente->dias_msg_pendencia }}</dd>
            <dt>Inseto Mensalidade</dt>
            <dd>{{ ($cliente->inseto_mensalidade) ? 'Yes' : 'No' }}</dd>
            <dt>Mensalidade Automatica</dt>
            <dd>{{ ($cliente->mensalidade_automatica) ? 'Yes' : 'No' }}</dd>
            <dt>Msg Bloqueio Automatica</dt>
            <dd>{{ ($cliente->msg_bloqueio_automatica) ? 'Yes' : 'No' }}</dd>
            <dt>Msg Pendencia Automatica</dt>
            <dd>{{ ($cliente->msg_pendencia_automatica) ? 'Yes' : 'No' }}</dd>
            <dt>Perm Alter Senha</dt>
            <dd>{{ ($cliente->perm_alter_senha) ? 'Yes' : 'No' }}</dd>
            <dt>Desconto Mensalidade</dt>
            <dd>{{ $cliente->desconto_mensalidade }}</dd>
            <dt>Desconto Mensali Ate Venci</dt>
            <dd>{{ $cliente->desconto_mensali_ate_venci }}</dd>
            <dt>Is Ativo</dt>
            <dd>{{ ($cliente->is_ativo) ? 'Yes' : 'No' }}</dd>
            <dt>Obs</dt>
            <dd>{{ $cliente->obs }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('cliente.cliente.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection