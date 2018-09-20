<div class="card-body">
    
<div class="form-group {{ $errors->has('CustomerID') ? 'has-error' : '' }}">
    <label for="CustomerID" class="col-md-2 control-label">Customer I D</label>
    <div class="col-md-10">
        <input class="form-control" name="CustomerID" type="text" id="CustomerID" value="{{ old('CustomerID', isset($log->CustomerID) ? $log->CustomerID : null) }}" placeholder="Enter customer i d here...">
        {!! $errors->first('CustomerID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('ReceivedAt') ? 'has-error' : '' }}">
    <label for="ReceivedAt" class="col-md-2 control-label">Received At</label>
    <div class="col-md-10">
        <input class="form-control" name="ReceivedAt" type="text" id="ReceivedAt" value="{{ old('ReceivedAt', isset($log->ReceivedAt) ? $log->ReceivedAt : null) }}" placeholder="Enter received at here...">
        {!! $errors->first('ReceivedAt', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('DeviceReportedTime') ? 'has-error' : '' }}">
    <label for="DeviceReportedTime" class="col-md-2 control-label">Device Reported Time</label>
    <div class="col-md-10">
        <input class="form-control" name="DeviceReportedTime" type="text" id="DeviceReportedTime" value="{{ old('DeviceReportedTime', isset($log->DeviceReportedTime) ? $log->DeviceReportedTime : null) }}" placeholder="Enter device reported time here...">
        {!! $errors->first('DeviceReportedTime', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Facility') ? 'has-error' : '' }}">
    <label for="Facility" class="col-md-2 control-label">Facility</label>
    <div class="col-md-10">
        <input class="form-control" name="Facility" type="text" id="Facility" value="{{ old('Facility', isset($log->Facility) ? $log->Facility : null) }}" min="-32768" max="32767" placeholder="Enter facility here...">
        {!! $errors->first('Facility', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Priority') ? 'has-error' : '' }}">
    <label for="Priority" class="col-md-2 control-label">Priority</label>
    <div class="col-md-10">
        <input class="form-control" name="Priority" type="text" id="Priority" value="{{ old('Priority', isset($log->Priority) ? $log->Priority : null) }}" min="-32768" max="32767" placeholder="Enter priority here...">
        {!! $errors->first('Priority', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('FromHost') ? 'has-error' : '' }}">
    <label for="FromHost" class="col-md-2 control-label">From Host</label>
    <div class="col-md-10">
        <input class="form-control" name="FromHost" type="text" id="FromHost" value="{{ old('FromHost', isset($log->FromHost) ? $log->FromHost : null) }}" maxlength="60" placeholder="Enter from host here...">
        {!! $errors->first('FromHost', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Message') ? 'has-error' : '' }}">
    <label for="Message" class="col-md-2 control-label">Message</label>
    <div class="col-md-10">
        <textarea class="form-control" name="Message" cols="50" rows="10" id="Message" placeholder="Enter message here...">{{ old('Message', isset($log->Message) ? $log->Message : null) }}</textarea>
        {!! $errors->first('Message', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('NTSeverity') ? 'has-error' : '' }}">
    <label for="NTSeverity" class="col-md-2 control-label">N T Severity</label>
    <div class="col-md-10">
        <input class="form-control" name="NTSeverity" type="number" id="NTSeverity" value="{{ old('NTSeverity', isset($log->NTSeverity) ? $log->NTSeverity : null) }}" min="-2147483648" max="2147483647" placeholder="Enter n t severity here...">
        {!! $errors->first('NTSeverity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Importance') ? 'has-error' : '' }}">
    <label for="Importance" class="col-md-2 control-label">Importance</label>
    <div class="col-md-10">
        <input class="form-control" name="Importance" type="number" id="Importance" value="{{ old('Importance', isset($log->Importance) ? $log->Importance : null) }}" min="-2147483648" max="2147483647" placeholder="Enter importance here...">
        {!! $errors->first('Importance', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventSource') ? 'has-error' : '' }}">
    <label for="EventSource" class="col-md-2 control-label">Event Source</label>
    <div class="col-md-10">
        <input class="form-control" name="EventSource" type="text" id="EventSource" value="{{ old('EventSource', isset($log->EventSource) ? $log->EventSource : null) }}" maxlength="60" placeholder="Enter event source here...">
        {!! $errors->first('EventSource', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventUser') ? 'has-error' : '' }}">
    <label for="EventUser" class="col-md-2 control-label">Event User</label>
    <div class="col-md-10">
        <input class="form-control" name="EventUser" type="text" id="EventUser" value="{{ old('EventUser', isset($log->EventUser) ? $log->EventUser : null) }}" maxlength="60" placeholder="Enter event user here...">
        {!! $errors->first('EventUser', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventCategory') ? 'has-error' : '' }}">
    <label for="EventCategory" class="col-md-2 control-label">Event Category</label>
    <div class="col-md-10">
        <input class="form-control" name="EventCategory" type="number" id="EventCategory" value="{{ old('EventCategory', isset($log->EventCategory) ? $log->EventCategory : null) }}" min="-2147483648" max="2147483647" placeholder="Enter event category here...">
        {!! $errors->first('EventCategory', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventID') ? 'has-error' : '' }}">
    <label for="EventID" class="col-md-2 control-label">Event I D</label>
    <div class="col-md-10">
        <input class="form-control" name="EventID" type="number" id="EventID" value="{{ old('EventID', isset($log->EventID) ? $log->EventID : null) }}" min="-2147483648" max="2147483647" placeholder="Enter event i d here...">
        {!! $errors->first('EventID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventBinaryData') ? 'has-error' : '' }}">
    <label for="EventBinaryData" class="col-md-2 control-label">Event Binary Data</label>
    <div class="col-md-10">
        <textarea class="form-control" name="EventBinaryData" cols="50" rows="10" id="EventBinaryData" placeholder="Enter event binary data here...">{{ old('EventBinaryData', isset($log->EventBinaryData) ? $log->EventBinaryData : null) }}</textarea>
        {!! $errors->first('EventBinaryData', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('MaxAvailable') ? 'has-error' : '' }}">
    <label for="MaxAvailable" class="col-md-2 control-label">Max Available</label>
    <div class="col-md-10">
        <input class="form-control" name="MaxAvailable" type="number" id="MaxAvailable" value="{{ old('MaxAvailable', isset($log->MaxAvailable) ? $log->MaxAvailable : null) }}" min="-2147483648" max="2147483647" placeholder="Enter max available here...">
        {!! $errors->first('MaxAvailable', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('CurrUsage') ? 'has-error' : '' }}">
    <label for="CurrUsage" class="col-md-2 control-label">Curr Usage</label>
    <div class="col-md-10">
        <input class="form-control" name="CurrUsage" type="number" id="CurrUsage" value="{{ old('CurrUsage', isset($log->CurrUsage) ? $log->CurrUsage : null) }}" min="-2147483648" max="2147483647" placeholder="Enter curr usage here...">
        {!! $errors->first('CurrUsage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('MinUsage') ? 'has-error' : '' }}">
    <label for="MinUsage" class="col-md-2 control-label">Min Usage</label>
    <div class="col-md-10">
        <input class="form-control" name="MinUsage" type="number" id="MinUsage" value="{{ old('MinUsage', isset($log->MinUsage) ? $log->MinUsage : null) }}" min="-2147483648" max="2147483647" placeholder="Enter min usage here...">
        {!! $errors->first('MinUsage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('MaxUsage') ? 'has-error' : '' }}">
    <label for="MaxUsage" class="col-md-2 control-label">Max Usage</label>
    <div class="col-md-10">
        <input class="form-control" name="MaxUsage" type="number" id="MaxUsage" value="{{ old('MaxUsage', isset($log->MaxUsage) ? $log->MaxUsage : null) }}" min="-2147483648" max="2147483647" placeholder="Enter max usage here...">
        {!! $errors->first('MaxUsage', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('InfoUnitID') ? 'has-error' : '' }}">
    <label for="InfoUnitID" class="col-md-2 control-label">Info Unit I D</label>
    <div class="col-md-10">
        <input class="form-control" name="InfoUnitID" type="number" id="InfoUnitID" value="{{ old('InfoUnitID', isset($log->InfoUnitID) ? $log->InfoUnitID : null) }}" min="-2147483648" max="2147483647" placeholder="Enter info unit i d here...">
        {!! $errors->first('InfoUnitID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('SysLogTag') ? 'has-error' : '' }}">
    <label for="SysLogTag" class="col-md-2 control-label">Sys Log Tag</label>
    <div class="col-md-10">
        <input class="form-control" name="SysLogTag" type="text" id="SysLogTag" value="{{ old('SysLogTag', isset($log->SysLogTag) ? $log->SysLogTag : null) }}" maxlength="60" placeholder="Enter sys log tag here...">
        {!! $errors->first('SysLogTag', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('EventLogType') ? 'has-error' : '' }}">
    <label for="EventLogType" class="col-md-2 control-label">Event Log Type</label>
    <div class="col-md-10">
        <input class="form-control" name="EventLogType" type="text" id="EventLogType" value="{{ old('EventLogType', isset($log->EventLogType) ? $log->EventLogType : null) }}" maxlength="60" placeholder="Enter event log type here...">
        {!! $errors->first('EventLogType', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('GenericFileName') ? 'has-error' : '' }}">
    <label for="GenericFileName" class="col-md-2 control-label">Generic File Name</label>
    <div class="col-md-10">
        <input class="form-control" name="GenericFileName" type="text" id="GenericFileName" value="{{ old('GenericFileName', isset($log->GenericFileName) ? $log->GenericFileName : null) }}" maxlength="60" placeholder="Enter generic file name here...">
        {!! $errors->first('GenericFileName', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('SystemID') ? 'has-error' : '' }}">
    <label for="SystemID" class="col-md-2 control-label">System I D</label>
    <div class="col-md-10">
        <input class="form-control" name="SystemID" type="number" id="SystemID" value="{{ old('SystemID', isset($log->SystemID) ? $log->SystemID : null) }}" min="-2147483648" max="2147483647" placeholder="Enter system i d here...">
        {!! $errors->first('SystemID', '<p class="help-block">:message</p>') !!}
    </div>
</div>

</div>

