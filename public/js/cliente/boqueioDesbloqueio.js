//Retona o elemento que foi clicado com a class "delete", uso o "on" pois os elementos
//sao criados dinamicamente
$(document).on( 'click', '.enableDisableSecret', function( event ) {
    event.preventDefault();
    cliente_id = $(this).attr('id');

    swal({
            title: "Tem certeza que quer bloquear?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim, Bloquear!",
            cancelButtonText: "Nao, cancelar!",
            closeOnConfirm: false,
            closeOnCancel: true
        },
        function(isConfirm) {
            if (isConfirm) {
                boqueioDesbloqueio()
            }
        });
});


function boqueioDesbloqueio()
{
    //Necessario para que o ajax envie o csrf-token
    //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    jQuery.ajax({
        type: 'POST',
        url: '/index.php/mikrotik/enableDisableSecret/' + cliente_id,
        datatype: 'json'
    }).done(function (retorno) {
        if(retorno.success) {
            swal("", "Usuario Bloqueado com sucesso", "success");
            table.ajax.reload();

        } else {
            swal("Error", "Click no botão abaixo!", "error");
            table.ajax.reload();
        }
    });
}