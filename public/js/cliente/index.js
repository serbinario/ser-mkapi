var table = $('#cliente').DataTable({
    "dom": 'lCfrtip',
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/cliente/grid",
        data: function (d) {

        }
    },
    columns: [
        {data: 'id', name: 'mk_clientes.id'},
        {data: 'nome', name: 'mk_clientes.nome'},
        {data: 'cpf', name: 'mk_clientes.cpf'},
        {data: 'login', name: 'mk_clientes.login'},
        {data: 'profile', name: 'mk_profiles.nome'},
        {data: 'status', name: 'status', orderable: false, searchable: false, "sClass": "center"},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});




