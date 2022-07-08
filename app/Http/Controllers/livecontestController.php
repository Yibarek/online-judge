<?php

namespace App\Http\Controllers;

use App\Models\contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class livecontestController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    public function problem($contest){
        //query builder
        $problems= DB::table('problems')->where('contest', $contest)->orderBy('id')->get();
        $Contests= DB::table('contests')->where('status', 'upcomming')->get();
        $Count= DB::table('contests')->where('status', 'upcomming')->count();
        return view('liveContest.problem',['problems'=>$problems, 'contest'=>$contest, 'Count'=> $Count]);

    }

    public function showProblem($id, $contest){
        // $problem = DB::table('problems')->where('id', $id)->first();

        // return view('liveContest.solve_Problem', ['problem' => $problem, 'contest'=>$contest,]);
    }


    public function clarification($contestt){
        $contests= DB::table('contests')->where('id', $contestt)->get();
        $creator = '';
        foreach ($contests as $c) {
            $creator = $c->creator;
        }
        $user='';
        $first = DB::table('clarifications')->where('contest', $contestt)->orderBy('id','DESC')->get();
        foreach ($first as $f) {
            if($f->sender != Auth::user()->username){
                $user = $f->sender;
            }
            elseif ($f->reciever != Auth::user()->username) {
                $user = $f->reciever;
            }
            break;
        }
        $clarifications = DB::table('clarifications')->where('contest', $contestt)->orderBy('id')->get();
        $max=4;
        $maxid = DB::table('clarifications')->where('contest', $contestt)->orderBy('id')->get();
        foreach ($clarifications as $m) {
            // if (Auth::user()->username == $creator) {
                // if ($m->reciever == Auth::user()->username || $m->sender == Auth::user()->username) {
                    $max == $m->id;
                // }
            // }
        }$ct = livecontestController::checkContestTime($contestt);
        $contestants =  DB::table('contestants')->where('contest', $contestt)->where('status', 'Accepted')->orderBy('id')->get();
        $users =  DB::table('users')->orderBy('id')->get();
        return view('liveContest.cla',['clarifications'=>$clarifications,
                                        'contestt'=>$contestt,
                                        'contests'=>$contests,
                                        'creator'=>$creator,
                                        'selectedUser'=>$user,
                                        'users'=>$users,
                                        'max'=>$max,
                                        'contest_time'=>$ct,
                                        'contestants'=>$contestants]);

    }

    function loadClarification($user, $contestt){
        $contests= DB::table('contests')->where('id', $contestt)->get();
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }

        $clarifications = DB::table('clarifications')->where('contest', $contestt)->orderBy('id')->get();
        $max=4;
        $maxid = DB::table('clarifications')->where('contest', $contestt)->orderBy('id')->get();
        foreach ($clarifications as $m) {
            // if (Auth::user()->username == $creator) {
                // if ($m->reciever == Auth::user()->username || $m->sender == Auth::user()->username) {
                    $max == $m->id;
                // }
            // }
        }
        $contestants =  DB::table('contestants')->where('contest', $contestt)->orderBy('id')->get();
        $users =  DB::table('users')->orderBy('id')->get();
        return view('liveContest.cla',['clarifications'=>$clarifications,
                                        'contestt'=>$contestt,
                                        'contests'=>$contests,
                                        'creator'=>$creator,
                                        'selectedUser'=>$user,
                                        'users'=>$users,
                                        'max'=>$max,
                                        'contest_time'=>livecontestController::checkContestTime($contestt),
                                        'contestants'=>$contestants]);
    }
    public function submission($contest){

        // $submission = DB::table('submission')->where('contest', $contest)->orderBy('id')->get();

        // return view('liveContest.submission',['submission'=>$submission, 'contest'=>$contest,]);

    }

    public function scoreboard($contestt){
        $creator='';
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            $creator = $c->creator;
        }
        $competants= DB::table('contestants')->where('contest', $contestt)->where('status', 'Accepted')->orderBy('rank')->paginate(100);
        $contests= DB::table('contests')->where('id', $contestt)->get();
        $submissions= DB::table('submissions')->where('contest', $contestt)->get();
        $problems = DB::table('problems')->where('contest', $contestt)->orderBy('p_in_s')->get();
        $first_solved = [];
        foreach ($problems as $p) {
            $solved = DB::table('submissions')->where('contest', $contestt)
                                                                ->where('p_in_s',$p->p_in_s)
                                                                ->where('verdict', 'Accepted')->count();
            if ($solved > 0) {
                $fs = DB::table('submissions')->where('contest', $contestt)
                                                                ->where('p_in_s',$p->p_in_s)
                                                                ->where('verdict', 'Accepted')->get();


                foreach ($fs as $f) {
                    $st = microtime(true);
                    $first_solved[$p->p_in_s] = microtime($f->date) - $st;
                }
            }
            else {
                $first_solved[$p->p_in_s] = 0;
            }
        }
        $problem_no = 0;
        $freez_start = 0;
        $freez_end = 0;
        foreach ($contests as $contest) {
            $problem_no = $contest->problems;
            $freez_start = $contest->freez_time;
            $freez_end = $contest->unfreez_time;
        }
        return view('liveContest.scoreboard',['contests'=>$contests,
                                            'competants'=>$competants,
                                            'Contestants'=>contestController::Contestants(),
                                            'submissions'=>$submissions,
                                            'creator'=>$creator,
                                            'contestt'=>$contestt,
                                            'problem_no'=>$problem_no,
                                            'contest_time'=>livecontestController::checkContestTime($contestt),
                                            'problems'=>$problems,
                                            'freez_start'=>$freez_start,
                                            'freez_end'=>$freez_end,
                                            'first_solved'=>$first_solved]);

    }

    public function scoreboard_geust($contestt){
        $contest_time = livecontestController::checkContestTime($contestt);
        if ($contest_time == 'true') {
            $competants= DB::table('contestants')->where('contest', $contestt)->where('status', 'Accepted')->orderBy('rank')->paginate(100);
            $contests= DB::table('contests')->where('id', $contestt)->get();
            $submissions= DB::table('submissions')->where('contest', $contestt)->get();
            $problems = DB::table('problems')->where('contest', $contestt)->orderBy('p_in_s')->get();
            $first_solved = [];
            foreach ($problems as $p) {
                $solved = DB::table('submissions')->where('contest', $contestt)
                                                                    ->where('p_in_s',$p->p_in_s)
                                                                    ->where('verdict', 'Accepted')->count();
                if ($solved > 0) {
                    $fs = DB::table('submissions')->where('contest', $contestt)
                                                                    ->where('p_in_s',$p->p_in_s)
                                                                    ->where('verdict', 'Accepted')->get();


                    foreach ($fs as $f) {
                        $st = microtime(true);
                        $first_solved[$p->p_in_s] = microtime($f->date) - $st;
                    }
                }
                else {
                    $first_solved[$p->p_in_s] = 0;
                }
            }
            $problem_no = 0;
            $freez_start = 0;
            $freez_end = 0;
            foreach ($contests as $contest) {
                $problem_no = $contest->problems;
                $freez_start = $contest->freez_time;
                $freez_end = $contest->unfreez_time;
            }
            return view('liveContest.scoreboard',['contests'=>$contests,
                                                'competants'=>$competants,
                                                'submissions'=>$submissions,
                                                'contestt'=>$contestt,
                                                'problem_no'=>$problem_no,
                                                'contest_time'=>'false',
                                                'problems'=>$problems,
                                                'freez_start'=>$freez_start,
                                                'freez_end'=>$freez_end,
                                                'first_solved'=>$first_solved]);
        }
        else {
            return redirect('/accessdenied');
        }

    }

    public function sendClarification(Request $request, $contestt){
        $date = date('d M Y H:i');
        $contest = DB::table('contests')->where('id', $contestt)->get();
        foreach ($contest as $c) {
            if ($c->creator == Auth::user()->username) {
                DB::table('clarifications')->insertOrIgnore(
                    [
                        'sender'=>Auth::user()->username,
                        'reciever'=>$request->contestant,
                        'content'=>$request->content,
                        'sender_status'=>'sent',
                        'contest'=>$contestt,
                        'time'=>$date,
                    ]
                    );

                    return redirect ("/lc/clarification/$contestt");
            }
            else {
                DB::table('clarifications')->insertOrIgnore(
                    [
                        'sender'=>Auth::user()->username,
                        'reciever'=>$c->creator,
                        'content'=>$request->content,
                        'contest'=>$contestt,
                        'reciever_status'=>'sent',
                        'time'=>$date,
                    ]
                    );

                    return redirect ("/lc/clarification/$contestt");
            }
        }
    }

    public function submit(){

    }

    public function checkContestTime($contestt){
        $count = DB::table('contests')->where('id', $contestt)->count();
        $contest = DB::table('contests')->where('id', $contestt)->get();
        if ($count == 0) {
            return 'false';
        }
        else {
            foreach ($contest as $c) {
                $start = strtotime($c->start_time);
                $end = strtotime($c->end_time);
                $now = strtotime("now");
                if ($now >= $start && $now <= $end) {
                    return 'true';
                } else {
                    return 'false';
                }

            }
        }

    }

}
