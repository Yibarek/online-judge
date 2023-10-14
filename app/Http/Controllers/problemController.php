<?php

namespace App\Http\Controllers;

use App\Models\submissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class problemController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    public function list($contestt){
        $permission = adminController::checkPermission('problem');
        $submissions = DB::table('submissions')->where('user', Auth::user()->username)->where('verdict', 'Accepted')->orderBy('id','DESC')->get();
        $submissionsError = DB::table('submissions')
        ->where('user', Auth::user()->username)
        ->where(function($q){
        	$q->where('verdict', 'Wrong Answer')
            ->orWhere('verdict', 'Compilation Error')
            ->orWhere('verdict', 'Time Limit Excedes');
        })->orderBy('id','DESC')->get();
        $contests= DB::table('contests')->where('id', $contestt)->get();
        $live = false;
        if ($contestt > 0) {
            // $contest = DB::table('contests')->where('id', $contestt)->get();
            // $status = '';
            // foreach ($contest as $c) {
            //     $status = $c->status;
            // }
            $contest_time = livecontestController::checkContestTime($contestt);
            if ($contest_time == 'true') {
                $live = true;
                $cyet=DB::table('contests')->count();
                $pyet=DB::table('problems')->count();
                $syet=DB::table('submissions')->count();
            $Pcount= DB::table('problems')->where('visibility', 'up comming')->count();
            $problems= DB::table('problems')->where('visibility', 'up comming')
                                            ->where('contest', $contestt)->distinct()->orderBy('p_in_s')->paginate(75);
            return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'Count'=>contestController::Count(),
                                                        'cyet'=>DB::table('contests')->count(),
                                                        'pyet'=>DB::table('problems')->count(),
                                                        'syet'=>DB::table('submissions')->count(),
                                                        'contests'=>$contests,
                                                        'Pcount'=>$Pcount,
                                                        'contestt'=>$contestt, 'live'=>$live,
                                                        'contest_time'=>livecontestController::checkContestTime($contestt),
                                                        'submissionsError'=>$submissionsError,
                                                        'submissions'=>$submissions]);
            } else {
            //     $submissions = DB::table('submissions')->where('user', Auth::user()->username)->where('verdict', 'Accepted')->orderBy('id','DESC')->get();
            // $submissionsError = DB::table('submissions')
            // ->where('user', Auth::user()->username)
            // ->where(function($q){
            //     $q->where('verdict', 'Wrong Answer')
            //     ->orWhere('verdict', 'Compilation Error')
            //     ->orWhere('verdict', 'Time Limit Excedes');
            // })->orderBy('id','DESC')->get();
            // $contests= DB::table('contests')->where('id', $contestt)->get();
            // $live = false;
            //     $Pcount= DB::table('problems')->where('visibility', 'passed')->count();
            //     $problems= DB::table('problems')->where('visibility', 'passed')->where('contest',$contestt)->distinct()->orderBy('id','DESC')->paginate(75);
            //     return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
            //                                                     'con_reg'=>contestController::con_reg(),
            //                                                     'Contestants'=>contestController::Contestants(),
            //                                                     'Count'=>contestController::Count(),
            //                                                     'contests'=>$contests,
            //                                                     'cyet'=>DB::table('contests')->count(),
            //                                                     'pyet'=>DB::table('problems')->count(),
            //                                                     'syet'=>DB::table('submissions')->count(),
            //                                                     'contest_time'=>$contest_time,
            //                                                     'Pcount'=>$Pcount,
            //                                                     'contestt'=>0, 'live'=>$live,
            //                                                     'submissionsError'=>$submissionsError,
            //                                                     'submissions'=>$submissions]);
            }

                $live = true;
                $cyet=DB::table('contests')->count();
                $pyet=DB::table('problems')->count();
                $syet=DB::table('submissions')->count();
            $Pcount= DB::table('problems')->where('visibility', 'up comming')->count();
            $problems= DB::table('problems')->where('visibility', 'up comming')
                                            ->where('contest', $contestt)->distinct()->orderBy('p_in_s')->paginate(75);
            return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'Count'=>contestController::Count(),
                                                        'cyet'=>DB::table('contests')->count(),
                                                        'pyet'=>DB::table('problems')->count(),
                                                        'syet'=>DB::table('submissions')->count(),
                                                        'contests'=>$contests,
                                                        'Pcount'=>$Pcount,
                                                        'contestt'=>$contestt, 'live'=>$live,
                                                        'contest_time'=>livecontestController::checkContestTime($contestt),
                                                        'submissionsError'=>$submissionsError,
                                                        'submissions'=>$submissions]);

        }else {
            $Pcount= DB::table('problems')->where('visibility', 'passed')->orwhere(function($q){
                $q->where('visibility', 'up comming')
                ->Where('writter', Auth::user()->username);})->count();
            $problems= DB::table('problems')->where('visibility', 'passed')->orwhere(function($q){
                $q->where('visibility', 'up comming')
                ->Where('writter', Auth::user()->username);})
            ->distinct()->orderBy('id','DESC')->paginate(75);
            return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
                                                            'con_reg'=>contestController::con_reg(),
                                                            'Contestants'=>contestController::Contestants(),
                                                            'Count'=>contestController::Count(),
                                                            'contests'=>$contests,
                                                            'cyet'=>DB::table('contests')->count(),
                                                            'pyet'=>DB::table('problems')->count(),
                                                            'syet'=>DB::table('submissions')->count(),
                                                            'contest_time'=>'false',
                                                            'Pcount'=>$Pcount,
                                                            'permission'=>$permission,
                                                            'contestt'=>$contestt, 'live'=>$live,
                                                            'submissionsError'=>$submissionsError,
                                                            'submissions'=>$submissions]);
            }
        }


    public function list_geust(){
        $submissions = DB::table('submissions')->where('user', '')->get();
        $submissionsError = DB::table('submissions')->where('user', '')->get();
        $contests= DB::table('contests')->where('id', 0)->get();
        $live = false;

        $Pcount= DB::table('problems')->where('visibility', 'passed')->count();
        $problems= DB::table('problems')->where('visibility', 'passed')->distinct()->orderBy('id','DESC')->paginate(75);
        return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
                                                        'Count'=>contestController::Count(),
                                                        'contests'=>$contests,
                                                        'cyet'=>DB::table('contests')->count(),
                                                        'pyet'=>DB::table('problems')->count(),
                                                        'syet'=>DB::table('submissions')->count(),
                                                        'contest_time'=>'false',
                                                        'Pcount'=>$Pcount,
                                                        'contestt'=>0, 'live'=>$live,
                                                        'submissionsError'=>$submissionsError,
                                                        'submissions'=>$submissions]);
    }

        public function contestProblems($contestt){

            $submissions = DB::table('submissions')->where('user', Auth::user()->username)->where('verdict', 'Accepted')->orderBy('id','DESC')->get();
            $submissionsError = DB::table('submissions')
            ->where('user', Auth::user()->username)
            ->where(function($q){
                $q->where('verdict', 'Wrong Answer')
                ->orWhere('verdict', 'Compilation Error')
                ->orWhere('verdict', 'Time Limit Excedes');
            })->orderBy('id','DESC')->get();
            $contests= DB::table('contests')->where('id', $contestt)->get();
            $live = false;
                $Pcount= DB::table('problems')->where('visibility', 'passed')->where('contest', $contestt)->count();
                $problems= DB::table('problems')->where('visibility', 'passed')->where('contest',$contestt)->distinct()->orderBy('id','DESC')->paginate(75);
                return view('Problem',['problems'=>$problems, 'Contests'=>contestController::Contests(),
                                                                'con_reg'=>contestController::con_reg(),
                                                                'Contestants'=>contestController::Contestants(),
                                                                'Count'=>contestController::Count(),
                                                                'contests'=>$contests,
                                                                'cyet'=>DB::table('contests')->count(),
                                                                'pyet'=>DB::table('problems')->count(),
                                                                'syet'=>DB::table('submissions')->count(),
                                                                'contest_time'=>livecontestController::checkContestTime($contestt),
                                                                'Pcount'=>$Pcount,
                                                                'contestt'=>$contestt, 'live'=>$live,
                                                                'submissionsError'=>$submissionsError,
                                                                'submissions'=>$submissions]);
            }

    public function editor($id, $contestt){
        if (Auth::user()->role == 'user' || Auth::user()->role == 'team') {

        $problems = DB::table('problems')->where('id', $id)->get();
        $contests= DB::table('contests')->where('id', $contestt)->get();
        return view('Editor',['problems' => $problems, 'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'Count'=>contestController::Count(),
                                                        'cyet'=>DB::table('contests')->count(),
                                                        'pyet'=>DB::table('problems')->count(),
                                                        'syet'=>DB::table('submissions')->count(),
                                                        'contests'=>$contests,
                                                        'contestt'=>$contestt,]);

        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function problem(){
        //query builder
        $problems= DB::table('problems')->distinct()->orderBy('id','DESC')->paginate(75);
        // $submissions= DB::table('submissions')->distinct()->orderBy('id','DESC')->get();
        return view('problem',['problems'=>$problems,  'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'cyet'=>DB::table('contests')->count(),
                                                        'pyet'=>DB::table('problems')->count(),
                                                        'syet'=>DB::table('submissions')->count(),
                                                        'contest_time'=>'false',
                                                        'Count'=>contestController::Count()]);
    }

    public function addProblem()
    {
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes'))) {

        return view('problem.addProblem',['contestt'=>0]);
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function add (Request $request, $contestt){
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes'))) {

            $result_value = DB::table('problems')->insertOrIgnore(

            ['name'=>$request->name,
            'accepted_error'=>$request->accepted_error,
            'point'=>$request->point,
            'time_limit'=>$request->time,
            // 'memory_limit'=>$request->memory,
            'solved'=>'0',
            'p_in_s'=>'A',
            'pdf_file'=>$request->pdf,
            'testcase'=>$request->testcases,
            'visibility'=>'upcomming',
            'writter'=>Auth::user()->username,
            'contest'=>0,
            ]
        );
        if ($result_value == 0) {
            $problem = DB::table('problems')->where('writter', Auth::user()->username)->orderBy('id', 'DESC')->get();
            $problem_id = 0;
            foreach ($problem as $p) {
                $problem_id = $p->id;
                break;
            }

            $testcase = '';
            $testcases = DB::table('problems')->where('writter', Auth::user()->username)->orderBy('id', 'DESC')->get();
            foreach ($testcases as $t) {
                $testcase = $t->testcase;
            }
                for ($j=1; $j <= $testcase; $j++) {
                    DB::table('testcases')->insertOrIgnore([
                        'contest'=>0,
                        'problem_id'=>$problem_id,
                        'problem'=>'A',
                        'input'=>'',
                        'answer'=>'',
                        'code'=>$j,
                    ]);
            }
            return redirect('/editProblem'.'/'.$problem_id.'/'.$contestt)->with('success', 'New problem is added successfully!');
        }
        else {
            return redirect('/p/0')->with('danger', 'Unable to save this problem! Something is wrong!');
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public static function problemID($p_name){
        $problem = DB::table('problems')->where('name', $p_name)->first();
        return $problem->id;
    }

    function addTestcase(Request $request, $contestt, $problem_id){
        $writter='';
        $problem = DB::table('problems')->where('id', $problem_id)->get();
        foreach ($problem as $c) {
            $writter = $c->writter;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes')) && Auth::user()->username == $writter) {

        $problems = DB::table('problems')->where('id', $problem_id)->get();
        $problem = 0;
        foreach ($problems as $p) {
            $problem = $p->testcase;
        }

        $i = 1;
        do {

            $in = 'input'.$i;  //present input
            $in1 = 'Einput'.$i; //previous input

            $ans = 'answer'.$i; //present answer
            $ans1= 'Eanswer'.$i; //previous answer

            $input = $request->$in;
            $answer = $request->$ans;

            if ($input == '') {   // if no new input is selected
                $input = $request->$in1;
            }

            if ($answer == '') {    // if no new answer is selected
                $answer = $request->$ans1;
            }

            DB::table('testcases')->where('problem_id', $problem_id)->where('code', $i)->update([
                'input'=>$input,
                'answer'=>$answer,
            ]);
            $i++;
        }while( $problem-- );
        DB::table('problems')->where('id', $problem_id)->update([
            'visibility'=>'passed',
        ]);

        // $testcases = DB::table('testcases')->where('contest', $contestt)->orderBy('problem')->get();
        // $contest = DB::table('contests')->where('id', $contestt)->get();
        // $problems = DB::table('problems')->where('contest', $contestt)->get();
        return view('/p/0')->with('success', 'Problem testcases are saved successfully! Problem creation is finished and public to the users.');
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function show($id, $contestt){
        $contests= DB::table('contests')->where('id', $contestt)->get();
    $problem = DB::table('problems')->where('id', $id)->first();
    // if($contestt == 0)
        return view('problem.solve_Problem', ['problem' => $problem,  'Contests'=>contestController::Contests(),
                                                                        'con_reg'=>contestController::con_reg(),
                                                                        'Contestants'=>contestController::Contestants(),
                                                                        'Count'=>contestController::Count(),
                                                                        'contests'=>$contests,
                                                                        'contestt'=>$contestt]);
    // else {
    //     return view('problem.solve_Problem', ['problem' => $problem, 'contest'=>$contest]);
    //     }
    }

    public function editProblem($id, $contestt){
        $writter='';
        $problem = DB::table('problems')->where('id', $id)->get();
        foreach ($problem as $c) {
            $writter = $c->writter;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes')) && Auth::user()->username == $writter) {

        $problems = DB::table('problems')->where('id', $id)->get();
        $contests= DB::table('contests')->where('id', $contestt)->get();
        $testcases = DB::table('testcases')->where('problem_id', $id)->orderBy('problem')->get();

        return view('problem.editProblem', ['problems' => $problems,
                                            'Contests'=>contestController::Contests(),
                                            'con_reg'=>contestController::con_reg(),
                                            'Contestants'=>contestController::Contestants(),
                                            'Count'=>contestController::Count(),
                                            'contestt'=>$contestt,
                                            'testcases'=>$testcases,
                                            'contests'=>$contests,]);
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function edit(Request $request, $problem_id, $contestt){
        $writter='';
        $problem = DB::table('problems')->where('id', $problem_id)->get();
        foreach ($problem as $c) {
            $writter = $c->writter;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes')) && Auth::user()->username == $writter) {

        $testcasePREV = '';
        $testcases = DB::table('problems')->where('writter', Auth::user()->username)->orderBy('id', 'DESC')->get();
        foreach ($testcases as $t) {
            $testcasePREV = $t->testcase;
        }

        $result_value = DB::table('problems')->where('id', $problem_id)->update(

            ['name'=>$request->name,
            'accepted_error'=>$request->accepted_error,
            'point'=>$request->point,
            'time_limit'=>$request->time,
            // 'memory_limit'=>$request->memory,
            'pdf_file'=>$request->pdf,
            'testcase'=>$request->testcases,
            ]
        );
        if ($result_value == 1) {
            $problem = DB::table('problems')->where('writter', Auth::user()->username)->orderBy('id', 'DESC')->get();
            $problem_id = 0;
            foreach ($problem as $p) {
                $problem_id = $p->id;
                break;
            }

            // if any testcase change happen
            if ($testcasePREV != $testcases) {
                //delete previous testcases of this contests
                DB::table('testcases')->where('contest', $contestt)->where('problem_id', $problem_id)->delete();
                for ($j=1; $j <= $request->testcase; $j++) {
                    DB::table('testcases')->insertOrIgnore([
                        'contest'=>0,
                        'problem_id'=>$problem_id,
                        'problem'=>'A',
                        'input'=>'',
                        'answer'=>'',
                        'code'=>$j,
                    ]);
                }
            }
            return redirect('/p/0')->with('success', 'Problem is updated '. $request->name.' successfully!');
        }
        else {
            return redirect('/p/0')->with('danger', 'Unable to save this problem! Something is wrong!');
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    public function delete($id)
    {
        $writter='';
        $problem = DB::table('problems')->where('id', $id)->get();
        foreach ($problem as $c) {
            $writter = $c->writter;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('problem') == 'Yes')) && Auth::user()->username == $writter) {

        DB::table('problems')->where('id',$id)->delete();
        DB::table('testcases')->where('problem_id',$id)->delete();
        return redirect('/p/0');
        }
        else {
            return redirect('/accessdenied');
        }
    }


}
