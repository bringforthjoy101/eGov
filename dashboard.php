

<?php
   include('session.php');
   include('layouts/header.php');
?>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php
    include('layouts/sidebar.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php
        include('layouts/topbar.php');
        ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
        

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Dashboard <?php echo $role_id?></h1>

            <div class="row">

                        <?php
                          if ($role_id == "1") {
                            $ReadSql = "SELECT * FROM projects WHERE reporter = $user_id";
                            $res = mysqli_query($conn, $ReadSql);
                            $ass_count = mysqli_num_rows($res);

                            // reports
                            $ReadSql1 = "SELECT * FROM reports WHERE reporter = $user_id";
                            $res1 = mysqli_query($conn, $ReadSql1);
                            $rep_count = mysqli_num_rows($res1);

                          } elseif ($role_id == "2") {
                            $ReadSql = "SELECT * FROM projects WHERE department_id = $department_id ";
                            $res = mysqli_query($conn, $ReadSql);
                            $ass_count = mysqli_num_rows($res);

                            // reports
                            $ReadSql1 = "SELECT * FROM reports WHERE reporter = $user_id";
                            $res1 = mysqli_query($conn, $ReadSql1);
                            $rep_count = mysqli_num_rows($res1);

                          } elseif ($role_id == "3") {
                            $ReadSql = "SELECT * FROM projects WHERE ministry_id = $ministry_id";
                            $res = mysqli_query($conn, $ReadSql);
                            $ass_count = mysqli_num_rows($res);

                            // reports
                            $ReadSql1 = "SELECT * FROM reports WHERE reporter = $user_id";
                            $res1 = mysqli_query($conn, $ReadSql1);
                            $rep_count = mysqli_num_rows($res1);

                          } else {
                            $ReadSql = "SELECT * FROM projects WHERE department_id = $department_id";
                            $res = mysqli_query($conn, $ReadSql);
                            $ass_count = mysqli_num_rows($res);

                            // reports
                            $ReadSql1 = "SELECT * FROM reports WHERE reporter = $user_id";
                            $res1 = mysqli_query($conn, $ReadSql1);
                            $rep_count = mysqli_num_rows($res1);

                          }
                          
                        ?>
                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">My Assignments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ass_count; ?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">My Projects</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $ass_count; ?></div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">My Reports</div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php
                                  echo $rep_count;
                                ?>
                              </div>
                            </div>
                        </div>
                        </div>
                        <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            <div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php
        include('layouts/footer.php');
      ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <?php
    include('layouts/logoutModal.php')
  ?>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
