<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use Request;
use Response;

use App\JurnalUmum;
use Auth;
use App\Account;

class JurnalController extends Controller
{
    public function umum(){
    	$acc 	= Account::all();


		return view("Jurnal.umum")->with("account", $acc);    	
    }

    public function umum_get(){ 
    	if(Auth::user()->hasRole("admin")){
    		$data 	= JurnalUmum::with("s_account","s_kantor")->get();
    	}
    	else{
    		$data 	= JurnalUmum::with("s_account","s_kantor")->where("kantor", "=", Auth::user()->cabang)->get();
    	}



    	$json	 = [
    		"success" => 1,
    		"data" => $data,
    	];

    	return Response::json($json);
    }

    public function umum_delete(){
    	$id 	= Request::input("id");
    	$index = Request::input("index");
    	$data = JurnalUmum::find($id);

    	$data->delete();

    	$res = [
    		"success" => 1,
    		"index" => $index,
    		"data" => "Berhasil menghapus item dari Jurnal Umum"
    	];

    	return Response::json($res);
    }

    public function get_acc(){
    	$data 	= Account::all();

    	return Response::json($data);
    }

    public function umum_exec(){
    	$index 	= Request::input("index");
    	$data 	= Request::input("data");

    	$id 		= $data["id"];
    	$tgl 		= $data["tgl"];
    	$acc 		= $data["acc_id"];
    	$kantor 	= $data["kantor"];
    	$account 	= $data["account"];
    	$keterangan = $data["keterangan"];
    	$tambahan 	= $data["tambahan"];
    	$debet 		= $data["debet"];
    	$kredit 	= $data["kredit"];

    	if($id == ""){
    		$jurnal 	= new JurnalUmum();
    	}
    	else{
    		$jurnal 	= JurnalUmum::find($id);
    	}
    	$jurnal->tanggal 	= $tgl;
    	$jurnal->account 	= $acc;
    	$jurnal->kantor 	= $kantor;
    	$jurnal->keterangan = $keterangan;
    	$jurnal->tambahan 	= $tambahan;
    	$jurnal->debet 		= $debet;
    	$jurnal->kredit 	= $kredit;

    	$jurnal->save();

    	if($id == ""){
    		$data_jurnal 	= JurnalUmum::orderBy("id", "DESC")->first();
    		$id_jurnal 		= $data_jurnal->id;
    	}
    	else{
    		$id_jurnal 		= $id;
    	}

    	$json 	= [
    		"success" => 1,
    		"index" => $index,
    		"id" => $id_jurnal
    	];

    	return Response::json($json);
    }
}
