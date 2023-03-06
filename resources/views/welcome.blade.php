@extends('layouts.app1')

@section('title') Codewar @endsection

  @section('content')

  <style>
    #header .logo h1 {
      font-size: 30px;
      max-height: 20px;
      padding-top: 6px;
      bottom: 0px;
      left: 0px;
      line-height: 1;
      font-weight: 700;
      letter-spacing: 1px;
    }
  </style>

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Improve your programming skill with Codewar</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">We are team of talented programmer making efficient softwares</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            @guest
                @if (Route::has('login'))
                    <li>
                        <a class="btn-get-started scrollto" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endif
            @endguest

          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients clients">
      <div class="container">

        <div class="row">

            <div class="col-lg-2 col-md-4 col-7">
                <div style="font-weight: 700;" class="img-fluid " alt="" data-aos="zoom-in" data-aos-delay="100">

                </div>
            </div>

          <div class="col-lg-2 col-md-4 col-7" style="margin: auto;">
            <img src="../../image/organization/DebreBirhanUniversity.jpg" class="img-fluid" alt="" data-aos="zoom-in" data-aos-delay="10">
          </div>

          <div class="col-lg-4 col-md-4 col-7">
            <div style="font-weight: 700; font-size: 22px; padding-top: 30px;" class="img-fluid " alt="" data-aos="zoom-in" data-aos-delay="100">
                Debre Birhan University Codewar contest site
            </div>
          </div>

          <div class="col-lg-2 col-md-4 col-7">
            <div style="font-weight: 700;" class="img-fluid " alt="" data-aos="zoom-in" data-aos-delay="100">

            </div>
          </div>
          <div class="col-lg-2 col-md-4 col-7">
            <div style="font-weight: 700;" class="img-fluid " alt="" data-aos="zoom-in" data-aos-delay="100">

            </div>
          </div>

          <div class="col-lg-2 col-md-4 col-7">
            <div style="font-weight: 700;" class="img-fluid " alt="" data-aos="zoom-in" data-aos-delay="100">

            </div>
          </div>

        </div>

      </div>
    </section><!-- End Clients Section -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>

            </p>
            <ul>
                <li><i class="ri-check-double-line"></i> Code War hosts Competitive Programming Contests as well and generates contest results, which usually called score boards for every contest. Users are also able to practice by submitting any problem after the contest ends.</li>
                <li><i class="ri-check-double-line"></i> Programming Contest Judge System poses problems such as questions in programming contests to users, receives their answers from the users, and checks the correctness of the submitted answers.</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <ul>
                <li><i class="ri-check-double-line"></i> The system can compile and execute code, and test the source code with pre-constructed data. Submitted source code may be run with restrictions, including time limit, memory limit, security restriction and so on. The output of the code will be captured by the system, and compared with the standard output. The system will then return the result.</li>
            </ul>

            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-xl-start" data-aos="fade-right" data-aos-delay="150">
            <img src="assets/img/counts-img.svg" alt="" class="img-fluid">
          </div>

          <div class="col-xl-7 d-flex align-items-stretch pt-4 pt-xl-0" data-aos="fade-left" data-aos-delay="300">
            <div class="content d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-emoji-smile"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{$user_count}}" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Happy Users</strong> </p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-journal-richtext"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{$problem_count}}" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Problems</strong></p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-clock"></i>
                    <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Years of experience</strong></p>
                  </div>
                </div>

                <div class="col-md-6 d-md-flex align-items-md-stretch">
                  <div class="count-box">
                    <i class="bi bi-award"></i>
                    <span data-purecounter-start="0" data-purecounter-end="{{$contest_count}}" data-purecounter-duration="1" class="purecounter"></span>
                    <p><strong>Contests</strong></p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Counts Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Services</h2>
          <p>Main services of the codewar are the following</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
              <div class="icon"><i class="bx bxl-dribbble"></i></div>
              <h4 class="title"><a href="">Contest</a></h4>
              <p class="description">Contestants can register and participate on contests and view generated scoreboard.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
              <div class="icon"><i class="bx bx-file"></i></div>
              <h4 class="title"><a href="">Problem List</a></h4>
              <p class="description">Users can access submit sourcecode for past contest problems in any time</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
              <div class="icon"><i class="bx bx-tachometer"></i></div>
              <h4 class="title"><a href="">Submissions</a></h4>
              <p class="description">All users submissions are stored and avaliable in any time for every user after the contest end.</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
            <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Score Board</a></h4>
              <p class="description">For every contest score bord is stored and generated automatically.</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>Codewar</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vesperr-free-bootstrap-template/ -->
            Developed by <a href="https://www.github.com/yibarek">Yitbarek</a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="footer-links text-lg-right text-center pt-2 pt-lg-0">
            <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">About</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms of Use</a>
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @endsection

