
var table = $('#inadimplente').DataTable({
    //"dom": 'lCfrtip',
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/inadimplente/grid",
        data: function (d) {
            /*d.status = $('select[name=status] option:selected').val();
            d.nome = $('input[name=nome]').val();
            d.data_pag_ini = dateToEN($('input[name=data_pag_ini]').val());
            d.data_pag_fim = dateToEN($('input[name=data_pag_fim]').val());
            d.data_venc_ini = dateToEN($('input[name=data_venc_ini]').val());
            d.data_venc_fim = dateToEN($('input[name=data_venc_fim]').val());*/

        }
    },
    columns: [
        {data: 'nome', name: 'mk_clientes.nome'},
        {data: 'login', name: 'mk_clientes.login'},
        {data: 'valor_debito', name: 'fin_debitos.valor_debito'},
        {data: 'data_vencimento', name: 'fin_debitos.data_vencimento'},
        {data: 'status_secret', name: 'fin_debitos.status_secret'},
        {data: 'dias_atraso', name: 'dias_atraso'}
    ],
    "fnInitComplete": function(oSettings, json) {
        //chartKnob();
    }
});

