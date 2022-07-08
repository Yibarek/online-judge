@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('content')
<main id="main" class="main"  style="margin-left: 7%;">

    <div class="pagetitle">
      <h4 style="margin-bottom: -50px;">Profile</h4>

    </div>{{-- End Page Title --}}

    <section class="section profile">
    @foreach ($user as $u)

    @section('title') {{$u->username}} - profile @endsection

    <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../../image/profile/{{$u->profile_image}}" alt="Profile" class="rounded-circle"
              style="width: 70%; height: ;70%;">
              <h3>{{$u->username}}</h3>
              <h5>{{$u->role}}</h5>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-7">

          <div class="card">
            <div class="card-body pt-3">
              {{-- Bordered Tabs --}}

              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8">{{$u->name}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Occupation</div>
                    <div class="col-lg-9 col-md-8">{{$u->occupation}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8">{{$u->country}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">City</div>
                    <div class="col-lg-9 col-md-8">{{$u->city}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Organization</div>
                    <div class="col-lg-9 col-md-8">{{$u->organization}}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">College</div>
                    <div class="col-lg-9 col-md-8">{{$u->college}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Department</div>
                    <div class="col-lg-9 col-md-8">{{$u->department}}</div>
                  </div>
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    {{-- <div class="col-lg-9 col-md-8">{{$u->phone}}</div> --}}
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">{{$u->email}}</div>
                  </div>

                </div>

              </div>
              {{-- End Bordered Tabs --}}

            </div>
          </div>

        </div>
      </div>

    @endforeach
    </section>

  </main>{{-- End #main --}}
@endsection
