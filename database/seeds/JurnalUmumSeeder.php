<?php

use Illuminate\Database\Seeder;
use App\Account;
use App\JurnalUmum;
use Faker\Factory as Faker;


class JurnalUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $date = explode(" ", Carbon\Carbon::today())[0];
        $date = "2017-07-24";
        $data_account = Account::where("cabang", "=", 1)->get();

        foreach($data_account as $da){
        	$faker = Faker::create();
        	$jurnal 	= new JurnalUmum();
        	$jurnal->tanggal 	= $date;
        	$jurnal->account 	= $da->id;
        	$jurnal->kantor 	= 1;
        	$jurnal->keterangan = $faker->name;
        	$jurnal->tambahan 	= $faker->name;
        	if(substr($da->kode, 0, 1) == "1"){
	        	$jurnal->debet 		= $faker->numberBetween(10000, 1000000);
	        	$jurnal->kredit 	= 0;
        	}
        	else if(substr($da->kode, 0, 1) == "5"){
        		$jurnal->debet 	= 0;
        		$jurnal->kredit = $faker->numberBetween(10000, 100000);
        	}
        	else{
        		$jurnal->debet = $faker->numberBetween(100000, 1000000);
        		$jurnal->kredit = $faker->numberBetween(0, 10000);
        	}
        	$jurnal->save();
        }
    }
}
