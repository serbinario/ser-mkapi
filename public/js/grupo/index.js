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
    var table = $('#grupo').DataTable({
        "dom": 'lCfrtip',
        processing: true,
        serverSide: true,
        bFilter: true,
        order: [[ 1, "asc" ]],
        ajax: {
            url: "/index.php/grupo/grid",
            data: function (d) {

            }
        },
        columns: [
            {data: 'nome', name: 'nome'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });

});