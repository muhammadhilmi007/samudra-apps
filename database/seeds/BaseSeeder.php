<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Divisi;
use App\Cabang;
use App\Role;
use App\Permission;
use App\Account;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$arr_div 	= ["Samudera Jaya Abadi", "Samudera Atlantik"];

    	foreach($arr_div as $div){
    		$divisi 	= new Divisi();
    		$divisi->nama_divisi = $div;

    		$divisi->save();
    	}

    	$arr_cab 	= [
    		"BDG1" => "Bandung 1",
    		"BDG2" => "Bandung 2",
    		"BDG3" => "Bandung 3",
    		"KAL1" => "Kalimantan 1",
    		"KAL2" => "Kalimantan 2",
    	];

    	$div_cab  	= [1,1,1,2,2];
    	$no_cab 	= 0;
    	foreach($arr_cab as $kd => $nm){
    		$cabang 	= new Cabang();
    		$cabang->kode_cabang 	= $kd;
    		$cabang->nama_cabang 	= $nm;
    		$cabang->divisi 		= $div_cab[$no_cab];
            $cabang->utama          = 0;
            $cabang->lat_coord      = "-6.870978788759881";
    		$cabang->long_coord		= "107.57213680043697";
        	$cabang->save();

        	$no_cab++;
    	}

    	$arr_user = [
    		[
    			"name" => "Septia Permana",
    			"email" => "septiapermana@gmail.com",
    			"password" => "asepnuryana",
    			"cabang" => 1
    		],
    		[
    			"name" => "Sani Sahidah",
    			"email" => "sani.sahidah@gmail.com",
    			"password" => "sanisa",
    			"cabang" => 1
    		],
    		[
    			"name" => "Delly Fathurachman",
    			"email" => "dellyarts@gmail.com",
    			"password" => "dellyarts",
    			"cabang" => 4
    		],
            [
                "name" => "Supir 1",
                "email" => "supir1@gmail.com",
                "password" => "supir1",
                "cabang" => 1
            ],
            [
                "name" => "supir2",
                "email" => "supir2@gmail.com",
                "password" => "supir2",
                "cabang" => 1
            ],
            [
                "name" => "kernet1",
                "email" => "kernet1@gmail.com",
                "password" => "kernet1",
                "cabang" => 1
            ],
            [
                "name" => "kernet2",
                "email" => "kernet2@gmail.com",
                "password" => "kernet2",
                "cabang" => 1
            ],
    	];

    	foreach($arr_user as $us){
	        $user 	= new User();
	        $user->name 	= $us["name"];
	        $user->email 	= $us["email"];
	        $user->password = \Hash::make($us["password"]);
	        $user->cabang 	= $us["cabang"];

	        $user->save();
    	}

    	$arr_role = [
    		[
	    		"name" => "admin",
	    		"display_name" => "Administrator",
	    		"description" => "Akses dan manage semua fitur"
    		],
    		[
	    		"name" => "direktur_utama",
	    		"display_name" => "Direktur Utama",
	    		"description" => "Lihat Semua Fitur"
    		],
    		[
	    		"name" => "manager_administrasi_dan_keuangan",
	    		"display_name" => "Manager Administrasi dan Keuangan",
	    		"description" => "Akses Semua Fitur"
    		],
    		[
	    		"name" => "manager_marketing",
	    		"display_name" => "Manager Marketing",
	    		"description" => "Lihat Semua Fitur"
    		],
    		[
	    		"name" => "manager_operasional",
	    		"display_name" => "Manager Operasional",
	    		"description" => "Lihat Semua Fitur"
    		],
    		[
	    		"name" => "manager_personalia",
	    		"display_name" => "Manager Personalia (HRD)",
	    		"description" => "Lihat Semua Fitur dan Akses Data Karyawan"
    		],
    		[
	    		"name" => "staff_admin_pusat",
	    		"display_name" => "Staff Admin Pusat",
	    		"description" => "Akses Semua Fitur Kecuali ..."
    		],
    		[
	    		"name" => "kepala_cabang",
	    		"display_name" => "Kepala Cabang",
	    		"description" => "Lihat Semua Fitur Cabang"
    		],
    		[
	    		"name" => "kepala_cabang_plus_staff_administrasi",
	    		"display_name" => "Kepala Cabang + Staff Administrasi",
	    		"description" => "Akses Semua Fitur Cabang"
    		],
    		[
	    		"name" => "kepala_gudang",
	    		"display_name" => "Kepala Gudang",
	    		"description" => "Akses Semua Fitur Gudang"
    		],
    		[
	    		"name" => "checker",
	    		"display_name" => "Checker",
	    		"description" => "Akses Semua Fitur Gudang"
    		],
    		[
	    		"name" => "staff_administrasi",
	    		"display_name" => "Staff Administrasi",
	    		"description" => "Akses Semua Fitur Cabang"
    		],
    		[
	    		"name" => "staff_administrasi_2",
	    		"display_name" => "Staff Administrasi 2",
	    		"description" => "Akses Semua Fitur Cabang (Penjualan Saja)"
    		],
    		[
	    		"name" => "staff_penjualan",
	    		"display_name" => "Staff Penjualan",
	    		"description" => "Akses Semua Fitur Penjualan (Resi Saja dan Omzet)"
    		],
    		[
	    		"name" => "cashier",
	    		"display_name" => "Cashier",
	    		"description" => "Buat Jurnal Umum"
    		],
    		[
	    		"name" => "customer_service",
	    		"display_name" => "Customer Service",
	    		"description" => "Tracking, Bikin Order Pickup Barang"
    		],
    		[
	    		"name" => "cashier_plus_customer_service",
	    		"display_name" => "Cashier + Customer Service",
	    		"description" => "Buat Jurnal Umum + Tracking, Bikin Order Pickup Barang"
    		],
    		[
	    		"name" => "debt_collector",
	    		"display_name" => "Debt Collector",
	    		"description" => "Buat Data Piutang"
    		],
    		[
	    		"name" => "supir",
	    		"display_name" => "Supir",
	    		"description" => "Supir"
    		],
    		[
	    		"name" => "kernet",
	    		"display_name" => "Kernet",
	    		"description" => "Kernet"
    		],
    		[
	    		"name" => "tim_bongkar_muat",
	    		"display_name" => "Tim Bongkar Muat",
	    		"description" => "Tim Bongkar Muat"
    		],
    	];

    	foreach($arr_role as $r){
	    	$role 	= new Role();
	    	$role->name 		= $r["name"];
	    	$role->display_name	= $r["display_name"];
	    	$role->description 	= $r["description"];

	    	$role->save();
    	}

    	$arr_perm 	= [
    		[
    			"name" => "administrator",
    			"display_name" => "Administrator",
    			"description" => "Mengakses fitur administrator dan Mengakses semua fitur"
    		],
    		[
    			"name" => "divisi:create",
    			"display_name" => "Create Divisi",
    			"description" => "Membuat Divisi"
    		],
    		[
    			"name" => "divisi:read",
    			"display_name" => "Read Divisi",
    			"description" => "Melihat Divisi"
    		],
    		[
    			"name" => "divisi:update",
    			"display_name" => "Update Divisi",
    			"description" => "Mengubah Divisi"
    		],
    		[
    			"name" => "divisi:delete",
    			"display_name" => "Delete Divisi",
    			"description" => "Menghapus Divisi"
    		],
    		[
    			"name" => "cabang:create",
    			"display_name" => "Create Cabang",
    			"description" => "Membuat Cabang"
    		],
    		[
    			"name" => "cabang:read",
    			"display_name" => "Read Cabang",
    			"description" => "Melihat Cabang"
    		],
    		[
    			"name" => "cabang:update",
    			"display_name" => "Update Cabang",
    			"description" => "Mengubah Cabang"
    		],
    		[
    			"name" => "cabang:delete",
    			"display_name" => "Delete Cabang",
    			"description" => "Menghapus Cabang"
    		],
    		[
    			"name" => "kendaraan:create",
    			"display_name" => "Create Kendaraan",
    			"description" => "Membuat Kendaraan"
    		],
    		[
    			"name" => "kendaraan:read",
    			"display_name" => "Read Kendaraan",
    			"description" => "Melihat Kendaraan"
    		],
    		[
    			"name" => "kendaraan:update",
    			"display_name" => "Update Kendaraan",
    			"description" => "Mengubah Kendaraan"
    		],
    		[
    			"name" => "kendaraan:delete",
    			"display_name" => "Delete Kendaraan",
    			"description" => "Menghapus Kendaraan"
    		],
    		[
    			"name" => "truck:create",
    			"display_name" => "Create Truck",
    			"description" => "Membuat Truck"
    		],
    		[
    			"name" => "truck:read",
    			"display_name" => "Read Truck",
    			"description" => "Melihat Truck"
    		],
    		[
    			"name" => "truck:update",
    			"display_name" => "Update Truck",
    			"description" => "Mengubah Truck"
    		],
    		[
    			"name" => "truck:delete",
    			"display_name" => "Delete Truck",
    			"description" => "Menghapus Truck"
    		],
            [
                "name" => "penjualan:create",
                "display_name" => "Create Penjualan",
                "description" => "Menambah Penjualan"
            ],
            [
                "name" => "penjualan:read",
                "display_name" => "Read Penjualan",
                "description" => "Melihat Penjualan"
            ],
            [
                "name" => "penjualan:update",
                "display_name" => "Update Penjualan",
                "description" => "Mengubah Penjualan"
            ],
            [
                "name" => "penjualan:delete",
                "display_name" => "Delete Penjualan",
                "description" => "Menghapus Penjualan"
            ],
            [
                "name" => "req_pengambilan_barang:create",
                "display_name" => "Create Request Pengambilan Barang",
                "description" => "Membuat Request Pengambilan Barang"
            ],
            [
                "name" => "req_pengambilan_barang:read",
                "display_name" => "Read Request Pengambilan Barang",
                "description" => "Melihat Request Pengambilan Barang"
            ],
            [
                "name" => "req_pengambilan_barang:update",
                "display_name" => "Update Request Pengambilan Barang",
                "description" => "Mengubah Request Pengambilan Barang"
            ],
            [
                "name" => "req_pengambilan_barang:delete",
                "display_name" => "Delete Request Pengambilan Barang",
                "description" => "Menghapus Request Pengambilan Barang"
            ],
            [
                "name" => "pengambilan_barang:create",
                "display_name" => "Create Pengambilan Barang",
                "description" => "Membuat Pengambilan Barang"
            ],
            [
                "name" => "pengambilan_barang:read",
                "display_name" => "Read Pengambilan Barang",
                "description" => "Melihat Pengambilan Barang"
            ],
            [
                "name" => "pengambilan_barang:update",
                "display_name" => "Update Pengambilan Barang",
                "description" => "Mengubah Pengambilan Barang"
            ],
            [
                "name" => "pengambilan_barang:delete",
                "display_name" => "Delete Pengambilan Barang",
                "description" => "Menghapus Pengambilan Barang"
            ],
            [
                "name" => "muat:create",
                "display_name" => "Create Muat",
                "description" => "Membuat Muat"
            ],
            [
                "name" => "muat:read",
                "display_name" => "Read Muat",
                "description" => "Melihat Muat"
            ],
            [
                "name" => "muat:update",
                "display_name" => "Update Muat",
                "description" => "Mengubah Muat"
            ],
            [
                "name" => "muat:delete",
                "display_name" => "Delete Muat",
                "description" => "Menghapus Muat"
            ],
            [
                "name" => "lansir:create",
                "display_name" => "Create Lansir",
                "description" => "Membuat Lansir"
            ],
            [
                "name" => "lansir:read",
                "display_name" => "Read Lansir",
                "description" => "Melihat Lansir"
            ],
            [
                "name" => "lansir:update",
                "display_name" => "Update Lansir",
                "description" => "Mengubah Lansir"
            ],
            [
                "name" => "lansir:delete",
                "display_name" => "Delete Lansir",
                "description" => "Menghapus Lansir"
            ],
            [
                "name" => "retur:kirim",
                "display_name" => "Kirim Retur",
                "description" => "Kirim Retur"
            ],
            [
                "name" => "retur:terima",
                "display_name" => "Terima Retur",
                "description" => "Terima Retur"
            ],
            [
                "name" => "overdue:read",
                "display_name" => "Read Overdue",
                "description" => "Melihat Overdue"
            ],
            [
                "name" => "overdue:update",
                "display_name" => "Update Overdue",
                "description" => "Mengubah Overdue"
            ],
            [
                "name" => "penagihan:create",
                "display_name" => "Create Penagihan",
                "description" => "Membuat Penagihan"
            ],
            [
                "name" => "penagihan:read",
                "display_name" => "Read Penagihan",
                "description" => "Melihat Penagihan"
            ],
            [
                "name" => "penagihan:update",
                "display_name" => "Update Penagihan",
                "description" => "Mengubah Penagihan"
            ],
            [
                "name" => "penagihan:delete",
                "display_name" => "Delete Penagihan",
                "description" => "Menghapus Penagihan"
            ],
    	];

    	foreach($arr_perm as $ap){
			$permission   = new Permission();
			$permission->name         = $ap["name"];
			$permission->display_name = $ap["display_name"];
			$permission->description  = $ap["description"];

			$permission->save();    	
    	}

        $user   = User::find(1);
        $role   = Role::find(1);

        $user->attachRole($role);

        $user   = User::find(2);
        $role   = Role::find(1);

        $user->attachRole($role);

        $user   = User::find(3);
        $role   = Role::find(1);

        $user->attachRole($role);

        $user   = User::find(4);
        $role   = Role::find(19);

        $user->attachRole($role);

        $user   = User::find(5);
        $role   = Role::find(19);

        $user->attachRole($role);

        $user   = User::find(6);
        $role   = Role::find(20);

        $user->attachRole($role);

        $user   = User::find(7);
        $role   = Role::find(20);

        $user->attachRole($role);

        $all_role = Role::all();
        foreach($all_role as $role){
            $name = $role["name"];
            $display_name = $role["display_name"];
            $description = $role["description"];

            $user = new User();
            $user->name = $display_name;
            $user->email = str_replace("_","",$name)."@gmail.com";
            $user->password = \Hash::make(str_replace("_","",$name));
            $user->cabang = 1;
            $user->save();

            $last_user  = User::orderBy("id", "DESC")->first();

            $user   = User::find($last_user->id);
            $nrole  = Role::find($role["id"]);

            $user->attachRole($nrole);
            
        }

        $all_permission = Permission::all();
        foreach($all_permission as $permission){
            $admin_role     = Role::find(1);
            $perm           = $permission->id;
            $admin_role->attachPermission($perm);

            $admin_role     = Role::find(3);
            $perm           = $permission->id;
            $admin_role->attachPermission($perm);

            if($permission->id != 1){
                $ex_name    = explode(":",$permission->name);
                $fitur      = $ex_name[0];
                $can        = $ex_name[1];


                if($can == "read"){
                    $dirut_role     = Role::find(2);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);

                    $dirut_role     = Role::find(4);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);

                    $dirut_role     = Role::find(5);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);

                }

                if($fitur == "cabang"){
                    if($can == "read"){
                        $dirut_role     = Role::find(8);
                        $perm           = $permission->id;
                        $dirut_role->attachPermission($perm);
                    }
                    $dirut_role     = Role::find(9);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);

                    $dirut_role     = Role::find(10);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);

                    $dirut_role     = Role::find(11);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);
                    $dirut_role     = Role::find(12);
                    $perm           = $permission->id;
                    $dirut_role->attachPermission($perm);
                }
            }

        }

        $arr_account = [
            "111" => "Kas Di Tangan Pusat",
            "112" => "Kas Di Tangan Cabang Bandung",
            "1121" =>    "Kas Di Tangan Cabang Bandung2",
            "113" => "Kas Di Tangan Cabang Garut",
            "114" => "Kas Di Tangan Cabang Surabaya",
            "1141" =>    "Kas Di Tangan Cabang Solo",
            "1142" =>    "Kas Di Tangan Cabang Jogja",
            "1143" =>    "Kas Di Tangan Cabang Semarang",
            "1144" =>    "Kas Di Tangan Cabang Kudus",
            "115" => "Kas Di tangan Cabang Samarang",
            "116" => "Kas Cadangan",
            "117" => "Kas Di Bank Central Asia",
            "118" => "Bilyet Giro",
            "121" => "Piutang usaha",
            "122" => "Piutang Non Usaha",
            "123" => "Piutang Karyawan",
            "124" => "Piutang Untuk Penerus",
            "131" => "Sewa Bayar di Muka",
            "141" => "Tanah",
            "142" => "Kantor/Gudang",
            "143" => "Akumulasi Penyusutan Kantor/Gudang",
            "144" => "Meubel dan Alat Kantor",
            "145" => "Akumulasi Penyusutan Meubel dan Alat kantor",
            "146" => "Kendaraan",
            "147" => "Akumulasi Penyusutan Kendaraan",
            "211" => "Hutang Bank",
            "212" => "Hutang Bunga",
            "213" => "Hutang Non usaha",
            "214" => "Hutang Gaji",
            "215" => "Hutang Pajak",
            "311" => "Modal As'adi",
            "312" => "Modal Imarudin AP",
            "313" => "Modal Dadang Iskandar",
            "314" => "Modal Yusuf Rusmana",
            "315" => "Modal Rahmat",
            "316" => "Modal Fathi",
            "317" => "Modal Khadijah",
            "318" => "Historical Balance",
            "321" => "Prive As'adi",
            "322" => "Prive Imarudin AP",
            "323" => "Prive Dadang Iskandar",
            "324" => "Prive Yusuf Rusmana",
            "325" => "Prive Rahmat",
            "326" => "Prive Fathi",
            "327" => "Prive Khadijah",
            "331" => "Laba Tahun Berjalan",
            "332" => "Laba Dibagikan",
            "333" => "Laba Ditahan",
            "327" => "Prive Khadijah",
            "411" => "Penjualan",
            "421" => "Pendapatan Lain-lain",
            "431" => "Pendapatan Bunga",
            "511" => "Biaya Pot. Pendapatan Timbangan",
            "512" => "Biaya Pot. Pendapatan Komisi",
            "513" => "Biaya Pot. Pendapatan Diskon",
            "521" => "Biaya Sewa Kendaraan Antar Cabang",
            "522" => "Biaya Sewa Kendaraan Operasional",
            "523" => "Biaya Penerus",
            "524" => "Biaya BBM",
            "525" => "Biaya Gaji Karyawan",
            "526" => "Biaya Lembur Karyawan",
            "527" => "Biaya Bonus Karyawan",
            "528" => "Biaya Parkir",
            "529" => "Biaya Kuli",
            "530" => "Biaya keamanan",
            "531" => "Biaya Telepon",
            "532" => "Biaya Listrik dan Air",
            "533" => "Biaya Operasional Lain-Lain",
            "541" => "Biaya Penyusutan Kantor/Gudang",
            "542" => "Biaya Penyusutan Meubel dan Alat Kantor",
            "543" => "Biaya Penyusutan Kendaraan",
            "551" => "Biaya Pajak",
            "552" => "Biaya Bunga",
            "553" => "Biaya sewa Kantor/Gudang",
            "561" => "Biaya Tunjangan",
            "562" => "Biaya Dinas",
            "563" => "Biaya Administrasi",
            "564" => "Biaya Pemasaran",
            "565" => "Biaya Perlengkapan",
            "566" => "Biaya Pemeliharaan",
            "567" => "Biaya Piutang Tak Tertagih",
            "568" => "Biaya Klaim",
            "569" => "Biaya Kecelakaan",
            "570" => "Biaya Kerugian Atas Penjualan Aset",
            "571" => "Serba-Serbi",
        ];

        foreach($arr_account as $k => $v){
            $acc = new Account();
            $acc->kode = $k;
            $acc->nama_account = $v;
            $acc->cabang = 1;
            $acc->save();
        }
    }
}
