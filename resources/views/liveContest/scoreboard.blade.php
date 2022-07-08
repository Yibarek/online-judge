
@if ($contest_time == 'false')
@extends('layouts.app2')
@else
@extends('layouts.live')
@endif

@section('title') Score Board @endsection

@section('content')

<div class=" p-2" style="width: 95%; margin: auto;
                          border-radius: 5px;
                          border: #eee;
                          background-color: white;">
  <div class="pl-3 pb-2">

  </div>
  <?php $mn_width = 145 +($problem_no * 52)?>
  <div class="container pl-3"
  style="height: 700px; min-width: {{$mn_width}}px; ">



    <div style ="border-radius: 5px;">
    <div class="" style="padding-left: 20px; width: 100%; background-color: #fff; height: 30px; border-radius: 5px;">
      <label class="page-title" style = "font-size: 23px;"><strong>Scoreboard</strong></label>
    </div>

    <table class="table table-hover table-sm" style="font-size: 14px; aline-content: center;">
        <thead>

          <tr style="height: 30px;">
            <th style="min-width: 20px; width: 5%" scope="col" rowspan="2">RN</th>
            <th style="min-width: 110px; width: 300px;" scope="col" rowspan="2">Contestant</th>
            <th style="min-width: 10px; width: 15px; text-align: center;" scope="col" rowspan="2">SC</th>
            <th style="min-width: 10px; width: 15px; text-align: center;" scope="col" rowspan="2">min</th>

            <th style=" text-align: center;" scope="col" colspan="{{$problem_no}}">Problems</th>
          </tr>

          <tr>
            @foreach ($problems as $problem)
              <th style="margin: auto; width: 60px; min-width: 47px;  text-align: center;" scope="col">{{$problem->p_in_s}}</th>
            @endforeach
          </tr>

        </thead>
        <tbody>
          {{-- variable diclaration --}}
          <?php $rank=1; $freez=false; $submission_time=0; $freez_time=0; $freez_end=0; $minute=0;?>

          @foreach ($competants as $competant)
          <tr>
            <th style ="" scope="row">{{ $competant->rank}}</th>
            <td><a href="#" style="text-decoration: none;">{{$competant->user}}</a></td>
            <td style="text-align: center;">{{$competant->total_solved}}</td>
            <td style="text-align: center;">{{$competant->minute}}</td>

            @foreach ($problems as $problem)
            {{-- {{$first_solved[$problem->p_in_s]}} --}}
              <?php $try = 0; $accepted = false;?>
              @foreach ($submissions as $submission)
                @if ($submission->user == $competant->user && $submission->p_in_s == $problem->p_in_s)

                  <?php $try++;?>
                  @if ($submission->verdict == 'Accepted')
                    <?php $accepted = true;
                      $submission_time = $submission->date;
                      $minute = $submission->minute;
                      // $now = new date();
                      break;
                    ?>
                  @endif

                @endif
              @endforeach

              @auth
                @if ((strtotime("now")>=strtotime($freez_start) && strtotime("now")<=strtotime($freez_end) &&
                    strtotime($submission_time)>=strtotime($freez_start) && strtotime($submission_time)<=strtotime($freez_end)) ||
                    Auth::user()->role != 'superadmin' && Auth::user()->username != $creator)
                    @if (($accepted == false && $try > 0) || ($accepted == true))
                        <td style="background-color: rgb(134, 136, 253);  text-align: center; height: 35px;" > {{--first solved--}}
                        <div style="align-self: center;">
                            <label>{{$try}} try</label>
                            <label></label>
                        </div>
                        </td>
                    @else
                        <td style="height: 35px;"></td>
                    @endif

                @else
                    @if ($accepted == true)
                        <td style="
                            @if ($minute == $problem->firstsolved)
                                background-color: rgb(2, 150, 2); color: #fff;
                            @elseif ($minute > $problem->firstsolved)
                                background-color: rgb(100, 225, 100);
                            @endif

                            text-align: center;" > {{--first solved--}}
                            <div>
                                <strong class="justify-content-center">{{$minute}}</strong>
                                <div style="align-self: center;">
                                    <label>{{$try}} try</label>
                                </div>
                            </div>
                        </td>
                    @elseif ($accepted == false && $try > 0)
                        <td rowpan="2" class="pt-2" style="background-color: rgb(255, 145, 136); text-align: center; height: 40px;" > {{--first solved--}}
                            {{-- <strong style="color: rgb(243, 99, 92)">.</strong> --}}
                            <div style="align-self: center;">
                            <label>{{$try}} try</label>
                            </div>
                        </td>
                    @else
                        <td style="height: 35px;"></td>
                    @endif
                @endif
            @else
                @if ($accepted == true)
                    <td style="
                        @if ($minute == $problem->firstsolved)
                            background-color: rgb(2, 150, 2); color: #fff;
                        @elseif ($minute > $problem->firstsolved)
                            background-color: rgb(100, 225, 100);
                        @endif

                        text-align: center;" > {{--first solved--}}
                        <div>
                        <strong class="justify-content-center">{{$minute}}</strong>
                        <div style="align-self: center;">
                            <label>{{$try}} try</label>
                        </div>
                        </div>
                    </td>
                @elseif ($accepted == false && $try > 0)
                    <td rowpan="2" class="pt-2" style="background-color: rgb(255, 145, 136); text-align: center; height: 40px;" > {{--first solved--}}
                        {{-- <strong style="color: rgb(243, 99, 92)">.</strong> --}}
                        <div style="align-self: center;">
                        <label>{{$try}} try</label>
                        </div>
                    </td>
                @else
                    <td style="height: 35px;"></td>
                @endif
            @endauth
            {{-- @endif --}}

            {{-- <td style="background-color: rgb(2, 185, 2);" >    accepted --}}
            @endforeach
            </tr>
            <?php ?>
          @endforeach
          <tfoot>
            <tr>
              <td colspan="4" class=" pagination-nav">
                  {{$competants->onEachSide(1)->links()}}
              </td>
            </tr>
        </tfoot>
          </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('colorValue')
