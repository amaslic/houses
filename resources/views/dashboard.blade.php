@include('layouts.header')
@include('layouts.nav')
<div class="container-main">
   <!-- BEGIN CONTENT BODY -->
   <div class="content-wrapper container">
    <!-- BEGIN CONTENT BODY -->
                
                        {{--  <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">

                                    <h4 class="float-left">Reports</h4>


                                    <ol class="breadcrumb float-left float-md-right">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);"><i class="fa fa-home"></i></a></li>
                                        <li class="breadcrumb-item">Tabs</li>
                                    </ol>

                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <div class="row margin-b-30">
                            <div class="col-md-6">
                                <div class="tabs-container">
                                    <ul class="nav nav-pills nav nav-tabs">
                                        <li class="nav-item">
                                            <a data-toggle="tab" href="#tab-1" aria-expanded="true" class="nav-link active"> Today</a></li>
                                        <li class="nav-item"><a data-toggle="tab" href="#tab-2" aria-expanded="false" class="nav-link">Last Week</a></li>
                                        <li class="nav-item"><a data-toggle="tab" href="#tab-3" aria-expanded="false" class="nav-link">Last Month</a></li>
                                        <li class="nav-item"><a data-toggle="tab" href="#tab-4" aria-expanded="false" class="nav-link">Last Year</a></li>
                                    
                                    </ul>
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <div class="panel-body  p-xl-3">
                                                <strong>Today</strong>
                                                    <p>Total Sales Today:{{$todaysalescount}}<p>
                                                   <p>Earn:{{$todaysalessum}}$</p>
                                                
                                            </div>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <div class="panel-body  p-xl-3">
                                               <strong>Last Week</strong>
                                                    <p>Total Sales in Last Week:{{$lastweeksalescount}}<p>
                                                      <p>Earn:{{$lastweeksalessum}}$</p>
                                            </div>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <div class="panel-body  p-xl-3">
                                               <strong>Last Month</strong>
                                                    <p>Total Sales in Last Month:{{$lastmonthsalescount}}<p>
                                            </div>
                                        </div>
                                         <div id="tab-4" class="tab-pane">
                                            <div class="panel-body  p-xl-3">
                                               <strong>Last Year</strong>
                                                    <p>Total Sales in Last Year:{{$lastyearsalescount}}<p>
                                            </div>
                                        </div>
                                    </div>
                                    


                                </div>
                            </div>
                    </div>  --}}
                   
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
                                        <i class="fa fa-flag fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$todaysalescount}}</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class=" fa fa-dollar fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$todaysalessum}}$</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                </div><!-- End .panel --> 
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                       Last Week
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class="fa fa-flag fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastweeksalescount}}</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class=" fa fa-dollar fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastweeksalessum}}$</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                </div><!-- End .panel --> 
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                       Last Month
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class="fa fa-flag fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastmonthsalescount}}</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class=" fa fa-dollar fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastmonthsalessum}}$</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                </div><!-- End .panel --> 
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="card-header">
                                       Last Year
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class="fa fa-flag fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastyearsalescount}}</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                    <div class="card-block text-xs-center">
                                        <i class=" fa fa-dollar fa-4x"></i> <h3 class="right panel-middle margin-b-0">{{$lastyearsalessum}}$</h3></br>
                                       
                                        
                                        <div class="clearfix"></div>
                                       
                                    </div>
                                </div><!-- End .panel --> 
                            </div>
                </div>
  </div>   
</div>
@include('layouts.footer')