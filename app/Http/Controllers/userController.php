<?php

namespace App\Http\Controllers;

use App\Models\contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function list(){
        //query builder
        $permission = adminController::checkPermission('user');
        $Ucount= DB::table('users')->distinct()->orderBy('name')->where('role','user')->count();
        $users= DB::table('users')->distinct()->orderBy('name')->paginate(50);
        return view('users',['users'=>$users, 'Contests'=>contestController::Contests(),
                                                'con_reg'=>contestController::con_reg(),
                                                'Contestants'=>contestController::Contestants(),
                                                'Count'=>contestController::Count(),
                                                'Ucount'=>$Ucount,
                                                'permission'=>$permission,
                                                'contestt'=>0]);
    }

    public function choose(){
        //query builder
        if (Auth::user()->username == "admin"){
            return view('/user');
        }
        else
            return view('/u');
    }

    public function showDetail($id, $contestt){
        if ($id != 1) {
            $user = DB::table('users')->where('id',$id)->get();
            return view('user.userDetail', ['user' => $user, 'Contests'=>contestController::Contests(),
                                                            'con_reg'=>contestController::con_reg(),
                                                            'Contestants'=>contestController::Contestants(),
                                                            'Count'=>contestController::Count(),
                                                            'contestt'=>$contestt]);
        }
        else {
            return redirect('/u/0');
        }

    }

    public function userDetail($username, $contestt){
        $user='';
        $user = DB::table('users')->where('username', $username)->get();
        foreach ($user as $c) {
            $user = $c->username;
        }
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('user') == 'Yes')) && Auth::user()->username == $user) {

        $user = DB::table('users')->where('username',$username)->get();
        return view('user.userDetail', ['user' => $user, 'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'Count'=>contestController::Count(),
                                                        'contestt'=>$contestt]);
        }
        else {
            return redirect('/accessdenied');
        }

    }

    public function userByName($name, $contestt){
        $user='';
        $team='';
        $user = DB::table('users')->where('username', $name)->get();
        foreach ($user as $c) {
            $user = $c->name;
            $team = $c->team;
        }
        if ((Auth::user()->role == 'superadmin') || ((Auth::user()->role == 'admin' && adminController::checkPermission('user') == 'Yes') && Auth::user()->name == $user) || Auth::user()->team == $team) {

        $user = DB::table('users')->where('name', $name)->get();
        return view('user.userDetail', ['user' => $user, 'Contests'=>contestController::Contests(),
                                                        'con_reg'=>contestController::con_reg(),
                                                        'Contestants'=>contestController::Contestants(),
                                                        'Count'=>contestController::Count(),
                                                        'contestt'=>$contestt]);
        }
        else {
            return redirect('/accessdenied');
        }
    }

    function changeProfile( Request $request){
        $logo = '';

        $new_image_name='';
        if($request->hasfile('img')){
            //getting the file from view
            $image = $request->file('img');
            // $image_size = $image->getClientSize();

            //getting the extension of the file
            $image_ext = $image->getClientOriginalExtension();
            //changing the name of the file
            $new_image_name = Auth::user()->id."".$image_ext;
            $destination_path = public_path('/image/profile');
            $image->move($destination_path,$new_image_name);

            // return $new_image_name;
        }

        if ($new_image_name == "") {
            $logo = Auth::user()->profile_image;
            // return $logo;
        }else {
            $logo = $request->img;
            // return $logo;
        }


        $result_value = DB::table('users')->where('id', Auth::user()->id)->update(
            [
                'name'=>$request->fullname,
                'username'=>$request->username,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'country'=>$request->country,
                'city'=>$request->city,
                'organization'=>$request->organization,
                'college'=>$request->college,
                'department'=>$request->department,
                'occupation'=>$request->occupation,
                'profile_image'=>$logo,
            ]
        );

        if ($result_value == 1) {
            return redirect('/profile')->with('success', 'Profile is changed successfully!');
        } else {
            return redirect('/profile')->with('danger', 'Profile change is failed!');
        }

    }

    public function changePassword(Request $request){
        $password = DB::table('users')->where('id', Auth::user()->id)->get();
        $i=0;
        foreach ($password as $p) {
            if (Hash::check($p->password, Hash::make($request->currentPassword))) {
                DB::table('users')->where('id', Auth::user()->id)->update(
                    ['password' => Hash::make($request->renewPassword)]
                );
                $i++;
                return redirect('/profile')->with('success', 'Password changed successfully!');
            }
        }
        if ($i==0) {
            return redirect('/profile')->with('danger', 'Password changed failed!');
        }
    }

    public function delete($id)
    {
        if ((Auth::user()->role == 'superadmin' || (Auth::user()->role == 'admin' && adminController::checkPermission('user') == 'Yes'))) {

        DB::table('users')->where('id',$id)->delete();
        return redirect('/u/0');
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function deleteProfile()
    {
        DB::table('users')->where('id',Auth::user()->id)->update(
            ['profile_image' => 'default_profile.png']
        );
        return redirect('/u/0');

    }

    public function registration($id){
        $users = DB::table('users')->where('id', $id)->get();
        foreach ($users as $user) {
            if ($user->name == '' ||
                $user->country == '' ||
                $user->city == '' ||
                $user->organization == '' ||
                $user->occupation == '' ||
                $user->college == '' ||
                $user->department == '' ||
                $user->email == '' ||
                $user->phone == '' ||
                $user->role == '') {
                return false;
            }
            else {
                return true;
            }
        }
    }
}
