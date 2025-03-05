@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<style type="text/css">
	  #klinikonmap {
	    height: 300px;
	  }
	  #klinikonmap2 {
	    height: 300px;
	  }
	</style>
@stop

@section("content")
	<div class="row">
		@permission("cabang:create")
		<div class="col-md-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Tambah Cabang</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/cabang/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>Nama Cabang</label>
		          <input type="text" class="form-control" name="name" placeholder="Nama Cabang" required>
		        </div>
		        <div class="form-group">
		          <label>Kode Cabang</label>
		          <input type="text" class="form-control" name="kode" placeholder="Kode Cabang" required>
		        </div>
		        <div class="form-group">
		          <label>Divisi</label>
		          <select name="divisi" class="form-control select2">
		          	<option value=""></option>
		          	@foreach($divisi as $d)
		          		<option value="{{$d->id}}">{{$d->nama_divisi}}</option>
		          	@endforeach
		          </select>
		        </div>
		        <div class="form-group">
		        	<label>Maps</label>
		        	<dd><div id='klinikonmap'></div></dd>
		        </div>
		        <div class="form-group">
		        	<label>Latitude</label>
		        	<input type="text" name="latitude" readonly value="-6.870978788759881" class="form-control" />
		        </div>
		        <div class="form-group">
		        	<label>Longitude</label>
		        	<input type="text" name="longitude" readonly value="107.57213680043697" class="form-control" />
		        </div>
		        <div class="form-group">
		        	<label>Pusat ?</label> <br/>
		        	<input type="checkbox" name="pusat" />
		        </div>
		      </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
		@endpermission
		@permission("cabang:read")
		<div class="col-md-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Cabang List</h3>
			  </div>
			  <div class="box-body">
			  	<table class="table table-bordered table-hover">
			  		<thead>
			  			<tr>
			  				<th>Id</th>
			  				<th>Kode Cabang</th>
			  				<th>Nama Cabang</th>
			  				<th>Divisi</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			@foreach($cabang as $d)
			  			<tr>
			  				<td>{{$d->id}}</td>
			  				<td>{{$d->kode_cabang}}</td>
			  				<td>{{$d->nama_cabang}}</td>
			  				<td>{{$d->s_divisi->nama_divisi}}</td>
			  				<td>
			  					@permission("cabang:delete")
			  					<a href="/divisi/{{$d->id}}/delete" confirm="Apakah anda yakin akang menghapus cabang {{$d->nama_cabang}} ?">
			  						<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
			  					</a>
			  					@endpermission
			  					@permission("cabang:update")
			  					<button type="button" class="btn btn-xs btn-info btn_edit" cabangid="{{$d->id}}"><i class="fa fa-pencil"></i></button>
			  					@endpermission
			  				</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  	</table>
			  </div>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/cabang/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  	</div>
			  </div>
			</div>
		</div>
		@endpermission
	</div>
	@permission("cabang:update")
	<div class="modal fade in" id="modal-editcabang">
      <form method="POST" id="edit_cabang">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Cabang</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Cabang</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Cabang" required>
                  </div>
                <div class="form-group">
                  <label>Kode Cabang</label>
                  <input type="text" class="form-control" name="kode" placeholder="Kode Cabang" required>
                </div>
                
                  <div class="form-group">
                    <label>Divisi</label>
                    <select name="divisi" class="form-control select2" style="width: 100% !important;">
                    	<option value=""></option>
                    	@foreach($divisi as $d)
                    		<option value="{{$d->id}}">{{$d->nama_divisi}}</option>
                    	@endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                	<label>Maps</label>
                	<dd><div id='klinikonmap2'></div></dd>
                </div>
                <div class="form-group">
                	<label>Latitude</label>
                	<input type="text" name="latitude2" readonly class="form-control" />
                </div>
                <div class="form-group">
                	<label>Longitude</label>
                	<input type="text" name="longitude2" readonly class="form-control" />
                </div>
                <div class="form-group">
                	<label>Pusat ?</label> <br/>
                	<input type="checkbox" name="pusat" />
                </div>
                <input type="hidden" name="_token" value="{{csrf_token()}}" />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
              <a href="#" class="modal-confirm-href">
                <button type="submit" class="btn btn-danger">Simpan</button>
              </a>
            </div>
          </div>
        </div>
      </form>
      </div>
      @endpermission
@stop

@section("scripts")
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtOpFXzomqDi7ajn6dIkP5l6x8O3BuDHI"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/cabang.js"></script>
@stop