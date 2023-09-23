
@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') Team @endsection

@section('content')
<script>document.getElementById('team').style.color = "#3498db";</script>

<style>
    .anchor{
        border-radius: 20px;
        min-width: 100px;
        text-decoration: none;
        padding-left: 10px;
        padding-right: 10px;
        font-size: 14px;
    }

label {
    /* font-size: 15px; */
}
</style>

{{-- ****************************        ADMIN       ***************************** --}}
{{-- ****************************        ADMIN       ***************************** --}}
{{-- ****************************        ADMIN       ***************************** --}}
@if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')
<div style="width: 95%; margin: auto;">
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        {{session('danger')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</div>
    <div class="container" style="height: fit-content; min-width: 300px; width: 95%; margin: auto;">

        <div style ="border-radius: 5px; min-width: fit-content; background-color: white;" class="p-3">
        <div class="d-flex justify-content-between" style="font-weight: bold; padding-left: 40px; width: 100%; height: 28px; border-radius: 5px; padding-bottom: 7px; margin-bottom: 10px;">
            <div class="d-flex justify-content-between">
                <div><img src="../../image/profile/team.png" width="35" height="35" style="color: #444;"></div>
                <label class="page_title">Teams</label>
            </div>
            @auth
                    <div class="d-flex justify-content-between">
                        <div class=" " style="width: 140px;">
                            @if (Auth::user()->role == "superadmin")
                            <a href="/org/{{$contestt}}"
                                style="margin-right:5px; text-decoration: none; border-radius: 20px;"
                                class="anchor p-2"> Organizations {{$organizations}}</a>
                            @endif
                        </div>
                        <div class=" " style="width: 150px;">
                            @if (Auth::user()->role == "superadmin")
                            <a href="/cy/{{$contestt}}"
                                style="margin-right:5px; text-decoration: none; border-radius: 20px;"
                                class="anchor p-2"> Countries {{$countries}}</a>
                            @endif
                        </div>
                    </div>
                @else
                    <div>.</div>
                @endauth
        </div>
        <div style="">
        <table class="table table-borderless datatable table-hover table-sm " style="padding-left: 40px; min-width: 400px; width: 100%; height: 20px; font-size: 14px;" >
        <thead>
            <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="min-width: 20px; width: 5%" scope="col">No</th>
            <th style="min-width: 70px; width: 25%" scope="col">Name</th>
            <th style="min-width: 75px; width: 15%; text-align: center;"scope="col">Organization</th>
            <th style="min-width: 40px; width: 8%; text-align: center;"scope="col">Coach</th>
            <th style="min-width: 40px; width: 6%; text-align: center;" scope="col">Members</th>
            <th style="min-width: 40px; width: 8%; text-align: center;" scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
        <?php
            $no = 0;
        ?>

            @foreach ($teams as $team)
            @if ($team->status != 'cancelled' && $team->status != 'deleted')

            <tr>
            <?php $team_logo = ''; ?>
                @foreach ($organization as $org)
                    @if ($org->name == $team->organization)
                        <?php $team_logo = $org->logo; ?>
                    @endif
                @endforeach
            <th scope="row" style="min-width: 20px; width: 5%">{{ ++$no }}</th>
            <td style="min-width: 110px; width: 25%"><a href="/t/{{$team->id}}" style="text-decoration: none;">{{ $team->name }}</a></td>
            <td style="min-width: 120px; width: 8%; text-align: center;"><img src="../../image/organization/{{$team_logo}}" width="30" height="25" style="margin-right: 4px;"> {{ $team->organization }}</td>
            <td style="min-width: 90px; width: 8%; text-align: center;"><a href="/uDetail/{{$team->coach}}/{{$contestt}}">{{ $team->coach }}</a></td>
            <td style="min-width: 70px; width: 6%; text-align: center;"><a href="#" data-bs-toggle="modal" data-bs-target="#members{{$team->id}}">{{ $team->members }}</a></td>
            <td style="text-align: center;">
            @if ((Auth::user()->role == "admin" && $permission == 'Yes')|| Auth::user()->role == "superadmin")
                <a href="/t/delete/{{$team->id}}"
                    class="btn btn-danger btn-sm bi bi-trash-fill"
                    title="Delete Team"
                    style="height: 25px; text-align: center;"
                    style="min-width: 80px; width: 8%; text-align: center;"
                    onclick="return myFunction();"></a>
            @endif
            </td>
            </tr>

            @endif
            @endforeach
            @if ($no == 0)
                <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Team Found</h6></td></tr>
            @endif
            <tfoot>
                <tr>

                </tr>
                    <td colspan="4" class=" pagination-nav">
                        {{ $teams->onEachSide(1)->links()}}
                    </td>
                </tr>
            </tfoot>
            </tbody>
        </table>
    </div>
    </div>
    </div>
@else
{{-- ****************************        USER       ***************************** --}}
{{-- ****************************        USER       ***************************** --}}
{{-- ****************************        USER       ***************************** --}}
<div style="width: 95%; margin: auto;">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('danger'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-octagon me-1"></i>
        {{session('danger')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
</div>
    <div class="container" style="height: fit-content; min-width: 300px; background-color: white; width: 95%; margin: auto; border: 1px solid #eee; border-radius: 5px;">
{{--
        <div class="add pl-5 justify-content-between d-flex"
            style ="border-radius: 5px; min-width: fit-content; background-color: white;" class="p-2">
            <a href=""></a>
            <div style="margin-bottom: -24px; margin-top: 35px;" >
                <a href="#" data-bs-toggle="modal" data-bs-target="#team"
                    style="margin-right:10px; text-decoration: none; margin-bottom: 50px; border-radius: 16px;"
                    class="p-1 anchor">    Join Team    </a>

                <a  href="" data-bs-toggle="modal" data-bs-target="#popup"
                    class="anchor p-1" style="border-radius: 16px; min-width: 100px;
                                            margin-right:100px;
                                            text-decoration: none;
                                            margin-bottom: 50px;">    Create Team    </a>
            </div>
        </div> --}}

        <div style ="border-radius: 5px; min-width: fit-content; background-color: white; margin-top: 8px;"
             class="d-flex justify-content-between p-3">
            <div class="d-flex" style="font-weight: bold; padding-left: 40px; width: 100%; height: 28px; border-radius: 5px; padding-bottom: 7px; margin-bottom: 10px;">
                <div><img src="../../image/profile/team.png" width="35" height="35" style="color: #444;"></div>
                <label class="page_title">Teams</label>
            </div>
            <div class="pl-5 justify-content-between d-flex"
                style ="border-radius: 5px; min-width: 220px; width: 30%; background-color: rgb(255, 255, 255);" class="p-2">
                <a href=""></a>
                <div style="margin-bottom: -24px; width: 100%;" >
                    <a href="#" data-bs-toggle="modal" data-bs-target="#team"
                    style="border-radius: 20px; margin-right:5%; text-decoration: none; "
                    class=" p-2 anchor">    Join Team    </a>

                    <a  href="" data-bs-toggle="modal" data-bs-target="#popup"
                    style="border-radius: 20px; margin-right:5%; text-decoration: none; "
                    class=" p-2 anchor">    Create Team    </a>
                </div>
            </div>
        </div>
        <div>
        <table class="table table-borderless datatable table-hover table-sm" style="padding-left: 40px; min-width: 400px; width: 100%; height: 20px; font-size: 14px;" >
        <thead>
            <tr style="height: 35px; background-color: #f1f4f9;">
                <th style="min-width: 20px; width: 5%" scope="col">No</th>
                <th style="min-width: 80px; width: 25%" scope="col">Name</th>
                <th style="min-width: 80px; width: 15%; text-align: center;"scope="col">Organization</th>
                <th style="min-width: 50px; width: 8%; text-align: center;"scope="col">Coach</th>
                <th style="min-width: 50px; width: 6%; text-align: center;" scope="col">Members</th>
                <th style="min-width: 50px; width: 8%; text-align: center;" scope="col">Action</th>

                </tr>
        </thead>
        <tbody>

        <?php
            $no = 0;
        ?>

            @foreach ($teams as $team)
            @if (Auth::user()->team == $team->id || Auth::user()->username == $team->coach)
                <tr>
                    <th scope="row" style="min-width: 20px; width: 5%">{{ ++$no }}</th>
                    <?php $team_logo = ''; ?>
                    @foreach ($organization as $org)
                        @if ($org->name == $team->organization)
                            <?php $team_logo = $org->logo; ?>
                        @endif
                    @endforeach
                    <td style="min-width: 110px; width: 25%"><a href="/t/{{$team->id}}" style="text-decoration: none;">{{ $team->name }}</a></td>
                    <td style="min-width: 120px; width: 8%; text-align: center;"><img src="../../image/organization/{{$team_logo}}" width="30" height="25" style="margin-right: 4px;"> {{ $team->organization }}</td>
                    <td style="min-width: 90px; width: 8%; text-align: center;"><a href="/uDetail/{{$team->coach}}/{{$contestt}}">{{ $team->coach }}</a></td>
                    <td style="min-width: 70px; width: 6%; text-align: center;"><a href="#" data-bs-toggle="modal" data-bs-target="#members{{$team->id}}">{{ $team->members }}</a></td>
                    <td style="text-align: center;">
                        @if($team->status != 'cancelled')
                        @if ($team->coach == Auth::user()->username)
                            <a href="/t/delete/{{ $team->id }}"
                                class="btn btn-danger btn-sm bi bi-trash-fill"
                                title="Delete Team"
                                style="height: 25px; text-align: center; font-size: 14px;"
                                style="min-width: 80px; width: 8%; text-align: center; "
                                onclick="return myFunction();">
                            </a>
                        @else
                            <a href="/t/leaveTeam"
                                class="btn btn-danger "
                                title="Leave Team"
                                style="height: 25px; text-align: center; font-size: 14px; padding-top: -13px;"
                                style="min-width: 80px; width: 8%; text-align: center;"
                                onclick="return myFunction();">Leave
                            </a>
                        @endif
                        @else
                            <span>cancelled</span>
                        @endif

                        </td>
                </tr>
            @endif
            @endforeach

            @if ($no == 0)
                <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Team Found</h6></td></tr>
            @endif

            <tfoot>
                <tr>

                </tr>
                    <td colspan="4" class=" pagination-nav">
                        {{ $teams->onEachSide(1)->links()}}
                    </td>
                </tr>
            </tfoot>
            </tbody>
        </table>
            </div>
    </div>
    </div>
@endif

{{-- create team modal start --}}
<div style="height: 100%; width: 100%; margin: auto; display: none;"
class="modal fade" id="popup" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 55%;">
    <div class="modal-content" style="overflow: auto;">
        <div class="modal-header" style="height: 40px;">
            <h6 class="modal-title page_title" id="staticBackdropLabel">Create Team </h6>
            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action=""></form>
        <form onsubmit="return validate();" action="/createTeam" id="f" name="f">
        <div class="modal-body" style=" width: 100%; margin: auto; background-color: #f6f6f6;  overflow: auto; max-height: 500px; ">
            <table style="width: 75%; margin: auto;" class="p-3">
                <tr class="d-flex justify-content-between p-2" style="margin-right: 35">
                    <td><label> Team Name</label></td>
                    <td><input class="form-control" type="text" name="name"></td>
                </tr>
                <tr class="d-flex justify-content-between p-2" style="margin-right: 35">
                    <td><label> Email</label></td>
                    <td><input class="form-control" type="email" name="email"></td>
                </tr>
                <script>

                </script>
                <tr class="d-flex justify-content-between p-2">
                    <td><label> Organization</label></td>
                    <td class="d-flex justify-content-between">
                        <div class="d-flex justify-content-between"><a href=""></a><input class="form-control"
                            type="text"
                            name="organization" style="width: 96%;"
                            id="organization"
                            onkeypress="searchOrganization();"></div>

                        <img id="logo" width="40" height="30"
                            style="margin-left: 5px; margin-top: 4px; visibility: hidden;">
                    </td>
                </tr>
                <tr class="d-flex justify-content-between p-2" style="margin-right: 35">
                    <td></td>
                    <td><div id="searchOrg"></div></td>
                </tr>
                <tr class="d-flex justify-content-between p-2" style="margin-right: 35">
                    <td><label> Password</label></td>
                    <td><input class="form-control" type="password" name="password"></td>
                </tr>
                <tr class="d-flex justify-content-between p-2" style="margin-right: 35">
                    <td><label>Confirm Password</label></td>
                    <td><input class="form-control" type="password" name="confirmPassword"></td>
                </tr>
            </table>
        </div>
        <div class="modal-footer navbar p-2">
            <button class="button getstarted p-2"
                    type="submit"
                    style="border: none; border-radius: 16px; text-decoration: none;"
                    onclick="">Create</button>

            {{-- <button class="button" style="border: 1px solid #ccc; border-radius: 4px;" data-bs-dismiss="modal"> Close</button> --}}
        </div>
    </form>
</div>
</div>
</div>
{{-- modal end --}}


{{-- join team modal start--}}
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="team" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="overflow: auto; height: 80%;">
            <div class="modal-header" style="height: 30px;">
                <div class="modal-title page_title" id="staticBackdropLabel">
                    <label>Join Team</label>
                </div>

                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="modal-body p-3" style=" height: 80%;">
                {{-- <form action="/lc/complete/"> --}}
                    <div style="width: 80%; margin: auto;" class="p-2">
                    <div class="search-bar" style="border: 1px solid #ddd; border-radius: 5px;">
                        <form class="search-form d-flex justify-content-between align-items-center "
                                method="GET" action="#team"
                                style="height: 30px;">
                          <input onkeypress="showTeam();" type="text" name="query" id="query" placeholder="Search" title="Enter a Team name to join" style="padding-left: 10px;">
                          <button onclick="showTeam();" method="GET" title="Search" style="width: 5%; background-color: #ccc; height: 100%;" ><i class="bi bi-search"></i></button>
                        </form>
                      </div>

                    <div style="width: 100%; margin: auto; border: 1px solid #eee; overflow: hidden; margin-top: 10px;">
                        <ul style="max-width: 100%;" id="txtHint"></ul>
                    </div>

                </div>

                </div>
                <div class="modal-footer navbar p-2">
                    <button class="button p-2 getstarted"
                            type="submit"
                            style="border: none; margin-top: 10px; padding-left: 25px; padding-right: 25px;"
                            onclick=""> Join </button>
                </div>
            {{-- </form> --}}

        </div>
    </div>
</div>
{{-- modal end--}}

{{-- members modal start--}}
@foreach ($teams as $team)

<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="members{{$team->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="overflow: auto; height: 50%;">
            <div class="modal-header d-flex" style="height: 60px;">
                <?php $team_logo = ''; ?>
                @foreach ($organization as $org)
                    @if ($org->name == $team->organization)
                        <?php $team_logo = $org->logo; ?>
                    @endif
                @endforeach

                <img src="../../image/organization/{{$team_logo}}" width="30" height="25" style="margin-right: 4px;">
                <div class="modal-title page_title" id="staticBackdropLabel">
                    <label>{{$team->name}}</label>
                </div>
                <span style="margin-left: 10px; margin-top: 2px;"> team members</span>

                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <?php $i=1; ?>
            <div class="modal-body p-3" style=" height: 80%; margin-top: 25px;">
                <ol>
                    @foreach ($members as $member)
                        @if ($member->team == $team->id)
                            <li class="p-2"><strong>{{$i++}}:</strong> <a href="/userByName/{{$member->name}}/{{$contestt}}">{{$member->name}}</a></li>
                        @endif
                    @endforeach
                </ol>
            </div>
        </div>
    </div>
</div>
@endforeach
{{-- modal end--}}

@endsection
<?php $DB = 'DB'; ?>
<script>
function myFunction() {
    if(!confirm("Are You Sure to delete this"))
    event.preventDefault();
}
function validate() {
    var p = document.getElementById('password').innerHTML;
    var cp = document.getElementById('confirmPassword').innerHTML;
    if(p == cp)
        return true;
    else
        return false;
}

function showTeam() {
  var xhttp;
  var str = document.getElementById('query');
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var team = JSON.parse(this.responseText);
        // var team = JSON.parse('{"name":"DBCODER","id":null}');

        var output = '';
        output='<li>'+
                    '<div class="d-flex p-2">'+
                        '<img src="../../image/organization/'+team.logo+'" width="35" height="30">'+
                        '<a href="/joinTeam/'+team.id+'" style="margin-left: 15px;">'+team.name+'</a>'+
                    '</div>'+
                '</li>';

        document.getElementById('txtHint').innerHTML = output;
            // console.log(team);
    }
    else{
        document.getElementById("txtHint").innerHTML = 'Not Found';
    }
  };
  var str = document.getElementById('query').value;
  var location = "/searchTeam/"+str;
  xhttp.open("GET", location, true);
  xhttp.send();
}

var organization = '';

function searchOrganization() {
  var xhttp;
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        organization = JSON.parse(this.responseText);

        var output = '';
        output='<li>'+
                    '<div class="d-flex p-2">'+
                        '<img class="rounded-circle" src="../../image/organization/'+organization.logo+'" width="30" height="30">'+
                        '<button type="button" style="color:#3489db; margin-left: 15px;" onclick="setOrg();">'+organization.name+'</button>'+
                    '</div>'+
                '</li>';

        // document.getElementById('txtHint').innerHTML = output;
        // output='<li>'+
        //             '<button id="orgBtn" onclick="setOrg()"'+organization.id+'" style="margin-left: 15px;">'+organization.name+'</button>'+
        //         '</li>';

        document.getElementById('searchOrg').innerHTML = output;

    }
    else{
        document.getElementById("searchOrg").innerHTML = 'Not Found';
        document.getElementById("logo").style.visibility = 'hidden';
    }
  };
  var str = document.getElementById('organization').value;
  var location = "/searchOrganization/"+str;
  xhttp.open("GET", location, true);
  xhttp.send();
}

function setOrg(){
    var btn = document.getElementById('searchOrg').innerHTML = '';
    document.getElementById('logo').style.visibility = 'visible';
    document.getElementById('logo').src = '../../image/organization/'+organization.logo;
    document.getElementById("organization").value= organization.name;

}
</script>

