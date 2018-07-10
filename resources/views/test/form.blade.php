<div class="card-body">
    
<div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
    <label for="name" class="col-md-2 control-label">Name</label>
    <div class="col-md-10">
        <input class="form-control" name="name" type="text" id="name" value="{{ old('name', isset($test->name) ? $test->name : null) }}" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sports') ? 'has-error' : '' }}">
    <label for="sports" class="col-md-2 control-label">Sports</label>
    <div class="col-md-10">
        <select class="form-control" id="sports[]" name="sports[]" multiple="multiple">
        	    <option value="" style="display: none;" {{ old('sports', isset($test->sports) ? $test->sports : '') == '' ? 'selected' : '' }} disabled selected>Select sports</option>
        	@foreach (['blue' => 'Blue',
'red' => 'Red',
'green' => 'Green',
'yellow' => 'Yellow',
'black' => 'Black',
'white' => 'White'] as $key => $text)
			    <option value="{{ $key }}" {{ in_array($key, old('sports', isset($test->sports) ? $test->sports : []) ?: []) ? 'selected' : '' }}>
			    	{{ $text }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('sports', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

