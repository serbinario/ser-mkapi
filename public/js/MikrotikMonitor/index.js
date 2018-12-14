$(document).ready(function () {

    var dados = {
        'data_venc_ini' : "1",
        'data_venc_fim' : "2"

    };
    // Requisição ajax
    jQuery.ajax({
        type: 'GET',
        data: dados,
        url: '/index.php/mikrotikMonitor/pppoeStatus',
        datatype: 'json'
    }).done(function (retorno) {
        if(retorno.success) {

            $(".monitoramento").append(addColuna());

            $total_registros = retorno.query.length;
            //console.log(retorno.qtdPorGrupo);

            //Cria todas os cads de cada grupo
            retorno.qtdPorGrupo.forEach(function(obj) {
                var arrayGrupo = [];
                var resultado="";
                for (var propriedade in obj) {
                    //resultado += obj[propriedade];
                    arrayGrupo.push(obj[propriedade])
                }
                $(".teste").append(addCard(arrayGrupo[0], arrayGrupo[0]));
            });


            var i = 1;
            var desconectado = "CONECTADO"
            //Cria todas os li de cada grupo
            retorno.query.forEach(function(obj) {
                var arrayCliente = [];
                var resultado="";
                for (var propriedade in obj) {
                    //resultado += obj[propriedade];
                    arrayCliente.push(obj[propriedade])
                }
                var string  = arrayCliente[3]

                if(string.length > 10) // will be true
                    $("#" + i).append(addLiDanger(arrayCliente[2], arrayCliente[5]));
                else
                    $("#" + i).append(addLiInfo(arrayCliente[2], arrayCliente[5]));
                if(i == 12)
                   // $(".monitoramento").append(addColuna());




                if(i ==12)
                    i = 0
                i++;
                //console.log(arrayCliente[2])
                //$(".teste").append(addCard(arrayCliente[0], arrayCliente[0]));
            });

            //$(".monitoramento").append(addColuna());
            //$(".divider-full-bleed").append(addLi());
            //$(".divider-full-bleed").append(addLi());
            //$(".monitoramento").append(addColuna());
            //$(".divider-full-bleed").append(addLi());

        } else {
            //swal(retorno.msg, "Click no botão abaixo!", "error");
        }
    });

    function addCard(nome, qtd) {
        //console.log(nome);
        htmlCard = "";
        htmlCard += "<div class=\"col-md-12\">";
        htmlCard += "   <div class=\"card teste2\">";
        htmlCard += "       <div class=\"card-head " + nome + "\">";
        htmlCard += "           <header>" + nome + "</header>"
        htmlCard += "       </div><!--end .card-head -->";
        htmlCard += "   </div><!--end .card -->";
        htmlCard += "</div><!--end .col -->";
        return htmlCard

    }

    function addColuna() {
        //console.log(nome);
        htmlColuna = "";
        htmlColuna += "<div class=\"col-md-1\">";
        htmlColuna += "   <div class=\"card-body no-padding\">";
        htmlColuna += "     <ul class=\"list divider-full-bleed\" data-sortable=\"true\">";
        htmlColuna += "     </ul><!--end .card -->";
        htmlColuna += "   </div><!--end .card -->";
        htmlColuna += "</div><!--end .col -->";
        return htmlColuna
    }

    function addLiInfo(nome, hora) {
        //console.log(nome);
        htmlColuna = "";
        htmlColuna += "<li class=\"tile\">";
        htmlColuna += "   <a class=\"tile-content ink-reaction style-info\" href=\"#2\">";
        htmlColuna += "     <div class=\"tile-text\">";
        htmlColuna += "          " + nome;
        htmlColuna += "         <small>" + hora + "</small>";
        htmlColuna += "     </div><!--end .card -->";
        htmlColuna += "   </a>";
        htmlColuna += "</li>";
        return htmlColuna
    }

    function addLiDanger(nome, hora) {
        //console.log(nome);
        htmlColuna = "";
        htmlColuna += "<li class=\"tile\">";
        htmlColuna += "   <a class=\"tile-content ink-reaction style-danger\" href=\"#2\">";
        htmlColuna += "     <div class=\"tile-text\">";
        htmlColuna += "          " + nome;
        htmlColuna += "         <small>" + hora + "</small>";
        htmlColuna += "     </div><!--end .card -->";
        htmlColuna += "   </a>";
        htmlColuna += "</li>";
        return htmlColuna
    }










});