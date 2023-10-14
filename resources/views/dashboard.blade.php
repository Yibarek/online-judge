@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') Home @endsection

@section('content')
<script>document.getElementById('home').style.color = "#3498db";</script>
<style>
    .container{
        color: #000;
    }
    .page-title{
        /*font-size: 40px;*/
    }
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
    .card-icon{
        height: 50px;
        width: 50px;
        font-size: 27px;
    }

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}

.card>hr {
    margin-right: 0;
    margin-left: 0;
}

.card>.list-group {
    border-top: inherit;
    border-bottom: inherit;
}

.card>.list-group:first-child {
    border-top-width: 0;
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
}

.card>.list-group:last-child {
    border-bottom-width: 0;
    border-bottom-right-radius: calc(0.25rem - 1px);
    border-bottom-left-radius: calc(0.25rem - 1px);
}

.card>.card-header+.list-group,
.card>.list-group+.card-footer {
    border-top: 0;
}

.card {
    flex: 1 1 auto;
    padding: 1rem 1rem;
    border: 1px solid #eee;
    box-shadow: 1px 5px 10px 1px rgba(200, 220, 225, 0.7);
    padding: 1px 1px 1px 1px;
    align-items: center;
}

.card-title {
    margin-bottom: 0.5rem;
}

.card-subtitle {
    margin-top: -0.25rem;
    margin-bottom: 0;
}

.card-text:last-child {
    margin-bottom: 0;
}

.card-link+.card-link {
    margin-left: 1rem;
}

