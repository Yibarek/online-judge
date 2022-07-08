<?php

namespace App\Http\Controllers;

use App\Models\contest;
use App\Models\problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class contestController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    public function list(){
        //query builder
        $LU= DB::table('contests')->where('status', 'upcomming')->distinct()->count();
        $LUcount= DB::table('contests')->where('status', 'upcomming')->where('registration', 'completed')->distinct()->count();
        $LUcontests= DB::table('contests')->where('status', 'upcomming')->distinct()->orderBy('id','DESC')->get();
        $Pcount= DB::table('contests')->where('status', 'passed')->distinct()->count();
        $Pcontests= DB::table('contests')->where('status', 'passed')->distinct()->orderBy('id','DESC')->paginate(50);

        $permission = adminController::checkPermission('contest');
        return view('contest.contest',['LUcontests'=>$LUcontests, 'Pcontests'=>$Pcontests,
                                        'Contests'=>contestController::Contests(),
                                        'Contestants'=>contestController::Contestants(),
                                        'con_reg'=>contestController::con_reg(),
                                        'Count'=>contestController::Count(),
                                        'LU'=>$LU,
                                        'LUcount'=>$LUcount,
                                        'Pcount'=>$Pcount,
                                        'permission'=>$permission,
                                        'cyet'=>DB::table('contests')->count(),
                                        'pyet'=>DB::table('problems')->count(),
                                        'syet'=>DB::table('submissions')->count(),
                                        'contestt'=>0]);
    }


    public function list_geust(){
        //query builder
        $LU= DB::table('contests')->where('status', 'upcomming')->distinct()->count();
        $LUcount= DB::table('contests')->where('status', 'upcomming')->where('registration', 'completed')->distinct()->count();
        $LUcontests= DB::table('contests')->where('status', 'upcomming')->distinct()->orderBy('id','DESC')->get();
        $Pcount= DB::table('contests')->where('status', 'passed')->distinct()->count();
        $Pcontests= DB::table('contests')->where('status', 'passed')->distinct()->orderBy('id','DESC')->paginate(50);

        return view('contest.contest',['LUcontests'=>$LUcontests, 'Pcontests'=>$Pcontests,
                                        'Contests'=>contestController::Contests(),
                                        'Count'=>contestController::Count(),
                                        'LU'=>$LU,
                                        'LUcount'=>$LUcount,
                                        'Pcount'=>$Pcount,
                                        'permission'=>'No',
                                        'cyet'=>DB::table('contests')->count(),
                                        'pyet'=>DB::table('problems')->count(),
                                        'syet'=>DB::table('submissions')->count(),
                                        'contestt'=>0]);
    }

    public function createContest (Request $request){
            if (Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) {

            $max = DB::table('contests')->where('creator', Auth::user()->username)->max('id');
            $con = '';
            $con_max = '';
            if ($max > 0) {
                $con = DB::table('contests')->where('creator', Auth::user()->username)->where('id', $max)->get();
                foreach ($con as $c){
                    if ($c->registration == "") {
                        DB::table('contests')->where('id', $max)->update(
                                ['status'=>'upcomming',
                            ]
                        );
                    }
                    else {
                        DB::table('contests')->insertOrIgnore(
                            ['creator'=>Auth::user()->username,
                            'status'=>'upcomming',
                            'contestants'=>0,
                            ]
                        );
                    }
                }
            } else {
                DB::table('contests')->insertOrIgnore(
                    ['creator'=>Auth::user()->username,
                    'status'=>'upcomming',
                    'contestants'=>0,
                    ]
                );

                $sponsers = DB::table('sponsers')->where('contest', 0)->distinct()->get();
                $max = DB::table('contests')->where('creator', Auth::user()->username)->max('id');
                $contests = DB::table('contests')->where('creator', Auth::user()->username)->where('id', $max)->get();
                foreach ($contests as $c) {
                    return view('contest.createContest1', ['contestt' => $max, 'contests' => $contests, 'max_contest_id' => $max, 'sponsers'=>$sponsers]);
                }
            }


            $sponsers = DB::table('sponsers')->where('contest', 0)->distinct()->get();
            $max = DB::table('contests')->where('creator', Auth::user()->username)->max('id');
            $contests = DB::table('contests')->where('creator', Auth::user()->username)->where('id', $max)->get();

            return view('contest.createContest1', ['contestt' => $max, 'contests' => $contests, 'max_contest_id' => $max, 'sponsers'=>$sponsers]);
        }
        else {
            return redirect('/accessdenied');
        }
    }
    public function detail ($contestt){
        $contest = DB::table('contests')->where('id', $contestt)->get();
        return view('contest.contestDetail',['contestt' =>$contestt, 'contest' => $contest]);
    }
    public function contestDetail (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $logo = '';
        $sponserslogo = '';

        $new_image_name='';
        if($request->hasfile('img')){
            //getting the file from view
            $image = $request->file('img');
            // $image_size = $image->getClientSize();

            //getting the extension of the file
            $image_ext = $image->getClientOriginalExtension();
            //changing the name of the file
            $new_image_name = rand(123456,999999).".".$image_ext;
            $destination_path = public_path('/image/contest');
            $image->move($destination_path,$new_image_name);

            // return $new_image_name;
        }

        if ($new_image_name == "") {
            $logo = $request->logo_name;
        }else {
            $logo = $new_image_name;
        }

        // if ($request->sponserslogo == '') {
        //     $sponserslogo = $request->Esponserslogo;
        // }
        // else {
        //     $sponserslogo = $request->sponserslogo;
        // }
        $countfiles = count($_FILES['file']['name']);
        if ($countfiles > 0) {
            DB::table('sponsers')->where('id', $contestt)->delete();
        }
        for($i=0;$i<$countfiles;$i++){
            $filename = $_FILES['file']['name'][$i];

            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'][$i],public_path('/image/sponser/'.$filename));

            $return_value = DB::table('sponsers')->insertOrIgnore(
                ['contest'=>$contestt,
                'sponser_logo'=>$filename]
            );
           }

        $return_value1 = DB::table('contests')->where('id', $contestt)->update(
            ['name'=>$request->name,
            'logo'=>$logo,
            'type'=>$request->radio,
            'place'=>$request->place,
            'owner'=>$request->owner,
            'officials'=>$request->contestants,
            'sponsers'=>$request->sponsers,
            'description'=>$request->description,
        ]
    );
    if ($return_value == 1 || $return_value1 == 1) {
        return redirect('/c/toDetail/'.$contestt)->with('success', 'Contest DETAIL saved Successfully!');
    }
    else {
        return redirect('/c/toDetail/'.$contestt)->with('danger', 'Unable to save the DETAIL! something is wrong.No new input detected or invalid file is choosen.');
    }
    }
    else {
        return redirect('/accessdenied');
    }
    }

    public function contestSchedule (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $return_value = DB::table('contests')->where('id', $contestt)->update(

            ['reg_start_time'=>$request->reg_start_date . ' ' . $request->reg_start_time,
            'reg_end_time'=>$request->reg_end_date . ' ' . $request->reg_end_time,
            'start_time'=>$request->start_date . ' ' . $request->start_time,
            'end_time'=>$request->end_date . ' ' . $request->end_time,
            'freez_time'=>$request->freez_start_date . ' ' . $request->freez_start_time,
            'unfreez_time'=>$request->freez_end_date . ' ' . $request->freez_end_time,
            ]

        );
    if($return_value == 1){
        return redirect('/c/toSchedule/'.$contestt)->with('success','Contest SCHEDULE saved Successfully');
    }
    else {
        return redirect('/c/toSchedule/'.$contestt)->with('danger', 'Unable to save Contest SCHEDULE! something is wrong on the inserted data.');
    }
    }
    else {
        return redirect('/accessdenied');
    }
    }

    public function contestProblemNo (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {

        if($request->no_of_problems < 1)
            $problems = 1;
        else
            $problems = $request->no_of_problems;

        $return_value = DB::table('contests')->where('id', $contestt)->update(
            ['problems'=>$problems,]
        );
        if ($return_value == 1) {
            return redirect('/c/toProblemNo/'.$contestt)->with('success','Contest PROBLEM NUMBERS saved Successfully');
        } else {
            return redirect('/c/toProblemNo/'.$contestt)->with('danger','unable to save Contest PROBLEM NUMBERS! some thing is wrong');
        }

        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function contestProblems (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        // delete the previous problems saved for this contest
        DB::table('problems')->where('contest',$contestt)->delete();
        DB::table('testcases')->where('contest',$contestt)->delete();

        // if null value is given saved it as one
        if($request->no_of_problems < 1)
            $problems = 1;
        else
            $problems = $request->no_of_problems;

        // update no of problems in the contest
        DB::table('contests')->where('id', $contestt)->update(
            ['problems'=>$problems,]
        );
        $contest = DB::table('contests')->where('id', $contestt)->get();

        // initialize problems with null value
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        for ($i=0; $i < $request->no_of_problems; $i++) {

            $return_value = DB::table('problems')->insertOrIgnore(
                ['p_in_s'=>$alphabet[$i],
                'visibility'=>'up comming',
                'solved'=>0,
                'testcase'=>1,
                'firstsolved'=>0,
                'contest' => $contestt,
                'writter' => Auth::user()->username]
            );
        }
        $problems = DB::table('problems')->where('contest',$contestt)->get();
        $testcases = DB::table('testcases')->where('contest', $contestt)->orderBy('id')->get();
        if ($return_value == 1) {
            return redirect('/c/toProblems/'.$contestt)->with('success','Contest PLEBLEM  NUMBERS saved Successfully');
        } else {
            return redirect('/c/toProblems/'.$contestt)->with('danger','unable to save Contest PLEBLEM  NUMBERS! something is wrong');

        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function saveContestProblems (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $problemNumbers = DB::table('problems')->where('contest', $contestt)->get();
        $count = DB::table('problems')->where('contest', $contestt)->count();
        $i=0;
        $tc = [];
        $p_in_s = [];
        foreach ($problemNumbers as $pn) {
            $tc[$i] = $pn->testcase;
            $p_in_s[$i] = $pn->p_in_s;
            $i++;
        }

        $contestproblems = DB::table('contests')->where('id', $contestt)->get();
        $problems = 0;
        foreach ($contestproblems as $p){
            $problems = $p->problems;
        }
        $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
        $max = DB::table('testcases')->max('contest');

        for ($i=0; $i < $problems; $i++) {
            $name = $request->input('name'.$alphabet[$i]);
            $accepted_error = $request->input('accepted_error'.$alphabet[$i]);
            $point = $request->input('point'.$alphabet[$i]);
            $ballon_color = $request->input('ballon_color'.$alphabet[$i]);
            $time_limit = $request->input('time'.$alphabet[$i]);
            // $memory = $request->input('memory'.$alphabet[$i]);
            if ($request->input('pdf'.$alphabet[$i]) == "") {
                $pdf_file = $request->input('pdf_file'.$alphabet[$i]);
            }else {
                $pdf_file = $request->input('pdf'.$alphabet[$i]);
            }

            $testcases = $request->input('testcases'.$alphabet[$i]);

            // previous values of problem
            $pnPrev = DB::table('problems')->where('contest', $contestt)->where('p_in_s', $alphabet[$i])->get();
            $testcasePREV = '';
            foreach ($pnPrev as $pnprev) {
                $testcasePREV = $pnprev->testcase;
            }

            // UPDAE PROBLEMS INFORMATION
            $return_value = DB::table('problems')->where('contest', $contestt)->where('p_in_s', $alphabet[$i])->update(

                ['name'=>$name,
                'time_limit'=>$time_limit,
                'point'=>$point,
                'accepted_error'=>$accepted_error,
                'ballon_color'=>$ballon_color,
                // 'memory_limit'=>$memory,
                'pdf_file'=>$pdf_file,
                'testcase'=>$testcases,
                ]

            );
            //If it is the first time the problems are saved
            if ($max < $contestt) {
                for ($j=1; $j <= $testcases; $j++) {
                    DB::table('testcases')->insertOrIgnore([
                        'contest'=>$contestt,
                        'problem'=>$alphabet[$i],
                        'input'=>'',
                        'answer'=>'',
                        'code'=>$j,
                    ]);
                }
            }
            else
            {
                // if any testcase change happen
                if ($testcasePREV != $testcases) {
                    //delete previous testcases of this contests
                    DB::table('testcases')->where('contest', $contestt)->where('problem', $alphabet[$i])->delete();
                    for ($j=1; $j <= $testcases; $j++) {
                        DB::table('testcases')->insertOrIgnore([
                            'contest'=>$contestt,
                            'problem'=>$alphabet[$i],
                            'input'=>'',
                            'answer'=>'',
                            'code'=>$j,
                        ]);
                    }
                }
            }

        }

        $testcases = DB::table('testcases')->where('contest', $contestt)->orderBy('problem')->get();

        $contest = DB::table('contests')->where('id', $contestt)->get();
        $problems = DB::table('problems')->where('contest', $contestt)->get();
        if ($return_value == 1) {
            return redirect('/c/toProblems/'.$contestt)->with('success','Contest PLEBLEMS saved Successfully');
        } else {
            return redirect('/c/toProblems/'.$contestt)->with('danger','Unable to save Contest PLEBLEMS! Please enter only valid values.');
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function addTestcases(Request $request, $contestt, $p_in_s){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $problems = DB::table('problems')->where('contest', $contestt)->where('p_in_s', $p_in_s)->get();
        $problem = 0;
        $problem_name = '';
        foreach ($problems as $p) {
            $problem = $p->testcase;
            $problem_name = $p->name;
        }

        $i = 1;
        do {

            $in = 'input'.$p_in_s.$i;  //present input
            $in1 = 'Einput'.$p_in_s.$i; //previous input

            $ans = 'answer'.$p_in_s.$i; //present answer
            $ans1= 'Eanswer'.$p_in_s.$i; //previous answer

            $input = $request->$in;
            $answer = $request->$ans;

            if ($input == '') {   // if no new input is selected
                $input = $request->$in1;
            }

            if ($answer == '') {    // if no new answer is selected
                $answer = $request->$ans1;
            }

            DB::table('testcases')->where('contest', $contestt)->where('problem', $p_in_s)->where('code', $i)->update([
                'input'=>$input,
                'answer'=>$answer,
            ]);
            $i++;
        }while( $problem-- );

        $testcases = DB::table('testcases')->where('contest', $contestt)->orderBy('problem')->get();
        $contest = DB::table('contests')->where('id', $contestt)->get();
        $problems = DB::table('problems')->where('contest', $contestt)->get();
        return redirect('/c/toProblems/'.$contestt)->with('success','Testcases for PLEBLEM '.$problem_name.' saved Successfully');
        }
        else {
            return redirect('/accessdenied');
        }
    }
    public function finishContestReg($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        DB::table('contests')->where('id', $contestt)->update(
            ['registration'=> "completed"]
        );

        return redirect('/c/0')->with('success','Contest registration is completed Successfully! Now it public for users.');
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function complete (Request $request, $contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $name = '';
        $c_names = DB::table('contests')->where('id', $contestt)->get();
        foreach ($c_names as $cn) {
            $name = $cn->name;
        }
        DB::table('contests')->where('id', $contestt)->update(
            ['status'=>'passed',
            'winners'=>$request->winners]
        );

        DB::table('problems')->where('contest', $contestt)->update(
            ['visibility'=>'passed']
        );

        DB::table('submissions')->where('contest', $contestt)->update(
            ['visibility'=>'passed']
        );

        DB::table('contestants')->where('contest', $contestt)->where('status', 'Rejected')->delete();
        DB::table('contestants')->where('contest', $contestt)->where('status', 'Pending')->delete();


        return redirect('/c/0')->with('success', $name .'contest is Successfully completed.');
        }
        else {
            return redirect('/accessdenied');
        }
    }


    public function toDetail($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {
        $sponsers = DB::table('sponsers')->where('contest', $contestt)->distinct()->get();
        $max = DB::table('contests')->max('id');
        $contests = DB::table('contests')->where('id', $contestt)->get();
        return view('contest.createContest1', ['contests' => $contests, 'contestt' => $contestt, 'max_contest_id' => $max, 'sponsers'=>$sponsers]);

        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function toSchedule($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {

        $contests = DB::table('contests')->where('id', $contestt)->get();
        return view('contest.Schedule', ['contests' => $contests, 'contestt' => $contestt]);

        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function toNoOfProblems($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {

        $contests = DB::table('contests')->where('id', $contestt)->get();
        return view('contest.createContest3', ['contests' => $contests, 'contestt' => $contestt]);

        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function toProblems($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('contest') == 'Yes')) && Auth::user()->username == $creator) {

        $testcases = DB::table('testcases')->where('contest', $contestt)->orderBy('problem')->get();
        $contest = DB::table('contests')->where('id', $contestt)->get();
        $problems = DB::table('problems')->where('contest', $contestt)->get();
        return view('contest.createContest4', ['problems' => $problems, 'contestt' => $contestt,
                                                'contest'=> $contest, 'testcases'=> $testcases]);

        }
        else {
            return redirect('/accessdenied');
        }
    }

    // public function show($id){
    // $problem = DB::table('problems')->where('id', $id)->get();

    // return view('problem.solveProblem', ['problem' => $problem] /* or compact('texts', 'text') */);
    // }

    // public function update($id){
    //     $problem = DB::table('problems')->where('id', $id)->first();

    //     return view('problem.editProblem', ['problem' => $problem]);
    // }

    // public function delete($id)
    // {
    //     DB::table('problems')->where('id',$id)->delete();
    //     return redirect('/c');
    // }

    // public function problem($contest){
    //     //query builder
    //     $problems = DB::table('problems')->where('contest', $contest)->orderBy('id')->get();
    //     $Contests = DB::table('contests')->where('status', 'upcomming')->get();
    //     $Count = DB::table('contests')->where('status', 'upcomming')->count();
    //     return view('liveContest.clarification1',['problems'=>$problems, 'Contests'=>$Contests, 'Count'=> $Count]);

    // }

    // public function submissions(){
    //     $submissions = "null";

    //     return view('liveContest.submission', ['submissions' => $submissions]);
    // }
    // public function scoreboard(){
    //     $scoreboard = "null";
    //     return view('liveContest.scoreboard', ['scoreboard' => $scoreboard]);
    // }
    // public function clarification(){
    //     $clarification = "null";
    //     return view('liveContest.clarification', ['calrification' => $clarification]);
    // }

    public static function Contests(){
        $Contests= DB::table('contests')->where('status', 'upcomming')->orderBy('id', 'DESC')->get();
        return $Contests;
    }
    public static function Contestants(){
        $Contestants= DB::table('contestants')->where('user', Auth::user()->username)->where('status', 'Accepted')->orderBy('id', 'DESC')->get();
        return $Contestants;
    }
    public static function count(){
        $Count= DB::table('contests')->where('status', 'upcomming')->count();
        return $Count;
    }
    public static function con_reg(){
        $Contests= DB::table('contests')->where('status', 'upcomming')->get();
        $count =DB::table('contestants')->where('user', Auth::user()->username)->orderBy('id','DESC')->count();
        $contestant =DB::table('contestants')->where('user', Auth::user()->username)->orderBy('id','DESC')->get();

        // fetch all upcomming contests
        $up_comming = 0;
        $contest_id = [];
        foreach($Contests as $contest){
            $contest_id[$up_comming] = $contest->id;
            $up_comming++;
        }

        $con_reg = [];
        if ($count > 0) {
            // fetch the contests that the contestant registered
            for ($i=0; $i < $up_comming; $i++) {

                foreach($contestant as $c){
                    $id = $contest_id[$i];
                    if ($c->contest == $id){
                        $con_reg[$id] = $id;
                        break;
                    }
                    else
                        $con_reg[$id] = -1;
                }

            }
        }
        else {
            for ($i=0; $i < $up_comming; $i++) {
                $id = $contest_id[$i];
                $con_reg[$id] = -1;
            }
        }

        return $con_reg;
    }

}

