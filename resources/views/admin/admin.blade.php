@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') Admins @endsection

@section('content')
<script>document.getElementById('admin').style.color = "#3498db";</script>

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

<div class="container1 p-2" style="height: fit-content; min-height: 600px; min-width: 500px; width: 95%; margin: auto;
                                   background-color: white;
                                   border-radius: 5px;">
  <div class="container2 p-2">
    <div class="d-flex justify-content-between">
        <div class="container3 d-flex p-3" style="font-weight: bold; width: 100%; height: 30px; border-radius: 5px; margin-bottom: 8px;">
            <div class="ri ri-admin-fill" style="color: #333; font-size: 30px; margin-left: 30px; margin-top: -8px;"></div>
            <label class="page_title">Admins</label>
        </div>
        <div style="width: 20%; margin-top: 8px;">
            @if (Auth::user()->role == "superadmin")
            <a href=""
                data-bs-toggle="modal"
                data-bs-target="#addNewAdmin"
                style="border-radius: 20px;
                        margin-right:5%; text-decoration: none; "
                class=" p-2 anchor"> Add New Admin</a>
            @endif
        </div>
    </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm " style="padding-left: 40px; min-width: 400px; height: 20px; font-size: 14px;"  >
      <thead>
        <tr style="height: 35px; text-align: center; background-color: #f1f4f9;">
          <th style="min-width: 20px; width: 5%" scope="col">No</th>
          <th style="min-width: 150px; width: 25%; text-align: left;" scope="col">Name</th>
          <th style="min-width: 100px; width: 15%" scope="col">Username</th>
          <th style="min-width: 150px; width: 15%" scope="col">Email</th>
          <th style="min-width: 100px; width: 5%"scope="col">Role</th>
          @if (Auth::user()->role == "superadmin")
            <th style="min-width: 70px; width: 8%" scope="col">Action</th>
          @endif

        </tr>
      </thead>
      <tbody>

      <?php
        $no = 0;
      ?>
        @if ($Acount == 0)
            <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Admin Found</h6></td></tr>
        @endif
        @foreach ($admins as $admin)

        @if (Auth::user()->role == 'superadmin' && $admin->role == 'admin')
          <tr style="text-align: center;">
            <th scope="row">{{ ++$no }}</th>
            <td style="text-align: left;"><a href="/u/{{$admin->id}}/{{$contestt}}" style="text-decoration: none;"><img src="../../image/profile/{{$admin->profile_image}}" width="25" height="25" class="rounded-circle" style="margin-right: 4px;"> {{ $admin->name }}</a></td>
            <td>{{ $admin->username }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ $admin->role }}</td>
            <td style="text-align: center;">
              @if (Auth::user()->role == "superadmin" && $admin->role != 'superadmin')
                <a href=""
                    data-bs-toggle="modal"
                    data-bs-target="#adminPermission{{$admin->id}}" title="Set Permission"
                    style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                    class="btn btn-success btn-sm pr-2 pl-2 ri ri-key-fill"></a>

                <a href="/removeAdmin/{{$admin->id}}" title="Remove Admin"
                    class="btn btn-danger btn-sm bi bi-trash-fill"
                    style="height: 25px;"
                    onclick="return myFunction();"></a>
              @endif
            </td>
            </tr>
          @endif

        @endforeach
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4" class=" pagination-nav">
                    {{ $admins->onEachSide(1)->links()}}
                </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
  </div>
</div>

@foreach ($admins as $admin)
@foreach ($permissions as $permission)
@if ($admin->username == $permission->admin)

