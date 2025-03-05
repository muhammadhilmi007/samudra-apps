<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> 
<style>
 .container{
  width : 100%;
 }
 .row{
		width: 100%;
	}
	.no{
		float: right;
		width: 25%;
		height: 3%;
		padding-top: 4px;
		padding-left: 40px;
	}	
 .left{
  float: left;
  width : 30%;
  margin-left:0px;
 }
 .right{
  float : left;
  width : 40%;
  margin-left: 30px;
 }
 .font{
 	font-size: 14pt;
 }
  .table-order{
	    display:table;
	    width:100%;
	    border-collapse: collapse;
	    margin: 2px;
	    margin-top: 15px;
	}
	.table-oreder tr{
		display:table-cell;
	    padding:2px;
	    border: 1px solid #000;
	}
	.table-order td{
	    display:table-cell;
	    padding:4px;
	    border: 1px solid #000;
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
</style>
<div class="container">
	<div class="no"><strong class="font">Surat Tugas Tagihan</strong></div>
	<!-- <strong class="font">Samudera Paket</strong>
	<p style="padding-top:-15px!important;"><i>expedisi via excecutive trucking</i></p>
	<p style="font-size:8pt; padding-top:-10px;"> Jln. Holis No. 408 Telp. (022) 76996132 (022) 76324490<p> -->
	<div class="left"><img src="../public/dist/img/lg.png" class="img-reponsive" style="height:80px;"></img></div>
	<div style="clear:both;"></div>
	<div class="row">
		<div class="no" style="width:37%; text-align:right;"><p>No  :.........................................................</p></div>
		<div class="no"  style="width:35%;"><p style="text-align:right;"> Tanggal :............................................</p> </div>  
		
	</div>
	<div style="clear:both;"></div>
	<div class="row">
		<table class="table-order">
			<tr style="background:#000; color:#fff; text-align:center;">
				<td style="width:20px;"></td>
				<td style="width:100px;">Customer</td>
				<td style="width:100px;">STT/ No. Inv</td>
				<td style="width:80px;">Tagih</td>
				<td>Kontra</td>
				<td style="width:90px;">Cek/ Giro</td>
				<td>Jumlah</td>
				<td style="width:100px;">Ket</td>
				<td></td>
			</tr>
			@for($a = 1; $a < 22; $a++)
    			<tr>
    				<td style="text-align:center;">{{$a}}</td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td></td>
    			</tr>
			@endfor
			<tr>
				<td style="background:#000; color:#fff; text-align:center;" colspan="2">total</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		</table>	
	</div>
	<div style="clear:both;"></div>
	<div class="row">
		<div class="left">
			<p style="text-align:center;">Debt Collector</p>
			<br/><br/><br/>
			<hr style="2x solid #000; width:70%; margin-left:30px !important;" />
			<p style="font-size:8pt; text-align:center;padding-top:-10px;">(Nama Lengkap, Cap Perusahaan)</p>
		</div>
		<div class="right" style="margin-left:200px;">
			<p style="text-align:center;">Staff Administrasi</p>
			<br/><br/><br/>
			<hr style="2x solid #000; width:55%; margin-left:60px !important;" />
			<p style="font-size:8pt; text-align:center;padding-top:-10px;">(Nama Lengkap, Cap Perusahaan)</p>
		</div>
	</div>
</div>