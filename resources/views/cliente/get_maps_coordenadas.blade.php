<!DOCTYPE html>
<html lang="en">
    <title>Google Map</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        #map {
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
<div id="latclicked"></div>
<div id="longclicked"></div>

<div id="latmoved"></div>
<div id="longmoved"></div>

<div style="padding:10px">
    <div id="map"></div>
</div>

<script type="text/javascript">
    var map;

    function initMap() {
        var latitude = -7.8330698; // YOUR LATITUDE VALUE
        var longitude = -34.9069011; // YOUR LONGITUDE VALUE

        var myLatLng = {lat: latitude, lng: longitude};

        map = new google.maps.Map(document.getElementById('map'), {
            center: myLatLng,
            zoom: 14,
            disableDoubleClickZoom: true, // disable the default map zoom on double click
        });

        // Update lat/long value of div when anywhere in the map is clicked
        google.maps.event.addListener(map,'click',function(event) {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
            var coords = latitude + ',' + longitude;
            self.opener.jQuery('#coordenadas').val(coords);
            window.close();
        });






        // Create new marker on double click event on the map


        // Create new marker on single click event on the map
        /*google.maps.event.addListener(map,'click',function(event) {
            var marker = new google.maps.Marker({
              position: event.latLng,
              map: map,
              title: event.latLng.lat()+', '+event.latLng.lng()
            });
        });*/
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZB16vnGtmRiSrSSuOV8E_vmWqhj8yqyw&callback=initMap"
        async defer></script>
</body>
</html>