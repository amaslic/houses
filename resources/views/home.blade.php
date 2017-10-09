
@include('layouts.header')
@include('layouts.nav')
<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 97%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?keyAIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM"></script>
    <script>
      // In the following example, markers appear when the user clicks on the map.
      // Each marker is labeled with a single alphabetical character.
      var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var labelIndex = 0;

      function initialize() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8,
          {{--  mapTypeId: 'terrain'  --}}
        });
        
 @foreach($locations as $location)
        var location = new google.maps.LatLng{{$location->latlng}};
              var marker = new google.maps.Marker({
                position: location,
                label: '{{$location->status}}',
                 map: map,
    });
     marker.setMap(map);
      
    @endforeach
        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(event) {
          addMarker(event.latLng, map);
        });

        {{--  // Add a marker at the center of the map.
        addMarker(bangalore, map);  --}}
        
      }
      

      // Adds a marker to the map.
      function addMarker(location, map) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.
         {{--  document.getElementById("markers").style.display = "block";  --}}
         document.getElementById("modal").click();
        var marker = new google.maps.Marker({
          position: location,
          {{--  label: labels[labelIndex++ % labels.length],  --}}
          map: map

        });
       
        document.getElementById("latlng").value= marker.getPosition();
        
        
      }
        function marker(clicked_id)
            {
                document.getElementById("marker").value= clicked_id;
                document.getElementById("addmarker").click();
              
            }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
   
  
  
    <div id="map"></div>
    <form action="addmarker" method="post">
     {{ csrf_field() }}
    <input type="hidden" name="latlng" id="latlng"></input>
     <input type="hidden" name="marker" id="marker"></input>
    <button type="submit" style="display:none;" name="addmarker"  id="addmarker"  >add</button>
    <button type="button" id="modal" class="btn btn-secondary" style="display:none;" data-toggle="modal" data-target="#myModal"> Launch demo modal</button>
    </form>
    <div  class="modal fade" name="markers" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    @foreach($pins as $pin)
    <button type="submit" class="pins" value="{{$pin->name}}"  onClick="marker(this.value)">{{$pin->name}}</button>
    @endforeach
   
    </div>
 

                  

@include('layouts.footer')