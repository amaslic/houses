@include('layouts.header')
@include('layouts.nav')

<div id="map" class="territoryMap"></div>

<select style="position: relative;
    z-index: 9999;
    top: 50px;">


 @foreach($users as $user)
                   <option>
                      {{$user->name}}
                 </option>
                     @endforeach
        </select>

        <button style="position: relative;
    z-index: 9999;
    top: 150px;">
            Add terrytory
         </button>
<script>
      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });

        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polyline']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          circleOptions: {
            fillColor: '#ffff00',
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
          }
        });
        drawingManager.setMap(map);
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPciwvQ6Ohik4U5LDcFruL8ZEsAZiZRXU&libraries=drawing&callback=initMap"
         async defer></script>

    <style>
        .territoryMap {
            height: 100%;
            z-index: 9999;
            top: 50px;
            max-width: 680px;
            max-height: 520px;
            width: 100%;
        }
    </style>
         
@include('layouts.footer')