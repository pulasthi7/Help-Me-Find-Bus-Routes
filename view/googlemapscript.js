// JavaScript Document


  var myLatlng = new google.maps.LatLng(6.871154274048345,80.015803037109375); 
var myOptions = {
zoom: 10,
center: myLatlng,
mapTypeId: google.maps.MapTypeId.ROADMAP
}
map = new google.maps.Map(document.getElementById("map"), myOptions);

//map.height=200;
//map.width=336;

var marker;
var markersArray = [];


//google.maps.event.addListener(map, 'center_changed', function() {
//var location = map.getCenter();
//});

google.maps.event.addListener(map, "click", function(event) {
     //marker.setMap(null);
document.getElementById("latitude").value = event.latLng.lat();
document.getElementById("longitude").value = event.latLng.lng();

placeMarker(new google.maps.LatLng(event.latLng.lat(),event.latLng.lng()));

    });
    
    function placeMarker(location){
   
        
        marker=new google.maps.Marker({position:location,map:map,animation: google.maps.Animation.DROP});
        markersArray.push(marker);
       
      
         
    }
    
    
    function setMarker(lng,lat){
        // change map centre
//         alert(lng+"hey"+lat);
//         window.setTimeout(function() {map.panTo(new google.maps.LatLng(lat,lng));
//    }, 3000);
//map.setCenter(new google.maps.LatLng(lat,lng));
//map.setZoom(12);
//map.panTo(new google.maps.LatLng(lat,lng));


//google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
//    window.setTimeout(function() {
//      map.panTo(new google.maps.LatLng(lat, lng));
//    }, 1000);
//  });

        
        //drop a marker
        placeMarker(new google.maps.LatLng(lat,lng));
        
        
    }
    
    
    function clearMarkers(){
       if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
        
    }
    
