
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
	        <h3 class="box-title">Detail Muat</h3>
	    </div>
        <div class="box-body">
			<div class="row">
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">id</th>
				        <td>{{$muat->id}}</td>
				      </tr>
				      <tr>
				        <th>Waktu Berangkat</th>
				        <td>{{$muat->waktu_berangkat}}</td>
				      </tr>
				      <tr>
				        <th>Kode Muat</th>
				        <td>{{$muat->kode_muat}}</td>
				      </tr>
				      <tr>
				        <th>Sampai</th>
				        <td>{{$muat->sampai}}</td>
				      </tr>
				      <tr>
				        <th>Petugas</th>
				        <td>{{$muat->s_checker->name}}</td>
				      </tr>
				    </table>
				  </div>
				</div>
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th style="width:50%">Antrian Truck</th>
				        <td>{{$muat->antrian_truck}}</td>
				      </tr>
				      <tr>
				        <th>Nama Truck</th>
				        <td>{{$muat->s_antrian_truck->s_truck->nama_truck}}</td>
				      </tr>
				      <tr>
				        <th>No Polisi</th>
				        <td>{{$muat->s_antrian_truck->s_truck->no_polisi}}</td>
				      </tr>
				      <tr>
				        <th>Grup</th>
				        <td>{{$muat->s_antrian_truck->s_truck->grup}}</td>
				      </tr>
				      <tr>
				        <th>Supir</th>
				        <td>{{$muat->s_antrian_truck->supir}}</td>
				      </tr>
				      <tr>
				        <th>No Telp Supir</th>
				        <td>{{$muat->s_antrian_truck->no_telp_supir}}</td>
				      </tr>
				      <tr>
				        <th>Kernet</th>
				        <td>{{$muat->s_antrian_truck->kernet}}</td>
				      </tr>
				      <tr>
				        <th>No Telp Kernet</th>
				        <td>{{$muat->s_antrian_truck->no_telp_kernet}}</td>
				      </tr>
				      
				    </table>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<a href="/muat/{{$muat->id}}/print" class="pull-right">
						<button type="button" class="btn btn-md btn-info"><i class="fa fa-print"></i> Print</button>
					</a>
				</div>
			</div>
		</div>
		@if($muat->sampai == null)
			@if($status == 1)
		        <form method="POST" action="/muat/{{$muat->id}}/setsampai">
		        <div class="box-footer">
	    			<div class="row">
	    				<div class="col-xs-4">
	    					<a href="/muat" class="pull-left">
	    						<button type="button" class="btn btn-md btn-warning">Kembali</button>
	    					</a>
	    				</div>
	    				<div class="col-xs-8">
	    					<div class="col-xs-5">

	    					</div>
	    					<div class="col-xs-5">
	    						<input type="hidden" name="_token" value="{{csrf_token()}}" />
	    						<input type="text" class="form-control datetimepicker" name="sampai" required placeholder="Waktu Sampai">
	    					</div>
	    					<div class="col-xs-2">
	    						<button type="submit" class="btn btn-info btn-md">Simpan</button>
	    					</div>
	    				</div>
	    			</div>
	    		</div>
		    	</form>
		    @endif
		@else
			<div class="box-footer">
				<a href="/muat" class="pull-right">
					<button type="button" class="btn btn-md btn-warning">Kembali</button>
				</a>
			</div>
		@endif
	</div>
	<div class="box box-primary">
	    <div class="box-header with-border">
	        <h3 class="box-title">STT</h3>
	    </div>
        <div class="box-body">
        	@foreach($muat->s_stt as $i => $stt)
				<div class="panel box box-@if($stt->status == 0)info @elseif($stt->status==1)success @elseif($stt->status==2)warning @endif">
				  <div class="box-header with-border">
				    <h4 class="box-title">
				      <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}">
				        STT : {{$stt->stt}}
				      </a>
				    </h4>
				  </div>
				  <div id="collapse{{$i}}" class="panel-collapse collapse">
				    <div class="box-body">
				    	<div class="col-xs-6">
				    	  <div class="table-responsive">
				    	    <table class="table">
				    	      <tr>
				    	        <th style="width:50%">Kantor Asal</th>
				    	        <td>{{$stt->s_penjualan->s_kantor_asal->nama_cabang}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Kantor Tujuan</th>
				    	        <td>{{$stt->s_penjualan->s_kantor_tujuan->nama_cabang}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Pengirim</th>
				    	        <td>{{$stt->s_penjualan->pengirim}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Penerima</th>
				    	        <td>{{$stt->s_penjualan->penerima}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Alamat Penerima</th>
				    	        <td>{{$stt->s_penjualan->alamat_penerima}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Berat</th>
				    	        <td>{{$stt->s_penjualan->berat}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Harga Per Kilo</th>
				    	        <td>{{changeToRp($stt->s_penjualan->harga_per_kilo)}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Harga Total</th>
				    	        <td>{{changeToRp($stt->s_penjualan->harga_total)}}</td>
				    	      </tr>
				    	    </table>
				    	  </div>
				    	</div>
				    	<div class="col-xs-6">
				    	  <div class="table-responsive">
				    	    <table class="table">
				    	      <tr>
				    	        <th style="width:50%">Penerus</th>
				    	        <td>{{$stt->s_penjualan->penerus}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Kode Penerus</th>
				    	        <td>{{$stt->s_penjualan->kode_penerus}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Nama Barang</th>
				    	        <td>{{$stt->s_penjualan->nama_barang}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Payment</th>
				    	        <td>{{$stt->s_penjualan->payment_type}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Jumlah Colly</th>
				    	        <td>{{$stt->s_penjualan->jumlah_colly}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Packing</th>
				    	        <td>{{$stt->s_penjualan->packing}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Ket Penjualan</th>
				    	        <td>{{$stt->s_penjualan->ket_tambahan}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Kontak Penerima</th>
				    	        <td>{{$stt->s_penjualan->kontak_penerima}}</td>
				    	      </tr>
				    	      <tr>
				    	        <th>Status</th>
				    	        <td>
				    	        	@if($stt->status == 0)
				    	        		<button class="btn btn-info btn-xs">On The Way</button>
				    	        	@elseif($stt->status == 1)
				    	        		<button class="btn btn-success btn-xs">Finish</button>
				    	        		@elseif($stt->status == 2)
				    	        		<button class="btn btn-warning btn-xs">Pending</button>
				    	        	@endif
				    	        </td>
				    	      </tr>
				    	      <tr>
				    	        <th>Ket Muat</th>
				    	        <td>{{$stt->keterangan}}</td>
				    	      </tr>
				    	    </table>
				    	  </div>
				    	</div>
				    </div>
				    @if($stt->status == 0 || $stt->status == 2)
				    <form method="POST" action="/muat/{{$muat->id}}/stt/{{$stt->stt}}/setstat">
				    <div class="box-footer">
				    	<div class="form-group col-xs-2">
				    		<label>Set Status</label>
				    		<br/>
				    		<input type="radio" name="status" value="1" class="minimal" required stt="{{$stt->stt}}"> Finish</input><br/>
				    		@if($stt->status != 2)
				    		<input type="radio" name="status" value="2" class="minimal" required stt="{{$stt->stt}}"> Pending</input>
				    		@endif
				    	</div>
				    	<div class="form-group col-xs-4">
				    		<label>Keterangan</label>
				    		<textarea name="keterangan" class="form-control" kstt="{{$stt->stt}}"></textarea>
				    	</div>
				    	<div class="col-xs-1">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				    		<button type="submit" class="btn btn-info" style="margin-top: 40px;">Simpan</button>
				    	</div>
				    </div>
					</form>
					@endif
				  </div>
				</div>
				@endforeach
			<div class="row">
				<div class="col-xs-12">
					<a href="/muat" class="pull-right">
						<button type="button" class="btn btn-md btn-info">Kembali</button>
					</a>
				</div>
			</div>
		</div>
	</div>
@stop

@section("scripts")
	<script src="/plugins/iCheck/icheck.min.js"></script>
	<script src="/dist/js/moment.min.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script>
	$(document).ready(function(){
		$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		  checkboxClass: 'icheckbox_minimal-blue',
		  radioClass: 'iradio_minimal-blue'
		});

		$('.minimal').on('ifChecked', function(){
		  var val 	= $(this).val();
		  var stt 	= $(this).attr("stt");
		  if(val == 1){
		  	$("[kstt="+stt+"]").attr("disabled", "disabled");
		  	$("[kstt="+stt+"]").removeAttr("required");
		  }
		  else{
		  	$("[kstt="+stt+"]").removeAttr("disabled");
		  	$("[kstt="+stt+"]").attr("required","required");
		  }
		});
			$(".datetimepicker").datetimepicker({
		   		format:'YYYY-MM-DD HH:mm:ss' 
			});
	});
	</script>
@stop