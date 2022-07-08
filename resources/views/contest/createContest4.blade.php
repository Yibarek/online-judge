@extends('layouts.app2')

@section('title') Contest-Problems @endsection

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

label {
    /* font-size: 15px; */
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
    <form action="/c/savecontestProblems/{{$contestt}}" method="POST">@csrf
        <div class="container p-2"  style="width: 80%; margin: auto; background-color: #fff; border-radius: 5px;">


            <div class="title justify-content-between d-flex" style="align-self: center; width: 80%; margin: auto; margin-top: 20px;">
                <h3 style="padding-right: 50px;" class="page_title">Create Contest </h3>
                <div class="d-flex">
                        <h6 class="pt-2 pl-2" style ="color: #494949">
                        <a class="anchor p-2" href="/c/toDetail/{{$contestt}}">Detail</a>
                        <a class="anchor p-2" href="/c/toSchedule/{{$contestt}}">Schedule</a>
                        <a class="anchor p-2" href="/c/toProblemNo/{{$contestt}}">NO_of_problems</a>  <strong>Problems</strong>
                    </h6>
                </div>
            </div>

            @foreach ($problems as $problem)

            <div class="pt-5 pb-1 pl" style="padding-left: 15%;">     {{-- ///////////////\\\\\\\\\\\\\\\     break     //////////////\\\\\\\\\\\\\--}}
                <caption class="caption"><strong>Problem {{$problem->p_in_s}}</strong></caption>
            </div>

            <div style="border: 1px solid $dfdfdf;
                        border-radius: 5px;
                        padding-bottom: 20px;
                        padding-top: 20px;
                        box-shadow: 1px 5px 10px 1px rgba(130, 200, 225, 0.7);
                        width: 70%; margin: auto;">
                {{-- <label><strong>Problem {{$problem->p_in_s}}</strong></label> --}}

                <div class="pl-5" style="width: 90%; margin: auto;">
                    <table class="pl-5" style="width: 100%; margin: auto;">
                        <tr style="width: 100%; margin: auto;">
                            <div>
                                <td class="p-2" style="width: 60%;">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Problem Name</label>
                                </td>
                                <td class="p-2" style="width: 40%;" >
                                    <input class="form-control"  type="text" name ="name{{$problem->p_in_s}}" id ="name{{$problem->p_in_s}}" value="{{$problem->name}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Point</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="point{{$problem->p_in_s}}" id ="point{{$problem->p_in_s}}" value="{{$problem->point}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Ballon color</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="ballon_color{{$problem->p_in_s}}" id ="ballon_color{{$problem->p_in_s}}" value="{{$problem->ballon_color}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Accepted Error</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="accepted_error{{$problem->p_in_s}}" id ="accepted_error{{$problem->p_in_s}}" value="{{$problem->accepted_error}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Time Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="time{{$problem->p_in_s}}" id ="time{{$problem->p_in_s}}" value="{{$problem->time_limit}}" placeholder="in microsecond">
                                </td>

                            </div>
                        </tr>
                        {{-- <tr>
                            <div>
                                <td class="p-2">
                                    <label for="" name ="{{$problem->p_in_s}}" id ="{{$problem->p_in_s}}">Memory Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="memory{{$problem->p_in_s}}" id ="memory{{$problem->p_in_s}}" value="{{$problem->memory_limit}}" placeholder="in kilobyte">
                                </td>

                            </div>
                        </tr> --}}
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="">Problem File</label>
                                </td>
                                <td class="p-2">
                                    <input type="file" name ="pdf{{$problem->p_in_s}}" id ="pdf{{$problem->p_in_s}}"
                                           value={{$problem->pdf_file}}>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left: 8px; padding-bottom: 5px;">
                                <input style="text-align: left; border: none;" disabled="true" type="text" name ="pdf_file{{$problem->p_in_s}}"
                                        id ="pdf_file{{$problem->p_in_s}}" value="{{$problem->pdf_file}}">
                            </td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label for="">No of testcase</label>
                                </td>
                                <td class="p-2 d-flex" >
                                    <input class="form-control"  type="number" name="testcases{{$problem->p_in_s}}"
                                            id ="testcases{{$problem->p_in_s}}"
                                            style="width: 100px; margin-right: 20px;" value={{$problem->testcase}}>
                                    <a type="button" style="font-weight: normal; text-decoration: none; text-align: center;"
                                                class="btn-sm add ri ri-add-fill rounded-circle" title="add testcases" data-bs-toggle="modal" data-bs-target="#popup{{$problem->p_in_s}}"
                                                id="add{{$problem->p_in_s}}"></a>
                                </td>
                                {{-- script to disable if testcase is updated--}}

                            </div>
                        </tr>

                    </table>
                </div>
            </div>

            <!-- Modal -->
                <div style="height: 100%; width: 100%; margin: auto; display: none;"
                    class="modal fade" id="popup{{$problem->p_in_s}}" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 35%;">
                        <div class="modal-content" style="overflow: auto;">
                            <div class="modal-header" style="height: 40px;">
                                <h6 class="modal-title" id="staticBackdropLabel">Testcases for problem {{$problem->p_in_s}}</h6>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action=""></form>
                            <form action="/c/addTestcases/{{$contestt}}/{{$problem->p_in_s}}" id="f{{$problem->p_in_s}}" name="f{{$problem->p_in_s}}">
                            <div class="modal-body" style="background-color: #f6f6f6;  overflow: auto; max-height: 500px;">
                                {{-- @for ($j = 1; $j <= $problem->testcase ; $j++) --}}
                                @foreach ($testcases as $testcase)

                                    @if ($testcase->problem == $problem->p_in_s)

                                    <div>

                                    </div>
                                    <div style=" border: 1px solid #dedede; background-color: white; border-radius: 4px; margin-bottom: 20px;" class="p-3">
                                        <table style="text-align: center; ">
                                            <tr>
                                                <td>Testcase: #<strong>{{$testcase->code}}</strong></td>
                                            </tr>
                                            <tr>
                                                <td class="p-1"> <label >Input</label> </td>
                                                <td class="p-2">
                                                    <input type="file" id="input{{$testcase->problem}}{{$testcase->code}}" name="input{{$testcase->problem}}{{$testcase->code}}"><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input class="form-control"  style="border: none;" type="text" id="Einput{{$testcase->problem}}{{$testcase->code}}" name="Einput{{$testcase->problem}}{{$testcase->code}}"  value="{{$testcase->input}}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-1"><label >Answer</label> </td>
                                                <td class="p-2">
                                                    <input type="file" id="answer{{$testcase->problem}}{{$testcase->code}}" name="answer{{$testcase->problem}}{{$testcase->code}}"><br>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <input class="form-control"  style="border: none;" type="text" id="Eanswer{{$testcase->problem}}{{$testcase->code}}" name="Eanswer{{$testcase->problem}}{{$testcase->code}}"  value="{{$testcase->answer}}">
                                                </td>

                                            </tr>
                                        </table>
                                    </div>
                                {{-- @endfor --}}
                                @endif

                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button class="button btn-primary p-1"
                                        type="submit"
                                        style="border: none; border-radius: 4px; text-decoration: none;"
                                        onclick="">Save</button>

                                <button class="button" style="border: 1px solid #ccc; border-radius: 4px;" data-bs-dismiss="modal"> Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach

            <hr style="width: 85%; margin: auto;">

            <div class="save p-5 justify-content-between d-flex " style="width: 80%;">
                <div ></div>
                <div class="">
                    <a href="/c/finishReg/{{$contestt}}" class="anchor p-2" style="text-align: center;" type="button">Finish</a>
                    <input class="anchor p-2" type="submit" value="Save" >
                </div>
            </div>

        </div>
    </form>

@endsection

