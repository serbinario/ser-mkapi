<div class="card-body">
    
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($pool->nome) ? $pool->nome : null) }}" minlength="1" maxlength="200" required="true" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ip_inicial') ? 'has-error' : '' }}">
    <label for="ip_inicial" class="col-md-2 control-label">Ip Inicial</label>
    <div class="col-md-10">
        <input class="form-control" name="ip_inicial" type="text" id="ip_inicial" value="{{ old('ip_inicial', isset($pool->ip_inicial) ? $pool->ip_inicial : null) }}" minlength="1" maxlength="20" required="true" placeholder="Enter ip inicial here...">
        {!! $errors->first('ip_inicial', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ip_final') ? 'has-error' : '' }}">
    <label for="ip_final" class="col-md-2 control-label">Ip Final</label>
    <div class="col-md-10">
        <input class="form-control" name="ip_final" type="text" id="ip_final" value="{{ old('ip_final', isset($pool->ip_final) ? $pool->ip_final : null) }}" minlength="1" maxlength="20" required="true" placeholder="Enter ip final here...">
        {!! $errors->first('ip_final', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

