@extends("base")

@section("styles")
    <link rel="stylesheet" href="/plugins/select2/select2.css" />
    <link rel="stylesheet" href="/css/jquery-ui.min.css" />
    <link rel="stylesheet" href="/css/jquery-ui.structure.min.css" />
    <link rel="stylesheet" href="/css/jquery-ui.theme.min.css" />
    <link rel="stylesheet" href="/plugins/iCheck/all.css">

@stop

@section("content")
<form method="POST">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Input Data Penjualan</h3>
    </div>
       <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xs-6">
                           <label>Kantor Asal</label>
                           @if(Auth::user()->hasRole("admin"))
                                <select name="kantor_asal" class="form-control select2" required>
                                    <option value=""></option>
                                    @foreach($allcabang as $dp)
                                        <option value="{{$dp->id}}">{{$dp->nama_cabang}}</option>
                                    @endforeach
                                </select>
                           @else
                               <input type="text" class="form-control" disabled value="{{\App\Cabang::find(Auth::user()->cabang)->nama_cabang}}">
                               <input type="hidden" name="kantor_asal" value="{{Auth::user()->cabang}}" />
                           @endif
                        </div>
                        <div class="col-xs-6">
                        	<label>Kantor Tujuan</label>
                            <select name="kantor_tujuan" class="form-control select2" required>
                                <option value=""></option>
                                @foreach($data_cabang as $dp)
                                    <option value="{{$dp->id}}">{{$dp->nama_cabang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <label>STT</label>
                    <input type="text" name="stt" class="form-control" readonly value="{{$penjualan->stt}}">
                </div>
                <div class="col-xs-6">
                    <label>Pengirim</label>
                    <input type="text" name="pengirim" class="form-control" required>
                </div>
                <div class="col-xs-6">
                    <label>Penerima</label>
                    <input type="text" name="penerima" class="form-control" required>
                </div>
                <div class="col-xs-6">
                    <label>Alamat</label>
                    <textarea class="form-control" rows="3" name="alamat" required></textarea>   
                </div>
                <div class="col-xs-6">
                    <label>Penerus</label>
                    <input type="text" name="penerus" class="form-control">
                </div>
                <div class="col-xs-6">
                    <label>Kode Penerus</label>
                    <select class="form-control" name="kode_penerus" disabled>
                        <option value="70">70</option>
                        <option value="74">74</option>
                        <option value="75">75</option>
                    </select> 
                </div>
                <div class="col-xs-6">
                    <label>Nama Barang </label>
                    <input type="text" name="nm_barang" class="form-control" required>
                </div>
                <div class="col-xs-6">
                    <label>Payment</label>
                    <select name="payment" required class="form-control">
                        <option value="CASH">CASH</option>
                        <option value="CAD">CAD</option>
                        <option value="COD">COD</option>
                    </select>
                </div>
                <div class="col-xs-6">
                    <label>Jumlah Colly</label>
                    <input type="text" name="jml_colly" class="form-control" value="{{$penjualan->jumlah_colly}}" pattern="[0-9]+" readonly required>
                </div>
                 <div class="col-xs-6">
                     <label>Packing</label>
                     <select class="form-control select2" name="packing" required>
                        <option> </option>
                        <option value="amplop">Amplop</option>
                        <option value="bal">Bal</option>
                        <option value="bal/box">Bal/Box</option>
                        <option value="bal/roll">Bal/Roll</option>
                        <option value="bal/unit">Bal/Unit</option>
                        <option value="box">Box</option>
                        <option value="colly">Colly</option>
                        <option value="drum">Drum</option>
                        <option value="drum/zak">Drum/Zak</option>
                        <option value="dus">Dus</option>
                        <option value="ikat">Ikat</option>
                        <option value="jerigen">Jerigen</option>
                        <option value="karung">Karung</option>
                        <option value="pail">Pail</option>
                        <option value="paket">Paket</option>
                        <option value="peti">Peti</option>
                        <option value="roll">Roll</option>
                        <option value="roll/bale">Roll/Bale</option>
                        <option value="roll/bale/dus">Roll/Bale/Dus</option>
                        <option value="unit">Unit</option>
                        <option value="zak">Zak</option>    
                        <option value="karung/roll">Karung/Roll</option>
                        <option value="pail/zak">Pail/Zak</option>
                        <option value="dus/roll">Dus/Roll</option>
                    </select> 
                 </div>
                 <div class="col-xs-6">
                    <div class="row">
                        <div class="col-xs-12">
                        <label>Jenis Harga</label>
                            <select class="form-control" name="jenis_harga" required>
                                <option value="berat">Berdasarkan Berat</option>
                                <option value="colly">Berdasarkan Colly</option>
                                <option value="volume_metric">Berdasarkan Volume Metric</option>
                            </select>
                        </div>
                    </div>
                    <div class="row vmet">
                        <div class="col-xs-4">
                            <label>Panjang</label>
                            <input type="text" name="v_panjang" class="form-control" pattern="[0-9]+" value="0" required>
                        </div>
                        <div class="col-xs-4">
                            <label>Lebar</label>
                            <input type="text" name="v_lebar" class="form-control" pattern="[0-9]+" value="0" required>
                        </div>
                        <div class="col-xs-4">
                            <label>Tinggi</label>
                            <input type="text" name="v_tinggi" class="form-control" pattern="[0-9]+" value="0" required>
                        </div>
                    </div>
                 </div>
                 <div class="col-xs-6">
                    <label>Berat</label>
                    <div class="input-group">
                        <input type="text" name="berat" class="form-control" required readonly value="{{$penjualan->berat}}">
                        <span class="input-group-addon">Kg</span>
                    </div>
                </div>
                <div class="col-xs-6">
                    <label>Harga</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" name="harga" class="form-control" required>
                    </div>
                </div>
                 <div class="col-xs-6">
                    <label>Jumlah Harga</label>
                    <div class="input-group">
                        <span class="input-group-addon">Rp</span>
                        <input type="text" name="jumlah_harga" class="form-control" required readonly>
                    </div>
                </div>
                <div class="col-xs-6">
                    <label>Keterangan Tambahan</label>
                    <textarea name="ket_tambahan" class="form-control" rows="3"></textarea>
                </div>
                <div class="col-xs-6">
                    <label>KontaK Penerima</label>
                    <input type="text" name="kontak_penerima" class="form-control">
                </div>
                <div class="col-xs-6">
                    <br/><br/>
                    <label>Transit ?</label>
                    <input type="checkbox" name="cb_transit" class="minimal"></input>
                    <br/>
                    <div class="row">
                    <div class="col-xs-12 transit_container">
                        <div class="unit_transit">
                            <div class="row">
                                <label class="labtrans">Transit ke 1</label>
                                <div class="col-xs-10">
                                    <select name="transit[]" class="form-control select2">
                                        <option value=""></option>
                                        @foreach($allcabang as $dp)
                                            <option value="{{$dp->id}}">{{$dp->nama_cabang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-2" transbut="1">
                                    <button type="button" class="btn btn-xs btn-info btn_transit_plus"><i class="fa fa-plus"></i></button>
                                    <button type="button" class="btn btn-xs btn-danger btn_transit_minus"><i class="fa fa-minus"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right" name="tambah">Tambah</button>  
                </div>
            </div>
        </div><!-- /.box-body -->
</div><!-- /.box -->
</form>
@stop

@section("scripts")
    <script>
    window.penjualan = [];
    @foreach($allpenjualan as $k => $p)
    console.log("anu ieu : {!!$k!!}",{!!$p!!});
        window.penjualan.push({!!$p!!});
    @endforeach
    window.allcabang = {!!$allcabang!!};

    $(document).ready(function(){
        $("[name=packing]").val("{{$penjualan->packing}}");
    });
    </script>
    <script src="/plugins/iCheck/icheck.min.js"></script>
    <script src="/plugins/select2/select2.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/editpenjualan.js"></script>
@stop