<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request as R2;
use Request;
use Session;
use Response;

use App\User;
use App\Truck;
use App\AntrianTruck;
use App\MuatDetail;
use App\Muat;
use App\Transit;
use App\Penjualan;
use App\Cabang;
use Auth;


use App;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;

class TruckController extends Controller
{
    //
	public function index(){
    	return view("Truck.index");
    }

    public function add(){
		    $no_polisi 	 	= Request::input("no_polisi");
      	$nama_truck = Request::input("nm_truck");
      	$grup  			= Request::input("grup");	
        $cabang     = Request::input("cabang");

      	$truck 			= new Truck();
      	$truck->no_polisi 	   = $no_polisi;
      	$truck->nama_truck 	   = $nama_truck;
        $truck->grup           = $grup;
      	$truck->cabang 			   = $cabang;
      	$truck->save();

      	$message	=["success" => "Berhasil menambah truck"];
      	Session::flash("message", $message);
      	return redirect("truck");
   
    }

    public function edit($id){
      	$truck 	= Truck::where("id","=",$id)->first();

      	return view("Truck.edit")->with(["truck" => $truck]);
    }

    public function antrian_truck(){
    	$truck = Truck::with("s_cabang");
      if(!Auth::user()->hasRole("admin")){
        $truck->where("cabang","=",Auth::user()->cabang);
      }

    	return view("Truck.antrian_truck")->with("truck", $truck->get());
    }

    public function antrian_add(){
        $truck        = Request::input("truck");
        $supir        = Request::input("nm_supir");
        $notelpsupir  = Request::input("notelp_supir");
        $kernet       = Request::input("nm_kernet");
        $notelpkernet = Request::input("notelp_kernet");
        $cabang       = Request::input("cabang");

        $antrian                  = new AntrianTruck();
        $antrian->truck           = $truck;
        $antrian->supir           = $supir;
        $antrian->no_telp_supir   = $notelpsupir; 
        $antrian->kernet          = $kernet;
        $antrian->cabang          = $cabang;
        $antrian->no_telp_kernet  = $notelpkernet;

        $antrian->save();

        $message = ["success" => "Berhasil menambahkan antrian truck"];
        Session::flash("message", $message);

        return redirect("truck/antrian_truck");
    }

    public function ectedit($id){
	  	
	  	  $no_polisi 	 	= Request::input("no_polisi");
      	$nama_truck = Request::input("nm_truck");
        $grup       = Request::input("grup"); 
      	$cabang  			= Request::input("cabang");	

      	$truck 	= Truck::find($id);
      	$truck->no_polisi 		= $no_polisi;
      	$truck->nama_truck 	= $nama_truck;
        $truck->grup      = $grup;
      	$truck->cabang 			= $cabang;
      	$truck->save();

      	$message	=["info" => "Berhasil mengubah data truck"];
      	Session::flash("message", $message);
      	return redirect("truck");
      }


      public function orgdata(){
        $key        = Request::input("key");
        $hal        = Request::input("hal");
        $orderby    = Request::input("orderby");
        $ascdsc     = Request::input("ascdsc");
        $limit      = Request::input("limit");

        $p = $hal - 1;
        $pl = $limit;
        $p = $p * $pl;

        $first = 0;

        if($key != ""){
              $exkey      = explode(";", $key);
              if(count($exkey) > 1){
                    foreach($exkey as $i => $k){
                        if($first == 0){
                          $truck = Truck::where("no_polisi","LIKE","%$k%");
                          $first = 1;
                        }
                        else{
                          $truck->where("no_polisi","LIKE","%$k%");
                        }
                          $truck->orWhere("nama_truck","LIKE","%$k%");
                          $truck->orWhere("grup","LIKE","%$k%");
                          $truck->orWhere("no_polisi","LIKE","%$k%");
                    }
              }
              else{
                    $truck = Truck::where("no_polisi","LIKE","%$key%");
                    $truck->orWhere("nama_truck","LIKE","%$key%");
                    $truck->orWhere("grup","LIKE","%$key%");
                    $truck->orWhere("no_polisi","LIKE","%$key%");
              }
          $count      = $truck->count();
        }
        else{
          $truck2   = Truck::with("s_cabang");
          if(!Auth::user()->hasRole("admin")){
            $in_temp  = [];
            foreach($truck2->get() as $t){
              if($t->cabang == Auth::user()->cabang){
                $in_temp[] = $t->id;
              }
            }
            $truck2->whereIn("id", $in_temp);
          }
          $count = $truck2->count();
        }


        if($orderby != ""){
              if($key != ""){
                $truck->orderBy($orderby, $ascdsc);
                $fordata  = $truck->take($pl)->skip($p)->get();
              }
              else{
                $truck2   = Truck::with("s_cabang");
                if(!Auth::user()->hasRole("admin")){
                  $in_temp  = [];
                  foreach($truck2->get() as $t){
                    if($t->cabang == Auth::user()->cabang){
                      $in_temp[] = $t->id;
                    }
                  }
                  $truck2->whereIn("id", $in_temp);
                }
                $truck = $truck2->orderBy($orderby, $ascdsc);
                $fordata  = $truck2->take($pl)->skip($p)->get();
              }
        }
        else{
          $fordata  = $truck2->take($pl)->skip($p)->get();
        }

        // if($key != ""){
        //   $fordata  = $truck->take($pl)->skip($p)->get();
        // }
        // else{
        //   $truck2   = Truck::with("s_cabang");
        //   if(!Auth::user()->hasRole("admin")){
        //     $in_temp  = [];
        //     foreach($truck2->get() as $t){
        //       if($t->cabang == Auth::user()->cabang){
        //         $in_temp[] = $t->id;
        //       }
        //     }
        //     $truck2->whereIn("id", $in_temp);
        //   }
        //   $fordata  = $truck2->take($pl)->skip($p)->get();
        // }


        // dd($key,$truck->take($pl)->skip($p)->get());

        $data       = [
              "success" => 1,
              "data" => $fordata,
              "count" => $count
        ];

        return Response::json($data);
      }

