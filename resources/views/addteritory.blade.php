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
    
    <div id="map"></div>

    <button type="button" id="modal" class="btn btn-secondary" style="display:none;" data-toggle="modal" data-target="#myModal"> Launch demo modal</button>
    <div  class="modal fade" name="markers" id="myModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header text-center">
            <h4 class="modal-title">Create territory</h4>
         </div>
         <div class="modal-body">
            <div class="row ">
               <div class="col-md-12">
                  <form class="form-horizontal" method="POST" id="addTerritory" action="createTerritory">
                     {{ csrf_field() }}
                     <input type="hidden" name="ltdlng" id="ltdlng" />
                     
                     <fieldset>
                        <!-- Form Name -->
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-user "></i></span>
                                    <select name="user_id">
                                        @foreach($users as $user)
                                            <option name="{{$user->id}}" value="{{$user->id}}">
                                                {{$user->name}} ({{$user->email}})
                                            </option>
                                        @endforeach
                                    </select>  
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-paint-brush"></i></span>
                                    <input  class="jscolor color-picker form-control" value="ab2567" name="color">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                                    <textarea  class="form-control" value="ab2567" name="description"> </textarea>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-warning pull-right">Add territory <span class="glyphicon glyphicon-send"></span></button>
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

</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


<script type="text/javascript">

    $(document).ready(function(){
        var lineCoords = [];

       

        initMap = function () {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8,
     
        });

       var color = rgb2hex($(".color-picker").css("backgroundColor"));

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
          polygonOptions: { 
           // fillColor: color,
            strokeWeight: 3,
           // strokeColor: color,
            clickable: true,
            editable: true,
            zIndex: 1
          }
        });

        drawingManager.setMap(map);

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
                    clickable: true,
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

        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            drawingManager.setDrawingMode(null);
            var arr = [];
            polygon.getPath().forEach(function(latLng){arr.push(JSON.stringify(latLng));})
            lineCoords.push( arr  );
            drawingManager.setOptions({fillColor: "black"});
            $( "#ltdlng" ).val( lineCoords );

           // alert($( "#ltdlng" ).val() + " " + color);
           // $( "#addTerritory" ).submit();
           document.getElementById("modal").click();
        });

        

      }
  initMap();
    });
         
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM&libraries=drawing&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



