<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')->where('role', 'user')->orderBy('rating', 'DESC')->paginate(10);
        $teams = DB::table('users')->where('role', 'team')->orderBy('rating', 'DESC')->paginate(10);
        $contests = DB::table('contests')->orderBy('id', 'DESC')->paginate(20);
        $organization= DB::table('organizations')->distinct()->orderBy('name')->get();

        $winners[][] = '';
        foreach ($contests as $contest) {
            $contestants = DB::table('contestants')->where('contest', $contest->id)->distinct()->orderBy('rank')->get();
            $contestants_count = DB::table('contestants')->where('contest', $contest->id)->distinct()->orderBy('rank')->count();

            // if there are contestant is registered on contest
            if ($contestants_count > 0) {
                $i=1;
                foreach ($contestants as $contestant) {
                    $winners[$contest->id][$i] = $contestant->user;
                    $i++;
                    if ($i > $contest->winners) {
                        break;
                    }
                }
            }
            else {
                $i=1;
                while ($i <= $contest->winners) {
                    $winners[$contest->id][$i] = '';
                    $i++;
                }
            }

        }

        $today = date("d/m/Y");

        $user_count = DB::table('users')->where('role', 'user')->count();
        $admin_count = DB::table('users')->where('role', 'admin')->count();
        $team_count = DB::table('users')->where('role', 'team')->count();
        $problem_count= DB::table('problems')->where('visibility', 'passed')->count();
        $contest_count= DB::table('contests')->where('status', 'passed')->count();
        $submission_count= DB::table('submissions')->where('visibility', 'passed')->count();

        $contest_permission = adminController::checkPermission('contest');
        $problem_permission = adminController::checkPermission('problem');
        $user_permission = adminController::checkPermission('user');
        $team_permission = adminController::checkPermission('team');
        $sponsers = DB::table('sponsers')->distinct()->get();

        return view('/dashboard', [ 'Contests'=>contestController::Contests(),
                                            'con_reg'=>contestController::con_reg(),
                                            'Count'=>contestController::Count(),
                                            'Contestants'=>contestController::Contestants(),
                                            'user_count'=>$user_count,
                                            'admin_count'=>$admin_count,
                                            'team_count'=>$team_count,
                                            'problem_count'=>$problem_count,
                                            'contest_count'=>$contest_count,
                                            'contest_permission'=>$contest_permission,
                                            'problem_permission'=>$problem_permission,
                                            'user_permission'=>$user_permission,
                                            'team_permission'=>$team_permission,
                                            'submission_count'=>$submission_count,
                                            'sponsers'=>$sponsers,
                                            'organization'=>$organization,
                                            'users'=>$users,
                                            'teams'=>$teams,
                                            'winners'=>$winners,
                                            'contestt'=>0,
                                            'contests'=>$contests]);

    }

    public function welcomePage(){
        $user_count = DB::table('users')->count();
        $problem_count = DB::table('problems')->where('visibility', 'passed')->count();
        $contest_count= DB::table('contests')->where('status', 'passed')->count();
        return view('welcome',['user_count'=>$user_count,
                                'problem_count'=>$problem_count,
                                'contest_count'=>$contest_count,]);
    }

}
