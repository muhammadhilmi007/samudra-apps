<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> 
<style>
 @page {
             margin-top: 0.3em;
             margin-left: 0.6em;
             margin-right: 0.6em;
         }
 .container{
  width : 100%;
 }
 .row{
		width: 100%;
		/*height:210px;*/
		border: 12px solid #f08519;
		border-bottom: 2px solid #f08519 !important;
		border-top: 7px solid #f08519 !important;
		padding: 10px;
		padding-bottom: 15px;
	}
	.no{
		float: right;
		width: 30%;
		height: 3%;
		padding-top: 4px;
		padding-left: 4px;
		border: 2px solid #f08519;
	}	
 .left{
  float: left;
  width : 48%;
 }
 .right{
  float : left;
  width : 48%;
  margin-left: 30px;
 }
  .table-order{
                    display:table;
                    width:100%;
                    border-collapse: collapse;
                    margin: 2px;
                }
                .table-oreder tr{
                	display:table-cell;
                    padding:2px;
                    /*border: 1px solid grey;*/
                }
                .table-order td{
                    display:table-cell;
                    padding:4px;
                    /*border: 1px solid grey;*/
                    }
	.btn-info{
		background : #00C0EF;
	}
 .btn-info{
  background : #00C0EF;
 }
 .btn-success{
  background : #00A65A;
 }
 .btn-warning{
  background : #F39C12;
 }
</style>
<div class="container">
	<div class="row">	
		<p class="no">Penjualan</p>
		<p><strong>Samudera Paket</strong></p>
		<pre>Jasa Pengiriman Barang</pre>
		<div class="table-responsive">
            <table class='table text-left' style="font-size:8pt;" >
                <tr>
                    <td><b>Kantor :</b></td>
                </tr>
                <tr>    
                    <td>Bandung</td>
                    <td>: Jl. Holis No. 396 Telp. 085100831773 - 082217849198</td>
                    <td>Semarang</td>
                    <td>:Jl. Arteri Soekarno-Hatta Komp. PGS No. 10 Telp. 0851 0063 2981 - 0878 3213 3192</td>
                </tr>
                <tr>    
                    <td>Solo</td>
                    <td>: Jl. Kopen 482 Gg. Anggur 02/07 Ngadirejo, Kartosuro (Belakang SPBU     Jati Urip) Telp. 0877 2204 3431</td>
               		<td>Kudus</td>
                    <td>:Jl. Pattimura Kios Karang Pakis No. 18 Telp. 0852 9141 2250 - 0877 3100 9078</td>
                </tr>
                <tr>    
                    <td>Yogya</td>
                    <td>: Jl. Ring Road Selatan Padhokan Lor, Tirtonirmolo, Kasihan - Bantul Telp.0851 0213 7474</td>
                </tr>
             </table>
        </div>  
    </div>

    <div class="row">
    	<p><strong>Detail Penjualan</strong></p>
        <div class="left">
	     	<div class="table-responsive">
	            <table class='table-order' style="font-size:11pt;" >
	            <tr>
	              <td>STT</td>
			      <td style="width: 20px;">:</td>
			      <td>{{$data_penjualan->stt}}</td>
	            </tr>
	            <tr>
	              <td>Kantor Asal</td>
				  <td style="width: 20px;">:</td>
				  <td>{{$data_penjualan->s_kantor_asal->nama_cabang}}</td>
	            </tr>
	            <tr>
	              <td>Kantor Tujuan</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->s_kantor_tujuan->nama_cabang}}</td>
	            </tr>
	            <tr>
	              <td>Pengirim</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->pengirim}}</td>
	            </tr>
	             <tr>
	              <td>Penerima</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->penerima}}</td>
	            </tr>
	            <tr>
	              <td>Alamat Penerima</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->alamat_penerima}}</td>
	            </tr>
	             <tr>
	              <td>Penerus</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->penerus}}</td>
	            </tr>
	            <tr>
	              <td>Kode Penerus</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->kode_penerus}}</td>
	            </tr>
	            <tr>
	              <td>Keterangan Tambahan</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->ket_tambahan}}</td>
	            </tr>
	            <tr>
	              <td>Petugas</td>
	              
	              <td style="width: 20px;">:</td>
	              <td>{{$data_penjualan->s_user->name}}</td>
	            </tr>
	            </table>
	        </div>  
        </div> 
        <div class="right">
         <div class="table-responsive">
	       <table  style="font-size:11pt;" >
           <tr>
             <td>Nama Barang</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->nama_barang}}</td>
           </tr>
           <tr>
             <td>Tipe Payment</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->payment_type}}</td>
           </tr>
           <tr>
             <td>Jumlah Colly</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->jumlah_colly}}</td>
           </tr>
           <tr>
             <td>Packing</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->packing}}</td>
           </tr>
            <tr>
             <td>Berat</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->berat}}</td>
           </tr>
           <tr>
             <td>Jenis Harga</td>
             <td style="width: 20px;">:</td>
             <td>{{str_replace("_"," ",strtoupper($data_penjualan->jenis_harga))}}</td>
           </tr>
           @if($data_penjualan->jenis_harga == "volume_metric")
            <tr>
             <td>Panjang</td>
             <td style="width: 20px;">:</td>
             <td>{{explode("-", $data_penjualan->vmet)[0]}}</td>
            </tr>
            <tr>
             <td>Lebar</td>
             <td style="width: 20px;">:</td>
             <td>{{explode("-", $data_penjualan->vmet)[1]}}</td>
            </tr>
            <tr>
             <td>Tinggi</td>
             <td style="width: 20px;">:</td>
             <td>{{explode("-", $data_penjualan->vmet)[2]}}</td>
            </tr>
            <tr>
             <td>Volume (p x l x t)</td>
             <td style="width: 20px;">:</td>
             <td>{{explode("-", $data_penjualan->vmet)[3]}}</td>
            </tr>
           @endif
            <tr>
             <td>Harga/Satuan</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->harga_per_kilo}}</td>
           </tr>
           <tr>
             <td>Harga Total</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->harga_total}}</td>
           </tr>
           <tr>
             <td>Kontak Penerima</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->kontak_penerima}}</td>
           </tr>
           <tr>
             <td>Cabang</td>
             <td style="width: 20px;">:</td>
             <td>{{$data_penjualan->s_cabang->nama_cabang}}</td>
           </tr>
         </table>
        </div>
    </div>   
     <div style="clear: both;"></div>
