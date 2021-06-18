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
        
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    </head>


    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="index.html" class="logo">
                        <span>
                            <img src="{{ asset('adminox/images/logo.png') }}" alt="" height="25">
                        </span>
                        <i>
                            <img src="{{ asset('adminox/images/logo_sm.png') }}" alt="" height="28">
                        </i>
                    </a>
                </div>

                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <i class="dripicons-bell noti-icon"></i>
                                <span class="badge badge-pink noti-icon-badge">4</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><span class="badge badge-danger float-right">5</span>Notification</h5>
                                </div>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-danger"><i class="icon-like"></i></div>
                                    <p class="notify-details">Carlos Crouch liked <b>Admin</b><small class="text-muted">1 min ago</small></p>
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="{{ asset('adminox/images/users/avatar-1.jpg') }}" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Welcome ! {{ auth()->user()->name }}</small> </h5>
                                </div> 

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-account-circle"></i> <span>Profile</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-settings"></i> <span>Settings</span>
                                </a>

                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-lock-open"></i> <span>Lock Screen</span>
                                </a>

                                <!-- item-->
                                <a href="{{ route('logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                     <span>Logout</span>
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                 </form>

                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left waves-light waves-effect">
                                <i class="dripicons-menu"></i>
                            </button>
                        </li>
                        <li class="hide-phone app-search">
                            <form role="search" class="">
                                <input type="text" placeholder="Search..." class="form-control">
                                <a href=""><i class="fa fa-search"></i></a>
                            </form>
                        </li>
                    </ul>

                </nav>

            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Navigation</li>
                            <li>
                                <a href="{{ url('home') }}">
                                    <i class="fi-air-play"></i><span class="badge badge-success pull-right">2</span> <span> Dashboard </span>
                                </a>
                            </li>
                               <li>
                                <a href="javascript: void(0);"><i class="fi-target"></i> <span> Admin UI </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="admin-grid.html">Grid</a></li>
                                    <li><a href="admin-sweet-alert.html">Sweet Alert</a></li>
                                </ul>
                            </li>
                            @if (Auth::user()->role == 1)
                                 <li>
                                <a href="{{ url('category') }}"><i class="mdi mdi-blackberry"></i> <span>Category</span></a>
                            </li>

                            <li>
                                <a href="{{ route('product_index') }}"><i class="mdi mdi-alert "></i><span class="badge badge-danger pull-right">New</span> <span> Products </span></a>
                            </li>

                            <li>
                                <a href="{{ route('faq') }}"><i class="fi-help"></i><span class="badge badge-danger pull-right">New</span> <span> FAQ </span></a>
                            </li>
                            <li>
                                <a href="{{ route('testimonial') }}"><i class="mdi mdi-android-debug-bridge"></i><span class="badge badge-danger pull-right">New</span> <span> Testimonial </span></a>
                            </li>

                            <li>
                                <a href="{{ route('slider') }}"><i class="mdi mdi-apple-finder"></i><span class="badge badge-danger pull-right">New</span> <span> Slider </span></a>
                            </li>

                            <li>
                                <a href="{{ route('setting') }}"><i class="mdi mdi-blur-linear "></i><span class="badge badge-warning pull-right">1</span> <span> Setting </span></a>
                            </li>
                            
                            <li>
                                <a href="{{ route('subCategory') }}"><i class="mdi mdi-blur-linear "></i><span class="badge badge-warning pull-right">1</span> <span> Sub Category </span></a>
                            </li>

                            <li>
                                <a href="{{ route('coupun.index') }}"><i class="mdi mdi-blur-linear "></i><span class="badge badge-warning pull-right">1</span> <span>Coupun</span></a>
                            </li>

                            <li>
                                <a href="tickets.html"><i class="fi-help"></i><span class="badge badge-warning pull-right">1</span> <span> Tickets </span></a>
                            </li>

                            <li>
                                <a href="javascript: void(0);"><i class="fi-paper-stack"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="nav-second-level" aria-expanded="false">
                                    <li><a href="page-starter.html">Starter Page</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-logout.html">Logout</a></li>
                                    <li><a href="page-recoverpw.html">Recover Password</a></li>
                                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                                    <li><a href="page-confirm-mail.html">Confirm Mail</a></li>
                                    <li><a href="page-404.html">Error 404</a></li>
                                    <li><a href="page-404-alt.html">Error 404-alt</a></li>
                                    <li><a href="page-500.html">Error 500</a></li>
                                </ul>
                            </li>   
                            @endif

                            
                            
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->




            
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <div class="container-fluid">
                        <!-- breadcumb use only --> 
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <h4 class="page-title float-left">@yield('page_name')</h4>

                                        @yield('breadcumb')
                                        
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                       <!-- start content from here --> 

                       @yield('content')
                      


                    </div> <!-- container -->

                </div> <!-- content -->

                <footer class="footer text-right">
                    
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->
         <!-- jQuery  -->
        @yield('scripts')

        @yield('subcategory')



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

        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        @yield('chart_js')
         
    </body>
</html>