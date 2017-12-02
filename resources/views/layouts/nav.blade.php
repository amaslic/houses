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
                                    <a href="{!! url('starttime'); !!}"  class="dropdown-toggle" id="start">

                                      
                                            <i  style="color:#4caf50!important;    font-size: 26px;" class="fa fa-clock-o"  aria-hidden="true"></i>
                                          
                                            
                                            {{--  <button id="reset">Reset</button>  --}}

                                        </form>
                                    </a>

                                    @else

                                    <a  class="dropdown-toggle stop-form" id="stop">
                                     

                                            <i  style="color:#ff5722!important;    font-size: 26px;"  class="fa fa-clock-o" aria-hidden="true"></i>

                                       

                                        </form>

                                        

                                    </a>
                                    @endif
                                    <li>
                                    <form action="addpath" method="post" class="path-form" style="display:none">
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
    $('#start').click(function(){
     /*   gpsCoords1 = [];
            var y1 = position.coords.latitude;
            var y = position.coords.longitude;
            var qqq =  gpsCoords1.push("{lat:"+y1+","+"lng:"+y+"}");
       // qqq.push(navigator.geolocation.getCurrentPosition());*/
        localStorage.setItem('startPath', 1);
        //localStorage.setItem('gpsCoords', JSON.stringify(qqq).toString());
    });

    $('#stop').click(function(){
        qq = [];
        localStorage.setItem('time', 0);
        localStorage.setItem('startPath', 0);
        localStorage.setItem('gpsCoords', JSON.stringify(qq));
        $('.path-form').submit();
    });

    function start(){
        
        document.getElementById("start").click();
    }

    function stop(){
        
        document.getElementById("stop").click();
        
    }


      var watchID = null;
      if(localStorage.getItem("startPath") == 1){
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
/*$("#button").click(function(){
 
	if(watchID)
	 navigator.geolocation.clearWatch(watchID);
 
	watchID = null;
	return false;
});
 */
});
 



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
    var time = 5000;
    var q = [
        ];

    if(localStorage.getItem("gpsCoords") == null)
        localStorage.setItem('gpsCoords', JSON.stringify(q));
    else
        localStorage.setItem('gpsCoords', JSON.stringify(JSON.parse(localStorage.getItem("gpsCoords"))));

        
        
    window.setInterval(function(){
   
         
           var y1 = position.coords.latitude-Math.random() * (0.2 - 0.122) + 0.122;
            var y = position.coords.longitude-Math.random() * (0.2 - 0.122) + 0.122;
           /*  var y1 = position.coords.latitude;
            var y = position.coords.longitude;*/
            var x =  gpsCoords.push("{lat:"+y1+","+"lng:"+y+"}");
            //localStorage.setItem('gpsCoords', JSON.stringify(q));
           
       
        i++;

       
                //time = 5000;
        
        localStorage.setItem("time", 1);

        var q = JSON.parse(localStorage.getItem("gpsCoords"));
        
        q.push({lat: y1, lng: y});

        localStorage.setItem('gpsCoords', JSON.stringify(q));
      /*  if(localStorage.getItem("time")==0 || localStorage.getItem("time") == null)
            time = 1000;
        else time = 5000;
*/
        localStorage.setItem("time", 1);


        $('#coords').val(localStorage.getItem("gpsCoords").toString());
}, time);
        /*
else{

window.setInterval(function(){      
var y1 = position.coords.latitude-Math.random() * (0.2 - 0.122) + 0.122;
            var y = position.coords.longitude-Math.random() * (0.2 - 0.122) + 0.122;
        
            var x =  gpsCoords.push("{lat:"+y1+","+"lng:"+y+"}");
            //localStorage.setItem('gpsCoords', JSON.stringify(q));
           
       
        i++;

       
                //time = 5000;
        
        localStorage.setItem("time", 1);

        var q = JSON.parse(localStorage.getItem("gpsCoords"));
        
        q.push({lat: y1, lng: y});

        localStorage.setItem('gpsCoords', JSON.stringify(q));
      
        
        $('#coords').val(localStorage.getItem("gpsCoords").toString());
}, 5000);
      }*/
}




 
 
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
      }
</script>
           