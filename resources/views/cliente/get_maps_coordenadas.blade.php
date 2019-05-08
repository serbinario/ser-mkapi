<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK - AUTH :: MAPA</title>
    <link href="estilos/leaflet.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        html {
            height: 100%;
        }

        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #mapa-mka {
            height: 100%;
            width: 100%;
        }
    </style>
    <script type="text/javascript" src="scripts/leaflet.js"></script>
</head>
<body>
<div id="mapa-mka"/>

<script type="text/javascript">
    var sistema_mapa = L.map('mapa-mka', {
        zoomControl: false
    });

    sistema_mapa.setView([-7.8330698,-34.9069011], 13);

    var camada_mapa = L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Open Database Licence <a href="http://openstreetmap.org"> &copy; contribuidores do OpenStreetMap </a>'
    });

    var camada_satelite = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        maxZoom: 18,
        attribution: 'Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });

    camada_mapa.addTo(sistema_mapa);

    L.control.zoom({
        zoomControl: true,
        zoomInTitle: 'Aumentar',
        zoomOutTitle: 'Diminuir',
        position: 'bottomright'
    }).addTo(sistema_mapa);

    var baseLayers = {
        "Mapa": camada_mapa,
        "Satelite": camada_satelite
    };

    L.control.layers(baseLayers, null, {collapsed: false, position: 'topleft'}).addTo(sistema_mapa);

    sistema_mapa.on('click', retCoords);

    function retCoords(e) {
        var latitude = Math.round(e.latlng.lat * 10000000) / 10000000;
        var longitude = Math.round(e.latlng.lng * 10000000) / 10000000;
        var coords = latitude + ',' + longitude;
        self.opener.jQuery('#coordenadas').val(coords);
        window.close();
    }
</script>
</body>
</html>