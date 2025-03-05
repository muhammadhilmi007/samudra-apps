@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<style>
	@if(!Auth::user()->can("kendaraan:update"))
		.btn_edit{
			display: none;
		}
	@endif

	@if(!Auth::user()->can("kendaraan:delete"))
		.btn-danger{
			display: none;
		}
	@endif
	</style>
@stop

@section("content")
	<div class="row">
		@permission("kendaraan:create")
		<div class="col-lg-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Input Data Kendaraan</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/kendaraan/add">
		      <div class="box-body">
		          <label>No Polisi</label>
		          <input type="text" class="form-control" name="no_polisi" required>
		          <label>Nama Kendaraan</label>	
		          <input type="text" class="form-control" name="nm_kendaraan">	
		          <label>Grup</label>	
		          <input type="text" class="form-control" name="grup">	
		          <label>Cabang</label>	
		          @if(Auth::user()->hasRole("admin"))
		          	<select name="cabang" class="form-control select2">
		          		<option value=""></option>
		          		@foreach(App\Cabang::all() as $cabang)
		          			<option value="{{$cabang->id}}">{{$cabang->nama_cabang}}</option>
		          		@endforeach
		          	</select>
		          @else
		          	<input type="text" disabled class="form-control" value="{{Auth::user()->s_cabang->nama_cabang}}" />
		          	<input type="hidden" name="cabang" value="{{Auth::user()->s_cabang->id}}" />
		          @endif
		        </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary pull-right">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
		@endpermission
		@permission("kendaraan:read")
		<div class="col-lg-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">List Kendaraan</h3>
			    <div style="margin-top: 20px;">
			    	<div class="row">
			    		<div class="col-xs-3">
			    			<div class="form-group">
		                      <label class="col-sm-3 control-label" style="margin-top: 7px;">Limit</label>
		                      <div class="col-sm-9">
		                        <select class="form-control ilimit">
		                        	<option value="10">10</option>
		                        	<option value="25">25</option>
		                        	<option value="50">50</option>
		                        	<option value="100">100</option>
		                        </select>
		                      </div>
		                    </div>
			    		</div>
			    		<div class="col-xs-6">
		                    <label class="col-sm-2 control-label" style="margin-top: 7px;">Sort</label>
		                    <div class="col-sm-5">
		                        <select class="form-control iorder">
		                        	<option value=""></option>
		                        	<option value="id">Id</option>
		                        	<option value="no_polisi">No Polisi</option>
		                        	<option value="nama_kendaraan">Nama Kendaraan</option>
		                        	<option value="grup">Grup</option>
		                        	<option value="cabang">Cabang</option>
		                        </select>
	                        </div>
	                        <div class="col-sm-5">
	                        	<select class="form-control iascdsc">
	                        		<option value="ASC">Ascending</option>
	                        		<option value="DESC">Descending</option>
	                        	</select>
	                        </div>
			    		</div>
			    		<div class="col-xs-3">
					    	<div class="input-group">
			                    <input type="search" class="form-control isearch" placeholder="';' multi search">
			                    <span class="input-group-addon ibutton"><i class="fa fa-search"></i></span>
			                </div>
			    		</div>
			    	</div>
			    </div>
			  </div>
			  <table class="table table-bordered table-hover">
			  	<thead>
			  		<tr>
			  			<th>Id</th>
			  			<th>No Polisi</th>
			  			<th>Nama Kendaraan</th>
			  			<th>Grup</th>
			  			<th>Cabang</th>
			  			<th>Action</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  	</tbody>
			  </table>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/kendaraan/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  	</div>
			  	<div class="pull-right">
			  		<ul class="pagination pagination-sm no-margin pull-right app_pagin">
	                    
	                </ul>
			  	</div>
			  </div>
		</div>
		@endpermission
	</div>
@stop

@section("scripts")
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/kendaraan.js"></script>
@stop