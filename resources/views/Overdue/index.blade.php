@extends("base")
@section("styles")
	<link rel="stylesheet" href="/plugins/select2/select2.css" />
	<link rel="stylesheet" href="/plugins/daterangepicker/daterangepicker-bs3.css">
	<style>
		@if(!Auth::user()->can("overdue:update"))
			.btn-info{
				display: none;
			}
		@endif

		/*@if(!Auth::user()->can("overdue:delete"))
			.btn-danger{
				display: none;
			}
		@endif*/

		/* */
	</style>
@stop

@section("content")
	<div class="row">
		@permission("overdue:read")
		<div class="col-lg-12">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">List Overdue</h3>
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
		                        	<option value="stt">STT</option>
		                        	<option value="cabang">Cabang</option>
		                        	<option value="nominal_awal">Nominal Awal</option>
		                        	<option value="nominal">Nominal</option>
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
			  			<th>STT</th>
			  			<th>Cabang</th>
			  			<th>Pelanggan</th>
			  			<th>Nominal Awal</th>
			  			<th>Nominal</th>
			  			<th>Action</th>
			  		</tr>
			  	</thead>
			  	<tbody>
			  		
			  	</tbody>
			  </table>
			  <div class="box-footer">
			  	<div class="pull-left">
			  		<a href="/overdue/export/excel">
			  			<button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
			  		</a>
			  		<button type="button" class="btn btn-info btn-md open_invoice"><i class="fa fa-file-excel-o"></i> Invoice</button>
			  	</div>
			  	<div class="pull-right">
			  		<ul class="pagination pagination-sm no-margin pull-right app_pagin">
	                    
	                </ul>
			  	</div>
			  </div>
		</div>
		@endpermission
	</div>

	<div class="modal fade in" id="modal-openinvoice">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Invoice</h4>
	      </div>
	      <div class="modal-body">
	        <div class="row">
	        	<div class="col-xs-12">
	        		<div class="form-group">
	        			<label>Pengirim</label>
	        			<select name="pengirim" class="form-control select2">
	        				<option value=""></option>
	        				@foreach($invoice_pengirim as $k => $ip)
	        					<option value="{{$ip}}">{{$ip}}</option>
	        				@endforeach
	        			</select>
	        		</div>
	        		<div class="form-group">
	        			<label>Time Range</label>
	        			<input type="text" name="range" class="timerange form-control" />
	        		</div>
	        	</div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
	          <button type="button" class="btn btn-danger print_invoice"><i class="fa fa-print"></i>Print</button>
	      </div>
	    </div>
	  </div>
	</div>
@stop

@section("scripts")
	<script src="/dist/js/moment.min.js"></script>
    <script src="/plugins/daterangepicker/daterangepicker.js"></script>
	<script src="/plugins/select2/select2.js"></script>
	<script src="/js/indexoverdue.js"></script>
@stop