.card-header {
    padding: 0.5rem 1rem;
    margin-bottom: 0;
    background-color: rgba(0, 0, 0, 0.03);
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

.card-header:first-child {
    border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
}

.card-footer {
    padding: 0.5rem 1rem;
    background-color: rgba(0, 0, 0, 0.03);
    border-top: 1px solid rgba(0, 0, 0, 0.125);
}

.card-footer:last-child {
    border-radius: 0 0 calc(0.25rem - 1px) calc(0.25rem - 1px);
}

.card-header-tabs {
    margin-right: -0.5rem;
    margin-bottom: -0.5rem;
    margin-left: -0.5rem;
    border-bottom: 0;
}

.card-header-pills {
    margin-right: -0.5rem;
    margin-left: -0.5rem;
}

.card-img-overlay {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    padding: 1rem;
    border-radius: calc(0.25rem - 1px);
}

.card-img,
.card-img-top,
.card-img-bottom {
    width: 100%;
}

.card-img,
.card-img-top {
    border-top-left-radius: calc(0.25rem - 1px);
    border-top-right-radius: calc(0.25rem - 1px);
}

.card-img,
.card-img-bottom {
    border-bottom-right-radius: calc(0.25rem - 1px);
    border-bottom-left-radius: calc(0.25rem - 1px);
}

.card-group>.card {
    margin-bottom: 0.75rem;
}

@media (min-width: 576px) {
    .card-group {
        display: flex;
        flex-flow: row wrap;
    }
    .card-group>.card {
        flex: 1 0 0%;
        margin-bottom: 0;
    }
    .card-group>.card+.card {
        margin-left: 0;
        border-left: 0;
    }
    .card-group>.card:not(:last-child) {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
    }
    .card-group>.card:not(:last-child) .card-img-top,
    .card-group>.card:not(:last-child) .card-header {
        border-top-right-radius: 0;
    }
    .card-group>.card:not(:last-child) .card-img-bottom,
    .card-group>.card:not(:last-child) .card-footer {
        border-bottom-right-radius: 0;
    }
    .card-group>.card:not(:first-child) {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }
    .card-group>.card:not(:first-child) .card-img-top,
    .card-group>.card:not(:first-child) .card-header {
        border-top-left-radius: 0;
    }
    .card-group>.card:not(:first-child) .card-img-bottom,
    .card-group>.card:not(:first-child) .card-footer {
        border-bottom-left-radius: 0;
    }
}

</style>

<div style="width: 95%; min-width: ; margin: auto;">
<div class="p-4" style="background-color: #fff;">
    <div class="row">
        <!-- User Card -->
        @if ((Auth::user()->role == "admin" && $user_permission == 'Yes')|| Auth::user()->role == "superadmin")
        <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Users <span style="font-size: 16px;">| This Month</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                  style="background-color: #abdba8; color: #0e7016;">
                    <i class="ri ri-user-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$user_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End User Card -->
          @endif

          <!-- Team Card -->
          @if ((Auth::user()->role == "admin" && $team_permission == 'Yes')|| Auth::user()->role == "superadmin")
          <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Teams <span style="font-size: 16px;">| This Month</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"style="background-color: #b2b5b6;">
                    <div ><img src="../../image/profile/team.png" width="35" height="35" style="color: #444;"></div>
                  </div>
                  <div class="ps-3">
                    <h6>{{$team_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Team Card -->
          @endif

          <!-- Admin Card -->
          @if (Auth::user()->role == "superadmin")
          <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Admins <span style="font-size: 16px;">| This Month</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                    style="background-color: #dfd5d0; color: rgb(204, 104, 10);">
                    <i class="ri ri-admin-fill"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$admin_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Admin Card -->
          @endif

          <!-- Contest Card -->
          @if ((Auth::user()->role == "admin" && $contest_permission == 'Yes')|| Auth::user()->role == "superadmin")
        <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Contest <span style="font-size: 16px;">| This Year</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                    style="background-color: #d4d3b3; color: #706108;">
                    <i class="page_icon bi bi-award"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$contest_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Contest Card -->
          @endif
          <!-- Problem Card -->
          @if ((Auth::user()->role == "admin" && $problem_permission == 'Yes')|| Auth::user()->role == "superadmin")
          <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Problems <span style="font-size: 16px;">| This Month</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                    style="background-color: #d4b4b3; color: #701408;">
                    <i class="page_icon bi bi-journal-richtext"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$problem_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Problem Card -->
          @endif
          <!-- Submissions Card -->
          @if (Auth::user()->role == "superadmin")
        <div class="col-xxl-4 col-md-4 p-3">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Submissions <span style="font-size: 16px;">| Today</span></h5>

                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"
                    style="background-color: #b3c8d4; color: #094770;">
                    <i class="bi bi-cart"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{$submission_count}}</h6>
                    <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
          @endif
    </div>
</div>

    <?php $j=1; ?>
    @foreach ($contests as $contest)
    <?php $j++; ?>
    @if ($contest->registration == 'completed')

    <div class="pb-4">
    <div class="p-4" style=" background-color: white; border-radius: 5px; border: 1px solid #eee;">

        <div class="d-flex justify-content-between">
        <div>
            <label class="page_title">{{$contest->name}}</label>
        </div>
        <div style="background-color: white; width: 50%; height: 45px; margin-left: 20px; margin-bottom: 5px;"
            class=" d-flex justify-content-between">
            <div></div>

            <div class="p-2 d-flex">
                @if ($contest->status == "passed")
                <table style="min-width: 300px;">
                    <tr>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2" style=""
                                    href="/c/toSchedule/{{$contest->id}}">schedule</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/contestants/{{$contest->id}}">Contestants</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/scoreboard/{{$contest->id}}">scoreboard</a>
                        </td>
                    </tr>
                </table>
                @else
                <table style="min-width: 200px;">
                    <tr>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                    href="/c/toSchedule/{{$contest->id}}">schedule</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/contestants/{{$contest->id}}">Contestants</a>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>

        <div>
            Created By <label style="color: rgb(200, 160, 2)">{{$contest->creator}}</label>
        </div>
        <div style="width: 100%; height: fit-content; border-left: 2px solid gray;" class="">
            <div style="padding-left: 10px;">

                <div class="d-flex" style="height: 300px;">
                    <textarea style="min-width: 60%; height: 100%; padding-top: 10px; padding-right: 15px; overflow: hidden; border: none; resize: none;"disabled ="true" cols="100%;">
                        {{$contest->description}}
                    </textarea>
                    <div style="max-width: 40%; width: fit-content; height: 100%; max-height: 200px; align-self: center;" >
                        <img src="../../image/contest/{{$contest->logo}}" alt="no" style="width: 100%;">
                    </div>
                </div>

                <div style="padding-top: 15px;">
                    <div style="padding-bottom: 8px;">
                        <strong>Contest Type: </strong>{{$contest->type}}
                    </div>

                    <div style="padding-bottom: 8px;">
                        <strong>Contest Place: </strong>{{$contest->place}}
                    </div>

                    <div style="padding-bottom: 8px;">
                        <strong>Official contestants: </strong>{{$contest->officials}}
                    </div>
                </div>

                @if ($contest->status == "passed")
                <div style="">
                    <div style="padding: 5px; font-weight: 600;">Conttest Winners: </div>
                    <?php $counter = 1; ?>
                    @while ($counter <= $contest->winners)
                        <div style="padding-left: 15%; padding-bottom: 5px; font-weight: 500; color: rgb(16, 109, 44);">
                            <label>{{$counter}}, </label><label style="color: #fff">...</label><label> {{$winners[$contest->id][$counter]}}</label>
                            <?php $counter++; ?>
                        </div>
                    @endwhile
                </div>
                @endif

                <div class="p-2">
                    <strong>Sponsers: </strong>
                    {{$contest->sponsers}}<br>
                    @foreach ($sponsers as $sponser)
                        @if ($sponser->contest == $contest->id)
                        <img style="margin: 20px;" src="../../image/sponser/{{$sponser->sponser_logo}}" width="90" height="50" name="existing_logo" id="{{$sponser->sponser_logo}}">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    </div>
    @endif
    @endforeach

</div>
<div style="background-color: #fff;
            width: 95%; margin: auto;
            border-radius: 5px;
            border: 1px solid #eee;
            margin-bottom: 20px;
            min-height: 85px;">
    <div style="margin-top: 20px; margin-left: 30px;">
        {{ $contests->onEachSide(1)->links()}}
        @if ($j == 1)
            <div style="text-align: center;">
                <div class="not-found">
                    <h3 class="p-2">Welcome to Codwar</h3>
                    <h6 class="p-2">No News and Contest History Found</h6>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('topusers')
<div style ="border: 1px solid #eee; borde
r-radius: 5px; width: 92%; margin: auto; margin-top: 3px; background-color: white;" class="p-2">
    <div class="" style="font-weight: bold; width: 100%; background-color: #fff; height: 28px; text-align: center; border-radius: 5px; margin-bottom: 5px;">
        <label style=" font-size: 17px;">Top Users</label>
    </div>
    <table class="table table-hover table-borderless datatable table-sm" style="font-size: 14px;">
        <thead>
          <tr style="background-color: #f1f4f9; font-weight: bold;">
            <td style="min-width: 20px; font-size: 17px; width: 5%" scope="col">#</td>
            <td class="pr-5" style="width: 70%;" scope="col">User</td>
            <td class="pr-5" style="width: 60px;" scope="col">Rating</td>
          </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
        @foreach ($users as $user)
          <tr>
            <td>{{$i}}</></td> <?php $i++; ?>
            <td><span class="pr-2"><img src="../../image/profile/{{$user->profile_image}}" alt="" width="30" height="30"style="margin-right: 10px;"></span >{{ $user->username }}</td>
            <td>{{ $user->rating }}</td>
          </tr>
          @if ($i==10)
              @break
          @endif
        @endforeach

        @if ($i == 1)
            <tr style="text-align: center;"><td class="not-found" colspan="5"><h6>No Users Found</h6></td></tr>
        @endif
        </tbody>
      </table>
</div>
@endsection

@section('topteams')
<div style ="border: 1px solid #eee; border-radius: 5px; width: 92%; margin: auto; margin-top: 12px; background-color: white;" class="p-2">
    <div class="" style="font-weight: bold; width: 100%; background-color: #fff; height: 28px; text-align: center; border-radius: 5px; margin-bottom: 5px;">
        <label style=" font-size: 17px;">Top Teams</label>
    </div>
    <table class="table table-hover table-borderless datatable table-sm" style="font-size: 14px;">
        <thead>
          <tr style="background-color: #f1f4f9; font-weight: bold;">
            <td style="min-width: 20px; font-size: 17px; width: 5%" scope="col">#</td>
            <td class="pr-5" style="width: 70%;" scope="col">User</td>
            <td class="pr-5" style="width: 60px;" scope="col">Rating</td>
          </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
        @foreach ($teams as $team)
        <?php $team_logo = ''; ?>
        @foreach ($organization as $org)
            @if ($org->name == $team->organization)
                <?php $team_logo = $org->logo; ?>
            @endif
        @endforeach
          <tr>
            <td>{{$i}}</></td> <?php $i++; ?>
            <td><span class="pr-2"><img src="../../image/profile/{{$team_logo}}" alt="" width="35" height="30"style="margin-right: 10px;"></span>{{ $team->username }}</td>
            <td>{{ $team->rating }}</td>
          </tr>
          @if ($i==10)
              @break
          @endif
        
        @endforeach

        @if ($i == 1)
            <tr style="text-align: center;"><td class="not-found" colspan="5"><h6>No Teams Found</h6></td></tr>
        @endif

        </tbody>
      </table>
</div>
@endsection
