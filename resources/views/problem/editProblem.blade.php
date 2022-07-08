@extends('layouts.app')

@section('content')
@foreach ($problems as $problem)

@section('title') Edit Problem @endsection

<form action="p/edit/{{$problem->id}}/{{$contestt}}" method="GET">
        <div class="container p-2" style="background-color: #fff;
                                          border: 1px solid #eee;
                                          border-radius 5px;
                                          width: 95%; margin:auto;">
            <div class="title d-flex justify-content-between" style="width: 70%; margin: auto; margin-top: 15px; margin-bottom: -40px;">
                <h2 class="p-2">Edit problem</h2>
                <div style=" height: 30px; align-items: center;" class="p-2">
                    <input type="submit" value="save" class="anchor p-1" >
                </div>
            </div>
            <div style="border: 1px solid #eee;
                        border-radius: 5px;
                        padding-bottom: 20px;
                        box-shadow: 1px 5px 10px 1px +
                        -- rgba(180, 225, 180, 0.7);
                        padding-top: 20px;
                        width: 70%; margin: auto;">

                <div class="pl-5" style="width: 80%; margin: auto;">
                    <table class="pl-5" style="width: 100%; margin: auto;">
                        <tr style="width: 100%; margin: auto;">
                            <div>
                                <td class="p-2" style="width: 35%;">
                                    <label >Problem Name</label>
                                </td>
                                <td class="p-2" style="width: 65%;" >
                                    <input class="form-control"  type="text" name ="name" id ="name" value="{{$problem->name}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Point</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="point" id ="point" value="{{$problem->point}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Accepted Error</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="accepted_error" id ="accepted_error" value="{{$problem->accepted_error}}">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Time Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="time" id ="time" value="{{$problem->time_limit}}" placeholder="in microsecond">
                                </td>

                            </div>
                        </tr>
                        {{-- <tr>
                            <div>
                                <td class="p-2">
                                    <label >Memory Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="memory" id ="memory" value="{{$problem->memory_limit}}" placeholder="in kilobyte">
                                </td>

                            </div>
                        </tr> --}}
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Problem File</label>
                                </td>
                                <td class="p-2">
                                    <input type="file" name ="pdf" id ="pdf"
                                        value={{$problem->pdf_file}}>
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left: 8px; padding-bottom: 5px;">
                                <label style="text-align: left;" type="text" name ="pdf_file"
                                        id ="pdf_file">{{$problem->pdf_file}}</label>
                            </td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>No of testcase</label>
                                </td>
                                <td class="p-2 d-flex" >
                                    <input class="form-control"  type="number" name="testcases"
                                            id ="testcases"
                                            style="width: 100px; margin-right: 20px;" value={{$problem->testcase}}>
                                    <a type="button" style="font-weight: normal; text-decoration: none; text-align: center;"
                                                class="btn-sm add ri ri-add-fill rounded-circle" title="add testcases" data-bs-toggle="modal" data-bs-target="#popup"
                                                id="add"></a>
                                </td>
                                {{-- script to disable if testcase is updated--}}

                            </div>
                        </tr>

                    </table>
                </div>
            </div>
            <div class="div" style="margin-bottom: 50px; "></div>
        </div>
    </form>

    <!-- Modal -->
    <div style="height: 100%; width: 100%; margin: auto; display: none;"
        class="modal fade" id="popup" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 35%;">
            <div class="modal-content" style="overflow: auto;">
                <div class="modal-header" style="height: 40px;">
                    <h6 class="modal-title" id="staticBackdropLabel">Problem testcases{{$problem->p_in_s}}</h6>
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
                                        <input type="file" id="input{{$testcase->code}}" name="input{{$testcase->code}}"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="form-control"  style="border: none;" type="text" id="Einput{{$testcase->code}}" name="Einput{{$testcase->code}}"  value="{{$testcase->input}}">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="p-1"><label >Answer</label> </td>
                                    <td class="p-2">
                                        <input type="file" id="answer{{$testcase->code}}" name="answer{{$testcase->code}}"><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input class="form-control"  style="border: none;" type="text" id="Eanswer{{$testcase->code}}" name="Eanswer{{$testcase->code}}"  value="{{$testcase->answer}}">
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



@endsection
