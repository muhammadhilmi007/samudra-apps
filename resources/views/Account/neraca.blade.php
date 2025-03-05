@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css" />

@stop

@section("content")
	<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">
		      	Neraca
		      </h3>
		      <div class="pull-right">
		      	<div class="form-group">
		      			<!-- <label>
		      				Cabang : 
		      			</label>
		      			<select name="pil_cabang">
		      					<option value="$cb->id">$cb->nama_cabang</option>
		      			</select> -->
		      			<input type="hidden" name="pil_cabang" value="{{Auth::user()->cabang}}">
		      			Cabang : {{Auth::user()->s_cabang->nama_cabang}}
		      	</div>
		      </div>
		    </div>
		      <div class="box-body content_container">
		      	<div class="row">
		      		<div class="col-xs-8">
				      	<h4>
				      		PT. {{Auth::user()->s_cabang->s_divisi->nama_divisi}}
				      	</h4>
		      		</div>
		      		<div class="col-xs-4">
		      			<div class="col-xs-4">
		      				<label>Tanggal</label>
		      			</div>
		      			<div class="col-xs-8">
				      		<input type="text" class="form-control" name="tanggal" datepicker required>
				      	</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12" style="padding-left: 30px; padding-right: 30px;">
				      	<div class="row">
				      		<div class="col-xs-12" style="background: #4F81BD;">
				      			Aktiva
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12" style="background: #DCE6F1;">
				      			Aktiva Lancar
				      		</div>
				      		<br/>
				      		<div class="col-xs-10 col-xs-offset-2" style="background : #DCE6F1;">
				      			Kas
				      		</div>
				      	</div>
				      	<!-- <div class="row">
				      		<div class="col-xs-2" style="text-align: right;">

				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Kas Di Tangan Pusat
				      		</div>
				      		<div class="col-xs-1 kas_di_tangan_pusat_1">
				      			1.000.000
				      		</div>
				      		<div class="col-xs-1 kas_di_tangan_pusat_2">

				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-2" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Kas Di Tangan Cabang
				      		</div>
				      		<div class="col-xs-1 kas_di_tangan_cabang_1">

				      		</div>
				      		<div class="col-xs-1 kas_di_tangan_cabang_2">

				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-2" style="text-align: right;">
				      			116
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Kas Cadangan
				      		</div>
				      		<div class="col-xs-1 kas_cadangan_1">

				      		</div>
				      		<div class="col-xs-1 kas_cadangan_2">

				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-2" style="text-align: right;">
				      			117
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Kas di BCA
				      		</div>
				      		<div class="col-xs-1 kas_di_bca_1">

				      		</div>
				      		<div class="col-xs-1 kas_di_bca_2">

				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-2" style="text-align: right;">
				      			118	
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Bilyet Giro
				      		</div>
				      		<div class="col-xs-1 bilyet_giro_1">

				      		</div>
				      		<div class="col-xs-1 bilyet_giro_2">

				      		</div>
				      	</div> -->
				      	@foreach($account["a11"] as $a11)
				      		<div class="row">
				      			<div class="col-xs-2" style="text-align: right;">
				      				{{$a11->kode}}
				      			</div>
				      			<div class="col-xs-8" style="padding-left: 50px;">
				      				{{$a11->nama_account}}
				      			</div>
				      			<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a11->nama_account))))}}_1">

				      			</div>
				      			<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a11->nama_account))))}}_2">

				      			</div>
				      		</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
				      			Total Kas
				      		</div>
				      		<div class="col-xs-1 total_a11_1">

				      		</div>
				      		<div class="col-xs-1 total_a11_2">

				      		</div>
				      	</div>
				      	@foreach($account["a13"] as $a13)
				      	<div class="row">
				      		<div class="col-xs-1 col-xs-offset-1" style="text-align: right;">
				      			{{$a13->kode}}
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px; background : #DCE6F1;">
				      			<b><i>{{$a13->nama_account}}</i></b>
				      		</div>
				      		<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a13->nama_account))))}}_1" style="background : #DCE6F1;">
				      		.
				      		</div>
				      		<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a13->nama_account))))}}_2" style="background : #DCE6F1;">
				      		.
				      		</div>
				      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
				      			Total Sewa Bayar Di muka
				      		</div>
				      		<div class="col-xs-1 total_a13_1">

				      		</div>
				      		<div class="col-xs-1 total_a13_2">

				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-1 col-xs-offset-1" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px; background : #DCE6F1;">
				      			<b><i>Piutang</i></b>
				      		</div>
				      		<div class="col-xs-1 piutang_1" style="background : #DCE6F1;">
				      		.
				      		</div>
				      		<div class="col-xs-1 piutang_2" style="background : #DCE6F1;">
				      		.
				      		</div>
				      	</div>
				      	@foreach($account["a12"] as $a12)
				      		<div class="row">
				      			<div class="col-xs-2" style="text-align: right;">
				      				{{$a12->kode}}
				      			</div>
				      			<div class="col-xs-8" style="padding-left: 50px;">
				      				{{$a12->nama_account}}
				      			</div>
				      			<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a12->nama_account))))}}_1">

				      			</div>
				      			<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a12->nama_account))))}}_2">

				      			</div>
				      		</div>
				      	@endforeach
				      	<!-- <div class="row">
				      		<div class="col-xs-2" style="text-align: right;">
				      			121
				      		</div>
				      		<div class="col-xs-8" style="padding-left: 50px;">
				      			Piutang Usaha
				      		</div>
				      		<div class="col-xs-1">

				      		</div>
				      		<div class="col-xs-1">

				      		</div>
				      	</div> -->
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Piutang
			      			</div>
			      			<div class="col-xs-1 total_a12_1">

				      		</div>
				      		<div class="col-xs-1 total_a12_2">

				      		</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Aktiva Lancar
			      			</div>
			      			<div class="col-xs-1 total_aktiva_lancar_1">

			      			</div>
			      			<div class="col-xs-1 total_aktiva_lancar_2">

			      			</div>
			      		</div> 
			      		<div class="row">
			      			<div class="col-xs-12" style="background: #DCE6F1;">
			      				Aktiva Tetap
			      			</div>
			      			<br/>
			      			<div class="col-xs-10 col-xs-offset-2" style="background : #DCE6F1;">
			      				Kas
			      			</div>
			      		</div>
			      		@foreach($account["a14"] as $a14)
			      			<div class="row">
			      				<div class="col-xs-2" style="text-align: right;">
			      					{{$a14->kode}}
			      				</div>
			      				<div class="col-xs-8" style="padding-left: 50px;">
			      					{{$a14->nama_account}}
			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a14->nama_account))))}}_1">

			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a14->nama_account))))}}_2">

			      				</div>
			      			</div>
			      		@endforeach
			      		<!-- <div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				141
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Tanah
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				142
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Kantor / Gudang
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				143
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Akum. Penyus. Kantor / Gudang
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				144
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Meubeul & Alat Kantor
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				145
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Akum. Penyus. Meubeul & Kantor
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				146
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Kendaraan
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				147
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Akum. Penyus. Kendaraan
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div> -->
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Aktiva Tetap
			      			</div>
			      			<div class="col-xs-1 total_a14_1">

				      		</div>
				      		<div class="col-xs-1 total_a14_2">

				      		</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10" style="background: #DCE6F1;">
			      				<b>Total Assets</b>
			      			</div>
			      			<div class="col-xs-1 total_assets_1" style="background :#DCE6F1;">

			      			</div>
			      			<div class="col-xs-1 total_assets_2" style="background :#DCE6F1;">

			      			</div>
			      		</div>	
			      		<br/>
			      		<div class="row">
			      			<div class="col-xs-12" style="background: #4F81BD;">
			      				Passiva
			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-12" style="background: #DCE6F1;">
			      				Kewajiban
			      			</div>
			      		</div>
			      		@foreach($account["a21"] as $a21)
			      			<div class="row">
			      				<div class="col-xs-2" style="text-align: right;">
			      					{{$a21->kode}}
			      				</div>
			      				<div class="col-xs-8" style="padding-left: 50px;">
			      					{{$a21->nama_account}}
			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a21->nama_account))))}}_1">

			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a21->nama_account))))}}_2">

			      				</div>
			      			</div>
			      		@endforeach
			      		<!-- <div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				211
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Hutang Bank
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				212
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Hutang Bunga
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				213
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Hutang Non Usaha
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				214
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Hutang Gaji
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				215
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Hutang Pajak
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div> -->
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Kewajiban
			      			</div>
			      			<div class="col-xs-1 total_a21_1">

				      		</div>
				      		<div class="col-xs-1 total_a21_2">

				      		</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-12" style="background: #DCE6F1;">
			      				Modal
			      			</div>
			      			<br/>
			      			<div class="col-xs-10 col-xs-offset-2" style="background : #DCE6F1;">
			      				Modal Usaha
			      			</div>
			      		</div>
			      		@foreach($account["a31"] as $a31)
			      			<div class="row">
			      				<div class="col-xs-2" style="text-align: right;">
			      					{{$a31->kode}}
			      				</div>
			      				<div class="col-xs-8" style="padding-left: 50px;">
			      					{{$a31->nama_account}}
			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a31->nama_account))))}}_1">

			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a31->nama_account))))}}_2">

			      				</div>
			      			</div>
			      		@endforeach
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Modal Usaha
			      			</div>
			      			<div class="col-xs-1 total_a31_1">

				      		</div>
				      		<div class="col-xs-1 total_a31_2">

				      		</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10 col-xs-offset-2" style="background : #DCE6F1;">
			      				Prive
			      			</div>
			      		</div>
			      		@foreach($account["a32"] as $a32)
			      			<div class="row">
			      				<div class="col-xs-2" style="text-align: right;">
			      					{{$a32->kode}}
			      				</div>
			      				<div class="col-xs-8" style="padding-left: 50px;">
			      					{{$a32->nama_account}}
			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a32->nama_account))))}}_1">

			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a32->nama_account))))}}_2">

			      				</div>
			      			</div>
			      		@endforeach
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Prive
			      			</div>
			      			<div class="col-xs-1 total_a32_1">

				      		</div>
				      		<div class="col-xs-1 total_a32_2">

				      		</div>
			      		</div>
			      		<!-- <div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				311
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Modal As'adi
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				312
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Modal Imarudin AP
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-2" style="text-align: right;">
			      				313
			      			</div>
			      			<div class="col-xs-8" style="padding-left: 50px;">
			      				Modal Dadang Iskandar
			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      			<div class="col-xs-1">

			      			</div>
			      		</div> -->
			      		<div class="col-xs-10 col-xs-offset-2" style="background : #DCE6F1;">
			      			Laba
			      		</div>
			      		@foreach($account["a33"] as $a33)
			      			<div class="row">
			      				<div class="col-xs-2" style="text-align: right;">
			      					{{$a33->kode}}
			      				</div>
			      				<div class="col-xs-8" style="padding-left: 50px;">
			      					{{$a33->nama_account}}
			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a33->nama_account))))}}_1">

			      				</div>
			      				<div class="col-xs-1 {{str_replace('\'', "", str_replace('/', '-', str_replace(' ','_', strtolower($a33->nama_account))))}}_2">

			      				</div>
			      			</div>
			      		@endforeach
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Laba
			      			</div>
			      			<div class="col-xs-1 total_a33_1">

				      		</div>
				      		<div class="col-xs-1 total_a33_2">

				      		</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10" style="text-align: right; font-style: italic; font-weight: bold;">
			      				Total Modal
			      			</div>
			      			<div class="col-xs-1 total_modal_1">

			      			</div>
			      			<div class="col-xs-1 total_modal_2">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10" style="background: #DCE6F1;">
			      				<b>Total Passiva</b>
			      			</div>
			      			<div class="col-xs-1 total_pasiva_1" style="background :#DCE6F1;">

			      			</div>
			      			<div class="col-xs-1 total_pasiva_2" style="background :#DCE6F1;">

			      			</div>
			      		</div>
			      		<br/>
			      		<br/>
			      		<div class="row">
			      			<div class="col-xs-12" style="background: #4F81BD;">
			      				Rasio Keuangan Umum
			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10">
			      				<b>Rasio Utang</b> (Jumlah Kewajiban / Total Aktiva)
			      			</div>
			      			<div class="col-xs-1 rasio_utang_1">

			      			</div>
			      			<div class="col-xs-1 rasio_utang_2">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10">
			      				<b>Rasio Lancar</b> (Aktiva Lancar / Kewajiban Lancar)
			      			</div>
			      			<div class="col-xs-1 rasio_lancar_1">

			      			</div>
			      			<div class="col-xs-1 rasio_lancar_2">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10">
			      				<b>Modal Berjalan</b> (Aktiva Lancar - Kewajiban Lancar)
			      			</div>
			      			<div class="col-xs-1 modal_berjalan_1">

			      			</div>
			      			<div class="col-xs-1 modal_berjalan_2">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10">
			      				<b>Rasio Aset terhadap Modal</b> (Jumlah Aktiva / Modal)
			      			</div>
			      			<div class="col-xs-1 rasio_aset_terhadap_modal_1">

			      			</div>
			      			<div class="col-xs-1 rasio_aset_terhadap_modal_2">

			      			</div>
			      		</div>
			      		<div class="row">
			      			<div class="col-xs-10">
			      				<b>Rasio Hutang terhadap Modal</b> (Kewajiban / Modal)
			      			</div>
			      			<div class="col-xs-1 rasio_hutang_terhadap_modal_1">

			      			</div>
			      			<div class="col-xs-1 rasio_hutang_terhadap_modal_2">

			      			</div>
			      		</div>
		      		</div>
		      	</div>
		      </div>
		      <div class="box-footer">
		      <form method="POST" action="/account/neraca/print">
		      	<input type="hidden" name="_token" value="{{csrf_token()}}" />
		      	<input type="hidden" name="halaman" value="">
		      	<input type="hidden" name="stanggal" value="">
		        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
		      </form>
		      </div>
		  </div>
		</div>
	</div>
@stop

@section("scripts")
	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="/js/neraca.js"></script>
@stop