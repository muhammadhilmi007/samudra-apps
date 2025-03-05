@extends("base")

@section("content")
<form role="form">
<div class="box box-danger">
    <div class="box-header with-border">
        <h3 class="box-title">Input Data Penjualan</h3>
    </div>
       <div class="box-body">
            <div class="row">
                <div class="col-xs-6">
                   <label>Kantor Asal</label>
                   <input type="text" class="form-control" placeholder="">
                </div>
                <div class="col-xs-6">
                	<label>Kantor Tujuan</label>
                    <input type="text" class="form-control" placeholder=".col-xs-4">
                </div>
            </div>
        </div><!-- /.box-body -->
</div><!-- /.box -->
</form>
@stop

@section("scripts")

@stop