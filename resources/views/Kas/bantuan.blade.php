@extends("base")

@section("styles")
    <style>
        .main_container{
            height: 700px;
        }
        
        thead, tbody{
            display: block;
        }
        th{
            width : 125px;
        }
        td{
            width : 125px;
        }
        table{
            height: 500px;
        }
        table tbody 
        {
           overflow: auto;
           height: 500px;
        }

        /*.dynamic_input td input{
            width: 90%;
        }*/
    </style>
    <link rel="stylesheet" href="/plugins/datepicker/datepicker3.css" />
    <link rel="stylesheet" href="/css/angular-datepicker.css" />
    <script src="/js/angular.min.js"></script>
    <script src="/js/angular-datepicker.js"></script>
@stop

@section("content")
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">Kas Kecil</h3>
    </div>
       <div class="box-body">
            <div class="row" ng-app="anKasBantuan">
                <div class="col-xs-12 main_container">
                    <div class="angular_controller" ng-controller="kasbantuan">
                        <div class="pull-left" style="padding-left: 10px; font-weight : bold; color: red;">
                            Saldo Kas : Rp [[saldo_kas_format]]
                        </div>
                        <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>TGL</th>
                                <th>ACC</th>
                                <th>KANTOR</th>
                                <th>ACCOUNT</th>
                                <th>KETERANGAN</th>
                                <th>TAMBAHAN</th>
                                <th>DEBET</th>
                                <th>KREDIT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="dynamic_input" ng-repeat="(x, y) in kasBantuanComponent">
                                <td>
                                    <datepicker date-format="dd-MM-yyyy">
                                        <input type="text" ng-model="y.tgl" ng-change="chUpdate(x)" style="width: 100px;"/>
                                    </datepicker>
                                </td>
                                <td>
                                    <select 
                                        ng-options="item as item.label for item in opt track by item.id" 
                                        ng-model="y.acc_temp"
                                        ng-change="chAcc(x, y.acc_temp)">
                                    </select>
                                </td>
                                <td><input type="text" ng-model="y.kantor_name" readonly /></td>
                                <td><input type="text" ng-model="y.account" readonly /></td>
                                <td><input type="text" ng-model="y.keterangan" ng-change="chUpdate(x)" style="width: 100px;" /></td>
                                <td><input type="text" ng-model="y.tambahan" ng-change="chUpdate(x)" style="width: 100px;"/></td>
                                <td><input type="text" ng-model="y.debet" data-ng-disabled="checkDebet(x)" ng-change="chUpdate(x)" style="text-align: right"/></td>
                                <td><input type="text" ng-model="y.kredit" data-ng-disabled="checkKredit(x)" ng-change="chUpdate(x)" style="text-align: right"/></td>
                                <td style="float: left">
                                    <!-- <button class="btn btn-xs btn-info btn_update"><i class="fa fa-pencil"></i></button> -->
                                    <button class="btn btn-xs btn-danger btn_delete" ng-click="chDelete(x)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" style="text-align: right; padding-right: 20px; font-weight: bold;">Jumlah</td>
                                <td style="text-align : right; padding-right: 20px;">[[chJumlahDebet]]</td>
                                <td style="text-align : right; padding-right: 20px;">[[chJumlahKredit]]</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:left">
                                    <button class="btn btn-xs btn-success btn_add" ng-click="addKasBantuanComponent()"><i class="fa fa-plus"></i></button>
                                </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<div class="modal fade in" id="modal-alert">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Pemberitahuan</h4>
      </div>
      <div class="modal-body">
        Berhasil Menghapus data
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
      </div>
    </div>
  </div>
</div>
@stop

@section("scripts")
    <script>
    window.userCabang = {{Auth::user()->cabang}};
    window.userCabangName = "{{Auth::user()->s_cabang->nama_cabang}}";
    window.dataAcc = {!!$account!!};
    </script>
    
    <script src="/js/kasbantuan.js"></script>
@stop