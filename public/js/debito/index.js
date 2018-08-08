var boletoCode

$('.date').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});

//Retona o elemento que foi clicado com a class "delete", uso o "on" pois os elementos
//sao criados dinamicamente
$(document).on( 'click', '.delete', function( event ) {
    event.preventDefault();
    var elem = document.getElementsByClassName("delete");
    swal({
            title: "Are you sure?",
            text: "You will not be able to recover this imaginary file!",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel plx!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                $( '#'+elem[0].id ).submit();
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }
        });
});

//Cancela o boleto
// RN-0003
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
        type: 'POST',
        data: dados,
        url: '/index.php/debitos/cancelCharge/',
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


// Requisição ajax
jQuery.ajax({
    type: 'GET',
    url: '/index.php/debitos/knob',
    datatype: 'json'
}).done(function (retorno) {
    if(retorno.success) {

        var max = retorno.total

        $("em.pagas").html('<h4>' + retorno.total_pagos + '</h4>');
        $("em.areceber").html('<h4>' + retorno.total_aguardando + '</h4>');
        $("em.inadiplentes").html('<h4>' + retorno.total_inadiplentes + '</h4>');

        //KNOD PAGAS
        $("#pagas").knob({
            max:max,
        });
        $('#pagas').val(retorno.pagas).trigger('change');

        $("#inadiplentes").knob({
            max:max,
        });
        $('#inadiplentes').val(retorno.inadiplentes).trigger('change');


        $("#aReceber").knob({
            max:max,
        });
        $('#aReceber').val(retorno.aReceber).trigger('change');

        $("#dinheiro").knob({
            max:max,
        });
        $('#dinheiro').val(retorno.dinheiro).trigger('change');
        //$(".inadiplente").knob().val(37).trigger('change');

    } else {
        swal(retorno.msg, "Click no botão abaixo!", "error");
    }
});


// $('.knob-chart').val(27).trigger('change');

$(document).on("click", "#search", function () {
    console.log("ddddddddddddddddd");
    table.draw();
});

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = "12345"


        return true;

    }
);

var table = $('#debitos').DataTable({
    //"dom": 'lCfrtip',
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/debitos/grid",
        data: function (d) {
            d.status = $('select[name=status] option:selected').val();
            d.nome = $('input[name=nome]').val();
        }
    },
    columns: [
        {data: 'nome', name: 'mk_clientes.nome'},
        {data: 'valor_debito', name: 'fin_debitos.valor_debito'},
        {data: 'data_competencia', name: 'fin_debitos.data_competencia'},
        {data: 'data_vencimento', name: 'fin_debitos.data_vencimento'},
        {data: 'data_pagamento', name: 'fin_debitos.data_pagamento'},
        {data: 'valor_pago', name: 'fin_debitos.valor_pago'},
        {data: 'status', name: 'fin_status.nome'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    "fnInitComplete": function(oSettings, json) {
        console.log(json);
    }
});
