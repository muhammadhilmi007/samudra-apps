@extends("base")

@section("styles")
	<link rel="stylesheet" href="/plugins/datatables/dataTables.bootstrap.css" />
    <link rel="stylesheet" href="/plugins/select2/select2.css" />
	<link rel="stylesheet" href="/plugins/iCheck/all.css">

@stop
@section("content")
	<div class="row">
        @permission("penagihan:create")
		<div class="col-xs-4">
		  <!-- general form elements -->
		  <div class="box box-primary">
		    <div class="box-header with-border">
		      <h3 class="box-title">Tambah Penagihan</h3>
		    </div><!-- /.box-header -->
		    <!-- form start -->
		    <form method="POST" action="/penagihan/add">
		      <div class="box-body">
		        <div class="form-group">
		          <label>STT</label>
		          <select name="stt" class="form-control select2">
		          	<option value=""></option>
		          	@foreach($penjualan as $p)
		          		<option value="{{$p->stt}}">{{$p->stt}}</option>
		          	@endforeach
		          </select>
		        </div>
		        <div class="form-group">
		        	<label>Keterangan</label>
		        	<textarea class="form-control" name="keterangan"></textarea>
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
        @permission("penagihan:read")
		<div class="col-xs-8">
			<div class="box box-primary">
			  <div class="box-header with-border">
			    <h3 class="box-title">Penagihan List</h3>
			  </div>
			<form method="POST" action="/penagihan/actlunas">
			<div class="box-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>STT</th>
                        <th>Keterangan</th>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                	@foreach($penagihan as $tagihan)
           	        <tr>
                        <td>{{$tagihan->id}}</td>
                        <td>{{$tagihan->stt}}</td>
                        <td>{{$tagihan->keterangan}}</td>
                        <td>{{$tagihan->s_penjualan->payment_type}}</td>
                        <td>
                        	@if($tagihan->status == 0)
                        		<button type="button" class="btn btn-xs btn-info">On Progress</button>
                        	@elseif($tagihan->status == 1)
                        		<button type="button" class="btn btn-xs btn-primary">Finish</button>
                        	@elseif($tagihan->status == 2)
                        		<button type="button" class="btn btn-xs btn-warning">Pending</button>
                        	@endif
                        </td>            
                        <td>
                            @permission("penagihan:update")
                            	@if($tagihan->status != 1)
                            	<input type="checkbox" class="minimal" name="id[]" class="" value="{{$tagihan->id}}" />
                            	@endif
                            @endpermission
                        </td>            
                    </tr>
                    @endforeach
                </tbody>
            </table>
            	         
            <div class="box-footer">
                <div class="pull-left">
                    <a href="/penjualan/export/excel">
                        <button type="button" class="btn btn-success btn-md"><i class="fa fa-file-excel-o"></i> Export To Excel</button>
                    </a>
                </div>
                @permission("penagihan:update")
                <div class="pull-right">
                	<input type="hidden" name="_token" value="{{csrf_token()}}" />
                	<button type="submit" class="btn btn-info pull-right">Submit</button>   
                </div>
                @endpermission
            </div>
            </form>
            </div>
		</div>
        @endpermission
	</div>
@stop

@section("scripts")
	<script src="/plugins/iCheck/icheck.min.js"></script>
    <script src="/plugins/select2/select2.js"></script>
	<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="/js/penagihan.js"></script>
@stop