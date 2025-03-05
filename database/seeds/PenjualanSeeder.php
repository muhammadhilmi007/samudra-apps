<?php

use Illuminate\Database\Seeder;

use App\Penjualan;
use Faker\Factory as Faker;
use App\Cabang;
use App\Overdue;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function get_packing(){
    	$packing = 	["amplop","bal","bal/box","bal/roll","bal/unit","box","colly","drum","drum/zak","dus","ikat","jerigen","karung","pail","paket","peti","roll","roll/bale","roll/bale/dus","unit","zak","karung/roll","pail/zak","dus/roll"];

    	$rand_arr = rand(0, (count($packing)-1) );

    	return $packing[$rand_arr];
    }

    public function get_payment(){
    	$payment 	= ["CASH", "CAD", "COD"];

    	$rand_arr 	= rand(0, (count($payment) - 1));

    	return $payment[$rand_arr];
    }

    public function get_cabang(){
    	return Cabang::inRandomOrder()->first()->id;
    }

    public function get_kantor_tujuan($except){
    	return Cabang::where("id", "!=", $except)->inRandomOrder()->first()->id;
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

    public function run()
    {

    	$faker 			= Faker::create();

    	for($a=0;$a<10;$a++){
    		$cabang 		= self::get_cabang();

    		$berat 			= $faker->randomFloat(2, $min = 1, $max = 1000);
    		$harga 			= self::randomNumber(4);

    		$kontak_penerima= self::get_kontak_penerima();
            $payment        = self::get_payment();
            $kantor_tujuan  = self::get_kantor_tujuan($cabang);
            $pengirim       = $faker->name;
            $penerima       = $faker->name;
            $stt            = self::generatestt($cabang);

	    	$penjualan 					= new Penjualan();
	    	$penjualan->packing 		= self::get_packing();
	    	$penjualan->jumlah_colly	= rand(1, 10000);
	    	$penjualan->stt 			= $stt;
	    	$penjualan->cabang 			= $cabang;
	        $penjualan->kantor_asal = $cabang;
	        $penjualan->kantor_tujuan = 4;
	        $penjualan->pengirim = $pengirim;
	        $penjualan->penerima = $penerima;
	        $penjualan->alamat_penerima = $faker->streetAddress;
            $penjualan->penerus = "";
	        $penjualan->jenis_harga = "berat";
	        $penjualan->kode_penerus = 70;
	        $penjualan->nama_barang = $faker->name;
	        $penjualan->payment_type = $payment;
	        $penjualan->jumlah_colly = rand(1, 10000);
	        $penjualan->packing = self::get_packing();
	        $penjualan->berat = $berat;
	        $penjualan->harga_per_kilo = $harga;
	        $penjualan->harga_total = $berat * $harga;
	        $penjualan->ket_tambahan = $faker->text;
	        $penjualan->kontak_penerima = $kontak_penerima;
	        $penjualan->user = 1;

	        $penjualan->save();

            $jumlah_harga = $berat * $harga;

            if($payment == "CAD" || $payment == "COD"){
                switch($payment){
                    case "CAD":
                        $over_cabang    = $cabang;
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
    		
    	}

    }

    public function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    public function get_kontak_penerima(){
    	$base 	= "08";
    	$random = self::randomNumber(10);

    	$result = $base."".$random;

    	return $result;
    }


}
