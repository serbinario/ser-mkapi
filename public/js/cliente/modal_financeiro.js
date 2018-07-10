
// Variável que armazenará o id da Contrato
var contrato_id;

// Evento para abrir o modal de btnAditvoModal
// este botao e criado no controller dinamicamente
$(document).on("click", ".btnModalFinanceiro", function () {


    // carregando a modal
    $("#modalFinanceiro").modal({show:true});

    //Recupera o id do registro
    cliente_id = $(this).attr('id');
    console.log(cliente_id);

    var table = $('#tableModalFinanceiro').DataTable({
        "destroy": true,
        "pageLength": 5,
        "lengthChange": false,
        processing: true,
        serverSide: true,
        bFilter: true,
        order: [[ 1, "asc" ]],
        ajax: {
            url: "/index.php/debitos/modalGrid" ,
            data: function (d) {
                d.cliente_id = cliente_id
            }
        },
        columns: [
            {data: 'numero_cobranca', name: 'numero_cobranca'},
            {data: 'valor_debito', name: 'valor_debito'},
            {data: 'valor_pago', name: 'valor_pago'},
            {data: 'data_vencimento', name: 'data_vencimento'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


});







