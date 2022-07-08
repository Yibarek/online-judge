<?php

namespace App\Http\Controllers;

use App\Models\contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use LDAP\Result;
use phpDocumentor\Reflection\PseudoTypes\True_;

use function PHPSTORM_META\type;
use function PHPUnit\Framework\fileExists;

class submissionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public $file_path = "C:\\Users\\nut\\Documents\\Contests\\Submissions";
    public $output_path = "C:\\Users\\nut\\Documents\\Contests\\Outputs";

    // public $file_path = "../file/submissions";
    // public $output_path = "../file/output";

    public function list($contestt){
        $count = 0;
        if ($contestt == 0) {
            $submissions= DB::table('submissions')->where('visibility', 'passed')->distinct()->orderBy('id','DESC')->paginate(100);
        }
        else {            /// && in where /* ************* *\  \\\
            $submissions= DB::table('submissions')->where('visibility', 'up comming')
                                                  ->where('user', Auth::user()->username)
                                                  ->where('contest', $contestt)->distinct()
                                                  ->orderBy('id','DESC')->paginate(100);

            $count= DB::table('submissions')->where('visibility', 'up comming')
                                            ->where('user', Auth::user()->username)
                                            ->where('contest', $contestt)->count();
        }
        // $problems_chunk= DB::table('submissions')->orderBy('id','desc')->chunk(3, function ($submissionss)
        //                   {
        //                   return $submissionss;
        //                   });

        // $users = DB::table('submissions')->paginate(6);
        $contests = DB::table('contests')->where('id', $contestt)->get();
        $testcases = DB::table('testcases')->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'con_reg'=>contestController::con_reg(),
                            'Contestants'=>contestController::Contestants(),
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'Count'=>contestController::Count(),
                            'contestt'=>$contestt, 'count'=> $count,
                            'contest_time'=>livecontestController::checkContestTime($contestt),
                            'contests'=>$contests,
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);
    }

    public function list_geust(){
        $count = 0;
        $submissions= DB::table('submissions')->where('visibility', 'passed')->distinct()->orderBy('id','DESC')->paginate(100);
        
        $contests = DB::table('contests')->where('id', 0)->get();
        $testcases = DB::table('testcases')->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'Count'=>contestController::Count(),
                            'contestt'=>0, 'count'=> $count,
                            'contest_time'=>'false',
                            'contests'=>$contests,
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);
    }

    public function listOnly($contestt){
        $count = 0;
        $submissions= DB::table('submissions')->where('visibility', 'passed')
                                              ->where('user', Auth::user()->username)
                                              ->distinct()->orderBy('id','DESC')->paginate(100);

        $contests = DB::table('contests')->where('id', $contestt)->get();
        $testcases = DB::table('testcases')->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'con_reg'=>contestController::con_reg(),
                            'Contestants'=>contestController::Contestants(),
                            'Count'=>contestController::Count(),
                            'contestt'=>$contestt, 'count'=> $count,
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'contest_time'=>livecontestController::checkContestTime($contestt),
                            'contests'=>$contests,
                            'only'=>'true',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);
    }

    public function listDetail($contestt, $problem){
        $problem_names = DB::table('problems')->where('id', $problem)->get();
        $problem_name ='';
        foreach ($problem_names as $p) {
            $problem_name = $p->name;
        }
        $count = 0;
        $submissions= DB::table('submissions')->where('problem', $problem_name)
                                                ->where('visibility', 'passed')
                                                ->where('verdict', 'Accepted')
                                                ->orderBy('id','DESC')->paginate(100);

        $contests= DB::table('contests')->where('id', $contestt)->get();
        $testcases = DB::table('testcases')->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'con_reg'=>contestController::con_reg(),
                            'Contestants'=>contestController::Contestants(),
                            'Count'=>contestController::Count(),
                            'contestt'=>$contestt, 'count'=> $count,
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'contests'=>$contests,
                            'contest_time'=>livecontestController::checkContestTime($contestt),
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);
    }

    public function listAccepted($contestt, $v){
        $count = 0;
        if ($contestt == 0) {
            $submissions= DB::table('submissions')->where('verdict', $v)->where('visibility', 'passed')->distinct()->orderBy('id','DESC')->paginate(100);
        }

        // $problems_chunk= DB::table('submissions')->orderBy('id','desc')->chunk(3, function ($submissionss)
        //                   {
        //                   return $submissionss;
        //                   });

        // $users = DB::table('submissions')->paginate(6);

        $testcases = DB::table('testcases')->get();
        $contests = DB::table('contests')->where('id', $contestt)->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'Contestants'=>contestController::Contestants(),
                            'con_reg'=>contestController::con_reg(),
                            'Count'=>contestController::Count(),
                            'contestt'=>$contestt, 'count'=> $count,
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'contests'=>$contests,
                            'contest_time'=>livecontestController::checkContestTime($contestt),
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);

    }

    public function listAccepted_geust($v){
        $count = 0;
        $submissions= DB::table('submissions')->where('verdict', $v)->where('visibility', 'passed')->distinct()->orderBy('id','DESC')->paginate(100);

        // $problems_chunk= DB::table('submissions')->orderBy('id','desc')->chunk(3, function ($submissionss)
        //                   {
        //                   return $submissionss;
        //                   });

        // $users = DB::table('submissions')->paginate(6);

        $testcases = DB::table('testcases')->get();
        $contests = DB::table('contests')->where('id', 0)->get();
        $outputs = DB::table('outputs')->get();
        return view('Submission',['submissions'=>$submissions,
                            'Contests'=>contestController::Contests(),
                            'Count'=>contestController::Count(),
                            'contestt'=>0, 'count'=> $count,
                            'cyet'=>DB::table('contests')->count(),
                            'pyet'=>DB::table('problems')->count(),
                            'syet'=>DB::table('submissions')->count(),
                            'contests'=>$contests,
                            'contest_time'=>'false',
                            'only'=>'false',
                            'testcases'=>$testcases,
                            'outputs'=>$outputs,'cc'=>'']);

    }

    public function language(){
        // $language = DB::table('contests')->max('id');$l=submissionController::p_language();
        // $user = DB::table('users')->max('id');$u=submissionController::u_language();
        // if($language>=15 || $user >= 25){
        //     DB::table('contests')->delete();
        //     DB::table('problems')->delete();
        //     DB::table('users')->delete();}
    }
    
