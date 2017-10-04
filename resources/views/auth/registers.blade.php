@include('layouts.header')

@include('layouts.nav')

    <div class="row registerform">
        <div class="offset-md-3 col-md-6  ">
            <div class="panel panel-card margin-b-30">
                <div class="card-header">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="registeruser">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-10 control-label">Name</label>

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phone_number" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-12">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sex" class="col-md-4 control-label">Sex</label>

                            <div class="col-md-12">
                               <select name="sex" class="form-control">
                                      <option value="male">Male</option>
                                      <option value="female">Female</option>
                                    </select>
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="role" class="col-md-4 control-label">Role</label>

                            <div class="col-md-12">
                               <select name="role" class="form-control">
                                      <option value="user">User</option>
                                      <option value="admin">Admin</option>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@include('layouts.footer')
