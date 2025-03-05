@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css" />
	<style>
	.subjd{
		font-size: 12pt;
		font-weight: bold;
	}
	</style>
@stop

@section("content")
	<div class="row">
		<div class="col-md-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">
		      	Laba Rugi
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
		      		<div class="col-xs-4">
				      	<h4>
				      		PT. {{Auth::user()->s_cabang->s_divisi->nama_divisi}}
				      	</h4>
		      		</div>
		      		<div class="col-xs-4">
		      			<div class="col-xs-4">
		      				<label>Bulan</label>
		      			</div>
		      			<div class="col-xs-8">
		      				<select name="bulan" class="form-control">
		      					<option value=""></option>
		      					@for($bln = 1; $bln <= 12; $bln++)
		      						<option value="{{$bln}}">{{date('F', mktime(0,0,0,$bln,1,date('Y')))}} </option>
		      					@endfor
		      				</select>
				      	</div>
		      		</div>
		      		<div class="col-xs-4">
		      			<div class="col-xs-4">
		      				<label>Tahun</label>
		      			</div>
		      			<div class="col-xs-8">
		      				<select name="tahun" class="form-control">
		      					<option value=""></option>
		      					@for($thn = 2013; $thn <= date('Y'); $thn++)
		      						<option value="{{$thn}}">{{$thn}}</option>
		      					@endfor
		      				</select>
				      	</div>
		      		</div>
		      	</div>
		      	<div class="row">
		      		<div class="col-md-12" style="padding-left: 30px; padding-right: 30px;">
				      	<div class="row">
				      		<div class="col-xs-5" style="background: #4F81BD; color : white;">
				      			PENDAPATAN
				      		</div>
				      		<div class="col-xs-2 tahun_stat" style="background: #4F81BD; color : white; text-align: center;">
				      			--
				      		</div>
				      		<div class="col-xs-1" style="background: #4F81BD; color : white; text-align: center;">
				      			% of OI
				      		</div>
				      		<div class="col-xs-3 bulan_stat" style="background: #4F81BD; color : white; text-align: center;">
				      			--
				      		</div>
				      		<div class="col-xs-1" style="background: #4F81BD; color : white; text-align: center;">
				      			% of OI
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Pendapatan Operasional
				      		</div>
				      	</div>
				      	@foreach($account["a41"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="border-bottom: 1px solid black;">
				      			&nbsp;
				      		</div>
				      		<div class="col-xs-2" style="text-align: center;">
				      			<input type="text" readonly value="" style="text-align: right;"></input>
				      		</div>
				      		<div class="col-xs-1" style="text-align: right;">
				      			-
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<input type="text" readonly value="" style="text-align: center;"></input>
				      		</div>
				      		<div class="col-xs-1" style="text-align: right;">
				      			-
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Pendapatan Operasional (OI)
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a41">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a41" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a41" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a41" style="text-align: right;">
				      			
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Pendapatan Non-Operasional
				      		</div>
				      	</div>
				      	@foreach($account["a42"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">

					      		</div>
					      	</div>
				      	@endforeach
				      	@foreach($account["a43"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="border-bottom: 1px solid black;">
				      			&nbsp;
				      		</div>
				      		<div class="col-xs-2" style="text-align: center;">
				      			<input type="text" readonly value="" style="text-align: right;"></input>
				      		</div>
				      		<div class="col-xs-1" style="text-align: right;">
				      			-
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<input type="text" readonly value="" style="text-align: center;"></input>
				      		</div>
				      		<div class="col-xs-1" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Pendapatan Non-Operasional
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a4243">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a4243" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a4243" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a4243" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-5" style="background: #DCE6F1; color : #000; font-weight: bold;">
				      			Total INCOME
				      		</div>
				      		<div class="col-xs-2" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right totIncomeThn">

				      			</span>
				      		</div>
				      		<div class="col-xs-1" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			100,1%
				      		</div>
				      		<div class="col-xs-3" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right totIncomeBln" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			100,1%
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12" style="background: #4F81BD; color : white;">
				      			BIAYA
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Biaya Potongan Pendapatan
				      		</div>
				      	</div>
				      	@foreach($account["a51"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Operating Expenses
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a51">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a51" style="text-align: right;">
				      			100,0%
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a51" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a51" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Biaya Operasional Lain
				      		</div>
				      	</div>
				      	@foreach($account["a52"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			#REF!
					      		</div>
					      	</div>
				      	@endforeach
				      	@foreach($account["a53"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Biaya Operasional
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a5253">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a5253" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a5253" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a5253" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-5" style="background: #DCE6F1; color : #000; font-weight: bold;">
				      			LABA BRUTO
				      		</div>
				      		<div class="col-xs-2" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right totLabaBrutoThn">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_totLabaBrutoThn" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right totLabaBrutoBln" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_totLabaBrutoBln" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Biaya Penyusutan
				      		</div>
				      	</div>
				      	@foreach($account["a54"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Biaya Penyusutan
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a54">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a54" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a54" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a54" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Biaya Berjangka
				      		</div>
				      	</div>
				      	@foreach($account["a55"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Biaya Berjangka
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a55">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a55" style="text-align: right;">
				      			100,0%
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a55" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a55" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-12 col-xs-offset-1 subjd">
				      			Biaya Lain-lain
				      		</div>
				      	</div>
				      	@foreach($account["a56"] as $ac)
					      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			{{$ac->nama_account}}
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;" class="nomThn_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiThn_{{$ac->kode}}" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: right;" class="nomBln_{{$ac->kode}}"></input>
					      		</div>
					      		<div class="col-xs-1 oiBln_{{$ac->kode}}" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					      	</div>
				      	@endforeach
				      	<div class="row">
				      		<div class="col-xs-4 col-xs-offset-1" style="text-align: right; font-weight: bold;">
				      			Total Biaya Lain-lain
				      		</div>
				      		<div class="col-xs-2">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomThn_a56">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomThn_a56" style="text-align: right;">
				      			
				      		</div>
				      		<div class="col-xs-3" style="text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right tot_nomBln_a56" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_tot_nomBln_a56" style="text-align: right;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
				      		<div class="col-xs-5" style="background: #DCE6F1; color : #000; font-weight: bold;">
				      			TOTAL EXPENSES
				      		</div>
				      		<div class="col-xs-2" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right totExpensesThn">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_totExpensesThn" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			&nbsp;
				      		</div>
				      		<div class="col-xs-3" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right totExpensesBln" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_totExpensesBln" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
				      	<div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			Laba Bersih Sebelum Pajak
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;"></input>
					      		</div>
					      		<div class="col-xs-1" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="#REF!" style="text-align: center;"></input>
					      		</div>
					      		<div class="col-xs-1" style="text-align: right;">
					      			<!-- #REF! -->
					      		</div>
					    </div>
					    <div class="row">
					      		<div class="col-xs-4 col-xs-offset-1">
					      			Pajak Penghasilan
					      		</div>
					      		<div class="col-xs-2" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: right;"></input>
					      		</div>
					      		<div class="col-xs-1" style="text-align: right;">
					      			
					      		</div>
					      		<div class="col-xs-3" style="text-align: center;">
					      			<input type="text" readonly value="" style="text-align: center;"></input>
					      		</div>
					      		<div class="col-xs-1" style="text-align: right;">
					      			
					      		</div>
					    </div>
					    <div class="row">
				      		<div class="col-xs-5" style="background: #DCE6F1; color : #000; font-weight: bold;">
				      			LABA BERSIH
				      		</div>
				      		<div class="col-xs-2" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left">
				      			Rp
				      			</span>
				      			<span class="pull-right totLabaBersihThn">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_labaBersihThn" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			&nbsp;
				      		</div>
				      		<div class="col-xs-3" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<span class="pull-left" style="margin-left: 40px;">
				      			Rp
				      			</span>
				      			<span class="pull-right totLabaBersihBln" style="margin-right: 40px;">

				      			</span>
				      		</div>
				      		<div class="col-xs-1 oi_labaBersihBln" style="background: #DCE6F1; color : #000; font-weight: bold; text-align: center;">
				      			<!-- #REF! -->
				      		</div>
				      	</div>
		      		</div>
		      	</div>
		      </div>
		      <div class="box-footer">
		      <!-- <form method="POST" action="/account/neraca/print"> -->
		      <form method="POST" action="/account/labarugi/printlabarugi">
		      	<input type="hidden" name="_token" value="{{csrf_token()}}" />
		      	<input type="hidden" name="halaman" value="">
		      	<input type="hidden" name="stanggal" value="">
		        <!-- <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button> -->
		        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-print"></i> Print</button>
		      </form>
		      </div>
		  </div>
		</div>
	</div>
@stop

@section("scripts")
	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="/js/labarugi.js"></script>
@stop