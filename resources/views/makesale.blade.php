@include('layouts.header')

@include('layouts.nav')

<div class="row registerform container-main">
        <div class="offset-md-3 col-md-6  " >
            <div class="panel panel-card margin-b-30">
                <div class="card-header">Edit Pin</div>

                <div class="panel-body" style="padding-top:5px;">
                    <form class="form-horizontal" action="/submitsale/{{$editpins->id}} " method="post">
                     {{ csrf_field() }}
                     <input type="hidden" name="id" id="id" value="{{$editpins->id}}"></input>
                     <fieldset>
                        <!-- Form Name -->
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-map-marker "></i></span>
                                 <select class="form-control" name="marker">
                                 <option value="Sold">Sold</option>
                                
                                 </select>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                 <input name="fullname" placeholder="Full Name" class="form-control" type="text" value="{{$editpins->fullname}}">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                 <input name="email" placeholder="E-Mail Address" class="form-control" type="text" value="{{$editpins->email}}">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                 <input name="phone" placeholder="Mobile No" class="form-control" type="text" value="{{$editpins->phonenumber}}">
                              </div>
                           </div>
                        </div>
                        <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12 inputGroupContainer">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                 <textarea class="form-control" name="notes" placeholder="Notes" value="{{$editpins->notes}}">{{$editpins->notes}}</textarea>
                              </div>
                           </div>
                        </div>
                       <!-- Text input-->
                        <div class="form-group">
                           <div class="col-md-12">
                              <div class="input-group">
                                 <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                 <input name="price" placeholder="Price" class="form-control" type="text" value="">
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="col-md-12">
                              <button type="submit" class="btn btn-warning pull-right">Submit Sale <span class="glyphicon glyphicon-send"></span></button>
                           </div>
                        </div>
                        
                     </fieldset>
                  </form>
                </div>
            </div>
        </div>
    </div>
            
@include('layouts.footer')