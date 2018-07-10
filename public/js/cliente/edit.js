$(document).ready(function () {
    console.log("edit");
    $('.phone').mask('(00)000000000');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.ip').mask('099.099.099.099');

    //Verifica se o cpf esta preenchido os campos juridico sao acultados
    if($( "input[name='tipo']").val() == 'Fisica'){
        $('.fisica').show()
        $('.juridico').hide()
    }else{
        $('.juridico').show()
        $('.fisica').hide()
    }

    //ao clicar aculta algum campo de cpf ou cnpj
    $('.tipoF').click(function () {
        $('.fisica').show()
        $('.juridico').hide()
    })
    $('.tipoJ').click(function () {
        $('.juridico').show()
        $('.fisica').hide()
    })

    //Ao submeter tirar as mascaras
    $("#contrato").submit(function (event) {
        $('.money').unmask();
    });

    $('.date').datepicker({autoclose: true, todayHighlight: true, format: "dd/mm/yyyy"});

    $("input[name=cep]").blur(function(){
        var cep_code = $(this).val();
        if( cep_code.length <= 0 ) return;
        $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", { code: cep_code },
            function(result){
            console.log(result)
                if( result.status!=1 ){
                    alert(result.message || "Houve um erro desconhecido");
                    return;
                }
                $("input#cep").val( result.code );
                $("input#estado").val( result.state );
                $("input#cidade").val( result.city );
                $("input#bairro").val( result.district );
                $("input#logradouro").val( result.address );
                $("input#estado").val( result.state );
                //alert("Dados recebidos e alterados");
            });
    });


});