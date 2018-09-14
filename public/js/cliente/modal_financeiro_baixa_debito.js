
// Variável que armazenará o id da Contrato
var contrato_id;

// Evento para abrir o modal de dar baixa debito
// este botao e criado no controller dinamicamente
$(document).on("click", ".btModalBaixaDebito", function () {

    // carregando a modal
    $("#modalFinanceiroBaixaDebito").modal({show:true});

    //Recupera a coluna
    numero_cobranca   = gridDebitostable.row($(this).parents('tr')).data().code;
    valor_debito = gridDebitostable.row($(this).parents('tr')).data().valor_debito;
    id_debito = gridDebitostable.row($(this).parents('tr')).data().id;

    var varHead = "Baixa Débito: " + numero_cobranca + " Cliente: "+ fornecedorNome + " Valor: R$ " + valor_debito;
    //Limpa Primeiro antes de colocar o texto
    $('#titleModalFianceiroBaixaDebito').empty();
    // prenchendo o titulo do modal
    $('#titleModalFianceiroBaixaDebito').append(varHead);


    //Limpar os campos
    $("#data_pagamento").val("");
    $("#forma_pagamento_id").val("");
    $("#conta_bancaria_id").val("");
    $("#multa").val("");
    $("#desconto").val("");
    $("#valor_pago").val(valor_debito);

});

// Evento para salvar o Debito
//Controller = DebitoController metodo store
$('#btnSaveBaixa').click(function() {
    // Recuperando valores do formulário
    var data_pagamento = $("#data_pagamento").val();
    var forma_pagamento_id = $("#forma_pagamento_id").val();
    var conta_bancaria_id = $("#conta_bancaria_id").val();
    var multa = $("#multa").val();
    var desconto = $("#desconto").val();
    var valor_pago = $("#valor_pago").val();



    // Preparando o array de dados
    var dados = {
        'id_debito': id_debito,
        'data_pagamento' : data_pagamento,
        'forma_pagamento_id' : forma_pagamento_id,
        'conta_bancaria_id' : conta_bancaria_id,
        'multa' : multa,
        'desconto' : desconto,
        'valor_pago' : valor_pago
    };


    //Valida se algum campo veio vazio
     if( !data_pagamento  || !forma_pagamento_id  || !valor_pago ){
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
        url: '/index.php/debitos/baixa',
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


            $('#modalFinanceiroBaixaDebito').modal('hide');
            gridDebitostable.ajax.reload();
            swal(retorno.msg, "Click no botão abaixo!", "success");
        } else {
            swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });
});







