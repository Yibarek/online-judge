@if (Auth::user()->role == 'team' || Auth::user()->role == 'user')
@section ('submit')
    <form action="" style="margin-bottom: 40px;">
        <div  class="" style="height: 270px; font-size: 15px; background-color: #fff; min-width: 140px; width: 92%; margin:auto; align-content: center; border: 1px solid #f1f1f1; border-radius: 5px;">
            <div style="font-weight: bold; width: 100%; height: 40px; text-align: center; font-size: 17px; margin-bottom: 10px;">
                <label class="p-3">Submit</label>
            </div>
            <div class="div p-2" style="padding-left: 30px;">
                <label style="padding-left: 10px;" for="">Problem</label>
                <input type="text" name='id' id="id" value="" style="width: 110px;" placeholder="problem id">
                <strong style="padding-left: 10px;"><input for="" name="problem" id="problem" value = "" style="border: none; font-weight:bold; background-color: #fcfcfc"></strong>
            </div>

            <div class="pl-2" style="padding-left: 10px;">
                <label style="padding-left: 10px;" for="">Language</label>
                <select name="language" id="language" style="width: 100px;">
                    <option value="c">c</option>
                    <option value="c++">c++</option>
                    <option value="java">java</option>
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
@endsection
@endif
