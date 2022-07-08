@extends('layouts.app2')

@section('f_content')

<div style="width: 80%; min-width: ; margin: auto;">
    <?php $j=1; ?>
    @foreach ($contest as $c)
    <?php $j++; ?>
    @if ($c->registration == 'completed')

    <div class="pb-4" style="">
    <div class="p-4" style=" background-color: white; border-radius: 5px; border: 1px solid #eee;">

        <div class="d-flex justify-content-between">
        <div>
            <label class="page_title">{{$c->name}}</label>
            @section('title'){{$c->name}}@endsection
        </div>
        <div style="background-color: white; width: 50%; height: 45px; margin-left: 20px; margin-bottom: 5px;"
            class=" d-flex justify-content-between">
            <div></div>

            <div class="p-2 d-flex">
                @if ($c->status == "passed")
                <table style="min-width: 300px;">
                    <tr>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2" style=""
                                    href="/c/toSchedule/{{$c->id}}">schedule</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/contestants/{{$c->id}}">Contestants</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/scoreboard/{{$c->id}}">scoreboard</a>
                        </td>
                    </tr>
                </table>
                @else
                <table style="min-width: 200px;">
                    <tr>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                    href="/c/toSchedule/{{$c->id}}">schedule</a>
                        </td>
                        <td style="padding-right: 15px;">
                            <a class="anchor p-2"
                                href="/lc/contestant/{{$c->id}}">Contestants</a>
                        </td>
                    </tr>
                </table>
                @endif
            </div>
        </div>
    </div>

        <div>
            Created By <label style="color: rgb(200, 160, 2)">{{$c->creator}}</label>
        </div>
        <div style="width: 100%; height: fit-content; border-left: 2px solid gray;" class="">
            <div style="padding-left: 10px;">

                <div class="d-flex" style="height: 300px;">
                    <textarea style="min-width: 60%; height: 100%; padding-top: 10px; padding-right: 15px; overflow: hidden; border: none; resize: none;"disabled ="true" cols="100%;">
                        {{$c->description}}
                    </textarea>
                    <div style="max-width: 40%; width: fit-content; height: 100%; max-height: 200px; align-self: center;" >
                        <img src="../../image/contest/{{$c->logo}}" alt="no" style="width: 100%;">
                    </div>
                </div>

                <div style="padding-top: 15px;">
                    <div style="padding-bottom: 8px;">
                        <strong>Contest Type: </strong>{{$c->type}}
                    </div>

                    <div style="padding-bottom: 8px;">
                        <strong>Contest Place: </strong>{{$c->place}}
                    </div>

                    <div style="padding-bottom: 8px;">
                        <strong>Official contestants: </strong>{{$c->officials}}
                    </div>
                </div>

                @if ($c->status == "passed")
                <div style="">
                    <div style="padding: 5px; font-weight: 600;">Conttest Winners: </div>
                    <?php $counter = 1; ?>
                    @while ($counter <= $c->winners)
                        <div style="padding-left: 15%; padding-bottom: 5px; font-weight: 500; color: rgb(16, 109, 44);">
                            <label>{{$counter}}, </label><label style="color: #fff">...</label><label> {{$winners[$c->id][$counter]}}</label>
                            <?php $counter++; ?>
                        </div>
                    @endwhile
                </div>
                @endif

                <div class="p-2">
                    <strong>Sponsers: </strong>
                    {{$c->sponsers}}
                    <div style="border: 1px solid red; max-width: 30%; width: fit-content; height: fit-content; max-height: 200px; align-self: center;" >
                        <img src="{{$c->logo}}" alt="no">
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    @endif
    @endforeach

</div>
<div style="background-color: #fff;
            width: 80%; margin: auto;
            border-radius: 5px;
            border: 1px solid #eee;
            margin-bottom: 20px;
            min-height: 85px;">
    <div style="margin-top: 20px; margin-left: 30px;">
        @if ($j == 1)
            <div style="text-align: center;">
                <div class="not-found">
                    <h3 class="p-2">Invalid access</h3>
                    <h6 class="p-2">No such Contest is Found</h6>
                </div>
            </div>
        @endif
    </div>
</div>
</div>
@endsection

