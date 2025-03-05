@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
@stop

@section("content")
	<div class="row">
		<div class="col-lg-4">
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Input Data Retur Terima</h3>
		    </div>
		    <form method="POST">
		      <div class="box-body">
		      	  <div class="form-group">
		          	<label>STT</label>
		          	<select name="stt[]" multiple="true" required class="select2 form-control">
		          		<option value=""></option>
		          		@foreach($penjualan as $p)
		          			<option value="{{$p->stt}}">{{$p->stt}}</option>
		          		@endforeach
		          	</select>
		          </div>
		          <div class="form-group">
		          	<label>Tanggal Terima</label>
		          	<input type="text" name="tanggal_terima" class="form-control datetimepicker" required>
		          </div>
		        </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary pull-right">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
		<div class="col-lg-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Detail STT</h3>
			  </div>
			  <div class="box-body">
			  	<div class="col-xs-6">
				  	<div class="table-responsive">
					    <table class="table">
					      <tr>
					        <th style="width:50%">Id Penjualan</th>
					        <td id="s_id"></td>
					      </tr>
					      <tr>
					        <th>STT</th>
					        <td id="s_stt"></td>
					      </tr>
					      <tr>
					        <th>Kantor Asal</th>
					        <td id="s_kantor_asal"></td>
					      </tr>
					      <tr>
					        <th>Kantor Tujuan</th>
					        <td id="s_kantor_tujuan"></td>
					      </tr>
					      <tr>
					        <th>Pengirim</th>
					        <td id="s_pengirim"></td>
					      </tr>
					      <tr>
					        <th>Penerima</th>
					        <td id="s_penerima"></td>
					      </tr>
					      <tr>
					        <th>Alamat Penerima</th>
					        <td id="s_alamat_penerima"></td>
					      </tr>
					      <tr>
					        <th>Keterangan Tambahan</th>
					        <td id="s_ket_tambahan"></td>
					      </tr>
					      <tr>
					        <th>Kontak Penerima</th>
					        <td id="s_kontak_penerima"></td>
					      </tr>
					    </table>
					  </div>
				  </div>
				  <div class="col-xs-6">
				  	  <div class="table-responsive">
					    <table class="table">
					      <tr>
					        <th style="width:50%">Penerus</th>
					        <td id="s_penerus"></td>
					      </tr>
					      <tr>
					        <th>Kode Penerus</th>
					        <td id="s_kode_penerus"></td>
					      </tr>
					      <tr>
					        <th>Nama Barang</th>
					        <td id="s_nama_barang"></td>
					      </tr>
					      <tr>
					        <th>Payment Type</th>
					        <td id="s_payment_type"></td>
					      </tr>
					      <tr>
					        <th>Jumlah Colly</th>
					        <td id="s_jumlah_colly"></td>
					      </tr>
					      <tr>
					        <th>Packing</th>
					        <td id="s_packing"></td>
					      </tr>
					      <tr>
					        <th>Berat</th>
					        <td id="s_berat"></td>
					      </tr>
					      <tr>
					        <th>Harga Per Kilo</th>
					        <td id="s_harga_per_kilo"></td>
					      </tr>
					      <tr>
					        <th>Harga Total</th>
					        <td id="s_harga_total"></td>
					      </tr>
					    </table>
					  </div>
				  </div>
				</div>
			  </div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">STT Diterima</h3>
			  </div>
			  <div class="box-body">
			  	 <table class="table table-hashed">
			  	 	<thead>
			  	 		<tr>
			  	 			<th>ID</th>
			  	 			<th>Kode Retur</th>
			  	 			<th>STT</th>
			  	 			<th>Tanggal Kirim</th>
			  	 			<th>Tanggal Terima</th>
			  	 		</tr>
			  	 	</thead>
			  	 	<tbody>
			  	 		@foreach($retur as $r)
				  	 		<tr>
					  	 		<td>{{$r->id}}</td>
					  	 		<td>{{$r->kode_retur}}</td>
					  	 		<td>{{$r->stt}}</td>
					  	 		<td>{{$r->tanggal_kirim}}</td>
					  	 		<td>{{$r->tanggal_terima}}</td>
				  	 		</tr>
			  	 		@endforeach
			  	 	</tbody>
			  	 </table>
			  </div>
		</div>
	</div>
@stop

@section("scripts")
	<script src="/plugins/select2/select2.js"></script>
	<script src="/dist/js/moment.min.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script src="/js/retur.js"></script>
@stop