</div>
<div class="row">
	<p><strong>Detail Muat</strong></p>
	<div class="">
		<div class="table-responsive">
			@if(!empty($data_penjualan->s_detail_muat))
			 @foreach($data_penjualan->s_detail_muat as $i => $v)
			 <div class="col-xs-12">
			     <table class="table-order">
			       <tr>
			       	 <td colspan="3"><b>Muat Ke {{$i + 1}}</b></td>
			       </tr>
			       <tr>
			         <td style="width:50%">Antrian Truck</td>
					 <td style="width: 20px">:</td>			       
			         <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->antrian_truck}}</td>
			       </tr>
			       <tr>
			         <td>Waktu Berangkat</td>
					 <td style="width: 20px">:</td>			       
			         <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->waktu_berangkat}}</td>
			       </tr>
			       <tr>
			         <td>Sampai</td>
					 <td style="width: 20px">:</td>			       
			         <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->sampai}}</td>
			       </tr>
			       <tr>
			         <td>Checker</td>
					 <td style="width: 20px">:</td>			       
			         <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->s_checker->name}}</td>
			       </tr>
			        <tr>
			         <td>Kode Muat</td>
					 <td style="width: 20px">:</td>			       
			         <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->kode_muat}}</td>
			       </tr>
			       <tr>
			         <td>Status</td>
			       	 <td style="width: 20px">:</td>
			         <td>
			          	@if($data_penjualan->s_detail_muat[$i]->status == 0)
			             <button class="btn btn-xs btn-info">On the Way</button>
					    @elseif($data_penjualan->s_detail_muat[$i]->status == 1)
					     <button class="btn btn-xs btn-success">Finish</button>
					    @else
					     <button class="btn btn-xs btn-warning">Pending</button>
					    @endif
			   		 </td>
			       </tr>
			     </table>
			 </div>
			 @endforeach
			@endif
		</div>
	</div>
	<div class="right"></div>
	<div style="clear:both;"></div>
