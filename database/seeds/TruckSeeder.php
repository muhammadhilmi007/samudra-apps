<?php

use Illuminate\Database\Seeder;

use App\Truck;
use App\Cabang;
use Faker\Factory as Faker;


class TruckSeeder extends Seeder
{
    function generateRandomString($length = 10) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function randomNumber($length) {
        $result = '';

        for($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }

        return $result;
    }

    public function nopol(){
    	$alphadigit 	= rand(1,2);

    	$alpha = self::generateRandomString($alphadigit);

    	$numberDigit = rand(1, 4);

    	$number = self::randomNumber($numberDigit);

    	$betadigit 	= rand(1,3);

    	$beta = self::generateRandomString($betadigit);

    	return $alpha." ".$number." ".$beta;
    }

    public function kgroup(){
    	$arr 	= ["Serba Guna", "Serba Guna Abadi", "Indah Sejahtera", "Bangun Tidur Terus Mandi"];
    	return $arr[rand(0,3)];
    }

    public function cabang(){
        $cabang     = Cabang::inRandomOrder()->first();

        return $cabang->id;
    }

    public function run()
    {
        $faker = Faker::create();

        for($a = 0; $a<100; $a++){
        	$truck 					= new Truck();
        	$truck->no_polisi 		= self::nopol();
            $truck->nama_truck      = $faker->name;
        	$truck->cabang  	= self::cabang();
        	$truck->grup 			= self::kgroup();

        	$truck->save();
        }


    }
}
