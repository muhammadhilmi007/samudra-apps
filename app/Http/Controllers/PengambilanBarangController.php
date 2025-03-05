<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use App\Cabang;
use App\ReqPengambilanBarang as Req;
use App\PengambilanBarang;
use App\Penjualan;
use App\User;
use App\Kendaraan;

use Auth;
use Session;


class PengambilanBarangController extends Controller
{
    
	public function index(){
		$cabang 	= Cabang::all();
		$req 		= Req::where("status", "=", "new");
		$penjualan	= Penjualan::whereNull("user")->get();
		$kendaraan 	= Kendaraan::all();
		$pbar 	 	= PengambilanBarang::with("s_kendaraan", "s_cabang");
		if(!Auth::user()->hasRole("admin")){
			$req->where("cabang","=",Auth::user()->cabang);
			$pbar->where("cabang","=",Auth::user()->cabang);
		}

		$stt 	= [];

		foreach($penjualan as $p){
			$stt[] = $p;
		}

		$user 	= User::all();

		foreach($user as $s){
			$s->roles = $s->roles;
		}

		return view("PengambilanBarang.index")->with([
			"cabang" => $cabang, 
			"req" => $req->get(), 
			"stt" => $stt,
			"kendaraan" => $kendaraan,
			"pbar" => $pbar->get()
		]);
	}

	public function generate_kode_pengambilan($cabang){
		$data_cabang 	= Cabang::find($cabang);
		$kode_cabang 	= $data_cabang->kode_cabang;

		$pengambilan_before  = PengambilanBarang::where("cabang", "=", $cabang);

		if($pengambilan_before->count() > 0){
			$pengambilan_get 	= $pengambilan_before->orderBy("id","DESC")->first();
			$kode_before 		= $pengambilan_get->kode_pengambilan;

			$start_sub 	= strlen($kode_cabang) + 1;
			$urutan 	= intval(substr($kode_before, $start_sub));
			$new_urutan 	= $urutan + 1;
			$new_urutan_length = strlen($new_urutan."");

			$forloop = 4 - $new_urutan_length;

			if($forloop > 0){
				$kd_temp	 = "";
				for($a = 1; $a <= $forloop; $a++){
					$kd_temp .= "0";
				}
				$new_kode_pengambilan = $kode_cabang."A".$kd_temp."".$new_urutan;
			}
			else{
				$new_kode_pengambilan = $kode_cabang."A".$new_urutan;
			}

		}
		else{
			$new_kode_pengambilan 	= $kode_cabang."A"."0001";
		}
		return $new_kode_pengambilan;
	}

	public function add(){
		$no_pengambilan 	= Request::input("no_pengambilan");
		$pengirim 			= Request::input("pengirim");
		$stt 				= Request::input("stt");
		$kendaraan 			= Request::input("kendaraan");
		$waktu_berangkat 	= Request::input("waktu_berangkat");
		$waktu_pulang 		= Request::input("waktu_pulang");
		if(Auth::user()->hasRole("admin")){
			$cabang 			= Request::input("cabang");
		}
		else{
			$cabang 		= Auth::user()->cabang;
		}
		$tanggal 			= Request::input("tanggal");

		$pbar 	= new PengambilanBarang();

		if(count($stt) > 0){
			$stt 	= implode("-", $stt);
		}
		else{
			$stt 	= $stt[0];
		}


		$pbar->no_pengambilan 	= $no_pengambilan;
		$pbar->pengirim  		= $pengirim;
		$pbar->stt  			= $stt;
		$pbar->kendaraan 		= $kendaraan;
		$pbar->waktu_berangkat 	= $waktu_berangkat;
		$pbar->waktu_pulang 	= $waktu_pulang;
		$pbar->tanggal 			= $tanggal;
		$pbar->cabang 			= $cabang;
		$pbar->kode_pengambilan = self::generate_kode_pengambilan($cabang);
		$pbar->user 			= Auth::user()->id;

		$pbar->save();

		$message 	= ["success" => "Berhasil menambahkan pengambilan barang"];
		Session::flash("message", $message);

		return redirect("/pengambilan_barang");
	}

}
