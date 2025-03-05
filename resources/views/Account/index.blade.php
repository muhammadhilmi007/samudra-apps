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
		      <h3 class="box-title">Tambah Account</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/account/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>Kode</label>
		          <input type="text" class="form-control" name="kode" placeholder="Insert Kode" required>
		          <label>Nama Account</label>
		          <input type="text" class="form-control" name="nama" placeholder="Insert Account Name" required>
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
			    <h3 class="box-title">Account List</h3>
			  </div>
			  <div class="box-body">
			  	<table class="table table-bordered table-hover">
			  		<thead>
			  			<tr>
			  				<th>Kode</th>
			  				<th>Nama Account</th>
			  				<th>Action</th>
			  			</tr>
			  		</thead>
			  		<tbody>
			  			@foreach($account as $a)
			  			<tr>
			  				<td>{{$a->kode}}</td>
			  				<td>{{$a->nama_account}}</td>
			  				<td>
			  					
			  					<a href="/account/{{$a->id}}/delete" confirm="Apakah anda yakin akang menghapus divisi {{$a->nama_account}} ?">
			  						<button type="button" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
			  					</a>
			  					<button type="button" class="btn btn-xs btn-info btn_edit" accountid="{{$a->id}}"><i class="fa fa-pencil"></i></button>
			  				</td>
			  			</tr>
			  			@endforeach
			  		</tbody>
			  	</table>
			  </div>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<!-- <a href="/divisi/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a> -->
			  	</div>
			  </div>
			</div>
		</div>
		
	</div>
	<div class="modal fade in" id="modal-editaccount">
      <form method="POST" id="edit_account">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Edit Account</h4>
            </div>
            <div class="modal-body">
                <div class="box-body">
                  <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" name="kode" placeholder="Kode" required>
                  </div>
                  <div class="form-group">
                    <label>Nama Account</label>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Account" required>
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
	<script src="/js/account.js"></script>
@stop