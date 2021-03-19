<html>
<head>
<link href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.0.0-beta.2.rc.2/leaflet.js"></script>
<style>
#map {
  height: 400px;
}
</style>
</head>
<body>

<div class="row">
        <div class="col-lg-12 my-3">
            <div class="pull-right">
                <h1><center>View Maps</center></h1>
            </div>
        </div>
    </div> 
   
<div id="map"></div>
<?php // print_r($locations); ?>

<script>
// Create the map
var map = L.map('map').setView([11.127122499999999, 78.6568942], 3);

@foreach($locations as $location)
L.marker([{{$location->latitude}}, {{$location->longitude}}]).addTo(map)
    .bindPopup('{{$location->address}} <br>')
    .openPopup();

@endforeach


// Set up the OSM layer
L.tileLayer(
  'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
  }).addTo(map);
  
// add a marker in the given location
//L.marker(center).addTo(map);
</script>
</body>
</html>