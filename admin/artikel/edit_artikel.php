<?php
session_start();
if (isset($_SESSION['email'])) {
  
?>
<?php $thisPage = "Artikel"; ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $thisPage; ?></title>
 <?php
 include '../layout/header.php';
 ?>
   <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="http://localhost/adminlte/AdminLTE-2.4.5/plugins/iCheck/all.css">
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
              <h3 class="box-title">Edit Artikel</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php
            include '../../config/koneksi.php';

            $ID       = $_GET['id'];
            $role     = $_SESSION['user'];
            $sql      = "SELECT * FROM artikel WHERE id=$ID";
            $result   = mysqli_query($konek, $sql);
            $row      = mysqli_fetch_assoc($result);
            $tampil   = $row['kategori_id'];
            $cek      = $row['status'];

            $sql2   = "SELECT * FROM kategori WHERE id=$tampil";
            $result2  = mysqli_query($konek, $sql2);
            $row2     = mysqli_fetch_assoc($result2);

            $url      = "http://localhost/adminlte/gambar/artikel-img/";

            ?>
            <form role="form" action="proses_edit.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                 <input type="hidden" name="id" value="<?php echo $ID; ?>">

                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" id="judul" value="<?php echo $row['judul']; ?>" name="judul">
                </div>

                <div class="form-group">
                  <label>Kategori</label>
                  <select name="kategori" id="category" class="form-control" required="">
          					<option value="<?php echo $row2['id']; ?>"><?php echo $row2['nama']; ?></option>
          					<?php
          						include '../../config/koneksi.php';
                      $user     = $_SESSION['id'];
          						$sql3 	= "SELECT * FROM kategori WHERE id_user=$user";
          						$result3 = mysqli_query($konek, $sql3);
          						if (mysqli_num_rows($result3) > 0) {
          							while ($row3 = mysqli_fetch_assoc($result3)) {
          								echo "<option value=".$row3['id'].">".$row3['nama']."</option>";
          							}
          						}
          					?>
          				</select>
              	</div>

              	<div class="form-group">
                  <label for="isi">Isi Artikel</label>
                 <div>
    		            <textarea class="box-body pad" id="editor1" name="isi" rows="10" cols="80"><?php echo $row['isi']; ?></textarea>
    		         </div>
                </div>

                    <?php
                    include '../../config/koneksi.php';

                    if (($role == 3) OR ($role == 1)) {
                      if ($cek == 1) {
                        echo "
                         <div>
                          <label for='status'>Status</label>
                          <div class='form-group'>
                            <label for='active'>
                            <input type='radio' name='status' value='1' id='active' class='minimal-red' required checked>
                            Active</label>
                            <label for='non-active'>
                            <input type='radio' name='status' value='0' id='non-active' class='minimal-red' required>
                            Non-Active</label>
                        </div>
                        ";
                      } else {
                        echo "
                        <div>
                          <label for='status'>Status</label>
                          <div class='form-group'>
                            <label for='active'>
                            <input type='radio' name='status' value='1' id='active' class='minimal-red' required>
                            Active</label>
                            <label for='non-active'>
                            <input type='radio' name='status' value='0' id='non-active' class='minimal-red' required checked>
                            Non-Active</label>
                          </div>
                          ";
                      }  
                    }
                    

                    ?>

                <div class="form-group">
                  <label for="gambar">Photo Profile</label>
                  <div>
                  <img src="<?= $url.$row['gambar']?>" width="150px"><br><br>
                  <input type="file" id="gambar" name="gambar"></input>
                  JPG, JPEG, PNG format
                  </div>
                </div>

              </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <a type="reset" class="btn btn-default" href="http://localhost/adminlte/admin/artikel">Cancel</a>
                <button type="submit" class="btn btn-info pull-right">Submit</button>
              </div>
            </form>
          </div>

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

<!-- jQuery 3 -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/dist/js/demo.js"></script>
<!-- CK Editor -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/bower_components/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="http://localhost/adminlte/AdminLTE-2.4.5/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>


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