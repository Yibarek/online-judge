
@if ($contest_time == 'false')
@extends('layouts.app2')
@else
@extends('layouts.live1')
@endif

@section('title') Clarification @endsection

@section('content')

<style>
    option{
        color: #555;
    }
    .page_title {
    font-weight: 600;
    font-size: 22px;
    color: #000;
    padding-left: 20px;
}
label{
    font-size: 14px;
}
.contestant-list:hover{
    background-color: #e8eef6;
}
</style>

<div class="frame " style="width: 95%; margin: auto; background-color: #fff;">
    <form action="/lc/sendClarification/{{$contestt}}">
     <div>                                         {{--background-color: #123; --}}
    {{-- contestant --}}


     {{-- message    --}}
    <div style="width: 70%; margin: auto;">
    @foreach ($contests as $contest)
            @if ($contest->creator == Auth::user()->username)
                <div style="height: 40px; padding-left: 20px;"
                    class="d-flex p-2 justify-content-between ">
                    <div class="d-flex" style="width: 60%;">
                        {{-- <div class="ri ri-message-2-fill" width="30" height="30" style="background-color: white; border-radius: 13px; margin-right: 8px;"> --}}
                        <span class="page_title bi bi-messenger">     Clarification</span>
                    </div>

                    <div style="margin-right: 4px; padding-right: 4px; width: 40%" class="d-flex p-1">
                        <label for="#contestant" style="margin-right: 4px;"><strong>Contestants</strong></label>
                        <select name="contestant" id="contestant" style="width: 100%; height: 25px; border: 2px solid #eef6f9;">
                            <option value="all" >All</option>
                            @foreach ($contestants as $contestant)
                                <option value="{{$contestant->user}}" @if ($contestant->user == $selectedUser) selected="true" @endif>{{$contestant->user}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        @endforeach
    <div class="messages" style="border: 1px solid #bcd; margin-top: 7px; max-height: 440px; overflow: auto; background-color: white;" >

        <div class="p-2" id="messageContent" style=" width: 89%; margin: auto; max-height: fit-content;">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin')

            @foreach ($clarifications as $clarification)

            @if (($clarification->reciever == Auth::user()->username ) && ($clarification->sender == $selectedUser ))

            <div class="justify-content-between d-flex p-1">
                <div id="id{{$clarification->id}}">
                    <div class="p-1" style="width: 90%; margin: auto;">
                        <label >{{$clarification->sender}}</label>
                    </div>
                    <div style="max-width: 100%; height: fit-content;
                                background-color: #eef4f9; align-content: left;
                                color: #2378ca;
                                border: 1px solid #eee;
                                border-radius: 18px;"
                         class="p-2">

                        <div class="msg_content p-1" style= "width: fit-content; height: fit-content;">
                            {{$clarification->content}}
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <label style="font-style: italic; padding-left: 20px; " >{{$clarification->time}}</label>
                        <a></a>
                    </div>
                </div>
                <label href="" style="width: 30%;"></label>
            </div>
            @endif

            @if ((($clarification->sender == Auth::user()->username) && ($clarification->reciever == $selectedUser)) || ($clarification->sender == Auth::user()->username) && ($clarification->reciever == 'all'))
            <div class="d-flex justify-content-between p-1">
                <label href="" style="width: 30%"></label>
                <div id="id{{$clarification->id}}" style="max-width: 70%; width: fit-content; height: fit-content;
                                                       align-content: right;">
                    <div class="justify-content-between d-flex p-1" style="width: 95%; margin: auto; font-size: 20px;">
                        @if ($clarification->reciever_status == 'seen')
                            <div class="bi bi-check-all" style="font-size: 20px;"></div>
                        @elseif ($clarification->sender == 'sent')
                            <div class="bi bi-check"></div>
                        @else
                            <div class="bi bi-loading"></div>
                        @endif

                        <div class="pr-3 pb-1"><label >{{Auth::user()->username}}</label></div>
                    </div>
                    {{-- message box --}}
                    <div style="background-color: #3489db;
                                color: white;
                                madding-bottom: -10px;
                                border: 1px solid rgba(10, 120, 245, 0.788);
                                border-radius: 18px;"
                         class="p-2">
                        <div >{{$clarification->content}}</div>

                    </div>
                    <div class="d-flex justify-content-between">
                        <a></a>
                        <label style="font-style: italic; padding-right: 20px; " >{{$clarification->time}}</label>
                    </div>

                </div>
            </div>
            @endif

        @endforeach
        @else
            @foreach ($clarifications as $clarification)

                @if ((($clarification->reciever == Auth::user()->username || $clarification->reciever == 'all') && (Auth::user()->role == 'user' || Auth::user()->role == 'team')) ||
                    (($clarification->reciever == Auth::user()->username )))

                <div class="justify-content-between d-flex p-1">
                    <div id="id{{$clarification->id}}">
                        <div class="p-1" style="width: 90%; margin: auto;">
                            <label >{{$clarification->sender}}</label>
                        </div>
                        <div style="max-width: 100%; height: fit-content;
                                    background-color: #eef4f9; align-content: left;
                                    color: #2378ca;
                                    border: 1px solid #eee;
                                    border-radius: 18px;"
                            class="p-2">

                            <div class="msg_content p-1" style= "width: fit-content; height: fit-content;">
                                {{$clarification->content}}
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <label style="font-style: italic; padding-left: 20px; " >{{$clarification->time}}</label>
                            <a></a>
                        </div>
                    </div>
                    <label href="" style="width: 30%;"></label>
                </div>
                @endif

                @if ($clarification->sender == Auth::user()->username)
                <div class="d-flex justify-content-between p-1">
                    <label href="" style="width: 30%"></label>
                    <div id="id{{$clarification->id}}" style="max-width: 70%; width: fit-content; height: fit-content;
                                                        align-content: right;">
                        <div class="justify-content-between d-flex p-1" style="width: 95%; margin: auto; font-size: 20px;">
                            @if ($clarification->reciever_status == 'seen')
                                <div class="bi bi-check-all" style="font-size: 20px;"></div>
                            @elseif ($clarification->sender == 'sent')
                                <div class="bi bi-check"></div>
                            {{-- @else
                                <div class="bi bi-loading"></div> --}}
                            @endif

                            <div class="pr-3 pb-1"><label >{{Auth::user()->username}}</label></div>
                        </div>

                        <div style="background-color: #3489db;
                                    color: white;
                                    madding-bottom: -10px;
                                    border: 1px solid rgba(10, 120, 245, 0.788);
                                    border-radius: 18px;"
                            class="p-2">
                            <div >{{$clarification->content}}</div>

                        </div>
                        <div class="d-flex justify-content-between">
                            <a></a>
                            <label style="font-style: italic; padding-right: 20px; " >{{$clarification->time}}</label>
                        </div>

                    </div>
                </div>
                @endif
            @endforeach
        @endif
        </div>
    </div>

    <div class="p-2">
        <div class="action justify-content-between d-flex d-inline" style="align-content: center; margin-top: 9px; height: 54px;
                                                                          background-color: white; border: 1px solid #bcd;
                                                                          border-radius: 35px;">
            <input type="textarea" class="p-1 form-control" name="content" id="message" cols="73" placeholder="write your question here"
                        style="border: 1px solid #d5d5d5; border: none; width: 90%; height: 30px; margin-top: 11px; margin-left: 20px; margin-right: 20px;">
            <button type="submit" class="btn-primary p-2 ri ri-send-plane-fill" title="Send" style="padding-left: 10px; border-radius:20px; height: 40px; width: 40px;
                                        text-decoration: none; text-align: center; margin: 6px; border: none; font-size: 18px; background-color: #3489db;" value=""></button>
        </div>
    </div>
    </div>
    </div>
    </form>
</div>
@endsection

<script>
    // document.location.href = "#id{{$max}}";
</script>

@auth
    @if (Auth::user()->username == 'superadmin' || Auth::user()->username == $creator)
    @section('contestants')
    <div style ="border: 1px solid #eee; border-radius: 5px; width: 92%; margin: auto; background-color: white; min-width: 130px;" class="p-2">
        <div style="font-weight: bold; width: 100%; background-color: #fff; height: 28px; text-align: center; border-radius: 5px; margin-bottom: 5px;">
            <label style=" font-size: 17px; page_title">Contestants</label>
        </div>
        <div class="pt-3" style="font-size: 14px; overflow: auto;">

            <div style="max-height: 500px;">
                <?php $i = 1;?>
            @foreach ($contestants as $contestant)
            <div style="border: 1px solid #eee; border-radius: 16px; margin-bottom: 2px;" class="contestant-list p-1 d-flex">
                @foreach($users as  $user)
                    @if($user->username == $contestant->user)
                        <div style="margin-right: 5px;"><img src="../../../image/profile/{{$user->profile_image}}" alt="" width="30" height="30"></div>
                        <?php $i++; ?>

                    @endif

                @endforeach

                <div><a style="cursor: pointer;" href="/lc/selectChat/{{$contestant->user}}/{{$contestt}}" class="anc">{{ $contestant->user }}</a></div>
            </div>
            @endforeach
        </div>
        </div>
    </div>
    @endsection

    @endif
@endauth
@section('contestants')
<div style ="border: 1px solid #eee; border-radius: 5px; width: 92%; margin: auto; background-color: white; min-width: 130px;" class="p-2">
    <div style="font-weight: bold; width: 100%; background-color: #fff; height: 28px; text-align: center; border-radius: 5px; margin-bottom: 5px;">
        <label style=" font-size: 17px; page_title">Contestants</label>
    </div>
    <div class="pt-3" style="font-size: 14px; overflow: auto;">

        <div style="max-height: 500px;">
            <?php $i = 1;?>
        @foreach ($contestants as $contestant)
        <div style="border: 1px solid #eee; border-radius: 16px; margin-bottom: 2px;" class="contestant-list p-1 d-flex">
            @foreach($users as  $user)
                @if($user->username == $contestant->user)
                    <div style="margin-right: 5px;"><img src="../../../image/profile/{{$user->profile_image}}" alt="" width="30" height="30"></div>
                    <?php $i++; ?>

                @endif

            @endforeach

            <div><a style="cursor: pointer;" href="/lc/selectChat/{{$contestant->user}}/{{$contestt}}" class="anc">{{ $contestant->user }}</a></div>
        </div>
        @endforeach
    </div>
    </div>
</div>
@endsection

{{-- <script>
    function selectChat() {
        var xhttp;
        //   if (str == "") {
        //     document.getElementById("txtHint").innerHTML = "";
        //     return;
        //   }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                clarification = JSON.parse(this.responseText);

                var output = '';

                output = '12312313 @foreach ($clarifications as $clarification)'+'@if ((($clarification->reciever == Auth::user()->username || $clarification->reciever == "all") && (Auth::user()->role == "user" || Auth::user()->role == "team")) || (($clarification->reciever == Auth::user()->username ) && (Auth::user()->role == "admin" || Auth::user()->role == "superadmin")))'+'<div class="justify-content-between d-flex p-1">'+
 '   <div id="id{{$clarification->id}}">'+
  '      <div class="p-1" style="width: 90%; margin: auto;">'+
   '         <label >{{$clarification->sender}}</label>'+
   '     </div>'+
    '    <div style="max-width: 100%; height: fit-content;'+
     '               background-color: #eef4f9; align-content: left;'+
      '              color: #2378ca;'+
       '             border: 1px solid #eee;'+
        '            border-radius: 18px;"'+
         '    class="p-2">'+

 '           <div class="msg_content p-1" style= "width: fit-content; height: fit-content;">'+
  '              {{$clarification->content}}'+
   '         </div>'+
    '    </div>'+

 '       <div class="d-flex justify-content-between">'+
  '          <label style="font-style: italic; padding-left: 20px; " >{{$clarification->time}}</label>'+
   '         <a></a>'+
     '   </div>'+
   ' </div>'+
   ' <label href="" style="width: 30%;"></label>'+
'</div>'+
'@endif'

'@if ($clarification->sender == Auth::user()->username)'+
'<div class="d-flex justify-content-between p-1">'+
 '   <label href="" style="width: 30%"></label>'+
  '  <div id="id{{$clarification->id}}" style="max-width: 70%; width: fit-content; height: fit-content;'+
   '                                        align-content: right;">'+
    '    <div class="justify-content-between d-flex p-1" style="width: 95%; margin: auto; font-size: 20px;">'+
     '       @if ($clarification->reciever_status == "seen")'+
      '          <div class="bi bi-check-all" style="font-size: 20px;"></div>'+
       '     @elseif ($clarification->sender == "sent")'+
        '        <div class="bi bi-check"></div>'+
         '   @else'+
          '      <div class="bi bi-loading"></div>'+
           ' @endif'+
           ' <div class="pr-3 pb-1"><label >{{Auth::user()->username}}</label></div>'+
 '       </div>'+

 '       <div style="background-color: #3489db;'+
  '                  color: white;'+
   '                 madding-bottom: -10px;'+
    '                border: 1px solid rgba(10, 120, 245, 0.788);'+
     '               border-radius: 18px;"'+
      '       class="p-2">'+
       '     <div >{{$clarification->content}}</div>'+

 '       </div>'+
  '      <div class="d-flex justify-content-between">'+
   '         <a></a>'+
    '        <label style="font-style: italic; padding-right: 20px; " >{{$clarification->time}}</label>'+
     '   </div>'+

 '   </div>'+
'</div>'+
'@endif'
'<br>'+
'@endforeach;'+
                document.getElementById('messageContent').innerHTML = output;

            }
            else{
                document.getElementById("messageContent").innerHTML = 'Not Found';
            }
        };
        xhttp.open("GET", "/loadMessage/yitbe", true);
        xhttp.send();
    }
</script> --}}
