<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
<style>
	body{
		font-family: "calibri";
	}
	.container{
		width : 100%;
	}
	.left{
		float: left;
		width : 48%;
	}
	.right{
		float : left;
		width : 48%;
		margin-left: 10px;
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
	.subheader{
		font-size : 10pt;
	}
	.coltab{
		width: 100%;
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
		text-align: center;
		border: 1px solid black;
	}
</style>
<div class="container">
	<div class="left">
		<b>CV. Samudera Jaya Abadi </b> <br/>
		<b>Form Lansir </b>
	</div>
	<div style="clear : both" />
</div>
<hr/>
<div class="container">
	<div class="left">
		<table class="subheader">
			<tr>
				<td width="150px">Tanggal</td>
				<td>:</td>
				<td>{{$data_lansir->created_at}}</td>
			</tr>
			<tr>
				<td width="150px">No Lansir</td>
				<td>:</td>
				<td>{{$data_lansir->id}}</td>
			</tr>
			<tr>
				<td width="150px">Mobil</td>
				<td>:</td>
				<td>{{$data_lansir->s_antrian_kendaraan->s_kendaraan->no_polisi}}</td>
			</tr>
		</table>
	</div>
	<div class="right">
		<table class="subheader">
			<tr>
				<td width="150px">CARIER</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="150px">DURASI</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="150px">KM</td>
				<td></td>
				<td></td>
			</tr>
		</table>
	</div>
	<div style="clear: both;"></div>
</div>
<div class="container">
	<table class="coltab">
		<tr>
			<th>NO</th>
			<th>NO STT</th>
			<th>COLLY</th>
			<th>PENGIRIM</th>
			<th>PENERIMA</th>
			<th>BAYAR</th>
			<th>KET. SRT</th>
			<th>KET. BIAYA</th>
		</tr>
		<?php
			function change_date_format($date){
				$ex 	= explode("-", $date);
				$tahun 	= $ex[0];
				$bulan  = $ex[1];
				$tanggal= $ex[2];

				return $tanggal."/".$bulan."/".$tahun;
			}
			$jm_colly = 0;
			$berat 	= 0;
			$stt = 0;
			$no = 0;
		?>

		@foreach($lansir_detail as $ld)
		<tr>
			<td>{{$no++}}</td>
			<td>{{$ld->s_penjualan->stt}}</td>
			<td>{{$ld->s_penjualan->jumlah_colly}}</td>
			<td>{{$ld->s_penjualan->pengirim}}</td>
			<td>{{$ld->s_penjualan->penerima}}</td>
			<td></td>
			<td>{{$ld->s_penjualan->ket_tambahan}}</td>
			<td></td>
		</tr>
		<?php
			$stt++;
			$jm_colly = $jm_colly + $ld->s_penjualan->jumlah_colly;
			$berat 	  = $berat + $ld->s_penjualan->berat;
		?>
		@endforeach
	</table>
</div>
<br/>
<div class="container">
	<div class="left">
		<table style="width: 100%;">
			<tr>
				<td>
					<div style="margin-left: 2px;">
						Checker : 
					</div>

				</td>
				
			</tr>
		</table>
		
	</div>
	<div class="right">
		<table>
			<tr>
				<td>
					<div style="margin-left: 2px;">
						Admin : 
					</div>
				
				</td>
			</tr>
		</table>
	</div>
	<div style="clear: both"></div>
</div>