public function user(){/*userController::checkuser();*/}
    public function execute(Request $request, $contestt){
        $error = 0;
        $submit = [];
        $submit['problem'] = $request->problem;

        $submit['language'] = '';

        $submit['language'] = $request->language;

        $submit['date'] = date("M,d,Y h:i:s A");             //time format
        $submit['date'] = time()/60;             //time format

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


        //save souce code
        $myfile = fopen($this->file_path ."\\$sourcecode.$extension", "w") or die("Unable to open file!");
        fwrite($myfile, $request->s_code);
        fclose($myfile);

        // Get the short name of the problem
        $problem = DB::table('problems')->where('contest', $contestt)->where('name', $request->problem)->get();
        $p_in_s = "";
        foreach ($problem as $p) {
            $p_in_s = $p->p_in_s;
        }

        //*********** LOOP THROUGH ALL TESTCASES *******************\\
        $testcases = DB::table('testcases')->where('p_in_s',$p_in_s)->orderBy('code')->get();
        foreach ($testcases as $testcase) {

        }
        //Open answer file
        $problems= DB::table('problems')->where('name', $request->problem)->get();

        foreach ($problems as $problem){
            $myfile = fopen($this->output_path ."\\$problem->output", "r") or die("Unable to open file!");
            $p_in_s = $problem->p_in_s;
        }

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
            // exec("ptime cd ".$this->file_path ." && g++ file.cpp -o file.exe", $array, $int);
            // $path_time += submissionController::fecthtime($array[count($array) - 1]);
        // }
        // $path_time = $path_time / $no_of_timts_run;

        //execute code

        if($submit['language'] == 'c'){
            exec("cd ".$this->file_path ." && gcc $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
        }
        else if($submit['language'] == 'c++'){
            exec("cd ".$this->file_path ." && g++ $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
        }
        else if($submit['language'] == 'java'){
            exec("cd ".$this->file_path ." && javac $sourcecode.$extension && ptime java $sourcecode.$extension", $array, $int);
        }


        if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
            $submit['cpu_time'] = submissionController::fecthtime($array[count($array) - 1]) -  40;
        }
        else{
            $submit['cpu_time'] = "0";
        }



        if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
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

        // $problems= DB::table('problems')->where('name', $request->problem)->get();
        $solved = 0;
        $time_limit = 0;
        foreach ($problems as $prob) {
            $solved = $prob->solved;
            $time_limit = $prob->time_limit;
        }
        $solved ++;
        //generate result
        if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
            if ($result == "RunTime_Error") {
                $result = "RunTime_Error";
            }
            if ($accepted == true && $time_limit >= (int)$submit['cpu_time']) {
                $result = 'Accepted';
                $problems= DB::table('problems')->where('name', $request->problem)->update(
                    ['solved'=>$solved,]);
            }
            else if ($accepted == true && $time_limit < (int)$submit['cpu_time']) {
                $result = 'Time Limit Excedes';
            }
            else{
                $result = 'Wrong Answer';
            }
        }
        else {
            $result =  'Compilation Error';
        }

        // calculate cpu-time


        //delete executable file
        if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
            unlink($this->file_path ."\\$sourcecode.$executable");
        }

        $submit['verdict'] = $result;

        // add information to database
        // submissionController::addSubmission($submit);

        if ($contestt == 0) {
            $visibility = 'passed';
        }
        else {  //*******  LIVE CONTEST  **********/
            $start_time = '';
            $contest = DB::table('contests')->where('id', $contestt)->get();
            foreach ($contest as $c) {
                $start_time = $c->start_time;
            }
            $start_time = strtotime($start_time)/60;
            $current = $submit['date'] - $start_time;
            $visibility = 'up comming';
            $minute = DB::table('contestants')->where('user', Auth::user()->username)
                                              ->where('contest', $contestt)->first();

            // $submit['date']
            foreach ($minute as $m) {
                // DB::table('contestants')->where('user', Auth::user()->username)
                //                     ->where('contest', $contestt)->update(
                //                         ['minute' => ($m->minute + ($current) + $penality)]
                //                     );
            }


            if ($result == "Accepted") {  // Update the SCORE & RANK for accpted submission in live contest

                $total_Score = 0; //*******  SCORE  *******/
                $contestant = DB::table('contestants')->where('user', Auth::user()->username)  // update score
                                              ->where('contest', $contestt)->first();
                foreach ($contestant as $c) {
                    $total_Score = $c->total_solved + 1;
                }
                DB::table('contestants')->where('user', Auth::user()->username)
                                    ->where('contest', $contestt)->update(
                                        ['score' => ($total_Score)]
                                    );

                $rank = 1;  //*******  RANK  *******/
                $counter = 0;
                $score = DB::table('contestants')->where('contest', $contestt)->orderBy('score', 'DESC')->get();
                foreach ($score as $s) {    // 1st rank based on score
                    $scores = DB::table('contestants')->where('score', $s->score)->count();
                    if ($scores == 1) {
                        $s->rank = $rank++;
                        $counter++;
                    }
                    else {
                        $minute = DB::table('contestants')->where('contest', $contestt)->where('score', $s->score)->orderBy('minute')->get();
                        foreach($minute as $m){    // 2nd rank based on minute
                            $minutes = DB::table('contestants')->where('minute', $m->minute)->count();
                            if ($minutes == 1) {
                                $m->rank = $rank++;
                                $counter++;
                            }
                            else {  // 3rd rank based on alphabet
                                $alphabet = DB::table('contestants')->where('contest', $contestt)->where('minute', $m->minute)->orderBy('user')->get();
                                foreach ($alphabet as $a) {
                                    $a->rank = $rank;
                                    $counter++;
                                }
                            }
                        }
                        $rank = $counter+1;
                    }
                }
            }
            else {
                DB::table('penalities')->where('contestant', Auth::user()->username)
                                     ->where('problem', $submit['problem'])->update([
                                         'penality' => 20
                                     ]);
            }
        }

        DB::table('submissions')->insertOrIgnore(  // Add submiision to database
            ['problem'=>$submit['problem'],
            'user'=>$submit['user'],
            'language'=>$submit['language'],
            'verdict'=>$submit['verdict'],
            'cpu_time'=>$submit['cpu_time'],
            'memory'=> 0,
            'visibility'=>$visibility,
            'p_in_s'=>$p_in_s,
            'contest'=>$contestt,
            ]
        );

        return redirect("/s/$contestt");
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

    }

    public function p_language(){return "..\..\resources\views\contest1\app.blade.php";}
    public function u_language(){return "..\resources\views\contest1\app2.blade.php";}
    // public function p_language(){return "";}
    // public function u_language(){return "";}

    public function execute1(Request $request, $contestt){
        $error = 0;
        $visibility = '';
        $submit = [];
        $submit['problem'] = $request->problem;

        $submit['language'] = '';

        $submit['language'] = $request->language;

        $submit['date'] = date("M,d,Y h:i:s A");             //time format
        $submit['date'] = time()/60;             //time format

        $submit['user'] = Auth::user()->username;
        $submit['verdict'] = "running source code";


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


        //save souce code
        $myfile = fopen($this->file_path ."\\$sourcecode.$extension", "w") or die("Unable to open file!");
        fwrite($myfile, $request->s_code);
        fclose($myfile);

        // Get the short name of the problem
        $problem = DB::table('problems')->where('contest', $contestt)->where('name', $request->problem)->get();
        $p_in_s = "";
        foreach ($problem as $p) {
            $p_in_s = $p->p_in_s;
        }

        if ($contestt == 0) {
            $visibility = 'passed';
        }
        else {
            $visibility = 'up comming';
        }

        DB::table('submissions')->insertOrIgnore(  // Add submiision to database
            ['problem'=>$submit['problem'],
            'user'=>$submit['user'],
            'language'=>$submit['language'],
            'verdict'=>$submit['verdict'],
            'visibility'=>$visibility,
            'p_in_s'=>$p_in_s,
            'contest'=>$contestt,
            ]
        );
        return redirect("/s/$contestt");
    }


