<?php
  include('../examples/session.php');
  if(!isset($_SESSION['login_user'])){    //$_SESSION['login_user']=emailid of user
    header("location: http://localhost/ZeroWeapon/pages/examples/login.php");
  }
  //echo $_SESSION['login_user'];
  $email=$_SESSION['login_user'];
  //echo $email;
  $BAnum = "SELECT BA FROM logincredential WHERE EmailID='$email'";
  $result = mysqli_query($conn, $BAnum);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
      $currBA = $row["BA"]; 
      //echo "Name: " . $row["BA"]. "<br>";
    }
 }

 $uname = "SELECT Name FROM firer WHERE BA='$currBA'";
 $result = mysqli_query($conn, $uname);
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $userName = $row["Name"]; 
    //echo $userName;
  }
}

  //submit
if(isset($_POST['submit'])){
  $bDOF= $_POST['DOF'];
  $bTime = $_POST['Time'];
  $bBx1 = $_POST['Bx1'];
  $bBy1 = $_POST['By1'];
  $bBx2 = $_POST['Bx2'];
  $bBy2 = $_POST['By2'];
  $bBx3 = $_POST['Bx3'];
  $bBy3 = $_POST['By3'];
  $bBx4 = $_POST['Bx4'];
  $bBy4 = $_POST['By4'];
  $bBx5 = $_POST['Bx5'];
  $bBy5 = $_POST['By5'];
  $ssql = "INSERT INTO grpfirebullet (BA, Date, Time, B1x, B1y, B2x, B2y, B3x, B3y, B4x, B4y, B5x, B5y) VALUES('$currBA', '$bDOF', '$bTime', '$bBx1', '$bBy1', '$bBx2', '$bBy2', '$bBx3', '$bBy3', '$bBx4', '$bBy4', '$bBx5', '$bBy5')";
  $result=mysqli_query($conn, $ssql);
  if($result){
    echo '<script>alert("Data Uploaded")</script>';
  }else{
    echo '<script>alert("Data not Uploaded")</script>';
  }
 }
 
 





?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zero Weapon | Bullet Impression Input</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="../../plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../bower_components/select2/dist/css/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="http://localhost/ZeroWeapon/index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">Zero</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">Zero Weapon</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php  
                $query = "SELECT Image FROM firer WHERE BA='$currBA'";  
                $result = mysqli_query($conn, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Image'] ).'" height="160" width="160" class="user-image" /> ';  
                }  
                ?> 
              <span class="hidden-xs"><?php echo $userName ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <?php  
                $query = "SELECT Image FROM firer WHERE BA='$currBA'";  
                $result = mysqli_query($conn, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Image'] ).'" height="160" width="160" class="img-circle" /> ';  
                }  
                ?> 
                <p>
                <?php echo $userName ?>
                  <small>BA: <?php echo $currBA ?></small>
                </p>
                
                
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                
                
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
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
        
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
          <a href="#">
            <a href="http://localhost/ZeroWeapon/index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          
        </li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Bullet Impression
        <small>Input</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Input</a></li>
        <li class="active">Bullet Impression Input</li>
      </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <form role="form" action="bulletinput.php" method="post">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Bullet Impression Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
          
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Firing</label>
                  <input type="Date" class="form-control" name="DOF" id="DOF" placeholder="Enter Date of Firing" required>
                </div>
                <div class="bootstrap-timepicker">
                  <div class="form-group">
                    <label>Time picker:</label>
                    <div class="input-group">
                      <input type="text" class="form-control timepicker" name="Time">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#1 (x-coordinate)</label>
                  <input type="text" class="form-control" name="Bx1" id="Bx1" placeholder="Enter Bullet#1 (x-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#1 (y-coordinate)</label>
                  <input type="text" class="form-control" name="By1" id="By1" placeholder="Enter Bullet#1 (y-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#2 (x-coordinate)</label>
                  <input type="text" class="form-control" name="Bx2" id="Bx2" placeholder="Enter Bullet#2 (x-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#2 (y-coordinate)</label>
                  <input type="text" class="form-control" name="By2" id="By2" placeholder="Enter Bullet#2 (y-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#3 (x-coordinate)</label>
                  <input type="text" class="form-control" name="Bx3" id="Bx3" placeholder="Enter Bullet#3 (x-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#3 (y-coordinate)</label>
                  <input type="text" class="form-control" name="By3" id="By3" placeholder="Enter Bullet#3 (y-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#4 (x-coordinate)</label>
                  <input type="text" class="form-control" name="Bx4" id="Bx4" placeholder="Enter Bullet#4 (x-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#4 (y-coordinate)</label>
                  <input type="text" class="form-control" name="By4" id="By4" placeholder="Enter Bullet#4 (y-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#5 (x-coordinate)</label>
                  <input type="text" class="form-control" name="Bx5" id="Bx5" placeholder="Enter Bullet#5 (x-coordinate)" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputName">Bullet#5 (y-coordinate)</label>
                  <input type="text" class="form-control" name="By5" id="By5" placeholder="Enter Bullet#5 (y-coordinate)" required>
                </div>
              <!-- /.box-body -->

        <!--      <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>-->
            
          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->
        <!-- right column -->

          <!-- left column -->
        


        <!--/.col (right) -->
      </div>
      <!-- /.row -->


      <div class="row">
        <!-- left column -->
        
  
      </div>
      <!-- /.row -->

      <div class="row">
        
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Submission</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           
              
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                
              </div>
           
          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->
        <!-- right column -->

          <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <!-- /.box -->



        </div>
        <!--/.col (left) -->


        <!--/.col (right) -->
      </div>
      <!-- /.row -->


    </form>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      
    </div>
    <strong>Copyright &copy; 2019 </strong>
  </footer>

  
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="../../plugins/input-mask/jquery.inputmask.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="../../bower_components/moment/min/moment.min.js"></script>
<script src="../../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll -->
<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, locale: { format: 'MM/DD/YYYY hh:mm A' }})
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false,
      showMeridian: false
    })
  })
</script>
</body>
</html>
