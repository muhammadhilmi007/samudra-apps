<style>
.ilblock{
	display: inline-block;
}
.one_hundred{
	width : 100% !important;
}
.xs12{
	width : 100% !important;
}
.xs8{
	width : 66% !important;
}
.xs4{
	width : 33% !important;
}
.xs2{
	width : 16% !important;
}
.xs10{
	width : 83% !important;
}
.xs1{
	width : 8% !important;
}
.akanan{
	text-align: right;
}
.pkandik{
	margin-left: -7px;
}

</style>
<?php
	function numFormat($value){
		$result 	 = number_format($value,0,',','.');
		return $result;
	}
?>

<div class="row">
	<div class="ilblock col-md-12 one_hundred">
	  <div class="box box-primary">
	    <div class="box-header with-border">
	      <div class="pull-right">
	      	<div class="form-group">
	      		<input type="hidden" name="pil_cabang" value="{{Auth::user()->cabang}}">
	      		Cabang : {{Auth::user()->s_cabang->nama_cabang}}
	      	</div>
	      </div>
	    </div>
	      <div class="box-body content_container">
	      	<div class="row">
	      		<div class="ilblock col-xs-8 xs8">
			      	<h4>
			      		PT. {{Auth::user()->s_cabang->s_divisi->nama_divisi}}
			      	</h4>
	      		</div>
	      		<div class="ilblock col-xs-4 xs4">
	      			<div class="ilblock col-xs-4 xs4">
	      				<label>Tanggal</label>
	      			</div>
	      			<div class="ilblock col-xs-8 xs8">
	      			{{$tanggal}}
			      	</div>
	      		</div>
	      	</div>
	      	<div class="row">
	      		<div class="ilblock col-md-12 one_hundred" style="padding-left: 30px; padding-right: 30px;">
			      	<div class="row">
			      		<div class="ilblock col-xs-12 xs12" style="background: #4F81BD;">
			      			Aktiva
			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="ilblock col-xs-12 xs12" style="background: #DCE6F1;">
			      			Aktiva Lancar
			      		</div>
			      		<br/>
			      		<div class="ilblock col-xs-10 xs10 ilblock col-xs-offset-2" style="background : #DCE6F1;">
			      			Kas
			      		</div>
			      	</div>
			      	@foreach($account["a11"] as $a11)
			      		<div class="row">
			      			<div class="ilblock col-xs-2 xs2" style="text-align: right;">
			      				{{$a11->kode}}
			      			</div>
			      			<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
			      				{{$a11->nama_account}}
			      			</div>
			      			<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a11->nama_account))))}}_1">
			      				{{numFormat($a11->nominal)}}
			      			</div>
			      			<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a11->nama_account))))}}_2">

			      			</div>
			      		</div>
			      	@endforeach
			      	<div class="row">
			      		<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
			      			Total Kas
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a11_1">
			      			{{numFormat($total_1["a11"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a11_2">

			      		</div>
			      	</div>
			      	@foreach($account["a13"] as $a13)
			      	<div class="row">
			      		<div class="ilblock col-xs-1 xs2 ilblock" style="text-align: right;">
			      			{{$a13->kode}}
			      		</div>
			      		<div class="ilblock col-xs-8 xs8" style="padding-left: 50px; background : #DCE6F1;">
			      			<b><i>{{$a13->nama_account}}</i></b>
			      		</div>
			      		<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a13->nama_account))))}}_1" style="background : #DCE6F1;">
			      			{{numFormat($a13->nominal)}}
			      		</div>
			      		<!-- <div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a13->nama_account))))}}_2" style="background : #DCE6F1;">
			      		.
			      		</div> -->
			      	</div>
			      	@endforeach
			      	<div class="row">
			      		<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
			      			Total Sewa Bayar Di muka
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a13_1">
			      			{{numFormat($total_1["a13"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a13_2">

			      		</div>
			      	</div>
			      	<div class="row">
			      		<div class="ilblock col-xs-1 xs2 ilblock " style="text-align: right;">
			      			
			      		</div>
			      		<div class="ilblock col-xs-8 xs8" style="padding-left: 50px; background : #DCE6F1;">
			      			<b><i>Piutang</i></b>
			      		</div>
			      		<div class="ilblock col-xs-1 xs1 piutang_1" style="background : #DCE6F1;">
			      		.
			      		</div>
			      		<!-- <div class="ilblock col-xs-1 xs1 piutang_2" style="background : #DCE6F1;">
			      		.
			      		</div> -->
			      	</div>
			      	@foreach($account["a12"] as $a12)
			      		<div class="row">
			      			<div class="ilblock col-xs-2 xs2" style="text-align: right;">
			      				{{$a12->kode}}
			      			</div>
			      			<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
			      				{{$a12->nama_account}}
			      			</div>
			      			<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a12->nama_account))))}}_1">
			      				{{numFormat($a12->nominal)}}
			      			</div>
			      			<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a12->nama_account))))}}_2">

			      			</div>
			      		</div>
			      	@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Piutang
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a12_1">
			      			{{numFormat($total_1["a12"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a12_2">

			      		</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Aktiva Lancar
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_aktiva_lancar_1">
		      				{{numFormat($bawah["total_aktiva_lancar_1"])}}
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_aktiva_lancar_2">

		      			</div>
		      		</div> 
		      		<div class="row">
		      			<div class="ilblock col-xs-12 xs12" style="background: #DCE6F1;">
		      				Aktiva Tetap
		      			</div>
		      			<br/>
		      			<div class="ilblock col-xs-10 xs10 ilblock col-xs-offset-2" style="background : #DCE6F1;">
		      				Kas
		      			</div>
		      		</div>
		      		@foreach($account["a14"] as $a14)
		      			<div class="row">
		      				<div class="ilblock col-xs-2 xs2" style="text-align: right;">
		      					{{$a14->kode}}
		      				</div>
		      				<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
		      					{{$a14->nama_account}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a14->nama_account))))}}_1">
		      					{{numFormat($a14->nominal)}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a14->nama_account))))}}_2">

		      				</div>
		      			</div>
		      		@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Aktiva Tetap
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a14_1">
		      				{{numFormat($total_1["a14"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a14_2">

			      		</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="background: #DCE6F1;">
		      				<b>Total Assets</b>
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_assets_1" style="background :#DCE6F1;">
		      				{{numFormat($bawah["total_assets_1"])}}
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_assets_2" style="background :#DCE6F1;">

		      			</div>
		      		</div>	
		      		<br/>
		      		<div class="row">
		      			<div class="ilblock col-xs-12 xs12" style="background: #4F81BD;">
		      				Passiva
		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-12 xs12" style="background: #DCE6F1;">
		      				Kewajiban
		      			</div>
		      		</div>
		      		@foreach($account["a21"] as $a21)
		      			<div class="row">
		      				<div class="ilblock col-xs-2 xs2" style="text-align: right;">
		      					{{$a21->kode}}
		      				</div>
		      				<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
		      					{{$a21->nama_account}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a21->nama_account))))}}_1">
		      					{{numFormat($a21->nominal)}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a21->nama_account))))}}_2">

		      				</div>
		      			</div>
		      		@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Kewajiban
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a21_1">
		      				{{numFormat($total_1["a21"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a21_2">

			      		</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-12 xs12" style="background: #DCE6F1;">
		      				Modal
		      			</div>
		      			<br/>
		      			<div class="ilblock col-xs-10 xs10 ilblock col-xs-offset-2" style="background : #DCE6F1;">
		      				Modal Usaha
		      			</div>
		      		</div>
		      		@foreach($account["a31"] as $a31)
		      			<div class="row">
		      				<div class="ilblock col-xs-2 xs2" style="text-align: right;">
		      					{{$a31->kode}}
		      				</div>
		      				<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
		      					{{$a31->nama_account}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a31->nama_account))))}}_1">
		      					{{numFormat($a31->nominal)}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a31->nama_account))))}}_2">

		      				</div>
		      			</div>
		      		@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Modal Usaha
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a31_1">
		      				{{numFormat($total_1["a31"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a31_2">

			      		</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10 ilblock col-xs-offset-2" style="background : #DCE6F1;">
		      				Prive
		      			</div>
		      		</div>
		      		@foreach($account["a32"] as $a32)
		      			<div class="row">
		      				<div class="ilblock col-xs-2 xs2" style="text-align: right;">
		      					{{$a32->kode}}
		      				</div>
		      				<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
		      					{{$a32->nama_account}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a32->nama_account))))}}_1">
		      					{{numFormat($a32->nominal)}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a32->nama_account))))}}_2">

		      				</div>
		      			</div>
		      		@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Prive
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a32_1">
		      				{{numFormat($total_1["a32"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a32_2">

			      		</div>
		      		</div>
		      		<div class="ilblock col-xs-10 xs10 ilblock col-xs-offset-2" style="background : #DCE6F1;">
		      			Laba
		      		</div>
		      		@foreach($account["a33"] as $a33)
		      			<div class="row">
		      				<div class="ilblock col-xs-2 xs2" style="text-align: right;">
		      					{{$a33->kode}}
		      				</div>
		      				<div class="ilblock col-xs-8 xs8" style="padding-left: 50px;">
		      					{{$a33->nama_account}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a33->nama_account))))}}_1">
		      					{{numFormat($a33->nominal)}}
		      				</div>
		      				<div class="ilblock col-xs-1 xs1 akanan {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a33->nama_account))))}}_2">

		      				</div>
		      			</div>
		      		@endforeach
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Laba
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_a33_1">
		      				{{numFormat($total_1["a33"])}}
			      		</div>
			      		<div class="ilblock col-xs-1 akanan pkandik xs2 total_a33_2">

			      		</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="text-align: right; font-style: italic; font-weight: bold;">
		      				Total Modal
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_modal_1">
		      				{{numFormat($bawah["total_modal_1"])}}
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_modal_2">

		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10" style="background: #DCE6F1;">
		      				<b>Total Passiva</b>
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_pasiva_1" style="background :#DCE6F1;">
		      				{{numFormat($bawah["total_pasiva_1"])}}
		      			</div>
		      			<div class="ilblock col-xs-1 akanan pkandik xs2 total_pasiva_2" style="background :#DCE6F1;">

		      			</div>
		      		</div>
		      		<br/>
		      		<br/>
		      		<div class="row">
		      			<div class="ilblock col-xs-12 xs12" style="background: #4F81BD;">
		      				Rasio Keuangan Umum
		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10">
		      				<b>Rasio Utang</b> (Jumlah Kewajiban / Total Aktiva)
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_utang_1">
		      				{{number_format($bawah["rasio_utang_1"], 2, '.', ',')}}
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_utang_2">

		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10">
		      				<b>Rasio Lancar</b> (Aktiva Lancar / Kewajiban Lancar)
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_lancar_1">
		      				{{number_format($bawah["rasio_lancar_1"], 2, '.', ',')}}
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_lancar_2">

		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10">
		      				<b>Modal Berjalan</b> (Aktiva Lancar - Kewajiban Lancar)
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 modal_berjalan_1">
		      				{{numFormat($bawah["modal_berjalan_1"])}}
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 modal_berjalan_2">

		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10">
		      				<b>Rasio Aset terhadap Modal</b> (Jumlah Aktiva / Modal)
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_aset_terhadap_modal_1">
		      				{{number_format($bawah["rasio_aset_terhadap_modal_1"], 2, '.', ',')}}
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_aset_terhadap_modal_2">

		      			</div>
		      		</div>
		      		<div class="row">
		      			<div class="ilblock col-xs-10 xs10">
		      				<b>Rasio Hutang terhadap Modal</b> (Kewajiban / Modal)
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_hutang_terhadap_modal_1">
		      				{{number_format($bawah["rasio_hutang_terhadap_modal_1"], 2, '.', ',')}}
		      			</div>
		      			<div class="ilblock col-xs-1 xs1 rasio_hutang_terhadap_modal_2">

		      			</div>
		      		</div>
	      		</div>
	      	</div>
	      </div>
	      
	  </div>
	</div>
</div>