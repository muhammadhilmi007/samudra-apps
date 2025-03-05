<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Samudera Jaya Abadi</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/fa/css/font-awesome.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/dist/css/skins/_all-skins.min.css">
    <link rel="shortcut icon" href="/dist/img/sja2.png" type="image/x-icon">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    @yield("styles")
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <img src="/dist/img/sja2.png" class="img-box logo-mini" style="padding:4px;" width="80px;">
          <!-- <span class="logo-mini"><b>A</b>LT</span> -->
          <!-- logo for regular state and mobile devices -->
         <!--  <span class="logo-lg"><b>Admin</b>LTE</span> -->
          <span class="logo-lg">
            <img src="/dist/img/sja2.png" class="img-reponsive" style="margin-left: -30px; padding:4px; height:50px; "> Samudera
          </span>
          <!-- <span class="logo-mini"><b>S</b>JA</span>
          logo for regular state and mobile devices
          <span class="logo-lg"><b>Samudera</b></span> -->

        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- <li class="dropdown messages-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-envelope-o"></i>
                  <span class="label label-success">4</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 4 messages</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <div class="pull-left">
                            <img src="/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">See All Messages</a></li>
                </ul>
              </li> -->
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the page and may cause design problems
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li> -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 9 tasks</li>
                  <li>
                    <ul class="menu">
                      <li>
                        <a href="#">
                          <h3>
                            Design some buttons
                            <small class="pull-right">20%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">20% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Create a nice theme
                            <small class="pull-right">40%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">40% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Some task I need to do
                            <small class="pull-right">60%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">60% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#">
                          <h3>
                            Make beautiful transitions
                            <small class="pull-right">80%</small>
                          </h3>
                          <div class="progress xs">
                            <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">80% Complete</span>
                            </div>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer">
                    <a href="#">View all tasks</a>
                  </li>
                </ul>
              </li> -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="/dist/img/profile.png" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="/dist/img/profile.png" class="img-circle" alt="User Image">
                    <p>
                      {{Auth::user()->name}} @foreach(Auth::user()->roles as $role) - {{$role->display_name}} @endforeach
                      <!-- <small>Member since Nov. 2012</small> -->
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="/logout" class="btn btn-default btn-flat">Keluar</a>
                    </div>
                    <div class="pull-left">
                      <button type="button" class="btn btn-default btn-flat" id="btn_ganti_password">Ganti Password</button>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
              </li>
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/dist/img/profile.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{Auth::user()->name}}</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!-- <li class="active treeview">
              <a href="#">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
                <li class="active"><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
              </ul>
            </li> -->
            <li>
              <a href="/dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-calculator"></i> <span>Akuntansi</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="/account"><i class="fa fa-plus"></i> <span>Account</span></a></li>
               <li><a href="/account/jurnal_umum"><i class="fa fa-file"></i> <span>Jurnal Umum</span></a></li>
               <li><a href="/account/kaskecil"><i class="fa fa-file"></i> <span>Kas Kecil</span></a></li>
               <li><a href="/account/kasbantuan"><i class="fa fa-file"></i> <span>Kas Bantuan</span></a></li>
               <li><a href="/account/labarugi"><i class="fa fa-file"></i> <span>Laba - Rugi</span></a></li>
               <li><a href="/account/neraca"><i class="fa fa-file"></i> <span>Neraca</span></a></li>
              </ul>
            </li>
            @permission(["divisi:create","divisi:read","divisi:update","divisi:delete"])
            <li>
              <a href="/divisi">
                <i class="fa fa-building-o"></i> <span>Divisi</span>
              </a>
            </li>
            @endpermission
            @permission(["cabang:create","cabang:read","cabang:update","cabang:delete"])
            <li>
              <a href="/cabang">
                <i class="fa fa-map-marker"></i> <span>Cabang</span>
              </a>
            </li>
            @endpermission
            @permission(["kendaraan:create","kendaraan:read","kendaraan:update","kendaraan:delete"])
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bus"></i> <span>Kendaraan</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
               <li><a href="/kendaraan"><i class="fa fa-plus"></i> <span>Tambah Kendaraan</span></a></li>
               <li><a href="/kendaraan/antrian_kendaraan"><i class="fa fa-list"></i> <span>Antrian Kendaraan</span></a></li>
              </ul>
            </li>
            @endpermission
            @permission(["truck:create","truck:read","truck:update","truck:delete"])
             <li class="treeview">
              <a href="#">
                <i class="fa fa-truck"></i> <span>Truck</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
            <ul class="treeview-menu">
              <li><a href="/truck"><i class="fa fa-plus"></i> <span>Tambah Truck</span></a></li>
               <li><a href="/truck/antrian_truck"><i class="fa fa-list"></i> <span>Antrian Truck</span></a></li>
            </ul>
            </li>
            @endpermission
            @permission("administrator")
            <li class="treeview">
              <a href="#">
                <i class="fa fa-gears"></i> <span>Administrator</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="/admin/role"><i class="fa fa-user"></i> Role </a></li>
                <li><a href="/admin/user"><i class="fa fa-users"></i> Users </a></li>
                <li><a href="/admin/permission"><i class="fa fa-lock"></i> Permission </a></li>
              </ul>
            </li>
            @endpermission
            @permission(["penjualan:create","penjualan:read","penjualan:update","penjualan:delete"])
            <li>
              <a href="/penjualan">
                <i class="fa fa-shopping-bag"></i> <span>Penjualan</span>
              </a>
            </li>
            @endpermission
            @permission(["pengambilan_barang:create","pengambilan_barang:read","pengambilan_barang:update","pengambilan_barang:delete","req_pengambilan_barang:create","req_pengambilan_barang:read","req_pengambilan_barang:update","req_pengambilan_barang:delete"])
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cubes"></i> <span>Barang</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @permission(["req_pengambilan_barang:create","req_pengambilan_barang:read","req_pengambilan_barang:update","req_pengambilan_barang:delete"])
                <li><a href="/req_pengambilan_barang"><i class="fa fa-shopping-cart"></i> Request Pengambilan </a></li>
                @endpermission
                @permission(["pengambilan_barang:create","pengambilan_barang:read","pengambilan_barang:update","pengambilan_barang:delete"])
                <li><a href="/pengambilan_barang"><i class="fa fa-users"></i> Pengambilan </a></li>
                @endpermission
              </ul>
            </li>
            @endpermission
            @permission(["muat:create","muat:read","muat:update","muat:delete"])
            <li>
              <a href="/muat">
                <i class="fa fa-codepen"></i> <span>Muat</span>
              </a>
            </li>
            @endpermission
            @permission(["lansir:create","lansir:read","lansir:update","lansir:delete"])
            <li>
              <a href="/lansir">
                <i class="fa fa-file-text"></i> <span>Lansir</span>
              </a>
            </li>
            @endpermission
            @permission(["retur:kirim", "retur:terima"])
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i> <span>Retur</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                @permission("retur:kirim")
                <li><a href="/retur/kirim"><i class="fa fa-shopping-cart"></i> Kirim </a></li>
                @endpermission
                @permission("retur:terima")
                <li><a href="/retur/terima"><i class="fa fa-users"></i> Terima </a></li>
                @endpermission
                <li><a href="/retur/print"><i class="fa fa-print"></i> Print </a></li>
              </ul>
            </li>
            @endpermission
            @permission(["overdue:read","overdue:update"])
            <li>
              <a href="/overdue">
                <i class="fa fa-money"></i> <span>Overdue / Piutang</span>
              </a>
            </li>
            @endpermission
            @permission(["penagihan:read","penagihan:update","penagihan:delete"])
            <li>
              <a href="/penagihan">
                <i class="fa fa-file-text"></i> <span>Penagihan</span>
              </a>
            </li>
            @endpermission
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file"></i> <span>Print</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                   <li><a href="/print/tugas/tagihan"><i class="fa fa-file"></i> <span>Surat Tugas Tagihan</span></a></li>
                   <li><a href="/print/invoice/perpelanggan"><i class="fa fa-file"></i> <span>Invoice - Perpelanggan</span></a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="title_inside">

          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
          @if(!empty(session("message")))
            @foreach(session('message') as $key => $value)
            <br/>
              <div class="alert alert-{{$key}} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4>  <i class="icon fa fa-check"></i> Message !</h4>
                {{$value}}
              </div>
            @endforeach
          @endif
        </section>

        <!-- Main content -->
        <section class="content">
          @yield("content")
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <!-- <b>Version</b> 2.3.0 -->
        </div>
        <strong>Copyright &copy; 2017 <a href="#">Kodels Project Studio</a>.</strong> All rights reserved.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab"></div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab"></div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>

    </div><!-- ./wrapper -->


    <!-- Modal -->
      <div class="modal fade in" id="modal-confirm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p class="modal-confirm-content"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
              <a href="#" class="modal-confirm-href">
                <button type="button" class="btn btn-danger">Ya</button>
              </a>
            </div>
          </div>
        </div>
      </div>


      <div class="modal fade in" id="modal-change-password">
        <div class="modal-dialog">
          <form method="POST" action="/admin/user/manualeditpassword">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Ganti Password</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Password Lama</label>
                <input type="password" class="form-control" id="epass_passwordlama" name="oldpassword" placeholder="Masukkan Password lama" required>
              </div>
              <div class="form-group">
                <label>Password Baru</label>
                <input type="password" class="form-control" id="epass_passwordbaru" name="newpassword" disabled placeholder="Masukkan Password baru" required>
              </div>
              <div class="form-group">
                <label>Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="epass_konfirmasipasswordbaru" disabled name="confirmnewpassword" placeholder="Ulangi Password baru" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-info" data-dismiss="modal">Batal</button>
              <input type="hidden" name="_token" value="{{csrf_token()}}" />
              <button type="submit" class="btn btn-warning">Ganti</button>
            </div>
          </div>
          </form>
        </div>
      </div>

    <!-- jQuery 2.1.4 -->
    <script src="/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/dist/js/app.min.js"></script>
    <!-- Sparkline -->
    <script src="/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="/plugins/chartjs/Chart.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="/dist/js/demo.js"></script>
    <script src="/js/main.js"></script>
    <script>
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      // window.csrf = $('meta[name="csrf-token"]').attr('content');
      window.csrf = "{{csrf_token()}}";
      $(document).ready(function(){
        var title = window.location.href.split("/")[3];

        var ex  = title.split("_");
        var result = "";
        if(ex.length > 1){
          for(a=0;a<ex.length;a++){
            result += ex[a].charAt(0).toUpperCase()+ex[a].slice(1)+" ";
          }
        }
        else{
          result = title.charAt(0).toUpperCase()+title.slice(1);
        }

        $(".title_inside").html(result);

        var arr_bread = [];

        var url = window.location.href.split("/");
        var url_length = url.length;
        for(i=3; i<url_length; i++){
          if(i==3){
            arr_bread.push(result);
          }
          else{
            arr_bread.push(url[i]);
          }
        }

        $(".breadcrumb").html("<li><i class='fa fa-dashboard'></i></li>");
        for(a=0;a<arr_bread.length;a++){
          $(".breadcrumb").append('<li>'+arr_bread[a]+'</li>')
        }

        $("#btn_ganti_password").click(function(){
          $("#modal-change-password").modal("show");
        });

        var timercheckpasswordlama;

        $("#epass_passwordlama").keyup(function(){
          var valuena = $(this).val();
            clearTimeout(timercheckpasswordlama); 
            timercheckpasswordlama = setTimeout(function() {
              console.log("ajax dipanggil");
              $.ajax({
                url : "/admin/user/checkpassword",
                type : "POST",
                data : {value : valuena},
                success:function(data){
                  if(data.success == 1){
                    $("#epass_passwordbaru").removeAttr("disabled");
                    $("#epass_konfirmasipasswordbaru").removeAttr("disabled");
                  }
                  else{
                    $("#epass_passwordbaru").attr("disabled", "disabled");
                    $("#epass_konfirmasipasswordbaru").attr("disabled", "disabled");
                    $("#epass_passwordbaru").val("");
                    $("#epass_konfirmasipasswordbaru").val("");
                  }
                }
              });
            }, 1000);
        });

      });
    </script>

    @yield("scripts")
  </body>
</html>
