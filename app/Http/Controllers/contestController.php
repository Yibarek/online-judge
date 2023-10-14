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

    public static function Contests(){
        $Contests= DB::table('contests')->where('status', 'upcomming')->orderBy('id', 'DESC')->get();
        return $Contests;
    }
    public static function Contestants(){
        $Contestants= DB::table('contestants')->where('user', Auth::user()->username)->orderBy('id', 'DESC')->get();
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

