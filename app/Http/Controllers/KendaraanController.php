<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Session;
use Response;
use Auth;

use App\User;
use App\Kendaraan;
use App\AntrianKendaraan;
use App\Cabang;
use App\LansirDetail;
use App\Lansir;
use App\Penjualan;
use App\MuatDetail;


use App;
use Excel;

use Faker;


class KendaraanController extends Controller
{
    //
      public function index(){

    	      return view("Kendaraan.index");
      }


      public function antrian_kendaraan(){
          $kendaraan = Kendaraan::with("s_cabang");
            if(Auth::user()->hasRole("admin")){
		          $kendaraan = $kendaraan->get();     
            }
            else{
              $kendaraan = $kendaraan->where("cabang", "=", Auth::user()->cabang)->get();
            }

            $supir     = [];
            $kernet    = [];

            if(Auth::user()->hasRole("admin")){
              $user      = User::all();
            }
            else{
              $user      = User::where("cabang","=", Auth::user()->cabang)->get();
            }

            foreach($user as $us){
                  if($us->hasRole("supir")){
                        $supir[]    = $us;
                  }

                  if($us->hasRole("kernet")){
                        $kernet[]   = $us;
                  }
            }


    	      return view("Kendaraan.antrian_kendaraan")->with(["kendaraan" => $kendaraan, "supir" => $supir, "kernet" => $kernet]);
      }
      public function addantrian(){
            $kendaraan  = Request::input("kendaraan");            
            $supir      = Request::input("supir");            
            $kernet     = Request::input("kernet");  

            $antrian    = new AntrianKendaraan();
            $antrian->kendaraan     = $kendaraan;
            $antrian->supir         = $supir;
            $antrian->kernet        = $kernet;

            $antrian->save();

            $message    = ["success" => "Berhasil menambahkan antrian kendaraan"];

            Session::flash("message", $message);

            return redirect("kendaraan/antrian_kendaraan");       
      }

      public function antrian_orgdata(){
            $key        = Request::input("key");
            $hal        = Request::input("hal");
            $orderby    = Request::input("orderby");
            $ascdsc     = Request::input("ascdsc");
            $limit      = Request::input("limit");

            $p = $hal - 1;
            $pl = $limit;
            $p = $p * $pl;

            $antrian  = AntrianKendaraan::with("s_kendaraan", "s_supir", "s_kernet", "s_lansir");
            if($key != ""){
                  $exkey      = explode(";", $key);
                  if(count($exkey) > 1){
                        foreach($exkey as $i => $k){
                              $antrian->where("id","LIKE","%$k%");

                              $data_kendaraan   = Kendaraan::where("nama_kendaraan","LIKE", "%$k%")->get();
                              foreach($data_kendaraan as $dk){
                                    $antrian->orWhere("kendaraan","=",$dk->id);
                              }

                              $data_supir       = User::where("name", "LIKE", "%$k%")->get();
                              foreach($data_supir as $ds){
                                    $antrian->orWhere("supir", "=", $ds->id);
                              }

                              $data_kernet      = User::where("name", "LIKE", "%$k%")->get();

                              foreach($data_kernet as $dk){
                                    $antrian->orWhere("kernet", "=", $dk->id);
                              }
                        }
                  }
                  else{
                        $antrian->where("id","LIKE","%$key%");

                        $data_kendaraan   = Kendaraan::where("nama_kendaraan","LIKE", "%$key%")->get();
                        foreach($data_kendaraan as $dk){
                              $antrian->orWhere("kendaraan","=",$dk->id);
                        }

                        $data_supir       = User::where("name", "LIKE", "%$key%")->get();
                        foreach($data_supir as $ds){
                              $antrian->orWhere("supir", "=", $ds->id);
                        }

                        $data_kernet      = User::where("name", "LIKE", "%$key%")->get();

                        foreach($data_kernet as $dk){
                              $antrian->orWhere("kernet", "=", $dk->id);
                        }
                  }

            }

            if(!Auth::user()->hasRole("admin")){
              $in_temp = [];
              foreach($antrian->get() as $a){
                if($a->s_kendaraan->cabang == Auth::user()->cabang){
                  $in_temp[] = $a->id;
                }
              }
              $antrian->whereIn("id", $in_temp);
            }

            $count      = $antrian->count();

            if($orderby != ""){
                  $antrian->orderBy($orderby, $ascdsc);
            }

            $fordata  = $antrian->take($pl)->skip($p)->get();
            foreach($fordata as $fd){
              $check_lansir   = Lansir::where("antrian_kendaraan","=",$fd->id)->count();
              if($check_lansir > 0){
                $fd->hasMuat = 1;
              }
              else{
                $fd->hasMuat = 0;
              }
            }


            // dd($key,$antrian->take($pl)->skip($p)->get());

            $data       = [
                  "success" => 1,
                  "data" => $fordata,
                  "count" => $count
            ];

            return Response::json($data);
      }

