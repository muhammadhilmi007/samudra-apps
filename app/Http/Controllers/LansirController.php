<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;


use App\AntrianKendaraan;
use App\LansirDetail;
use App\Lansir;
use App\Penjualan;
use App\MuatDetail;
use App\Cabang;

use Request;
use Response;
use Session;
use Auth;

use App;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;


class LansirController extends Controller
{
    
	public function index(){
		$tempNotInKendaraan		= [];
		$lansir 		= Lansir::all();

		foreach($lansir as $l){
			$tempNotInKendaraan[] = $l->antrian_kendaraan;
		}

		$antrian 		= AntrianKendaraan::with("s_kendaraan")->whereNotIn("id", $tempNotInKendaraan)->get();

		$temp 			= [];
		$lansirdetail 	= LansirDetail::where("status", "!=", 0)->get();


		foreach($lansirdetail as $ld){
			$temp[] = $ld["stt"];
		}


		$tempMuat 	= [];
		$muatDetail 	= MuatDetail::where("status","=",1)->get();

		foreach($muatDetail as $md){
			$tempMuat[] 	= $md->stt;
		}


		$penjualan 	= Penjualan::with("s_kantor_asal","s_kantor_tujuan")->whereNotNull("user")->whereNotIn("stt", $temp)->whereIn("stt", $tempMuat)->get();

		return view("Lansir.index")->with(["antrian_kendaraan" => $antrian, "penjualan" => $penjualan]);
	}

	public function generatekodelansir($cabang){
		$data_cabang 		= Cabang::find($cabang);
		$kd_cabang 			= $data_cabang->kode_cabang;

		$lansir_before 		= Lansir::with("s_antrian_kendaraan");

		if($lansir_before->count() > 0){
			$lansir_temp 	= [];
			$lansir_get 	= $lansir_before->orderBy("id", "DESC")->get();

			foreach($lansir_get as $lg){
				if($lg->s_antrian_kendaraan->s_kendaraan->cabang == $cabang){
					$lansir_temp[] = $lg;
					// break;
				}
			}

			$kdcabang_and_act_length 	= strlen($kd_cabang) + 1;
			$lansir_fix 		= $lansir_temp[0];
			$kd_lansir_before 	= $lansir_fix->kode_lansir;

			$nomer_urutan 	 = intval(substr($kd_lansir_before, $kdcabang_and_act_length));
			$new_urutan 	 = $nomer_urutan + 1;

			$forloop 	= 4 - strlen($new_urutan."");
			$kd_temp 	= "";

			if($forloop > 0){
				for($a = 1; $a<=$forloop; $a++){
					$kd_temp .= "0";
				}
				$new_kd_lansir = $kd_cabang."C".$kd_temp."".$new_urutan;
			}
			else{
				$new_kd_lansir = $kd_cabang."C".$new_urutan;
			}	

		}
		else{
			$new_kd_lansir 	= $kd_cabang."C"."0001";
		}

		return $new_kd_lansir;
	}

	public function add(){
		$antrian_kendaraan 	= Request::input("antrian_kendaraan");
		$stt 				= Request::input("stt");
		$waktu_berangkat	= Request::input("berangkat");

		$data_antrian 		= AntrianKendaraan::with("s_kendaraan")->find($antrian_kendaraan);
		$id_antrian 		= $data_antrian->id;
		$cabang 	= $data_antrian->s_kendaraan->cabang;


		$kode_lansir 	= self::generatekodelansir($cabang);

		$lansir 			= new Lansir();

		$lansir->antrian_kendaraan= $antrian_kendaraan;
		$lansir->berangkat 		= $waktu_berangkat;
		$lansir->checker 			= Auth::user()->id;
		$lansir->kode_lansir		= $kode_lansir;

		$lansir->save();

		$last_lansir 	= Lansir::orderBy("id", "DESC")->first();
		$id 			= $last_lansir->id;

		foreach($stt as $s){
			$lansirdetail 			= new LansirDetail();
			$lansirdetail->stt 		= $s;
			$lansirdetail->lansir	= $id;
			$lansirdetail->status 	= 0;
			$lansirdetail->save();
		}

		$message 	= ["success" => "Berhasil menambahkan lansir"];
		Session::flash("message", $message);

		return redirect("lansir");
	}


