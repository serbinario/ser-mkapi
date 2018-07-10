@extends('layouts.menu')

@section('content')

<!-- BEGIN HORIZONTAL FORM -->
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="" accept-charset="UTF-8" id="edit_router_form" name="edit_router_form" class="form-horizontal">
                <input name="_method" type="hidden" value="PUT">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Editar account</header>
                        <div class="tools">
                            <div class="btn-group">
                                <a href="{{ route('router.router.index') }}" class="btn btn-primary" title="Show All Router">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Nome</dt>
            <dd>{{ $router->nome }}</dd>
            <dt>Ip Address</dt>
            <dd>{{ $router->ip_address }}</dd>
            <dt>Port</dt>
            <dd>{{ $router->port }}</dd>
            <dt>Username</dt>
            <dd>{{ $router->username }}</dd>
            <dt>Password</dt>
            <dd>{{ $router->password }}</dd>
            <dt>Descricao</dt>
            <dd>{{ $router->descricao }}</dd>
            <dt>Is Ativo</dt>
            <dd>{{ ($router->is_ativo) ? 'Yes' : 'No' }}</dd>

                            </dl>

                        </div>


                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <a href="{{ route('router.router.index') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Voltar</a>
                        </div>
                    </div>
                </div><!--end .card -->

            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->

@endsection