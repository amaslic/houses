@include('layouts.header')
@include('layouts.nav')


<style>
    body, html {
    height: 100%;
    width: 100%;
    }
    .modal{
        z-index: 999;
    }
    .modal-backdrop{
        z-index: 990;
    }
    .modal-dialog{
        padding-top: 150px;
    }
    #map{

        min-height: 884px;
        height: 100%;
    }
</style>

<div class="container-main">
    <div class="pac-card" id="pac-card">
      <div>
        <div id="title">
            Search by address
        </div>
        <div id="type-selector" class="pac-controls">
          <input type="radio" name="type" id="changetype-all" checked="checked">
          <label for="changetype-all">All</label>

          <input type="radio" name="type" id="changetype-establishment">
          <label for="changetype-establishment">Establishments</label>

          <input type="radio" name="type" id="changetype-address">
          <label for="changetype-address">Addresses</label>

          <input type="radio" name="type" id="changetype-geocode">
          <label for="changetype-geocode">Geocodes</label>
        </div>
        <div id="strict-bounds-selector" class="pac-controls">
          <input type="checkbox" id="use-strict-bounds" value="">
          <label for="use-strict-bounds">Strict Bounds</label>
        </div>
      </div>
      <div id="pac-container">
        <input id="pac-input" type="text"
            placeholder="Enter a location">
      </div>
    </div>
  
    
   
    <input type="text" id="pathm" disabled style="position: absolute; top: 50px; left: 350px; z-index: 9999;" />
    <div id="map"></div>
    <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
    </div>




</div>

<div class="container">
    <div class="" id="">
      <div>
        
      </div>
      <div id="">
        
      </div>
    </div>
    
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script  data-cfasync="false">


     var path = [];
        var lineCoords = [];
        initMap = function () {
        var map = new google.maps.Map(document.getElementById('map'), {
          //center: {lat:  38.89103282648846, lng: -90.703125},
          center: {lat: 45.265943945811614, lng: 18.059984987923727},
          zoom: 13,
         
        });

         var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        autocomplete.addListener('place_changed', function() {
        //  infowindow.close();
         // marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          // If the place has a geometry, then present it on a map.
          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          }
          //marker.setPosition(place.geometry.location);
          //marker.setVisible(true);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

         /* infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);*/
        });

        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });

        var i = 0;
        var z = [];
        var polylineLength = 0;
        @foreach($path as $t)
  
        q =  '{{$t->coords}}';
        var y = q.replace(/&quot;/g, '\"');
        var m = y.replace(/[[]]/g , ''); 
      //  var n = m.replace("]", "");
        z.push(JSON.parse(m));
           console.log(z[i]);

          // alert(z[i].toString());
           
            var flightPath = new google.maps.Polyline({
                path: z[i],
                geodesic: true,
                strokeColor: '#FF0000',
                strokeOpacity: 1.0,
                strokeWeight: 2
              });
           
              flightPath.setMap(map);

              
            for (var pp = 0; pp < z[i].length; pp++) {
             
            var lat = parseFloat(z[i][pp].lat);
            var lng = parseFloat(z[i][pp].lng);
            //console.log(lat);
            //console.log(lng);
            var pointsPath = new google.maps.LatLng(lat,lng);
           // console.log(pointsPath);
            path.push(pointsPath);
            //console.log(path);
            if(pp > 0) polylineLength += google.maps.geometry.spherical.computeDistanceBetween(path[pp], path[pp-1]);

            }
            //console.log(polylineLength);
            var km = polylineLength*0.001*0.621371192;
            $("#pathm").val(parseFloat(km).toFixed(2)+" miles");
          i++;
   // console.log(z[0].length);
          
        @endforeach 

   

      }

    initMap();
</script>
<script  data-cfasync="false" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAAKddZzBqbk8aba9FhoWo22G3NyuJ85o&libraries=drawing,places,geometry&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



