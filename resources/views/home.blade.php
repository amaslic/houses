@include('layouts.header')
@include('layouts.nav')
<style>
   /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
   #map {
   min-height: 884px;
   height: 100%;
   }
   /* Optional: Makes the sample page fill the window. */
   html, body {
   height: 97%;
   margin: 0;
   padding: 0;
   }
</style>
{{--  <script src="https://maps.googleapis.com/maps/api/js?keyAIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM"></script>  --}}
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

    
    

    {{--  <div class="container">
    <h1>Timer</h1>

    <hr/><h3 style='margin-top:20px;'>Before you start working, run the timer!</h3>
    <span id="stopwatch">00:00:00</span>
    <p>
        <input class='btn btn-primary' type='button' value='Play/Pause' onclick='Example1.Timer.toggle();' />
        <input class='btn btn-primary' type='button' value='Stop/Reset' onclick='Example1.resetStopwatch();' />
    </p>
    </div>  --}}
    <!--END TIMER-->

   <div id="floating-panel">
      <input id="latlng" type="text" style="display:none;"value="40.714224,-73.961452">
      <input id="submit" type="button" style="display:none;" value="Reverse Geocode">
   </div>
   <div id="map"></div>
   <div id="infowindow-content">
      <img src="" width="16" height="16" id="place-icon">
      <span id="place-name"  class="title"></span><br>
      <span id="place-address"></span>
   </div>
   <button type="button" id="modal" class="btn btn-secondary" style="display:none;" data-toggle="modal" data-target="#myModal"> Launch demo modal</button>
   <button type="button"  id="tooltip" class="homerDemo3 btn btn-warning" style="display:none;">ToolTip</button>
   <div id="preloader">
      <div class="inner">
         <span class="loader"></span>
      </div>
   </div>
   <!-- /PRELOADER -->
</div>
<div  class="modal fade" name="markers" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h4 class="modal-title">Choose Marker Status</h4>
         </div>
         <div class="modal-body">
            <div class="row ">
               <div class="col-md-12">
                  <form class="form-horizontal" action="addmarker " method="post">
                     {{ csrf_field() }}
                     <input type="hidden" name="latlng2" id="latlng2"></input>
                     <fieldset>
                        <!-- Form Name -->
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-map-marker "></i></span>
                                 <select class="form-control" name="marker">
                                    @foreach($pins as $pin)
                                    <option value="{{$pin->name}}">{{$pin->name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                 <input name="fullname" placeholder="Full Name" class="form-control" type="text">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <input name="email" placeholder="E-Mail Address" class="form-control" type="text">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                 <input name="phone" placeholder="Mobile No" class="form-control" type="text">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12 inputGroupContainer">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                 <textarea class="form-control" name="notes" placeholder="Notes"></textarea>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-warning pull-right">Add Marker <span class="glyphicon glyphicon-send"></span></button>
                           </div>
                        </div>
                     </fieldset>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>
   // In the following example, markers appear when the user clicks on the map.
   
   // Each marker is labeled with a single alphabetical character.
   
   
   
   
    
   function initMap() {
    var  b = '{{$goto->ltdlng}}';
    var y = b.replace(/&quot;/g, '\"');
           // console.log(y);
             {{--  z.push(JSON.parse('['+y+']'));  --}}
    var ltd = y.split('t').pop().split(',').shift();
    var ldt = ltd.substring(2,50 );
     var lng = y.split(':').pop().split('}').shift();
   
     var map = new google.maps.Map(document.getElementById('map'), {
   
       center: new google.maps.LatLng(ldt, lng),
   
       zoom: 16,
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
      var i =  0;
       var z = [];
   
      @foreach($territory as $t)
            q =  '{{$t->ltdlng}}' ;
            var y = q.replace(/&quot;/g, '\"');
           // console.log(y);
             z.push(JSON.parse('['+y+']'));
           // console.log(z);
           var ltd = y.split('t').pop().split(',').shift();
    var ldt = ltd.substring(2,50 );
     var lng = y.split('g').pop(1).split('}').shift(1);
    var lng = lng.substring(2,50);
    
            {{--  var infowindow = new google.maps.InfoWindow({
   
                size: new google.maps.Size(150, 50)
   
            });  --}}
   
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
                    clickable: false,
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
                    clickable: false,
                    editable: false
                });
                {{--  alert(ldt+lng);  --}}
                 {{--  document.getElementById("{{$t->id}}").innerHTML=ldt+lng;  --}}
   {{--  document.getElementById("latlng").value=ldt+','+lng;  --}}
   
   var geocoder = new google.maps.Geocoder;
        var infowindow = new google.maps.InfoWindow;
   
       
          geocodeLatLng(geocoder, map);
        var input = ldt+','+lng;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              map.setZoom(16);
              {{--  var marker = new google.maps.Marker({
                position: latlng,
                map: map
              });  --}}
              infowindow.setContent(results[0].formatted_address);
              {{--  document.getElementById("{{$t->id}}").innerHTML=results[0].formatted_address;
               document.getElementById("latlng").value='';  --}}
              
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
            document.getElementById("{{$t->id}}").innerHTML=ldt+lng;
          }
        });
   
      
            google.maps.event.addListener(x, 'click', function(event) {
   
                var contentString = "{{$t->description}}";
                infowindow.setContent(contentString);
                infowindow.setPosition(event.latLng);
                infowindow.open(map);
   
            });
   
            i++;
            x.setMap(map);
        @endforeach
   function geocodeLatLng(geocoder, map) {
       
        }
      @foreach($locations as $location)
   
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
            '<p><a href="../editpin/{{$location->id}}">Edit Pin</a> | <a href="../deletepin/{{$location->id}}">Delete Pin</a></p> '+
             '<p><a href="../makesale/{{$location->id}}">Make Sale</a></p> '+
            '</div>'+
            '</div>';
   
    var infowindow{{$location->id}} = new google.maps.InfoWindow({
   
          content: contentString
   
        });
   
    var location = new google.maps.LatLng{{$location->latlng}};
           var marker{{$location->id}} = new google.maps.Marker({
             position: location,
              map: map,
              icon: '../images/{{$location->icon}}',
              infowindow: infowindow{{$location->id}}
   
   });
   
   marker{{$location->id}}.setMap(map);
      marker{{$location->id}}.addListener('click', function() {
          infowindow{{$location->id}}.open(map, marker{{$location->id}});
        });
   @endforeach
   
    google.maps.event.addListener(map, 'click', function(event) {
   
       addMarker(event.latLng, map);
   
     });
   
     {{--  // Add a marker at the center of the map.
   
     addMarker(bangalore, map);  --}}
   }
   // Adds a marker to the map.
   
   function addMarker(location, map) {
      document.getElementById("modal").click();
      var marker = new google.maps.Marker({
       position: location,
       map: map
     });
   
     document.getElementById("latlng2").value= marker.getPosition();
   
   }
   
     function marker(clicked_id)
   
         {
   
             document.getElementById("marker").value= clicked_id;
   
         }
   
   google.maps.event.addDomListener(window, 'load', initMap);
   {{--  document.getElementById("submit").click();  --}}
   
</script>
<script>
   jQuery(function(){
      jQuery('#tooltip').click();
   });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAAKddZzBqbk8aba9FhoWo22G3NyuJ85o&libraries=drawing,places&callback=initMap"
   async defer></script>

  
  
@include('layouts.footer')