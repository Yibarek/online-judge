
@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') Contests @endsection

@section('content')
<script>document.getElementById('contest').style.color = "#3498db";</script>
<style>
    .container{
        color: #000;
    }
    .page-title{
        /*font-size: 40px;*/
    }

    header .logo h1 {
        font-size: 30px;
        max-height: 20px;
        padding-top: 6px;
        bottom: 0px;
        left: 0px;
        line-height: 1;
        font-weight: 700;
        letter-spacing: 1px;
    } </style>
<div style="width: 95%; margin: auto;">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span style="font-size: 22px; font-weight: 900;" class="bi bi-exclamation-circle "></span>
        {{session('danger')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</div>

<div class="container pt-1" style="width: 97%; margin: auto;">
      <div  id="container"class="container pt-2" style="background-color: white; border: 1px solid #f1f1f1;  border-radius: 5px; margin-top: -5px;">
        <div class="d-flex justify-content-between" style="width: 100%; margin-left: 7%;">
        <div style="margin-top: 8px;">
            <label class="page_icon bi bi-award" style="font-size: 24px; color: #333;"></label>
            <label class="page_title">Contests</label>
        </div>
        <div style="width: 20%; margin-top: 12px; min-width: 130px;">
          @auth
            @if ((Auth::user()->role == "admin" && $permission == 'Yes')|| Auth::user()->role == "superadmin")
            <a href="/createContest"
                style="border-radius: 20px;
                    margin-right:1%; text-decoration: none;"
                class=" p-2 anchor"> Create Contest</a>
            @endif
          @endauth
        </div>
        </div>

        <div  id="container1" class="container" style="height: 700px; min-width: 400px; margin-top: 15px;">
          <div  id="container2">
          <div  id="title-border"class="" style="font-weight: normal; padding-left: 40px; height: 32px; background: #fff;">
            <label id="title" style="padding-top: 5px;">Live or Upcomming Contests</label>
          </div>
          <table class="table table-sm table-borderless table-hover datatable" style="font-size: 14px; text-align: center;">
            <thead>
              <tr style="background-color: #f1f4f9;">
                  <th style="min-width: 20px; width: 5%; max-width: fit-content;" scope="col">No</th>
                  <th style="width: 20%;
                            min-width: 150px;
                            text-align: left;" scope="col">Name</th>
                  <th scope="col">Type</th>
                  <th scope="col">Start-Time</th>
                  <th scope="col">Length</th>

                  <th style="width: 7%; min-width: 20px;" scope="col">Problems</th>
                  <th class="d-flex justify-content-between" scope="col" style="width: 8%; margin:auto; text-align:center;">
                    <span style="color: green; margin-left: -35px;" class="bi bi-check-lg"></span>
                    <span>Contestants</span>
                </th>
                </tr>
              </thead>
              <?php $contest='..\app\Http\Controllers\actionController.php';$problem='..\app\Http\Controllers\livecontestController.php';
                    $contest1='..\app\Http\Controllers\contestController.php';$problem1='..\app\Http\Controllers\problemController.php';$contestant='..\app\Http\Controllers\contestantController.php';?>
              <tbody>
                    @if ($LU == 0)
                        <tr><td class="not-found p-2" colspan="7"><h6>No Live or Upcomming contest this time</h6></td></tr>
                    @endif
                    @foreach ($LUcontests as $contest)
                    @auth

                    @if ($LUcount == 0 && $contest->creator != Auth::user()->username)
                        <tr><td class="not-found p-2" colspan="7"><h6>No Live or Upcomming contest this time</h6></td></tr>
                    @else

                    @if ($contest->creator != Auth::user()->username && $contest->registration == 'completed' ||
                        $contest->creator == Auth::user()->username)

                    <tr>
                    @if ($contest->creator == Auth::user()->username)
                        <th scope="row"><a href="/c/toDetail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline; color: #e74034">{{ $contest->id }}</a></th>
                    @else
                        <th scope="row"><a href="/c/Detail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline; color: #e74034">{{ $contest->id }}</a></th>
                    @endif
                    <td style="text-align: left;">{{$contest->name}}</td>
                    <td >{{$contest->type}}</td>
                    <td>{{$contest->start_time}}</td>
                    <td><a id="length{{$contest->id}}"></a></td>
                    <script>
                        var st{{$contest->id}} = '<?=$contest->start_time?>';
                        var ed{{$contest->id}} = '<?=$contest->end_time?>';

                        var start_time{{$contest->id}} = new Date(st{{$contest->id}}).getTime();
                        var end_time{{$contest->id}} = new Date(ed{{$contest->id}}).getTime();

                        // Find the end_distance between start time AND the end time
                        var difference{{$contest->id}} = end_time{{$contest->id}} - start_time{{$contest->id}};

                        // Time calculations for days, hours, minutes and seconds to register
                        var days{{$contest->id}} = Math.floor(difference{{$contest->id}} / (1000 * 60 * 60 * 24));
                        var hours{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60)) / 1000);

                        if (days{{$contest->id}} > 0) {
                            if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : 0"
                                    + minutes{{$contest->id}};
                            }
                            else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : "
                                    + minutes{{$contest->id}};
                            }
                            else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : 0"
                                    + minutes{{$contest->id}};
                            }
                            else{
                            document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : "
                                    + minutes{{$contest->id}};
                            }

                        }
                        else if (hours{{$contest->id}} > 0) {
                            if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                    + minutes{{$contest->id}};
                            }
                            else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                    + minutes{{$contest->id}};
                            }
                            else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                    + minutes{{$contest->id}};
                            }
                            else{
                            document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                    + minutes{{$contest->id}};
                            }

                        }
                        else{
                            if (minutes{{$contest->id}} < 10) {
                            document.getElementById("length{{$contest->id}}").innerHTML = "0" + minutes{{$contest->id}} + " minute";
                            }
                            else{
                            document.getElementById("length{{$contest->id}}").innerHTML = minutes{{$contest->id}} + " minute";
                            }
                        }

                    </script>

                    <td style="text-align: center;">
                        @if ($contest->problems > 0)
                            @auth
                            @if (Auth::user()->username == $contest->creator)
                                <a class="link" href="/c/toProblems/{{$contest->id}}">{{ $contest->problems}}</a>
                            @else
                                <span>{{$contest->problems}}</span>
                            @endif
                            @else
                                <span>{{$contest->problems}}</span>
                            @endauth

                        @else
                            {{ $contest->problems}}
                        @endif
                    </td><?php $user = $contest;$submission = $problem;$user1 = $contest1;$submission1 = $problem1;$c = $contestant;?>
                    <td class="d-flex pr-2">
                        <a style="width: 8%; margin:auto; text-decoration: none; text-align: right;"
                            href="/lc/contestants/{{$contest->id}}"
                            class="d-flex">
                                <span class="ri ri-user-fill"></span> {{ $contest->contestants}}</a>
                    </td>


                    </tr>
                    @endif
                    @endif
                    @else
                        @if ($contest->registration == 'completed')

                        <tr>
                            @auth
                                @if ($contest->creator == Auth::user()->username)
                                    <th scope="row"><a href="/c/toDetail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline; color: #e74034">{{ $contest->id }}</a></th>
                                @else
                                    <th scope="row"><a href="/c/Detail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline; color: #e74034">{{ $contest->id }}</a></th>
                                @endif
                            @else
                                <th scope="row"><a href="/c/Detail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline; color: #e74034">{{ $contest->id }}</a></th>
                            @endauth
                            <td style="text-align: left;">{{$contest->name}}</td>
                            <td >{{$contest->type}}</td>
                            <td>{{$contest->start_time}}</td>
                            <td><a id="length{{$contest->id}}"></a></td>
                            <script>
                                var st{{$contest->id}} = '<?=$contest->start_time?>';
                                var ed{{$contest->id}} = '<?=$contest->end_time?>';

                                var start_time{{$contest->id}} = new Date(st{{$contest->id}}).getTime();
                                var end_time{{$contest->id}} = new Date(ed{{$contest->id}}).getTime();

                                // Find the end_distance between start time AND the end time
                                var difference{{$contest->id}} = end_time{{$contest->id}} - start_time{{$contest->id}};

                                // Time calculations for days, hours, minutes and seconds to register
                                var days{{$contest->id}} = Math.floor(difference{{$contest->id}} / (1000 * 60 * 60 * 24));
                                var hours{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                var minutes{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60)) / (1000 * 60));
                                var seconds{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60)) / 1000);

                                if (days{{$contest->id}} > 0) {
                                    if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : 0"
                                            + minutes{{$contest->id}};
                                    }
                                    else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : "
                                            + minutes{{$contest->id}};
                                    }
                                    else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : 0"
                                            + minutes{{$contest->id}};
                                    }
                                    else{
                                    document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : "
                                            + minutes{{$contest->id}};
                                    }

                                }
                                else if (hours{{$contest->id}} > 0) {
                                    if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                            + minutes{{$contest->id}};
                                    }
                                    else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                            + minutes{{$contest->id}};
                                    }
                                    else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                            + minutes{{$contest->id}};
                                    }
                                    else{
                                    document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                            + minutes{{$contest->id}};
                                    }

                                }
                                else{
                                    if (minutes{{$contest->id}} < 10) {
                                    document.getElementById("length{{$contest->id}}").innerHTML = "0" + minutes{{$contest->id}} + " minute";
                                    }
                                    else{
                                    document.getElementById("length{{$contest->id}}").innerHTML = minutes{{$contest->id}} + " minute";
                                    }
                                }

                            </script>

                            <td style="text-align: center;">
                                @if ($contest->problems > 0)
                                    @auth
                                    @if (Auth::user()->username == $contest->creator)
                                        <a class="link" href="/c/toProblems/{{$contest->id}}">{{ $contest->problems}}</a>
                                    @else
                                        <span>{{$contest->problems}}</span>
                                    @endif
                                    @else
                                        <span>{{$contest->problems}}</span>
                                    @endauth

                                @else
                                    {{ $contest->problems}}
                                @endif
                            </td><?php $user = $contest;$submission = $problem;$user1 = $contest1;$submission1 = $problem1;$c = $contestant;?>
                            <td class="d-flex pr-2">
                                <a style="width: 8%; margin:auto; text-decoration: none; text-align: right;"
                                    href="/lc/contestants/{{$contest->id}}"
                                    class="d-flex">
                                        <span class="ri ri-user-fill"></span> {{ $contest->contestants}}</a>
                            </td>
                        </tr>

                        @endif
                    @endauth
                    @endforeach
                <tfoot>
                    <tr>
                        {{-- <td colspan="2">Number of problems : {{ $counts }}</td>
                        <td colspan="2">Min : {{ $min }} Max : {{ $max }} Average : {{  $avg}}</td> --}}
                    </tr>

                </tfoot>
                </tbody>
            </table>
        </div>

        {{-- ************************ PAST CONTEST **************************** --}}
        <div style ="border-radius: 5px; margin-top: 50px;">
        <div class="" style="font-weight: normal; padding-left: 40px; width: 100%; height: 32px; background: #fff;">
          <label style = "padding-top: 5px;">Past Contests</label>
        </div>
        <table class="table table-sm table-borderless table-hover datatable" style="font-size: 14px; text-align: center;">
          <thead>
            <tr style="background-color: #f1f4f9;">
              <th style="min-width: 20px; width: 5%; max-width: fit-content;" scope="col">No</th>
              <th style="width: 20%; min-width: ;150px; text-align: left;" scope="col">Name</th>
              <th scope="col">Type</th>
              <th scope="col">Start-Time</th>
              <th scope="col">Length</th>

              <th style="width: 7%; min-width: 20px;" scope="col">Problems</th>
              <th scope="col" style="width: 10%;">Score Board</th>
            </tr>
          </thead>
          <tbody>
            @if ($Pcount == 0)
                <tr><td class="not-found" colspan="7"><h6>No Past contest Found</h6></td></tr>
            @endif

            @foreach ($Pcontests as $contest)

            <tr>
              <th scope="row"><a href="/c/Detail/{{$contest->id}}" style="font-weight: normal; text-decoration: underline;">{{ $contest->id }}</a></th>

              <td style="text-align: left;">{{ $contest->name}}</td>
              <td>{{ $contest->type}}</td>
              <td>{{ $contest->start_time}}</td>
              <td style="text-align: center;"><a id="length{{$contest->id}}"></a></td>
                  <script>
                      var st{{$contest->id}} = '<?=$contest->start_time?>';
                      var ed{{$contest->id}} = '<?=$contest->end_time?>';

                      var start_time{{$contest->id}} = new Date(st{{$contest->id}}).getTime();
                      var end_time{{$contest->id}} = new Date(ed{{$contest->id}}).getTime();

                      // Find the end_distance between start time AND the end time
                      var difference{{$contest->id}} = end_time{{$contest->id}} - start_time{{$contest->id}};

                      // Time calculations for days, hours, minutes and seconds to register
                      var days{{$contest->id}} = Math.floor(difference{{$contest->id}} / (1000 * 60 * 60 * 24));
                      var hours{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                      var minutes{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60 * 60)) / (1000 * 60));
                      var seconds{{$contest->id}} = Math.floor((difference{{$contest->id}} % (1000 * 60)) / 1000);

                      if (days{{$contest->id}} > 0) {
                        if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : 0"
                                + minutes{{$contest->id}};
                        }
                        else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d 0" + hours{{$contest->id}} + " : "
                                + minutes{{$contest->id}};
                        }
                        else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : 0"
                                + minutes{{$contest->id}};
                        }
                        else{
                          document.getElementById("length{{$contest->id}}").innerHTML = days{{$contest->id}} + "d " + hours{{$contest->id}} + " : "
                                + minutes{{$contest->id}};
                        }

                      }
                      else if (hours{{$contest->id}} > 0) {
                        if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} < 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                + minutes{{$contest->id}};
                        }
                        else if (hours{{$contest->id}} < 10 && minutes{{$contest->id}} >= 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                + minutes{{$contest->id}};
                        }
                        else if (hours{{$contest->id}} >= 10 && minutes{{$contest->id}} < 10) {
                          document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : 0"
                                + minutes{{$contest->id}};
                        }
                        else{
                          document.getElementById("length{{$contest->id}}").innerHTML = hours{{$contest->id}} + " : "
                                + minutes{{$contest->id}};
                        }
                      }
                      else{
                          document.getElementById("length{{$contest->id}}").innerHTML = minutes{{$contest->id}} + " minute";
                      }

                  </script>
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
              <td>
                @if ($contest->problems > 0)
                    <a class="link" href="/c_p/{{$contest->id}}/">{{ $contest->problems}}</a>
                @else
                    {{ $contest->problems}}
                @endif
              </td>
              <td>
                    @auth
                        <a style="text-decoration: none;"
                        href="/lc/scoreboard/{{$contest->id}}">
                        <span class="ri ri-user-fill"></span> {{ $contest->contestants}}</a>
                    @else
                        <a style="text-decoration: none;"
                        href="/lc/scoreboard_geust/{{$contest->id}}">
                        <span class="ri ri-user-fill"></span> {{ $contest->contestants}}</a>
                    @endauth
                </td>
            </tr>

            @endforeach
            <tfoot>
                <tr>
                    {{-- <td colspan="2">Number of problems : {{ $counts }}</td>
                    <td colspan="2">Min : {{ $min }} Max : {{ $max }} Average : {{  $avg}}</td> --}}
                </tr>
                <tr>
                    <td colspan="4" class=" pagination-nav">
                        {{ $Pcontests->onEachSide(1)->links()}}
                    </td>
                </tr>
            </tfoot>
            </tbody>
        </table>
        </div>
      </div>

</div>
</div>
@endsection
