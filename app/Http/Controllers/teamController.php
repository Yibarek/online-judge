<?php

namespace App\Http\Controllers;

use App\Models\team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class teamController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function list(){

        $teams= DB::table('teams')->distinct()->orderBy('id', 'DESC')->paginate(75);
        $members= DB::table('users')->distinct()->orderBy('team', 'DESC')->get();
        $organization= DB::table('organizations')->distinct()->orderBy('name')->get();
        return view('Team',['teams'=>$teams, 'Contests'=>contestController::Contests(),
                                                'con_reg'=>contestController::con_reg(),
                                                'Contestants'=>contestController::Contestants(),
                                                'Count'=>contestController::Count(),
                                                'members'=>$members,
                                                'contestt'=>0,
                                                'organization'=>$organization]);
    }

    public function createTeam(Request $request){
        $max = DB::table('teams')->max('id');
        $max = $max + 1;

        if (Auth::user()->team == 0) {
            DB::table('teams')->insertOrIgnore(

                ['name'=>$request->name,
                'organization'=>$request->organization,
                'coach'=>Auth::user()->username,
                'members'=>'1',
                'status'=>'active',
                ]
            );
            $id = DB::table('teams')->max('id');


            // create user for this team
            DB::table('users')->insertOrIgnore(

                ['name'=>$request->name,
                'username'=>$request->name,
                'password'=>Hash::make($request->password),
                'organization'=>$request->organization,
                'email'=>$request->email,
                'rating'=>0,
                'role'=>'team',
                ]
            );

            // refer user team value to team id
            DB::table('users')->where('username', Auth::user()->username)->update(
                ['team'=>$id]
            );
            return redirect('/t/0')->with('success', "Team ". $request->name." is created successfully, tell your friends to join this team!");
        }
        else {
            return redirect('/t/0')->with('danger', "You are Already in another Team. First leave that Team to create a new one.");
        }


    }

    public function searchTeam($team){
        $teams = DB::table('teams')->where('name', 'like', '%'.$team.'%')
                                   ->where('status','!=','cancelled')
                                   ->where('status','!=','deleted')->get();
        foreach ($teams as $team) {
            $organization = DB::table('organizations')->where('name', $team->organization)->get();
            foreach ($organization as $org) {
                return response()->json(['id'=>$team->id, 'name'=>$team->name, 'logo'=>$org->logo], 200);
            }
        }
    }



    public function searchOrganization($org){
        $organizations = DB::table('organizations')->where('name', 'like', '%'.$org.'%')->get();
        foreach ($organizations as $organization) {
            return response()->json(['id'=>$organization->id, 'name'=>$organization->name, 'logo'=>$organization->logo], 200);
        }
    }

    public function joinTeam($id){

        $count = DB::table('teams')->where('id', $id)->count();

        if ($count > 0) {
            $team = DB::table('teams')->where('id', $id)->get();
            $members = 0;
            $team_name = '';
            foreach ($team as $t) {
                $members = ($t->members) + 1;
                $team_name = $t->name;
            }
            if ($members <= 3) {
                if (Auth::user()->team == 0) {
                    DB::table('teams')->where('id', $id)->update(
                        ['members'=>$members]
                    );
                    // refer user team value to team id
                    DB::table('users')->where('id', Auth::user()->id)->update(
                        ['team'=>$t->id]
                    );
                    return redirect('/t/0')->with('success','you have join the team "'.$team_name.'" successfully!');
                }
                else
                {
                    return redirect('/t/0')->with('danger', "You are Already in another Team. First leave that Team to join another team.");
                }
            }
            else {
                return redirect('/t/0')->with('danger','Team "'.$team_name.'" already have 3 member. please join another or create your oun team!');
            }
        }else {
            return redirect('/t/0')->with('danger','no such team avaliable');
        }

    }

    public function show($id){
        $teams = DB::table('teams')->where('id', $id)->first();
        return view('user.userDetail', ['team' => $teams, 'Contests'=>contestController::Contests(),
                                                            'con_reg'=>contestController::con_reg(),
                                                            'Contestants'=>contestController::Contestants(),
                                                            'Count'=>contestController::Count()]);
    }

    public function leave(){
        if (Auth::user()->role == 'user' && Auth::user()->team != 0) {

        $team = DB::table('users')->where('id', Auth::user()->id)->get();
        DB::table('users')->where('id', Auth::user()->id)->update(
            ['team', 0]
        );
        foreach ($team as $t) {
            return redirect('/t/0')->with('success', 'You successfully leave from team '.$t->name);
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    function delete($id)
    {
        if (Auth::user()->role == 'user') {

        $uname = '';
        $team = DB::table('teams')->where('id',$id)->get();
        foreach ($team as $t) {
            $uname = $t->name;
        }
        DB::table('users')->where('username',$uname)->delete();
        if (Auth::user()->role == 'user') {
            DB::table('teams')->where('id',$id)->update(
                ['status' => 'cancelled']
            );
        }
        elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'speradmin') {
            DB::table('teams')->where('id',$id)->update(
                ['status' => 'deleted']
            );
        }

        // delete user under this team
        DB::table('users')->where('team', $id)->update(
            ['team'=>0]
        );
        return redirect('/t/0')->with('success', 'Team '.$uname. ' is successfully deleted!');
        }
        else {
            return redirect('/accessdenied');
        }
    }

}
