@extends("base")

@section("styles")
	<style>
		/* The switch - the box around the slider */
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 45px;
		  height: 25px;
		}

		/* Hide default HTML checkbox */
		.switch input {display:none;}

		/* The slider */
		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 18px;
		  width: 18px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(18px);
		  -ms-transform: translateX(18px);
		  transform: translateX(18px);
		}

		/* Rounded sliders */
		.slider.round {
		  border-radius: 25px;
		}

		.slider.round:before {
		  border-radius: 50%;
		}
		

		td, th{
			/*white-space: nowrap;*/
			font-size: 14px;
			word-wrap:break-word;
			height: 80px;
		}		

		.first-col {
		    position: absolute;
		    width: 18em;
		    margin-left: -18em;
		}

		.table-wrapper {
		    overflow-x: scroll;
		    width: 837px;
		    margin-left: 18em;
		}

	</style>
@stop

@section("content")
	<?php
		function checkRolePerm($roleandpermission, $reqrole, $reqperm){
			foreach($roleandpermission as $rp){
				$role = $rp->role_id;
				$permission = $rp->permission_id;
				if($reqrole == $role && $reqperm == $permission){
					return "checked";
				}
			}

		}
	?>
	<div class="row">
		<form method="POST" action="/admin/permission/actroleperm">
		<div class="col-lg-12">
			<div class="box box-primary">
			    <div class="box-header with-border">
			      <h3 class="box-title">Role & Permission</h3>
			      <div class="pull-right">
			      	<button type="button" class="btn btn-sm btn-info btn_add_permission"><i class="fa fa-plus"></i> Permission</button>
			      </div>
			    </div>
			    <div class="table-wrapper">
			    	<table class="table table-bordered table-striped table-hover">
			    		<thead>
				    		<tr>
				    			<th class="first-col">Permission</th>
				    			@foreach($role as $i => $r)
				    				<th valign="top">{{$r->name}}</th>
				    			@endforeach
				    		</tr>
			    		</thead>
			    		<tbody>
			    			@foreach($permission as $p)
			    			<tr>
			    				<td class="first-col">
			    					<span style="font-weight: bold; text-size: 12pt;">{{$p->display_name}}</span><br/>
			    					{{$p->description}}
			    				</td>
			    				@foreach($role as $r)
			    					<th style="vertical-align: middle; text-align: center;">
			    						<label class="switch">
			    						  <input type="checkbox" name="roleperm[]" value="{{$p->id}}-{{$r->id}}" {{checkRolePerm($roleperm,$r->id, $p->id)}}>
			    						  <div class="slider round"></div>
			    						</label>
			    					</th>
			    				@endforeach
			    			</tr>
			    			@endforeach
			    		</tbody>
			    	</table>
			    </div>
			    <div class="box-footer">
			    	<div class="pull-left">
			    		<a href="/admin/permission/export/excel">
			    			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			    		</a>
			    	</div>
			    </div>
		  	</div>
		  			<input type="hidden" name="_token" value="{{csrf_token()}}" />
			    	<button type="submit" class="btn btn-warning pull-right"><i class="fa fa-save"></i> Simpan</button>
		</div>
		</form>
	</div>

	<div class="modal fade in" id="modal-add">
	  <form method="POST" action="/admin/permission/add">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Tambah Permission</h4>
	      </div>
	      <div class="modal-body">
	        <div class="form-group">
	          <label>Permission Name</label>
	          <input type="text" class="form-control" name="name" placeholder="Name of permission" required>
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
	      <div class="modal-footer">
	      	<input type="hidden" name="_token" value="{{csrf_token()}}" />
	        <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
	        <button type="submit" class="btn btn-info"><i class="fa fa-plus"></i> Tambah</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>
@stop

@section("scripts")
	<script src="/js/permission.js"></script>
@stop