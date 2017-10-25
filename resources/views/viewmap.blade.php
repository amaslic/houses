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

       
        var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
            drawingModes: ['polygon']
          },
         
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



        

      }

    

  initMap();
    });
         
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM&libraries=drawing,places&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