</div>
<div class="row">
	<p><strong>Transit</strong></p>
	<div class="">
		<div class="table-responsive">
		  @if(!empty($transit))
		   @foreach($transit["transit_detail"] as $i => $t)
		    <div class="col-xs-12">
		     @if($t["transit_status"] == 0)
		     <div class="box box-info">
		     @elseif($t["transit_status"] == 1)
		     <div class="box box-success">
		     @else
		     <div class="box box-warning">
		     @endif
		         <div class="box-header witd-border">
		             <h3 class="box-title">Transit ke {{$i + 1}}</h3>
		         </div>
		            <div class="box-body">
		        <div class="col-xs-12">
		          <div class="table-responsive">
		            <table class="table">
		              <tr>
		                <td style="width:50%">Kode Cabang</td>
		                <td style="width: 20px;">:</td>
		                <td>{{$t["data_cabang"]->kode_cabang}}</td>
		              </tr>
		              <tr>
		                <td>Nama Cabang</td>
		                <td style="width: 20px;">:</td>
		                <td>{{$t["data_cabang"]->nama_cabang}}</td>
		              </tr>
		              <tr>
		                <td>Divisi</td>
		                <td style="width: 20px;">:</td>
		                <td>{{$t["data_cabang"]->s_divisi->nama_divisi}}</td>
		              </tr>
		              <tr>
		                <td>Status</td>
		                <td style="width: 20px;">:</td>
		                <td>
		                 @if($t["transit_status"] == 0)
		                  <button class="btn btn-xs btn-info">Registered</button>
				         @elseif($t["transit_status"] == 1)
				            <button class="btn btn-xs btn-success">Finish</button>
				         @else
				            <button class="btn btn-xs btn-warning">On the Way</button>
				         @endif
		          </td>
		              </tr>
		            </table>
		          </div>
		        </div>
		      </div>
		     </div>
		    </div>
		   @endforeach
		  @else
		  	Tidak ada transit
		  @endif
		</div>
	</div>
</div>
<div class="row">
	<p><strong>Detail Lansir</strong></p>
	<div class="">
		<div class="table-responsive">
		@if(!empty($data_penjualan->s_detail_lansir))
		    <table class="table">
		      <tr>
		        <td style="width:50%">Antrian Kendaraan</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->s_lansir->antrian_kendaraan}}</td>
		      </tr>
		      <tr>
		        <td>Waktu Berangkat</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->s_lansir->berangkat}}</td>
		      </tr>
		      <tr>
		        <td>Sampai</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->s_lansir->sampai}}</td>
		      </tr>
		      <tr>
		        <td>Checker</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->s_lansir->s_checker->name}}</td>
		      </tr>
		       <tr>
		        <td>Id Lansir</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->lansir}}</td>
		      </tr>
		      <tr>
		        <td>Nama Penerima</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>{{$data_penjualan->s_detail_lansir->nama_penerima}}</td>
		      </tr>
		      <tr>
		        <td>Status</td>
		        <td style="width : 10px; text-align: center;">:</td>
		        <td>
		         @if($data_penjualan->s_detail_lansir->status == 0)
		          <button class="btn btn-xs btn-info">On the Way</button>
		   @elseif($data_penjualan->s_detail_lansir->status == 1)
		    <button class="btn btn-xs btn-success">Finish</button>
		   @else
		    <button class="btn btn-xs btn-warning">Pending</button>
		   @endif
		  </td>
		      </tr>
		    </table>
		@endif
		</div>
	</div>
