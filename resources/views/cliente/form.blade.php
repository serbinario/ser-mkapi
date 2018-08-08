<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    <div class="form-group">
        <label class="col-sm-2 control-label">Tipo Pessoa *</label>
        <div class="col-sm-10">
            <label class="radio-inline radio-styled radio-primary">
                <input {{ isset($cliente->tipo) ? 'disabled' : '' }} id="tipo_fisica" class="tipoF" name="tipo" type="radio" value="Fisica" required="true" {{ old('tipo', isset($cliente->tipo) ? $cliente->tipo : null) == 'Fisica' ? 'checked' : '' }}>
                Fisica
            </label>
            <label class="radio-inline radio-styled radio-success">
                <input {{ isset($cliente->tipo) ? 'disabled' : '' }} id="tipo_juridico" class="tipoJ" name="tipo" type="radio" value="Juridico" required="true" {{ old('tipo', isset($cliente->tipo) ? $cliente->tipo : null) == 'Juridico' ? 'checked' : '' }}>
                Juridico
            </label>
        </div><!--end .col -->
    </div><!--end .form-group -->
    
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('nome') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">Nome: *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="nome" type="text" id="nome" value="{{ old('nome', isset($cliente->nome) ? $cliente->nome : null) }}" minlength="1" maxlength="255"  placeholder="Enter nome here...">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('data_nascimento') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">Data Nacimento *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm date" name="data_nascimento" type="text" id="data_nascimento" value="{{ old('data_nascimento', isset($cliente->data_nascimento) ? $cliente->data_nascimento : null) }}" placeholder="Enter data nascimento here...">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('login') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">Login *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="login" type="text" id="login" value="{{ old('login', isset($cliente->login) ? $cliente->login : null) }}" maxlength="20" placeholder="Enter login here...">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('senha') ? 'has-error' : '' }}">
                <label for="login" class="col-sm-4 control-label">Senha *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="senha" type="text" id="senha" value="{{ old('senha', isset($cliente->senha) ? $cliente->senha : null) }}" maxlength="20" placeholder="Enter senha here...">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        <label for="email" class="col-md-2 control-label">Email</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="email" type="text" id="email" value="{{ old('email', isset($cliente->email) ? $cliente->email : null) }}" maxlength="50" placeholder="Enter email here...">
        </div>
    </div>

    <div class="row fisica">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('cpf') ? 'has-error' : '' }}">
                <label for="cpf" class="col-md-4 control-label">CPF *</label>
                <div class="col-md-8">
                    <input class="form-control input-sm cpf" name="cpf" type="text" id="cpf" value="{{ old('cpg', isset($cliente->cpf) ? $cliente->cpf : null) }}"  placeholder="Entre com o CPF...">
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('rg') ? 'has-error' : '' }}">
                <label for="rg" class="col-md-4 control-label">RG</label>
                <div class="col-md-8">
                    <input class="form-control input-sm" name="rg" type="text" id="rg" value="{{ old('rg', isset($cliente->rg) ? $cliente->rg : null) }}"   placeholder="Entre com o CPF...">
                </div>
            </div>
        </div>
    </div>


    <div class="form-group juridico {{ $errors->has('cnpj') ? 'has-error' : '' }}">
        <label for="cnpj" class="col-md-2 control-label">CNPJ *</label>
        <div class="col-md-10">
            <input class="form-control input-sm cnpj" name="cnpj" type="text" id="cnpj" value="{{ old('cnpj', isset($cliente->clienteable->cnpj) ? $cliente->clienteable->cnpj : null) }}"   placeholder="Entre com o CPF...">
        </div>
    </div>


    <div class="row">
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('phone01') ? 'has-error' : '' }}">
                <label for="phone01" class="col-md-4 control-label">Telefone 01</label>
                <div class="col-md-8">
                    <input class="form-control input-sm phone" name="phone01" type="text" id="phone01" value="{{ old('phone01', isset($cliente->phone01) ? $cliente->phone01 : null) }}" placeholder="Entre com telefone here...">
                    {!! $errors->first('phone01', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group {{ $errors->has('phone02') ? 'has-error' : '' }}">
                <label for="phone01" class="col-md-4 control-label">Telefone 02</label>
                <div class="col-md-8">
                    <input class="form-control input-sm phone" name="phone02" type="text" id="phone02" value="{{ old('phone02', isset($cliente->phone02) ? $cliente->phone02 : null) }}" placeholder="Entre com teleffone here...">
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Endereço</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    <div class="form-group {{ $errors->has('cep') ? 'has-error' : '' }}">
        <label for="cep" class="col-md-2 control-label">Cep *</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="cep" type="text" id="cep" value="{{ old('cep', isset($cliente->cep) ? $cliente->cep : null) }}" maxlength="10" placeholder="Enter cep here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('logradouro') ? 'has-error' : '' }}">
        <label for="logradouro" class="col-md-2 control-label">Logradouro *</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="logradouro" type="text" id="logradouro" value="{{ old('logradouro', isset($cliente->logradouro) ? $cliente->logradouro : null) }}" maxlength="200" placeholder="Enter logradouro here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('numero_casa') ? 'has-error' : '' }}">
        <label for="numero_casa" class="col-md-2 control-label">Numero *</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="numero_casa" type="text" id="numero_casa" value="{{ old('logradouro', isset($cliente->numero_casa) ? $cliente->numero_casa : null) }}" maxlength="200" placeholder="Enter logradouro here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('complemanto') ? 'has-error' : '' }}">
        <label for="complemanto" class="col-md-2 control-label">Complemanto</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="complemanto" type="text" id="complemanto" value="{{ old('complemanto', isset($cliente->complemanto) ? $cliente->complemanto : null) }}" maxlength="200" placeholder="Enter complemanto here...">
            {!! $errors->first('complemanto', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('bairro') ? 'has-error' : '' }}">
        <label for="bairro" class="col-md-2 control-label">Bairro</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="bairro" type="text" id="bairro" value="{{ old('bairro', isset($cliente->bairro) ? $cliente->bairro : null) }}" maxlength="50" placeholder="Enter bairro here...">
            {!! $errors->first('bairro', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('cidade') ? 'has-error' : '' }}">
        <label for="cidade" class="col-md-2 control-label">Cidade *</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="cidade" type="text" id="cidade" value="{{ old('cidade', isset($cliente->cidade) ? $cliente->cidade : null) }}" maxlength="50" placeholder="Enter cidade here...">
        </div>
    </div>
    <div class="form-group {{ $errors->has('estado') ? 'has-error' : '' }}">
        <label for="estado" class="col-md-2 control-label">Estado *</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="estado" type="text" id="estado" value="{{ old('estado', isset($cliente->estado) ? $cliente->estado : null) }}" maxlength="50" placeholder="Enter estado here...">
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Adicionais</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>

    <div class="form-group {{ $errors->has('data_instalacao') ? 'has-error' : '' }}">
        <label for="data_instalacao" class="col-md-2 control-label">Data Instalacao *</label>
        <div class="col-md-10">
            <input class="form-control input-sm date" name="data_instalacao" type="text" id="data_instalacao" value="{{ old('data_instalacao', isset($cliente->data_instalacao) ? $cliente->data_instalacao : null) }}" placeholder="Enter data instalacao here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('grupo_id') ? 'has-error' : '' }}">
        <label for="grupo_id" class="col-md-2 control-label">Grupo *</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="grupo_id" name="grupo_id">
                <option value="" style="display: none;" {{ old('grupo_id', isset($cliente->grupo_id) ? $cliente->grupo_id : '') == '' ? 'selected' : '' }} disabled selected>Select Grupo</option>
                @foreach ($mkGrupos as $key => $mkGrupo)
                    <option value="{{ $key }}" {{ old('grupo_id', isset($cliente->grupo_id) ? $cliente->grupo_id : null) == $key ? 'selected' : '' }}>
                        {{ $mkGrupo }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-lg-12">
        <h4 class="text-bold">Dados do Plano</h4>
        <hr class="ruler-lg"/>
    </div>
    <br> <br><br>


    <div class="form-group {{ $errors->has('router_id') ? 'has-error' : '' }}">
        <label for="router_id" class="col-md-2 control-label">Router</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="router_id" name="router_id">
                <option value="" style="display: none;" {{ old('router_id', isset($cliente->router_id) ? $cliente->router_id : '') == '' ? 'selected' : '' }} disabled selected>Select router</option>
                @foreach ($mkRouters as $key => $mkRouter)
                    <option value="{{ $key }}" {{ old('router_id', isset($cliente->router_id) ? $cliente->router_id : null) == $key ? 'selected' : '' }}>
                        {{ $mkRouter }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('profile_id') ? 'has-error' : '' }}">
        <label for="profile_id" class="col-md-2 control-label">Profile *</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="profile_id" name="profile_id">
                <option value="" style="display: none;" {{ old('profile_id', isset($cliente->profile_id) ? $cliente->profile_id : '') == '' ? 'selected' : '' }} disabled selected>Select profile</option>
                @foreach ($mkProfiles as $key => $mkProfile)
                    <option value="{{ $key }}" {{ old('profile_id', isset($cliente->profile_id) ? $cliente->profile_id : null) == $key ? 'selected' : '' }}>
                        {{ $mkProfile }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>




    <div class="form-group {{ $errors->has('tipo_autenticacao') ? 'has-error' : '' }}">
        <label for="tipo_autenticacao" class="col-md-2 control-label">Tipo Autenticaçao</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="tipo_autenticacao" name="tipo_autenticacao">
                <option value="" style="display: none;" {{ old('tipo_autenticacao', isset($cliente->tipo_autenticacao) ? $cliente->tipo_autenticacao : '') == '' ? 'selected' : '' }} disabled selected>Enter tipo autenticaçao here...</option>
                @foreach (['PPPoE' => 'PPPoE',
    'Hotspot' => 'Hotspot',
    'Dhcp' => 'Dhcp'] as $key => $text)
                    <option value="{{ $key }}" {{ old('tipo_autenticacao', isset($cliente->tipo_autenticacao) ? $cliente->tipo_autenticacao : null) == $key ? 'selected' : '' }}>
                        {{ $text }}
                    </option>
                @endforeach
            </select>

            {!! $errors->first('tipo_autenticacao', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('ip_pppoe') ? 'has-error' : '' }}">
        <label for="ip_pppoe" class="col-md-2 control-label">Ip Pppoe</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="ip_pppoe" type="text" id="ip_pppoe" value="{{ old('ip_pppoe', isset($cliente->ip_pppoe) ? $cliente->ip_pppoe : null) }}" maxlength="20" placeholder="Enter ip pppoe here...">
            {!! $errors->first('ip_pppoe', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('ip_hotspot') ? 'has-error' : '' }}">
        <label for="ip_hotspot" class="col-md-2 control-label">Ip Hotspot</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="ip_hotspot" type="text" id="ip_hotspot" value="{{ old('ip_hotspot', isset($cliente->ip_hotspot) ? $cliente->ip_hotspot : null) }}" maxlength="20" placeholder="Enter ip hotspot here...">
            {!! $errors->first('ip_hotspot', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('mac') ? 'has-error' : '' }}">
        <label for="mac" class="col-md-2 control-label">Mac</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="mac" type="text" id="mac" value="{{ old('mac', isset($cliente->mac) ? $cliente->mac : null) }}" maxlength="20" placeholder="Enter mac here...">
            {!! $errors->first('mac', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('vencimento_dia_id') ? 'has-error' : '' }}">
        <label for="vencimento_dia_id" class="col-md-2 control-label">Vencimento Dia *</label>
        <div class="col-md-10">
            <select class="form-control input-sm" id="vencimento_dia_id" name="vencimento_dia_id">
                <option value="" style="display: none;" {{ old('vencimento_dia_id', isset($cliente->vencimento_dia_id) ? $cliente->vencimento_dia_id : '') == '' ? 'selected' : '' }} disabled selected>Select vencimento dia</option>
                @foreach ($mkVencimentoDia as $key => $mkVencimentoDium)
                    <option value="{{ $key }}" {{ old('vencimento_dia_id', isset($cliente->vencimento_dia_id) ? $cliente->vencimento_dia_id : null) == $key ? 'selected' : '' }}>
                        {{ $mkVencimentoDium }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group {{ $errors->has('dias_bloqueio') ? 'has-error' : '' }}">
        <label for="dias_bloqueio" class="col-md-2 control-label">Dias Bloqueio</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="dias_bloqueio" type="number" id="dias_bloqueio" value="{{ old('dias_bloqueio', isset($cliente->dias_bloqueio) ? $cliente->dias_bloqueio : null) }}" min="-2147483648" max="2147483647" placeholder="Enter dias bloqueio here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('dias_msg_pendencia') ? 'has-error' : '' }}">
        <label for="dias_msg_pendencia" class="col-md-2 control-label">Dias Msg Pendencia</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="dias_msg_pendencia" type="number" id="dias_msg_pendencia" value="{{ old('dias_msg_pendencia', isset($cliente->dias_msg_pendencia) ? $cliente->dias_msg_pendencia : null) }}" min="-2147483648" max="2147483647" placeholder="Enter dias msg pendencia here...">
        </div>
    </div>

    <div class="form-group {{ $errors->has('inseto_mensalidade') ? 'has-error' : '' }}">
        <label for="inseto_mensalidade" class="col-md-2 control-label">Inseto Mensalidade</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="inseto_mensalidade_1">
                    <input id="inseto_mensalidade_1" class="" name="inseto_mensalidade" type="checkbox" value="1" {{ old('inseto_mensalidade', isset($cliente->inseto_mensalidade) ? $cliente->inseto_mensalidade : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('inseto_mensalidade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('mensalidade_automatica') ? 'has-error' : '' }}">
        <label for="mensalidade_automatica" class="col-md-2 control-label">Mensalidade Automatica</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="mensalidade_automatica_1">
                    <input id="mensalidade_automatica_1" class="" name="mensalidade_automatica" type="checkbox" value="1" {{ old('mensalidade_automatica', isset($cliente->mensalidade_automatica) ? $cliente->mensalidade_automatica : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('mensalidade_automatica', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('msg_bloqueio_automatica') ? 'has-error' : '' }}">
        <label for="msg_bloqueio_automatica" class="col-md-2 control-label">Msg Bloqueio Automatica</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="msg_bloqueio_automatica_1">
                    <input id="msg_bloqueio_automatica_1" class="" name="msg_bloqueio_automatica" type="checkbox" value="1" {{ old('msg_bloqueio_automatica', isset($cliente->msg_bloqueio_automatica) ? $cliente->msg_bloqueio_automatica : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('msg_bloqueio_automatica', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('msg_pendencia_automatica') ? 'has-error' : '' }}">
        <label for="msg_pendencia_automatica" class="col-md-2 control-label">Msg Pendencia Automatica</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="msg_pendencia_automatica_1">
                    <input id="msg_pendencia_automatica_1" class="" name="msg_pendencia_automatica" type="checkbox" value="1" {{ old('msg_pendencia_automatica', isset($cliente->msg_pendencia_automatica) ? $cliente->msg_pendencia_automatica : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('msg_pendencia_automatica', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('perm_alter_senha') ? 'has-error' : '' }}">
        <label for="perm_alter_senha" class="col-md-2 control-label">Perm Alter Senha</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="perm_alter_senha_1">
                    <input id="perm_alter_senha_1" class="" name="perm_alter_senha" type="checkbox" value="1" {{ old('perm_alter_senha', isset($cliente->perm_alter_senha) ? $cliente->perm_alter_senha : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('perm_alter_senha', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('desconto_mensalidade') ? 'has-error' : '' }}">
        <label for="desconto_mensalidade" class="col-md-2 control-label">Desconto Mensalidade</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="desconto_mensalidade" type="number" id="desconto_mensalidade" value="{{ old('desconto_mensalidade', isset($cliente->desconto_mensalidade) ? $cliente->desconto_mensalidade : null) }}" min="-999" max="999" placeholder="Enter desconto mensalidade here..." step="any">
            {!! $errors->first('desconto_mensalidade', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('desconto_mensali_ate_venci') ? 'has-error' : '' }}">
        <label for="desconto_mensali_ate_venci" class="col-md-2 control-label">Desconto Mensali Ate Venci</label>
        <div class="col-md-10">
            <input class="form-control input-sm" name="desconto_mensali_ate_venci" type="number" id="desconto_mensali_ate_venci" value="{{ old('desconto_mensali_ate_venci', isset($cliente->desconto_mensali_ate_venci) ? $cliente->desconto_mensali_ate_venci : null) }}" min="-999" max="999" placeholder="Enter desconto mensali ate venci here..." step="any">
            {!! $errors->first('desconto_mensali_ate_venci', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('is_ativo') ? 'has-error' : '' }}">
        <label for="is_ativo" class="col-md-2 control-label">Is Ativo</label>
        <div class="col-md-10">
            <div class="checkbox checkbox-styled">
                <label for="is_ativo_1">
                    <input id="is_ativo_1" class="" name="is_ativo" type="checkbox" value="1" {{ old('is_ativo', isset($cliente->is_ativo) ? $cliente->is_ativo : null) == '1' ? 'checked' : '' }}>
                    Yes
                </label>
            </div>

            {!! $errors->first('is_ativo', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('obs') ? 'has-error' : '' }}">
        <label for="obs" class="col-md-2 control-label">Obs</label>
        <div class="col-md-10">
            <textarea class="form-control input-sm" name="obs" cols="50" rows="10" id="obs" placeholder="Enter obs here...">{{ old('obs', isset($cliente->obs) ? $cliente->obs : null) }}</textarea>
            {!! $errors->first('obs', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>

