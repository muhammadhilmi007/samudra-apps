<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Response;
use Auth;
use Session;
use Redirect;


use App\Penjualan;
use App\Cabang;
use App\LansirDetail;
use App\MuatDetail;
use App\Retur;
use App\Overdue;
use App\OverdueDetail;

use App;
use Barryvdh\DomPDF\Facade as PDF;

class ReturController extends Controller
{
    
	public function index(){
		return view("Retur.index");
	}


	public function kirim(){
		$penjualan 	= Penjualan::with("s_kantor_asal","s_kantor_tujuan","s_user","s_cabang");

		$returTemp  = [];
		$retur 		= Retur::whereNotNull("tanggal_kirim")->get();


		foreach($retur as $r){
			$returTemp[] = $r["stt"];
		}

		if(Auth::user()->hasRole("admin")){
			$penjualan = $penjualan->whereNotIn("stt", $returTemp)->get();
		}
		else{
			$penjualan = $penjualan->where("kantor_asal","=",Auth::user()->cabang)->whereNotIn("stt", $returTemp)->get();
		}

		$data_retur 	= Retur::with("s_cabang");

		if(Auth::user()->hasRole("admin")){
			$data_retur = $data_retur->get();
		}
		else{
			$data_retur = $data_retur->where("cabang","=",Auth::user()->cabang)->get();
		}


		return view("Retur.kirim")->with(["penjualan" => $penjualan, "retur" => $data_retur]);
	}

	public function generate_koderetur($cabang){
		$data_cabang	 	= Cabang::find($cabang);
		$kode_cabang 		= $data_cabang->kode_cabang;
		$id_cabang 			= $data_cabang->id;
		$data_retur  		= Retur::where("cabang","=",$id_cabang);

		if($data_retur->count() > 0){
			$retur_get 	= $data_retur->orderBy("id", "DESC")->first();
			$kode_retur = $retur_get->kode_retur;

			$forsub 	= strlen($kode_cabang)+1;

			$urutan_before 	= intval(substr($kode_retur, $forsub));
			$new_urutan 	= $urutan_before + 1;

			$new_urutan_length 	= strlen($new_urutan."");

			$forloop = 4 - $new_urutan_length;

			if($forloop > 0){
				$kd_temp = "";
				for($a = 1; $a <= $forloop; $a++){
					$kd_temp .= "0";
				}
				$new_koderetur 	= $kode_cabang."D".$kd_temp."".$new_urutan;
			}
			else{
				$new_koderetur 	= $kode_cabang."D".$new_urutan;
			}
		}
		else{
			$new_koderetur = $kode_cabang."D"."0001";
		}

		return $new_koderetur;
	}

	public function actkirim(){
		$stt 			= Request::input("stt");
		$tanggal_kirim 	= Request::input("tanggal_kirim");
		$cabang 		= Request::input("cabang");



		if(count($stt) > 1){
			$stt 	= implode("-", $stt);
		}
		else{
			$stt  	= $stt[0];
		}

		$stt 	= explode("-", $stt);
		foreach($stt as $s){
			$kode_retur 	= self::generate_koderetur($cabang);


			$retur 					= new Retur();
			$retur->stt 			= $s;
			$retur->tanggal_kirim	= $tanggal_kirim;
			$retur->cabang 			= $cabang;
			$retur->kode_retur 		= $kode_retur;

			$retur->save();
			
		}

		if(!empty(Request::input("payment_type"))){
			$payment_type = Request::input("payment_type");
			$penjualan 	= Penjualan::where("stt","=",$stt)->first();

			$penjualan  				= Penjualan::find($penjualan["id"]);
			$penjualan->payment_type 	= $payment_type;
			$penjualan->save();

			if($payment_type == "CASH"){
				$overdue 		= Overdue::where("stt","=",$stt)->first();
				$overdue 		= Overdue::find($overdue["id"]);

				$nominal 		= $overdue->nominal;

				$overdueDetail  = new OverdueDetail();
				$overdueDetail->stt = $stt;
				$overdueDetail->tanggal = $tanggal_kirim;
				$overdueDetail->besar_nominal = $nominal;

				$overdueDetail->save();

				$overdue->nominal = 0;
				$overdue->save();
			}
		}

		$message = ["success" => "Berhasil menyimpan data retur kirim"];

		Session::flash("message", $message);

		return Redirect::back();
	}


	public function terima(){
		$penjualan 	= Penjualan::with("s_kantor_asal","s_kantor_tujuan","s_user","s_cabang");

		$returTemp  = [];
		$retur 		= Retur::whereNotNull("tanggal_terima")->get();

		
		$returTemp2 = [];
		$returall 	= Retur::all();

		foreach($returall as $r){
			$returTemp2[] = $r["stt"];
		}


		foreach($retur as $r){
			$returTemp[] = $r["stt"];
		}

		if(Auth::user()->hasRole("admin")){
			$penjualan = $penjualan->whereNotIn("stt", $returTemp)->whereIn("stt", $returTemp2)->get();
		}
		else{
			$penjualan = $penjualan->where("kantor_tujuan","=",Auth::user()->cabang)->whereIn("stt", $returTemp2)->whereNotIn("stt", $returTemp)->get();
		}

		$data_retur 	= Retur::whereNotNull("tanggal_terima")->get();
		$retur_temp 	= [];

		foreach($data_retur as $dr){
			if(Auth::user()->hasRole("admin")){
				$retur_temp[] = $dr;
			}
			$stt 		= $dr->stt;
			$penjualans	= Penjualan::where("stt","=",$stt)->first();
			if($penjualans->kantor_tujuan == Auth::user()->cabang){
				$retur_temp[] = $dr;
			} 
		}

		return view("Retur.terima")->with(["penjualan" => $penjualan, "retur" => $retur_temp]);
	}

