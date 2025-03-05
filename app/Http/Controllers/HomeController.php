<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MuatDetail;
use App\LansirDetail;
use App\Penjualan;
use App\Cabang;
use Carbon\Carbon;
use Auth;


use App;
use Barryvdh\DomPDF\Facade as PDF;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard(){
        $baret = [];
        $count_belum_muat   = 0;
        $count_belum_lansir = 0;


        if(Auth::user()->hasRole("admin")){
            $penjualan_hari_ini     = Penjualan::whereRaw('Date(created_at) = CURDATE()')->count();
            $penjualan_total        = Penjualan::count();

            /* --------------------- Penjualan belum muat -------------------*/

            $muat   = MuatDetail::all();
            $stt_muat_temp = [];
            foreach($muat as $m){
                $stt_muat_temp[] = $m->stt;
            }
            $pen_blm_muat = Penjualan::whereNotIn("stt", $stt_muat_temp)->count();
            $count_belum_muat = $pen_blm_muat;


            /* --------------------- Penjualan belum lansir ------------------- */
            $lansir  = LansirDetail::all();
            $stt_lansir_temp    = [];
            foreach($lansir as $l){
                $stt_lansir_temp[] = $l->stt;
            }
            $pen_blm_lansir = Penjualan::whereNotIn("stt", $stt_lansir_temp)->count();
            $count_belum_lansir = $pen_blm_lansir;
            $omset = [];

            for($a = 1; $a<=12; $a++){
                $pthis_year    = Penjualan::whereYear("created_at",Carbon::now());
                $omset[] = $pthis_year->whereMonth("created_at",$a)->get();
            }

        }
        else{
            $penjualan_hari_ini     = Penjualan::where("cabang", "=", Auth::user()->cabang)->whereRaw('Date(created_at) = CURDATE()')->count();
            $penjualan_total        = Penjualan::where("cabang", "=", Auth::user()->cabang)->count();

            /* ---------------------- penjualan belum muat -------------------*/

            $muat   = MuatDetail::with("s_muat")->get();
            $stt_muat_temp = [];
            foreach($muat as $m){
                if($m->s_muat->cabang == Auth::user()->cabang){
                    $stt_muat_temp[] = $m->stt;
                }
            }
            $pen_blm_muat = Penjualan::whereNotIn("stt", $stt_muat_temp)->count();
            $count_belum_muat = $pen_blm_muat;

            /* --------------------- penjualan belum lansir ----------------- */

            $lansir  = LansirDetail::with("s_lansir")->get();

            $stt_lansir_temp    = [];

            foreach($lansir as $l){
                if($l->s_lansir->cabang == Auth::user()->cabang){
                    $stt_lansir_temp = [];
                }
            }
            $pen_blm_lansir = Penjualan::whereNotIn("stt", $stt_lansir_temp)->count();
            $count_belum_lansir = $pen_blm_lansir;   


            for($a = 1; $a<=12; $a++){
                $pthis_year    = Penjualan::where("cabang","=",Auth::user()->cabang)->whereYear("created_at",Carbon::now());
                $omset[] = $pthis_year->whereMonth("created_at",$a)->get();
            }
        }

        $cabang     = Cabang::all();

        $baret = [
            "penjualan_hari_ini" => $penjualan_hari_ini,
            "penjualan_total" => $penjualan_total,
            "penjualan_belum_dimuat" => $count_belum_muat,
            "penjualan_belum_dilansir" => $count_belum_lansir,
            "omset" => $omset,
            "cabang" => $cabang
        ];



        return view('dashboard')->with($baret);
    }
     public function printtugastagihan(){
        $pdf = PDF::loadView('print.printtugastagihan')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function printinvoiceperpelanggan(){
        $pdf = PDF::loadView('print.invoiceperpelanggan')->setPaper('a4', 'portrait');
        return $pdf->stream();
    }

    
}
