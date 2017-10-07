@include('layouts.header')
@include('layouts.nav')




<div class="container-main">

    <div id="map-canvas" style="width: 620px;
    height: 480px; padding-top: 150px;" ></div>

     <select>
        @foreach($users as $user)
            <option name="{{$user->id}}">
                {{$user->name}} ({{$user->email}})
            </option>
        @endforeach
    </select>
</div>


<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){
        var poly;
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
            strokeWeight: 2
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
               
        }
    });
</script>


         
@include('layouts.footer')