</div>
<!--
<div class="container">
 <div class="left">
  @if(!empty($data_penjualan->s_detail_muat))
   <div class="row">
   @foreach($data_penjualan->s_detail_muat as $i => $v)
   <div class="col-xs-12">
    <h1>Detail Muat</h1>
       <table class="table">
         <tr>
           <td style="width:50%">Antrian Truck</td>
         
           <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->antrian_truck}}</td>
         </tr>
         <tr>
           <td>Waktu Berangkat</td>
           <td style="width : 10px; text-align: center;">:</td>
           <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->waktu_berangkat}}</td>
         </tr>
         <tr>
           <td>Sampai</td>
           <td style="width : 10px; text-align: center;">:</td>
           <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->sampai}}</td>
         </tr>
         <tr>
           <td>Checker</td>
           <td style="width : 10px; text-align: center;">:</td>
           <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->s_checker->name}}</td>
         </tr>
          <tr>
           <td>Kode Muat</td>
           <td style="width : 10px; text-align: center;">:</td>
           <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->kode_muat}}</td>
         </tr>
         <tr>
           <td>Status</td>
           <td style="width : 10px; text-align: center;">:</td>
           <td>
            @if($data_penjualan->s_detail_muat[$i]->status == 0)
             <button class="btn btn-xs btn-info">On tde Way</button>
      @elseif($data_penjualan->s_detail_muat[$i]->status == 1)
       <button class="btn btn-xs btn-success">Finish</button>
      @else
       <button class="btn btn-xs btn-warning">Pending</button>
      @endif
     </td>
         </tr>
       </table>
   </div>
   @endforeach
     </div>
  @endif
 </div>
 <div class="right">
  @if(!empty($transit))
   @foreach($transit["transit_detail"] as $i => $t)
    <div class="col-xs-12">
     @if($t["transit_status"] == 0)
     <div class="box box-info">
     @elseif($t["transit_status"] == 1)
     <div class="box box-success">
     @else
     <div class="box box-warning">
     @endif
         <div class="box-header witd-border">
             <h3 class="box-title">Transit ke {{$i + 1}}</h3>
         </div>
            <div class="box-body">
       <div class="row">
        <div class="col-xs-12">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <td style="width:50%">Kode Cabang</td>
                <td>{{$t["data_cabang"]->kode_cabang}}</td>
              </tr>
              <tr>
                <td>Nama Cabang</td>
                <td>{{$t["data_cabang"]->nama_cabang}}</td>
              </tr>
              <tr>
                <td>Divisi</td>
                <td>{{$t["data_cabang"]->s_divisi->nama_divisi}}</td>
              </tr>
              <tr>
                <td>Status</td>
                <td>
                 @if($t["transit_status"] == 0)
                  <button class="btn btn-xs btn-info">Registered</button>
		         @elseif($t["transit_status"] == 1)
		            <button class="btn btn-xs btn-success">Finish</button>
		         @else
		            <button class="btn btn-xs btn-warning">On tde Way</button>
		         @endif
          </td>
              </tr>
            </table>
          </div>
        </div>
       </div>
      </div>
     </div>
    </div>
   @endforeach
  @endif
 </div>
 <div style="clear: botd"></div>
</div>
<div class="container">
 <div class="left">
 @if(!empty($data_penjualan->s_detail_lansir))
  <h1>Detail Lansir</h1>
     <table class="table">
       <tr>
         <td style="width:50%">Antrian Kendaraan</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->s_lansir->antrian_kendaraan}}</td>
       </tr>
       <tr>
         <td>Waktu Berangkat</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->s_lansir->berangkat}}</td>
       </tr>
       <tr>
         <td>Sampai</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->s_lansir->sampai}}</td>
       </tr>
       <tr>
         <td>Checker</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->s_lansir->s_checker->name}}</td>
       </tr>
        <tr>
         <td>Id Lansir</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->lansir}}</td>
       </tr>
       <tr>
         <td>Nama Penerima</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>{{$data_penjualan->s_detail_lansir->nama_penerima}}</td>
       </tr>
       <tr>
         <td>Status</td>
         <td style="width : 10px; text-align: center;">:</td>
         <td>
          @if($data_penjualan->s_detail_lansir->status == 0)
           <button class="btn btn-xs btn-info">On tde Way</button>
    @elseif($data_penjualan->s_detail_lansir->status == 1)
     <button class="btn btn-xs btn-success">Finish</button>
    @else
     <button class="btn btn-xs btn-warning">Pending</button>
    @endif
   </td>
       </tr>
     </table>
 @endif
 </div>    
</div>-->