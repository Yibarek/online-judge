<?php

namespace App\Http\Controllers;

use App\Models\contestant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class contestantController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public static $message = '';

    public function list($c_id){
        //query builder
        // $contestants= DB::table('contestants')->where('id', $c_id)->distinct()->orderBy('id','DESC')->get();
        // return view ('', ['contestant'=>$contestants, 'Contests'=>contestController::Contests(),
        //                            contest.contestant                                     'con_reg'=>contestController::con_reg(),
        //                                                                 'Count'=>contestController::Count(),
        //                                                                 'contestt'=>$c_id]);
        $contestants= DB::table('contestants')->where('contest', $c_id)->orderBy('id')->paginate(75);
        $contest= DB::table('contests')->where('id', $c_id)->get();
        return view('Contestant', ['contestants'=>$contestants, 'Contests'=>contestController::Contests(),
                                                'con_reg'=>contestController::con_reg(),

                                                'Contestants'=>contestController::Contestants(),
                                                'Count'=>contestController::Count(),
                                                'contestt'=>0,
                                                'contest'=>$contest]);
    }

    public function show($id){
        $problem = DB::table('problems')->where('id', $id)->get();
        return view('problem.solveProblem', ['problem' => $problem, 'Contests'=>contestController::Contests(),
                                                                    'Contestants'=>contestController::Contestants(),
                                                                    'con_reg'=>contestController::con_reg(),
                                                                    'Count'=>contestController::Count()]);}


    public function add($contestt){

        $reg = DB::table('contestants')->where('contest', $contestt)->where('user', Auth::user()->username)->count();

        if ($reg == 0) {
            $contest = DB::table('contests')->where('id', $contestt)->get();
            foreach ($contest as $c) {
            //     $contestantt = $c->contestants + 1;
                if ((Auth::user()->role == 'team' && $c->type == 'Team') ||
                    (Auth::user()->role == 'user' && $c->type == 'Individual')) {

                    DB::table('contestants')->insertOrIgnore(
                        ['contest'=>$contestt,
                        'user'=>Auth::user()->username,
                        'total_solved'=>0,
                        'status'=>'Pending',
                        'minute'=>0,
                        'rank'=>0,
                        ]
                    );

                    // DB::table('contests')->where('id', $contestt)->update(
                    //     ['contestants'=>$contestantt]
                    // );
                    return redirect('/lc/contestants/'.$contestt)->with('success', "Your request to participate on contest $c->name is sent successfully!");
                }
            }

        }
        else {
            return redirect('/lc/contestants/'.$contestt)->with('danger', "You already registered to the contest!");
        }

        $users= DB::table('contestants')->where('contest', $contestt)->orderBy('id')->get();
        $contest= DB::table('contests')->where('id', $contestt)->get();

        // foreach ($contest as $c) {
        //     return redirect('/lc/contestants/'.$contestt)->with('success', "user request to participate on contest $c->name is successfully sent.");
        // }

    }

    public function accept($id)
    {
        DB::table('contestants')->where('id', $id)->update(

            ['status'=>"Accepted"]

        );

        $user = DB::table('contestants')->where('id', $id)->get();
        foreach ($user as $u) {
            $contest = DB::table('contests')->where('id', $u->contest)->get();
            foreach ($contest as $c) {
                $contestantt = $c->contestants + 1;
                DB::table('contests')->where('id', $u->contest)->update(
                    ['contestants'=>$contestantt]
                );
            }
        }

        $contestants = DB::table('contestants')->where('id', $id)->get();
        $contest = 0;


        foreach ($contestants as $contestant) {
            $contest = $contestant->contest;
            return redirect('/lc/contestants/'.$contestant->contest)->with('success', "$contestant->user is APPRROVED to participate on this contest!");
        }
    }

    public function reject($id)
    {
        DB::table('contestants')->where('id', $id)->update(

            ['status'=>"Rejected"]

        );

        $user = DB::table('contestants')->where('id', $id)->get();
        foreach ($user as $u) {
            $contest = DB::table('contests')->where('id', $u->contest)->get();
            foreach ($contest as $c) {
                $contestantt = $c->contestants - 1;
                DB::table('contests')->where('id', $u->contest)->update(
                    ['contestants'=>$contestantt]
                );
            }
        }

        $contestants = DB::table('contestants')->where('id', $id)->get();
        $contest = 0;
        foreach ($contestants as $contestant) {
            $contest = $contestant->contest;
            return redirect('/lc/contestants/'.$contestant->contest)->with('success', "$contestant->user is REJECTED to participate on this contest!");
        }
    }
}
