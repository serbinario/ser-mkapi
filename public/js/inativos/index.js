console.log("wwwwwwwwwwwwwwwwwwwww")
var tableInativos = $('#inativos').DataTable({
    //"dom": 'lCfrtip',
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    ajax: {
        url: "/index.php/cliente/inativos/grid",
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
        {data: 'cpf', name: 'mk_clientes.cpf'},
        {data: 'login', name: 'mk_clientes.login'},
        {data: 'profile', name: 'mk_profiles.nome'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    "fnInitComplete": function(oSettings, json) {
        //chartKnob();
    }
});

