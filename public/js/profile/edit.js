$(document).ready(function () {
    console.log("edit");
    $('.phone').mask('(00)000000000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.date').mask('00/00/0000');
    $('.ip').mask('099.099.099.099');
    $('.dns').mask('099.099.099.099');
    //Ao submeter tirar as mascaras
    $("#pool").submit(function (event) {
        $('.phone').unmask();
    });

    $(".select2-list").select2({
        allowClear: true
    });


});