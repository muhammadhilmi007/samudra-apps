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
		height:210px;
		border: 12px solid #f08519;
		border-bottom: 2px solid #f08519 !important;
		border-top: 7px solid #f08519 !important;
	}
	.left{
		float: left;
		width : 48%;
		padding: 10px;
	}
	.right{
		float : left;
		width : 48%;
		margin:0px;
		padding: 10px;

	}
	.no{
		float: right;
		width: 40% ;
		height: 5%;
		padding-top: 4px;
		padding-left: 4px;
		border: 2px solid #f08519;
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
                    border: 1px solid grey;
                }
                .table-order td{
                    display:table-cell;
                    padding:4px;
                    border: 1px solid grey;
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
		<div class="left">
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
                    </tr>
                    <tr>    
                        <td>Solo</td>
                        <td>: Jl. Kopen 482 Gg. Anggur 02/07 Ngadirejo, Kartosuro (Belakang SPBU     Jati Urip) Telp. 0877 2204 3431</td>
                    </tr>
                    <tr>    
                        <td>Yogya</td>
                        <td>: Jl. Ring Road Selatan Padhokan Lor, Tirtonirmolo, Kasihan - Bantul Telp.0851 0213 7474</td>
                    </tr>
                 </table>
            </div>        
		</div>
		<div class="right">
		<br/>
			<p><b>SURAT TANDA TERIMA (STT) TITIPAN BARANG</b></p>
			<br><br/>
			<div class="table-responsive">
                <table class='table text-left' style="font-size:8pt;" >
                    <tr>
                        <td>Semarang</td>
                        <td>:Jl. Arteri Soekarno-Hatta Komp. PGS No. 10 Telp. 0851 0063 2981 - 0878 3213 3192</td>
                    </tr>
                    <tr>
                        <td>Kudus</td>
                        <td>:Jl. Pattimura Kios Karang Pakis No. 18 Telp. 0852 9141 2250 - 0877 3100 9078</td>
                    </tr>
                </table>
            </div>  
			<div>
				<p class="no"> No STT : <strong style="color:#f01919;">{{$data_penjualan->stt}}</strong></p>
			</div>   
		</div>			
	</div>
	<div class="row" style="height:36% !important;">
		<div class="table-order">
            <table class='table text-left' style="font-size:9pt;" >
     			<tr style="height:20px;">
     				<td style="width:100px !important;">Jumlah Colly</td>
     				<td style="width:200px !important;">Nama Barang</td>
     				<td style="width:100px !important;">Berat (Kg)</td>
     				<td style="width:100px !important;">Biaya (Rp)</td>
     				<td style="width:130px !important;">Pembayaran<</td>
     				<td style="width:300px !important;">Pengirim</td>
     			</tr>
     			<?php
     				function changeToRp($value){
     					$result 	 = number_format($value,0,',','.');
     					return $result;
     				}
     			?>
     			<tr style="height:60px !important; font-size:12pt; color:#f01919; text-align:center;">
     			    <td style="width:100px !important;" rowspan="3">{{$data_penjualan->jumlah_colly}}</td>
     				<td style="width:200px !important;" rowspan="3">{{$data_penjualan->nama_barang}}</td>
     				<td style="width:100px !important;" rowspan="3">{{$data_penjualan->berat}}</td>
     				<td style="width:100px !important;" rowspan="3">{{changeToRp($data_penjualan->harga_total)}}</td>
     				<td style="width:130px !important; text-align: left; margin-left: 20px;" rowspan="5">
     					@if($data_penjualan->payment_type == 'CASH')
     						<img src="../public/dist/img/check.png" class="img-reponsive" style="width:30px;margin-top:10px;"/> CASH<br/>
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> CAD<br/>
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> COD<br/>
						@elseif($data_penjualan->payment_type == 'CAD')
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px;margin-top:10px;"/> CASH<br/>
							<img src="../public/dist/img/check.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> CAD<br/>
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> COD<br/>
     					@elseif($data_penjualan->payment_type == 'COD')
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px;margin-top:10px;"/> CASH<br/>
							<img src="../public/dist/img/ksg.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> CAD<br/>
							<img src="../public/dist/img/check.png" class="img-reponsive" style="width:30px; margin-top:10px;"/> COD<br/>
						@endif
					<td style="width:300px !important; text-align:left;">{{$data_penjualan->pengirim}}</td>
     			</tr>
     			<tr>
     				<td style="width:300px !important;" height="10px">Penerima</td>
     			</tr>
     			<tr>
     				<td style="width:300px !important; font-size:12pt; color:#f01919;">{{$data_penjualan->penerima}}</td>
     			</tr>
     			<tr>
     				<td colspan="4" rowspan="2"><small>Terbilang :</small></td>
     				<td style="width:300px !important;" height="10px">Penerus / Kode / Keterangan Tambahan:</td>
     			</tr>
     			<tr>
     				<td style="width:300px !important; font-size:12pt; color:#f01919;">{{$data_penjualan->penerus}}/{{$data_penjualan->kode_penerus}}/{{$data_penjualan->ket_tambahan}}</td>
     			</tr>
     		</table>
     	</div>	       
	</div>
	<div class="row" style="height:170px; border-bottom:10px solid #f08519!important;">
		<div class="table-order">
            <table class='table' style="font-size:9pt;" >
     			<tr style="height:20px;text-align:center;">
     				<td style="width:180px !important;">Telah diterima dengan baik</td>
     				<td style="width:600px !important;">Keterangan</td>
     				<td style="width:190px !important; font-size:12pt; color:#f01919;" rowspan="4">
     						{{$data_penjualan->s_kantor_asal->nama_cabang}}
     						<p style="color:#f08519;">PT. Samudera Jaya Abadi</p>
     						<p>{{$data_penjualan->s_user->name}}</p>
     				</td>
     			</tr>
     			<tr>
     				<td rowspan="3" style="padding-top:0px !important; text-align:center;">
     					Pengirim:........................../ 20.......
     					<h5>Tanda Tangan / Nama / Cap</h5>
     					<br/><br/>
     					............................................
     				</td>
     				<td rowspan="3" style="padding-top:0px !important; text-align:left; font-size:12px;">
     					1. Barang kiriman diserahkan oleh pengangkut sesuai alamat yang tertera dan pengangkut bertanggung jawab sepenuhnya, kecuali hal-hal majeure kecelakaan kendaraan di luar kemampuan kami.
						<br/>2. Barang kiriman yang mudah pecah dan mudah busuk bukan tanggung jawab pengangkut.
						<br/>3. Kiriman yang hilang oleh pengangkut diganti maksimum 10 x biaya angkut, kecuali yang diasuransikan melalui kami.
						<br/>4. Claim dilayani selambat-lambatnya 24 jam setelah penyerahan atas dasar berita acara.
						<br/>5. Apabila penerima menolak biaya angkut maka pengirim diwajibkan membayarnya.
     				</td>
     			</tr>
     		</table>
     	</div>					
	</div>
		<!--<table>
		<div class="left">
		  <tr>
		    <th>STT</th>
		    <td style="width : 10px;">:</td>
		    <td>{{$data_penjualan->stt}}</td>
		  </tr>
		  <tr>
		    <th>Kantor Asal</th>
		    <td>:</td>
		    <td>{{$data_penjualan->s_kantor_asal->nama_cabang}}</td>
		  </tr>
		  <tr>
		    <th>Kantor Tujuan</th>
		    <td>:</td>
		    <td>{{$data_penjualan->s_kantor_tujuan->nama_cabang}}</td>
		  </tr>
		  <tr>
		    <th>Pengirim</th>
		    <td>:</td>
		    <td>{{$data_penjualan->pengirim}}</td>
		  </tr>
		   <tr>
		    <th>Penerima</th>
		    <td>:</td>
		    <td>{{$data_penjualan->penerima}}</td>
		  </tr>
		  <tr>
		    <th>Alamat Penerima</th>
		    <td>:</td>
		    <td>{{$data_penjualan->alamat_penerima}}</td>
		  </tr>
		   <tr>
		    <th>Penerus</th>
		    <td>:</td>
		    <td>{{$data_penjualan->penerus}}</td>
		  </tr>
		  <tr>
		    <th>Kode Penerus</th>
		    <td>:</td>
		    <td>{{$data_penjualan->kode_penerus}}</td>
		  </tr>
		  <tr>
		    <th>Keterangan Tambahan</th>
		    <td>:</td>
		    <td>{{$data_penjualan->ket_tambahan}}</td>
		  </tr>
		  <tr>
		    <th>Petugas</th>
		    <td>:</td>
		    <td>{{$data_penjualan->s_user->name}}</td>
		  </tr>
		</table>
	</div>
	<div class="right">
		<table class="table">
		  <tr>
		    <th style="width:50%">Nama Barang</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->nama_barang}}</td>
		  </tr>
		  <tr>
		    <th>Tipe Payment</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->payment_type}}</td>
		  </tr>
		  <tr>
		    <th>Jumlah Colly</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->jumlah_colly}}</td>
		  </tr>
		  <tr>
		    <th>Packing</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->packing}}</td>
		  </tr>
		   <tr>
		    <th>Berat</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->berat}}</td>
		  </tr>
		  <tr>
		    <th>Jenis Harga</th>
		    <td style="width : 20px">:</td>
		    <td>{{str_replace("_"," ",strtoupper($data_penjualan->jenis_harga))}}</td>
		  </tr>
		  @if($data_penjualan->jenis_harga == "volume_metric")
		  	<tr>
		  		<th>Panjang</th>
		  		<td style="width : 20px">:</td>
		  		<td>{{explode("-", $data_penjualan->vmet)[0]}}</td>
		  	</tr>
		  	<tr>
		  		<th>Lebar</th>
		  		<td style="width : 20px">:</td>
		  		<td>{{explode("-", $data_penjualan->vmet)[1]}}</td>
		  	</tr>
		  	<tr>
		  		<th>Tinggi</th>
		  		<td style="width : 20px">:</td>
		  		<td>{{explode("-", $data_penjualan->vmet)[2]}}</td>
		  	</tr>
		  	<tr>
		  		<th>Volume (p x l x t)</th>
		  		<td style="width : 20px">:</td>
		  		<td>{{explode("-", $data_penjualan->vmet)[3]}}</td>
		  	</tr>
		  @endif
		   <tr>
		    <th>Harga/Satuan</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->harga_per_kilo}}</td>
		  </tr>
		  <tr>
		    <th>Harga Total</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->harga_total}}</td>
		  </tr>
		  <tr>
		    <th>Kontak Penerima</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->kontak_penerima}}</td>
		  </tr>
		  <tr>
		    <th>Cabang</th>
		    <td style="width : 20px">:</td>
		    <td>{{$data_penjualan->s_cabang->nama_cabang}}</td>
		  </tr>
		</table>
	</div>
	<div style="clear : both" />
