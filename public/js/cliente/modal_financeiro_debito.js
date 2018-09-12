
// Variável que armazenará o id da Contrato
var contrato_id;

// Evento para abrir o modal de btnAditvoModal
// este botao e criado no controller dinamicamente
$(document).on("click", ".btnModalFinanceiroDebito", function () {

    // carregando a modal
    $("#modalFinanceiroDebito").modal({show:true});

    //Recupera a coluna
    fornecedorNome   = table.row($(this).parents('tr')).data().nome;
    login   = table.row($(this).parents('tr')).data().login;
    cpf   = table.row($(this).parents('tr')).data().cpf;
    console.log(fornecedorNome);

    //Recupera o id do registro
    cliente_id = $(this).attr('id'); //$(this) refers the clicked button element

    //Adiciono um campo hidden com o id do registro do contrato
    //$("input[type='hidden']").remove();
    $('#modalFinanceiroDebito').append('<input type="hidden" name="id" value="' + cliente_id + '" />');

    var varHead = " Novo Pagamento: " + " - " + fornecedorNome + " Login: " + login;

    //Limpa Primeiro antes de colocar o texto
    $('#titleModalFianceiroDebito').empty();
    // prenchendo o titulo do modal
    $('#titleModalFianceiroDebito').append(varHead);


    // Recuperando valores do formulário
    var descricao = $("#descricao").val();
    var data_vencimento = $("#data_vencimento").val();
    var data_competencia = $("#data_competencia").val();
    var valor_debito = $("#valor_debito").val();




    //Limpar os campos
    $("#descricao").val("");
    $("#data_vencimento").val("");
    $("#data_competencia").val("");
    $("#valor_debito").val("");
    $("#categoria").val("");


    //Necessario para que o ajax envie o csrf-token
    //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Requisição ajax
    jQuery.ajax({
        type: 'POST',
        url: '/index.php/cliente/getCliente/' + cliente_id,
        datatype: 'json'
    }).done(function (retorno) {
        if(retorno.success) {
            $("#descricao").val(retorno.descricao);
            $("#data_vencimento").val(retorno.diaVenci);
            $("#data_competencia").val(retorno.diaVenci);
            $("#valor_debito").val(retorno.valor);
        } else {

        }
    });
});

// Evento para salvar o Debito
//Controller = DebitoController metodo store
$('#btnSaveDebito').click(function() {
    // Recuperando valores do formulário
    var descricao = $("#descricao").val();
    var data_vencimento = $("#data_vencimento").val();
    var data_competencia = $("#data_competencia").val();
    var valor_debito = $("#valor_debito").val();


    // Preparando o array de dados
    var dados = {
        'id' : cliente_id,
        'nome' : fornecedorNome,
        'cpf' : cpf,
        'mk_cliente_id' : cliente_id,
        'descricao' : descricao,
        'data_vencimento' : data_vencimento,
        'data_competencia' : data_competencia,
        'valor_debito' : valor_debito
    };

    //Valida se algum campo veio vazio
    if(!cpf){
        swal("CPF nao Informado", "Click no botão abaixo!", "error");
        return false
    }

    //Valida se algum campo veio vazio
     if( !descricao  || !data_vencimento  || !data_competencia  || !valor_debito || !cpf){
        swal("Existe campos obrigatorios", "Click no botão abaixo!", "error");
         return false
     }

    //Necessario para que o ajax envie o csrf-token
    //Para isso coloquei no form <meta name="csrf-token" content="{{ csrf_token() }}">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Requisição ajax
    jQuery.ajax({
        type: 'POST',
        url: '/index.php/debitos',
        data: dados,
        datatype: 'json',
        beforeSend: function() {
            $(".carregamento").show();
        },
        complete: function() {
            $(".carregamento").hide();
        }
    }).done(function (retorno) {
        if(retorno.success) {
            console.log(table.ajax.reload())
            table.ajax.reload();

            //Limpar os campos
            $("#descricao").val("");
            $("#data_vencimento").val("");
            $("#data_competencia").val("");
            $("#valor_debito").val("");
            $("#categoria").val("");


            $('#modalFinanceiroDebito').modal('hide');
            swal(retorno.msg, "Click no botão abaixo!", "success");
        } else {
            swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });
});







