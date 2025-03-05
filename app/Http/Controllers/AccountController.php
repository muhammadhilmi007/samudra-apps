<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;

use App\Account;
use App\Cabang;
use App\JurnalUmum;
use Request;
use Response;
use Session;
use Auth;


use App;
use Barryvdh\DomPDF\Facade as PDF;
class AccountController extends Controller
{
    public function index(){
    	$account 	= Account::where("cabang", "=", Auth::user()->cabang)->get();

    	return view("Account.index")->with("account", $account);
    }
    public function add(){
    	$kode	= Request::input("kode");
    	$nama 	= Request::input("nama");

    	$account 	            = new Account();
    	$account->kode			= $kode;
    	$account->nama_account	= $nama;
        $account->cabang        = Auth::user()->cabang;
    	$account->save();

    	$message = ["success" => "Berhasil menambahkan Account"];
    	Session::flash("message", $message);

    	return redirect("account");
    }

    public function find_by_id($id){
        $account    = Account::find($id);

        $data = [
            "success" => 1,
            "data" => $account
        ];

        return Response::json($data);
    }

     public function edit($id){
    	$kode	= Request::input("kode");
    	$nama 	= Request::input("nama");

    	$account 	            = Account::find($id);
    	$account->kode			= $kode;
    	$account->nama_account	= $nama;

    	$account->save();

    	$message = ["success" => "Berhasil menambahkan Account"];
    	Session::flash("message", $message);

    	return redirect("account");
    }

    public function neraca(){
        $cabang     = Cabang::all();
        $account    = Account::all();

        
        
        $a11        = Account::where("kode", "LIKE", "11%")->get();
        $a12        = Account::where("kode", "LIKE", "12%")->get();
        $a13        = Account::where("kode", "LIKE", "13%")->get();
        $a14        = Account::where("kode", "LIKE", "14%")->get();
        $a21        = Account::where("kode", "LIKE", "21%")->get();
        $a31        = Account::where("kode", "LIKE", "31%")->get();
        $a32        = Account::where("kode", "LIKE", "32%")->get();
        $a33        = Account::where("kode", "LIKE", "33%")->get();

        $account    = [
            "all" => $account,
            "a11" => $a11,
            "a12" => $a12,
            "a13" => $a13,
            "a14" => $a14,
            "a21" => $a21,
            "a31" => $a31,
            "a32" => $a32,
            "a33" => $a33,
        ];

        return view("Account.neraca")->with(["cabang" => $cabang, "account" => $account]);
    }

