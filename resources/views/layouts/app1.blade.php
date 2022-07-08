<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    {{-- <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> --}}
<head>
    <meta charset="utf-8">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
    crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <script src="{{ asset('js/main.js') }}" defer></script> --}}

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../remixicon/remixicon.css" rel="stylesheet">

    {{--  --}}

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  {{-- Home Page Form --}}
  {{--  --}}
  {{--  --}}
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="../../assets/img/favicon.png" rel="icon">
<link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../../assets/vendor/aos/aos.css" rel="stylesheet">
<link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

<!-- Template Main CSS File -->
<link href="../../assets/css/style.css" rel="stylesheet">

<!-- =======================================================
* Template Name: Vesperr - v4.7.0
* Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
* Author: BootstrapMade.com
* License: https://bootstrapmade.com/license/
======================================================== -->
{{--  --}}
{{--  --}}
{{--  --}}

{{-- Login Form --}}
{{--  --}}
{{--  --}}
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="../../image/icpc.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/login_vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../assets/css/login_util.css">
	<link rel="stylesheet" type="text/css" href="../../assets/css/login_main.css">
<!--===============================================================================================-->
{{--  --}}
{{--  --}}
{{--  --}}

</head>
<body style="position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            max-width: 100vw;
            width: 100vw;">

    <div id="app" >

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center" >
    <div class="container d-flex align-items-center">

        <div class="logo d-flex">
            <a href="/"><img src="../../image/logo/icpc.png" style="padding-right: 5px;"></a>
            <h1><a href="/" style="font-size: 30px;
                margin: 0;
                padding: 0;
                line-height: 1;
                font-weight: 700;
                letter-spacing: 1px;">CodeWar</a></h1>
        </div>

        <nav id="navbar" class="navbar" style="width: 100%;">
        <ul id="menus" style="width: 100%;" class="d-flex justify-content-between">
            <div class="d-flex">
            <li><a class="nav-link scrollto active" id="home" href="/home">Home</a></li>
            
            @auth
                <li><a class="nav-link scrollto" id="contest" href="/c/0">Contests</a></li>
            @else
                <li><a class="nav-link scrollto" id="contest" href="/contest">Contests</a></li>
            @endauth
            
            @auth
                <li><a class="nav-link scrollto " id="problem" href="/p/0">Problem</a></li>
            @else
                <li><a class="nav-link scrollto " id="problem" href="/problems">Problem</a></li>
            @endauth
            
            @auth
                <li><a class="nav-link scrollto" id="submission" href="/s/0">Submissions</a></li>
            @else
                <li><a class="nav-link scrollto " id="submission" href="/submission">Submissions</a></li>
            @endauth
            
            <li><a class="nav-link scrollto" id="about" href="#about">About</a></li>
            <li><a class="nav-link scrollto" id="contact" href="#contact">Contact</a></li>
            </div>
            <script>document.getElementById('home').style.color = "#495057";</script>
            <div class="d-flex">
            @guest
                @if (Route::has('register'))
                    <li>
                        <a class="nav-link scrollto" href="{{ route('register') }}">{{ __('Sign Up') }}</a>
                    </li>
                @endif
                @if (Route::has('login'))
                    <li>
                        <a class="getstarted scrollto" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            @else

            <li class="nav-item dropdown pe-3" style="list-style: none;">

                <a class="nav-link nav-profile d-flex align-items-center" href="#" data-bs-toggle="dropdown">
                    <img src="../../image/profile/{{Auth::user()->profile_image}}" width="25" height="25" alt="" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle p-2" style="font-weight: 600;">{{Auth::user()->username}}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu arrow profile" style="position: absolute; left: -50px">
                    <li class="pl-2" style=" text-align: center; height: 36px;  color: #777; padding-left: 8px;">
                    <span style="height: 20px; font-weight: 600;  font-size: 16px;">{{Auth::user()->username}}</span><br>
                    <span style="font-size: 14px">{{Auth::user()->role}}</span>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/profile">
                            <span class="bi bi-person"> My Profile</span>
                        </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <span class="bi bi-person"> My Status</span>
                        </a>
                    </li>
                    <li>
                    <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">

                            <span class="bi bi-box-arrow-right"> {{ __('Logout') }}</span>

                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                            @csrf
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            @endguest
            </div>
        </ul>
        <i class="bi bi-list mobile-nav-toggle" style="position: fixed; top: 15px; right: ;15px;"></i>
        </nav><!-- .navbar -->

    </div>

    </header><!-- End Header -->




            {{-- <main id="hero" class="py-4 d-flex"> --}}
                    @yield('content')
            {{-- </main> --}}

        {{-- <script src="../js/bootstrap.min.js"></script> --}}
        <script src="../../assets/js/main.js"></script>
        <!-- Vendor JS Files -->
        <script src="../../assets/vendor/purecounter/purecounter.js"></script>
        <script src="../../assets/vendor/aos/aos.js"></script>
        <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../../assets/js/main.js"></script>

        {{-- Login Page --}}
        {{--  --}}
        {{--  --}}

        <!--===============================================================================================-->
        <script src="../../assets/login_vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/login_vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/login_vendor/bootstrap/js/popper.js"></script>
            <script src="../../assets/login_vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/login_vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/login_vendor/daterangepicker/moment.min.js"></script>
            <script src="../../assets/login_vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/login_vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
            <script src="../../assets/js/login_main.js"></script>
        {{--  --}}
        {{--  --}}
        {{--  --}}

    </div>
</body>
</html>

