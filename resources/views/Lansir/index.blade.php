@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<style>
		@if(!Auth::user()->can("lansir:update"))
			.btn_edit{
				display: none;
			}
		@endif

		@if(!Auth::user()->can("lansir:delete"))
			.btn-danger{
				display: none;
			}
		@endif

		/* */
	</style>
@stop

@section("content")
	<div class="row">
		@permission("lansir:create")
		<div class="col-lg-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Input Data Lansir</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/lansir/add">
		      <div class="box-body">
		      	<div class="form-group">
		          <label>Antrian Kendaraan</label>
		          	<select name="antrian_kendaraan" class="form-control select2">
		          		<option value=""></option>
		          		@foreach($antrian_kendaraan as $ak)
		          			<option value="{{$ak->id}}">{{$ak->id}}|Supir : {{$ak->supir}}|Kernet : {{$ak->kernet}}</option>
		          		@endforeach
		          	</select>
		      	</div>
		      	<div class="form-group">
		          <label>STT</label>	
		          	<select name="stt[]" class="select2 form-control" multiple="multiple">
		          		<option value=""></option>
		          		@foreach($penjualan as $p)
		          			<option value="{{$p->stt}}">{{$p->stt}}|K_Asal : {{$p->s_kantor_asal->nama_cabang}}|K_Tujuan : {{$p->s_kantor_tujuan->nama_cabang}}</option>
		          		@endforeach
		          	</select>
		      	</div>
		      	@if(Auth::user()->hasRole('admin'))
		      		<div class="form-group">
		      		  <label>Cabang</label>	
		      		  <select name="cabang" class="form-control select2">
		      		  	<option value=""></option>
		      		  	@foreach(\App\Cabang::all() as $c)
		      		  		<option value="{{$c['id']}}">{{$c['nama_cabang']}}</option>
		      		  	@endforeach
		      		  </select>
		      		</div>
		      	@else
		      		<input type="hidden" class="form-control" name="cabang" value="{{Auth::user()->cabang}}" />
		      	@endif

		      	<div class="form-group">
		          <label>Berangkat</label>	
		          <input type="text" class="form-control datetimepicker" name="berangkat">
		      	</div>
		        </div>
		      <input type="hidden" name="_token" value="{{csrf_token()}}" />
		      <div class="box-footer">
		        <button type="submit" class="btn btn-primary pull-right">Submit</button>
		      </div>
		    </form>
		  </div>
		</div>
		@endpermission
		@permission("lansir:read")
		<div class="col-lg-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">List Lansir</h3>
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
		                        	<option value="no_polisi">Antrian Truck</option>
		                        	<option value="waktu_berangkat">Waktu Berangkat</option>
		                        	<option value="sampai">Sampai</option>
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
			  			<th>Kode Lansir</th>
			  			<th>Antrian Kendaraan</th>
			  			<th>Waktu Berangkat</th>
			  			<th>Sampai</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  	</tbody>
			  </table>
			  <div class="box-footer">
			  	<div class="pull-left">
			  	    <a href="/lansir/export/excel">
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
	<script src="/dist/js/moment.min.js"></script>
	<script src="/dist/js/bootstrap-datetimepicker.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/lansir.js"></script>
@stop