<div class="p-2" style="width: 98%; margin: auto;
                         background-color: #fff;
                         border-radius: 5px;
                         border: 1px; border: #eee;
                         font-weight: 700;">
  <div style="font-size: 19px; color: #222; text-align: center;">
    <label>Colors</label>
  </div>
  <div class="p-3">
    <table style="width: 70%; min-width: 100px; margin:auto; color: #222;" class="p-3">
        <tr style=" height: 40px; text-align: center;">
          <td style="box-shadow: 1px 5px 10px 1px rgba(20, 150, 20, 0.7); background-color: rgb(20, 150, 20);  color: rgb(255, 255, 255);">First Solved</td>
          {{-- <td class="p-2" style="font-size: 15px;">First Solved</td> --}}
        </tr>

        <tr style=" height: 40px; text-align: center;">
          <td style="box-shadow: 1px 5px 10px 0px rgba(100, 225, 100, 0.7); background-color: rgb(100, 225, 100);">Solved</td>
          {{-- <td class="p-2" style="font-size: 15px;">Solved</td> --}}
        </tr>

        <tr style=" height: 40px; text-align: center;">
          <td style="box-shadow: 1px 5px 10px 0px rgba(255, 145, 136, 0.7); background-color: rgb(255, 145, 136);">Error</td>
          {{-- <td class="p-2" style="font-size: 15px;">Error</td> --}}
        </tr>

        <tr style=" height: 40px; text-align: center;">
          <td style="box-shadow: 1px 5px 10px 0px rgba(134, 136, 253, 0.7); background-color: rgb(134, 136, 253);">Judging</td>
          {{-- <td class="p-2" style="font-size: 15px;">Judging</td> --}}
        </tr>
    </table>
  </div>
</div>
@endsection