</div>

<br/>
<div class="container">
	<div class="left">
		@if(!empty($data_penjualan->s_detail_muat))
			<div class="row">
			@foreach($data_penjualan->s_detail_muat as $i => $v)
			<div class="col-xs-12">
				<h1>Detail Muat</h1>
			    <table class="table">
			      <tr>
			        <th style="width:50%">Antrian Truck</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->antrian_truck}}</td>
			      </tr>
			      <tr>
			        <th>Waktu Berangkat</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->waktu_berangkat}}</td>
			      </tr>
			      <tr>
			        <th>Sampai</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->sampai}}</td>
			      </tr>
			      <tr>
			        <th>Checker</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->s_checker->name}}</td>
			      </tr>
			       <tr>
			        <th>Kode Muat</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>{{$data_penjualan->s_detail_muat[$i]->s_muat->kode_muat}}</td>
			      </tr>
			      <tr>
			        <th>Status</th>
			        <td style="width : 10px; text-align: center;">:</td>
			        <td>
			        	@if($data_penjualan->s_detail_muat[$i]->status == 0)
			        		<button class="btn btn-xs btn-info">On The Way</button>
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
					    <div class="box-header with-border">
					        <h3 class="box-title">Transit ke {{$i + 1}}</h3>
					    </div>
				        <div class="box-body">
							<div class="row">
								<div class="col-xs-12">
								  <div class="table-responsive">
								    <table class="table">
								      <tr>
								        <th style="width:50%">Kode Cabang</th>
								        <td>{{$t["data_cabang"]->kode_cabang}}</td>
								      </tr>
								      <tr>
								        <th>Nama Cabang</th>
								        <td>{{$t["data_cabang"]->nama_cabang}}</td>
								      </tr>
								      <tr>
								        <th>Divisi</th>
								        <td>{{$t["data_cabang"]->s_divisi->nama_divisi}}</td>
								      </tr>
								      <tr>
								        <th>Status</th>
								        <td>
								        	@if($t["transit_status"] == 0)
								        		<button class="btn btn-xs btn-info">Registered</button>
											@elseif($t["transit_status"] == 1)
												<button class="btn btn-xs btn-success">Finish</button>
											@else
												<button class="btn btn-xs btn-warning">On The Way</button>
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
	<div style="clear: both"></div>
