var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {	
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
	
    var options = {
        zoom: 5,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

function abrirInfoBox(id, marker) {
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}

function carregarPontos() {
    //console.log("ddddd")
    jQuery.ajax({
        type: 'GET',
        url: '/mikrotik/activeDesactiveClients/',
        datatype: 'json'
    }).done(function (retorno) {
        console.log(retorno)
        var latlngbounds = new google.maps.LatLngBounds();

        //console.log(retorno.clientes)
        $.each(retorno.clientes, function(index, ponto) {

            //console.log(ponto.Id)
            if(ponto.status == "desconectado"){
                icon = '/img/desconectado.png'
            }else{
                icon = '/img/conectado2.png'
            }
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(ponto.Latitude, ponto.Longitude),
                title: "Nome:" + ponto.nome   + "\nLogin:" + ponto.login  + "\nEnd.::" + ponto.Descricao + "\nTempo:" + ponto.uptime,
                icon: icon,
                map: map
            });

            if(ponto.status == "desconectado"){
                marker.setAnimation(google.maps.Animation.BOUNCE);
                marker.labelContent = ponto.login;
            }


            var myOptions = {
                content: "<p>" + "Nome:" + ponto.nome   + "<br>Login:" + ponto.login  + "<br>End.::" + ponto.Descricao + "<br>Tempo:" + ponto.uptime + "</p>",
                pixelOffset: new google.maps.Size(-150, 0)
            };

            infoBox[ponto.Id] = new InfoBox(myOptions);
            infoBox[ponto.Id].marker = marker;

            infoBox[ponto.Id].listener = google.maps.event.addListener(marker, 'click', function (e) {
                abrirInfoBox(ponto.Id, marker);
            });

            markers.push(marker);

            latlngbounds.extend(marker.position);

        });

        //Agrupa os makers
        //var markerCluster = new MarkerClusterer(map, markers);

        map.fitBounds(latlngbounds);
    });
	
}

carregarPontos();