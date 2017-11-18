@include('layouts.header')
@include('layouts.nav')
<div class="container-main">
   <!-- BEGIN CONTENT BODY -->
   <div class="content-wrapper container">
      <!-- BEGIN CONTENT BODY -->
      <div class="row" style="">
         <div class="col-sm-12">
            <div class="page-title">
               <h4 class="float-left">Reports</h4>
               <ol class="breadcrumb float-left float-md-right">
                  <li class="breadcrumb-item"><span style="font-size:15px;">TOTAL: {{$totalsalescount}}</span></li>
                  <li class="breadcrumb-item"><span style="font-size:15px;">{{$totalsalessum}}$</span></li>
               </ol>
            </div>
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header">
                  Today
               </div>
               <div class="card-block text-xs-center">
                  <i class="fa fa-flag fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$todaysalescount}}</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
               <div class="card-block text-xs-center">
                  <i class=" fa fa-dollar fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$todaysalessum}}$</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- End .panel --> 
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header">
                  Last Week
               </div>
               <div class="card-block text-xs-center">
                  <i class="fa fa-flag fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastweeksalescount}}</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
               <div class="card-block text-xs-center">
                  <i class=" fa fa-dollar fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastweeksalessum}}$</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- End .panel --> 
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header">
                  Last Month
               </div>
               <div class="card-block text-xs-center">
                  <i class="fa fa-flag fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastmonthsalescount}}</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
               <div class="card-block text-xs-center">
                  <i class=" fa fa-dollar fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastmonthsalessum}}$</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- End .panel --> 
         </div>
         <div class="col-md-3 col-lg-3">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header">
                  Last Year
               </div>
               <div class="card-block text-xs-center">
                  <i class="fa fa-flag fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastyearsalescount}}</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
               <div class="card-block text-xs-center">
                  <i class=" fa fa-dollar fa-4x"></i> 
                  <h3 class="right panel-middle margin-b-0">{{$lastyearsalessum}}$</h3>
                  </br>
                  <div class="clearfix"></div>
               </div>
            </div>
            <!-- End .panel --> 
         </div>
         <div class="col-md-6 col-lg-6">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header" style="padding-bottom:20px;">
                  Report Per User
                  <div class="col-md-3 right">
                     <form class="form-horizontal" action="reportperuser " method="post">
                        {{ csrf_field() }}
                        <select class="form-control" name="peruser" onchange="this.form.submit(null)" style="width:140px;">
                           <option value="null">Select User</option>
                           @foreach($users as $user)
                           <option value="{{$user->id}}">{{$user->name}}</option>
                           @endforeach
                        </select>
                     </form>
                  </div>
               </div>
               <div class="card-block text-xs-center">
                  <h3>{{$perusername}}</h3>
                  <hr style="border-top:1px solid #4c4c4c;">
                  <p class="reportfont">Sales Today: <b>{{$salestodayperuser}}</b></p>
                  <p class="reportfont">Sales Last Week: <b>{{$saleslastweekperuser}}</b></p>
                  <p class="reportfont">Sales Last Month: <b>{{$saleslastmonthperuser}}</b></p>
                  <p class="reportfont">Sales Last year: <b>{{$saleslastyearperuser}}</b></p>
                  <p class="reportfont">Total: <b>{{$totalsalesperuser}}</b></p>
               </div>
            </div>
            <!-- End .panel --> 
         </div>

            <div class="col-md-6 col-lg-6">
            <div class="panel panel-card recent-activites">
               <!-- Start .panel -->
               <div class="card-header" style="padding-bottom:20px;">
                  Report Per Hour
                  <div class="col-md-3 right">
                     <form class="form-inline" action="reportperhour " method="post">
                        {{ csrf_field() }}
                        <select class="form-control" name="peruserhour" onchange="" style="width:140px;">
                           <option value="null">Select User</option>
                           @foreach($users as $user)
                           <option value="{{$user->id}}">{{$user->name}}</option>
                           @endforeach
                        </select>
                    
                  </div>
               </div>
               <div class="card-block text-xs-center">
                Please select date and time range.
                     <div class="form-inline">
                        <div class="form-group">
                            
                            <input type="date" class="form-control" name="date" id="date">
                        </div>
                        <div class="form-group" style="margin-left:30px;margin-right:5px;">
                        
                            <input type="time" class="form-control"  name="firsttime" id="time" value="01:00">
                        </div> - 
                        <div class="form-group" style="margin-left:5px;" >
                        
                            <input type="time" class="form-control" name="secondtime"id="time"  value="23:59">
                        </div>
                        
                        <div class="form-group" style="margin-left:30px;" >
                        
                        <button type="submit" class="btn btn-warning">Report</button>
                        </div>
                       </div> 
                    </form>
                    
                  
               </div>
                <div class="card-block text-xs-center">
                  <h3>{{$peruserhour2}}</h3>
                  <hr style="border-top:1px solid #4c4c4c;">
                  <p class="reportfont">Markers : <b>{{$countmarkersperuser}}</b></p>
                 
               </div>
            </div>
            <!-- End .panel --> 
         </div>
        
      </div>
   </div>
</div>
@include('layouts.footer')