	public function actterima(){
		$stt 			= Request::input("stt");
		$tanggal_terima 	= Request::input("tanggal_terima");

		foreach($stt as $s){
			$retur 					= Retur::where("stt","=",$s)->first();
			$retur 					= Retur::find($retur["id"]);
			$retur->tanggal_terima	= $tanggal_terima;

			$retur->save();
		}


		if(!empty(Request::input("payment_type"))){
			$payment_type = Request::input("payment_type");
			$penjualan 	= Penjualan::where("stt","=",$stt)->first();

			$penjualan  				= Penjualan::find($penjualan["id"]);
			$penjualan->payment_type 	= $payment_type;
			$penjualan->save();

			if($payment_type == "CASH"){
				$overdue 		= Overdue::where("stt","=",$stt)->first();
				$overdue 		= Overdue::find($overdue["id"]);

				$nominal 		= $overdue->nominal;

				$overdueDetail  = new OverdueDetail();
				$overdueDetail->stt = $stt;
				$overdueDetail->tanggal = $tanggal_terima;
				$overdueDetail->besar_nominal = $nominal;

				$overdueDetail->save();

				$overdue->nominal = 0;
				$overdue->save();
			}
		}

		$message = ["success" => "Berhasil menyimpan data retur terima"];

		Session::flash("message", $message);

		return Redirect::back();
	}


	public function orgdata(){
	      $key        = Request::input("key");
	      $hal        = Request::input("hal");
	      $orderby    = Request::input("orderby");
	      $ascdsc     = Request::input("ascdsc");
	      $limit      = Request::input("limit");
	      $cabang     = Request::input("cabang");

	      $p = $hal - 1;
	      $pl = $limit;
	      $p = $p * $pl;

	      $cabang     =  Cabang::find($cabang);;

	      $penjualan  = Penjualan::with("s_kantor_asal","s_kantor_tujuan","s_user","s_cabang","s_detail_muat","s_detail_lansir");
	      if($key != ""){
	            $exkey      = explode(";", $key);
	            if(count($exkey) > 1){
	                  foreach($exkey as $i => $k){
	                        $penjualan->where("stt","LIKE","%$k%");
	                        $penjualan->orWhere("pengirim","LIKE","%$k%");
	                        $penjualan->orWhere("penerima","LIKE","%$k%");
	                        $penjualan->orWhere("created_at","LIKE","%$k%");

	                        $kantor_asal    = Cabang::where("nama_cabang", "LIKE", "%$k%")->get();
	                        foreach($kantor_asal as $ka){
	                            $kaid   = $ka["id"];
	                            $penjualan->orWhere("kantor_asal","=",$kaid);
	                        }
	                        $kantor_tujuan  = Cabang::where("nama_cabang", "LIKE", "%$k%")->get();
	                        foreach($kantor_tujuan as $katuj){
	                            $katujid    = $katuj["id"];
	                            $penjualan->orWhere("kantor_tujuan","=",$katujid);
	                        }
	                  }
	            }
	            else{
	                $penjualan->where("stt","LIKE","%$key%");
	                $penjualan->orWhere("pengirim","LIKE","%$key%");
	                $penjualan->orWhere("penerima","LIKE","%$key%");
	                $penjualan->orWhere("created_at","LIKE","%$key%");

	                $kantor_asal    = Cabang::where("nama_cabang", "LIKE", "%$key%")->get();
	                foreach($kantor_asal as $ka){
	                    $kaid   = $ka["id"];
	                    $penjualan->orWhere("kantor_asal","=",$kaid);
	                }
	                $kantor_tujuan  = Cabang::where("nama_cabang", "LIKE", "%$key%")->get();
	                foreach($kantor_tujuan as $katuj){
	                    $katujid    = $katuj["id"];
	                    $penjualan->orWhere("kantor_tujuan","=",$katujid);
	                }
	            }

	            $penjualan->where("cabang","=",$cabang->id);
	      }

	      $lansir_temp 	= [];

	      $lansir 	= LansirDetail::all();
	      foreach($lansir as $l){
	      	$lansir_temp[] = $l->stt;
	      }

	      $penjualan->whereNotNull("user")->whereIn("stt", $lansir_temp);

	      $count      = $penjualan->count();

	      if($orderby != ""){
	            $penjualan->orderBy($orderby, $ascdsc);
	      }

	      // dd($key,$penjualan->take($pl)->skip($p)->get());

	      $data       = [
	            "success" => 1,
	            "data" => $penjualan->take($pl)->skip($p)->get(),
	            "count" => $count
	      ];

	      return Response::json($data);
	}

	public function print_retur(){
		$cabang 		= Auth::user()->cabang;
		$data_retur 	= Retur::with("s_cabang","s_penjualan")->where("cabang","=",$cabang)->get();

		$pdf = PDF::loadView('Retur.print', ["data_retur" => $data_retur])->setPaper('a4', 'landscape');

		return $pdf->stream();
	}
}
