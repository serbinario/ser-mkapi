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
    var table = $('#log').DataTable({
        "dom": 'lCfrtip',
        processing: true,
        serverSide: true,
        bFilter: true,
        order: [[ 4, "DESC" ]],
        ajax: {
            url: "/index.php/log/grid",
            data: function (d) {

            }
        },
        columns: [
            {data: 'user', name: 'Message'},
            {data: 'status', name: 'Message'},
            {data: 'ip', name: 'Message'},
            {data: 'ReceivedAt', name: 'ReceivedAt'},
            {data: 'nome', name: 'mk_grupos.nome'}

        ]
    });

});