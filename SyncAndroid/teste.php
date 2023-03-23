<!DOCTYPE html>
<html>
    <head>

        <title>Custom Icons Tutorial - Leaflet</title>

        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="shortcut icon" type="image/x-icon" href="docs/images/favicon.ico" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>

        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            #map {
                width: 600px;
                height: 400px;
            }
        </style>

    </head>
    <body>

        <div id='map'></div>

        <script>
            var marker = null;

            var mbAttr = 'Map data &copy OpenStreetMap contributors, CC-BY-SA, Imagery © Mapbox';
            var mbUrl = 'https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
            var streets_satellite = L.tileLayer(mbUrl, {id: 'mapbox.streets-satellite', attribution: mbAttr});
            var mymap = L.map('map', {center: [-14.861577, -40.844505],
                zoom: 9,
                layers: [streets_satellite]});
            var LeafIcon = L.Icon.extend({options: {iconSize: [38, 95]}});
            var pin_blue = new LeafIcon({iconUrl: '../Templates/imgs/pin_blue.svg'}),
                    pin_green = new LeafIcon({iconUrl: '../Templates/imgs/pin_green.svg'}),
                    pin_red = new LeafIcon({iconUrl: '../Templates/imgs/pin_red.svg'}),
                    pin_yellow = new LeafIcon({iconUrl: '../Templates/imgs/pin_yellow.svg'}),
                    pin_white = new LeafIcon({iconUrl: '../Templates/imgs/pin_white.svg'}),
                    pin_lavender = new LeafIcon({iconUrl: '../Templates/imgs/pin_lavender.svg'}),
                    pin_pink = new LeafIcon({iconUrl: '../Templates/imgs/pin_pink.svg'}
                    );


            <?php
            require_once '../Libs/php/Conect.class.php';
            include_once '../Modulos/Supervisor/MarkerpropCidades.php'; ?>
        </script>



    </body>
</html>