@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<link rel="stylesheet" href="/plugins/datepicker/datepicker3.css" />
@stop

@section("content")
	<div class="row">
		@permission("req_pengambilan_barang:create")
		<div class="col-lg-4">
			<div class="box box-primary">
			    <div class="box-header with-border">
			        <h3 class="box-title">Request Pengambilan Barang</h3>
			    </div>
				<form method="POST" action="/req_pengambilan_barang/add">
				  <div class="box-body">
				    <div class="form-group">
			      	  <label>Pengirim</label>
				      <input type="text" class="form-control" name="pengirim" required>
				    </div>
				    <div class="form-group">
			      	  <label>Penerima</label>
				      <input type="text" class="form-control" name="penerima" required>
				    </div>
		    	    <div class="form-group">
		          	  <label>Alamat Pengambilan</label>
		          	  <textarea class="form-control" name="alamat_pengambilan" required></textarea>
		    	    </div>
		    	    <div class="form-group">
		          	  <label>Tujuan</label>
		          	  <textarea class="form-control" name="tujuan" required></textarea>
		    	    </div>
		    	    <div class="form-group">
			      	  <label>Jumlah Colly</label>
				      <input type="text" class="form-control" name="jumlah_colly" pattern="[0-9]+" required>
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
				  <div class="box-footer">
				  	<input type="hidden" name="_token" value="{{csrf_token()}}" />
				    <button type="submit" class="btn btn-primary">Submit</button>
				  </div>
				</form>
			</div>
		</div>
		@endpermission
		@permission("req_pengambilan_barang:read")
		<div class="col-lg-8">
			<div class="box box-primary">
			    <div class="box-header with-border">
			        <h3 class="box-title">List Request Pengambilan Barang</h3>
			    </div>
  			    <div class="box-body">
  			    	<table class="table table-hover table-stripped">
  			    		<thead>
  			    			<tr>
  			    				<th>id</th>
  			    				<th>Pengirim</th>
  			    				<th>Alamat Pengambilan</th>
  			    				<th>Tujuan</th>
  			    				<th>Jumlah Colly</th>
  			    				<th>Tanggal</th>
  			    				<th>Status</th>
  			    				@role("admin")
  			    				<th>Action</th>
  			    				@endrole
  			    			</tr>
  			    		</thead>
  			    		<tbody>
  			    			@foreach($req as $r)
  			    			<tr>
  			    				<td>{{$r->id}}</td>
  			    				<td>{{$r->pengirim}}</td>
  			    				<td>{{$r->alamat_pengambilan}}</td>
  			    				<td>{{$r->tujuan}}</td>
  			    				<td>{{$r->jumlah_colly}}</td>
  			    				<td>{{$r->tanggal}}</td>
  			    				<td>
  			    					@if($r->status == "new")
  			    						<button type="button" class="btn btn-xs btn-info">New</button>
  			    					@elseif($r->status == "done")
  			    						<button type="button" class="btn btn-xs btn-success">Done</button>
  			    					@endif
  			    				</td>
  			    				@permission("req_pengambilan_barang:update")
  			    				<td>
  			    					@if($r->status == "new")
  			    						<a href="/req_pengambilan_barang/{{$r->id}}/setdone" confirm="Anda yakin menyatakan pengambilan dengan pengirim {{$r->pengirim}} selesai ?">
  			    							<button type="button" class="btn btn-xs btn-success"><i class="fa fa-check"></i></button>
  			    						</a>
  			    					@endif
  			    				</td>
  			    				@endpermission
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
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/plugins/datepicker/bootstrap-datepicker.js"></script>
	<script src="/dist/js/moment.min.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script src="/js/reqpengambilanbarang.js"></script>
@stop