@extends("base")

@section("styles")
	
@stop

@section("content")
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Retur</h3>
        <div class="pull-right">

        </div>
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
                            <option value="kantor_asal">Kantor Asal</option>
                            <option value="kantor_tujuan">Kantor Tujuan</option>
                            <option value="pengirim">Pengirim</option>
                            <option value="penerima">Penerima</option>
                            <option value="tanggal">Tanggal</option>
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
        <div class="box-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>STT</th>
                        <th>Pengirim</th>
                        <th>Penerima</th>
                        <th>Tanggal Kirim</th>
                        <th>Tanggal Terima</th>
                        <th>Payment</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            <div class="box-footer">
                <div class="pull-right">
                    <ul class="pagination pagination-sm no-margin pull-right app_pagin">
                        
                    </ul>
                </div>
            </div>
        </div>
</div>
@stop

@section("scripts")
    <script>
        window.cabang = {{Auth::user()->cabang}}
    </script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/datatables/dataTables.bootstrap.js"></script>
    <script src="/js/retur.js"></script>
@stop