      public function orgdataantrian(){
            $key        = Request::input("key");
            $hal        = Request::input("hal");
            $orderby    = Request::input("orderby");
            $ascdsc     = Request::input("ascdsc");
            $limit      = Request::input("limit");

            $p = $hal - 1;
            $pl = $limit;
            $p = $p * $pl;

            
            $antrian  = AntrianTruck::with("s_truck", "s_muat");
            if(!Auth::user()->hasRole("admin")){
              $antrian->where("cabang","=", Auth::user()->cabang);
            }

            if($key != ""){
                  $exkey      = explode(";", $key);
                  if(count($exkey) > 1){
                        foreach($exkey as $i => $k){
                              $antrian->where("supir","LIKE","%$k%");
                              $antrian->orWhere("no_telp_supir","LIKE","%$k%");
                              $antrian->orWhere("kernet","LIKE","%$k%");
                              $antrian->orWhere("no_telp_kernet","LIKE","%$k%");

                              $rtruck   = Truck::where("nama_truck", "LIKE", "%$k%")->get();
                              foreach($rtruck as $rt){
                                $antrian->orWhere("truck", "=", $rt["id"]);
                              }
                        }
                  }
                  else{
                        $antrian->where("supir","LIKE","%$key%");
                        $antrian->orWhere("no_telp_supir","LIKE","%$key%");
                        $antrian->orWhere("kernet","LIKE","%$key%");
                        $antrian->orWhere("no_telp_kernet","LIKE","%$key%");

                        $rtruck   = Truck::where("nama_truck", "LIKE", "%$key%")->get();
                        foreach($rtruck as $rt){
                          $antrian->orWhere("truck", "=", $rt["id"]);
                        }
                  }


            }

            $count      = $antrian->count();

            if($orderby != ""){
                  $antrian->orderBy($orderby, $ascdsc);
            }


            $fordata  = $antrian->take($pl)->skip($p)->get();
            foreach($fordata as $fd){
              $check_muat   = Muat::where("antrian_truck","=",$fd->id)->count();
              if($check_muat > 0){
                $fd->hasMuat = 1;
              }
              else{
                $fd->hasMuat = 0;
              }
            }
            // dd($key,$antrian->take($pl)->skip($p)->get());

            $data       = [
                  "success" => 1,
                  "data" => $fordata,
                  "count" => $count
            ];

            return Response::json($data);
      }

      public function antrian_add_muat($id){
          $antrian  = AntrianTruck::with("s_truck")->find($id);

          $temp     = [];
          $mdetail     = MuatDetail::all();
          foreach($mdetail as $md){
            $temp[] = $md->stt;
          }

          $penjualan      = Penjualan::with("s_kantor_asal", "s_kantor_tujuan", "s_user", "s_cabang")->whereNotIn("stt", $temp)->whereNotNull("user")->get();

          $data_transit  = Transit::all();
          foreach($data_transit as $dt){
            $count_finish = 0;
            $transit  = $dt["transit"];
            $ex       = explode("-", $transit);
            foreach($ex as $i => $e){
              $trex = explode("_", $e);
              $kd_cabang = intval($trex[0]);
              $transit_status = intval($trex[1]);
              if($transit_status == 0){
                if(Auth::user()->hasRole("admin") || Auth::user()->cabang == $kd_cabang){
                  $timpa  = true;
                  $data_penjualan   = Penjualan::find($dt["penjualan"]);
                  foreach($penjualan as $p){
                    if($p["id"] == $dt["penjualan"]){
                      $timpa = false;
                    }
                  }

                  if($timpa){
                    $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
                  }

                  break;
                }
              }
              $count_finish++;
            }
            if($count_finish == count($ex)){
              $penjualan_data = Penjualan::find($dt["penjualan"]);
              $muat_transit   = MuatDetail::where("stt","=",$penjualan_data->stt)->get();

              $count_transit_muat   = count($muat_transit);

              $must   = count($ex) + 1;

              if($count_transit_muat < $must){
                $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
              }

            }
          }

          return view("Truck.antrian_truck_muat")->with(["antrian" => $antrian, "penjualan" => $penjualan]);
      }

