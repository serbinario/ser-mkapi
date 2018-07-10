<div class="card-body">
    
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($grupo->nome) ? $grupo->nome : null) }}" minlength="1" maxlength="255" required="true" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

