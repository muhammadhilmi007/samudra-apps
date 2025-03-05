@extends("base")

@section("styles")

@stop

@section("content")
	<?php
		function changeToRp($value){
			$result 	 = "Rp " . number_format($value,0,',','.');
			return $result;
		}
	?>
	<div class="box box-primary">
	    <div class="box-header with-border">
	        <h3 class="box-title">Data Penjualan</h3>
	    </div>
        <div class="box-body">
			<div class="row">
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">STT</th>
				        <td>{{$penjualan->stt}}</td>
				      </tr>
				      <tr>
				        <th>Kantor Asal</th>
				        <td>{{$penjualan->s_kantor_asal->nama_cabang}}</td>
				      </tr>
				      <tr>
				        <th>Kantor Tujuan</th>
				        <td>{{$penjualan->s_kantor_tujuan->nama_cabang}}</td>
				      </tr>
				      <tr>
				        <th>Pengirim</th>
				        <td>{{$penjualan->pengirim}}</td>
				      </tr>
				       <tr>
				        <th>Penerima</th>
				        <td>{{$penjualan->penerima}}</td>
				      </tr>
				      <tr>
				        <th>Alamat Penerima</th>
				        <td>{{$penjualan->alamat_penerima}}</td>
				      </tr>
				       <tr>
				        <th>Penerus</th>
				        <td>{{$penjualan->penerus}}</td>
				      </tr>
				      <tr>
				        <th>Kode Penerus</th>
				        <td>{{$penjualan->kode_penerus}}</td>
				      </tr>
				      <tr>
				        <th>Keterangan Tambahan</th>
				        <td>{{$penjualan->ket_tambahan}}</td>
				      </tr>
				      <tr>
				        <th>Petugas</th>
				        <td>{{$penjualan->s_user->name}}</td>
				      </tr>
				    </table>
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">Nama Barang</th>
				        <td>{{$penjualan->nama_barang}}</td>
				      </tr>
				      <tr>
				        <th>Tipe Payment</th>
				        <td>{{$penjualan->payment_type}}</td>
				      </tr>
				      <tr>
				        <th>Jumlah Colly</th>
				        <td>{{$penjualan->jumlah_colly}}</td>
				      </tr>
				      <tr>
				        <th>Packing</th>
				        <td>{{$penjualan->packing}}</td>
				      </tr>
				       <tr>
				        <th>Berat</th>
				        <td>{{$penjualan->berat}}</td>
				      </tr>
				      <tr>
				        <th>Jenis Harga</th>
				        <td>{{str_replace("_"," ",strtoupper($penjualan->jenis_harga))}}</td>
				      </tr>
				      @if($penjualan->jenis_harga == "volume_metric")
				      	<tr>
				      		<th>Panjang</th>
				      		<td>{{explode("-", $penjualan->vmet)[0]}}</td>
				      	</tr>
				      	<tr>
				      		<th>Lebar</th>
				      		<td>{{explode("-", $penjualan->vmet)[1]}}</td>
				      	</tr>
				      	<tr>
				      		<th>Tinggi</th>
				      		<td>{{explode("-", $penjualan->vmet)[2]}}</td>
				      	</tr>
				      	<tr>
				      		<th>Volume (p x l x t)</th>
				      		<td>{{explode("-", $penjualan->vmet)[3]}}</td>
				      	</tr>
				      @endif
				       <tr>
				        <th>Harga/Satuan</th>
				        <td>{{changeToRp($penjualan->harga_per_kilo, 2)}}</td>
				      </tr>
				      <tr>
				        <th>Harga Total</th>
				        <td>{{changeToRp($penjualan->harga_total, 2)}}</td>
				      </tr>
				      <tr>
				        <th>Kontak Penerima</th>
				        <td>{{$penjualan->kontak_penerima}}</td>
				      </tr>
				      <tr>
				        <th>Cabang</th>
				        <td>{{$penjualan->s_cabang->nama_cabang}}</td>
				      </tr>
				    </table>
				  </div>
				</div>
			</div>
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			@if(!empty($penjualan->s_detail_muat))
			<div class="row">
				@foreach($penjualan->s_detail_muat as $dm)
				<div class="col-xs-12">
					@if($dm->status == 0)
					<div class="box box-info">
					@elseif($dm->status == 1)
					<div class="box box-success">
					@else
					<div class="box box-warning">
					@endif
					    <div class="box-header with-border">
					        <h3 class="box-title">Data Muat</h3>
					    </div>
				        <div class="box-body">
							<div class="row">
								<div class="col-xs-12">
								  <div class="table-responsive">
								    <table class="table">
								      <tr>
								        <th style="width:50%">Antrian Truck</th>
								        <td>{{$dm->s_muat->antrian_truck}}</td>
								      </tr>
								      <tr>
								        <th>Waktu Berangkat</th>
								        <td>{{$dm->s_muat->waktu_berangkat}}</td>
								      </tr>
								      <tr>
								        <th>Sampai</th>
								        <td>{{$dm->s_muat->sampai}}</td>
								      </tr>
								      <tr>
								        <th>Checker</th>
								        <td>{{$dm->s_muat->s_checker->name}}</td>
								      </tr>
								       <tr>
								        <th>Kode Muat</th>
								        <td>{{$dm->s_muat->kode_muat}}</td>
								      </tr>
								      <tr>
								        <th>Status</th>
								        <td>
								        	@if($dm->status == 0)
								        		<button class="btn btn-xs btn-info">On The Way</button>
											@elseif($dm->status == 1)
												<button class="btn btn-xs btn-success">Finish</button>
											@else
												<button class="btn btn-xs btn-warning">Pending</button>
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
			</div>
			@endif
		</div>
		<div class="col-lg-6">
			@if(!empty($transit))
				<div class="row">
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
				</div>
			@endif
		</div>
