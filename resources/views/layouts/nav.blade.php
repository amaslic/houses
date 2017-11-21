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
                                    <a id="start1"  onclick="start();" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                                        <form class="form-inline ml" method="POST" action="starttime">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="" id="start"></input> 

                                            <i onclick="start();" style="color:green!important;    font-size: 26px;" class="fa fa-clock-o" id="start" aria-hidden="true"></i>
                                            <button type="submit" style="display:none;" id="start"></button>
                                            
                                            {{--  <button id="reset">Reset</button>  --}}

                                        </form>
                                    </a>

                                    @else

                                    <a id="stop1"  onclick="stop();" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                        <form class="form-inline ml" method="POST" action="stoptime">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="" id="stop"></input> 

                                            <i onclick="stop();" style="color:red!important;    font-size: 26px;" id="start" class="fa fa-clock-o" aria-hidden="true"></i>

                                            <button type="submit" id="stop" style="display:none;"></button>
                                            
                                            {{--  <button id="reset">Reset</button>  --}}

                                        </form>

                                        

                                    </a>
                                    @endif
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
</script>
           