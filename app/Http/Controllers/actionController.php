<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class actionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public $source_code_path = "file/Submissions";
    public $answer_path = "file/Answers";
    public $output_path = "file/Outputs";

    public function execute(Request $request, $contestt){
        $submit = DB::table('submissions')->where('user', Auth::user()->username)
                                        ->where('problem', $request->problem)
                                        ->where('verdict', 'Accepted')->count();
        $virus = '';
        $pm=0;
        $cm=0;
        $p=0;
        $now=0;
        $contest_start_time = 0;
        $current_minute = 0;

        if ($request->language == 'c' || $request->language == 'c++') {
            $virus = 'system';
        }

        $s_t = 0;
        $s_time = 0;
        $n_t = 0;
        $n_time = 0;
        $e_t = 0;
        $e_time = 0;
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $s_t = $c->start_time;
            $e_t = $c->end_time;
        }

        $s_time = strtotime($s_t) / (60);
        $n_time = strtotime("now") / (60);
        $e_time = strtotime($e_t) / (60);
        $before = $n_time - $s_time;
        $after = $e_time - $n_time;

        if (($submit == 0)){
            if (strpos($request->s_code, $virus) == false ) {// deny accepted submission

                $error = 0;
                $a_error = DB::table('problems')->where('name', $submit['problem'])->get();
                foreach ($a_error as $e) {
                    $error = $e->accepted_error;
                }

                $submit = [];
                $submit['problem'] = $request->problem;

                $submit['language'] = '';

                $submit['language'] = $request->language;

                $submit['date'] = time();             //time format

                $submit['cpu_time'] = 0;

                $submit['user'] = Auth::user()->username;
                $result = "running source code";


                //define source-code file name and extension
                $sourcecode = DB::table('submissions')->count() + 1; // submission count
                $executable = '';
                $extension = '';
                if($submit['language'] == "c"){
                    $extension = "c";
                    $executable = "exe";
                }

                else if($submit['language'] == "c++"){
                    $extension = "cpp";
                    $executable = "exe";
                }

                else if($submit['language'] == "java"){
                    $extension = "java";
                    $executable = "class";
                }

                //validate source code


                //save souce code
                $myfile = fopen($this->source_code_path ."/$sourcecode.$extension", "w") or die("Unable to open file!");
                fwrite($myfile, $request->s_code);
                fclose($myfile);

                // Get the short name of the problem
                $problems = DB::table('problems')->where('name', $request->problem)->get();
                $p_in_s = "";
                $solved = 0;
                $time_limit = 0;
                $contesttt = 0;
                foreach ($problems as $problem) {
                    $p_in_s = $problem->p_in_s;
                    $solved = $problem->solved;
                    $time_limit = $problem->time_limit;
                    $contesttt = $problem->contest;
                }
                $solved ++;
                $index = 0;

                //*********** LOOP THROUGH ALL TESTCASES *******************/
                $testcases = DB::table('testcases')->where('contest', $contesttt)->where('problem',$p_in_s)->orderBy('code')->get();
                foreach ($testcases as $testcase) {

                    //Open answer file
                    $myfile = fopen($this->answer_path ."/$testcase->answer", "r") or die("Unable to open file!");

                    // Output one line until end-of-file
                    $code = [];
                    $j=0;
                    while(!feof($myfile)) {
                        $line[$j] =  fgets($myfile);
                        $j++;
                    }

                    fclose($myfile);

                    //run source-code
                    $accepted = true;
                    $array = [];
                    $int = "";
                    $times = 0;
                    $no_of_timts_run = 3;
                    $path_time = 0;

                    // for ($i=1; $i <= $no_of_timts_run; $i++) {
                        // exec("ptime cd ".$this->source_code_path ." && g++ file.cpp -o file.exe", $array, $int);
                        // $path_time += submissionController::fecthtime($array[count($array) - 1]);
                    // }
                    // $path_time = $path_time / $no_of_timts_run;

                    //execute code

                    if($submit['language'] == 'c'){
                        exec("cd ".$this->source_code_path ." && gcc $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
                    }
                    else if($submit['language'] == 'c++'){
                        exec("cd ".$this->source_code_path ." && g++ $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
                    }
                    else if($submit['language'] == 'java'){
                        exec("cd ".$this->source_code_path ." && javac $sourcecode.$extension && ptime java $sourcecode.$extension", $array, $int);
                    }

                    //excecution time
                    if (file_exists($this->source_code_path ."/$sourcecode.$executable")) {
                        $submit['cpu_time'] = actionController::fecthtime($array[count($array) - 1]) -  40;
                    }
                    else{
                        $submit['cpu_time'] = "0";
                    }

                    //compair the output with the answer
                    if (file_exists($this->source_code_path ."/$sourcecode.$executable")) {
                        for ($i=0; $i < count($line)-1; $i++) {

                            // check for direct similarity
                            if ((int)$array[$i] != (int)$line[$i]){
                                // check for aproximate similarity
                                if (max((int)$array[$i], (int)$line[$i]) - min((int)$array[$i], (int)$line[$i]) > $error ) {
                                    $accepted = false;
                                    break;
                                }

                            }
                        }
                    }

                    //generate result
                    if (file_exists($this->source_code_path ."/$sourcecode.$executable")) {
                        if ($int == 1) {
                            $result = "RunTime_Error";
                        }
                        else {
                            if ($accepted == true && $time_limit >= (int)$submit['cpu_time']) {
                                $result = 'Accepted';
                                $problems= DB::table('problems')->where('name', $request->problem)->update(
                                    ['solved'=>$solved,]);
                            }
                            else if ($accepted == true && $time_limit < (int)$submit['cpu_time']) {
                                $result = 'Time Limit Excedes';
                                $index = $testcase->code;
                                break;
                            }
                            else{
                                $result = 'Wrong Answer';
                                $index = $testcase->code;
                                break;
                            }
                        }
                    }
                    else {
                        $result =  'Compilation Error';
                        $index = $testcase->code;
                        break;
                    }

                    //delete executable file
                    if (file_exists($this->source_code_path ."/$sourcecode.$executable")) {
                        unlink($this->source_code_path ."/$sourcecode.$executable");
                    }
                    $submit['verdict'] = $result;

                    //create name for output_file
                    $output_name = DB::table('outputs')->max('id') + 1;

                    //save output
                    $myfile = fopen($this->output_path ."/$output_name.out", "w") or die("Unable to open file!");
                    for($i=0; $i < count($array) - 6; $i++){
                        fwrite($myfile, $array[$i]."\n");
                    }
                    fclose($myfile);

                    DB::table('outputs')->insertOrIgnore(
                        [
                            'user'=>Auth::user()->username,
                            'contest'=>$contesttt,
                            'output' => "$output_name.out",
                            'problem'=>$p_in_s,
                            'testcase'=>$testcase->code,
                            'cpu_time'=>$submit['cpu_time'],
                            'memory'=>'0',
                            'verdict'=>$result,
                        ]
                    );

                }


                if ($contestt == 0) {
                    $visibility = 'passed';
                }
                else {  //*******  LIVE CONTEST  **********/
                    $start_time = 0;
                    $previous_minute = 0;
                    $new_minute = 0;
                    $now = 0;
                    $penality = 0;

                    if ($result == "Accepted") {  // Update the MINUTE, SCORE & RANK for accepted submission in live contest

                        //*******  MINUTE  *******/
                        // feach previous minute value
                        $minutes = DB::table('contestants')->where('user', Auth::user()->username)
                                                            ->where('contest', $contestt)->get();
                        foreach ($minutes as $m) {
                        $previous_minute = $m->minute;
                        }

                        //find the current minute from the beggining of the contest
                        $contest_Time = DB::table('contests')->where('id', $contestt)->get();
                        foreach ($contest_Time as $ct) {
                            $start_time = $ct->start_time;
                        }

                        //feach penality
                        $penalities = DB::table('penalities')->where('contestant', Auth::user()->username)
                                                            ->where('problem', $submit['problem'])->get();

                        foreach ($penalities as $p) {
                            $penality = $p->penality;
                        }

                        $now = $submit['date'] / (60) / 60;
                        $contest_start_time = strtotime($start_time) / (60) / 60;

                        $current_minute = $now - $contest_start_time;
                        $new_minute = floor($previous_minute + $current_minute + $penality);

                        DB::table('contestants')->where('user', Auth::user()->username)
                                                ->where('contest', $contestt)
                                                ->update(['minute'=>$new_minute]);

                        $problem = DB::table('problems')->where('name', $submit['problem'])->get();
                        foreach ($problem as $p) {
                            if ($p->firstsolved == 0) {
                                DB::table('problems')->where('name', $submit['problem'])->update(['firstsolved'=>$new_minute]);
                            }
                        }


                        $total_Score = 0; //*******  SCORE  *******/

                        $count = DB::table('contestants')->where('user', Auth::user()->username)  // update score
                                                    ->where('contest', $contestt)->count();

                        if ($count >0) {
                            $contestant = DB::table('contestants')->where('user', Auth::user()->username)  // update score
                                                    ->where('contest', $contestt)->get();

                            foreach ($contestant as $c) {
                                $total_Score = $c->total_solved + 1;
                            }
                        }
                        DB::table('contestants')->where('user', Auth::user()->username)
                                            ->where('contest', $contestt)->update(
                                                ['total_solved' => ($total_Score)]
                                            );

                        $previous_rating = 0; //*******  RATING  *******/
                        $new_rating = 0;
                        $point = 0;

                        //feach previous rating
                        $rating = DB::table('users')->where('username', Auth::user()->username)->get();
                        foreach ($rating as $r) {
                            $previous_rating = $r->rating;
                        }

                        //feach problem point
                        $point = DB::table('problems')->where('name', $submit['problem'])->get();
                        foreach ($point as $p) {
                            $point = $p->point;
                        }

                        $new_rating = $previous_rating + $point;
                        DB::table('users')->where('username', Auth::user()->username)->update(
                            ['rating' => $new_rating]
                        );

                        $rank = 1;  //*******  RANK  *******/
                        $counter = 0;
                        $scores = 0;
                        $score = DB::table('contestants')->where('contest', $contestt)->orderBy('total_solved', 'DESC')->get();
                        foreach ($score as $s) {    // 1st rank based on score
                            if($scores == 0){
                                $scores = DB::table('contestants')->where('contest', $contestt)->where('total_solved', $s->total_solved)->count();
                                if ($scores == 1) {
                                    DB::table('contestants')->where('id', $s->id)->update(
                                        ['rank'=>$rank++]);
                                    $counter++;
                                }
                                else {
                                    $minutes = 0;
                                    $minute = DB::table('contestants')->where('contest', $contestt)->where('total_solved', $s->total_solved)->orderBy('minute')->get();
                                    foreach($minute as $m){    // 2nd rank based on minute
                                        if($minutes == 0){
                                            $minutes = DB::table('contestants')->where('contest', $contestt)->where('total_solved', $s->total_solved)->where('minute', $m->minute)->count();
                                            if ($minutes == 1) {
                                                DB::table('contestants')->where('id', $m->id)->update(
                                                    ['rank'=>$rank++]);
                                                $counter++;
                                            }
                                            else {  // 3rd rank based on alphabet
                                                $alphabet = DB::table('contestants')->where('contest', $contestt)->where('total_solved', $s->total_solved)->where('minute', $m->minute)->orderBy('user')->get();
                                                foreach ($alphabet as $a) {
                                                    DB::table('contestants')->where('id', $a->id)->update(
                                                        ['rank'=>$rank]);
                                                    $counter++;
                                                }
                                            }
                                        }
                                        $minutes--;
                                    }
                                    $rank = $counter+1;
                                }
                            }
                            $scores--;
                        }

                    }
                    else {
                        $count = DB::table('penalities')->where('contestant', Auth::user()->username)
                                                        ->where('problem', $submit['problem'])->count();
                        if($count > 0){
                            DB::table('penalities')->where('contestant', Auth::user()->username)
                                                ->where('problem', $submit['problem'])
                                                ->update(['penality' => 20]);
                        }else {
                            DB::table('penalities')->where('contestant', Auth::user()->username)
                                                ->where('problem', $submit['problem'])
                                                ->insertOrIgnore(
                                                    ['penality' => 20,
                                                    'problem' => $submit['problem'],
                                                    'contestant' => $submit['user']]
                                                );
                        }
                    }
                }


                $visibility = 'up comming';
                DB::table('submissions')->insertOrIgnore(  // Add submiision to database
                    ['problem'=>$submit['problem'],
                    'user'=>$submit['user'],
                    'language'=>$submit['language'],
                    'verdict'=>$result,
                    'cpu_time'=>$submit['cpu_time'],
                    'memory'=> 0,
                    'visibility'=>$visibility,
                    'p_in_s'=>$p_in_s,
                    'contest'=>$contestt,
                    'stop_at'=>$index,
                    'minute'=>$new_minute,
                    ]
                );
            }
            else{
                return redirect('s/'.$contestt)->with('danger', 'BAD SOURCE CODE! Source code contains unallowed content. we have no any trust on this code to run on our server');
            }
        }
        else{
            return redirect('s/'.$contestt)->with('danger', 'You already have accepted submission for this problem. Try solving another problem.');
        }

        $count = 0;
        if ($contestt == 0) {
            $submissions= DB::table('submissions')->where('visibility', 'passed')->where('user', Auth::user()->username)->distinct()->orderBy('id','DESC')->paginate(100);
        }
        else {            /// && in where /* ************* *\  /\
            $submissions= DB::table('submissions')->where('visibility', 'up comming')
                                                  ->where('user', Auth::user()->username)
                                                  ->where('contest', $contestt)->distinct()
                                                  ->orderBy('id','DESC')->paginate(100);

            $count= DB::table('submissions')->where('visibility', 'up comming')
                                            ->where('user', Auth::user()->username)
                                            ->where('contest', $contestt)->count();
        }

        $testcases = DB::table('testcases')->get();
        $outputs = DB::table('outputs')->get();
        $contests = DB::table('contests')->where('id', $contestt)->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'Contestants'=>contestController::Contestants(),
                            'con_reg'=>contestController::con_reg(),
                            'contests'=>$contests,
                            'Count'=>contestController::Count(),
                            'contestt'=>$contestt, 'count'=> $count,
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'contest_time'=>livecontestController::checkContestTime($contestt),
                            'outputs'=>$outputs,'cc'=>''])->with('success', 'Successfull submission!');

    }


    public function fecthtime($time){
        $second = 0;
        $temp = "";
        for ($i=16; $i < strlen($time); $i++) {
            if ($time[$i] != ' ' && $time[$i] != 's') {
                $temp = $temp . $time[$i];
            }
        }
        $second = (float)$temp * 1000;
        return $second;
    }public function submit(){submissionController::language();submissionController::user();}

}
