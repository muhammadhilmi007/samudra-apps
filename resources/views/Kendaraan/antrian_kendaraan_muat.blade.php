@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
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
	        <h3 class="box-title">Detail Antrian</h3>
	    </div>
        <div class="box-body">
			<div class="row">
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">id</th>
				        <td>{{$antrian->id}}</td>
				      </tr>
				      <tr>
				      	<th>Kendaraan</th>
				      	<td>{{$antrian->s_kendaraan->nama_kendaraan}}</td>
				      </tr>
				      <tr>
				      	<th>No Polisi Kendaraan</th>
				      	<td>{{$antrian->s_kendaraan->no_polisi}}</td>
				      </tr>
				    </table>
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">Antrian Kendaraan</th>
				        <td>{{$antrian->id}}</td>
				      </tr>
				      <tr>
				      	<th>Supir</th>
				      	<td>{{$antrian->s_supir->name}}</td>
				      </tr>
				      <tr>
				      	<th>Kernet</th>
				      	<td>{{$antrian->s_kernet->name}}</td>
				      </tr>
				    </table>
				  </div>
				</div>
			</div>
			<!-- <div class="row">
				<div class="col-xs-12">
					<a href="/muat" class="pull-right">
						<button type="button" class="btn btn-md btn-info">Kembali</button>
					</a>
				</div>
			</div> -->
		</div>
	</div>
	<form method="POST">
	<div class="box box-primary">
	    <div class="box-header with-border">
	        <h3 class="box-title">Pilih STT untuk Muat</h3>
	    </div>
	    <table class="table table-stripped table-hover">
	    	<thead>
		    	<tr>
		    		<th>id</th>
		    		<th>STT</th>
		    		<th>Kantor Asal</th>
		    		<th>Kantor Tujuan</th>
		    		<th>Pengirim</th>
		    		<th>Penerima</th>
		    		<th>Alamat Penerima</th>
		    		<th>Nama Barang</th>
		    		<th>Berat</th>
		    		<th>Harga Per Kilo</th>
		    		<th>Harga Total</th>
		    		<th>Check</th>
		    	</tr>
		    </thead>
		    <tbody>
		    	@foreach($penjualan as $p)
		    	<tr>
		    		<td>{{$p->id}}</td>
		    		<td>{{$p->stt}}</td>
		    		<td>{{$p->s_kantor_asal->nama_cabang}}</td>
		    		<td>{{$p->s_kantor_tujuan->nama_cabang}}</td>
		    		<td>{{$p->pengirim}}</td>
		    		<td>{{$p->penerima}}</td>
		    		<td>{{$p->alamat_penerima}}</td>
		    		<td>{{$p->nama_barang}}</td>
		    		<td>{{$p->berat}} Kg</td>
		    		<td>{{changeToRp($p->harga_per_kilo)}}</td>
		    		<td>{{changeToRp($p->harga_total)}}</td>
		    		<td><input type="checkbox" name="stt[]" value="{{$p->stt}}" class="minimal"></input></td></td>
		    	</tr>
		    	@endforeach
		    </tbody>
	    </table>
        <div class="box-body">
			<div class="row">
				<div class="col-xs-4">
					<a href="/truck/antrian_truck" class="pull-left">
						<button type="button" class="btn btn-md btn-warning">Kembali</button>
					</a>
				</div>
				<div class="col-xs-8">
					<div class="col-xs-5">

					</div>
					<div class="col-xs-5">
						<input type="hidden" name="_token" value="{{csrf_token()}}" />
						<input type="text" class="form-control datetimepicker" name="waktu_berangkat" required placeholder="Waktu berangkat">
					</div>
					<div class="col-xs-2">
						<button type="submit" class="btn btn-info btn-md">Simpan</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
@stop

@section("scripts")
	<script src="/dist/js/moment.min.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script src="/plugins/iCheck/icheck.min.js"></script>
	<script>
	$(document).ready(function(){
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		  checkboxClass: 'icheckbox_minimal-blue',
		  radioClass: 'iradio_minimal-blue'
		});
			$(".datetimepicker").datetimepicker({
		   		format:'YYYY-MM-DD HH:mm:ss' 
			});

		$('[type=submit]').click(function() {
		      checked = $("input[type=checkbox]:checked").length;

		      if(!checked) {
		        alert("Anda belum memilih STT sama sekali, silahkan pilih STT minimal 1 STT");
		        return false;
		      }

		    });
	});
	</script>
@stop