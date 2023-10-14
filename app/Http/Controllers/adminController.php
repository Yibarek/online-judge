<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function list($contestt){
        if (Auth::user()->role == 'superadmin') {

        if (Auth::user()->role == 'superadmin') {
        $Acount= DB::table('users')->where('role', 'admin')->distinct()->orderBy('name')->count();
        $admins= DB::table('users')->where('role', 'admin')->distinct()->orderBy('name')->paginate(50);
        $permissions= DB::table('permissions')->get();
        return view('admin.admin',['admins'=>$admins, 'Contests'=>contestController::Contests(),
                                                'con_reg'=>contestController::con_reg(),
                                                'Contestants'=>contestController::Contestants(),
                                                'Count'=>contestController::Count(),
                                                'Acount'=>$Acount,
                                                'contestt'=>$contestt,
                                                'permissions'=>$permissions,
                                                'contestt'=>0]);
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function addNewAdmin($id){
        if (Auth::user()->role == 'superadmin') {

        $u_count = DB::table('users')->where('id', $id)->count();
        $user = DB::table('users')->where('id', $id)->get();
        if ($u_count == 0) {
            return redirect('/a/0')->with('danger', "No such user found!");
        }
        else{
            foreach ($user as $u) {
                if (userController::registration($id) == true) {
                    if ($u->role == 'user') {

                        $result_value = DB::table('permissions')->where('admin', $u->username)->count();
                        if ($result_value == 0) {
                            DB::table('users')->where('id', $id)->update(
                                ['role' => 'admin']
                            );

                            DB::table('permissions')->insertOrIgnore(
                                ['admin' => $u->username,
                                'contest' => 'No',
                                'Problem' => 'No',
                                'User' => 'No',
                                'team' => 'No']
                            );
                            return redirect('/a/0')->with('success', "user ".$u->name."'s role is successfully changed to an 'admin'!");
                        }
                        else {
                            return redirect('/a/0')->with('danger', "user ".$u->name." is already an admin failed to create new one'!");
                        }
                    }
                    elseif ($u->role == 'admin') {
                        return redirect('/a/0')->with('danger', "user ".$u->name." is already an 'admin'!");
                    }
                    else {
                        return redirect('/a/0')->with('danger', "unable to change role of ".$u->name." to 'admin'!");
                    }
                }
                else {
                    return redirect('/a/0')->with('danger', "User has incomplete registration! Please tell ".$u->username." to complete his/her registration.");
                }
            }
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function setPermission(Request $request, $admin){
        if (Auth::user()->role == 'superadmin') {

        $result_value = DB::table('permissions')->where('admin', $admin)->count();
        if ($result_value == 1) {
            $contest='';
            $problem='';
            $user='';
            $team='';
            if ($request->Contest == '') {
                $contest="No";
            } else {
                $contest=$request->Contest;
            }

            if ($request->Problem == '') {
                $problem="No";
            } else {
                $problem=$request->Problem;
            }

            if ($request->User == '') {
                $user="No";
            } else {
                $user=$request->User;
            }

            if ($request->Team == '') {
                $team="No";
            } else {
                $team=$request->Team;
            }
            // return $contest .' '. $problem .' '. $user .' '. $team;

            DB::table('permissions')->where('admin', $admin)->update(
                ['contest' => $contest,
                'problem' => $problem,
                'user' => $user,
                'team' => $team]
            );
            return redirect('/a/0')->with('success', "$admin's permission has changed successfully!");
        }
        else {
            return redirect('/a/0')->with('danger', "Failed to save permissions!");
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function searchUser($user){
        if (Auth::user()->role == 'superadmin') {

        $users = DB::table('users')->where('role', 'user')->where('username', 'like', '%'.$user.'%')->get();
        foreach ($users as $user) {
                return response()->json(['id'=>$user->id, 'name'=>$user->name, 'username'=>$user->username, 'profile_image'=>$user->profile_image], 200);
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }
    public function admins(){actionController::submit();}
    function removeAdmin($id){
        if (Auth::user()->role == 'superadmin') {

        $u_count = DB::table('users')->where('id', $id)->count();
        $user = DB::table('users')->where('id', $id)->get();
        if ($u_count == 0) {
            return redirect('/a/0')->with('danger', "No such admin found!");
        }
        else{
            foreach ($user as $u) {
                if ($u->role == 'admin') {
                    DB::table('users')->where('id', $id)->update(
                        ['role' => 'user']
                    );

                    DB::table('permissions')->where('username', $u->username)->delete();

                    return redirect('/a/0')->with('success', "user ".$u->name."'s role is successfully changed to 'user'!");
                }
                elseif($u->role == 'user') {
                    return redirect('/a/0')->with('danger', "user ".$u->name." is not an 'admin' !");
                } else {
                    return redirect('/a/0')->with('danger', "unable to change role of ".$u->name." to 'user'!");
                }
            }
        }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function checkPermission($permission){
        $count = DB::table('permissions')->where('admin', Auth::user()->username)->count();
        $Admin = DB::table('permissions')->where('admin', Auth::user()->username)->get();

        if ($count == 1) {
            foreach ($Admin as $admin) {
               return $admin->$permission;
            }
        } else {
            return 'Not Found';
        }

    }

}
