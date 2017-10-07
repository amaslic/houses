@include('layouts.header')
@include('layouts.nav')




<div class="container-main">

   <!-- <div id="map-canvas" style="width: 620px;
    height: 480px; padding-top: 150px;" ></div>-->
    <div id="map" style="width: 620px;
    height: 480px; padding-top: 150px;" ></div>
     <select>
        @foreach($users as $user)
            <option name="{{$user->id}}">
                {{$user->name}} ({{$user->email}})
            </option>
        @endforeach
    </select>
    <div>
        Color: <input class="jscolor color-picker" value="ab2567">
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){

      

        initMap = function () {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });

        function rgb2hex(rgb) {
            rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
            function hex(x) {
                return ("0" + parseInt(x).toString(16)).slice(-2);
            }
            return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
        }

        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
          },
          markerOptions: {icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'},
          circleOptions: {
            fillColor: rgb2hex($(".color-picker").css("backgroundColor")),
            fillOpacity: 1,
            strokeWeight: 5,
            clickable: false,
            editable: true,
            zIndex: 1
          }
        });
        drawingManager.setMap(map);
        alert( rgb2hex($(".color-picker").css("backgroundColor")));
      }

/*       var poly;
        var map;
        var image = {
            url: "https://maps.gstatic.com/mapfiles/ms2/micons/red.png",
            size: new google.maps.Size(1, 1),
        };
        var lineCoords = [];
       
        

        initialize = function () {
            var mapOptions = {
            zoom: 2,
            center: new google.maps.LatLng(15,0),
            draggableCursor: 'pointer',
            draggingCursor: 'pointer',
            panControl: false
        };
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var polyOptions = {
            strokeColor: '#000000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
            fillColor: "#000000"
        };
        poly = new google.maps.Polyline(polyOptions);
        google.maps.event.addListener(map, 'click', addLatLng);
        }
        google.maps.event.addDomListener(window, 'load', initialize);



        addLatLng = function(event) {
            poly.setMap(map);
            var path = poly.getPath();
            path.push(event.latLng);
            var marker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                title: 'Test Title',
                icon: image
            });
            var markerLat = (event.latLng.lat()).toFixed(6);
            var markerLng = (event.latLng.lng()).toFixed(6);
            lineCoords.push(markerLat, markerLng);

            console.log(lineCoords);

            console.log("Lat: " + markerLat + " Lng: " + markerLng)
               
        } */
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM&libraries=drawing&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



