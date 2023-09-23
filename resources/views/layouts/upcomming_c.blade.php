
@section('contest')
<?php $ready_contest = 0; ?>
@foreach ($Contests as $contest)
    @if ($contest->registration == 'completed')
        <?php $ready_contest++;?>
    @endif
@endforeach
@if ($contestt == 0)
    @if ($ready_contest > 0)

<form register="">
    <?php $i=0;?>
    <div id ="full_panel p-2" style="border-radius: 5px; background-color: white; border: 1px solid #f1f1f1; min-width: 150px; width: 97%; padding-left: 6%; margin:auto; align-content: center;">
        <div style="font-weight: bold; width: 92%; height: 28px; margin-bottom: 7px;">
            <label style=" font-size: 17px; margin-top: 8px;" class="p-2">Upcomming Contest</label>
        </div>
        <div style="color: white;">.</div>
            @foreach ($Contests as $contest)
            @if ($contest->registration == 'completed')
            <?php $c_id = $contest->id ?>
            <div id ="panel{{$i}}" class="div p-3" style ="align-content: center;">
                <?php $i++?>
                <table>
                    <tr><td class="">
                        <a class="" href="/c/Detail/{{$contest->id}}" style =";text-decoration: none;" id="contest{{$c_id}}" >{{$contest->name}}</a></td>
                    </tr>
                    <tr style="text-align: center;"><td>
                        <!-- Display the countdown timer in an element -->
                        <strong id="time{{$c_id}}" style="width: 100%; margin: auto; color: #555; letter-spacing: 1px;"></strong></td>
                    </tr>
                    <tr style="text-align: center;">
                        <td class="" style="">
                            <a id="time_left{{$c_id}}" type="hidden" class="" style="color: #777;"></a>
                            <a id="enter{{$c_id}}" type="hidden" class="btn btn-link pl-3" style="text-align: center;" href = "/p/{{$c_id}}"></a>
                            <a id="register{{$c_id}}" type="hidden" class="btn btn-link pl-3" style="text-align: center;" data-bs-toggle="modal" data-bs-target="#popup{{$c_id}}"></a>
                            <a id="contestant{{$c_id}}" type="hidden" href="/lc/contestants/{{$c_id}}" style="text{{$c_id}}-decoration: none;"></a>
                            <a id="complete{{$c_id}}" type="hidden" class="btn btn-link pl-3" style="text-align: center;" data-bs-toggle="modal" data-bs-target="#winners{{$c_id}}"></a>

                        </td>
                    </tr>

                </table>

            </div>

            <script>

                // Set the date we're counting down to

                var count = '<?=$Count?>';

                // for (let i = 0; i < count; i++) {
                    var Reg_start{{$c_id}} = '<?=$contest->reg_start_time?>';
                    var Reg_end{{$c_id}} = '<?=$contest->reg_end_time?>';
                    var contest_start{{$c_id}} = '<?=$contest->start_time?>';
                    var contest_end{{$c_id}} = '<?=$contest->end_time?>';

                    contest_start{{$c_id}} = new Date(contest_start{{$c_id}}).getTime();
                    contest_end{{$c_id}} = new Date(contest_end{{$c_id}}).getTime();

                    // var id = '<?=$contest->id?>';

                    Reg_start{{$c_id}} = new Date(Reg_start{{$c_id}}).getTime();
                    Reg_end{{$c_id}} = new Date(Reg_end{{$c_id}}).getTime();

                    // Update the count down every 1 second
                    var x{{$c_id}} = setInterval(function() {

                    var now{{$c_id}} = new Date().getTime();

                    // Find the end_distance between now and the count down date
                    var start_time{{$c_id}} = Reg_start{{$c_id}} - now{{$c_id}};
                    var end_time{{$c_id}} = Reg_end{{$c_id}} - now{{$c_id}};

                    // Time calculations for days, hours, minutes and seconds to register
                    var days1{{$c_id}} = Math.floor(start_time{{$c_id}} / (1000 * 60 * 60 * 24));
                    var hours1{{$c_id}} = Math.floor((start_time{{$c_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes1{{$c_id}} = Math.floor((start_time{{$c_id}} % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds1{{$c_id}} = Math.floor((start_time{{$c_id}} % (1000 * 60)) / 1000);

                    // Time calculations for days, hours, minutes and seconds for restration to end
                    var days2{{$c_id}} = Math.floor(end_time{{$c_id}} / (1000 * 60 * 60 * 24));
                    var hours2{{$c_id}} = Math.floor((end_time{{$c_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes2{{$c_id}} = Math.floor((end_time{{$c_id}} % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds2{{$c_id}} = Math.floor((end_time{{$c_id}} % (1000 * 60)) / 1000);

                    // If registration time is not yet reached
                    if(start_time{{$c_id}} > 0){
                            document.getElementById("time{{$c_id}}").innerHTML = days1{{$c_id}} + "d " + hours1{{$c_id}} + ": "
                            + minutes1{{$c_id}} + ": " + seconds1{{$c_id}};
                            document.getElementById("time_left{{$c_id}}").innerHTML = "Before register";
                        }

                    // If registration time is reached
                    else if (end_time{{$c_id}} > 0) {
                        @auth
                            @if ($con_reg[$c_id] == $c_id)
                                clearInterval(x{{$c_id}});
                                enter();

                            @elseif ((Auth::user()->role == 'team' && $contest->type == 'Team') ||
                                    (Auth::user()->role == 'user' && $contest->type == 'Individual'))

                                        document.getElementById("time_left{{$c_id}}").innerHTML = "";
                                        document.getElementById("register{{$c_id}}").innerHTML = "Register";

                                        document.getElementById('time{{$c_id}}').innerHTML = days2{{$c_id}} + "d " + hours2{{$c_id}} + ": "
                                                                                    + minutes2{{$c_id}} + ": " + seconds2{{$c_id}};
                            @else
                                document.getElementById('time{{$c_id}}').innerHTML = days2{{$c_id}} + "d " + hours2{{$c_id}} + ": "
                                                                                    + minutes2{{$c_id}} + ": " + seconds2{{$c_id}};
                                document.getElementById("time_left{{$c_id}}").innerHTML = "Before Register End";
                            @endif
                        @endauth

                    }
                    else{
                        clearInterval(x{{$c_id}});
                        enter();
                    }
                    }, 1000);

                    clearInterval(x{{$c_id}});
                    enter();

                    // count down for contest time
                    function enter(){
                        var contest_start{{$c_id}} = '<?=$contest->start_time?>';
                        var contest_end{{$c_id}} = '<?=$contest->end_time?>';

                        contest_start{{$c_id}} = new Date(contest_start{{$c_id}}).getTime();
                        contest_end{{$c_id}} = new Date(contest_end{{$c_id}}).getTime();

                        var x1{{$c_id}} = setInterval(function() {
                        var now1{{$c_id}} = new Date().getTime();

                        // Find the distance between now and the count down date
                        var start_time1{{$c_id}} = contest_start{{$c_id}} - now1{{$c_id}};
                        var end_time1{{$c_id}} = contest_end{{$c_id}} - now1{{$c_id}};

                        // Time calculations for days, hours, minutes and seconds to start contest
                        var days3{{$c_id}} = Math.floor(start_time1{{$c_id}} / (1000 * 60 * 60 * 24));
                        var hours3{{$c_id}} = Math.floor((start_time1{{$c_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes3{{$c_id}} = Math.floor((start_time1{{$c_id}} % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds3{{$c_id}} = Math.floor((start_time1{{$c_id}} % (1000 * 60)) / 1000);

                        // Time calculations for days, hours, minutes and seconds for contest to end
                        var days4{{$c_id}} = Math.floor(end_time1{{$c_id}} / (1000 * 60 * 60 * 24));
                        var hours4{{$c_id}} = Math.floor((end_time1{{$c_id}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes4{{$c_id}} = Math.floor((end_time1{{$c_id}} % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds4{{$c_id}} = Math.floor((end_time1{{$c_id}} % (1000 * 60)) / 1000);

                        // If contest time is not yet reached
                        if(start_time1{{$c_id}} > 0) {
                            document.getElementById("time{{$c_id}}").innerHTML = days3{{$c_id}} + "d " + hours3{{$c_id}} + ": "
                                + minutes3{{$c_id}} + ": " + seconds3{{$c_id}};
                                var label{{$c_id}} =document.getElementById("contestant{{$c_id}}");

                           @auth
                            @if ($con_reg[$c_id] == $c_id)
                                    @foreach ($Contestants as $contestant)
                                        if(end_time1{{$c_id}} > 0){
                                            @foreach ($Contestants as $contestant)
                                                @if ($contestant->status == 'Accepted')
                                                    // document.getElementById("enter{{$c_id}}").innerHTML = "Enter"
                                                @else
                                                    document.getElementById("time_left{{$c_id}}").innerHTML="Before Contest End";
                                                @endif
                                            @endforeach
                                        }
                                        @if ($contestant->contest == $c_id)
                                            @if ($contestant->status == 'Pending')
                                                label{{$c_id}}.innerHTML = "Registered";
                                            @elseif ($contestant->status == 'Accepted')
                                                label{{$c_id}}.style.color = "green";
                                                label{{$c_id}}.innerHTML = "Registered";
                                            @else
                                                label{{$c_id}}.innerHTML = "Rejected";
                                                label{{$c_id}}.style.color = "red";
                                            @endif
                                        @endif
                                    @endforeach
                                @elseif ((Auth::user()->role == 'team' && $contest->type == 'Team') ||
                                    (Auth::user()->role == 'user' && $contest->type == 'Individual'))

                                        document.getElementById("time_left{{$c_id}}").innerHTML = "";
                                        document.getElementById("register{{$c_id}}").innerHTML = "Register";

                                        document.getElementById('time{{$c_id}}').innerHTML = days2{{$c_id}} + "d " + hours2{{$c_id}} + ": "
                                                                                    + minutes2{{$c_id}} + ": " + seconds2{{$c_id}};
                                @else
                                    document.getElementById("time_left{{$c_id}}").innerHTML="Before Contest";

                                @endif

                           @endauth
                            }

                        // If contest start time is reached
                        else if (end_time1{{$c_id}} > 0) {
                            document.getElementById("time_left{{$c_id}}").innerHTML = "";
                                document.getElementById("register{{$c_id}}").innerHTML = "";
                                document.getElementById("contestant{{$c_id}}").innerHTML = "";
                                document.getElementById('time{{$c_id}}').innerHTML = days4{{$c_id}} + "d " + hours4{{$c_id}} + ": "+ minutes4{{$c_id}} + ": " + seconds4{{$c_id}};
                        @auth
                            @if ((Auth::user()->role == 'admin' && Auth::user()->username == $creator) || Auth::user()->role ==  'superadmin')
                                document.getElementById("enter{{$c_id}}").innerHTML = "Enter"
                            @else
                                if ({{$con_reg[$c_id]}} == {{$c_id}}) {//check status
                                    @foreach ($Contestants as $contestant)
                                        @if ($contestant->status == 'Accepted')
                                            document.getElementById("enter{{$c_id}}").innerHTML = "Enter"
                                        @else
                                            document.getElementById("time_left{{$c_id}}").innerHTML="Before Contest End";
                                        @endif
                                    @endforeach
                                }
                                else{
                                    document.getElementById("time_left{{$c_id}}").innerHTML="Before Contest End";
                                }

                            @endif
                        @endauth
                            }
                        // If the contesttime is finished, display some information
                        else {
                            document.getElementById("register{{$c_id}}").innerHTML = "";
                            document.getElementById("enter{{$c_id}}").innerHTML = "";
                            document.getElementById("contestant{{$c_id}}").innerHTML = "";
                            document.getElementById("time{{$c_id}}").innerHTML = "Finished";
                            document.getElementById("time_left{{$c_id}}").innerHTML = "";
                        @auth
                            @if ($contest->creator == Auth::user()->username)
                                document.getElementById("complete{{$c_id}}").innerHTML = "Complete Contest";
                            @endif
                        @endauth
                            clearInterval(x1{{$c_id}});
                        }
                        }, 1000);
                        }
                // }
            </script>
            <hr style="margin-right: 10px;">

            {{-- contest rule modal start--}}
            <div style="height: 100%; width: 100%; margin: auto; display: none;"
                class="modal fade" id="popup{{$c_id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" style="overflow: auto; height: 90%;">
                        <div class="modal-header" style="height: 30px;">
                            <div class="modal-title" id="staticBackdropLabel">
                                <h6>Contest Terms</h6>
                            </div>

                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body pt-1" >
                                <textarea name="" disabled = "true" id="" style="width: 100%; margin: auto; height: 85%; margin-top: 20px;">
                The registration confirms that you:


* have read the contest rules
* will not violate the rules
* will not communicate with other participants, use another person's code for solutions/generators, share ideas of solutions and hacks
* will not attempt to deliberately destabilize the testing process and try to hack the contest system in any form
* will not use multiple accounts and will take part in the contest using your personal and the single account.

                                </textarea>
                                <div class="modal-footer navbar">
                                    <a class="button p-2 getstarted"
                                            href="/lc/add/contestant/{{$c_id}}"
                                            style="border: none;">Agree</a>
                                </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- modal end--}}

            {{-- winners modal start--}}
            <div style="height: 100%; width: 100%; margin: auto; display: none;"
                class="modal fade" id="winners{{$c_id}}" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content" style="overflow: auto; height: 40%;">
                        <div class="modal-header" style="height: 30px;">
                            <div class="modal-title" id="staticBackdropLabel">
                                <h6>Contest Winners</h6>
                            </div>

                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <form action=""></form>
                        <div class="modal-body pt-1" >
                            <form action="/lc/complete/{{$c_id}}">
                                <div class="pt-4"> Number of winners</div>
                                <input type="number"
                                        name="winners" id="winners"
                                        style="width: 100%; margin: auto; margin-top: 20px;"></input>

                                <div class="modal-footer navbar">
                                    <input class="button p-2 getstarted"
                                            type="submit"
                                            style="border: none; margin-top: 30px;"
                                            value="Agree">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            {{-- modal end--}}
        @endif
        @endforeach
    </div>
</form>
@endif
@endif
@endsection

