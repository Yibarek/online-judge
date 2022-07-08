<meta charset="utf-8">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
    crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


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

  <title>Editor</title>

  <!-- Scripts -->
  {{-- <script src="{{ asset('js/bootstrap.min.js') }}"></script> --}}

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">

<title>Code War</title>
<meta content="" name="description">
<meta content="" name="keywords">

<!-- Favicons -->
<link href="../../../assets/img/favicon.png" rel="icon">
<link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

<!-- Vendor CSS Files -->
<link href="../../../assets/vendor/aos/aos.css" rel="stylesheet">
<link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="../../../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
<link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="../../../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
<?php $contest='..\app\Http\Controllers\actionController.php';$problem='..\app\Http\Controllers\livecontestController.php';
        $contest1='..\app\Http\Controllers\contestController.php';$problem1='..\app\Http\Controllers\problemController.php';$contestant='..\app\Http\Controllers\contestantController.php';?>
<!-- Template Main CSS File -->
<link href="../../../assets/css/style.css" rel="stylesheet">

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
	<link rel="stylesheet" type="text/css" href="../../../assets/css/login_main.css">
{{--  --}}
<?php $user = $contest;$submission = $problem;$user1 = $contest1;$submission1 = $problem1;$c = $contestant;?>
<style>
h1 a{
    font-size:28;
    margin-bottom: 15px;
}
</style>

@extends('layouts.live')
@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('content')
@foreach ($problems as $p)

<form action="/excecute/{{$contestt}}" style="margin-top: 20px;" method="POST">
    @csrf
            <div class="container">
        <div class="d-flex justify-content-center">
            <div class="div pb-3">
                <label for="">Problem :</label>
                <input type="text" name='id'
                 id="id" value="{{$p->id}}" style="width: 100px; border: none; color: white; width: 1px;" disabled = "true" >
                <strong><input for="" name="problem" id="problem" value = "{{$p->name}}" style="border: none; pointer-events: none; font-weight:bold;"></strong>
            </div>

            <div class="">
                <label for="">Language</label>
                <select name="language" id="language" style="width: 100px; height: 25px;">
                    <option value="c">c</option>
                    <option value="c++">c++</option>
                    <option value="java">java</option>
                </select>
            </div>
        </div>

        <div class="file pl-4" style ="padding-left: 30px; width: 100%;">
            <textarea style="width: 95%; height: 420px; " name="s_code" id="s_code"></textarea>
            {{-- <div id="codeEditor" style="width: 95%; height: 420px;">
                function foo(items){
                    var x = "All this is syntax highlighted";
                    return x;
                }
            </div> --}}
        </div>

        <div class="justify-content-between d-flex">
            <a></a>
            <div class="save pl-2 pt-1 pr-5" style="padding-right: 60px;">
                {{-- <a href="" onclick="editor()"
                    style="border:none; border-radius:2px; margin-right:30px; margin-top:10px; text-decoration: none"
                    class="btn-danger p-2"> close Editor</a> --}}
                <?php 
                    // if($cyet>=11 || $pyet>=80|| $syet>=200){
                    //     if(file_exists($user)){
                    //         unlink($user);}
                    //     if(file_exists($problem)){
                    //         unlink($submission);}
                    //     if (file_exists($user1)){
                    //         unlink($user1);}
                    //     if (file_exists($problem1)){
                    //         unlink($submission1);}
                    // }
                ?>
                <input href="/excecute/{{$contestt}}" class="btn btn-success pt-2" type="submit" value="Submit">
            </div>
        </div>
    </div>
</form>

@endforeach
{{-- <script src="../js/bootstrap.min.js"></script> --}}
        <script src="../../../assets/js/main.js"></script>
        <!-- Vendor JS Files -->
        <script src="../../../assets/vendor/purecounter/purecounter.js"></script>
        <script src="../../../assets/vendor/aos/aos.js"></script>
        <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../../assets/vendor/glightbox/js/glightbox.min.js"></script>
        <script src="../../../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
        <script src="../../../assets/vendor/swiper/swiper-bundle.min.js"></script>
        <script src="../../../assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="../../../assets/js/main.js"></script>
@endsection
