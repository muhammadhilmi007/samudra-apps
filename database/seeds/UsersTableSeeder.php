<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Divisi;
use App\Cabang;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $divisi 	= new Divisi();
        $divisi->nama_divisi = "Samudera Jaya Abadi";

        $divisi->save();

        $divisi 	= new Divisi();
        $divisi->nama_divisi = "Samudera Atlantik";

        $divisi->save();

        $cabang 	= new Cabang();
        $cabang->kode_cabang 	= "BGD1";
        $cabang->nama_cabang 	= "Bandung 1";
        $cabang->divisi 		= 1;
        $cabang->utama 			= 0;

        $cabang->save();

        $cabang 	= new Cabang();
        $cabang->kode_cabang 	= "BGD2";
        $cabang->nama_cabang 	= "Bandung 2";
        $cabang->divisi 		= 1;
        $cabang->utama 			= 0;

        $cabang->save();


        $cabang 	= new Cabang();
        $cabang->kode_cabang 	= "KAL1";
        $cabang->nama_cabang 	= "Kalimantan 1";
        $cabang->divisi 		= 2;
        $cabang->utama 			= 0;

        $cabang->save();

        $user 	= new User();
        $user->name 	= "Septia Permana";
        $user->email 	= "septiapermana@gmail.com";
        $user->password = \Hash::make("asepnuryana");
        $user->cabang 	= 1;

        $user->save();
    }
}
