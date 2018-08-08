
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
            {data: 'code', name: 'fin_boletos.code'},
            {data: 'valor_debito', name: 'fin_debitos.valor_debito'},
            {data: 'data_vencimento', name: 'fin_debitos.data_vencimento'},
            {data: 'valor_pago', name: 'fin_debitos.valor_pago'},
            {data: 'data_pagamento', name: 'fin_debitos.data_pagamento'},
            {data: 'link', name: 'link', "render": function(data, type, row, meta){
                    if(type === 'display'){
                        if (data != null)
                        data = '<a target="_blank" href="' + data + '">' + 'link' + '</a>';
                    }
                    return data;
                }},
            {data: 'nome', name: 'fin_status.nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });


});







