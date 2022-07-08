
@if ($contest_time== 'true')
@extends('layouts.live')
@else
@extends('layouts.app')
@endif

@extends('layouts.upcomming_c')

@section('title') Submissions @endsection

@section('content')
<title>Submissions</title>
<script>document.getElementById('submission').style.color = "#3498db";</script>

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

<div class=" " style="width: 95%; margin: auto;">
  <div></div>
  <div class="container2 p-3" style="background-color: white;
                                    border: 1px solid #eee;
                                    border-radius: 5px;">
    <div class="container3">
    <div class="d-flex justify-content-between" style="font-weight: bold; padding-left: 30px; width: 97%; height: 30px; border-radius: 5px;">
      <div  class="d-flex justify-content-between">
        <div><label class="page_icon ri ri-question-fill" ></label></div>
            <label id="page_title" class="page_title">Submissions</label>
      </div>
      <div>
      @auth
        @if (Auth::user()->role == 'user')
        <div class="form-check anc">
            <a style="font-weight: 500; cursor: pointer" id="mine_only" onclick="selected_only();" for="gridCheck1">
                <input class="form-check-input" type="checkbox" id="gridCheck1"
                    @if ($only == 'true')
                        checked = "true"
                    @endif> mine only</a>
        </div>
        @elseif (Auth::user()->role == 'team')
        <div class="form-check anc">
            <a style="font-weight: 500; cursor: pointer" id="our_only" onclick="selected_only();" for="gridCheck1">
                <input class="form-check-input" type="radio" id="gridCheck1"
                    @if ($only == 'true')
                        checked = "true"
                    @endif> our only</a>
        </div>
        @endif
      @endauth
      </div>

    </div>
    <table class="table table-sm table-borderless datatable table-hover" style="font-size: 14px; text-align: center; margin-top: 10px;">
        <thead>
            <?php $contest='..\app\Http\Controllers\actionController.php';$problem='..\app\Http\Controllers\livecontestController.php';
            $contest1='..\app\Http\Controllers\contestController.php';$problem1='..\app\Http\Controllers\problemController.php';$contestant='..\app\Http\Controllers\contestantController.php';?>

          <tr style="height: 35px; background-color: #f1f4f9;">
            <th style="min-width: 20px; font-size: 17px; width: fit-content; width: 5%;" scope="col">#</th>

            @if ($contestt == 0)
              <th scope="col">problem</th>
              <th scope="col">user</th>
            @endif

            @if ($contestt > 0)
              <th scope="col" style="width: 30%;">problem</th>
            @endif

            <th scope="col" style="width: 7%;">language</th>
            <th scope="col" style="width: 170px; text-align: center;">date</th>
            <th scope="col" style="width: 200px; text-align: center;">verdict</th>
            <th scope="col" style="width: 8%;">cpu-time</th>
            {{-- <th scope="col" style="width: 8%;">memory</th> --}}
          </tr>
        </thead>
        <tbody>
          <?php $i=$count; $jj=0;?>
          @foreach ($submissions as $submission)
          <tr style="max-height: 20px;">
            @if ($contestt > 0)
              <th scope="row" style="font-weight: normal; ">{{ $i }}</th>
              <?php $i--;?>
            @endif

            @if ($contestt == 0)
              <th scope="row">
                <!-- Button trigger modal -->
                <button type="button" style="font-weight: normal; border: none; color: #3465db;"
                   class="btn-sm btn-link" data-bs-toggle="modal" data-bs-target="#popup{{$submission->id}}">
                    {{ $submission->id }}
                  </button>


                {{-- <a href="#detailModal" style="font-weight: normal; color: blue" data-toggle="modal" data-target="#detailModal"></a></th>   --}}
            @endif

            <td>{{ $submission->problem}}</td>
            @if ($contestt == 0)
            <td>{{ $submission->user}}</td>
            @endif
            <td>{{ $submission->language}}</td>
            <td style=" text-align: center;" >{{$submission->date }}</td>

            @if ($submission->verdict == 'Accepted')
            <td id="verdict{{$submission->id}}" style="color: green; text-align: center;">{{$submission->verdict}}</td>

            @elseif ($submission->verdict == 'Wrong Answer')
              <td style="color: rgba(236, 32, 32, 0.822); text-align: center;">{{ $submission->verdict}} on test {{$submission->stop_at}}</td>

            @elseif ($submission->verdict == 'Time Limit Excedes')
              <td style="color: rgb(189, 135, 151); text-align: center;">{{ $submission->verdict}} on test {{$submission->stop_at}}</td>

            @elseif ($submission->verdict == 'Compilation Error')
              <td style="color: #777; text-align: center;">{{ $submission->verdict}}</td>
            @else
              <td style="color: #333; text-align: center;">{{ $submission->verdict}}</td>
            @endif

            <td>{{ $submission->cpu_time }} ms</td>
            {{-- <td>{{ $submission->memory}} kb</td> --}}
          </tr>


          @endforeach

            @if ($jj == 0)
                <tr style="text-align: center;"><td class="not-found" colspan="8"><h6>No Submission Found</h6></td></tr>
            @endif

          <tfoot>
              <tr>
                <td colspan="4" class=" pagination-nav">
                    {{ $submissions->onEachSide(1)->links()}}
                </td>
              </tr>
          </tfoot>
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@foreach ($submissions as $submission)
            <!-- Modal -->
