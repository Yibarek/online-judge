@extends('layouts.live')
@extends('layouts.app')
@extends('layouts.submit')
@extends('layouts.upcomming_c')

@section('title') {{$problem->name}} @endsection

@section('content')
    <div class="container navbar-expand-lg " style="
                    left: 50%;
                    right: 50%;
                    /* margin-left: -50vw; */
                    /* margin-right: -50vw; */
                    max-width: 100vw;
                    width: 95%;
                    border: 1px solid #eee;
                    border-radius: 5px;
                    /* float: left; */
                    background-color: #fff">
         {{-- <div style="background-color: #fff, width: 95%; margin: auto; min-width: 600px; border: 1px solid #f1f1f1;">            --}}
        <div class="problem p-3" style=" max-width: 860px; width: 100%; margin: auto;
                                        background-color: #fff; color: #fff;
                                        height: 2200px; overflow: hidden;
                                        padding-left: 20%; padding-right: 20%;">

            <object style="width: 100%; margin: auto; height: 100%;
                                                                 background-color: #fff;
                                                                 "
                    data="../../file/problems/{{$problem->pdf_file}}#toolbar=0" type="" internalid="1D2D17AC156EC59F114AEF60F1A51CAD">
                    <embed name="1D2D17AC156EC59F114AEF60F1A51CAD" style="width: 100%; margin: auto; height: 100%;
                                                                 background-color: #fff;
                                                                 "
                    src="../../file/problems/{{$problem->pdf_file}}#toolbar=0" type="" internalid="1D2D17AC156EC59F114AEF60F1A51CAD">
                </embed>
                    Error: The page could not be embedded.
                </object>
        </div>
        {{-- </div> --}}
    </div>
 {{-- <div class="submit" style="width: 20%; margin-right: 30px; min-width: 120px; border: 1px solid #ccc; border-radius: 3px; float: right;"> --}}

@endsection

@if (Auth::user()->role == 'team' || Auth::user()->role == 'user' && $contestt == 0)

{{-- @section ('submit')
    <form action="" style="margin-bottom: 40px;">
        <div  class="" style="height: 270px; font-size: 15px; background-color: #fff; min-width: 140px; width: 92%; margin:auto; align-content: center; border: 1px solid #f1f1f1; border-radius: 5px;">
            <div style="font-weight: bold; width: 100%; height: 40px; text-align: center; font-size: 17px; margin-bottom: 10px;">
                <label class="p-3">Submit</label>
            </div>
            <div class="div p-2" style="padding-left: 30px;">
                <label style="padding-left: 10px;" for="">Problem</label>
                <input type="text" name='id' id="id" value="{{$problem->id}}" style="width: 110px;">
                <strong style="padding-left: 10px;"><input for="" name="problem" id="problem" value = "{{$problem->name}}" style="border: none; font-weight:bold; background-color: #fcfcfc"></strong>
            </div>

            <div class="pl-2" style="padding-left: 10px;">
                <label style="padding-left: 10px;" for="">Language</label>
                <select name="language" id="language" style="width: 100px;">
                    <option value="c">c</option>
                    <option value="c++">c++</option>
                    <option value="java">java</option>
                    <option value="python">python</option>
                </select>
            </div>
            <div class="p-2">
                <input style="padding-left: 10px;" type="file" name="s_code" id="s_code">
            </div>
            <div class="d-flex align-item-baseline">
                <div class="save pr-5 pt-1 pr-2" style=" padding-bottom: 20px; padding-left: 20px; margin-left: 4px; margin-top: 7px; border: none; border-radius: 3px;">
                    <a href="/s/editor/{{$problem->id}}/{{$contestt}}"
                        style="border:none; border-radius:4px; text-decoration: none;"
                        class="btn-primary p-2 pb-2 pt-1 btn-sm">Editor mode</a>
                </div>

                <div class="save pr-3" style=" padding-top: 10px; padding-left: 25px">
                    <input class="btn btn-success btn-sm" type="submit" value="Submit" >
                </div>

            </div>
        </div>
    </form>
@endsection --}}

@endif
