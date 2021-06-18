<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Laravel') }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('adminox/images/favicon.ico') }}">

        <!-- App css -->
        <link href="{{ asset('adminox/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminox/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminox/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('adminox/css/style.css') }}" rel="stylesheet" type="text/css" />

        <script src="{{ asset('adminox/js/modernizr.min.js') }}"></script>

    </head>


    <body class="bg-accpunt-pages">

        <!-- HOME -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="account-pages">
                                <div class="account-box">
                                    <div class="account-logo-box">
                                        <h2 class="text-uppercase text-center">
                                            <a href="index.html" class="text-success">
                                                <span><img src="{{ asset('adminox/images/logo_dark.png') }}" alt="" height="30"></span>
                                            </a>
                                        </h2>
                                        <h5 class="text-uppercase font-bold m-b-5 m-t-50">Sign In</h5>
                                        <p class="m-b-0">Login to your Admin account</p>
                                    </div>
                                    <div class="account-content">
                                        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                                            @csrf
                                            <div class="form-group m-b-20 row">
                                                <div class="col-12">
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" placeholder="Enter your password"  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                                     @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">
                                                    @if (Route::has('password.request'))
                                                        <a href="{{ route('password.request') }}" class="text-muted pull-right"><small>Forgot your password?</small></a>
                                                    @endif
                                                    <label for="password">Password</label>
                                                    <input class="form-control" type="password" id="password" placeholder="Enter your password"  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                                </div>
                                            </div>

                                            <div class="form-group row m-b-20">
                                                <div class="col-12">

                                                    <div class="checkbox checkbox-success">
                                                        <input id="remember" type="checkbox" class="form-check-input" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="remember">
                                                            Remember me
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group row text-center m-t-10">
                                                <div class="col-12">
                                                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                                </div>
                                            </div>

                                        </form>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <button type="button" class="btn m-r-5 btn-facebook waves-effect waves-light">
                                                        <i class="fa fa-facebook"></i>
                                                    </button>
                                                    <button type="button" class="btn m-r-5 btn-googleplus waves-effect waves-light">
                                                        <i class="fa fa-google"></i>
                                                    </button>
                                                    <button type="button" class="btn m-r-5 btn-twitter waves-effect waves-light">
                                                        <i class="fa fa-twitter"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row m-t-50">
                                            <div class="col-sm-12 text-center">
                                                <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- end card-box-->


                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->



        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('adminox/js/jquery.min.js') }}"></script>
        <script src="{{ asset('adminox/js/tether.min.js') }}"></script><!-- Tether for Bootstrap -->
        <script src="{{ asset('adminox/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('adminox/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('adminox/js/waves.js') }}"></script>
        <script src="{{ asset('adminox/js/jquery.slimscroll.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('adminox/js/jquery.core.js') }}"></script>
        <script src="{{ asset('adminox/js/jquery.app.js') }}"></script>

    </body>
</html>