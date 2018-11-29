$(document).ready(function () {
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

    console.log("index");
    var table = $('#profile').DataTable({
        "dom": 'lCfrtip',
        processing: true,
        serverSide: true,
        bFilter: true,
        order: [[ 1, "asc" ]],
        ajax: {
            url: "/index.php/profile/grid",
            data: function (d) {

            }
        },
        columns: [
            {data: 'descricao', name: 'descricao'},
            {data: 'nome', name: 'nome'},
            {data: 'valor', name: 'valor'},
            {data: 'local_address', name: 'local_address'},
            {data: 'rate_limit_tx_tx', name: 'rate_limit_tx_tx'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

});