<div id="wrapper">

            <!-- BEGIN HEADER -->

            <div class="page-header navbar fixed-top">

                <!-- BEGIN HEADER INNER -->

                <div class="page-header-inner ">

                    <!-- BEGIN LOGO -->

                    <div class="page-logo">

                        <a href="{!! url('home'); !!}"><!--<img src="{{asset ('images/logo.png')}}" alt="absolute admin" class="img-fluid logo-default"/> --><h2 style="color: white; font-weight: 600">Roofbuilders</h2> </a>

                    </div>



                    <div class="menu-toggler sidebar-toggler">

                        <a href="javascript:;" class="navbar-minimalize minimalize-styl-2  float-left "><i class="fa fa-bars"></i></a>

                    </div>

                    <!-- END LOGO -->



                    <!-- BEGIN TOP NAVIGATION MENU -->

                    <div class="top-menu">

                        <ul class="nav navbar-nav float-right">

                            <!-- BEGIN NOTIFICATION DROPDOWN -->

                           

                                 @if (Auth::user()->isAdmin())

                                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                        <i class="fa fa-user"></i>

                                    </a>

                                    <ul class="dropdown-menu animated flipInX">

                                        <li>  

                                            <ul class="dropdown-menu-list scroller" data-handle-color="#637283">

                                                <li>

                                                    <a href="{!! url('registers'); !!}"><span class="details">

                                                                <span class="label label-sm label-icon label-success">

                                                                    <i class="fa fa-plus"></i></span>Add New User</span>

                                                    </a>

                                                </li>

                                                <li>

                                                    <a href="{!! url('userlist'); !!}">

                                                        

                                                            <span class="details">

                                                                <span class="label label-sm label-icon label-info">

                                                                    <i class="fa fa-list"></i>

                                                                </span>User List</span>

                                                    </a>

                                                </li>

                                            </ul>

                                        </li>

                                    </ul>

                                </li>

                                 @endif

                                 @if (Auth::user()->isAdmin())

                                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <i class="fa fa-map-o"></i>
                                    </a>

                                <ul class="dropdown-menu animated flipInX">

                                    <li>  <ul class="dropdown-menu-list scroller" data-handle-color="#637283">

                                            <li>

                                                <a href="{!! url('addteritory'); !!}">

                                                   

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-success">

                                                            <i class="fa fa-plus"></i>

                                                        </span>Add Teritory</span>

                                                </a>

                                            </li>

                                            <li>

                                                <a href="{!! url('viewmap'); !!}">

                                                   

                                                    <span class="details">

                                                        <span class="label label-sm label-icon label-info">

                                                            <i class="fa fa-map"></i>

                                                        </span>View Active Territories</span>

                                                </a>

                                            </li>

                                            

                                            

                                        </ul>

                                    </li>

                                </ul>

                            </li>

                                 @endif

                                @if (Auth::user()->isAdmin())

                                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

                                <a href="{!! url('pins'); !!}" class="dropdown-toggle"  data-close-others="true">

                                    <i class="fa fa-map-marker"></i>

                                    

                                </a>

                                </li>

                                @endif

                               

						

							   
                                <li class="dropdown dropdown-quick-sidebar-toggler">

                                <a href="{!! url('logout'); !!}" class="dropdown-toggle">

                                    <i class="icon-logout"></i>

                                </a>

                                </li>
							   	@if(Auth::user()->isUser())
                                <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">

                                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                        <i class="fa fa-list"></i>
                                    </a>
                                
                                    @if($status===0)
                                    <a href="{!! url('starttime'); !!}"  class="dropdown-toggle" >

                                      
                                            <i  style="color:#4caf50!important;    font-size: 26px;" class="fa fa-clock-o" id="start" aria-hidden="true"></i>
                                          
                                            
                                            {{--  <button id="reset">Reset</button>  --}}

                                        </form>
                                    </a>

                                    @else

                                    <a href="{!! url('stoptime'); !!}"   class="dropdown-toggle stop-form" >
                                     

                                            <i  style="color:#ff5722!important;    font-size: 26px;" id="start" class="fa fa-clock-o" aria-hidden="true"></i>

                                       

                                        </form>

                                        

                                    </a>
                                    @endif
                                    <li>
                                    <form action="addpath" method="post" class="path-form">
                                    {{ csrf_field() }}
                                    <input name="date" id="date" type="hidden" />