      public function generate_kode_muat($cabang){
        $data_cabang  = Cabang::find($cabang);
        $kd_cabang    = $data_cabang->kode_cabang;
        $muat_before  = Muat::where("cabang","=",$cabang);

        if($muat_before->count() > 0){
          $data_muat_before   = $muat_before->orderBy("id", "DESC")->first();
          $kode_muat_before   = $data_muat_before["kode_muat"];
          $strlen_kode  = strlen($kd_cabang) + 1;
          $hitungan   = intval(substr($kode_muat_before, $strlen_kode));


          $new_hitungan   = $hitungan + 1;

          $strlen_new_hitungan  = strlen($new_hitungan."");

          $forloop = 4 - $strlen_new_hitungan;
          $kd_temp   = "";
          if($forloop > 0){
            for($a = 1; $a <= $forloop; $a++){
              $kd_temp .= "0";
            }
            $new_kode_muat = $kd_cabang."B".$kd_temp."".$new_hitungan;
          }
          else{
            $new_kode_muat = $kd_cabang."B".$new_hitungan;
          }
        }
        else{
          $new_kode_muat  = $kd_cabang."B"."0001";
        }


        return $new_kode_muat;
      }

      public function exec_antrian_add_muat($id){
        $stt              = Request::input("stt");
        $waktu_berangkat  = Request::input("waktu_berangkat");
        $cabang           = Request::input("cabang");
        $cabang_tujuan           = Request::input("cabang_tujuan");

        $muat             = new Muat();

        $muat->antrian_truck  = $id;
        $muat->waktu_berangkat  = $waktu_berangkat;
        $muat->checker      = Auth::user()->id;
        $muat->cabang      = $cabang;
        $muat->cabang_tujuan      = $cabang_tujuan;
        $muat->kode_muat      = self::generate_kode_muat($cabang);

        $muat->save();

        $last_muat    = Muat::orderBy("id", "DESC")->first();
        $idm       = $last_muat->id;
        foreach($stt as $s){

          // cek stt transit ?
          $penjualan  = Penjualan::where("stt","=",$s)->first();
          $penjualan_id   = $penjualan["id"];

          $transit  = Transit::where("penjualan", "=", $penjualan_id);

          if($transit->count() > 0){
           $dt       = $transit->first();
           $transit  = $dt["transit"];
           $ex       = explode("-", $transit);
           foreach($ex as $i => $e){
             $trex = explode("_", $e);
             $kd_cabang = intval($trex[0]);
             $transit_status = intval($trex[1]);
             if($transit_status == 0){
               if(Auth::user()->hasRole("admin") || Auth::user()->cabang == $kd_cabang){
                 // $penjualan[] = Penjualan::with("s_kantor_asal","s_kantor_tujuan")->find($dt["penjualan"]);
                  $ex[$i] = $kd_cabang."_2";

                  $new_data                 = implode("-", $ex);
                  $updated_transit          = Transit::find($dt["id"]);
                  $updated_transit->transit = $new_data;
                  $updated_transit->save();
                 break;
               }
             }
           } 
          }


                $muatdetail           = new MuatDetail();
                $muatdetail->stt      = $s;
                $muatdetail->id_muat  = $idm;
                $muatdetail->status   = 0;
                $muatdetail->save();
        }

        $message  = ["success" => "Berhasil menambahkan muat"];
        Session::flash("message", $message);
        return redirect("/truck/antrian_truck");
      }

      public function export_excel(){
          $excel = App::make('excel');
          Excel::create('Truck', function($excel) {

              $excel->sheet('1', function($sheet) {
                  $truck     = Truck::all();
                  $sheet->loadView('truck.excel')->with("truck", $truck);
              });

          })->download('xls');
      }

      public function antrian_export_excel(){
          $excel = App::make('excel');
          Excel::create('Antrian Truck', function($excel) {

              $excel->sheet('1', function($sheet) {
                  $antrian     = AntrianTruck::with("s_truck")->get();
                  $sheet->loadView('truck.antrianexcel')->with("antrian", $antrian);
              });

          })->download('xls');
      }

      public function printkbh($id){
        $data_truck   = Truck::with("s_cabang")->find($id);
        $antrian_truck = AntrianTruck::with("s_muat","s_truck")->where("truck","=",$id)->get();
        $pdf = PDF::loadView('Truck.printkbh', ["data_truck" => $data_truck, "antrian_truck" => $antrian_truck])->setPaper('a4', 'landscape');

        return $pdf->stream();
      }
}
