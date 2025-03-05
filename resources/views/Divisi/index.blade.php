@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
@stop

@section("content")
	<div class="row">
		@permission("divisi:create")
		<div class="col-md-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Tambah Divisi</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/divisi/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>Nama Divisi</label>
		          <input type="text" class="form-control" name="name" placeholder="Insert Name" required>
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
		@permission("divisi:read")
		<div class="col-md-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Divisi List</h3>
			  </div>
			  <div class="box-body">
			  	<table class="table table-bordered table-hover">
			  		<thead>
			  			<tr>
			  				<th>Id</th>
			  				<th>Name</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			@foreach($divisi as $d)
			  			<tr>
			  				<td>{{$d->id}}</td>
			  				<td>{{$d->nama_divisi}}</td>
			  				<td>
			  					@permission("divisi:delete")
			  					<a href="/divisi/{{$d->id}}/delete" confirm="Apakah anda yakin akang menghapus divisi {{$d->nama_divisi}} ?">
			  						<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
			  					</a>
			  					@endpermission
			  					@permission("divisi:update")
			  					<button type="button" class="btn btn-xs btn-info btn_edit" divisiid="{{$d->id}}"><i class="fa fa-pencil"></i></button>
			  					@endpermission
			  				</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  	</table>
			  </div>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/divisi/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  	</div>
			  </div>
			</div>
		</div>
		@endpermission
	</div>
	@permission("divisi:update")
	<div class="modal fade in" id="modal-editdivisi">
      <form method="POST" id="edit_divisi">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Divisi</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Nama Divisi</label>
                    <input type="text" class="form-control" name="name" placeholder="Nama Divisi" required>
                  </div>
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
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/js/divisi.js"></script>
@stop