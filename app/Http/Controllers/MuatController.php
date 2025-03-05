<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use App\AntrianTruck;
use App\Penjualan;
use App\Muat;
use App\MuatDetail;
use App\Transit;
use App\Cabang;

use Request;
use Auth;
use Session;
use Response;


use App;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;

class MuatController extends Controller
{
    public function index(){
    	$tempNotInAntrian = [];
    	$muat 		= Muat::with("s_cabang");

    	foreach($muat->get() as $m){
    		$tempNotInAntrian[] = $m->antrian_truck;
    	}

    	$antrian 	= AntrianTruck::whereNotIn("id", $tempNotInAntrian);
      if(!Auth::user()->hasRole("admin")){
        $antrian->where("cabang","=",Auth::user()->cabang);
      }


    	$stt 	= [];
    	$muatdetail 	= MuatDetail::all();
    	$temp 	= [];

    	foreach($muatdetail as $md){
    		$temp[] = $md["stt"];
    	}

    	$penjualan 	= Penjualan::with("s_kantor_asal","s_kantor_tujuan")->whereNotNull("user")->whereNotIn("stt", $temp)->get();


      $data_transit  = Transit::all();
      foreach($data_transit as $dt){
        $count_finish = 0;
        $transit  = $dt["transit"];
        $ex       = explode("-", $transit);
        foreach($ex as $i => $e){
          $trex = explode("_", $e);
          $kd_cabang = intval($trex[0]);
          $transit_status = intval($trex[1]);
          if($transit_status == 0){
            if(Auth::user()->hasRole("admin") || Auth::user()->cabang == $kd_cabang){
              $timpa  = true;
              $data_penjualan   = Penjualan::find($dt["penjualan"]);
              foreach($penjualan as $p){
                if($p["id"] == $dt["penjualan"]){
                  $timpa = false;
                }
              }

              if($timpa){
                $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
              }

              break;
            }
          }
          $count_finish++;
        }
        if($count_finish == count($ex)){
          $penjualan_data = Penjualan::find($dt["penjualan"]);
          $muat_transit   = MuatDetail::where("stt","=",$penjualan_data->stt)->get();

          $count_transit_muat   = count($muat_transit);

          $must   = count($ex) + 1;

          if($count_transit_muat < $must){
            $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
          }

        }
      }

    	return view("Muat.index")->with(["antrian_truck" => $antrian->get(), "penjualan" => $penjualan]);
    }

    public function generate_kode_muat($cabang){
      $data_cabang  = Cabang::find($cabang);
      $kd_cabang    = $data_cabang->kode_cabang;
      $muat_before  = Muat::where("cabang","=",$cabang);

      if($muat_before->count() > 0){
        $data_muat_before   = $muat_before->orderBy("id", "DESC")->first();
        $kode_muat_before   = $data_muat_before["kode_muat"];
        $strlen_kode  = strlen($kd_cabang) + 1;
        $hitungan   = intval(substr($kode_muat_before, $strlen_kode));


        $new_hitungan   = $hitungan + 1;

        $strlen_new_hitungan  = strlen($new_hitungan."");

        $forloop = 4 - $strlen_new_hitungan;
        $kd_temp   = "";
        if($forloop > 0){
          for($a = 1; $a <= $forloop; $a++){
            $kd_temp .= "0";
          }
          $new_kode_muat = $kd_cabang."B".$kd_temp."".$new_hitungan;
        }
        else{
          $new_kode_muat = $kd_cabang."B".$new_hitungan;
        }
      }
      else{
        $new_kode_muat  = $kd_cabang."B"."0001";
      }


      return $new_kode_muat;
    }

    public function add(){
    	$antrian_truck 	= Request::input("antrian_truck");
    	$stt 			= Request::input("stt");
    	$waktu_berangkat= Request::input("waktu_berangkat");
      $cabang     = Request::input("cabang");
      $cabang_tujuan     = Request::input("cabang_tujuan");

      // for generate muat code

    	$muat 			= new Muat();

    	$muat->antrian_truck	= $antrian_truck;
    	$muat->waktu_berangkat 	= $waktu_berangkat;
      $muat->checker      = Auth::user()->id;
      $muat->cabang       = $cabang;
      $muat->cabang_tujuan       = $cabang_tujuan;
      $muat->kode_muat      = self::generate_kode_muat($cabang);

    	$muat->save();

    	$last_muat 		= Muat::orderBy("id", "DESC")->first();
    	$id 			= $last_muat->id;

    	foreach($stt as $s){
        // cek stt transit ?
        $penjualan  = Penjualan::where("stt","=",$s)->first();
        $penjualan_id   = $penjualan["id"];

        $transit  = Transit::where("penjualan", "=", $penjualan_id);

        if($transit->count() > 0){
         $dt       = $transit->first();
         $transit  = $dt["transit"];
         $ex       = explode("-", $transit);
         foreach($ex as $i => $e){
           $trex = explode("_", $e);
           $kd_cabang = intval($trex[0]);
           $transit_status = intval($trex[1]);
           if($transit_status == 0){
             if(Auth::user()->hasRole("admin") || Auth::user()->cabang == $kd_cabang){
               // $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
                $ex[$i] = $kd_cabang."_2";

                $new_data                 = implode("-", $ex);
                $updated_transit          = Transit::find($dt["id"]);
                $updated_transit->transit = $new_data;
                $updated_transit->save();
               break;
             }
           }
         } 
        }
          


    		$muatdetail 			= new MuatDetail();
    		$muatdetail->stt 		= $s;
    		$muatdetail->id_muat	= $id;
    		$muatdetail->status 	= 0;
    		$muatdetail->save();
      }
    	

    	$message 	= ["success" => "Berhasil menambahkan muat"];
    	Session::flash("message", $message);

    	return redirect("muat");

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



          $muat  = Muat::with("s_antrian_truck");

          if(!Auth::user()->hasRole("admin")){
            $muat->where("cabang","=",Auth::user()->cabang);
          }

          if($key != ""){
                $exkey      = explode(";", $key);
                if(count($exkey) > 1){
                      foreach($exkey as $i => $k){
                            $muat->where("antrian_truck","LIKE","%$k%");
                            $muat->orWhere("waktu_berangkat","LIKE","%$k%");
                            $muat->orWhere("sampai","LIKE","%$k%");
                      }
                }
                else{
                      $muat->where("antrian_truck","LIKE","%$key%");
                      $muat->orWhere("waktu_berangkat","LIKE","%$key%");
                      $muat->orWhere("sampai","LIKE","%$key%");
                      
                }
          }

          $count      = $muat->count();

          if($orderby != ""){
                $muat->orderBy($orderby, $ascdsc);
          }


          // dd($key,$muat->take($pl)->skip($p)->get());

          $data       = [
                "success" => 1,
                "data" => $muat->take($pl)->skip($p)->get(),
                "count" => $count
          ];

          return Response::json($data);
    }

