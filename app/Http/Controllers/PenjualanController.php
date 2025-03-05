<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use Request;
use Response;
use App\Penjualan;
use App\Cabang;
use App\Overdue;
use App\Transit;

use Auth;
use Session;

use App;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;

class PenjualanController extends Controller
{
    public function index(){
    	return view("Penjualan.index");
    }

    public function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }
    //api

    public function checker_input(){
    	$berat 			= Request::input("berat");
    	$packing		= Request::input("packing");
    	$jumlah_colly	= Request::input("jumlah_colly");
    	$cabang 		= Request::input("cabang");

    	// $prevStt 	= Penjualan::where("kantor_asal", "=", $cabang)->orderBy("created_at", "DESC");
    	$newStt = self::generatestt($cabang);

    	$penjualan 					= new Penjualan();
    	$penjualan->berat 			= $berat;
    	$penjualan->packing 		= $packing;
    	$penjualan->jumlah_colly	= $jumlah_colly;
    	$penjualan->stt 			= $newStt;
    	$penjualan->cabang 			= $cabang;
    	$penjualan->save();

    	$data	 = [
    		"status" => 1,
    		"message" => "Berhasil input data",
    		"stt" => $newStt
    	];

    	return Response::json($data);
    }

    public function list_penjualan(){
    	$cabang 	= Request::input("cabang");
    	$penjualan	= Penjualan::where("kantor_asal","=",$cabang)->orderBy("created_at", "DESC")->get();

    	$data 	= [
    		"status" => 1,
    		"data" => $penjualan
    	];

    	return Response::json($data);
    }

    public function penjualan_list(){
    	$cabang 	= Request::input("cabang");
    	$penjualan 	= Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang");

    	if(Auth::user()->hasRole("admin")){
    		$data 	= $penjualan->get();
    	}
    	else{
    		$data = $penjualan->where("cabang","=",$cabang)->get();
    	}
    	
    	$count 	= $penjualan->count();
    	
    	$jdata 	= [
    		"success" => 1,
    		"data" => $data,
    		"count" => $count
    	];

    	return Response::json($jdata);
    }

    public function edit($id){
        $penjualan = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang")->find($id);
        
        // Check if penjualan exists
        if (!$penjualan) {
            return redirect("/penjualan");
        }
        
        $cabang = Cabang::where("id", "!=", $penjualan->cabang)->get();
        $allcabang = Cabang::all();
    
        $penjualanTemp = [];
        $pengirimTemp = [];
    
        $allPenjualan = Penjualan::where("pengirim", "!=", null)->get();
    
        foreach($allPenjualan as $p){
            if(!in_array($p["pengirim"], $pengirimTemp)){
                $pengirimTemp[] = $p["pengirim"];
                $penjualanTemp[] = $p;
            }
        }
    
        return view("Penjualan.edit")->with([
            "penjualan" => $penjualan, 
            "data_cabang" => $cabang, 
            "allcabang" => $allcabang, 
            "allpenjualan" => $penjualanTemp
        ]);
    }

    public function actedit($id){
    	$kantor_asal = Request::input("kantor_asal");
    	$kantor_tujuan = Request::input("kantor_tujuan");
    	$stt = Request::input("stt");
    	$pengirim = Request::input("pengirim");
    	$penerima = Request::input("penerima");
    	$alamat = Request::input("alamat");
    	$penerus = Request::input("penerus");
    	if($penerus != ""){
    		$kode_penerus = Request::input("kode_penerus");
    	}
    	$nm_barang = Request::input("nm_barang");
    	$payment = Request::input("payment");
    	$jml_colly = Request::input("jml_colly");
    	$packing = Request::input("packing");
    	$berat = Request::input("berat");
    	$harga = Request::input("harga");
    	$jumlah_harga = Request::input("jumlah_harga");
    	$ket_tambahan = Request::input("ket_tambahan");
        $kontak_penerima = Request::input("kontak_penerima");
        $jenis_harga = Request::input("jenis_harga");

        if($jenis_harga == "volume_metric"){
            $v_panjang = Request::input("v_panjang");
            $v_lebar = Request::input("v_lebar");
        	$v_tinggi = Request::input("v_tinggi");

            $vmet = $v_panjang * $v_lebar * $v_tinggi;

            $allv = $v_panjang."-".$v_lebar."-".$v_tinggi."-".$vmet;
        }

    	$penjualan 	= Penjualan::find($id);
    	if (!$penjualan) {
            return redirect("/penjualan");
        }
    	$penjualan->kantor_asal = $kantor_asal;
    	$penjualan->kantor_tujuan = $kantor_tujuan;
    	$penjualan->pengirim = $pengirim;
    	$penjualan->penerima = $penerima;
    	$penjualan->alamat_penerima = $alamat;
    	$penjualan->penerus = $penerus;
        $penjualan->jenis_harga = $jenis_harga;
        if($penerus != ""){
            $penjualan->kode_penerus = $kode_penerus;
        }

        if($jenis_harga == "volume_metric"){
            $penjualan->vmet = $allv;
        }

    	$penjualan->nama_barang = $nm_barang;
    	$penjualan->payment_type = $payment;
    	$penjualan->jumlah_colly = $jml_colly;
    	$penjualan->packing = $packing;
    	$penjualan->berat = $berat;
    	$penjualan->harga_per_kilo = $harga;
    	$penjualan->harga_total = $jumlah_harga;
    	$penjualan->ket_tambahan = $ket_tambahan;
    	$penjualan->kontak_penerima = $kontak_penerima;
    	$penjualan->user = Auth::user()->id;

    	$penjualan->save();

        if(!empty(Request::input("cb_transit"))){

            $data_penjualan     = Penjualan::orderBy("id", "DESC")->find($id);
            $transit    = Request::input("transit");

            foreach($transit as $k => $t){
                $transit[$k] = $t."_0"; 
            }

            $ptransit   = new Transit();
            $ptransit->penjualan = $data_penjualan["id"];
            $ptransit->transit  = implode("-", $transit);

            $ptransit->save();
        }

        if($payment == "CAD" || $payment == "COD"){
            switch($payment){
                case "CAD":
                    $over_cabang    = $kantor_asal;
                    $over_pelanggan = $pengirim;
                break;
                case "COD":
                    $over_cabang    = $kantor_tujuan;
                    $over_pelanggan = $penerima;
                break;
            }
            $overdue                = new Overdue();
            $overdue->stt           = $stt;
            $overdue->cabang        = $over_cabang;
            $overdue->pelanggan     = $over_pelanggan;
            $overdue->nominal_awal  = $jumlah_harga;
            $overdue->nominal  = $jumlah_harga;

            $overdue->save();
        }

    	$message 	= ["success" => "Berhasil menyimpan data"];
    	Session::flash("message", $message);

    	return redirect("/penjualan");
    }

    public function getByStt(){
        $stt            = Request::input("stt");

        $penjualan      = Penjualan::with("s_kantor_asal","s_kantor_tujuan","s_user","s_cabang")->where("stt","=",$stt)->get();

        $data = [
            "success" => 1,
            "data" => $penjualan[0]
        ];

        return Response::json($data);
    }

    public function detail($id){
        $penjualan = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang", "s_detail_muat", "s_detail_lansir")->find($id);
        
        if (!$penjualan) {
            return redirect("/penjualan");
        }

        $fortrans = null;
        $transit    = Transit::where("penjualan","=",$id);

        if($transit->count() > 0){
            $fortrans = $transit->first();

            $tr_temp= [];
            $tr     = $fortrans["transit"];

            $ex     = explode("-", $tr);
            foreach($ex as $e){
                $temp = [];
                $trex   = explode("_", $e);

                $kd_cabang      = $trex[0];
                $stat_transit   = $trex[1];

                $data_cabang = Cabang::with("s_divisi")->find($kd_cabang);
                $temp["kd_cabang"] = $kd_cabang;
                $temp["data_cabang"] = $data_cabang;
                $temp["transit_status"] = intval($stat_transit);

                $tr_temp[] = $temp;
            }

            $fortrans["transit_detail"] = $tr_temp;
        }

    	if(count($penjualan) == 0){
    		return redirect("/penjualan");
    	}

    	return view("Penjualan.detail")->with([
            "penjualan" => $penjualan, 
            "transit" => $fortrans
        ]);

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

          $penjualan  = Penjualan::with("s_kantor_asal","s_kantor_tujuan","s_user","s_cabang");
          
          if(!Auth::user()->hasRole("admin")){
            $penjualan->where("cabang","=",Auth::user()->cabang);
          }

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

    public function add(){
        if(Auth::user()->hasRole("admin")){
            $cabang     = Cabang::all();     
        }
        else{
            $cabang     = Cabang::where("id", "!=", Auth::user()->cabang)->get();
        }
        $allcabang  = Cabang::all();

        $penjualanTemp  = [];
        $pengirimTemp = [];

        $allPenjualan = Penjualan::all();

        foreach($allPenjualan as $p){
            if(!in_array($p["pengirim"], $pengirimTemp)){
                $pengirimTemp[] = $p["pengirim"];
                $penjualanTemp[] = $p;
            }
        }

        return view("Penjualan.add")->with(["data_cabang" => $cabang, "allcabang" => $allcabang, "allpenjualan" => $penjualanTemp]);
    }

    public function generatestt($cabang){
        $data_cabang     = Cabang::find($cabang);

        $cabang_length = strlen($data_cabang->kode_cabang);

        $penjualan_before = Penjualan::where("cabang","=",$cabang)->orderBy("id", "DESC")->get();

        if(count($penjualan_before) > 0){
            $latest_stt     = $penjualan_before[0]["stt"];
            $data_nomer = substr($latest_stt, $cabang_length);
            $latest_number  = intval($data_nomer);
            $new_number     = $latest_number + 1;
            $new_number_s   = "".$new_number;

            $length_of_new_number   = strlen($new_number_s);
            if($length_of_new_number < 6){
                $add_for_zero   = 6 - $length_of_new_number;

                $zero_temp  = "";
                for($a = 1; $a<=$add_for_zero; $a++){
                    $zero_temp .= "0";
                }

                $newstt    = $data_cabang->kode_cabang."".$zero_temp."".$new_number_s;
            }
            else{
                $newstt    = $data_cabang->kode_cabang."".$new_number_s;
            }
        }
        else{
            $newstt     = $data_cabang->kode_cabang."000001";
        }

        return $newstt;
    }

    public function manualadd(){
        $kantor_asal = Request::input("kantor_asal");
        $kantor_tujuan = Request::input("kantor_tujuan");
        $stt = self::generatestt($kantor_asal);
        $pengirim = Request::input("pengirim");
        $penerima = Request::input("penerima");
        $alamat = Request::input("alamat");
        $penerus = Request::input("penerus");
        if($penerus != ""){
            $kode_penerus = Request::input("kode_penerus");
        }
        $nm_barang = Request::input("nm_barang");
        $payment = Request::input("payment");
        $jml_colly = Request::input("jml_colly");
        $packing = Request::input("packing");
        $berat = Request::input("berat");
        $harga = Request::input("harga");
        $jumlah_harga = Request::input("jumlah_harga");
        $ket_tambahan = Request::input("ket_tambahan");
        $kontak_penerima = Request::input("kontak_penerima");

        $jenis_harga = Request::input("jenis_harga");


        if($jenis_harga == "volume_metric"){
            $v_panjang = Request::input("v_panjang");
            $v_lebar = Request::input("v_lebar");
            $v_tinggi = Request::input("v_tinggi");

            $vmet = $v_panjang * $v_lebar * $v_tinggi;

            $allv = $v_panjang."-".$v_lebar."-".$v_tinggi."-".$vmet;
        }



        $penjualan  = new Penjualan();
        $penjualan->kantor_asal = $kantor_asal;
        $penjualan->kantor_tujuan = $kantor_tujuan;
        $penjualan->stt = $stt;
        $penjualan->pengirim = $pengirim;
        $penjualan->penerima = $penerima;
        $penjualan->alamat_penerima = $alamat;
        $penjualan->penerus = $penerus;
        $penjualan->jenis_harga = $jenis_harga;
        if($penerus != ""){
            $penjualan->kode_penerus = $kode_penerus;
        }
        if($jenis_harga == "volume_metric"){
            $penjualan->vmet = $allv;
        }


        $penjualan->nama_barang = $nm_barang;
        $penjualan->payment_type = $payment;
        $penjualan->jumlah_colly = $jml_colly;
        $penjualan->packing = $packing;
        $penjualan->berat = $berat;
        $penjualan->harga_per_kilo = $harga;
        $penjualan->harga_total = $jumlah_harga;
        $penjualan->ket_tambahan = $ket_tambahan;
        $penjualan->kontak_penerima = $kontak_penerima;
        $penjualan->cabang = Auth::user()->cabang;
        $penjualan->user = Auth::user()->id;

        $penjualan->save();



        if(!empty(Request::input("cb_transit"))){

            $data_penjualan     = Penjualan::orderBy("id", "DESC")->first();
            $transit    = Request::input("transit");

            foreach($transit as $k => $t){
                $transit[$k] = $t."_0"; 
            }

            $ptransit   = new Transit();
            $ptransit->penjualan = $data_penjualan["id"];
            $ptransit->transit  = implode("-", $transit);

            $ptransit->save();
        }



        if($payment == "CAD" || $payment == "COD"){
            switch($payment){
                case "CAD":
                    $over_cabang    = $kantor_asal;
                    $over_pelanggan = $pengirim;
                break;
                case "COD":
                    $over_cabang    = $kantor_tujuan;
                    $over_pelanggan = $penerima;
                break;
            }
            $overdue                = new Overdue();
            $overdue->stt           = $stt;
            $overdue->cabang        = $over_cabang;
            $overdue->pelanggan     = $over_pelanggan;
            $overdue->nominal_awal  = $jumlah_harga;
            $overdue->nominal  = $jumlah_harga;

            $overdue->save();
        }


        $message    = ["success" => "Berhasil menambahkan penjualan dengan STT : $stt"];
        Session::flash("message", $message);

        return redirect("/penjualan");
    }

    public function export_excel(){
        $excel = App::make('excel');

        Excel::create('Penjualan', function($excel) {

            $excel->sheet('1', function($sheet) {
                $penjualan     = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang")->whereNotNull("user")->get();

                $sheet->loadView('Penjualan.excel')->with("penjualan", $penjualan);
            }); 

        })->download('xls');
    }

    public function printpenjualan($id){
        $stt = $id;
        $id     = Penjualan::where("stt","=",$id)->first()["id"];
        $data_penjualan     = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang", "s_detail_lansir", "s_detail_muat")->find($id);

        $fortrans = null;
        $transit    = Transit::where("penjualan","=",$id);

        if($transit->count() > 0){
            $fortrans = $transit->first();

            $tr_temp= [];
            $tr     = $fortrans["transit"];

            $ex     = explode("-", $tr);
            foreach($ex as $e){
                $temp = [];
                $trex   = explode("_", $e);

                $kd_cabang      = $trex[0];
                $stat_transit   = $trex[1];

                $data_cabang = Cabang::with("s_divisi")->find($kd_cabang);
                $temp["kd_cabang"] = $kd_cabang;
                $temp["data_cabang"] = $data_cabang;
                $temp["transit_status"] = intval($stat_transit);

                $tr_temp[] = $temp;
            }

            $fortrans["transit_detail"] = $tr_temp;
        }

        $pdf = PDF::loadView('Penjualan.printpenjualan', ["data_penjualan" => $data_penjualan, "transit" => $fortrans])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

     public function printdetailpenjualan($id){
        $stt = $id;
        $id     = Penjualan::where("stt","=",$id)->first()["id"];
        $data_penjualan     = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang", "s_detail_lansir", "s_detail_muat")->find($id);

        $fortrans = null;
        $transit    = Transit::where("penjualan","=",$id);

        if($transit->count() > 0){
            $fortrans = $transit->first();

            $tr_temp= [];
            $tr     = $fortrans["transit"];

            $ex     = explode("-", $tr);
            foreach($ex as $e){
                $temp = [];
                $trex   = explode("_", $e);

                $kd_cabang      = $trex[0];
                $stat_transit   = $trex[1];

                $data_cabang = Cabang::with("s_divisi")->find($kd_cabang);
                $temp["kd_cabang"] = $kd_cabang;
                $temp["data_cabang"] = $data_cabang;
                $temp["transit_status"] = intval($stat_transit);

                $tr_temp[] = $temp;
            }

            $fortrans["transit_detail"] = $tr_temp;
        }

        $pdf = PDF::loadView('Penjualan.printdetailpenjualan', ["data_penjualan" => $data_penjualan, "transit" => $fortrans])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function filterpengirim(){
        $value  = Request::input("val");

        $penerimaTemp = [];
        $dataTemp = [];

        $data   = Penjualan::where("pengirim","=",$value)->get();
        foreach($data as $p){
            if(!in_array($p["penerima"], $penerimaTemp)){
                $penerimaTemp[] = $p["penerima"];
                $dataTemp[] = $p;
            }
        }

        $rt = [
            "success" => 1,
            "data" => $dataTemp
        ];

        return Response::json($rt);
    }

    public function filterpenerima(){
        $value      = Request::input("val");
        $pengirim   = Request::input("pengirim");



        $alamatTemp = [];
        $dataTemp = [];

        $data   = Penjualan::where("pengirim","=",$pengirim)->where("penerima","=",$value)->get();

        foreach($data as $p){
            if(!in_array($p["alamat_penerima"], $alamatTemp)){
                $alamatTemp[] = $p["alamat_penerima"];
                $dataTemp[] = $p;
            }
        }

        $rt = [
                "success" => 1,
                "data" => $dataTemp
            ];

        return Response::json($rt);
    }

    public function filteralamat(){
        $value      = Request::input("val");
        $pengirim   = Request::input("pengirim");
        $penerima   = Request::input("penerima");


        $penerusTemp = [];
        $dataTemp = [];

        $data   = Penjualan::where("pengirim","=",$pengirim)->where("penerima","=",$penerima)->where("alamat_penerima","=",$value)->get();

        foreach($data as $p){
            if(!in_array($p["penerus"], $penerusTemp)){
                $penerusTemp[] = $p["penerus"];
                $dataTemp[] = $p;
            }
        }

        $rt = [
                "success" => 1,
                "data" => $dataTemp
            ];

        return Response::json($rt);
    }
     public function printtugastagihan(){
        $pdf = PDF::loadView('print_tugas_tagihan.printtugastagihan')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

}
