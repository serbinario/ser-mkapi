
// Variável que armazenará o id da Contrato
var contrato_id;


// Evento para abrir o modal de btnAditvoModal
// este botao e criado no controller dinamicamente
$(document).on("click", ".btnModalFinanceiro", function () {


    // carregando a modal
    $("#modalFinanceiro").modal({show:true});

    //Recupera o id do registro
    cliente_id = $(this).attr('id');
    fornecedorNome   = table.row($(this).parents('tr')).data().nome;


    var varHead = " Financeiro: " + " - " + fornecedorNome;

    //Limpa Primeiro antes de colocar o texto
    $('#titleModalFianceiro').empty();
    // prenchendo o titulo do modal
    $('#titleModalFianceiro').append(varHead);



    gridDebitostable = $('#tableModalFinanceiro').DataTable({
        "destroy": true,
        "pageLength": 5,
        "lengthChange": false,
        "autoWidth": true,
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
            {data: 'id', name: 'fin_debitos.id', 'visible': true},
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

$(document).on( 'click', '.cancelBoleto', function( event ) {
    event.preventDefault();

    boletoCode  = $(this).attr('id');

    swal({
            title: "Deseja cancelar o boleto?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim, Cancelar o Boleto",
            cancelButtonText: "Nao, cancel!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                gridDebitostable.ajax.reload();
                cancelCharge()
            }
        });
});

function cancelCharge()
{
    //Recupera o id do registro

    //Necessario para que o ajax envie o csrf-token
    //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var dados = {
        'code': boletoCode
    }

    jQuery.ajax({
        type: 'GET',
        data: dados,
        url: '/index.php/debitos/cancelCharge/' + boletoCode,
        datatype: 'json'
    }).done(function (retorno) {

        if(retorno.success) {
            table.draw();
            swal(retorno.msg, "Click no botão abaixo!", "success");
        } else {
            swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });

}







