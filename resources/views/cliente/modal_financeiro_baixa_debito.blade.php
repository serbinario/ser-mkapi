<!-- BEGIN FORM MODAL MARKUP -->
<div class="modal fade" id="modalFinanceiroBaixaDebito" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titleModalFianceiroBaixaDebito">Baixa Débito</h4>
            </div>

            <div class="row">

                <form class="form" role="form" id="modalAditivoCreate">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    <div class="modal-body">

                        <div class="card-body">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control input-sm date datepicker" name="data_pagamento" type="text" id="data_pagamento" value="" placeholder="Data Pagamento..." step="any">
                                            {!! $errors->first('descricao', '<p class="help-block">:message</p>') !!}
                                            <label for="data_pagamento" class="control-label">Pata Pagamento *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select class="form-control input-sm" id="forma_pagamento_id" name="forma_pagamento_id">
                                                <option value="" style="display: none;" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : '') == '' ? 'selected' : '' }} disabled selected>Forma de Pagamento</option>
                                                @foreach ($finFormasPagamentos as $key => $finFormasPagamento)
                                                    <option value="{{ $key }}" {{ old('forma_pagamento_id', isset($debitos->forma_pagamento_id) ? $debitos->forma_pagamento_id : null) == $key ? 'selected' : '' }}>
                                                        {{ $finFormasPagamento }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="forma_pagamento_id" class="control-label">Forma Pagamento *</label>
                                        </div>
                                    </div>
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
                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control input-sm money" name="multa" type="text" id="multa" value="" placeholder="Multa..." step="any">
                                            {!! $errors->first('multa', '<p class="help-block">:message</p>') !!}
                                            <label for="multa" class="control-label">Multa *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control input-sm money" name="desconto" type="text" id="desconto" value="" placeholder="Desconto..." step="any">
                                            {!! $errors->first('desconto', '<p class="help-block">:message</p>') !!}
                                            <label for="desconto" class="control-label">Desconto *</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input class="form-control input-sm money" name="valor_pago" type="text" id="valor_pago" value="" placeholder="Valor Pago..." step="any">
                                            {!! $errors->first('valor_pago', '<p class="help-block">:message</p>') !!}
                                            <label for="valor_pago" class="control-label">Valor Pago *</label>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="btnSaveBaixa">Salvar</button>
                            <button type="button" class="btn btn-primary" id="btnCancelBaixa" data-dismiss="modal">Cancelar</button>
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


