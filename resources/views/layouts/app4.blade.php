
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
    <script src="{{ asset('js/main.js') }}" defer></script>

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

{{--  --}}
{{--  --}}
{{--  --}}

{{-- Login Form --}}
	<link rel="stylesheet" type="text/css" href="../../assets/css/login_main.css">
{{--  --}}
</head>
<body style="position: relative;
            left: 50%;
            right: 50%;
            margin-left: -50vw;
            margin-right: -50vw;
            max-width: 100vw;
            width: 100vw;
            background-color: #f5f7f9">

    <div id="app" >

        <main id="hero" class="py-4 d-flex" style="width: 100%; margin-top: -50px;">
            <div style="width: 80%; margin: auto;">
                @yield('content')
            </div>

        </main>

        <div style="width: 100%;">
            {{-- ======= Footer ======= --}}
        {{-- <footer id="footer" class="footer" style="text-align: center;">
            <div class="copyright">
            &copy; Copyright <strong><span>CodeWar</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">DBCODER</a>
            </div> --}}
        {{--</footer>--}}{{-- End Footer --}}
        </div>

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
    </div>
</body>
</html>

