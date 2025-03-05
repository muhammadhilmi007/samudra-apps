<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get("/login", function(){
	return redirect("/");
});

Route::get("/logout", function(){
	Auth::logout();

	return redirect("/");
});

// Route::post("/login", "UserController@login");
Route::group(["middleware" => "auth"], function(){
	Route::get('/dashboard', "HomeController@dashboard");
	Route::group(["prefix" => "admin"], function(){

		// role group
		Route::group(["prefix" => "role"], function(){
			Route::get("/", "AdminController@role");
			Route::get("/export/excel", "AdminController@export_excel");
			Route::post("/add", "AdminController@role_add");
			Route::post("/checkname", "AdminController@role_checkname");
			Route::post("/{id}", "AdminController@getRoleById");
			Route::post("/{id}/edit", "AdminController@role_edit");

		});

		// permission group
		Route::group(["prefix" => "permission"], function(){
			Route::get("/", "AdminController@permission");
			Route::get("/export/excel", "AdminController@permission_export_excel");
			Route::post("/add", "AdminController@permission_add");
			Route::post("/checkname", "AdminController@permission_checkname");
			Route::post("/actroleperm", "AdminController@actroleperm");
		});

		// user group
		Route::group(["prefix" => "user"], function(){
			Route::get("/", "AdminController@user");
			Route::get("/export/excel", "AdminController@user_export_excel");
			Route::post("/add", "AdminController@user_add");
			Route::post("/checkemail", "AdminController@user_checkemail");
			Route::post("/checkpassword", "UserController@user_checkpassword");
			Route::post("/manualeditpassword", "UserController@manualeditpassword");
			Route::post('/{id}', "UserController@getUserById");
			Route::post('/{id}/edit', "UserController@edit_user");
		});
	});

	Route::group(["prefix" => "divisi"], function(){
		Route::get("/", "DivisiController@index");
		Route::get("/export/excel", "DivisiController@export_excel");
		Route::post("/add", "DivisiController@add");
		Route::post("/{id}", "DivisiController@getDivisiById");
		Route::post("/{id}/edit", "DivisiController@edit");
	});

	Route::group(["prefix" => "cabang"], function(){
		Route::get("/", "CabangController@index");
		Route::post("/add", "CabangController@add");
		Route::get("/export/excel", "CabangController@export_excel");
		Route::post("/{id}", "CabangController@getCabangById");
		Route::post("/{id}/edit", "CabangController@edit");
	});

	// penjualan group
	Route::group(["prefix" => "penjualan"], function(){
		Route::get("/", "PenjualanController@index");
		Route::get("/export/excel", "PenjualanController@export_excel");
		Route::get("/add", "PenjualanController@add");
		Route::post("/add", "PenjualanController@manualadd");
		Route::post("/getbystt", "PenjualanController@getByStt");
		Route::post("/list", "PenjualanController@penjualan_list");
		Route::post("/orgdata", "PenjualanController@orgdata");
		Route::post("/orgdata/filter/pengirim", "PenjualanController@filterpengirim");
		Route::post("/orgdata/filter/penerima", "PenjualanController@filterpenerima");
		Route::post("/orgdata/filter/alamat", "PenjualanController@filteralamat");
		Route::get("/{id}", "PenjualanController@detail");
		Route::get("/{id}/edit", "PenjualanController@edit");
		Route::post("/{id}/edit", "PenjualanController@actedit");
		Route::get("/{stt}/print", "PenjualanController@printpenjualan");
		Route::get("/{stt}/print/penjualan", "PenjualanController@printdetailpenjualan");
		Route::get("/print/tugas/tagihan","PenjualanController@printtugastagihan");
	});
	
	// kendaraan group
	Route::group(["prefix" => "kendaraan"], function(){
		Route::get("/", "KendaraanController@index");
		Route::post("/add", "KendaraanController@add");
		Route::get("/export/excel", "KendaraanController@export_excel");
		Route::post("/orgdata", "KendaraanController@orgdata");
		Route::group(["prefix" => "antrian_kendaraan"], function(){
			Route::get("/", "KendaraanController@antrian_kendaraan");
			Route::post("/", "KendaraanController@addantrian");
			Route::get("/export/excel", "KendaraanController@antrian_export_excel");
			Route::post("/orgdata", "KendaraanController@antrian_orgdata");
			Route::get("/{id}/muat", "KendaraanController@antrian_add_muat");
			Route::post("/{id}/muat", "KendaraanController@exec_antrian_add_muat");
		});
		Route::get("/{id}/edit", "KendaraanController@edit");
		Route::post("/{id}/edit", "KendaraanController@actedit");

	});

	// truck group
	Route::group(["prefix" => "truck"], function(){
		Route::get("/", "TruckController@index");
		Route::get("/export/excel", "TruckController@export_excel");
		Route::post("/add", "TruckController@add");
		Route::post("/orgdata", "TruckController@orgdata");
		Route::group(["prefix" => "antrian_truck"], function(){
			Route::get("/", "TruckController@antrian_truck");
			Route::get("/export/excel", "TruckController@antrian_export_excel");
			Route::post("/add", "TruckController@antrian_add");
			Route::post("/orgdata", "TruckController@orgdataantrian");
			Route::get("/{id}/muat", "TruckController@antrian_add_muat");
			Route::post("/{id}/muat", "TruckController@exec_antrian_add_muat");
		});
		Route::get("/{id}/edit", "TruckController@edit");
		Route::get("/{id}/printkbh", "TruckController@printkbh");
		Route::post("/{id}/edit", "TruckController@actedit");
	});

	Route::group(["prefix" => "req_pengambilan_barang"], function(){
		Route::get("/", "ReqPengambilanBarangController@request");
		Route::post("/add", "ReqPengambilanBarangController@actrequest");
		Route::get("/{id}/setdone", "ReqPengambilanBarangController@setdone");
	});

	Route::group(["prefix" => "pengambilan_barang"], function(){
		Route::get("/", "PengambilanBarangController@index");
		Route::post("/add", "PengambilanBarangController@add");
	});

	Route::group(["prefix" => "muat"], function(){
		Route::get("/", "MuatController@index");
		Route::post("/add", "MuatController@add");
		Route::post("/orgdata", "MuatController@orgdata");
		Route::get("/export/excel", "MuatController@export_excel");
		Route::get("/{id}", "MuatController@detail");
		Route::get("/{id}/print", "MuatController@print_detail");
		Route::post("/{id}/setsampai", "MuatController@setsampai");
		Route::post("/{id}/stt/{stt}/setstat", "MuatController@setstatstt");
	});

	Route::group(["prefix" => "lansir"], function(){
		Route::get("/", "LansirController@index");
		Route::post("/add", "LansirController@add");
		Route::post("/orgdata", "LansirController@orgdata");
		Route::get("/export/excel", "LansirController@export_excel");
		Route::get("/{id}", "LansirController@detail");
		Route::get("/{id}/print", "LansirController@print_detail");
		Route::post("/{id}/setsampai", "LansirController@setsampai");
		Route::post("/{id}/stt/{stt}/setstat", "LansirController@setstatstt");
	});

	Route::group(["prefix" => "retur"], function(){
		Route::get("/", "ReturController@index");
		Route::get("/kirim", "ReturController@kirim");
		Route::post("/kirim", "ReturController@actkirim");
		Route::get("/terima", "ReturController@terima");
		Route::post("/terima", "ReturController@actterima");
		Route::post("/orgdata", "ReturController@orgdata");
		Route::get("/print", "ReturController@print_retur");
	});


	Route::group(["prefix" => "overdue"], function(){
		Route::get("/", "OverdueController@index");
		Route::get("/invoice/{pengirim}/{range}", "OverdueController@print_invoice");
		Route::post("/orgdata", "OverdueController@orgdata");
		Route::get("/{id}", "OverdueController@detail");
		Route::post("/{id}", "OverdueController@adddetail");
		Route::get("/{id}/actcash", "OverdueController@actcash");
	});

	Route::group(["prefix" => "penagihan"], function(){
		Route::get("/", "PenagihanController@index");
		Route::post("/add", "PenagihanController@add");
		Route::post("/actlunas", "PenagihanController@actlunas");
	});

	Route::group(["prefix" => "account"], function(){
		Route::get("/", "AccountController@index");
		Route::get("/neraca", "AccountController@neraca");
		Route::post("/neraca/get", "AccountController@neraca_get");
		Route::post("/neraca/print", "AccountController@neraca_print");
		Route::get("/get/acc", "AccountController@get_acc");
		Route::group(["prefix" => "jurnal_umum"], function(){
			Route::get("/", "JurnalController@umum");
			Route::post("/exec", "JurnalController@umum_exec");
			Route::post("/delete", "JurnalController@umum_delete");
			Route::post("/get", "JurnalController@umum_get");
		});
		Route::group(["prefix" => "kaskecil"], function(){
			Route::get("/", "KasController@kecil");
			Route::post("/exec", "KasController@kecil_exec");
			Route::post("/delete", "KasController@kecil_delete");
			Route::post("/get", "KasController@kecil_get");
		});
		Route::group(["prefix" => "kasbantuan"], function(){
			Route::get("/", "KasController@bantuan");
			Route::post("/exec", "KasController@bantuan_exec");
			Route::post("/delete", "KasController@bantuan_delete");
			Route::post("/get", "KasController@bantuan_get");
		});
		Route::group(["prefix" => "labarugi"], function(){
			Route::get("/", "AccountController@indexLabaRugi");
			Route::post("/get", "AccountController@getLabaRugi");
			Route::post("/printlabarugi", "AccountController@printLabaRugi");

		});
		Route::post("/add", "AccountController@add");
		Route::post("/{id}", "AccountController@find_by_id");
		Route::post("/{id}/edit", "AccountController@edit");
	});
	//Route::group(["prefix"=> "tugas_tagihan"], function(){
		//Route::get("/print","PenjualanController@printtugastagihan");
	//});
	Route::get('/print/tugas/tagihan', 'HomeController@printtugastagihan');
	Route::get('/print/invoice/perpelanggan', 'HomeController@printinvoiceperpelanggan');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

