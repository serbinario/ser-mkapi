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



// $('.knob-chart').val(27).trigger('change');
//Executado no filtro
$(document).on("click", "#search", function () {
    console.log("ddddddddddddddddd");
    table.draw();
    chartKnob();
});

$(document).on("click", "#clear", function (event) {
    event.preventDefault();
    $('input[name=data_pag_ini]').val("");
    $('input[name=data_pag_fim]').val("")
    $('input[name=data_venc_ini]').val("")
    $('input[name=data_venc_fim]').val("")
    $('input[name=nome]').val("")
});

$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        var min = "12345"


        return true;

    }
);

var table = $('#cobranca').DataTable({
    //"dom": 'lCfrtip',
    "searching": true,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/cobranca/grid",
        data: function (d) {
        }
    },
    columns: [
        {data: 'id', name: 'cobranca.id'},
        {data: 'nome', name: 'mk_clientes.nome'},
        {data: 'phone01', name: 'mk_clientes.phone01'},
        {data: 'valor', name: 'cobrancas.valor'},
        {data: 'data_vencimento', name: 'data_vencimento'},
        {data: 'status', name: 'cobrancas.status'},
        {data: 'data_envio', name: 'cobrancas.data_envio'},
        {data: 'obs', name: 'cobrancas.obs'},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    "fnInitComplete": function(oSettings, json) {
        //chartKnob();
    }
});

function dateToEN(date)
{
    return date.split('/').reverse().join('-');
}