      public function add(){
      	$no_polisi 	     = Request::input("no_polisi");
      	$nama_kendaraan  = Request::input("nm_kendaraan");
      	$grup  	     = Request::input("grup");
      	$cabang 	     = Request::input("cabang");

      	$kendaraan 		= new Kendaraan();
      	$kendaraan->no_polisi 		= $no_polisi;
      	$kendaraan->nama_kendaraan 	= $nama_kendaraan;
      	$kendaraan->grup 			= $grup;
      	$kendaraan->cabang 		= $cabang;

      	$kendaraan->save();

      	$message 	= ["success" => "Berhasil menambahkan kendaraan"];
      	Session::flash("message", $message);

      	return redirect("kendaraan");
      }

      public function edit($id){

      	$kendaraan 	= Kendaraan::with("s_cabang")->where("id","=",$id)->first();

      	return view("Kendaraan.edit")->with(["kendaraan" => $kendaraan]);
      }
      public function actedit($id){
      	$no_polisi 	 	= Request::input("no_polisi");
      	$nama_kendaraan = Request::input("nm_kendaraan");
      	$grup  			= Request::input("grup");
      	$cabang 		= Request::input("cabang");


	  	$kendaraan 	= Kendaraan::find($id);
	  	$kendaraan->no_polisi 		= $no_polisi;
	  	$kendaraan->nama_kendaraan 	= $nama_kendaraan;
	  	$kendaraan->grup 			= $grup;
	  	$kendaraan->cabang 			= $cabang;

		$kendaraan->save();

		$message = ["info" => "Berhasil mengubah data kendaraan !"];
      	Session::flash("message", $message);

      	return redirect("kendaraan");
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

            $cabang     =  Cabang::where("nama_cabang","LIKE","%$key%")->get();

            $kendaraan  = Kendaraan::with("s_cabang");
            if($key != ""){
                  $exkey      = explode(";", $key);
                  if(count($exkey) > 1){
                        foreach($exkey as $i => $k){
                              $kendaraan->where("no_polisi","LIKE","%$k%");
                              $kendaraan->orWhere("nama_kendaraan","LIKE","%$k%");
                              $kendaraan->orWhere("grup","LIKE","%$k%");
                              $kendaraan->orWhere("no_polisi","LIKE","%$k%");
                        }
                  }
                  else{
                        $kendaraan->where("no_polisi","LIKE","%$key%");
                        $kendaraan->orWhere("nama_kendaraan","LIKE","%$key%");
                        $kendaraan->orWhere("grup","LIKE","%$key%");
                        $kendaraan->orWhere("no_polisi","LIKE","%$key%");
                  }

                  foreach($cabang as $c){
                        $kendaraan->orWhere("cabang","=",$c->id);
                  }
            }

            if(!Auth::user()->hasRole("admin")){
              $kendaraan->where("cabang","=",Auth::user()->cabang);
            }
            $count      = $kendaraan->count();
            if($orderby != ""){
                  $kendaraan->orderBy($orderby, $ascdsc);
            }


            // dd($key,$kendaraan->take($pl)->skip($p)->get());

            $data       = [
                  "success" => 1,
                  "data" => $kendaraan->take($pl)->skip($p)->get(),
                  "count" => $count
            ];

            return Response::json($data);
      }


