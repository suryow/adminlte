<?php
session_start();
if (isset($_SESSION['email'])) {
  
?>
<?php $thisPage = "User"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $thisPage; ?></title>
 <?php
 include '../layout/header.php';
 ?>
  <!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
          include '../layout/massage.php';
          include '../layout/notification.php';
          include '../layout/tasks.php';
          include '../layout/user.php';
          ?>
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
      <?php
     include '../layout/sidebar.php';
     ?>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Artikel
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Artikel</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header with-border">
              <a href="http://localhost/adminlte/admin/user/create.php" class="btn btn-primary pull-left"><i class="fa fa-plus-circle"></i> Create</a>

              <!-- <div class="box-tools">
                <?php
                // $pencarian  = isset($_GET['cari'])?$_GET['cari']:'';
                ?>
                <form action="" method="GET">
                <a href="http://localhost/adminlte/admin/kategori/index.php" class="btn btn-default pull-right">Clear</a>
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="cari" class="form-control pull-right" placeholder="Search" value="<?= $pencarian?>">
                  <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
                </div>
                </form>
              </div> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">

            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <tr>
                    <th style="width: 10px">No</th>
                    <th>Nama</th>
                    <th>E-mail</th>
                    <th>Tipe User</th>
                    <?php
                    include '../../config/koneksi.php';

                    $user   = $_SESSION['id'];
                    $metu   = $_SESSION['user'];

                    if ($metu == 1) {
                      echo "
                            <th>Action</th>
                      ";
                    }

                    ?>
                  </tr>
              </thead>
                <?php
                  include '../../config/koneksi.php';

                  $user   = $_SESSION['id'];
                  $metu   = $_SESSION['user'];

                  $nomor  = 1;
                  $sql    = "SELECT role.id, role.nama as tipe, user.id as urut, user.name as nama, user.email as email FROM user INNER JOIN role ON role.id=user.role_id";
                  $result = mysqli_query($konek, $sql);
                  $url    = "http://localhost/adminlte/gambar/user-img/";

                  function namaUser($id) {
                    global $konek;
                    $name    = "SELECT name FROM user WHERE id=".$id;
                    $hasil   = mysqli_query($konek, $name);
                    $kolom   = mysqli_fetch_assoc($hasil);

                    return $kolom['name'];
                  }

                  function jika($status) {
                    if ($status==1) {
                      return "<em style='color:#008bd1'>Active</em>";
                    } else {
                      return "<em style='color:#ff0000'>Non-Active</em>";}
                    }

                  if ($metu == 1) {
                    if (mysqli_num_rows($result)>0) {
                      while ($row = mysqli_fetch_assoc($result)){
                        echo "
                          <tr>
                            <td>".$nomor++."</td>
                            <td>".$row['nama']."</td>
                            <td>".$row['email']."</td> 
                            <td>".$row['tipe']."</td>  
                            <td>
                              <a href='edit_user.php?id=".$row['urut']."' class='btn btn-primary btn-xs'>Edit</a> 
                              <a href='delete_user.php?id=".$row['urut']."' onclick='javascript:return confirm(\"Apakah anda yakin ingin menghapus data ini?\")' class='btn btn-danger btn-xs'>Delete</a>
                            </td>
                          </tr>
                        ";
                      }
                    } else {
                      echo "
                        <tr>
                          <td colspan='8' align='center'>Tidak ada data yang ditemukan.</td>
                        </tr>
                      ";
                    }
                  } else {
                    if (mysqli_num_rows($result)>0) {
                      while ($row = mysqli_fetch_assoc($result)){
                        echo "
                          <tr>
                            <td>".$nomor++."</td>
                            <td>".$row['nama']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['tipe']."</td>
                          </tr>
                        ";
                      }
                    } else {
                      echo "
                        <tr>
                          <td colspan='8' align='center'>Tidak ada data yang ditemukan.</td>
                        </tr>
                      ";
                    }
                  }
                  
                  ?>
              </table>

            </div>
            <!-- /.box-body -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<?php
include '../layout/script.php';
?>
</body>
</html>

<?php
} else {
  echo "Anda belum login, silahkan <a href='../index.php'>Login</a>";
}
?>