@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
@stop

@section("content")
	<div class="row">
		<div class="col-lg-12">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Edit Data Kendaraan</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/kendaraan/{{$kendaraan->id}}/edit">
		      <div class="box-body">
		        <div class="col-xs-6">
		          <label>No Polisi</label>
		          <input type="text" class="form-control" name="no_polisi" value="{{$kendaraan->no_polisi}}" required>
		        </div>
		        <div class="col-xs-6">  
		          <label>Nama Kendaraan</label>	
		          <input type="text" class="form-control" name="nm_kendaraan" value="{{$kendaraan->nama_kendaraan}}">	
		        </div>
		         <div class="col-xs-6">  
		          <label>Grup</label>	
		          <input type="text" class="form-control" name="grup" value="{{$kendaraan->grup}}">	
		        </div>
		        <div class="col-xs-6">  
		          <label>Cabang</label>	
		          @if(Auth::user()->hasRole("admin"))
		          	<select name="cabang" class="form-control select2">
		          		<option value=""></option>
		          		@foreach(App\Cabang::all() as $cabang)
		          			<option value="{{$cabang->id}}" @if($cabang->id == $kendaraan->s_cabang->id) selected @endif>{{$cabang->nama_cabang}}</option>
		          		@endforeach
		          	</select>
		          @else
		          	<input type="text" disabled class="form-control" value="{{$kendaraan->s_cabang->nama_cabang}}" />
		          	<input type="hidden" name="cabang" value="{{$kendaraan->s_cabang->id}}" />
		          @endif
		        </div>
		      </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary pull-right">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
	</div>
@stop

@section("scripts")
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/kendaraan.js"></script>
	<script>
	$(document).ready(function(){
		$("[name=supir]").select2("val", {{$kendaraan->supir}});
		$("[name=kernet]").select2("val", {{$kendaraan->kernet}});
		@if(Auth::user()->hasRole("admin"))
			$("[name=cabang]").select2("val", {{$kendaraan->cabang}});
		@endif
	});
	
	</script>
@stop