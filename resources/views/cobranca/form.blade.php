<div class="card-body">
    
<div class="form-group {{ $errors->has('numero_cobranca') ? 'has-error' : '' }}">
    <label for="numero_cobranca" class="col-md-2 control-label">Numero Cobranca</label>
    <div class="col-md-10">
        <input class="form-control" name="numero_cobranca" type="text" id="numero_cobranca" value="{{ old('numero_cobranca', isset($cobranca->numero_cobranca) ? $cobranca->numero_cobranca : null) }}" maxlength="20" placeholder="Enter numero cobranca here...">
        {!! $errors->first('numero_cobranca', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('valor') ? 'has-error' : '' }}">
    <label for="valor" class="col-md-2 control-label">Valor</label>
    <div class="col-md-10">
        <input class="form-control" name="valor" type="number" id="valor" value="{{ old('valor', isset($cobranca->valor) ? $cobranca->valor : null) }}" min="-99999999" max="99999999" placeholder="Enter valor here..." step="any">
        {!! $errors->first('valor', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', isset($cobranca->status) ? $cobranca->status : null) }}" maxlength="20" placeholder="Enter status here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('identificador') ? 'has-error' : '' }}">
    <label for="identificador" class="col-md-2 control-label">Identificador</label>
    <div class="col-md-10">
        <input class="form-control" name="identificador" type="text" id="identificador" value="{{ old('identificador', isset($cobranca->identificador) ? $cobranca->identificador : null) }}" maxlength="50" placeholder="Enter identificador here...">
        {!! $errors->first('identificador', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($cobranca->nome) ? $cobranca->nome : null) }}" maxlength="200" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_vencimento') ? 'has-error' : '' }}">
    <label for="data_vencimento" class="col-md-2 control-label">Data Vencimento</label>
    <div class="col-md-10">
        <input class="form-control" name="data_vencimento" type="text" id="data_vencimento" value="{{ old('data_vencimento', isset($cobranca->data_vencimento) ? $cobranca->data_vencimento : null) }}" placeholder="Enter data vencimento here...">
        {!! $errors->first('data_vencimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('valor_pago') ? 'has-error' : '' }}">
    <label for="valor_pago" class="col-md-2 control-label">Valor Pago</label>
    <div class="col-md-10">
        <input class="form-control" name="valor_pago" type="text" id="valor_pago" value="{{ old('valor_pago', isset($cobranca->valor_pago) ? $cobranca->valor_pago : null) }}" maxlength="10" placeholder="Enter valor pago here...">
        {!! $errors->first('valor_pago', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_pagamento') ? 'has-error' : '' }}">
    <label for="data_pagamento" class="col-md-2 control-label">Data Pagamento</label>
    <div class="col-md-10">
        <input class="form-control" name="data_pagamento" type="text" id="data_pagamento" value="{{ old('data_pagamento', isset($cobranca->data_pagamento) ? $cobranca->data_pagamento : null) }}" placeholder="Enter data pagamento here...">
        {!! $errors->first('data_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
    <label for="login" class="col-md-2 control-label">Login</label>
    <div class="col-md-10">
        <input class="form-control" name="login" type="text" id="login" value="{{ old('login', isset($cobranca->login) ? $cobranca->login : null) }}" maxlength="20" placeholder="Enter login here...">
        {!! $errors->first('login', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('link_pagamento') ? 'has-error' : '' }}">
    <label for="link_pagamento" class="col-md-2 control-label">Link Pagamento</label>
    <div class="col-md-10">
        <input class="form-control" name="link_pagamento" type="text" id="link_pagamento" value="{{ old('link_pagamento', isset($cobranca->link_pagamento) ? $cobranca->link_pagamento : null) }}" maxlength="255" placeholder="Enter link pagamento here...">
        {!! $errors->first('link_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

