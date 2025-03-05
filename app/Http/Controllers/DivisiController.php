<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use App\Divisi;
use Session;
use Response;


use App;
use Excel;


class DivisiController extends Controller
{
    public function index(){
    	$divisi = Divisi::all();

    	return view("Divisi.index")->with("divisi", $divisi);
    }

    public function add(){
    	$name 	= Request::input("name");

    	$divisi 	= new Divisi();
    	$divisi->nama_divisi = $name;

    	$divisi->save();

    	$message = ["success" => "Berhasil menambahkan divisi"];
    	Session::flash("message", $message);

    	return redirect("divisi");
    }

    public function getDivisiById($id){
    	$divisi 	= Divisi::find($id);

    	$data 	= [
    		"success" => 1,
    		"data" => $divisi
    	];

    	return Response::json($data);
    }

    public function edit($id){
    	$name 	= Request::input("name");

    	$divisi 	= Divisi::find($id);
    	$divisi->nama_divisi = $name;

    	$divisi->save();

    	$message = ["success" => "Berhasil mengubah divisi"];
    	Session::flash("message", $message);

    	return redirect("divisi");
    }

    public function export_excel(){
        $excel = App::make('excel');
        Excel::create('Divisi', function($excel) {

            $excel->sheet('1', function($sheet) {
                $divisi     = Divisi::all();
                $sheet->loadView('Divisi.excel')->with("divisi", $divisi);
            });

        })->download('xls');
    }
}
