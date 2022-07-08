@extends('layouts.app2')
@extends('layouts.upcomming_c')

@section('title') Contestants @endsection

@section('f_content')
<style>
    .page_title {
    font-weight: 600;
    font-size: 22px;
    color: #333;
    padding-left: 20px;
}
</style>
<?php $creator = ''?>
@foreach ($contest as $cc)
    <?php $creator =$cc->creator?>
@endforeach

    <div class="container" style="height: 700px; min-width: 450px; width: 80%; margin:auto;
        @foreach ($contest as $c)
            @if ($c->status == "upcomming")
                width: 95%;
            @else
                width: 55%;
                margin-left: 23%;
            @endif
        @endforeach
        background-color: #fff;
        border-radius: 10px;">
        <div class ="p-5">

        <div class="page_title" style="padding-left: 40px; width: 100%; margin-top: -15px; margin-bottom: 10px;">
            <label style = "padding-top: 5px;">Contestants</label>
        </div>

        <table class="table table-hover table-sm" style="text-align: center; padding-left: 40px; min-width: 400px; width: 100%" >
            <thead>
            <tr style="height: 35px;">

                <th style="min-width: 20px; width: 5%" scope="col">No</th>
                <th style="min-width: 150px; " scope="col">User</th>
                @foreach ($contest as $c)
                    @if ($c->status == "upcomming")
                        <th style="min-width: 150px; width: 25%" scope="col">Status</th>
                        @if (Auth::user()->username == $creator)
                            <th style="min-width: 150px; width: 25%" scope="col">Aciton</th>
                        @endif
                    @endif
                @endforeach

            </tr>
            </thead>
            <tbody>

                <?php
                $no = 0;
                ?>

                @foreach ($contestants as $user)
                @if ((Auth::user()->role == "user" && $user->status != 'Rejected') || (Auth::user()->role == "team" && $user->status != 'Rejected'))
                    <tr>
                    <th scope="row">{{ ++$no }}</th>
                    <td><a href="#" style="text-decoration: none;">{{ $user->user}}</a></td>
                    @if ($user->status == 'Accepted')
                        {{-- <td style="color: green;">{{$user->status}}</td>badge bg-success --}}
                        <td class="badge bg-success">{{$user->status}}</td>
                    @elseif ($user->status == 'Rejected')
                        {{-- <td style="color: rgba(236, 32, 32, 0.822);">{{$user->status}}</td> --}}
                        <td class="badge bg-success">{{$user->status}}</td>
                    @else
                        {{-- <td>{{$user->status}}</td> --}}
                        <td class="badge bg-warning" >{{$user->status}}</td>
                    @endif
                    </tr>
                @endif
                @if (Auth::user()->username == $creator)
                <tr>
                    <th scope="row">{{ ++$no }}</th>
                    <td><a href="#" style="text-decoration: none;">{{ $user->user }}</a></td>
                    @if ($c->status == "upcomming")
                        {{-- <td id="action">{{ $user->status }}</td> --}}
                        @if ($user->status == 'Accepted')
                        {{-- <td style="color: green;">{{$user->status}}</td>badge bg-success --}}
                        <td class="badge bg-success">{{$user->status}}</td>
                    @elseif ($user->status == 'Rejected')
                        {{-- <td style="color: rgba(236, 32, 32, 0.822);">{{$user->status}}</td> --}}
                        <td class="badge bg-danger">{{$user->status}}</td>
                    @else
                        {{-- <td>{{$user->status}}</td> --}}
                        <td class="badge bg-warning" >{{$user->status}}</td>
                    @endif
                        @foreach ($contest as $c)
                        <td>
                            @if ($user->status == "Pending" || $user->status == "Rejected")
                                <a href="/contestant/accept/{{ $user->id }}"
                                style="text-decoration: none;"
                                class="btn-primary btn-sm">Accept</a>
                            @endif
                            @if ($user->status == "Accepted")
                                <a href="/contestant/reject/{{ $user->id }}"
                                style="text-decoration: none;"
                                class="btn-danger btn-sm">Reject</a>
                            @endif
                        </td>
                    @endforeach
                    @endif
                    </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class=" pagination-nav">
                        {{ $contestants->onEachSide(1)->links()}}
                    </td>
                  </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection

