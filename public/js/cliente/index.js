var gridDebitostable;
var fornecedorNome;
var valor_debito;
var numero_cobranca;
var id_debito; //id do debito
function template(d){
    console.log(d);
    //Retirar os "&quot" da array aditivos
    //var aditivos = JSON.parse(d.aditivos.replace(/&quot;/g,'"'))

    var html = "<table class='table table-bordered'>";
    html += "<thead>" +
        "<tr><td>Profile</td><td>Grupo</td></tr>" +
        "</thead>";



    html += "<tr>";
    html += "<td>"  + d.profile + "</td>";
    html += "<td>"  + d.grupo + "</td>";

    html += "</tr>"

    html += "</table>";

    return  html;
}

var table = $('#cliente').DataTable({
    "searching": false,
    "bLengthChange": false,
    processing: true,
    serverSide: true,
    bFilter: true,
    order: [[ 1, "asc" ]],
    ajax: {
        url: "/index.php/cliente/grid",
        data: function (d) {
            d.status = $('select[name=status] option:selected').val();
            d.data_instalacao_ini = dateToEN($('input[name=data_instalacao_ini]').val());
            d.data_instalacao_fin = dateToEN($('input[name=data_instalacao_fin]').val())
            d.localizar = $('input[name=localizar]').val();
            d.vencimento = $('select[name=vencimento] option:selected').val();
            d.grupo_id = $('select[name=grupo_id] option:selected').val();
        }
    },
    columns: [
        {
            "className":      'details-control',
            "orderable":      false,
            "data":           null,
            "defaultContent": ''
        },
        {data: 'id', name: 'mk_clientes.id'},
        {data: 'nome', name: 'mk_clientes.nome'},
        {data: 'cpf', name: 'mk_clientes.cpf'},
        {data: 'login', name: 'mk_clientes.login'},
        {data: 'profile', name: 'mk_profiles.nome'},
        {data: 'status', name: 'status', searchable: false, "sClass": "center"},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ]
});

// Add event listener for opening and closing details
$('#cliente tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( template(row.data()) ).show();
        tr.addClass('shown');
    }
});

$(document).on("keyup", "#localizar", function () {
    table.draw();
});

$(document).on("change", "#status", function () {
    table.draw();
});
$(document).on("change", "#vencimento", function () {
    table.draw();
});

$(document).on("change", "#data_instalacao_fin", function () {
    table.draw();
});

$(document).on("change", "#grupo_id", function () {
    table.draw();
});

function dateToEN(date)
{
    return date.split('/').reverse().join('-');
}





