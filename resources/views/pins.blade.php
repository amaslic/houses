@include('layouts.header')
@include('layouts.nav')

<div class="container" style="margin-top:100px;">
    <div class="row">
        <div class="panel panel-card margin-b-30">
            <div class="col-sm-12">
                <div class="card-header">
                    
                    <p><i class="fa fa-folder-open-o" aria-hidden="true"></i> Add Status</p>
                    <a class="btn btn-success btn-clickable pull-right" href="#">
                        <i class="fa fa-chevron-down"></i> 
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <form class="form-inline" method="POST" action="/addpin">
                    {{ csrf_field() }}
                    <div class="pp form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="sr-only control-label"></label>
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" placeholder="Status Name" name="name" value="{{ old('name') }}" required autofocus >
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="pp form-group{{ $errors->has('group') ? ' has-error' : '' }}">
                        <label class="sr-only control-label" for="group"></label>
                        <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="group" placeholder="KPI Group" name="group" value="{{ old('group') }}" required autofocus >
                        @if ($errors->has('group'))
                            <span class="help-block">
                                <strong>{{ $errors->first('group') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="pp form-group">
                        <button type="cancel" class="btn btn-primary"> Cancel </button>
                    </div>
                    <div class="pp form-group">
                        <button type="submit" class="btn btn-primary"> Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')