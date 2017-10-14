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
   
   
   function initialize() {
     var map = new google.maps.Map(document.getElementById('map'), {
       center: {lat: -34.397, lng: 150.644},
       zoom: 8,
       {{--  mapTypeId: 'terrain'  --}}
     });

      var i =  0;
       var z = [];
      @foreach($territory as $t)
  
            q =  '{{$t->ltdlng}}' ;
            var y = q.replace(/&quot;/g, '\"');
           // console.log(y);

             z.push(JSON.parse('['+y+']'));

           // console.log(z);

          

            var infowindow = new google.maps.InfoWindow({
                size: new google.maps.Size(150, 50)
            });

            google.maps.event.addListener(map, 'click', function() {
                infowindow.close();
            });

           
                

                var x = new google.maps.Polygon({
                    path: z[i],
                    strokeColor: '#'+'{{$t->color}}',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#'+'{{$t->color}}',
                    fillOpacity: 0.35,
                   // infowindow: contentString,

                    clickable: false,
                    editable: false
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
            '<p><a href="editpin/{{$location->id}}">Edit Pin</a> | <a href="deletepin/{{$location->id}}">Delete Pin</a></p> '+
             '<p><a href="makesale/{{$location->id}}">Make Sale</a></p> '+

            '</div>'+
            '</div>';
   var infowindow{{$location->id}} = new google.maps.InfoWindow({
          content: contentString
        });
     var location = new google.maps.LatLng{{$location->latlng}};
    
           var marker{{$location->id}} = new google.maps.Marker({
             position: location,
             {{--  label: '{{$location->status}}',  --}}
              map: map,
              icon: '/images/{{$location->icon}}',
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
            
           
         }
   
   google.maps.event.addDomListener(window, 'load', initialize);
</script>
<div id="map"></div>
<button type="button" id="modal" class="btn btn-secondary" style="display:none;" data-toggle="modal" data-target="#myModal"> Launch demo modal</button>
</form>
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
                     <input type="hidden" name="latlng" id="latlng"></input>
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
@include('layouts.footer')