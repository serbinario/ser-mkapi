<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="modalFinanceiroDebito" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titleModalFianceiroDebito">Novo Pagamento</h4>
            </div>

            <div class="row">

                <form class="form" role="form" id="modalAditivoCreate">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="modal-body">

                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control input-sm" name="descricao" type="text" id="descricao" value="" placeholder="Descriçao..." step="any">
                                        {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Descriçao *</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control input-sm" name="categoria" type="text" id="categoria" value="" placeholder="Categoria..." step="any">
                                        {!! $errors->first('categoria', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Categoria</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <select class="form-control input-sm" id="conta_bancaria_id" name="conta_bancaria_id">
                                            <option value="" style="display: none;" {{ old('conta_bancaria_id', isset($debitos->conta_bancaria_id) ? $debitos->conta_bancaria_id : '') == '' ? 'selected' : '' }} disabled selected>Select conta bancaria</option>
                                            @foreach ($finContasBancarias as $key => $finContasBancarium)
                                                <option value="{{ $key }}" {{ old('conta_bancaria_id', isset($debitos->conta_bancaria_id) ? $debitos->conta_bancaria_id : null) == $key ? 'selected' : '' }}>
                                                    {{ $finContasBancarium }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="descricao" class="control-label">Conta</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control input-sm date" name="data_competencia" type="text" id="data_competencia" value="" placeholder="data_competencia..." step="any">
                                        {!! $errors->first('data_competencia', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Data Competencia *</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control input-sm date" name="data_vencimento" type="text" id="data_vencimento" value="" placeholder="Data Vencimento..." step="any">
                                        {!! $errors->first('data_vencimento', '<p class="help-block">:message</p>') !!}
                                        <label for="data_vencimento" class="control-label">Data Vencimento *</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input class="form-control input-sm money" name="valor_debito" type="text" id="valor_debito" value="" placeholder="Valor Debito..." step="any">
                                        {!! $errors->first('valor_debito', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Valor *</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group {{ $errors->has('parcelas') ? 'has-error' : '' }}">
                                        <label for="parcelas" class="col-sm-4 control-label">Parcelas:</label>
                                        <div class="col-md-8">
                                            <select id="parcelas" name="parcelas" class="form-control input-sm">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>



              {{--              <div class="col-lg-12">
                                <h4 class="text-bold">Pago</h4>
                                <hr class=""/>
                            </div>

                            <br> <br><br>--}}

                            {{--<div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <input class="form-control input-sm date" name="data_pagamento" type="text" id="data_pagamento" value="{{ old('data_pagamento', isset($debitos->data_pagamento) ? $debitos->data_pagamento : null) }}" placeholder="Data Pagamento...">
                                        {!! $errors->first('data_pagamento', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Data Pagamento</label>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <select class="form-control input-sm" id="forma_pagamento_id" name="forma_pagamento_id">
                                            <option value="" style="display: none;" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : '') == '' ? 'selected' : '' }} disabled selected>Forma Pagamento</option>
                                            @foreach ($finFormasPagamentos as $key => $finFormasPagamento)
                                                <option value="{{ $key }}" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : null) == $key ? 'selected' : '' }}>
                                                    {{ $finFormasPagamento }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="descricao" class="control-label">Forma Pagamento</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input class="form-control input-sm" name="valor_desconto" type="number" id="valor_desconto" value="{{ old('valor_desconto', isset($debitos->valor_desconto) ? $debitos->valor_desconto : null) }}" min="-99999999" max="99999999" placeholder="Descontos..." step="any">
                                        {!! $errors->first('valor_desconto', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Descontos</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input class="form-control input-sm" name="valor_desconto" type="number" id="valor_desconto" value="{{ old('valor_desconto', isset($debitos->valor_desconto) ? $debitos->valor_desconto : null) }}" min="-99999999" max="99999999" placeholder="Multa Juros..." step="any">
                                        {!! $errors->first('valor_desconto', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Juros/Multa</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <input class="form-control input-sm" name="valor_pago" type="number" id="valor_pago" value="{{ old('valor_pago', isset($debitos->valor_pago) ? $debitos->valor_pago : null) }}" min="-99999999" max="99999999" placeholder="Valor Pago..." step="any">
                                        {!! $errors->first('valor_pago', '<p class="help-block">:message</p>') !!}
                                        <label for="descricao" class="control-label">Valor Pago</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('local_pagamento_id') ? 'has-error' : '' }}">
                                <label for="local_pagamento_id" class="col-md-2 control-label">Local Pagamento</label>
                                <div class="col-md-10">
                                    <select class="form-control input-sm" id="local_pagamento_id" name="local_pagamento_id">
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
--}}




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btnSaveDebito">Salvar</button>
                            <button type="button" class="btn btn-primary" id="btnCancelAditivos" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>

                </form>

            </div><!--end .row -->
            <!-- END DATATABLE 1 -->


        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL MARKUP -->

<div class="carregamento">
</div>


