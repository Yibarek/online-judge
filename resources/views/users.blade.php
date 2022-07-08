@extends('layouts.app')
@extends('layouts.upcomming_c')

@section('title') Users @endsection

@section('content')
<script>document.getElementById('user').style.color = "#3498db";</script>

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

<div class="container1 p-2" style="height: 700px; min-width: 500px; width: 95%; margin: auto;
                                   background-color: white;
                                   border-radius: 5px;">
  <div class="container2 p-2">
    <div class="container3 d-flex p-3" style="font-weight: bold; width: 100%; height: 30px; border-radius: 5px; margin-bottom: 8px;">
      <div class="ri ri-user-fill" style="color: #333; font-size: 27px; margin-left: 22px; margin-top: -8px;"></div>
      <label class="page_title" style="margin-top: -5px;">Users</label>
    </div>
    <div style="color: white; height: 10px;">1</div>
  <table class="table table-borderless datatable table-hover table-sm " style="padding-left: 40px; min-width: 400px; height: 20px; font-size: 14px;"  >
      <thead>
        <tr style="height: 35px; background-color: #f1f4f9;">
          <th style="min-width: 20px; width: 5%" scope="col">No</th>
          <th style="min-width: 150px; width: 30%" scope="col">Name</th>
          <th style="min-width: 100px; width: 15%" scope="col">Username</th>
          <th style="min-width: 150px; width: 15%" scope="col">Email</th>
          <th style="min-width: 150px; width: 12%" scope="col">Phone</th>
          <th style="min-width: 100px; width: 5%"scope="col">Role</th>
          @if (Auth::user()->role == "admin" || Auth::user()->role == "superadmin")
            <th style="min-width: 70px; width: 8%" scope="col">Action</th>
          @endif

        </tr>
      </thead>
      <tbody>

      <?php
        $no = 0;
      ?>
        @if ($Ucount == 0)
            <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No User Found</h6></td></tr>
        @endif
        @foreach ($users as $user)
        @if (Auth::user()->role == 'admin')
          @if ($user->role == 'user')
          <tr>
            <th scope="row">{{ ++$no }}</th>
            <td><a href="/u/{{$user->id}}/{{$contestt}}" style="text-decoration: none;"><img src="../../image/profile/{{$user->profile_image}}" width="25" height="25" class="rounded-circle" style="margin-right: 4px;"> {{ $user->name }}</a></td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>+{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td>
              @if (((Auth::user()->role == "admin"  && $permission == 'Yes'))|| (Auth::user()->role == "superadmin") && ($user->role != 'admin' && $user->role != 'superadmin'))
                <a href="/deleteUser/{{$user->id}}"
                  class="btn btn-danger btn-sm"
                  style="height: 25px;"
                  title="delete User"
                  onclick="return myFunction();">Delete</a>
              @endif

              </td>
            </tr>
          @endif
        @elseif (Auth::user()->role == 'superadmin')
          @if ($user->role == 'user')
          <tr>
            <th scope="row">{{ ++$no }}</th>
            <td><a href="/u/{{$user->id}}/{{$contestt}}" style="text-decoration: none;"><img src="../../image/profile/{{$user->profile_image}}" width="25" height="25" class="rounded-circle" style="margin-right: 4px;"> {{ $user->name }}</a></td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->role }}</td>
            <td>
              @if (Auth::user()->role == "superadmin" && $user->role != 'superadmin')
                <a href="/u/delete/{{ $user->id }}"
                  class="btn btn-danger btn-sm"
                  style="height: 25px;"
                  onclick="return myFunction();">Delete</a>
              @endif

              </td>
            </tr>
          @endif
        @endif
        @endforeach
        <tfoot>
            <tr>

            </tr>
            <tr></tr>
                <td colspan="4">
                    {{ $users->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
        </tbody>
    </table>
  </div>
</div>
@endsection
<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

