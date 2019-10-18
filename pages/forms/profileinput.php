<?php
  include('../examples/session.php');
  if(!isset($_SESSION['login_user'])){    //$_SESSION['login_user']=emailid of user
    header("location: http://localhost/ZeroWeapon/pages/examples/login.php");
  }
  //echo $_SESSION['login_user'];
  $email=$_SESSION['login_user'];
  //echo $email;
  $BAnum = "SELECT id, ActorType FROM logincredential WHERE username='$email'";
  $resultt = mysqli_query($conn, $BAnum);
  if (mysqli_num_rows($resultt) > 0) {
    while($roww = mysqli_fetch_assoc($resultt)) {
      $currBA = $roww["id"]; 
      $currAT = $roww["ActorType"];
      //echo $currBA;
    }
 }
 $uname = "SELECT Name FROM firer WHERE id='$currBA'";
 $result = mysqli_query($conn, $uname);
 if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $userName = $row["Name"]; 
    //echo $userName;
  }
}

  //update
if(isset($_POST['update'])){
  $fname = $_POST['Name'];
  $fdob = $_POST['DOB'];
  $fgender = $_POST['Gender'];
  $freligion = $_POST['Religion'];
  //$file = addslashes(file_get_contents($_FILES['Image']['tmp_name']));
  $fphn = $_POST['PhoneNumber'];
  $fvill = $_POST['Village'];
  $fpo = $_POST['PO'];
  $fps = $_POST['PS'];
  $fdis = $_POST['Dist'];
  $fnid = $_POST['NID'];
  $funit = $_POST['Unit'];
  $companyy = $_POST['Company'];
  $ssql = "UPDATE firer SET Name='$fname', DOB='$fdob', Gender='$fgender', Religion='$freligion', Cell='$fphn', Village='$fvill', PO='$fpo', PS='$fps', Dist='$fdis', NID='$fnid', Unit='$funit', Company='$companyy' WHERE id='$currBA'";
  $result=mysqli_query($conn, $ssql);
  if($result){
    echo '<script>alert("Data Updated")</script>';
  }else{
    echo '<script>alert("Data not Updated")</script>';
  }

  /* Upload Image */
  $check = getimagesize($_FILES["Image"]["tmp_name"]);
    if($check !== false){
        $image = $_FILES['Image']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
        $query="UPDATE firer SET Image='$imgContent' WHERE id='$currBA'";
        $insert=mysqli_query($conn, $query);
        if($insert){
            //echo "File uploaded successfully.";
        }else{
            //echo "File upload failed, please try again.";
        } 
    }else{
      echo "err";
    }

  /* Upload Image */




 }
 
 //display
 $disp = "SELECT * FROM firer WHERE id='$currBA'";
  $results = mysqli_query($conn, $disp);
  if (mysqli_num_rows($results) > 0) {
    while($rows = mysqli_fetch_assoc($results)) {
      $currBA = $rows["id"]; 
      $Namee=$rows["Name"];
      $DOBB=$rows["DOB"];
      $Genderr = $rows["Gender"];
      $Religionn=$rows['Religion'];
      $PhoneNumberr=$rows['Cell'];
      $Villagee=$rows['Village'];
      $Poo=$rows['PO'];
      $Pss=$rows['PS'];
      $Dist=$rows['Dist'];
      $NIDD=$rows['NID'];
      $Unitt=$rows['Unit'];
      $picc=$rows['Image'];
      $companyy=$rows['Company'];
    }
 }




