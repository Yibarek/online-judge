<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use DateTime;

class countryController extends Controller
{
    public function list(){
        $countries= DB::table('countries')->distinct()->orderBy('country')->paginate(75);
        return view('country',['countries'=>$countries, 'Contests'=>contestController::Contests(),
                                                'con_reg'=>contestController::con_reg(),
                                                'Contestants'=>contestController::Contestants(),
                                                'Count'=>contestController::Count(),
                                                'contestt'=>0]);
    }

    public static function organizations($country){
        return $organizations= DB::table('organizations')->where('country', $country)->count();
    }

    public function addCountry(Request $request){
        if(Auth::user()->role == 'superadmin'){
            $image="";
            $response=0;
            $new_image_name='';

            if($request->file('country_flag')){
                $file= $request->file('country_flag');
                $new_image_name= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('../image/country'), $new_image_name);
            }

            if ($new_image_name == "") {
                $image = 'default_flag.jpg';
            }else {
                $image = $new_image_name;
            }

            $response = DB::table('countries')->insertOrIgnore([
                'country'=>$request->country,
                'flag'=>$image,
            ]);

            if ($response == 1) {
                return redirect('/cy/0')->with('success', 'New Country is added successfully!');
            }
            else{
                return redirect('/cy/0')->with('danger', 'Unable to add the country. Try again!');
            }
        }
        else {
            return redirect('/accessdenied');
        }
    }

    public function editCountry(Request $request, $id){
        $image="";
        $new_image_name='';

        if($request->file('profile_image')){
            $file= $request->file('profile_image');
            $new_image_name= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('../image/country'), $new_image_name);
        }

        if ($new_image_name == "") {
            $image = 'default_profile.png';
        }else {
            $image = $new_image_name;
        }

        $response = DB::table('countries')->where('id', $id)->update(

            ['flag'=>$image,
            'country'=>$request->country,
            ]
        );

        if ($response == 1) {
            return redirect('/cy/0')->with('success', "Country is created successfully");
        } else {
            return redirect('/cy/0')->with('danger', "Unable to create country. Try again!");
        }

    }

}


