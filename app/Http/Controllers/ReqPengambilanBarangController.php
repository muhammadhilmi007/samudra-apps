<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Auth;
use Session;

use App\ReqPengambilanBarang as Req;
use App\Cabang;

class ReqPengambilanBarangController extends Controller
{
    public function request(){

    	$cabang  	= Cabang::all();
    	$req 		= Req::with("s_cabang"); 
    	if(Auth::user()->hasRole("admin")){
    		$req = $req->get();
    	}
    	else{
    		$req = $req->where("cabang", "=", Auth::user()->cabang)->get();
    	}

    	return view("PengambilanBarang.request")->with(["cabang" => $cabang, "req" => $req]);
    }

    public function actrequest(){
    	$pengirim 			= Request::input("pengirim");
    	$penerima 			= Request::input("penerima");
    	$alamat_pengambilan = Request::input("alamat_pengambilan");
    	$tujuan 			= Request::input("tujuan");
    	$jumlah_colly 		= Request::input("jumlah_colly");
    	$tanggal 			= Request::input("tanggal");


    	if(Auth::user()->hasRole("admin")){
    		$cabang 	= Request::input("cabang");
    	}
    	else{
    		$cabang 	= Auth::user()->cabang;
    	}

    	$req  = new Req();
    	$req->pengirim				= $pengirim;
    	$req->penerima				= $penerima;
    	$req->alamat_pengambilan	= $alamat_pengambilan;
    	$req->tujuan 				= $tujuan;
    	$req->jumlah_colly 			= $jumlah_colly;
    	$req->cabang 				= $cabang;
    	$req->tanggal 				= $tanggal;
    	$req->status 				= "new";
    	$req->user 					= Auth::user()->id;

    	$req->save();
    	
    	$message 	= ["success" => "Berhasil menambahkan request pengambilan barang"];
    	Session::flash("message", $message);

    	return redirect("/req_pengambilan_barang");

    }

    public function setdone($id){
    	$req 	= Req::find($id);
    	$req->status = "done";


    	$req->save();

    	$message = ["success" => "Berhasil update status request pengambilan barang"];
    	Session::flash("message", $message);

    	return redirect("/req_pengambilan_barang");
    }
}