      public function antrian_add_muat($id){
            $antrian  = AntrianKendaraan::with("s_kendaraan","s_supir","s_kernet")->find($id);

            $tempNotIn     = [];
            $mdetail     = LansirDetail::all();
            foreach($mdetail as $md){
                  $tempNotIn[] = $md->stt;
            }

            $tempIn       = [];
            $mMuat       = MuatDetail::where("status","=",1)->get();
            foreach($mMuat as $mm){
                  $tempIn[] = $mm->stt;
            }



            $stt      = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang")->whereIn("stt", $tempIn)->whereNotIn("stt", $tempNotIn)->whereNotNull("user")->get();

            return view("Kendaraan.antrian_kendaraan_muat")->with(["antrian" => $antrian, "penjualan" => $stt]);
      }

      public function generatekodelansir($cabang){
        $data_cabang    = Cabang::find($cabang);
        $kd_cabang      = $data_cabang->kode_cabang;

        $lansir_before    = Lansir::with("s_antrian_kendaraan");

        if($lansir_before->count() > 0){
          $lansir_temp  = [];
          $lansir_get   = $lansir_before->orderBy("id", "DESC")->get();

          foreach($lansir_get as $lg){
            if($lg->s_antrian_kendaraan->s_kendaraan->cabang == $cabang){
              $lansir_temp[] = $lg;
              // break;
            }
          }

          $kdcabang_and_act_length  = strlen($kd_cabang) + 1;
          $lansir_fix     = $lansir_temp[0];
          $kd_lansir_before   = $lansir_fix->kode_lansir;

          $nomer_urutan    = intval(substr($kd_lansir_before, $kdcabang_and_act_length));
          $new_urutan    = $nomer_urutan + 1;

          $forloop  = 4 - $new_urutan;
          $kd_temp  = "";

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
          $new_kd_lansir  = $kd_cabang."C"."0000";
        }

        return $new_kd_lansir;
      }

      public function exec_antrian_add_muat($id){
            $stt              = Request::input("stt");
            $waktu_berangkat  = Request::input("waktu_berangkat");

            $data_antrian     = AntrianKendaraan::with("s_kendaraan")->find($id);
            $id_antrian     = $data_antrian->id;
            $cabang   = $data_antrian->s_kendaraan->cabang;


            $kode_lansir  = self::generatekodelansir($cabang);


            $lansir             = new Lansir();

            $lansir->antrian_kendaraan    = $id;
            $lansir->berangkat            = $waktu_berangkat;
            $lansir->checker              = Auth::user()->id;
            $lansir->kode_lansir          = $kode_lansir;

            $lansir->save();

            $last_muat    = Lansir::orderBy("id", "DESC")->first();
            $idm       = $last_muat->id;
            foreach($stt as $s){
                    $lansirdetail           = new LansirDetail();
                    $lansirdetail->stt      = $s;
                    $lansirdetail->lansir   = $idm;
                    $lansirdetail->status   = 0;
                    $lansirdetail->save();
            }

            $message  = ["success" => "Berhasil menambahkan muat"];
            Session::flash("message", $message);
            return redirect("/kendaraan/antrian_kendaraan");
      }

      public function export_excel(){
          $excel = App::make('excel');
          Excel::create('Kendaraan', function($excel) {

              $excel->sheet('1', function($sheet) {
                  $kendaraan     = Kendaraan::with("s_cabang")->get();
                  $sheet->loadView('Kendaraan.excel')->with("kendaraan", $kendaraan);
              });

          })->download('xls');
      }

      public function antrian_export_excel(){
          $excel = App::make('excel');
          Excel::create('Antrian Kendaraan', function($excel) {

              $excel->sheet('1', function($sheet) {
                  $antrian     = AntrianKendaraan::with("s_kendaraan", "s_supir", "s_kernet")->get();
                  $sheet->loadView('Kendaraan.antrianexcel')->with("antrian", $antrian);
              });

          })->download('xls');
      }
}
