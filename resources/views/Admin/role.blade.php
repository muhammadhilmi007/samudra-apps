@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
@stop

@section("content")
	<div class="row">
		<div class="col-md-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Add Role</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/admin/role/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>Role Name</label>
		          <input type="text" class="form-control" name="name" placeholder="Name of role" required>
		        </div>
		        <div class="form-group">
		          <label>Display Name</label>
		          <input type="text" class="form-control" name="display_name" placeholder="Display Name">
		        </div>
		        <div class="form-group">
		          <label>Description</label>
		          <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
		        </div>
		      </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
		<div class="col-md-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Role List</h3>
			  </div>
			  <div class="box-body">
			  	<table class="table table-bordered table-hover">
			  		<thead>
			  			<tr>
			  				<th>Id</th>
			  				<th>Name</th>
			  				<th>Display Name</th>
			  				<th>Description</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			@foreach($role as $r)
			  			<tr>	
			  				<td>{{$r->id}}</td>
			  				<td>{{$r->name}}</td>
			  				<td>{{$r->display_name}}</td>
			  				<td>{{$r->description}}</td>
			  				<td align="center">
			  					<a href="/admin/role/{{$r->id}}/delete" confirm="Apakah anda yakin akan menghapus role {{$r->name}} ?">
			  						<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
			  					</a>
			  					<button type="button" class="btn btn-info btn-xs btn_edit" roleid="{{$r->id}}"><i class="fa fa-pencil"></i></button>
			  				</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  	</table>
			  </div>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/admin/role/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  	</div>
			  </div>
			</div>
		</div>
	</div>

		<div class="modal fade in" id="modal-editrole">
	      <form method="POST" id="edit_role">
	        <div class="modal-dialog">
	          <div class="modal-content">
	            <div class="modal-header">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	              <h4 class="modal-title">Edit Role</h4>
	            </div>
	            <div class="modal-body">
	                <div class="box-body">
	                  <div class="form-group">
	                    <label>Role Name</label>
	                    <input type="text" class="form-control" name="name" placeholder="Name of role" required>
	                  </div>
	                  <div class="form-group">
	                    <label>Display Name</label>
	                    <input type="text" class="form-control" name="display_name" placeholder="Display Name">
	                  </div>
	                  <div class="form-group">
	                    <label>Description</label>
	                    <textarea class="form-control" name="description" placeholder="Enter Description"></textarea>
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
@stop

@section("scripts")
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/js/role.js"></script>
@stop