</div>
<div class="container">
	<div class="left">
	@if(!empty($data_penjualan->s_detail_lansir))
		<h1>Detail Lansir</h1>
	    <table class="table">
	      <tr>
	        <th style="width:50%">Antrian Kendaraan</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->s_lansir->antrian_kendaraan}}</td>
	      </tr>
	      <tr>
	        <th>Waktu Berangkat</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->s_lansir->berangkat}}</td>
	      </tr>
	      <tr>
	        <th>Sampai</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->s_lansir->sampai}}</td>
	      </tr>
	      <tr>
	        <th>Checker</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->s_lansir->s_checker->name}}</td>
	      </tr>
	       <tr>
	        <th>Id Lansir</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->lansir}}</td>
	      </tr>
	      <tr>
	        <th>Nama Penerima</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>{{$data_penjualan->s_detail_lansir->nama_penerima}}</td>
	      </tr>
	      <tr>
	        <th>Status</th>
	        <td style="width : 10px; text-align: center;">:</td>
	        <td>
	        	@if($data_penjualan->s_detail_lansir->status == 0)
	        		<button class="btn btn-xs btn-info">On The Way</button>
				@elseif($data_penjualan->s_detail_lansir->status == 1)
					<button class="btn btn-xs btn-success">Finish</button>
				@else
					<button class="btn btn-xs btn-warning">Pending</button>
				@endif
			</td>
	      </tr>
	    </table>
	@endif
	
	</div>-->		  
</div>