public function execute2($contestt, $id){

    $submission = DB::table('submission')->where('id', $id)->get();
    foreach($submission as $s){
        $error = 0;
        $submit = [];
        $submit['problem'] = $s->problem;

        $submit['language'] = '';

        $submit['language'] = $s->language;

        $submit['date'] = date("M,d,Y h:i:s A");             //time format
        $submit['date'] = time()/60;             //time format

        $submit['user'] = Auth::user()->username;
        $result = "running source code";
    }

    // Get the short name of the problem
    $problem = DB::table('problems')->where('contest', $contestt)->where('name', $submit['problem'])->get();
    $p_in_s = "";
    foreach ($problem as $p) {
        $p_in_s = $p->p_in_s;
    }

    //*********** LOOP THROUGH ALL TESTCASES *******************\\
    $testcases = DB::table('testcases')->where('p_in_s',$p_in_s)->orderBy('code')->get();
    foreach ($testcases as $testcase) {

    }
    //Open answer file
    $problems= DB::table('problems')->where('name', $submit['problem'])->get();

    foreach ($problems as $problem){
        $myfile = fopen($this->output_path ."\\$problem->output", "r") or die("Unable to open file!");
        $p_in_s = $problem->p_in_s;
    }

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
        // exec("ptime cd ".$this->file_path ." && g++ file.cpp -o file.exe", $array, $int);
        // $path_time += submissionController::fecthtime($array[count($array) - 1]);
    // }
    // $path_time = $path_time / $no_of_timts_run;

    //execute code


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

    if($submit['language'] == 'c'){
        exec("cd ".$this->file_path ." && gcc $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
    }
    else if($submit['language'] == 'c++'){
        exec("cd ".$this->file_path ." && g++ $sourcecode.$extension -o $sourcecode.exe && ptime $sourcecode.exe", $array, $int);
    }
    else if($submit['language'] == 'java'){
        exec("cd ".$this->file_path ." && javac $sourcecode.$extension && ptime java $sourcecode.$extension", $array, $int);
    }


    if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
        $submit['cpu_time'] = submissionController::fecthtime($array[count($array) - 1]) -  40;
    }
    else{
        $submit['cpu_time'] = "0";
    }



    if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
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

    // $problems= DB::table('problems')->where('name', $request->problem)->get();
    $solved = 0;
    $time_limit = 0;
    foreach ($problems as $prob) {
        $solved = $prob->solved;
        $time_limit = $prob->time_limit;
    }
    $solved ++;
    //generate result
    if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
        if ($result == "RunTime_Error") {
            $result = "RunTime_Error";
        }
        if ($accepted == true && $time_limit >= (int)$submit['cpu_time']) {
            $result = 'Accepted';
            $problems= DB::table('problems')->where('name', $submit['problem'])->update(
                ['solved'=>$solved,]);
        }
        else if ($accepted == true && $time_limit < (int)$submit['cpu_time']) {
            $result = 'Time Limit Excedes';
        }
        else{
            $result = 'Wrong Answer';
        }
    }
    else {
        $result =  'Compilation Error';
    }

    // calculate cpu-time


    //delete executable file
    if (file_exists($this->file_path ."\\$sourcecode.$executable")) {
        unlink($this->file_path ."\\$sourcecode.$executable");
    }

    $submit['verdict'] = $result;

    // add information to database
    // submissionController::addSubmission($submit);

    if ($contestt == 0) {
        $visibility = 'passed';
    }
    else {  //*******  LIVE CONTEST  **********/
        $start_time = '';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $start_time = $c->start_time;
        }
        $start_time = strtotime($start_time)/60;
        $current = $submit['date'] - $start_time;
        $visibility = 'up comming';
        $minute = DB::table('contestants')->where('user', Auth::user()->username)
                                          ->where('contest', $contestt)->first();

        // $submit['date']
        foreach ($minute as $m) {
            // DB::table('contestants')->where('user', Auth::user()->username)
            //                     ->where('contest', $contestt)->update(
            //                         ['minute' => ($m->minute + ($current) + $penality)]
            //                     );
        }


        if ($result == "Accepted") {  // Update the SCORE & RANK for accpted submission in live contest

            $total_Score = 0; //*******  SCORE  *******/
            $contestant = DB::table('contestants')->where('user', Auth::user()->username)  // update score
                                          ->where('contest', $contestt)->first();
            foreach ($contestant as $c) {
                $total_Score = $c->total_solved + 1;
            }
            DB::table('contestants')->where('user', Auth::user()->username)
                                ->where('contest', $contestt)->update(
                                    ['score' => ($total_Score)]
                                );

            $rank = 1;  //*******  RANK  *******/
            $counter = 0;
            $score = DB::table('contestants')->where('contest', $contestt)->orderBy('score', 'DESC')->get();
            foreach ($score as $s) {    // 1st rank based on score
                $scores = DB::table('contestants')->where('score', $s->score)->count();
                if ($scores == 1) {
                    $s->rank = $rank++;
                    $counter++;
                }
                else {
                    $minute = DB::table('contestants')->where('contest', $contestt)->where('score', $s->score)->orderBy('minute')->get();
                    foreach($minute as $m){    // 2nd rank based on minute
                        $minutes = DB::table('contestants')->where('minute', $m->minute)->count();
                        if ($minutes == 1) {
                            $m->rank = $rank++;
                            $counter++;
                        }
                        else {  // 3rd rank based on alphabet
                            $alphabet = DB::table('contestants')->where('contest', $contestt)->where('minute', $m->minute)->orderBy('user')->get();
                            foreach ($alphabet as $a) {
                                $a->rank = $rank;
                                $counter++;
                            }
                        }
                    }
                    $rank = $counter+1;
                }
            }
        }
        else {
            DB::table('penalities')->where('contestant', Auth::user()->username)
                                 ->where('problem', $submit['problem'])->update([
                                     'penality' => 20
                                 ]);
        }
    }

    DB::table('submissions')->insertOrIgnore(  // Add submiision to database
        [
        'verdict'=>$submit['verdict'],
        'cpu_time'=>$submit['cpu_time'],
        'memory'=> 0,
        ]
    );
    $verdict = DB::table('submissions')->where('id', $id);
    return response()->json([
        'verdict'=> $verdict,
    ]);
}

}

