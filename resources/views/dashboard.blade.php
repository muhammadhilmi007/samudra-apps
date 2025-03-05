@extends("base")

@section("styles")
    
@stop

@section("content")
	<!-- Info boxes -->
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-cloud-download"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Penjualan</span>
                  <small>Semua</small>
                  <span class="info-box-number">
                    {{$penjualan_total}}
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-bar-chart"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Total Penjualan</span>
                  <small>Hari ini</small>
                  <span class="info-box-number">
                    {{$penjualan_hari_ini}}
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Barang</span>
                  <small>Belum dimuat</small>
                  <span class="info-box-number">{{$penjualan_belum_dimuat}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-bus"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Barang</span>
                  <small>Belum dilansir</small>
                  <span class="info-box-number">{{$penjualan_belum_dilansir}}</span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">OMSET</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown"><i class="fa fa-wrench"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                      </ul>
                    </div>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>Grafik Omset Tahun {{date('Y')}}</strong>
                      </p>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="salesChart" style="height: 180px;"></canvas>
                      </div><!-- /.chart-responsive -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">
                  <!-- <div class="row">
                    <div class="col-sm-4 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                        <h5 class="description-header">....</h5>
                        <span class="description-text">Omset Total</span>
                      </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                        <h5 class="description-header">...</h5>
                        <span class="description-text">Laba Kotor</span>
                      </div>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                        <h5 class="description-header">....</h5>
                        <span class="description-text">Laba Bersih </span>
                      </div>
                    </div>
                  </div> -->
                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Laba Rugi</h3>
                  <div class="box-tools pull-right">
                    <div class="col-xs-5" style="padding-top: 7px;">Tahun</div>
                    <div class="col-xs-7">
                      <select name="thn_labarugi" class="form-control" style="width: 100px;">
                        <option value=""></option>
                        @for($i=2010; $i <= date('Y'); $i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

          <!-- Main row -->
          <div class="row">
            <!-- Left col -->
            <div class="col-md-12">
              <!-- MAP & BOX PANE -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">CABANG</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="row">
                    <div class="col-md-12 col-sm-8">
                      <div class="pad">
                        <!-- Map will be created here -->
                        <div id="world-map-markers" style="height: 325px;"></div>
                      </div>
                    </div><!-- /.col -->
                    <!-- <div class="col-md-3 col-sm-4">
                      <div class="pad box-pane-right bg-green" style="min-height: 280px">
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,70,90,70,75,80,70</div>
                          <h5 class="description-header">8390</h5>
                          <span class="description-text">Visits</span>
                        </div>
                        <div class="description-block margin-bottom">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">30%</h5>
                          <span class="description-text">Referrals</span>
                        </div>
                        <div class="description-block">
                          <div class="sparkbar pad" data-color="#fff">90,50,90,70,61,83,63</div>
                          <h5 class="description-header">70%</h5>
                          <span class="description-text">Organic</span>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
              
              <!-- TABLE: LATEST ORDERS -->
            </div><!-- /.col -->
            <div class="col-lg-4">
              <div class="box box-default hchart">
                <div class="box-header with-border">
                  <h3 class="box-title">Browser Usage</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="chart-responsive">
                        <canvas id="pieChart" height="150"></canvas>
                      </div><!-- ./chart-responsive -->
                    </div><!-- /.col -->
                    <div class="col-md-4">
                      <ul class="chart-legend clearfix">
                        <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                        <li><i class="fa fa-circle-o text-green"></i> IE</li>
                        <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                        <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                        <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                        <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                      </ul>
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <ul class="nav nav-pills nav-stacked">
                    <li><a href="#">United States of America <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                    <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a></li>
                    <li><a href="#">China <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                  </ul>
                </div><!-- /.footer -->
              </div>
            </div>
          </div><!-- /.row -->
@stop

@section("scripts")
<script>
  window.omset = [];
  window.cabang = [];
  @foreach($omset as $om)
    window.omset.push({!!$om!!})
  @endforeach

  @foreach($cabang as $c)
    window.cabang.push({!!$c!!});
  @endforeach
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/dist/js/pages/dashboard2.js"></script>
<script>
$(document).ready(function(){
  $(".hchart").hide(0);

  // var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
  // // This will get the first returned node in the jQuery collection.
  // var areaChart = new Chart(areaChartCanvas);

  var areaChartData = {
    labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
    datasets: [
      {
        label: "Total Income",
        fillColor: "rgba(60, 141, 188, 1)",
        strokeColor: "rgba(60, 141, 188, 1)",
        pointColor: "rgba(60, 141, 188, 1)",
        pointStrokeColor: "rgba(60, 141, 188, 1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60, 141, 188,1)",
        data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
      },
      {
        label: "Laba Bruto",
        fillColor: "rgba(0,192,239,1)",
        strokeColor: "rgba(0,192,239,0.8)",
        pointColor: "rgba(0,192,239,1)",
        pointStrokeColor: "rgba(0,192,239,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(0,192,239,1)",
        data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
      },
      {
        label: "Total Expenses",
        fillColor: "rgba(245,105,84,0.9)",
        strokeColor: "rgba(245,105,84,0.8)",
        pointColor: "rgba(245,105,84,0.9)",
        pointStrokeColor: "rgba(245,105,84,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(245,105,84,1)",
        data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
      },
      {
        label: "Laba Bersih",
        fillColor: "rgba(0,166,90,0.9)",
        strokeColor: "rgba(0,166,90,0.8)",
        pointColor: "rgba(0,166,90,0.9)",
        pointStrokeColor: "rgba(0,166,90,1)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(0,166,90,1)",
        data: [100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100]
      },
    ]
  };

  var areaChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: false,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.3,
    //Boolean - Whether to show a dot for each point
    pointDot: false,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 4,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: true,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };

  // //Create the line chart
  // areaChart.Line(areaChartData, areaChartOptions);

  //-------------
  //- LINE CHART -
  //--------------
  var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
  var lineChart = new Chart(lineChartCanvas);
  var lineChartOptions = areaChartOptions;
  lineChartOptions.datasetFill = false;
  lineChart.Line(areaChartData, lineChartOptions);
});
</script>
@stop