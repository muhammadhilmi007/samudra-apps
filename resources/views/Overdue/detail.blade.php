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
		function nFormat($value){
			$result 	 = number_format($value,0,',','.');
			return $result;
		}
	?>
	<div class="box box-primary">
	    <div class="box-header with-border">
	        <h3 class="box-title">Overdue Transaction</h3>
	    </div>
        <div class="box-body">
			<div class="row">
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th><h2>Data Overdue</h2></th>
				        <td></td>
				      </tr>
				      <tr>
				        <th>id</th>
				        <td>{{$overdue->id}}</td>
				      </tr>
				      <tr>
				        <th>STT</th>
				        <td>{{$overdue->stt}}</td>
				      </tr>
				      <tr>
				        <th>Cabang</th>
				        <td>{{$overdue->s_cabang->nama_cabang}}</td>
				      </tr>
				      <tr>
				        <th>Pelanggan</th>
				        <td>{{$overdue->pelanggan}}</td>
				      </tr>
				      <tr>
				        <th>Nominal Awal</th>
				        <td>{{changeToRp($overdue->nominal_awal)}}</td>
				      </tr>
				      <tr>
				        <th>Nominal</th>
				        <td>{{changeToRp($overdue->nominal)}}</td>
				      </tr>
				    </table>
				  </div>
				  @if($overdue->nominal != 0)
				  <form method="POST">
				  	<div class="form-group">
				  		<h2>Form Pembayaran</h2>
				  		<input type="hidden" name="_token" value="{{csrf_token()}}" />
				  	</div>
				  	<div class="form-group">
				  		<label>Tanggal Bayar</label>
				  		<input type="text" name="tanggal" class="form-control datetimepicker" />
				  	</div>
				  	<div class="form-group">
				  		<label>Nominal</label>
				  		<input type="text" name="nominal" class="form-control" patter="[0-9]+"/>
				  	</div>
				  	<div class="form-group">
				  		<span class="rupiah_viewer">Rp 0</span>
				  	</div>
				  	<div class="form-group">
			          	<label>Payment Type</label>
			          	<select name="payment_type" class="form-control">
				          	<option value="CASH" @if($overdue->s_stt->payment_type == "CASH") selected @endif>CASH</option>
				          	<option value="CAD" @if($overdue->s_stt->payment_type == "CAD") selected @endif>CAD</option>
				          	<option value="COD" @if($overdue->s_stt->payment_type == "COD") selected @endif>COD</option>
			          	</select>
			          </div>
				  	<div class="form-group">
				  		<button type="submit" class="btn btn-md btn-info pull-right"><i class="fa fa-save"></i> Simpan</button>
				  	</div>
				  </form>
				  @endif
				</div>
				<div class="col-xs-6">
				  <div class="table-responsive">
				    <table class="table">
				      <tr>
				        <th><h2>Detail Overdue</h2></th>
				        <td></td>
				        <td></td>
				      </tr>
				      <tr>
				        <th>#</th>
				        <th>Tanggal</th>
				        <th><div class="pull-right">Nominal</div></th>
				      </tr>
				      <?php $jml = 0;?>
				      @foreach($detail as $i => $d)
					      <tr>
					        <th>Pembayaran ke-{{$i + 1}}</th>
					      	<td>{{$d->tanggal}}</td>
					        <td>Rp <div class="pull-right">{{nFormat($d->besar_nominal)}}</div></td>
					        <?php $jml = $jml + $d->besar_nominal; ?>
					      </tr>
				      @endforeach
				      <tr>
				      	<th colspan="2">
				      		Total
				      	</th>
				      	<td>
				      		Rp
				      		<div class="pull-right">{{nFormat($jml)}}</div>
				      	</td>
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

			<div class="box-footer">
				<a href="/overdue" class="pull-right">
					<button type="button" class="btn btn-md btn-warning">Kembali</button>
				</a>
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

		$(".datetimepicker").datetimepicker({
	   		format:'YYYY-MM-DD HH:mm:ss' 
		});
		function number_format (number, decimals, dec_point, thousands_sep) {
		    // Strip all characters but numerical ones.
		    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
		    var n = !isFinite(+number) ? 0 : +number,
		        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		        sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
		        dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
		        s = '',
		        toFixedFix = function (n, prec) {
		            var k = Math.pow(10, prec);
		            return '' + Math.round(n * k) / k;
		        };
		    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
		    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
		    if (s[0].length > 3) {
		        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		    }
		    if ((s[1] || '').length < prec) {
		        s[1] = s[1] || '';
		        s[1] += new Array(prec - s[1].length + 1).join('0');
		    }
		    return s.join(dec);
		}

		$("[name=nominal]").keyup(function(){
			var val 	= $(this).val();
			$(".rupiah_viewer").html("Rp "+number_format(val));
		});


	});
	</script>
@stop