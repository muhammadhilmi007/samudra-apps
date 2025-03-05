@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css" />
@stop

@section("content")
	<div class="row">
		@permission("pengambilan_barang:create")
		<div class="col-lg-12">
			<div class="box box-primary">
			    <div class="box-header with-border">
			        <h3 class="box-title">Pengambilan Barang</h3>
			    </div>
				<form method="POST" action="/pengambilan_barang/add">
				  <div class="box-body">
					  <div class="col-md-6">
					  	 <div class="form-group">
				      	  <label>No Pengambilan</label>
					      <select name="no_pengambilan" class="select2 form-control">
					      	<option value=""></option>
					      	@foreach($req as $r)
					      		<option value="{{$r->id}}">ID : {{$r->id}} | Pengirim : {{$r->pengirim}} | Penerima : {{$r->penerima}}</option>
					      	@endforeach
					      </select>
					    </div>
					    <div class="form-group">
				      	  <label>Pengirim</label>
					      <input type="text" class="form-control" name="pengirim" required>
					    </div>
					    <div class="form-group">
				      	  <label>STT</label>
					      <select name="stt[]" class="form-control select2" multiple="multiple" required>
					      	<option value=""></option>
					      	@foreach($stt as $s)
					      		<option value="{{$s->stt}}">{{$s->stt}}</option>
					      	@endforeach
					      </select>
					    </div>
					    <div class="form-group">
					    	<label>Kendaraan</label>
					    	<select name="kendaraan" class="form-control select2">
					    		<option value=""></option>
					    		@foreach($kendaraan as $k)
					    			<option value="{{$k->id}}">ID : {{$k->id}} | {{$k->no_polisi}} | {{$k->nama_kendaraan}}</option>
					    		@endforeach
					    	</select>
					    </div>
					  </div>
					  <div class="col-md-6">
					  	<div class="form-group">
				      	  <label>Waktu Berangkat</label>
					      <input type="text" class="form-control timepicker" name="waktu_berangkat" required>
					    </div>
					    <div class="form-group">
				      	  <label>Waktu Pulang</label>
					      <input type="text" class="form-control timepicker" name="waktu_pulang" required>
					    </div>
					    <div class="form-group">
					      <label>Tanggal</label>
					      <input type="text" class="form-control" name="tanggal" datepicker required>
					    </div>
					    @role("admin")
				    	<div class="form-group">
				    		<label>Cabang</label>
				    		<select name="cabang" class="select2 form-control">
				    			<option value=""></option>
				    			@foreach($cabang as $c)
				    				<option value="{{$c->id}}">{{$c->nama_cabang}}</option>
				    			@endforeach
				    		</select>
				    	</div>
					    @endrole
					  </div>
				  </div>
				  <div class="box-footer">
				  	<input type="hidden" name="_token" value="{{csrf_token()}}" />
				    <button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</form>
			</div>
		</div>
		@endpermission
		@permission("pengambilan_barang:read")
		<div class="col-lg-12">
			<div class="box box-primary">
			    <div class="box-header with-border">
			        <h3 class="box-title">List Pengambilan Barang</h3>
			    </div>
  			    <div class="box-body">
  			    	<table class="table table-hover table-stripped">
  			    		<thead>
  			    			<tr>
  			    				<th>No</th>
  			    				<th>Pengirim</th>
  			    				<th>STT</th>
  			    				<th>Kode Pengambilan</th>
  			    				<th>Kendaraan</th>
  			    				<th>Berangkat</th>
  			    				<th>Pulang</th>
  			    				<th>Tanggal</th>
  			    				<th>Cabang</th>
  			    			</tr>
  			    		</thead>
  			    		<tbody class="datatable">
  			    			@foreach($pbar as $p)
  			    				<tr>
  			    					<td>{{$p->no_pengambilan}}</td>
  			    					<td>{{$p->pengirim}}</td>
  			    					<td>{{$p->stt}}</td>
  			    					<td>{{$p->kode_pengambilan}}</td>
  			    					<td>{{$p->s_kendaraan->nama_kendaraan}}</td>
  			    					<td>{{$p->waktu_berangkat}}</td>
  			    					<td>{{$p->waktu_pulang}}</td>
  			    					<td>{{$p->tanggal}}</td>
  			    					<td>{{$p->s_cabang->nama_cabang}}</td>
  			    				</tr>
  			    			@endforeach
  			    		</tbody>
  			    	</table>
  			    </div>
		</div>
		@endpermission
	</div>
@stop

@section("scripts")
	<script src="/dist/js/moment.min.js"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script src="/js/reqpengambilanbarang.js"></script>
@stop