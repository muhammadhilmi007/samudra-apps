<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use Request;
use Response;

use App\KasKecil;
use App\KasBantuan;
use Auth;
use App\Account;

class KasController extends Controller
{
        public function kecil(){
        	$acc 	= Account::all();


    		return view("Kas.kecil")->with("account", $acc);    	
        }

        public function kecil_get(){
        	if(Auth::user()->hasRole("admin")){
        		$data 	= KasKecil::with("s_account","s_kantor")->get();
        	}
        	else{
        		$data 	= KasKecil::with("s_account","s_kantor")->where("kantor", "=", Auth::user()->cabang)->get();
        	}



        	$json	 = [
        		"success" => 1,
        		"data" => $data,
        	];

        	return Response::json($json);
        }

        public function kecil_delete(){
        	$id 	= Request::input("id");
        	$index = Request::input("index");
        	$data = KasKecil::find($id);

        	$data->delete();

        	$res = [
        		"success" => 1,
        		"index" => $index,
        		"data" => "Berhasil menghapus item dari Kas Kecil"
        	];

        	return Response::json($res);
        }

        public function get_acc(){
        	$data 	= Account::all();

        	return Response::json($data);
        }

        public function kecil_exec(){
        	$index 	= Request::input("index");
        	$data 	= Request::input("data");

        	$id 		= $data["id"];
        	$tgl 		= $data["tgl"];
        	$acc 		= $data["acc"];
        	$kantor 	= $data["kantor"];
        	$account 	= $data["account"];
        	$keterangan = $data["keterangan"];
        	$tambahan 	= $data["tambahan"];
        	$debet 		= $data["debet"];
        	$kredit 	= $data["kredit"];

        	if($id == ""){
        		$kaskecil 	= new KasKecil();
        	}
        	else{
        		$kaskecil 	= KasKecil::find($id);
        	}
        	$kaskecil->tanggal 	= $tgl;
        	$kaskecil->account 	= $acc;
        	$kaskecil->kantor 	= $kantor;
        	$kaskecil->keterangan = $keterangan;
        	$kaskecil->tambahan 	= $tambahan;
        	$kaskecil->debet 		= $debet;
        	$kaskecil->kredit 	= $kredit;

        	$kaskecil->save();

        	if($id == ""){
        		$data_kas_kecil 	= KasKecil::orderBy("id", "DESC")->first();
        		$id_kas_kecil 		= $data_kas_kecil->id;
        	}
        	else{
        		$id_kas_kecil 		= $id;
        	}

        	$json 	= [
        		"success" => 1,
        		"index" => $index,
        		"id" => $id_kas_kecil
        	];

        	return Response::json($json);
        }

            public function bantuan(){
            	$acc 	= Account::all();


        		return view("Kas.bantuan")->with("account", $acc);    	
            }

            public function bantuan_get(){
            	if(Auth::user()->hasRole("admin")){
            		$data 	= KasBantuan::with("s_account","s_kantor")->get();
            	}
            	else{
            		$data 	= KasBantuan::with("s_account","s_kantor")->where("kantor", "=", Auth::user()->cabang)->get();
            	}



            	$json	 = [
            		"success" => 1,
            		"data" => $data,
            	];

            	return Response::json($json);
            }

            public function bantuan_delete(){
            	$id 	= Request::input("id");
            	$index = Request::input("index");
            	$data = KasBantuan::find($id);

            	$data->delete();

            	$res = [
            		"success" => 1,
            		"index" => $index,
            		"data" => "Berhasil menghapus item dari Kas Bantuan"
            	];

            	return Response::json($res);
            }


            public function bantuan_exec(){
            	$index 	= Request::input("index");
            	$data 	= Request::input("data");

            	$id 		= $data["id"];
            	$tgl 		= $data["tgl"];
            	$acc 		= $data["acc"];
            	$kantor 	= $data["kantor"];
            	$account 	= $data["account"];
            	$keterangan = $data["keterangan"];
            	$tambahan 	= $data["tambahan"];
            	$debet 		= $data["debet"];
            	$kredit 	= $data["kredit"];

            	if($id == ""){
            		$kasbantuan 	= new KasBantuan();
            	}
            	else{
            		$kasbantuan 	= KasBantuan::find($id);
            	}
            	$kasbantuan->tanggal 	= $tgl;
            	$kasbantuan->account 	= $acc;
            	$kasbantuan->kantor 	= $kantor;
            	$kasbantuan->keterangan = $keterangan;
            	$kasbantuan->tambahan 	= $tambahan;
            	$kasbantuan->debet 		= $debet;
            	$kasbantuan->kredit 	= $kredit;

            	$kasbantuan->save();

            	if($id == ""){
            		$data_bantuan 	= KasBantuan::orderBy("id", "DESC")->first();
            		$id_bantuan 		= $data_bantuan->id;
            	}
            	else{
            		$id_bantuan 		= $id;
            	}

            	$json 	= [
            		"success" => 1,
            		"index" => $index,
            		"id" => $id_bantuan
            	];

            	return Response::json($json);
            }
}