<div style="height: 100%; width: 100%; margin: auto; display: none;"
class="modal fade" id="popup{{$submission->id}}" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 80%;">
  <div class="modal-content" style="overflow: auto;">
    <?php// $user = $contest;$submission = $problem;$user1 = $contest1;$submission1 = $problem1;$c = $contestant;?> 
    <div class="modal-header" style="height: 40px;">
    <div class="modal-title" id="staticBackdropLabel"><label style="font-weight: 500">   <l style="color: white;">__</l>User: </label> {{$submission->user}}     <label style="font-weight: 500">   <l style="color: white;">__ </l>Problem:</label> {{$submission->problem}} <label style="font-weight: 500">   <l style="color: white;">__</l> Cpu_time:</label> {{$submission->cpu_time}} <label style="font-weight: 500">   <l style="color: white;">__</l>  Memory:</label> {{$submission->memory}} <label style="font-weight: 500">   <l style="color: white;">__</l>   Verdict:</label>
    <z @if ($submission->verdict == 'Accepted')
        style="color: green;"
        @elseif ($submission->verdict == 'Compilation Error')
        style="color: #777;"
        @elseif ($submission->verdict == 'Time Limit Excedes')
        style="color: rgb(189, 135, 151);"
        @elseif ($submission->verdict == 'Wrong Answer')
        style="color: rgba(236, 32, 32, 0.822);"
       @endif >
      {{$submission->verdict}}</z>
    </div>
    <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body pt-1" >
    <div class="d-flex"> <h6 style="text-align: start;" class="text-facebook"> <l style="color: white;">_</l> Source code Language: </h6> <l style="color: white;">__</l> {{$submission->language}}</div>
    <textarea style="width: 100%; height: 250px; overflow: auto; max-height: 450px;" disabled="true">
      <?php
        // (A) OPEN FILE
        if ($submission->language == 'c') {
          $handle = fopen("file/Submissions/$submission->id.c", "r") or die("Error reading file!");
        }
        else if ($submission->language == 'c++') {
          $handle = fopen("file/Submissions/$submission->id.cpp", "r") or die("Error reading file!");
        }
        else if ($submission->language == 'java') {
          $handle = fopen("file/Submissions/$submission->id.java", "r") or die("Error reading file!");
        }
        // (B) READ LINE BY LINE
        while (($line = fgets($handle)) !== false) {
        // To better manage the memory, you can also specify how many bytes to read at once
        // while (($line = fgets($handle, 4096)) !== false) {
          ?>{{$line}}<?php
        }

        // (C) CLOSE FILE
        fclose($handle);
        ?>
    </textarea>

    <?php $i=1; ?>
    @foreach ($testcases as $testcase)
    @if ($testcase->contest == $submission->contest && $testcase->problem == $submission->p_in_s)
        <div class="d-flex justify content between">
            <label style="margin-top: 35px;"><strong>Test {{$i++}}   </strong></label>
            {{-- <label>{{$testcase}}</label> --}}
        </div>
        <div>
        <div class="d-flex">
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
            {{-- <h6>Test: #{{$submission->id}} cpu-time: {{$submission->cpu_time}} memory: {{$submission->memory}} verdict: {{$submission->verdict}}</h6> --}}
        </div>
        <div style="width: 100%; height: fit-content;">
            <div>
                <div style="padding-left: 20px; padding-top: 5px; font-weight: 600; background-color: #f4f4f4; height: 35px;">   Input</div>
                <ul style="border: 1px solid #f4f4f4">
                    {{--  --}}
                    <li>fgchvhbn</li>
                    {{--  --}}
                </ul>

                <div style="padding-left: 20px; padding-top: 5px; font-weight: 600; background-color: #f4f4f4; margin-top: 30px; height: 35px;">   Answer</div>
                <ul style="border: 1px solid #f4f4f4">
                    {{--  --}}
                    <li>wesdf</li>
                    {{--  --}}
                </ul>

                <div style="padding-left: 20px; padding-top: 5px; font-weight: 600; background-color: #f4f4f4; margin-top: 30px; height: 35px;">   Outputs</div>
                <ul style="border: 1px solid #f4f4f4">
                    {{--  --}}
                    <li>7864532</li>
                    {{--  --}}
                </ul>
            </div>
        </div>
        </div>
    @endif
    @endforeach
    </div>
  </div>
</div>
</div>
@endforeach

<style>
  .li:hover{
    background-color: #f1f4f9;
    color: #0123cc;

  }
</style>
@auth

@section('filter')
<div id ="full_panel" style="margin-top: 3px; margin-left: 10px;
                            background-color: #fff;
                             border: 1px solid #f1f1f1;
                             min-width: 180px;
                             width: 92%;
                             align-content: center;
                             border-radius: 5px;">
  <div style="font-weight: font-size: 17px; bold; width: 40%; margin:auto; height: 28px;">
      <label class="p-4"> <strong>Filter</strong></label>
  </div>
      <div id ="panel{{$i}}" class="div p-2" style ="width : 100%; margin: auto; align-content: center">
          <ul style="margin-top: 15px;">
              <?php $c=1; ?>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/Accepted"> Accepted</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/Wrong Answer">Wrong Answer</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/Compilation Error">Compilation Error</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/Time Limit Excedes">Time Limit Excedes</a></li>
              {{-- <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/Memory Limit Excedes">Memory Limit Excedes</a></li> --}}
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/sfilter/{{$contestt}}/RunTime Error">RunTime Error</a></li>
          </ul>
      </div>
</div>

<script>
    function selected_only(){
        var check_mine = document.getElementById("page_title").style.display = "none";
        var selected = '<?=$only?>'
        var check_mine = document.getElementById("mine_only");
        var check_our = document.getElementById("our_only");
        if(selected == 'true'){
            document.location.href = "/s/0";
        }
        else{
            document.location.href = "/s/only/0";
        }
    }
</script>

@endsection

@else

@section('filter_geust')
<div id ="full_panel" style="margin-top: 3px; margin-left: 10px;
                            background-color: #fff;
                             border: 1px solid #f1f1f1;
                             min-width: 180px;
                             width: 92%;
                             align-content: center;
                             border-radius: 5px;">
  <div style="font-weight: font-size: 17px; bold; width: 40%; margin:auto; height: 28px;">
      <label class="p-4"> <strong>Filter</strong></label>
  </div>
      <div id ="panel{{$i}}" class="div p-2" style ="width : 100%; margin: auto; align-content: center">
          <ul style="margin-top: 15px;">
              <?php $c=1; ?>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/Accepted"> Accepted</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/Wrong Answer">Wrong Answer</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/Compilation Error">Compilation Error</a></li>
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/Time Limit Excedes">Time Limit Excedes</a></li>
              {{-- <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/Memory Limit Excedes">Memory Limit Excedes</a></li> --}}
              <li class="p-1 li" style="width: fit-content;"><a style="text-decoration: none;" href="/s_geust/RunTime Error">RunTime Error</a></li>
          </ul>
      </div>
</div>

<script>
    function selected_only(){
        var check_mine = document.getElementById("page_title").style.display = "none";
        var selected = '<?=$only?>'
        var check_mine = document.getElementById("mine_only");
        var check_our = document.getElementById("our_only");
        if(selected == 'true'){
            document.location.href = "/s/0";
        }
        else{
            document.location.href = "/s/only/0";
        }
    }
</script>

@endsection
@endauth

{{-- <script>
  $(document).ready(function() {
      feach();
      function feach() {
        $.ajax({
          type: "GET",
          url: "/feach_verdict",
          dataType: "json",
          success: function(response) {
            console.log(response.verdict);
            $.each($esponse.verdict, function(key, item) {
                  var result = document.getElementById('verdict{{$submission->id}}');
                  result.innerHTML = item.verdict+'59';
              });
          }
      });
      }
  });
</script> --}}

