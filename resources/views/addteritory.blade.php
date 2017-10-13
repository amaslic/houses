@include('layouts.header')
@include('layouts.nav')




<div class="container-main">



   <!-- <div id="map-canvas" style="width: 620px;
    height: 480px; padding-top: 150px;" ></div>-->
    <div id="map" style="width: 620px;
    height: 480px; padding-top: 150px;" ></div>
    <form method="POST" id="addTerritory" action="createTerritory">
     {{ csrf_field() }}
        <select name="user_id">
            @foreach($users as $user)
                <option name="{{$user->id}}" value="{{$user->id}}">
                    {{$user->name}} ({{$user->email}})
                </option>
            @endforeach
        </select>
        <div>
            Color: <input onchange="changeColor(this.value)" class="jscolor color-picker" value="ab2567" name="color">
        </div>
        <input type="hidden" name="ltdlng" id="ltdlng" />
    </form>

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

        

         changeColor = function(x){
            
         // $(".color-picker").val() = x;
            alert(x)
            return color = "#"+x;
        }
/*
        getColor = function(){
            return color;
        }

        console.log("Changed to: "+color)
       */
       
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

       var c = [];  
       var i =  0;
       var z = [];

        Array.prototype.clear = function() {
    this.splice(0, this.length);
};

        @foreach($territory as $t)

       
             q =  '{{$t->ltdlng}}' ;
            var y = q.replace(/&quot;/g, '\"');
            console.log(y);

             z.push(JSON.parse('['+y+']'));

            console.log(z);

                var x = new google.maps.Polygon({

                    path: z[i],
                    strokeColor: '#'+'{{$t->color}}',
                    strokeOpacity: 0.8,
                    strokeWeight: 2,
                    fillColor: '#'+'{{$t->color}}',
                    fillOpacity: 0.35
                });
           
            i++;
            x.setMap(map);
            c.clear();
        @endforeach
        //console.log(y);
        console.log(z)
        google.maps.event.addListener(drawingManager, 'polygoncomplete', function(polygon) {
            drawingManager.setDrawingMode(null);
            var arr = [];
            polygon.getPath().forEach(function(latLng){arr.push(JSON.stringify(latLng));})
           //polygon.getPath().forEach(function(latLng){arr.push(latLng);})

            //lineCoords.push(arr.join(',\n'));
            lineCoords.push( arr  );
            //console.log(lineCoords);
            drawingManager.setOptions({fillColor: "black"});
            $( "#ltdlng" ).val( lineCoords );

            alert($( "#ltdlng" ).val() + " " + color);
            $( "#addTerritory" ).submit();
        });

        

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