{{-- set admin permision modal start--}}
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="adminPermission{{$admin->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="overflow: auto; height: 70%;">

            <div class="modal-header" style="height: 30px;">
                <div class="modal-title page_title" id="staticBackdropLabel">
                    <label>Admin permission</label>
                </div>
                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-3" style=" height: 80%; margin: auto;">
                <form action="/setPermission/{{$admin->username}}">
                    <div class="p-3">
                        <div><span>What do you allow <strong>{{$admin->name}}</strong> to manage ?</span></div>
                        <ul class="p-2" style="margin-left: 100px;">
                            <input onclick="permission();" style="margin-bottom: 12px;" class="form-check-input p-1" type="checkbox" name='Contest' id="Contest" value="{{$permission->contest}}"
                            @if ($permission->contest == 'Yes')
                                checked
                            @endif>  Contest</input>
                            <br>
                            <input onclick="permission();" style="margin-bottom: 12px;" class="form-check-input p-1" type="checkbox" name='Problem' id="Problem" value="{{$permission->problem}}"
                            @if ($permission->problem == 'Yes')
                                checked
                            @endif>  Problem</input>
                            <br>
                            <input onclick="permission();" style="margin-bottom: 12px;" class="form-check-input p-1" type="checkbox" name='User' id="User" value="{{$permission->user}}"
                            @if ($permission->user == 'Yes')
                                checked
                            @endif>  User</input>
                            <br>
                            <input onclick="permission();" style="margin-bottom: 12px;" class="form-check-input p-1" type="checkbox" name='Team' id="Team" value="{{$permission->team}}"
                            @if ($permission->team == 'Yes')
                                checked
                            @endif>  Team</input>
                    </ul>

                        <div>
                            <input type="submit" class="anchor p-2" style="margin-left: 80px; margin-top: 40px; border-radius: 20px; " value="Set Permission">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
{{-- modal end--}}
@endif
@endforeach
@endforeach

{{-- add admin modal start--}}
<div style="height: 100%; width: 100%; margin: auto; display: none;"
    class="modal fade" id="addNewAdmin" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="overflow: auto; height: 80%;">
            <div class="modal-header" style="height: 40px;">
                <div class="modal-title page_title" id="staticBackdropLabel">
                    <label style="width: 40px;">Add New Admin</label>
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
                          <input onkeypress="showUser();" type="text" name="query" id="query" placeholder="Search" title="Enter a username to create admin" style="padding-left: 10px;">
                          <button onclick="showUser();" method="GET" title="Search" style="width: 5%; background-color: #ccc; height: 100%;" ><i class="bi bi-search"></i></button>
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
                            onclick=""> Add </button>
                </div>
            {{-- </form> --}}

        </div>
    </div>
</div>
{{-- modal end--}}

<script>
    permission();
function permission(){
    var rd1 = document.getElementById("Contest");
    var rd2 = document.getElementById("Problem");
    var rd3 = document.getElementById("User");
    var rd4 = document.getElementById("Team");

    if (rd1.checked == true) {
        rd1.value = "Yes";
    }
    else{
        rd1.value = "No";
    }

    if (rd2.checked == true) {
        rd2.value = "Yes";
    }
    else{
        rd2.value = "No";
    }

    if (rd3.checked == true) {
        rd3.value = "Yes";
    }
    else{
        rd3.value = "No";
    }

    if (rd4.checked == true) {
        rd4.value = "Yes";
    }
    else{
        rd4.value = "No";
    }

}
</script>

<?php $DB='H' ?>
@endsection
<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
  function showUser() {
  var xhttp;
  var str = document.getElementById('query');
//   if (str == "") {
//     document.getElementById("txtHint").innerHTML = "";
//     return;
//   }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var user = JSON.parse(this.responseText);
        // var team = JSON.parse('{"name":"DBCODER","id":null}');

        var output = '';
        output='<li>'+
                    '<div class="d-flex p-2">'+
                        '<img class="rounded-circle" src="../../image/profile/'+user.profile_image+'" width="30" height="30">'+
                        '<a href="/addNewAdmin/'+user.id+'" style="margin-left: 15px;">'+user.username+'</a>'+
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
  var location = "/searchUser/"+str;
  xhttp.open("GET", location, true);
  xhttp.send();
}

function setUser(){
    var btn = document.getElementById('searchOrg').innerHTML = '';
    document.getElementById('logo').style.visibility = 'visible';
    document.getElementById('logo').src = '../../image/organization/'+organization.logo;
    document.getElementById("organization").value= organization.name;

}
 </script>

