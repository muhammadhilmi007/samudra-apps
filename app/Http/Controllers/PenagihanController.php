<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use App\Penagihan;
use Session;
use Response;
use Request;
use App\Penjualan;
use App\Overdue;
use App\OverdueDetail;
use Redirect;
use Carbon;

class PenagihanController extends Controller
{
    public function index(){
    	$penagihan = Penagihan::with("s_penjualan")->get();

    	$data_overdue_lunas = Overdue::where("nominal","=",0)->get();
    	$stt_lunas_temp 	= [];

    	$penjualan = Penjualan::with("s_kantor_asal");
        foreach($data_overdue_lunas as $lunas){
            $stt_lunas_temp[] = $lunas["stt"];
        }

    	foreach($stt_lunas_temp as $lunas){
    		$penjualan = $penjualan->where("stt", "!=", $lunas);
    	}

    	foreach($penagihan as $p){
    		$penjualan = $penjualan->where("stt", "!=", $p["stt"]);
    	}
    	$penjualan = $penjualan->where("payment_type","!=","CASH");


    	return view("Penagihan.index")->with(["penagihan" => $penagihan, "penjualan" => $penjualan->get()]);
    }

    public function add(){
    	$stt = Request::input("stt");
    	$ket = Request::input("keterangan");
    	$penagihan = new Penagihan();
    	$penagihan->stt=$stt;
    	$penagihan->keterangan = $ket;
    	$penagihan->status =0;

    	$penagihan->save();

    	$message 	= ["success" => "Berhasil input data penagihan !"];

    	Session::flash("message", $message);
    	return Redirect::back(); 


    }

    public function actlunas(){
        $id     = Request::input("id");
        $tanggal = Carbon\Carbon::now();

        foreach($id as $i){
            $penagihan  = Penagihan::find($i);
            $stt        = $penagihan->stt;


            $penjualan  = Penjualan::where("stt","=",$stt)->first();
            $penjualan  = Penjualan::find($penjualan["id"]);
            $penjualan->payment_type = "CASH";
            $penjualan->save();

            $overdue    = Overdue::where("stt", "=", $stt)->first();
            $overdue    = Overdue::find($overdue["id"]);

            $nominal    = $overdue["nominal"];


            $overdueDetail = new OverdueDetail();
            $overdueDetail->stt = $stt;
            $overdueDetail->tanggal = $tanggal;
            $overdueDetail->besar_nominal = $nominal;
            $overdueDetail->save();

            $overdue->nominal = 0;
            $overdue->save();

            $penagihan->status = 1;
            $penagihan->save();
        }
        $message    = ["success" => "Berhasil melunaskan penagihan"];
        Session::flash("message", $message);
        return Redirect::back();
    }

}