</div>
<div class="row">
	@if(!empty($penjualan->s_detail_lansir))
	<div class="col-lg-6">
		@if($penjualan->s_detail_lansir->status == 0)
		<div class="box box-info">
		@elseif($penjualan->s_detail_lansir->status == 1)
		<div class="box box-success">
		@else
		<div class="box box-warning">
		@endif
		    <div class="box-header with-border">
		        <h3 class="box-title">Data Lansir</h3>
		    </div>
	        <div class="box-body">
				<div class="row">
					<div class="col-xs-12">
					  <div class="table-responsive">
					    <table class="table">
					      <tr>
					        <th style="width:50%">Antrian Kendaraan</th>
					        <td>{{$penjualan->s_detail_lansir->s_lansir->antrian_kendaraan}}</td>
					      </tr>
					      <tr>
					        <th>Waktu Berangkat</th>
					        <td>{{$penjualan->s_detail_lansir->s_lansir->berangkat}}</td>
					      </tr>
					      <tr>
					        <th>Sampai</th>
					        <td>{{$penjualan->s_detail_lansir->s_lansir->sampai}}</td>
					      </tr>
					      <tr>
					        <th>Checker</th>
					        <td>{{$penjualan->s_detail_lansir->s_lansir->s_checker->name}}</td>
					      </tr>
					       <tr>
					        <th>Kode Lansir</th>
					        <td>{{$penjualan->s_detail_lansir->s_lansir->kode_lansir}}</td>
					      </tr>
					      <tr>
					        <th>Nama Penerima</th>
					        <td>{{$penjualan->s_detail_lansir->nama_penerima}}</td>
					      </tr>
					      <tr>
					        <th>Status</th>
					        <td>
					        	@if($penjualan->s_detail_lansir->status == 0)
					        		<button class="btn btn-xs btn-info">On The Way</button>
								@elseif($penjualan->s_detail_lansir->status == 1)
									<button class="btn btn-xs btn-success">Finish</button>
								@else
									<button class="btn btn-xs btn-warning">Pending</button>
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
	@endif
</div>
<div class="row">
			<div class="col-xs-12">
				<a href="/penjualan" class="pull-right">
					<button type="button" class="btn btn-md btn-info">Kembali</button>
				</a>
				<a href="/penjualan/{{$penjualan->stt}}/print/penjualan" class="pull-left">
					<button type="button" class="btn btn-md btn-success"><i class="fa fa-print"></i> Print Penjualan</button>
				</a>
				<a href="/penjualan/{{$penjualan->stt}}/print" class="pull-left">
					<button type="button" class="btn btn-md btn-warning" style="margin-left: 20px;"><i class="fa fa-print"></i> Print STT</button>
				</a>
			</div>
	</div>
@stop

@section("scripts")

@stop