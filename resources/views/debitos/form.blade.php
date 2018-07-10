<div class="card-body">
    
<div class="form-group {{ $errors->has('mk_cliente_id') ? 'has-error' : '' }}">
    <label for="mk_cliente_id" class="col-md-2 control-label">Mk Cliente</label>
    <div class="col-md-10">
        <select class="form-control" id="mk_cliente_id" name="mk_cliente_id">
        	    <option value="" style="display: none;" {{ old('mk_cliente_id', isset($debitos->mk_cliente_id) ? $debitos->mk_cliente_id : '') == '' ? 'selected' : '' }} disabled selected>Select mk cliente</option>
        	@foreach ($mkClientes as $key => $mkCliente)
			    <option value="{{ $key }}" {{ old('mk_cliente_id', isset($debitos->mk_cliente_id) ? $debitos->mk_cliente_id : null) == $key ? 'selected' : '' }}>
			    	{{ $mkCliente }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('mk_cliente_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('numero_cobranca') ? 'has-error' : '' }}">
    <label for="numero_cobranca" class="col-md-2 control-label">Numero Cobranca</label>
    <div class="col-md-10">
        <input class="form-control" name="numero_cobranca" type="text" id="numero_cobranca" value="{{ old('numero_cobranca', isset($debitos->numero_cobranca) ? $debitos->numero_cobranca : null) }}" maxlength="50" placeholder="Enter numero cobranca here...">
        {!! $errors->first('numero_cobranca', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('conta_bancaria_id') ? 'has-error' : '' }}">
    <label for="conta_bancaria_id" class="col-md-2 control-label">Conta Bancaria</label>
    <div class="col-md-10">
        <select class="form-control" id="conta_bancaria_id" name="conta_bancaria_id">
        	    <option value="" style="display: none;" {{ old('conta_bancaria_id', isset($debitos->conta_bancaria_id) ? $debitos->conta_bancaria_id : '') == '' ? 'selected' : '' }} disabled selected>Select conta bancaria</option>
        	@foreach ($finContasBancarias as $key => $finContasBancarium)
			    <option value="{{ $key }}" {{ old('conta_bancaria_id', isset($debitos->conta_bancaria_id) ? $debitos->conta_bancaria_id : null) == $key ? 'selected' : '' }}>
			    	{{ $finContasBancarium }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('conta_bancaria_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('valor_debito') ? 'has-error' : '' }}">
    <label for="valor_debito" class="col-md-2 control-label">Valor Debito</label>
    <div class="col-md-10">
        <input class="form-control" name="valor_debito" type="number" id="valor_debito" value="{{ old('valor_debito', isset($debitos->valor_debito) ? $debitos->valor_debito : null) }}" min="-99999999" max="99999999" placeholder="Enter valor debito here..." step="any">
        {!! $errors->first('valor_debito', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('valor_pago') ? 'has-error' : '' }}">
    <label for="valor_pago" class="col-md-2 control-label">Valor Pago</label>
    <div class="col-md-10">
        <input class="form-control" name="valor_pago" type="number" id="valor_pago" value="{{ old('valor_pago', isset($debitos->valor_pago) ? $debitos->valor_pago : null) }}" min="-99999999" max="99999999" placeholder="Enter valor pago here..." step="any">
        {!! $errors->first('valor_pago', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('valor_desconto') ? 'has-error' : '' }}">
    <label for="valor_desconto" class="col-md-2 control-label">Valor Desconto</label>
    <div class="col-md-10">
        <input class="form-control" name="valor_desconto" type="number" id="valor_desconto" value="{{ old('valor_desconto', isset($debitos->valor_desconto) ? $debitos->valor_desconto : null) }}" min="-99999999" max="99999999" placeholder="Enter valor desconto here..." step="any">
        {!! $errors->first('valor_desconto', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_vencimento') ? 'has-error' : '' }}">
    <label for="data_vencimento" class="col-md-2 control-label">Data Vencimento</label>
    <div class="col-md-10">
        <input class="form-control" name="data_vencimento" type="text" id="data_vencimento" value="{{ old('data_vencimento', isset($debitos->data_vencimento) ? $debitos->data_vencimento : null) }}" placeholder="Enter data vencimento here...">
        {!! $errors->first('data_vencimento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('data_pagamento') ? 'has-error' : '' }}">
    <label for="data_pagamento" class="col-md-2 control-label">Data Pagamento</label>
    <div class="col-md-10">
        <input class="form-control" name="data_pagamento" type="text" id="data_pagamento" value="{{ old('data_pagamento', isset($debitos->data_pagamento) ? $debitos->data_pagamento : null) }}" placeholder="Enter data pagamento here...">
        {!! $errors->first('data_pagamento', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pago') ? 'has-error' : '' }}">
    <label for="pago" class="col-md-2 control-label">Pago</label>
    <div class="col-md-10">
        <input class="form-control" name="pago" type="text" id="pago" value="{{ old('pago', isset($debitos->pago) ? $debitos->pago : null) }}" placeholder="Enter pago here...">
        {!! $errors->first('pago', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('forma_pagamento_id') ? 'has-error' : '' }}">
    <label for="forma_pagamento_id" class="col-md-2 control-label">Forma Pagamento</label>
    <div class="col-md-10">
        <select class="form-control" id="forma_pagamento_id" name="forma_pagamento_id">
        	    <option value="" style="display: none;" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : '') == '' ? 'selected' : '' }} disabled selected>Select forma pagamento</option>
        	@foreach ($finFormasPagamentos as $key => $finFormasPagamento)
			    <option value="{{ $key }}" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : null) == $key ? 'selected' : '' }}>
			    	{{ $finFormasPagamento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('forma_pagamento_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('carne_id') ? 'has-error' : '' }}">
    <label for="carne_id" class="col-md-2 control-label">Carne</label>
    <div class="col-md-10">
        <select class="form-control" id="carne_id" name="carne_id">
        	    <option value="" style="display: none;" {{ old('carne_id', isset($debitos->carne_id) ? $debitos->carne_id : '') == '' ? 'selected' : '' }} disabled selected>Select carne</option>
        	@foreach ($finCarnes as $key => $finCarne)
			    <option value="{{ $key }}" {{ old('carne_id', isset($debitos->carne_id) ? $debitos->carne_id : null) == $key ? 'selected' : '' }}>
			    	{{ $finCarne }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('carne_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('local_pagamento_id') ? 'has-error' : '' }}">
    <label for="local_pagamento_id" class="col-md-2 control-label">Local Pagamento</label>
    <div class="col-md-10">
        <select class="form-control" id="local_pagamento_id" name="local_pagamento_id">
        	    <option value="" style="display: none;" {{ old('local_pagamento_id', isset($debitos->local_pagamento_id) ? $debitos->local_pagamento_id : '') == '' ? 'selected' : '' }} disabled selected>Select local pagamento</option>
        	@foreach ($finLocaisPagamentos as $key => $finLocaisPagamento)
			    <option value="{{ $key }}" {{ old('local_pagamento_id', isset($debitos->local_pagamento_id) ? $debitos->local_pagamento_id : null) == $key ? 'selected' : '' }}>
			    	{{ $finLocaisPagamento }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('local_pagamento_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    <label for="status" class="col-md-2 control-label">Status</label>
    <div class="col-md-10">
        <input class="form-control" name="status" type="text" id="status" value="{{ old('status', isset($debitos->status) ? $debitos->status : null) }}" maxlength="50" placeholder="Enter status here...">
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

