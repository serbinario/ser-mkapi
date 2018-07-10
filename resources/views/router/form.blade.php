<div class="card-body">
    
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($router->nome) ? $router->nome : null) }}" minlength="1" maxlength="200" required="true" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ip_address') ? 'has-error' : '' }}">
    <label for="ip_address" class="col-md-2 control-label">Ip Address</label>
    <div class="col-md-10">
        <input class="form-control ip" name="ip_address" type="text" id="ip_address" value="{{ old('ip_address', isset($router->ip_address) ? $router->ip_address : null) }}" minlength="1" maxlength="20" required="true" placeholder="Enter ip address here...">
        {!! $errors->first('ip_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('port') ? 'has-error' : '' }}">
    <label for="port" class="col-md-2 control-label">Port</label>
    <div class="col-md-10">
        <input class="form-control" name="port" type="text" id="port" value="{{ old('port', isset($router->port) ? $router->port : null) }}" maxlength="10" placeholder="Enter port here...">
        {!! $errors->first('port', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
    <label for="username" class="col-md-2 control-label">Username</label>
    <div class="col-md-10">
        <input class="form-control" name="username" type="text" id="username" value="{{ old('username', isset($router->username) ? $router->username : null) }}" minlength="1" maxlength="20" required="true" placeholder="Enter username here...">
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
    <label for="password" class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
        <input class="form-control" name="password" type="text" id="password" value="{{ old('password', isset($router->password) ? $router->password : null) }}" minlength="1" maxlength="20" required="true" placeholder="Enter password here...">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('descricao') ? 'has-error' : '' }}">
    <label for="descricao" class="col-md-2 control-label">Descricao</label>
    <div class="col-md-10">
        <textarea class="form-control" name="descricao" cols="50" rows="10" id="descricao" placeholder="Enter descricao here...">{{ old('descricao', isset($router->descricao) ? $router->descricao : null) }}</textarea>
        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_ativo') ? 'has-error' : '' }}">
    <label for="is_ativo" class="col-md-2 control-label">Is Ativo</label>
    <div class="col-md-10">
        <div class="checkbox checkbox-styled">
            <label for="is_ativo_1">
            	<input id="is_ativo_1" class="" name="is_ativo" type="checkbox" value="1" {{ old('is_ativo', isset($router->is_ativo) ? $router->is_ativo : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_ativo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

