@include('layouts.header')


<body class="account">
        <div class="container">
            <div class="row">
                <div class="account-col text-center">
                    <h1>ABSOLUTE-Admin</h1>
                    <h3>Log into your account</h3>
                      <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} row">
                            <input type="email" class="form-control" placeholder="Email Adress" name="email" id="email" required="">
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} row">
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password" required="">
                               @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block ">Login</button>
                        <a href="{{ route('password.request') }}"><small>Forgot password?</small></a>
                      
                        
                    </form>
                </div>
            </div>
        </div>
       @include('layouts.footer')
   
