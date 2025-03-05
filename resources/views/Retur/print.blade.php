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
<?php
	function changeToRp($value){
		$result 	 = "Rp " . number_format($value,0,',','.');
		return $result;
	}
?>
<div class="container">
	<center>
		<b>CV. SAMUDERA JAYA ABADI</b> <br/>
		<b>CABANG {{strtoupper($data_retur[0]->s_cabang->nama_cabang)}} </b>

		<br/>
		<br/>
		LAPORAN RETUR PER TANGGAL
	</center>
</div>
<hr/>
<div class="container">
	<table class="coltab">
		<tr>
			<th>TANGGAL</th>
			<th>ASAL</th>
			<th>TUJUAN</th>
			<th>NO STT</th>
			<th>PENGIRIM</th>
			<th>PENERIMA</th>
			<th>TANGGAL LANSIR</th>
			<th>PAYMENT</th>
			<th>TANGGAL</th>
			<th>STATUS</th>
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

		@foreach($data_retur as $dr)
			<tr>
				<td>{{change_date_format(explode(" ",$dr->tanggal_kirim)[0])}}</td>
				<td>{{$dr->s_penjualan->s_kantor_asal->nama_cabang}}</td>
				<td>{{$dr->s_penjualan->s_kantor_tujuan->nama_cabang}}</td>
				<td>{{$dr->s_penjualan->stt}}</td>
				<td>{{$dr->s_penjualan->pengirim}}</td>
				<td>{{$dr->s_penjualan->penerima}}</td>
				<td></td>
				<td>{{$dr->s_penjualan->payment_type}}</td>
				<td>{{$dr->created_at}}</td>
				<td></td>
				<?php
					// $jm_colly = $jm_colly + $sp->jumlah_colly;
					// $berat = $berat + $sp->berat;
					$stt++;
				?>
			</tr>
		@endforeach
	</table>
</div>
<div class="container" style="margin-top: 20px;">
	<div class="left">
		<table class="subheader">
			<tr>
				<td width="150px">Jumlah</td>
				<td>:</td>
				<td>{{$stt}} STT</td>
			</tr>
		</table>
	</div>
	<div class="right">

	</div>
	<div style="clear: both;"></div>
</div>
<br/>
<br/>
<div class="container">
	<center>
	..................., .............................
	</center>
</div>
<div class="container">
	<div class="left">
		<table style="width: 100%;">
			<tr>
				<td>
					<div style="margin-left: 2px;">
						Kasir
					</div>
					<div style="margin-left: 2px; margin-top: 80px;">
						...............................
					</div>
				</td>
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
	<div class="right">
		<table style="width: 100%;">
			<tr>
				<td>
					<div style="margin-left: 2px;">
						Staff Administrasi
					</div>
					<div style="margin-left: 2px; margin-top: 80px;">
						...............................
					</div>
				</td>
				<td>
					<div style="margin-left: 30px;">
						Kepala Cabang
					</div>
					<div style="margin-left: 30px; margin-top: 80px;">
						...............................
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div style="clear: both"></div>
</div>