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
	}
 .no{
	float: right;
	width: 30%;
	font-size: 13pt;
	padding: 3px;
	text-align: center;
	border: 2px solid #000;
	}	
 .left{
  float: left;
  width : 50%;
  margin-top: 20px !important;
  margin-left: 20px;
 }
 .right{
  float : left;
  width : 40%;
  margin-left: 30px;
 }
 .font{
 	font-size: 14pt;
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

 .coltab{
 	width: 100%;
 	font-size: 9pt;
 	border-collapse: collapse;
 }
 .coltab tr{
 	border: 1px solid black;
 }
 .coltab tr th{
 	text-align: center;
 	border: 1px solid black;
 }
 .coltab tr td{
 	text-align: left;
 	padding-left: 3px;
 	padding-right: 3px;
 	border: 1px solid black;
 }
</style>
<div class="container">
	<div class="row">
		<div class="left">
			<p class="font"><strong>CV. SAMUDERA JAYA ABADI</strong></p>
			<pre style="padding-top:-10px;">JASA PENGIRIMAN BARANG</pre>
			<!-- <pre style="padding-top:-10px; font-size:8pt;">BANDUNG Jl. Holis 408 0851-0199-6132/ 085100324490 </pre> -->
		</div>
		<div class="no">Invoice</div>
		<div style="clear:both;"></div>
		<p style="text-align:right;">Customer : {{$data[0]->pengirim}}</p>
		<hr style="2px solid  #000; width :100%;">
	</div>
	<div class="row">
		<?php
			function change_date_format($date){
				$ex 	= explode("-", $date);
				$tahun 	= $ex[0];
				$bulan  = $ex[1];
				$tanggal= $ex[2];

				return $tanggal."/".$bulan."/".$tahun;
			}
			function changeToRp($value){
				$result 	 = "Rp " . number_format($value,0,',','.');
				return $result;
			}

			$total = 0;
		?>
		<table class="coltab">
			<tr>
				<th>TANGGAL</th>
				<th>NO STT</th>
				<th>CUSTOMER 2</th>
				<th>COLLY</th>
				<th>BERAT</th>
				<th>PAYMENT</th>
				<th>PIUTANG</th>
				<th style="width: 15%">KET</th>
			</tr>
			@foreach($data as $d)
			<tr>
				<td>{{change_date_format(explode(" ",$d->created_at)[0])}}</td>
				<td>{{$d->stt}}</td>
				<td>{{$d->penerima}}</td>
				<td>{{$d->jumlah_colly}}</td>
				<td>{{$d->berat}} Kg</td>
				<td>{{$d->payment_type}}</td>
				<td style="text-align: right;">{{changeToRp($d->s_overdue->nominal)}}</td>
				<td></td>
			</tr>
			<?php
				$total = $total + $d->s_overdue->nominal;
			?>
			@endforeach
			<tr>
				<td colspan="6" style="border: none;"></td>
				<td style="border: none; text-align : right;">{{changeToRp($total)}}</td>
				<td style="border: none;"></td>
			</tr>
			<tr>
				<td colspan="2" style="border: none;"></td>
				<td colspan="5" style="text-align : right; height: 20px;"></td>
				<td style="border: none;"></td>
			</tr>

		</table>
		<br/>
		<table style="width : 100%;">
			<tr>
				<td style="width : 33%; text-align: center;">Diterima Oleh <br/><br/><br/><br/> AJM</td>
				<td style="width : 33%; text-align: center;">Debt Collector <br/><br/><br/><br/> Odang T.Taryana</td>
				<td style="width : 33%; text-align: center;">Hormat Kami, <br/><br/><br/><br/> Wira Mujalil</td>
			</tr>
			<tr>
				<td style="width : 33%; text-align: center;"></td>
				<td style="width : 33%; text-align: center;"><br/><u><i>LembarCustomer</i></u></td>
				<td style="width : 33%; text-align: center;"></td>
			</tr>
		</table>
	</div>
</div>