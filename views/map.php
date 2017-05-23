<div id="map" style="height: 500px;"></div>
<script>

    function initMap() {

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: <?php echo $customer_coordinates['latitude'] ?>, lng: <?php echo $customer_coordinates['longitude'] ?>}
        });

        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        var markers = locations.map(function (location, i) {
            return new google.maps.Marker({
                position: location,
                label: labels[i % labels.length]
            });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
                {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
    var locations = <?php echo $partners_coordinates?>
</script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBrmCZHnTd3r5Mqd129gXIC6I1rXlEWbKI&callback=initMap"></script>