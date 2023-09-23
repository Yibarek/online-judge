@extends('layouts.app2')
<style>
    .anchor{
        border-radius: 20px;
        min-width: 100px;
        text-decoration: none;
        margin-left: 5px;
        margin-right: 5px;
        font-size: 14px;
    }
</style>

@section('title') Contest-Problem No @endsection

@section('f_content')
<div style="width: 80%; margin: auto;">
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

<?php $problems = 0;?>  {{-- initialize problems variable --}}
    <form action="/c/contestProblems/{{$contestt}}" method="POST">
        @csrf
        @foreach ($contests as $contest)
            <?php $problems = $contest->problems;?>   {{-- update problems variable --}}
        <div class="container p-1"  style="width: 80%; margin: auto; background-color: #fff; margin-top:-20px; border-radius: 5px;">
            <div class="title justify-content-between d-flex" style="align-self: center; width: 80%; margin: auto; margin-top: 20px;">
                <h3 style="padding-right: 50px;" class="page_title">Create Contest </h3>
                <div class="d-flex">
                    <h6 class="pt-2 pl-2" style ="color: #494949">
                        <a class="anchor p-2" href="/c/toDetail/{{$contestt}}">Detail</a>
                        <a class="anchor p-2" href="/c/toSchedule/{{$contestt}}">Schedule</a> <strong> No_of_problems </strong>
                    </h6>
                    <h6 class="pt-2 pl-2" style ="color: #aaa">
                        @if ($contest->problems > 0)
                            <a class="anchor p-2 " href="/c/toProblems/{{$contestt}}"> Problems</a>
                        @else
                            Problems
                        @endif
                    </h6>
                </div>
            </div>

            <div class="pt-5 pb-1" style="margin-left: 11%;">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Contest Problems</strong></caption>
            </div>
            <div style="border-radius: 5px; width: 85%; margin:auto; background-color: #fff">
                <div class="justify-content-between p-4">

                    <table>
                        <tr>
                            <td class="p-2">
                                <label for="">No-Of-Problems</label>
                            </td>
                            <td class="p-2" >
                                <input class="form-control" type="number" name='no_of_problems' id="no_of_problems" value="{{$contest->problems}}">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <hr style="width: 85%; margin: auto;">

            <div class="save p-5 justify-content-between d-flex " style="width: 700px;">
                <div ></div>
                <div class="d-flex navbar" style="margin-left: 100px; align-self: flex-end;">
                    <input class="getstarted pr-3" style="border: none;" type="submit" @if ($contest->problems > 0)
                        @disabled(true)
                    @endif value="Save" onclick="return myFunction();">
                </div>
            </div>
        </div>

        @endforeach
    </form>
@endsection

<script>
    function myFunction() {
        if ({{$problems}} > 0) {
            if(!confirm("Are You Sure? Saved problems under this contest will be deleted!"))
            event.preventDefault();
        }

    }
</script>
