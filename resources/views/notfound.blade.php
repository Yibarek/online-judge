@extends('layouts.app4')
@section('content')
<title> Not Found 404 </title>

  <main>
    <div class="container">

      <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <h1>404</h1>
        <h2>You are not allowed for this service please contact the Developer.</h2>
        <a class="anchor p-2" href="/home">Back to home</a>
        <img src="../../../assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found" style="width: 70%; height: 350px;">
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
          Designed by <a href="/">DBCODER</a>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

@endsection
