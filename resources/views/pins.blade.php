@include('layouts.header')
@include('layouts.nav')
<div class="container-main">
    <div class="container">
        <div class="row registerform">
            <div class="col-md-12">
                <div class="panel panel-card recent-activites mm">
                    <!-- Start .panel -->
                    <div class="card-header">
                        Status List
                    </div>
                    <div class="card-block text-xs-center">
                        <div class="table-responsive table-commerce">
                            <div id="basic-datatables_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                            <div class="row">
                                <div class="col-md-6 col-xs-12 ">
                                    <div class="dataTables_length" id="basic-datatables_length"><label></label></div>
                                </div>
                                <div class="col-md-6 col-xs-12">
                                    <div id="basic-datatables_filter" class="dataTables_filter"></div>
                                </div>
                            </div><!--row-->
                            <table id="basic-datatables" class="table table-striped table-hover dataTable no-footer" role="grid" aria-describedby="basic-datatables_info">
                                    <thead>
                                        <tr role="row">
                                            {{--  <th class="w80 sorting_asc" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-sort="ascending" 
                                            style="width: 56px;">
                                            <strong>ID</strong>
                                            </th>  --}}
                                            <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                                            " style="width: 146px;">
                                            <strong>Status Color</strong>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                                            " style="width: 146px;">
                                            <strong>Status Name</strong>
                                            </th>
                                            <th class="sorting" tabindex="0" aria-controls="basic-datatables" rowspan="1" colspan="1" aria-label="
                                            " style="width: 173px;">
                                            <strong>KPI Group</strong>
                                            </th>
                                        </tr>
                                    </thead>
                                <tbody>
                                    @foreach($pin as $pi)
                                    <tr role="row" class="odd">
                                        {{--  <td class="sorting_1">{{$pi->id}}</td>  --}}
                                        <td><img src="images/pins/{{$pi->color}}.png"></td>
                                        <td>{{$pi->name}}</td>
                                        <td>{{$pi->group}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                    <!-- End .panel --> 
                </div>
            </div>
        </div><!--row registerform-->
    </div><!--container-->

        <!--ADD STATUS FORM-->
        <div class="container" style="padding:0;">
            <div class="col-md-12">
                <div class="panel panel-card margin-b-30">
                    <div class="col-sm-12">
                        <div class="card-header card_header">
                            <p><i class="fa fa-folder-open-o" aria-hidden="true"></i> Add Status</p>
                            
                            <a class="btn btn-success btn-clickable right" >
                                <i class="fa fa-chevron-down"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="panel_body">
                        <div class="row">
                            <form class="form-inline ml" method="POST" action="/addpin">
                                {{ csrf_field() }}
                                <div  class="dropdowncolor pp pl pr form-group{{ $errors->has('color') ? ' has-error' : '' }}">
                                    {{--  <label for="color" class="sr-only control-label"></label>  --}}
                                    <select name="color" id="color">
                                        <option value="red" data-image="images/pins/red.png"></option>
                                        <option value="blue" data-image="images/pins/blue.png"></option>
                                        <option value="lightblue" data-image="images/pins/lightblue.png"></option>
                                        <option value="green" data-image="images/pins/green.png"></option>
                                        <option value="yellow" data-image="images/pins/yellow.png"></option>
                                        <option value="orange" data-image="images/pins/orange.png"></option>
                                        <option value="pink" data-image="images/pins/pink.png"></option>
                                        <option value="violet" data-image="images/pins/violet.png"></option>
                                        <option value="gray" data-image="images/pins/gray.png"></option>
                                        <option value="brown" data-image="images/pins/brown.png"></option>
                                    </select>
                                </div>
                                <div class="pp pr form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="sr-only control-label"></label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" placeholder="Status Name" name="name" value="{{ old('name') }}" required autofocus >
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="pp pr form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                                    <label class="sr-only control-label" for="group"></label>
                                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="group" placeholder="KPI Group" name="group" value="{{ old('group') }}" required autofocus >
                                    @if ($errors->has('group'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('group') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="pp  form-group">
                                    <button type="reset" class="btn btn-primary"> Cancel </button>
                                </div>
                                <div class="pp  form-group">
                                    <button type="submit" class="btn btn-primary"> Submit </button>
                                </div>
                            </form>
                        </div>
                    </div><!--panel_body-->
                </div><!--panel panel-card margin-b-30-->
            </div><!--col-md-12-->
        </div><!--container--> 
</div>
<script src="js/msdropdown/msdropd.js" type="text/javascript"></script>
@include('layouts.footer')