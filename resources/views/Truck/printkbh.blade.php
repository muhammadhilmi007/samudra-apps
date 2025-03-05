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
		<b>CABANG {{strtoupper($data_truck->s_cabang->nama_cabang)}} </b>

		<br/>
		<br/>
		LAPORAN KIRIMAN BARANG PER TRUCK
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
			<th>MOBIL</th>
			<th>COLLY</th>
			<th>BERAT</th>
			<th>CASH</th>
			<th>CAD</th>
			<th>COD</th>
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
			$cash = 0;
			$cad = 0;
			$cod = 0;
		?>

		@foreach($antrian_truck as $at)
			<?php
			$as = $at->s_muat;
			?>
				@foreach($as->s_stt as $st)
				<?php
				$sp = $st->s_penjualan;
				?>
						<tr>
							<td>{{change_date_format(explode(" ",$as->waktu_berangkat)[0])}}</td>
							<td>{{$sp->s_kantor_asal->nama_cabang}}</td>
							<td>{{$sp->s_kantor_tujuan->nama_cabang}}</td>
							<td>{{$sp->stt}}</td>
							<td>{{$sp->pengirim}}</td>
							<td>{{$sp->penerima}}</td>
							<td>{{$at->s_truck->no_polisi}}</td>
							<td>{{$sp->jumlah_colly}}</td>
							<td>{{$sp->berat}}</td>
							<td>@if($sp->payment_type == "CASH"){{changeToRp($sp->harga_total)}} <?php $cash = $cash + $sp->harga_total; ?> @else - @endif</td>
							<td>@if($sp->payment_type == "CAD"){{changeToRp($sp->harga_total)}} <?php $cad = $cad + $sp->harga_total; ?> @else - @endif</td>
							<td>@if($sp->payment_type == "COD"){{changeToRp($sp->harga_total)}} <?php $cod = $cod + $sp->harga_total; ?> @else - @endif</td>
							<?php
								$jm_colly = $jm_colly + $sp->jumlah_colly;
								$berat = $berat + $sp->berat;
								$stt++;
							?>
						</tr>
				@endforeach
		@endforeach
		<tr>
			<td colspan="7"></td>
			<td>{{$jm_colly}}</td>
			<td>{{$berat}}</td>
			<td>{{changeToRp($cash)}}</td>
			<td>{{changeToRp($cad)}}</td>
			<td>{{changeToRp($cod)}}</td>
		</tr>
		<?php
			$total 	= $cash + $cad + $cod;
			$persentase_cash = $cash / $total * 100;
			$persentase_cad = $cad / $total * 100;
			$persentase_cod = $cod / $total * 100;
		?>
		<tr>
			<td colspan="9"></td>
			<td>{{number_format((float)$persentase_cash, 2, '.', '')}} %</td>
			<td>{{number_format((float)$persentase_cad, 2, '.','')}} %</td>
			<td>{{number_format((float)$persentase_cod, 2, '.','')}} %</td>
		</tr>
		<tr>
			<td colspan="12" style="text-align: right;">{{changeToRp($total)}}</td>
		</tr>
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