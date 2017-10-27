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

        var i = 0;
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
                icon: '/images/{{$location->icon}}',
               
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

       


    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2_-ZK1vYH7btuM7Qoz5anEajPXI5YtiM&libraries=drawing&callback=initMap"
         async defer></script>


         
@include('layouts.footer')



