<div class="card-body">
    
<div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
    <label for="nome" class="col-md-2 control-label">Nome</label>
    <div class="col-md-10">
        <input class="form-control" name="nome" type="text" id="nome" value="{{ old('nome', isset($profile->nome) ? $profile->nome : null) }}" minlength="1" maxlength="200" required="true" placeholder="Enter nome here...">
        {!! $errors->first('nome', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('local_address') ? 'has-error' : '' }}">
    <label for="local_address" class="col-md-2 control-label">Local Address</label>
    <div class="col-md-10">
        <input class="form-control" name="local_address" type="text" id="local_address" value="{{ old('local_address', isset($profile->local_address) ? $profile->local_address : null) }}" maxlength="20" placeholder="Enter local address here...">
        {!! $errors->first('local_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('pool_id') ? 'has-error' : '' }}">
    <label for="pool_id" class="col-md-2 control-label">Remote Address</label>
    <div class="col-md-10">
        <select class="form-control" id="pool_id" name="pool_id">
        	    <option value="" style="display: none;" {{ old('pool_id', isset($profile->pool_id) ? $profile->pool_id : '') == '' ? 'selected' : '' }} disabled selected>Select pool</option>
        	@foreach ($pools as $key => $pool)
			    <option value="{{ $key }}" {{ old('pool_id', isset($profile->pool_id) ? $profile->pool_id : null) == $key ? 'selected' : '' }}>
			    	{{ $pool }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('pool_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('dns1_server') ? 'has-error' : '' }}">
    <label for="dns1_server" class="col-md-2 control-label">DNS Server</label>
    <div class="col-md-10">
        <input class="form-control ip" name="dns1_server" type="text" id="dns1_server" value="{{ old('dns1_server', isset($profile->dns1_server) ? $profile->dns1_server : null) }}" maxlength="20" placeholder="Enter dns1 server here...">
        {!! $errors->first('dns1_server', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('dns2_server') ? 'has-error' : '' }}">
    <label for="dns2_server" class="col-md-2 control-label">DNS Server</label>
    <div class="col-md-10">
        <input class="form-control ip" name="dns2_server" type="text" id="dns2_server" value="{{ old('dns2_server', isset($profile->dns2_server) ? $profile->dns2_server : null) }}" maxlength="20" placeholder="Enter dns2 server here...">
        {!! $errors->first('dns2_server', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('rate_limit_tx_tx') ? 'has-error' : '' }}">
    <label for="rate_limit_tx_tx" class="col-md-2 control-label">Rate Limit (rx tx)</label>
    <div class="col-md-10">
        <input class="form-control" name="rate_limit_tx_tx" type="text" id="rate_limit_tx_tx" value="{{ old('rate_limit_tx_tx', isset($profile->rate_limit_tx_tx) ? $profile->rate_limit_tx_tx : null) }}" maxlength="50" placeholder="Enter local RX TX here...">
        {!! $errors->first('rate_limit_tx_tx', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('queue_parent') ? 'has-error' : '' }}">
    <label for="queue_parent" class="col-md-2 control-label">Queue Parent</label>
    <div class="col-md-10">
        <input class="form-control" name="queue_parent" type="text" id="queue_parent" value="{{ old('queue_parent', isset($profile->queue_parent) ? $profile->queue_parent : null) }}" maxlength="20" placeholder="Enter queue parent here...">
        {!! $errors->first('queue_parent', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('queue_type') ? 'has-error' : '' }}">
    <label for="queue_type" class="col-md-2 control-label">Queue Type</label>
    <div class="col-md-10">
        <select class="form-control" id="queue_type" name="queue_type">
        	    <option value="" style="display: none;" {{ old('queue_type', isset($profile->queue_type) ? $profile->queue_type : '') == '' ? 'selected' : '' }} disabled selected>Enter queue type here...</option>
        	@foreach (['default' => 'Default',
'default-small' => 'Default-small',
'ethernet-default' => 'Ethernet-default',
'hotspot-default' => 'Hotspot-default'] as $key => $text)
			    <option value="{{ $key }}" {{ old('queue_type', isset($profile->queue_type) ? $profile->queue_type : null) == $key ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('queue_type', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('script_on_up') ? 'has-error' : '' }}">
    <label for="script_on_up" class="col-md-2 control-label">Script On Up</label>
    <div class="col-md-10">
        <textarea class="form-control" name="script_on_up" cols="50" rows="10" id="script_on_up" placeholder="Enter script on up here...">{{ old('script_on_up', isset($profile->script_on_up) ? $profile->script_on_up : null) }}</textarea>
        {!! $errors->first('script_on_up', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('script_on_down') ? 'has-error' : '' }}">
    <label for="script_on_down" class="col-md-2 control-label">Script On Down</label>
    <div class="col-md-10">
        <textarea class="form-control" name="script_on_down" cols="50" rows="10" id="script_on_down" placeholder="Enter script on down here...">{{ old('script_on_down', isset($profile->script_on_down) ? $profile->script_on_down : null) }}</textarea>
        {!! $errors->first('script_on_down', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('is_ativo') ? 'has-error' : '' }}">
    <label for="is_ativo" class="col-md-2 control-label">Ativo</label>
    <div class="col-md-10">
        <div class="checkbox checkbox-styled">
            <label for="is_ativo_1">
            	<input id="is_ativo_1" class="" name="is_ativo" type="checkbox" value="1" {{ old('is_ativo', isset($profile->is_ativo) ? $profile->is_ativo : null) == '1' ? 'checked' : '' }}>
                Yes
            </label>
        </div>

        {!! $errors->first('is_ativo', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

