
@include('layouts.header')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!</br>
                    @if (Auth::user()->isAdmin())
                   <a href="registers"> <button class="btn btn-primary">Register Users</button></a>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@include('layouts.footer')