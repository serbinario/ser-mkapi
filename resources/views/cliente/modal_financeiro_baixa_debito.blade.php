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


