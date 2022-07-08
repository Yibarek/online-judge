<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ratingController extends Controller
{
    public function list(){
        //query builder
        $users= DB::table('users')->where('role', 'user')->distinct()->orderBy('rating', 'DESC')->paginate(75);
        $teams= DB::table('users')->where('role', 'team')->distinct()->orderBy('rating', 'DESC')->paginate(75);
        $countries= DB::table('countries')->distinct()->get();
        $organizations= DB::table('organizations')->distinct()->get();
        return view('rating',['users'=>$users, 'teams'=>$teams,
                                'Contests'=>contestController::Contests(),
                                'con_reg'=>contestController::con_reg(),
                                'Contestants'=>contestController::Contestants(),
                                'Count'=>contestController::Count(),
                                'countries'=>$countries,
                                'organizations'=>$organizations,
                                'contestt'=>0]);
    }

    public function list_geust(){
        //query builder
        $users= DB::table('users')->where('role', 'user')->distinct()->orderBy('rating', 'DESC')->paginate(75);
        $teams= DB::table('users')->where('role', 'team')->distinct()->orderBy('rating', 'DESC')->paginate(75);
        $countries= DB::table('countries')->distinct()->get();
        $organizations= DB::table('organizations')->distinct()->get();
        return view('rating',['users'=>$users, 'teams'=>$teams,
                                'Contests'=>contestController::Contests(),
                                'Count'=>contestController::Count(),
                                'countries'=>$countries,
                                'organizations'=>$organizations,
                                'contestt'=>0]);
    }

}
