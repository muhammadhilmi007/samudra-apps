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
		<center>
			<b> CV. Samudera Jaya Abadi </b>
			<br/>Cabang {{$data_muat->s_cabang->nama_cabang}} 
			<br/>Daftar Muat Barang
		</center>
	</div>
	<div class="right">
		<center>
			<b> CV. Samudera Jaya Abadi </b>
			<br/>Cabang {{$data_muat->s_cabang_tujuan->nama_cabang}} 
			<br/> 
		</center>
	</div>
	<div style="clear : both" />
</div>
<hr/>
<div class="container">
	<div class="left">
		<table class="subheader">
			<tr>
				<td width="150px">Berangkat</td>
				<td>:</td>
				<td>{{$data_muat->waktu_berangkat}}</td>
			</tr>
			<tr>
				<td width="150px">Sampai</td>
				<td>:</td>
				<td>{{$data_muat->sampai}}</td>
			</tr>
		</table>
	</div>
	<div class="right">
		<table class="subheader">
			<tr>
				<td width="150px">{{strtoupper($data_muat->s_cabang->nama_cabang)}}</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td width="150px">{{strtoupper($data_muat->s_cabang_tujuan->nama_cabang)}}</td>
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
			<th>TANGGAL</th>
			<th>NO STT</th>
			<th>NAMA BARANG</th>
			<th>PACKING</th>
			<th>COLLY</th>
			<th>BERAT</th>
			<th>PENGIRIM</th>
			<th>PENERIMA</th>
			<th>DAERAH PENERIMA</th>
			<th>PENERUS</th>
			<th>70/71</th>
			<th>CEK</th>
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
		?>

		@foreach($muat_detail as $dm)
		<tr>
			<td>{{change_date_format(explode(" ",$dm->created_at)[0])}}</td>
			<td>{{$dm->s_penjualan->stt}}</td>
			<td>{{$dm->s_penjualan->nama_barang}}</td>
			<td>{{$dm->s_penjualan->packing}}</td>
			<td>{{$dm->s_penjualan->jumlah_colly}}</td>
			<td>{{$dm->s_penjualan->berat}}</td>
			<td>{{$dm->s_penjualan->pengirim}}</td>
			<td>{{$dm->s_penjualan->penerima}}</td>
			<td>{{$dm->s_penjualan->alamat_penerima}}</td>
			<td>{{$dm->s_penjualan->penerus}}</td>
			<td>{{$dm->s_penjualan->kode_penerus}}</td>
			<td></td>
		</tr>
		<?php
			$stt++;
			$jm_colly = $jm_colly + $dm->s_penjualan->jumlah_colly;
			$berat 	  = $berat + $dm->s_penjualan->berat;
		?>
		@endforeach
	</table>
</div>
<div class="container" style="margin-top: 20px;">
	<div class="left">
		<table class="subheader">
			<tr>
				<td width="150px">J. Colly</td>
				<td>:</td>
				<td>{{$jm_colly}}</td>
			</tr>
			<tr>
				<td width="150px">Berat</td>
				<td>:</td>
				<td>{{$berat}}</td>
			</tr>
			<tr>
				<td width="150px">Jumlah</td>
				<td>:</td>
				<td>{{$stt}} STT</td>
			</tr>
		</table>
	</div>
	<div class="right">
		{{$data_muat->s_cabang->nama_cabang}}, ...................................
	</div>
	<div style="clear: both;"></div>
</div>
<br/>
<br/>
<div class="container">
	<div class="left">
		<table style="width: 100%;">
			<tr>
				<td>
					<div style="margin-left: 2px;">
						Checker
					</div>
					<div style="margin-left: 2px; margin-top: 80px;">
						...............................
					</div>
				</td>
				<td>
					<div style="margin-left: 2px;">
						Supir
					</div>
					<div style="margin-left: 2px; margin-top: 80px;">
						...............................
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
						Kepala Gudang
					</div>
					<div style="margin-left: 2px; margin-top: 80px;">
						...............................
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div style="clear: both"></div>
</div>