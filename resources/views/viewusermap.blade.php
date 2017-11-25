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

        var lineCoords = [];
        initMap = function () {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat:  38.89103282648846, lng: -90.703125},
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
          infowindow.close();
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

        @foreach($territory as $t)
  
            q =  '{{$t->ltdlng}}' ;
            var y = q.replace(/&quot;/g, '\"');
             z.push(JSON.parse('['+y+']'));
            var infowindow = new google.maps.InfoWindow({
                size: new google.maps.Size(150, 50)
            });

            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });
  
            if("{{$t->active}}" == 1)
                var x = new google.maps.Polygon({
                    path: z[i],
                    strokeColor: '#98fb98',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#'+'{{$t->color}}',
                    fillOpacity: 0.35,
                   // infowindow: contentString,
                    clickable: true,
                    editable: false
                });
            else
                 var x = new google.maps.Polygon({
                    path: z[i],
                    strokeColor: '#800000',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#'+'{{$t->color}}',
                    fillOpacity: 0.35,
                   // infowindow: contentString,
                    clickable: true,
                    editable: false
                });

            google.maps.event.addListener(x, 'click', function(event) {
                var contentString = "{{$t->description}} <br>";
                 if("{{$t->active}}" == 1)
                  contentString += "<a href='{{ URL::to('deactivateTerritory/'.$t->id) }}'>Deactivate</a>";
                else
                  contentString += "<a href='{{ URL::to('activateTerritory/'.$t->id) }}'>Activate</a>";
                infowindow.setContent(contentString);
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });
            i++;
            x.setMap(map);
          
        @endforeach 

         @foreach($locations as $location)

            var marker = new google.maps.Marker({
                position:  new google.maps.LatLng{{$location->latlng}},
                map: map,
                icon: '../images/{{$location->icon}}',
               
            });

            google.maps.event.addListener(marker, 'click', function(event) {
                var contentString = '<div id="content">'+
                '<div id="siteNotice">'+
                '</div>'+
                '<h3 id="firstHeading" class="firstHeading">{{$location->status}}</h3>'+
                '<div id="bodyContent">'+
                '<p><b>Full Name:</b> {{$location->fullname}} </p>' +
                '<p><b>Email:</b>{{$location->email}} </p> '+
                '<p><b>Phone Number:</b>{{$location->phonenumber}} </p> '+
                '<p><b>Date and Time:</b> </br>{{$location->created_at}} </p> '+
                '<p><b>Comment: </b>{{$location->notes}} </p> '+
                '</div>'+
                '</div>';
                infowindow.setContent(contentString);
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
            });

        @endforeach

      }

    initMap();
</script>
<script  data-cfasync="false" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAAKddZzBqbk8aba9FhoWo22G3NyuJ85o&libraries=drawing,places&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