	public function orgdata(){
	      $key        = Request::input("key");
	      $hal        = Request::input("hal");
	      $orderby    = Request::input("orderby");
	      $ascdsc     = Request::input("ascdsc");
	      $limit      = Request::input("limit");

	      $p = $hal - 1;
	      $pl = $limit;
	      $p = $p * $pl;



	      $lansir  = Lansir::with("s_antrian_kendaraan");
	      if($key != ""){
	            $exkey      = explode(";", $key);
	            if(count($exkey) > 1){
	                  foreach($exkey as $i => $k){
	                        $lansir->where("antrian_kendaraan","LIKE","%$k%");
	                        $lansir->orWhere("berangkat","LIKE","%$k%");
	                        $lansir->orWhere("sampai","LIKE","%$k%");
	                  }
	            }
	            else{
	                  $lansir->where("antrian_kendaraan","LIKE","%$key%");
	                  $lansir->orWhere("berangkat","LIKE","%$key%");
	                  $lansir->orWhere("sampai","LIKE","%$key%");
	            }
	      }

	      $count      = $lansir->count();

	      if($orderby != ""){
	            $lansir->orderBy($orderby, $ascdsc);
	      }


	      // dd($key,$lansir->take($pl)->skip($p)->get());

	      $data       = [
	            "success" => 1,
	            "data" => $lansir->take($pl)->skip($p)->get(),
	            "count" => $count
	      ];

	      return Response::json($data);
	}

	public function detail($id){
		$lansir 		= Lansir::with("s_antrian_kendaraan", "s_stt", "s_checker")->find($id);
		$status 	= 1;
		$lansirdetail = LansirDetail::where("lansir","=",$id)->get();

		foreach($lansirdetail as $ld){
			if($ld->status == 0){
				$status = 0;
			}
		}

		return view("Lansir.detail")->with(["lansir" => $lansir, "status" => $status]);
	}

	public function setstatstt($id, $stt){
		$lansirdetail = LansirDetail::where("lansir","=","$id")->where("stt","=",$stt)->first();

		$status 	= Request::input("status");


		$md 		= LansirDetail::find($lansirdetail->id);
		$md->status = $status;
		if($status == "2"){
			$md->keterangan = Request::input("keterangan");
		}
		else if($status == "1"){
			$md->nama_penerima = Request::input("nama_penerima");
		}
		$md->save();

		$message 	= ["success" => "Berhasil mengubah status stt lansir"];
		Session::flash("message", $message);

		return \Redirect::back();
	}

	public function setsampai($id){
    	$muat 			= Lansir::find($id);
    	$muat->sampai  	= Request::input("sampai");
    	$muat->save();

    	$message = ["info" => "Berhasil menyimpan dan mengupdate data lansir"];
    	Session::flash("message", $message);

    	return redirect("lansir");
    }

    public function export_excel(){
    	$excel = App::make('excel');

    	Excel::create('Lansir', function($excel) {

    	    $excel->sheet('1', function($sheet) {
    	        $data   = Lansir::with("s_antrian_kendaraan","s_checker");

    	        if(Auth::user()->hasRole("admin")){
    	          $lansir   = $data->get();
    	        }
    	        else{
    	          $lansir 	= [];

    	          foreach($data->get() as $d){
    	          	$cabang 	= $d->s_antrian_kendaraan->s_kendaraan->cabang;

    	          	if($cabang == Auth::user()->cabang){
    	          		$lansir[] = $d;
    	          	}
    	          }
    	        }

    	        $sheet->loadView('Lansir.excel')->with("lansir", $lansir);
    	    }); 

    	    $excel->sheet('2', function($sheet){
    	        $detail   = LansirDetail::with("s_penjualan","s_lansir");

    	        if(Auth::user()->hasRole("admin")){
    	          $lansirdetail = $detail->get();
    	        }
    	        else{
    	          $lansirdetail = [];

    	          foreach($detail as $d){
    	            if($d->s_lansir->s_antrian_kendaraan->s_kendaraan->cabang == Auth::user()->cabang){
    	              $muatdetail[] = $d;
    	            }
    	          }

    	        }

    	        $sheet->loadView('Lansir.excel2')->with('lansirdetail', $lansirdetail);
    	    });

    	})->download('xls');
    }

    public function print_detail($id){
    	$data_lansir 	= Lansir::with("s_antrian_kendaraan","s_checker","s_stt")->find($id);
    	$detail_lansir 	= LansirDetail::with("s_penjualan","s_lansir")->where("lansir","=",$id)->get();

    	$pdf = PDF::loadView('Lansir.print', ["data_lansir" => $data_lansir, "lansir_detail" => $detail_lansir])->setPaper('a4', 'landscape');

    	return $pdf->stream();
    }
}
