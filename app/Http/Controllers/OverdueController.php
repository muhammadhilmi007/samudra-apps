<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Response;
use Redirect;
use Session;
use Carbon;

use App\Overdue;
use App\OverdueDetail;
use App\Cabang;
use App\Penjualan;


use App;
use Barryvdh\DomPDF\Facade as PDF;


class OverdueController extends Controller
{
    public function index(){
      $data_customer = Penjualan::where("payment_type","=","CAD")->orWhere("payment_type","=","COD")->get();
      $arr_temp   = [];

      foreach($data_customer as $dc){
        if(!in_array($dc["pengirim"], $arr_temp)){
          $arr_temp[$dc["id"]] = $dc["pengirim"];
        }
      }

    	return view("Overdue.index")->with(["invoice_pengirim" => $arr_temp]);
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


          $overdue  = Overdue::with("s_stt","s_cabang");
          if($key != ""){
                $exkey      = explode(";", $key);
                if(count($exkey) > 1){
                      foreach($exkey as $i => $k){
                            $overdue->where("stt","LIKE","%$k%");
                            $data_cabang 	= Cabang::where("nama_cabang","LIKE","%$k%")->get();
                            foreach($data_cabang as $cab){
                            	$overdue->orWhere("cabang","=",$cab->id);
                            }
                            $overdue->orWhere("pelanggan", "LIKE", "%$k%");
                            $overdue->orWhere("nominal_awal", "LIKE", "%$k%");
                            $overdue->orWhere("nominal", "LIKE", "%$k%");
                      }
                }
                else{
                      	$overdue->where("stt","LIKE","%$key%");
	                    $data_cabang 	= Cabang::where("nama_cabang","LIKE","%$key%")->get();
	                    foreach($data_cabang as $cab){
	                    	$overdue->orWhere("cabang","=",$cab->id);
	                    }
	                    $overdue->orWhere("pelanggan", "LIKE", "%$key%");
	                    $overdue->orWhere("nominal_awal", "LIKE", "%$key%");
	                    $overdue->orWhere("nominal", "LIKE", "%$key%");
                }

                // foreach($cabang as $c){
                //       $overdue->orWhere("cabang","=",$c->id);
                // }
          }

          $count      = $overdue->count();

          if($orderby != ""){
                $overdue->orderBy($orderby, $ascdsc);
          }


          $data       = [
                "success" => 1,
                "data" => $overdue->take($pl)->skip($p)->get(),
                "count" => $count
          ];

          return Response::json($data);
    }


    public function detail($id){
    	$overdue 		= Overdue::with("s_stt","s_cabang")->find($id);
    	$overdueDetail 	= OverdueDetail::where("stt","=",$overdue["stt"])->get();

    	// dd($overdue, $overdueDetail);

    	return view("Overdue.detail")->with(["overdue" => $overdue, "detail" => $overdueDetail]);
    }

    public function adddetail($id){
    	$tanggal 		= Request::input("tanggal");
    	$nominal 		= Request::input("nominal");
      $payment_type = Request::input("payment_type");


    	$overdue 				= Overdue::find($id);

      $penjualan  = Penjualan::where("stt","=",$overdue["stt"])->first();

      $penjualan          = Penjualan::find($penjualan["id"]);
      $penjualan->payment_type  = $payment_type;
      $penjualan->save();

      if($payment_type == "CASH"){
        $overdue    = Overdue::where("stt","=",$overdue["stt"])->first();
        $overdue    = Overdue::find($overdue["id"]);

        $nominal    = $overdue->nominal;

        $overdueDetail  = new OverdueDetail();
        $overdueDetail->stt = $overdue["stt"];
        $overdueDetail->tanggal = $tanggal;
        $overdueDetail->besar_nominal = $nominal;

        $overdueDetail->save();

        $overdue->nominal = 0;
        $overdue->save();
      }
      else{
      	$detail 				= new OverdueDetail();
      	$detail->stt 			= $overdue["stt"];
      	$detail->tanggal 		= $tanggal;
      	$detail->besar_nominal 	= $nominal;

      	$detail->save();

      	$original_nominal 		= $overdue["nominal"];

      	$updated 				= $original_nominal - $nominal;

      	$overdue->nominal 	 	= $updated;

      	$overdue->save();
      }

    	$message 	= ["success" => "Berhasil menambahkan pembayaran"];
    	Session::flash("message", $message);

    	return Redirect::back();

    }


    public function actcash($id){
      $tanggal = Carbon\Carbon::now();

      $overdue  = Overdue::find($id);
      $stt      = $overdue->stt;
      $nominal  = $overdue->nominal;


      $detail         = new OverdueDetail();
      $detail->stt      = $overdue["stt"];
      $detail->tanggal    = $tanggal;
      $detail->besar_nominal  = $nominal;

      $detail->save();


      $overdue->nominal = 0;
      $overdue->save();

      $penjualan  = Penjualan::where("stt", "=", $stt)->first();

      $penjualan  = Penjualan::find($penjualan->id);
      $penjualan->payment_type = "CASH";

      $penjualan->save();

      $message  = ["success" => "Berhasil melunaskan overdue dengan id $id"];

      Session::flash("message", $message);

      return Redirect::back();
    }

    public function print_invoice($pengirim, $range){
      $sp_range   = explode("_", $range);
      $awal       = $sp_range[0]." 00:00:00";
      $akhir      = $sp_range[1]." 23:59:59";


      $data       = Penjualan::with("s_overdue")->whereBetween("created_at",[$awal, $akhir])->where("pengirim","=",$pengirim)->get();

      $temp = [];
      foreach($data as $d){
        if($d["payment_type"] == "CAD" || $d["payment_type"] == "COD"){
          $temp[] = $d;
        }
      }

      $pdf = PDF::loadView('print.invoiceperpelanggan',["data" => $temp])->setPaper('a4', 'portrait');
      return $pdf->stream();
    }
}
