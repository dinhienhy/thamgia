<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
    var myCenter=new google.maps.LatLng(<?php echo $data['lat']; ?>,<?php echo $data['long'] ?>);
    
    function initialize()
    {
    var mapProp = {
      center:myCenter,
      zoom:16,
      mapTypeId:google.maps.MapTypeId.ROADMAP
      };
    
      map = new google.maps.Map(document.getElementById("view-googleMap"),mapProp);
    
      var marker=new google.maps.Marker({
        position:myCenter,
      });
      marker.setMap(map);
      var infowindow = new google.maps.InfoWindow({
        content:"<?php echo $data['address']; ?>"
      });
      infowindow.open(map,marker);
    }
    google.maps.event.addDomListener(window, 'load', initialize);    
</script>
<h2 class="title title-center"><?php echo $data['title']; ?></h2>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="view-googleMap" style="width:100%;height:380px;"></div>
    </div>
</div>