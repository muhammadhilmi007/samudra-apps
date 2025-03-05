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
		      <h3 class="box-title">Edit Data Truck</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/truck/{{$truck->id}}/edit">
		      <div class="box-body">
		        <div class="col-xs-6">
		          <label>No Polisi</label>
		          <input type="text" class="form-control" name="no_polisi" value="{{$truck->no_polisi}}" required>
		        </div>
		        <div class="col-xs-6">  
		          <label>Nama Truck</label>	
		          <input type="text" class="form-control" name="nm_truck" value="{{$truck->nama_kendaraan}}">	
		        </div>
		         <div class="col-xs-6">  
		          <label>Grup</label>	
		          <input type="text" class="form-control" name="grup" value="{{$truck->grup}}">	
		        </div>
		        @if(Auth::user()->hasRole('admin'))
		        	<div class="col-xs-6">
		        	  <label>Cabang</label>	
		        	  <select name="cabang" class="form-control select2">
		        	  	<option value=""></option>
		        	  	@foreach(\App\Cabang::all() as $c)
		        	  		<option value="{{$c['id']}}">{{$c['nama_cabang']}}</option>
		        	  	@endforeach
		        	  </select>
		        	</div>
		        @else
		        	<input type="hidden" class="form-control" name="cabang" value="{{Auth::user[cabang]}}" />
		        @endif
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
	<script src="/js/truck.js"></script>
	<script>
	$(document).ready(function(){
		@if(Auth::user()->hasRole('admin'))
		$("[name=cabang]").select2("val", {{$truck->cabang}});
		@endif
	});
	
	</script>
@stop