    public function neraca_get(){
        $cabang     = Request::input("cabang");
        $tanggal    = Request::input("tanggal");

        $ex         = explode("-", $tanggal);
        $tanggal2    = $ex[2]."-".$ex[1]."-".$ex[0];

        $a11        = Account::where("kode", "LIKE", "11%")->where("cabang","=",$cabang)->get();
        foreach($a11 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a12        = Account::where("kode", "LIKE", "12%")->where("cabang","=",$cabang)->get();
        foreach($a12 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a13        = Account::where("kode", "LIKE", "13%")->where("cabang","=",$cabang)->get();
        foreach($a13 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a14        = Account::where("kode", "LIKE", "14%")->where("cabang","=",$cabang)->get();
        foreach($a14 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a21        = Account::where("kode", "LIKE", "21%")->where("cabang","=",$cabang)->get();
        foreach($a21 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a31        = Account::where("kode", "LIKE", "31%")->where("cabang","=",$cabang)->get();
        foreach($a31 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a32        = Account::where("kode", "LIKE", "32%")->where("cabang","=",$cabang)->get();
        foreach($a32 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a33        = Account::where("kode", "LIKE", "33%")->where("cabang","=",$cabang)->get();

        foreach($a33 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }

        $account    = [
            "a11" => $a11,
            "a12" => $a12,
            "a13" => $a13,
            "a14" => $a14,
            "a21" => $a21,
            "a31" => $a31,
            "a32" => $a32,
            "a33" => $a33,
        ];

        $datas = [
            "success" => 1,
            "data" => $account,
        ];
        return Response::json($datas);
    }

    public function neraca_print(){

        $cabang     = Auth::user()->cabang;
        $account    = Account::all();
        $tanggal    = Request::input("stanggal");  
        $a11        = Account::where("kode", "LIKE", "11%")->where("cabang","=",$cabang)->get();
        foreach($a11 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a12        = Account::where("kode", "LIKE", "12%")->where("cabang","=",$cabang)->get();
        foreach($a12 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a13        = Account::where("kode", "LIKE", "13%")->where("cabang","=",$cabang)->get();
        foreach($a13 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a14        = Account::where("kode", "LIKE", "14%")->where("cabang","=",$cabang)->get();
        foreach($a14 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a21        = Account::where("kode", "LIKE", "21%")->where("cabang","=",$cabang)->get();
        foreach($a21 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a31        = Account::where("kode", "LIKE", "31%")->where("cabang","=",$cabang)->get();
        foreach($a31 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a32        = Account::where("kode", "LIKE", "32%")->where("cabang","=",$cabang)->get();
        foreach($a32 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }
        $a33        = Account::where("kode", "LIKE", "33%")->where("cabang","=",$cabang)->get();

        foreach($a33 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->where("tanggal","=",$tanggal)->where("kantor","=",$cabang)->get();
            $debet = 0;
            $kredit = 0;
            foreach($data as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominal = $nominal;
        }

        $account    = [
            // "all" => Account::where("cabang", "=", $cabang)->get(),
            "a11" => $a11,
            "a12" => $a12,
            "a13" => $a13,
            "a14" => $a14,
            "a21" => $a21,
            "a31" => $a31,
            "a32" => $a32,
            "a33" => $a33,
        ];

        $total_1 = [];
        $jml_kewajiban = 0;
        $jml_aktiva = 0;
        $jml_aktiva_lancar = 0;
        $jml_modal = 0;

        foreach($account as $key => $value){
            for($i=0;$i<count($value);$i++){
                if($i == 0){
                    $total_1[$key] = 0;
                }
                if($key == "a21"){
                    $jml_kewajiban = $jml_kewajiban + 1;
                }
                if($key == "a11" || $key == "a12" || $key == "a13" || $key == "a14"){
                    $jml_aktiva = $jml_aktiva + 1;
                }
                if($key == "a11" || $key == "a12" || $key == "a13"){
                    $jml_aktiva_lancar = $jml_aktiva_lancar + 1;
                }
                if($key == "a31" || $key == "a32" || $key == "a33"){
                    $jml_modal = $jml_modal + 1;
                }
                $nominal = $value[$i]->nominal;
                $total_1[$key] = $total_1[$key] + $nominal;
            }
        }

        $bawah["total_aktiva_lancar_1"] = $total_1["a11"] + $total_1["a12"] + $total_1["a13"];
        $bawah["total_assets_1"] = $bawah["total_aktiva_lancar_1"] + $total_1["a14"];
        $bawah["total_modal_1"] = $total_1["a31"] - $total_1["a32"] + $total_1["a33"];
        $bawah["total_pasiva_1"] = $bawah["total_modal_1"] + $total_1["a21"];
        $bawah["rasio_utang_1"] = $jml_kewajiban / $jml_aktiva;
        $bawah["rasio_lancar_1"] = $bawah["total_aktiva_lancar_1"] / $total_1["a21"];
        $bawah["modal_berjalan_1"] = $bawah["total_aktiva_lancar_1"] - $total_1["a21"];
        $bawah["rasio_aset_terhadap_modal_1"] = $jml_aktiva / $jml_modal;
        $bawah["rasio_hutang_terhadap_modal_1"] = $jml_kewajiban / $jml_modal;

        // return view("Account.neracaprint")->with(["account" => $account, "cabang" => $cabang, "tanggal" => $tanggal]);

        $pdf = PDF::loadView("Account.neracaprint", ["account" => $account,
                                                     "cabang" => $cabang,
                                                     "tanggal" => $tanggal,
                                                     "total_1" => $total_1,
                                                     "bawah" => $bawah])->setPaper('a4', 'portrait');
        return $pdf->stream();
    }



    public function indexLabaRugi(){
        $cabang     = Auth::user()->cabang;
        

        //pendapatan operasional
        $a41        = Account::where("kode", "LIKE", "41%")->get();

        //pendapatan non-operasional
        $a42        = Account::where("kode", "LIKE", "42%")->get();
        $a43        = Account::where("kode", "LIKE", "43%")->get();

        //biaya potongan pendapatan
        $a51        = Account::where("kode", "LIKE", "51%")->get();

        //biaya operasional lain
        $a52        = Account::where("kode", "LIKE", "52%")->get();
        $a53        = Account::where("kode", "LIKE", "53%")->get();

        //biaya penyusutan
        $a54        = Account::where("kode", "LIKE", "54%")->get();

        //biaya berjangka 
        $a55        = Account::where("kode", "LIKE", "55%")->get();

        //biaya lain-lain
        $a56        = Account::where("kode", "LIKE", "56%")->get();
        
        $account    = [
            "a41" => $a41,
            "a42" => $a42,
            "a43" => $a43,
            "a51" => $a51,
            "a52" => $a52,
            "a53" => $a53,
            "a54" => $a54,
            "a55" => $a55,
            "a56" => $a56,
        ];


        return view("Account.indexlabarugi")->with(["account" => $account]);
    }

    public function getLabaRugi(){
        $cabang = Auth::user()->cabang;
        $tahun  = Request::input("tahun");
        $bulan  = Request::input("bulan");

        $a41        = Account::where("kode", "LIKE", "41%")->where("cabang","=",$cabang)->get();
        foreach($a41 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->whereYear('tanggal', $tahun)->where("kantor","=",$cabang);
            $debet = 0;
            $kredit = 0;
            foreach($data->get() as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominalTahun = $nominal;

            $data2 = $data->whereMonth("tanggal", $bulan)->get();
            $debet2 = 0;
            $kredit2 = 0;
            foreach($data2 as $d){
                $debet2 = $debet2 + (int) $d->debet;
                $kredit2 = $kredit2 + (int) $d->kredit;
            }
            $nominal2 = $debet2 + $kredit2;
            $a->nominalBulan = $nominal2;
        }

        $a42        = Account::where("kode", "LIKE", "42%")->where("cabang","=",$cabang)->get();
        foreach($a42 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->whereYear('tanggal', $tahun)->where("kantor","=",$cabang);
            $debet = 0;
            $kredit = 0;
            foreach($data->get() as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominalTahun = $nominal;

            $data2 = $data->whereMonth("tanggal", $bulan)->get();
            $debet2 = 0;
            $kredit2 = 0;
            foreach($data2 as $d){
                $debet2 = $debet2 + (int) $d->debet;
                $kredit2 = $kredit2 + (int) $d->kredit;
            }
            $nominal2 = $debet2 + $kredit2;
            $a->nominalBulan = $nominal2;
        }

        $a43        = Account::where("kode", "LIKE", "43%")->where("cabang","=",$cabang)->get();
        foreach($a43 as $a){
            $data   = JurnalUmum::where("account","=",$a->id)->whereYear('tanggal', $tahun)->where("kantor","=",$cabang);
            $debet = 0;
            $kredit = 0;
            foreach($data->get() as $d){
                $debet = $debet + (int) $d->debet;
                $kredit = $kredit + (int) $d->kredit;
            }
            $nominal = $debet + $kredit;
            $a->nominalTahun = $nominal;

            $data2 = $data->whereMonth("tanggal", $bulan)->get();
            $debet2 = 0;
            $kredit2 = 0;
            foreach($data2 as $d){
                $debet2 = $debet2 + (int) $d->debet;
                $kredit2 = $kredit2 + (int) $d->kredit;
            }
            $nominal2 = $debet2 + $kredit2;
            $a->nominalBulan = $nominal2;
        }

        for($i = 1; $i <= 6; $i++){
            $hit = 50 + $i;
            ${'a'.$hit} = Account::where("kode", "LIKE", $hit."%")->where("cabang","=",$cabang)->get();
            foreach(${'a'.$hit} as $a){
                $data   = JurnalUmum::where("account","=",$a->id)->whereYear('tanggal', $tahun)->where("kantor","=",$cabang);
                $debet = 0;
                $kredit = 0;
                foreach($data->get() as $d){
                    $debet = $debet + (int) $d->debet;
                    $kredit = $kredit + (int) $d->kredit;
                }
                $nominal = $debet + $kredit;
                $a->nominalTahun = $nominal;

                $data2 = $data->whereMonth("tanggal", $bulan)->get();
                $debet2 = 0;
                $kredit2 = 0;
                foreach($data2 as $d){
                    $debet2 = $debet2 + (int) $d->debet;
                    $kredit2 = $kredit2 + (int) $d->kredit;
                }
                $nominal2 = $debet2 + $kredit2;
                $a->nominalBulan = $nominal2;
            }
        }

        $account    = [
            "a41" => $a41,
            "a42" => $a42,
            "a43" => $a43,
            "a51" => $a51,
            "a52" => $a52,
            "a53" => $a53,
            "a54" => $a54,
            "a55" => $a55,
            "a56" => $a56,
        ];


        return Response::json($account);
    }
    public function printLabaRugi(){
        $pdf = PDF::loadView('Account.printlabarugi')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
}