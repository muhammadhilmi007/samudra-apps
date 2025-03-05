@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/iCheck/all.css">
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
	<link rel="stylesheet" href="/plugins/select2/select2.css" />

@stop

@section("content")
	<div class="row">
		<div class="col-md-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Add User</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/admin/user/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>Name</label>
		          <input type="text" class="form-control" name="name" placeholder="Insert Name" required>
		        </div>
		        <div class="form-group">
		          <label>Email</label>
		          <input type="email" class="form-control" name="email" placeholder="Insert Email">
		        </div>
		        <div class="form-group">
		          <label>Password</label>
		          <input type="password" class="form-control" name="password" placeholder="Password">
		        </div>
		        <div class="form-group">
		          <label>Re-Type Password</label>
		          <input type="password" class="form-control" name="repassword" readonly placeholder="Re-Type Password">
		        </div>
		        <div class="form-group">
		          <label>Cabang</label>
		          <select name="cabang" class="form-control select2" style="width: 100% !important;">
		          	<option value=""></option>
		          	@foreach($cabang as $d)
		          		<option value="{{$d->id}}">{{$d->nama_cabang}} | {{$d->s_divisi->nama_divisi}}</option>
		          	@endforeach
		          </select>
		        </div>
		        <div class="form-group">
		          <label>Role(s)</label>
		          @foreach($roles as $r)
		          	<br/>
		          	&emsp; <input type="checkbox" name="role[]" value="{{$r->id}}" class="minimal" /> &nbsp; {{$r->display_name}}
		          @endforeach
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
			    <h3 class="box-title">User List</h3>
			  </div>
			  <div class="box-body">
			  	<table class="table table-bordered table-hover">
			  		<thead>
			  			<tr>
			  				<th>Id</th>
			  				<th>Name</th>
			  				<th>Email</th>
			  				<th>Cabang</th>
			  				<th>Role(s)</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			@foreach($users as $user)
			  			<tr>
			  				<td>{{$user->id}}</td>
			  				<td>{{$user->name}}</td>
			  				<td>{{$user->email}}</td>
			  				<td>{{$user->s_cabang->nama_cabang}}</td>

			  				<td>
			  					@foreach($user->roles as $i => $r) 
			  						@if($i > 0) - @endif {{$r->display_name}}  
			  					@endforeach
			  				</td>
			  				<td>
			  					<a href="/admin/user/{{$user->id}}/delete" confirm="Apakah anda yakin akang menghapus user {{$user->name}} ?">
			  						<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
			  					</a>
			  					<button type="button" class="btn btn-xs btn-info btn_edit" userid="{{$user->id}}"><i class="fa fa-pencil"></i></button>
			  				</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  	</table>
			  </div>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/admin/user/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  	</div>
			  </div>
			</div>
		</div>
	</div>
	<div class="modal fade in" id="modal-edituser">
      <form method="POST" id="edit_user">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit User</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Insert Name" required>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Insert Email" disabled>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label>Cabang</label>
                    <select name="cabang" class="form-control select2" style="width: 100% !important;">
                    	<option value=""></option>
                    	@foreach($cabang as $d)
                    		<option value="{{$d->id}}">{{$d->nama_cabang}}</option>
                    	@endforeach
                    </select>
                  </div>
                  <!-- <div class="form-group">
                    <label>Re-Type Password</label>
                    <input type="password" class="form-control" name="repassword" readonly placeholder="Re-Type Password">
                  </div> -->
                  <div class="form-group">
                    <label>Role(s)</label>
                    @foreach($roles as $r)
                    	<br/>
                    	&emsp; <input type="checkbox" name="role[]" value="{{$r->id}}" class="minimal edit_role" /> &nbsp; {{$r->display_name}}
                    @endforeach
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
	<script src="/plugins/iCheck/icheck.min.js"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/user.js"></script>
@stop