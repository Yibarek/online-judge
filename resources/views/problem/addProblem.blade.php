@extends('layouts.app')

@section('title') Add New Problem @endsection

@section('content')
    <form action="/p/add/{{$contestt}}" method="GET">
        <div class="container p-2" style="background-color: #fff;
                                          border: 1px solid #eee;
                                          border-radius 5px;
                                          width: 95%; margin:auto;">
            <div class="title d-flex justify-content-between" style="width: 70%; margin: auto; margin-top: 8px; margin-bottom: -40px;">
                <h2 class="p-2">Add new problem</h2>
                <div style=" height: 30px; align-items: center;" class="p-2">
                    <input type="submit" value="save" class="anchor p-1" >
                </div>
            </div>
            <div style="border: 1px solid #eee;
                        border-radius: 5px;
                        padding-bottom: 10px;
                        box-shadow: 1px 5px 10px 1px rgba(180, 225, 180, 0.7);
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
                                    <input class="form-control"  type="text" name ="name" id ="name">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Point</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="point" id ="point">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Accepted Error</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="accepted_error" id ="accepted_error">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label >Time Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="time" id ="time" placeholder="in microsecond">
                                </td>

                            </div>
                        </tr>
                        {{-- <tr>
                            <div>
                                <td class="p-2">
                                    <label >Memory Limit</label>
                                </td>
                                <td class="p-2" >
                                    <input class="form-control"  type="text" name ="memory" id ="memory" placeholder="in kilobyte">
                                </td>

                            </div>
                        </tr> --}}
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>Problem File</label>
                                </td>
                                <td class="p-2">
                                    <input type="file" name ="pdf" id ="pdf">
                                </td>

                            </div>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="padding-left: 8px; visibility: hiddenpx; height: 0px;">
                                <label style="text-align: left;" type="text" name ="pdf_file"
                                        id ="pdf_file"></label>
                            </td>
                        </tr>
                        <tr>
                            <div>
                                <td class="p-2">
                                    <label>No of testcase</label>
                                </td>
                                <td class="p-2 d-flex" >
                                    <input class="form-control"  type="number" name="testcases" id ="testcases">
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
@endsection
