<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use Request;

use App\User;
use App\Role;
use Response;
use Redirect;
use Session;
use Auth;
use Hash;

class UserController extends Controller
{
    public function getUserById($id){
    	$user 	= User::find($id);
    	$user->roles = $user->roles;
    	$data 	= [
    		"success" => 1,
    		"data" => $user
    	];

    	return Response::json($data);
    }

    public function edit_user($id){
    	\DB::table('role_user')->where('user_id', $id)->delete();
    	$ruser  		= User::find($id);
    	$name           = Request::input("name");
    	$email          = Request::input("email");
    	$password       = Request::input("password");
        $cabang         = Request::input("cabang");
    	if(!empty(Request::input("role"))){
    		$role           = Request::input("role");
    		foreach($role as $r){
    			$srole  = Role::find($r);
    			$ruser->attachRole($srole);
    		}
    	}
    	$ruser->name 	= $name;
        $ruser->cabang  = $cabang;
    	if($password != ""){
    		$ruser->password 	= \Hash::make($password);
    	}
    	$ruser->save();

        $message = ["success" => "Berhasil mengubah user"];
        Session::flash("message", $message);
    	return redirect("/admin/user");
    }

    public function user_checkpassword(){
        $value  = Request::input("value");

        $user    = Auth::user();

        if(Hash::check($value, $user->password)){
            $data = [
                "success" => 1
            ];
        }
        else{
            $data = [
                "success" => 0
            ];
        }
        
        return Response::json($data);
    }

    public function manualeditpassword(){
        $new        = Request::input("newpassword");
        $confirm    = Request::input("confirmnewpassword");

        if($new == $confirm){
            $user   = User::find(Auth::user()->id);
            $user->password    = Hash::make($new);
            $user->save();

            $message = ["success" => "Berhasil mengubah password"];

            Session::flash("message", $message);
            return Redirect::back();
        }
        else{


            $message    = ["danger" => "GAGAL !, Password baru dengan konfirmasi password baru tidak sama !"];
            Session::flash("message", $message);
            return Redirect::back();
        }
    }

    public function api_login(){
        $email      = Request::input("email");
        $password   = Request::input("password");

        $user   = User::where("email","=",$email);

        // var jdata = JSON.stringify({
        //     status : 1,
        //     message : "Redirect to Dashboard !",
        //     data_user : rows[0],
        //     data_home : dataTemp,
        //     token : token,
        // });

        if($user->count() > 0){
            $data_user  = $user->first();
            if(!\Hash::make($password) == $data_user->password){
                $data = [
                    "status" => 0,
                    "message" => "Wrong Password"
                ];
            }
            else{
                $user->name     = $data_user->name;
                $user->password = $data_user->password;
                $user->cabang   = $data_user->cabang;
                $user->role     = User::find($data_user->id)->roles[0]->name;
                $data = [
                    "status" => 1,
                    "message" => "Successfully Login",
                    "data_user" => $user
                ];
            }
        }
        else{
            $data = [
                "status" => 0,
                "message" => "User is not registered"
            ];
        }

        return Response::json($data);
    }
}
