<script src="http://maps.google.com/maps/api/js?sensor=false&amp;language=id" type="text/javascript"></script>

 <script type="text/javascript">
var geocoder = new google.maps.Geocoder();

// http://cariprogram.blogspot.com
// nuramijaya@gmail.com

 function initialize() {
  var latLng = new google.maps.LatLng(-5.1694899, 119.4106163);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 12,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

   var marker = new google.maps.Marker({
    position: latLng,
    title: 'Ambarrukmo Plaza Yogyakarta',
    map: map,
    draggable: true
  });

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

       var marker1 = new google.maps.Marker({
  position : pos,
  animation:google.maps.Animation.BOUNCE,
  title : 'lokasi',
  //icon : 'assets/icon.png',
  map : map,
  draggable : true
  });
    map.setCenter(pos);
    /*google.maps.event.addListener(marker1, 'drag', function() {
   updateMarkerPosition(marker1.getPosition());
  });
  updateMarkerPosition(marker1.getPosition())*/  
    }, function() {
      //=handleNoGeolocation(true);
        var marker1 = new google.maps.Marker({
  position : latLng,
  animation:google.maps.Animation.BOUNCE,
  title : 'lokasi',
  //icon : 'assets/icon.png',
  map : map,
  draggable : true
  });
   /*google.maps.event.addListener(marker1, 'drag', function() {
   updateMarkerPosition(marker1.getPosition());
  });
  updateMarkerPosition(marker1.getPosition())*/
    });
  } else {
    // Browser doesn't support Geolocation
    //=handleNoGeolocation(false);
     var marker1 = new google.maps.Marker({
  position : latLng,
  animation:google.maps.Animation.BOUNCE,
  title : 'lokasi',
  //icon : 'assets/icon.png',
  map : map,
  draggable : true
  });
   /*google.maps.event.addListener(marker1, 'drag', function() {
   updateMarkerPosition(marker1.getPosition());
  });
  updateMarkerPosition(marker1.getPosition())*/
  }

 }

 // Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>

 <style>
  #mapCanvas {
    width: 800px;
    height: 600px;
    float: left;
  }
</style>
<br />
<div id="mapCanvas"></div>