?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Zero Weapon | Profile Update</title>
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
                $query = "SELECT Image FROM firer WHERE id='$currBA'";  
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
                $query = "SELECT Image FROM firer WHERE id='$currBA'";  
                $result = mysqli_query($conn, $query);  
                while($row = mysqli_fetch_array($result))  
                {  
                     echo '<img src="data:image/jpeg;base64,'.base64_encode($row['Image'] ).'" height="160" width="160" class="img-circle" /> ';  
                }  
                ?> 
                <p>
                <?php echo $userName ?>
                  <small>ID: <?php echo $currBA ?></small>
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
                <div class="pull-right">
                  <a href="http://localhost/ZeroWeapon/pages/examples/logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
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
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Input</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Personal Profile Update</a></li>
            <?php
              if($currAT==1){
                echo '<li><a href="../forms/selectsoldierprofileinput.php"><i class="fa fa-circle-o"></i> Soldier Profile Update</a></li>';
                echo '<li><a href="../forms/addsoldierprofile.php"><i class="fa fa-circle-o"></i> Add New Soldier</a></li>';
              }
            ?>    
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i> <span>Output</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../tables/GroupingResult.php"><i class="fa fa-circle-o"></i> Grouping Result</a></li>
            <li><a href="../tables/SOSNResult.php"><i class="fa fa-circle-o"></i> SOSN Result</a></li>
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
      <h1>
        Profile Update
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Input</a></li>
        <li class="active">Profile Update</li>
      </ol>
    </section>

    <!-- Main content -->
    <!-- Main content -->
    <section class="content">
      <form role="form" action="profileinput.php" method="post" enctype="multipart/form-data">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">General Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                
                
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="Name" id="Name" value="<?php echo $Namee; ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth</label>
                  <input type="Date" class="form-control" name="DOB" id="DOB" placeholder="Enter Date of Bith" value="<?php echo $DOBB?>" required>
                </div>
               <b>Gender</b>
                <div class="radio">
                    <label>
                      <input type="radio" name="Gender" <?php if($Genderr=="Male") {echo "checked";}?> id="optionsRadios2" value="Male" required>
                      Male
                    </label>
                </div>
                <div class="radio">
                    <label>
                      <input type="radio" name="Gender" <?php if($Genderr=="Female") {echo "checked";}?> id="optionsRadios2" value="Female" required>
                      Female
                    </label>
                </div>
                <div class="form-group">
                  <label>Religion</label>
                  <select class="form-control" name="Religion" id="Religion" required>
                    <?php
                    echo "<option value='". $Religionn ."'>" .$Religionn ."</option>" ;
                    ?>
                    <option value="NOT SELECTED">(--select--)</option>
                    <option value="Islam">Islam</option>
                    <option value="Hinduism">Hinduism</option>
                    <option value="Christian">Christian</option>
                    <option value="Buddhism">Buddhism</option>
                    <option value="Others">Others</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputFile">Add Image</label>
                  <input type="file" name="Image" id="Image">
                </div>

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
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Contact Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">Phone Number</label>
                  <input type="text" class="form-control" name="PhoneNumber" id="PhoneNumber" placeholder="Enter Phone Number" value="<?php echo $PhoneNumberr ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Village</label>
                  <input type="text" class="form-control" name="Village" id="Village" placeholder="Enter Road Number/Name" value="<?php echo $Villagee ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Post Office</label>
                  <input type="text" class="form-control" name="PO" id="PO" placeholder="Enter PO" value="<?php echo $Poo ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Police Station</label>
                  <input type="text" class="form-control" name="PS" id="PS" placeholder="Enter PS" value="<?php echo $Pss ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">District</label>
                  <input type="text" class="form-control" name="Dist" id="Dist" placeholder="Enter District" value="<?php echo $Dist ?>" required>
                </div>
                
                

              </div>
              <!-- /.box-body -->

        <!--      <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>-->
            
          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->


        <!--/.col (right) -->
      </div>
      <!-- /.row -->


      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Identification Information</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
          
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputName">NID Number</label>
                  <input type="text" class="form-control" name="NID" id="NID" placeholder="Enter NID" value="<?php echo $NIDD ?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Unit</label>
                  <input type="text" class="form-control" name="Unit" id="Unit" placeholder="Enter Unit" value="<?php echo $Unitt?>" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Company</label>
                  <input type="text" class="form-control" name="Company" id="Company" placeholder="Enter Company" value="<?php echo $companyy?>" required>
                </div>
                           

              </div>
              <!-- /.box-body -->

        <!--      <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>-->
           
          </div>
          <!-- /.box -->



        </div>
        <!--/.col (left) -->
  
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
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                
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
    <strong>Copyright &copy; 2019
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
      showInputs: false
    })
  })


</script>
</body>
</html>

