<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use Request;
use Session;
use Response;

use App\Role;
use App\Permission;
use App\User;
use App\Cabang;

use Auth;
use App;
use Excel;

class AdminController extends Controller
{
    public function role(){
        $roleData   = Role::all();
    	return view("Admin.role")->with("role", $roleData);
    }

    public function getRoleById($id){
        $role   = Role::find($id);

        $data   = [
            "success" => 1,
            "data" => $role
        ];

        return Response::json($data);
    }

    

    public function role_add(){
    	$name 			= Request::input("name");
    	$display_name	= Request::input("display_name");
    	$description	= Request::input("description");

    	$role 	= new Role();
    	$role->name 		= $name;
    	$role->display_name	= $display_name;
    	$role->description 	= $description;

    	$role->save();

        $message = ["success" => "Berhasil menambahkan role"];
        Session::flash("message", $message);
    	return redirect("admin/role");
    }

    public function role_edit($id){
            $name           = Request::input("name");
            $display_name   = Request::input("display_name");
            $description    = Request::input("description");

            $role   = Role::find($id);
            $role->name         = $name;
            $role->display_name = $display_name;
            $role->description  = $description;

            $role->save();

            $message = ["success" => "Berhasil mengubah role"];
            Session::flash("message", $message);
            return redirect("admin/role");
    }

    public function role_checkname(){
        $name   = Request::input("name");
        $ret    = false;
        $check  = Role::where("name", "=", $name)->count();
        if($check > 0){
            $ret = true;
        }
        $data   = [
            "success" => 1,
            "data" => $ret
        ];
        return Response::json($data);
    }

    public function permission(){
        $role   = Role::all();
        $permission = Permission::all();
        $roleperm = \DB::table("permission_role")->get();

        return view("Admin.permission")->with(["role" => $role, "permission" => $permission, "roleperm" => $roleperm]);
    }

    public function permission_add(){
        $name           = Request::input("name");
        $display_name   = Request::input("display_name");
        $description    = Request::input("description");

        $permission   = new Permission();
        $permission->name         = $name;
        $permission->display_name = $display_name;
        $permission->description  = $description;

        $permission->save();

        $message = ["success" => "Berhasil menambahkan permission"];
        Session::flash("message", $message);
        return redirect("admin/permission");
    }

    public function permission_checkname(){
        $name   = Request::input("name");
        $ret    = false;
        $check  = Permission::where("name", "=", $name)->count();
        if($check > 0){
            $ret = true;
        }
        $data   = [
            "success" => 1,
            "data" => $ret
        ];
        return Response::json($data);
    }


    public function user(){
        $roles  = Role::all();
        $users  = User::with("s_cabang")->get(); 
        $cabang = Cabang::with("s_divisi")->get();
        return view("Admin.user")->with(["roles" => $roles, "users" => $users, "cabang" => $cabang]);
    }

    public function user_add(){
        $name           = Request::input("name");
        $email          = Request::input("email");
        $password       = Request::input("password");
        $cabang         = Request::input("cabang");
        $role           = Request::input("role");

        $user   = new User();
        $user->name         = $name;
        $user->email        = $email;
        $user->password     = \Hash::make($password);
        $user->cabang       = $cabang;
        $user->save();

        $ruser  = User::where("email", "=", $email)->first();
        $ruser  = User::find($ruser->id);
        foreach($role as $r){
            $srole  = Role::find($r);
            $ruser->attachRole($srole);
        }

        $message = ["success" => "Berhasil menambahkan user"];
        Session::flash("message", $message);
        return redirect("admin/user");
    }


    public function user_checkemail(){
        $email   = Request::input("email");
        $ret    = false;
        $check  = User::where("email", "=", $email)->count();
        if($check > 0){
            $ret = true;
        }
        $data   = [
            "success" => 1,
            "data" => $ret
        ];
        return Response::json($data);
    }

    public function actroleperm(){
        \DB::table("permission_role")->delete();
        $roleperm   = Request::input("roleperm");
        if(!empty($roleperm)){
            foreach($roleperm as $rp){
                $ex     = explode("-", $rp);
                $permission = $ex[0];
                $role       = $ex[1];

                $actRole    = Role::find($role);

                $actPermission = Permission::find($permission);

                $actRole->attachPermission($actPermission);
            }
        }

        $message = ["success" => "Berhasil mengubah role permission"];
        Session::flash("message", $message);

        return redirect("admin/permission");
    }

    public function export_excel(){
        $excel = App::make('excel');

        Excel::create('Roles', function($excel) {

            $excel->sheet('1', function($sheet) {
                $role     = Role::all();
                $sheet->loadView('Admin.roleexcel')->with("roles", $role);
            });

        })->download('xls');
    }

    public function user_export_excel(){
        $excel = App::make('excel');

        Excel::create('Users', function($excel) {

            $excel->sheet('1', function($sheet) {
                $users     = User::with("s_cabang")->get();
                $sheet->loadView('Admin.userexcel')->with("users", $users);
            });

        })->download('xls');
    }

    public function permission_export_excel(){
        $excel = App::make('excel');

        Excel::create('Permissions', function($excel) {

            $excel->sheet('1', function($sheet) {
                $permissions     = Permission::all();
                $sheet->loadView('Admin.permissionexcel')->with("permissions", $permissions);
            });

        })->download('xls');
    }

}