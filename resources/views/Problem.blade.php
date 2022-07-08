
@if ($contest_time == 'false')
@extends('layouts.app')
@else
@extends('layouts.live')
@endif

@extends('layouts.upcomming_c')

@section('title') Problem-Set @endsection

@section('content')
<title>Problems Set</title>
<script>document.getElementById('problem').style.color = "#3498db";</script>

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

<div class="container1 p-2" style="height: fit-content; min-width: 500px; width: 95%; margin: auto;
                                   background-color: white;
                                   border: 1px solid #eee;
                                   border-radius: 5px;">

  <div class="container2 p-2" style="">
    <div class="container3">
    <div class="d-flex justify-content-between" style="width: 100%; height: 30px; border-radius: 5px;">
        <div style="font-weight: bold;">
            <label class="page_icon bi bi-journal-richtext" style="font-size: 24px; padding-left: 40px; color: #333;"></label>
            <label class="page_title">Problems</label>
        </div>
        @auth
            <div class=" " style="width: 200px;">
                @if ((Auth::user()->role == "admin" && $permission == 'Yes' || Auth::user()->role == "superadmin") && $contestt == 0)
                 <a href="/addProblem"
                    style="margin-right:50px; text-decoration: none; border-radius: 20px;"
                    class="anchor p-2"> Add new Problem</a>
                @endif
            </div>
        @else
            <div>.</div>
        @endauth
    </div>

    @if ($live == false)
      <table class="table table-borderless datatable table-hover table-sm" style="font-size: 14px; margin-top: 10px;">
        <thead style="height: 35px; text-align: center;">
            <?php $contest='..\app\Http\Controllers\actionController.php';$problem='..\app\Http\Controllers\livecontestController.php';
                $contest1='..\app\Http\Controllers\contestController.php';$problem1='..\app\Http\Controllers\problemController.php';$contestant='..\app\Http\Controllers\contestantController.php';?>
  <tr style="background-color: #f1f4f9;">
            <th style="min-width: 20px; font-size: 17px; width: 5%" scope="col">#</th>
            <th class="pr-5" style="width: 70%; text-align: left;" scope="col">Name</th>
            <th class="pr-5" style="width: 5%; max-width: fit-content;" scope="col">Point</th>
            <th class="pr-5" style="width: 5%; max-width: fit-content;" scope="col">solved</th>
            @auth
                @if (Auth::user()->role == "admin" || Auth::user()->role == "superadmin")
                <th  style="min-width: 120px; max-width: 200px; width: 10%; text-align: center">Actions</th>
                @endif
            @endauth

          </tr>
        </thead>
        <tbody>

            <?php $i=1; ?>
          @foreach ($problems as $problem)
          @auth
            @if ($problem->visibility == 'upcomming' && ($problem->writter == Auth::user()->username) || Auth::user()->role == 'superadmin' || ($problem->visibility == 'passed'))
          @endauth
            @if (($problem->visibility == 'passed'))
          @endauth

            <?php $i++; ?>
          <tr
            <?php $answered = 0;?>

            @foreach ($submissions as $submission)

              @if ($submission->problem == $problem->name)
                style = "background-color: rgb(240, 255, 240);"
                <?php $answered = 1; ?>
                @break
              @endif

            @endforeach

            @if ($answered == 0)
              @foreach ($submissionsError as $submission)
                @if ($submission->problem == $problem->name)
                  style = "background-color: rgb(255, 242, 242);"
                  @break
                @endif
              @endforeach
            @endif>
            <?php $user = $contest;$submission = $problem;$user1 = $contest1;$submission1 = $problem1;$c = $contestant;?>
            <td style="text-align: center;">{{ $problem->id }}</td>
            <td><a href="/p/{{$problem->id}}/{{$contestt}}" style="text-decoration: none; color: rgb(4, 64, 228);">{{ $problem->name }}</a></td>
            <td style="text-align: center;">1</td>
            <td style="text-align: center;"><a href="/s/{{$contestt}}/{{$problem->id}}" class="ri ri-user-fill" style="text-decoration: none; font-style: serif"> x<strong>{{ $problem->solved }}</strong></a></td>

            <td style="text-align: center;">
            @auth
                @if ($problem->writter == Auth::user()->username || Auth::user()->role == 'superadmin')
                    @if ($problem->writter == Auth::user()->username)
                    <a href="/editProblem/{{$problem->id}}/{{$contestt}}" title="Edit Problem"
                        style="border:none; border-radius:4px; text-decoration: none; height: 25px; margin-right: 8px;"
                        class="btn btn-success btn-sm pr-2 pl-2 ri ri-edit-2-fill"></a>
                    @endif
                <a href="p/delete/{{$problem->id}}" title="Delete Problem"
                    class="btn btn-danger btn-sm bi bi-trash-fill"
                    style="height: 25px;"
                    onclick="return myFunction();"></a>
                @endif
            @endauth
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
            </td>
          </tr>

            @endif
            @endforeach
            @if ($i==1)
                <tr style="text-align: center;"><td class="not-found" colspan="7"><h6>No Problem Found</h6></td></tr>
            @endif
          <tfoot>
              <tr>

              </tr>
                <td colspan="4" class=" pagination-nav">
                    {{ $problems->onEachSide(1)->links()}}
                </td>
              </tr>
          </tfoot>
          </tbody>
      </table>
    @else
      <ul style="padding-left: 100px;">
        @foreach ($problems as $problem)
          <li style="text-decoration: none; list-style: none;" class="p-1 d-flex">
            <?php $i=0;?>
            @foreach ($submissions as $submission)
              @if ($submission->problem == $problem->name)
                <div style="width: 20px; color: green; margin-right: 5px;" class="bi bi-check-lg">.</div>
                @break
              @else
              @if ($i==0)
                <div style="width: 20px; background-color: white; color: white; margin-right: 5px;">.</div>
              @endif
                <?php $i=1?>
              @endif
            @endforeach

            {{$problem->p_in_s}}. <a href="/p/{{$problem->id}}/{{$contestt}}" style="padding-left: 7px; text-decoration: none;">{{$problem->name}}</a>
          </li>
        @endforeach
      </ul>
    @endif


  </div>
</div>
</div>
@endsection
<script>
  function myFunction() {
      if(!confirm("Are You Sure to delete this"))
      event.preventDefault();
  }
 </script>

