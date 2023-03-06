@extends('layouts.app2')

@section('title') Contest-Schedule @endsection

@section('f_content')
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
<form action="/c/contestSchedule/{{$contestt}}" method="POST">
    @csrf
        @foreach ($contests as $contest)
        @if (Auth::user()->username != $contest->creator)
            <style>
                .title, .save{
                    visibility: hidden;
                }
                input{
                    display: inline;
                }
            </style>

        @endif
        <div class="container p-2"  style="width: 80%; margin: auto; background-color: #fff;  border-radius: 5px;">
            @if (Auth::user()->username == $contest->creator)
                <div class="title justify-content-between d-flex" style="align-self: center; width: 80%; margin: auto; margin-top: 20px;">
                    <h3 style="padding-right: 50px;" class="page_title">Create Contest </h3>
                    <div class="d-flex">
                        <h6 class="pt-2 pl-2" style ="color: #494949">
                            <a class="anchor p-2" href="/c/toDetail/{{$contestt}}">Detail</a>  <strong> Schedule </strong>
                        </h6>
                        <h6 class="pt-2 pl-2" style ="color: #aaa">
                            <a class="anchor p-2" href="/c/toProblemNo/{{$contestt}}">No_of_problems</a>
                            @if ($contest->problems > 0)
                                <a class="anchor p-2" href="/c/toProblems/{{$contestt}}">Problems</a>
                            @else
                                Problems
                            @endif
                        </h6>
                    </div>
                </div>
            @else
                <div style="margin-left: 32%; font-size: 28px;" class="d-flex p-2">
                    <h2 id="viewonly"></h2>
                    <strong id="bold" style="margin-left: 10px; margin-top: -6px;"></strong>
                </div>
                <script>
                    document.getElementById('viewonly').innerHTML = "Schedule for contest ";
                    document.getElementById('bold').innerHTML = " {{$contest->name}}";
                </script>
            @endif

            {{-- <hr style="width: 85%; margin: auto;"> --}}
            <div class="pt-5 pb-1" style="padding-left: 11%;">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Contest Registration</strong></caption>
            </div>
            <table style="width: 89%; margin:auto;">
                <tr class="justify-content-between d-flex  p-4">
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Reg-Start-Date</label>
                        </div>
                        <div class="p-1" >
                    <?php
                            $date = new DateTime($contest->reg_start_time);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='reg_start_date' id="reg_start_date" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Reg-Start-Time</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->reg_start_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='reg_start_time' id="reg_start_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>

                <tr class="justify-content-between d-flex  p-4">
                    <td class="d-flex">
                        <div class="p-2">
                            <label class="pr-1" for="">Reg-End-Date</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->reg_end_time);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='reg_end_date' id="reg_end_date" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Reg-End-Time</label>
                        </div>
                        <div class="p-1" >
                            <?php
                            $date = new DateTime($contest->reg_end_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='reg_end_time' id="reg_end_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>
            </table>

            <hr style="width: 85%; margin: auto;">
            <div class="pt-5 pb-1" style="padding-left: 11%;">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Contest Period</strong></caption>
            </div>
            <table style="border-radius: 5px; width: 88%; margin:auto; background-color: #fff;">
                <tr class="justify-content-between d-flex  p-4">
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Start-Date</label>
                        </div>
                        <div class="p-1" >
                            <?php
                                $date = new DateTime($contest->start_time);
                                $year = $date -> format('Y');
                                $month = $date -> format('m');
                                $day = $date -> format('d');
                            ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='start_date' id="start_date" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Start-Time</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->start_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='start_time' id="start_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>

                <tr class="justify-content-between d-flex  p-4">
                    <td class="d-flex">
                        <div class="p-2">
                            <label class="pr-1" for="">End-Date</label>
                        </div>
                        <div class="p-1" >
                            <?php
                                $date = new DateTime($contest->end_time);
                                $year = $date -> format('Y');
                                $month = $date -> format('m');
                                $day = $date -> format('d');
                            ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='end_date' id="end_tdate" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">End-Time</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->end_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='end_time' id="end_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>
            </table>

            <hr style="width: 85%; margin: auto;">

            <div class="pt-5 pb-1" style="padding-left: 11%;">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Contest Freez</strong></caption>
            </div>
            <table style="border-radius: 5px; width: 85%; margin:auto; background-color: #fff;">
                <tr class="justify-content-between d-flex  p-3">
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Freez-Start-Date</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->freez_time);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='freez_start_date' id="freez_start_date" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Freez-Start-Time</label>
                        </div>
                        <div class="p-1" >
                        <?php
                            $date = new DateTime($contest->freez_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='freez_start_time' id="freez_start_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>
            </table>

            <table style="width: 87%; margin:auto;">
                <tr class="justify-content-between d-flex  p-4">
                    <td class="d-flex">
                        <div class="p-2">
                            <label class="pr-1" for="">Freez-End-Date</label>
                        </div>
                        <div class="p-2" >
                        <?php
                            $date = new DateTime($contest->unfreez_time);
                            $year = $date -> format('Y');
                            $month = $date -> format('m');
                            $day = $date -> format('d');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="date" class="form-control" name='freez_end_date' id="freez_end_date" value="{{$year.'-'.$month.'-'.$day}}">
                        </div>
                    </td>
                    <td class="d-flex">
                        <div class="p-2">
                            <label for="">Freez-End-Time</label>
                        </div>
                        <div class="p-2" >
                        <?php
                            $date = new DateTime($contest->unfreez_time);
                            $hour = $date -> format('h');
                            $minute = $date -> format('i');
                        ?>
                            <input @if (Auth::user()->username != $contest->creator) disabled="true" @endif
                                     type="time" class="form-control" name='freez_end_time' id="freez_end_time" value="{{$hour.':'.$minute}}">
                        </div>
                    </td>
                </tr>
            </table>


            <hr style="width: 85%; margin: auto;">

            <div class=" p-5 justify-content-between d-flex " style="width: 700px;">
                <div ></div>
                <div class="d-flex " style="margin-left: 100px;">
                    <a href="/c/toProblemNo/{{$contestt}}" style="margin-right: 20px; text-align: center; @if (Auth::user()->username != $contest->creator) display:none @endif "  class="anchor p-2" >Next</a>
                    <input style=" @if (Auth::user()->username != $contest->creator) display:none @endif " class="anchor p-2" type="submit" value="Save" >
                </div>
            </div>
            @endforeach
        </div>
    </form>
@endsection