    public function detail($id){
    	$muat 		= Muat::with("s_antrian_truck", "s_stt", "s_checker")->find($id);
    	$status 	= 1;
    	$muatdetail = MuatDetail::where("id_muat","=",$id)->get();

    	foreach($muatdetail as $md){
    		if($md->status == 0){
    			$status = 0;
    		}
    	}

    	return view("Muat.detail")->with(["muat" => $muat, "status" => $status]);
    }

    public function setstatstt($id, $stt){
    	$muatdetail = MuatDetail::where("id_muat","=","$id")->where("stt","=",$stt)->first();

    	$status 	= Request::input("status");


    	$md 		= MuatDetail::find($muatdetail->id);
    	$md->status = $status;
    	if($status == "2"){
    		$md->keterangan = Request::input("keterangan");
    	}
      // cek stt transit ?
      $penjualan  = Penjualan::where("stt","=",$stt)->first();
      $penjualan_id   = $penjualan["id"];

      $transit  = Transit::where("penjualan", "=", $penjualan_id);

      if($transit->count() > 0){
       $dt       = $transit->first();
       $transit  = $dt["transit"];
       $ex       = explode("-", $transit);
       $count_temp = 0;
       foreach($ex as $i => $e){
         $trex = explode("_", $e);
         $kd_cabang = intval($trex[0]);
         $transit_status = intval($trex[1]);
         if($transit_status == 2){
           if(Auth::user()->hasRole("admin") || Auth::user()->cabang == $kd_cabang){
             // $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
              $ex[$i] = $kd_cabang."_".$status;

              $new_data                 = implode("-", $ex);
              $updated_transit          = Transit::find($dt["id"]);
              $updated_transit->transit = $new_data;
              $updated_transit->save();
             break;
           }
         }
         $count_temp++;
       }
         // if($count_temp == count($ex)){
         //  $md->save();
         // }
      }
      // else{
    	 // $md->save(); 
      // }

      $md->save();


    	$message 	= ["success" => "Berhasil mengubah status stt muat"];
    	Session::flash("message", $message);

    	return \Redirect::back();
    }

    public function setsampai($id){
    	$muat 			= Muat::find($id);
    	$muat->sampai  	= Request::input("sampai");
    	$muat->save();

    	$message = ["info" => "Berhasil menyimpan dan mengupdate data muat"];
    	Session::flash("message", $message);

    	return redirect("muat");
    }

    public function export_excel(){

      $excel = App::make('excel');

      Excel::create('Muat', function($excel) {

          $excel->sheet('1', function($sheet) {
              $data   = Muat::with("s_cabang", "s_checker");

              if(Auth::user()->hasRole("admin")){
                $muat   = $data->get();
              }
              else{
                $muat   = $data->where("cabang","=",Auth::user()->cabang)->get();
              }

              $sheet->loadView('Muat.excel')->with("muat", $muat);
          }); 

          $excel->sheet('2', function($sheet){
              $detail   = MuatDetail::with("s_muat");

              if(Auth::user()->hasRole("admin")){
                $muatdetail = $detail->get();
              }
              else{
                $muatdetail = [];

                foreach($detail as $d){
                  if($d->s_muat->cabang == Auth::user()->cabang){
                    $muatdetail[] = $d;
                  }
                }

              }

              $sheet->loadView('Muat.excel2')->with('muatdetail', $muatdetail);
          });

      })->download('xls');
    }

    public function print_detail($id){
      $datamuat   = Muat::with("s_cabang","s_cabang_tujuan")->find($id);
      $muatdetail = MuatDetail::with("s_penjualan")->where("id_muat","=",$id)->get();

      $pdf = PDF::loadView('Muat.printmuat', ["data_muat" => $datamuat, "muat_detail" => $muatdetail])->setPaper('a4', 'landscape');

      return $pdf->stream();

    }
}
