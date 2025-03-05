<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Response;
use Session;


use App;
use App\Cabang;
use App\Divisi;
use Excel;

class CabangController extends Controller
{
    public function index(){
    	$cabang 	= Cabang::with("s_divisi")->get();
    	$divisi 	= Divisi::all();

    	return view("Cabang.index")->with(["cabang" => $cabang, "divisi" => $divisi]);
    }

    public function add(){
    	$name 	= Request::input("name");
        $kode   = Request::input("kode");
        $divisi = Request::input("divisi");
        $latitude = Request::input("latitude");
    	$longitude = Request::input("longitude");
        

        if(!empty(Request::input("pusat"))){
            $pusat = $divisi;
        }
        else{
            $pusat = 0;
        }

    	$cabang 	= new Cabang();
        $cabang->kode_cabang    = $kode;
    	$cabang->nama_cabang 	= $name;
        $cabang->divisi         = $divisi;
        $cabang->lat_coord      = $latitude;
    	$cabang->long_coord		= $longitude;
    	$cabang->utama 			= $pusat;
    	$cabang->save();

    	$message 	= ["success" => "Berhasil menambahkan cabang"];
    	Session::flash("message", $message);

    	return redirect("/cabang");
    }

    public function getCabangById($id){
    	$cabang 	= Cabang::with("s_divisi")->find($id);

    	$data	 = [
    		"success" => 1,
    		"data" => $cabang
    	];

    	return Response::json($data);
    }

    public function edit($id){
    	$name 		= Request::input("name");
        $kode       = Request::input("kode");
        $divisi     = Request::input("divisi");
        $latitude     = Request::input("latitude2");
    	$longitude 	= Request::input("longitude2");

        if(!empty(Request::input("pusat"))){
            $pusat = $divisi;
        }
        else{
            $pusat = 0;
        }

    	$cabang 	= Cabang::find($id);
        $cabang->kode_cabang = $kode;
    	$cabang->nama_cabang = $name;
        $cabang->lat_coord   = $latitude;
    	$cabang->long_coord	 = $longitude;
        $cabang->utama       = $pusat;

    	$cabang->save();

    	$message 	= ["success" => "Berhasil mengubah cabang"];
    	Session::flash("message", $message);

    	return redirect("/cabang");

    }

    public function export_excel(){
	set_time_limit(0);
	ini_set('memory_limit', '1G');
        $excel = App::make('excel');
        Excel::create('Cabang', function($excel) {

            $excel->sheet('1', function($sheet) {
                $cabang     = Cabang::with("s_divisi")->get();
                $sheet->loadView('Cabang.excel')->with("cabang", $cabang);
            });

        })->download('xls');
    }
}
