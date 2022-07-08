<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class CalculateServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }

    public function checkUser(Request $request){
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            if ($user->email==$request->email && Hash::check($request->password, $user->password)) {
                return view('auth.login1', ['email'=>$user->email, 'password'=>$request->password]);
            }
            else {
                return view('auth.login1', ['email'=>$user->email, 'password'=>$request->password]);
            }
        }
    }

}
