@include('layouts.header')


<body class="account">
        <div class="container">
            <div class="row">
                <div class="account-col text-center">
                    <h1>ABSOLUTE-Admin</h1>
                    <h3>Log into your account</h3>
                    <form class="m-t"  action="index.html">
                        <div class="form-group row">
                            <input type="text" class="form-control" placeholder="Username" required="">
                        </div>
                        <div class="form-group row">
                            <input type="password" class="form-control" placeholder="Passowrd" required="">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block ">Login</button>
                        <a href="#"><small>Forgot password?</small></a>
                        <p class=" text-center"><small>Do not have an account?</small></p>
                        <a class="btn  btn-secondary btn-block" href="register.html">Create an account</a>
                        <p>Absolute-Admin Admin &copy; 2016</p>
                    </form>
                </div>
            </div>
        </div>
       @include('layouts.footer')
    </body>
   
</html>
