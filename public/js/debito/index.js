

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

    //KNOD PAGAS
    $("#pagas").knob({
        max:"285",
    });
    $('#pagas').val(36).trigger('change');

    $("#inadiplente").knob({
        max:"285",
    });
    $('#inadiplente').val(50).trigger('change');


    $("#aReceber").knob({
        max:"285",
    });
    $('#aReceber').val(260).trigger('change');

    $("#dinheiro").knob({
        max:"285",
    });
    $('#dinheiro').val(1).trigger('change');
    //$(".inadiplente").knob().val(37).trigger('change');

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



    console.log("index");
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
            {data: 'data_vencimento', name: 'fin_debitos.data_vencimento'},
            {data: 'data_pagamento', name: 'fin_debitos.data_pagamento'},
            {data: 'valor_pago', name: 'fin_debitos.valor_pago'},
            {data: 'status', name: 'fin_debitos.status'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        "fnInitComplete": function(oSettings, json) {
        console.log(json);
    }
    });