<input name="coords" id="coords" type="hidden" />
                                        <button>Add path</button>
                                    </form>
                    </li>
                                <ul class="dropdown-menu animated flipInX">

                                    <li>  <ul class="dropdown-menu-list scroller" style="overflow-y: scroll;
    height: 400px;" data-handle-color="#637283">
                                      
                                   
                                        @foreach($territory as $userter)
                                            <li  >
                                                <a id="{{$userter->id}}" href="/gotomap/{{$userter->id}}">
                                                     
                                                      <span class="details">

                                                        <span class="label label-sm label-icon label-info">

                                                            <i class="fa fa-map-marker"></i>

                                                        </span>{{$userter->address}}</span>
                                                    
                                                </a>
                                                
                                            </li>
                                        @endforeach
                                        </ul>
                                    </li>
                            @endif
                            <!-- END QUICK SIDEBAR TOGGLER -->

                        </ul>

                    </div>

                    <!-- END TOP NAVIGATION MENU -->

                </div>

                <!-- END HEADER INNER -->

          

            </div>

            <!-- END HEADER -->

</div>





<script>
    function start(){
        
        document.getElementById("start").click();
    }

    function stop(){
        
        document.getElementById("stop").click();
        
    }

      var watchID = null;
$(document).ready(function(){
	var optn = {
enableHighAccuracy: true,
			timeout: Infinity,
			maximumAge: 0	
		};
	if( navigator.geolocation )
	 navigator.geolocation.watchPosition(success, fail, optn);
	else
	 $("p").html("HTML5 Not Supported");
$("#button").click(function(){
 
	if(watchID)
	 navigator.geolocation.clearWatch(watchID);
 
	watchID = null;
	return false;
});
 
});
 

var q = [
        ];

        var path = [];

function success(position)
{
	var googleLatLng = new google.maps.LatLng(position.coords.latitude, 
						position.coords.longitude);
	var mapOtn={
zoom:9,
center:googleLatLng,
mapTypeId:google.maps.MapTypeId.ROAD
	};
 
	/*var Pmap=document.getElementById("map");
 
	var map=new google.maps.Map(Pmap, mapOtn);
*/
    var i = 0;
    var gpsCoords = [];

    if(localStorage.getItem("gpsCoords") == null)
        localStorage.setItem('gpsCoords', JSON.stringify(q));
    else
        localStorage.setItem('gpsCoords', JSON.stringify(JSON.parse(localStorage.getItem("gpsCoords"))));

    window.setInterval(function(){
   
         
            var y1 = position.coords.latitude-Math.random() * (0.2 - 0.122) + 0.122;
            var y = position.coords.longitude-Math.random() * (0.2 - 0.122) + 0.122;
            /*var y1 = position.coords.latitude;
            var y = position.coords.longitude;*/
            var x =  gpsCoords.push("{lat:"+y1+","+"lng:"+y+"}");
            //localStorage.setItem('gpsCoords', JSON.stringify(q));
        
       
        i++;
      

        //$( ".container" ).append( gpsCoords +"<br>");
     
        var q = JSON.parse(localStorage.getItem("gpsCoords"));
        
        q.push({lat: y1, lng: y});

       

    
        console.log(q);

       // if(localStorage.getItem("gpsCoords") != null){
            
        //}
       

        localStorage.setItem('gpsCoords', JSON.stringify(q));
        /*
        var flightPath = new google.maps.Polyline({
          path: b,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
*/

/*
        var polylineLength = 0;
            for (var i = 0; i < q.length; i++) {
            var lat = parseFloat(q[i].lat);
            var lng = parseFloat(q[i].lng);
            var pointPath = new google.maps.LatLng(lat,lng);
            path.push(pointPath);
            if (i > 0) polylineLength += google.maps.geometry.spherical.computeDistanceBetween(path[i], path[i-1]);

            }

            */
          
            //$( ".containerM" ).append( polylineLength +"m<br>");

            /* $.ajax({
                type: "POST",
                'dataType' : 'json', 
                url:',
                data: {title: title, body: body, published_at: published_at},
                success: function( msg ) {
                    $("#ajaxResponse").append("<div>"+msg+"</div>");
                }
        });*/
        $('#coords').val(localStorage.getItem("gpsCoords").toString());
}, 5000);


/*
if(localStorage.getItem("gpsCoords") != null){
            var b = JSON.parse(localStorage.getItem("gpsCoords"));
        }
        else
            var b = [];
        
        var flightPath = new google.maps.Polyline({
          path: b,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);
*/
}

var dateObj = new Date();
var month = dateObj.getUTCMonth() + 1; //months from 1-12
var day = dateObj.getUTCDate();
var year = dateObj.getUTCFullYear();

newdate = day + "/" + month + "/" + year;

$('#date').val(newdate);
 
 
function fail(error)
{
	var errorType={
0:"Unknown Error",
1:"Permission denied by the user",
2:"Position of the user not available",
3:"Request timed out"
	};
 
	var errMsg = errorType[error.code];
 
	if(error.code == 0 || error.code == 2){
		errMsg = errMsg+" - "+error.message;
	}
 
	$("p").html(errMsg);
}

/*
$( ".stop-form" ).click(function() {
 $(".path-form").submit();
});
*/
</script>
           