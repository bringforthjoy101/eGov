

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

        <?php
            $id = $_GET['rep_id'];
            $sql = "SELECT * FROM reports LEFT JOIN projects ON reports.project_id = projects.id LEFT JOIN users ON reports.reporter = users.uid WHERE reports.rep_id = ?";
            $res = mysqli_query($conn, $sql);
            //$row = mysqli_fetch_array($res);
            if($stmt = mysqli_prepare($conn, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "i", $param_id);
                
                // Set parameters
                $param_id = trim($_GET["rep_id"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    $result = mysqli_stmt_get_result($stmt);
            
                    if(mysqli_num_rows($result) == 1){
                        /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        
                        // Retrieve individual field value
                        
                    } else{
                        // URL doesn't contain valid id parameter. Redirect to error page
                        header("location: error.php");
                        exit();
                    }
                    
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            
            if(isset($_POST) & !empty($_POST)){
            $report = $_POST['report'];
            

            // Insert record
            $UpdateSql = "UPDATE reports SET report='$report' WHERE rep_id=$id";
            //$CreateSql = "INSERT INTO `projects` (title, description, prj_file, ministry, unit, created_at, due_at, updated_at, user_id) VALUES ('$title', '$desc', '$target_file', '$ministry', '$unit', now(), now() + interval 2 hour, now(), '$user_id')";
            $res = mysqli_query($conn, $UpdateSql) or die(mysqli_error($conn));

            if($res) {
                $smsg = "Project was successfully updated.";
                //header('location: projects.php');
                }else{
                $fmsg = "Project update failed.";
                }
                
            }

            
        ?>

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Update Project Report</h1>

            <div class="col-lg-6">
              <?php if(isset($smsg)){ ?><div class="card mb-4 py-3 border-left-success">
                  <div class="card-body">
                    <?php echo $smsg; ?>
                  </div>
                </div><?php } ?>
              <?php if(isset($fmsg)){ ?><div class="card mb-4 py-3 border-left-danger">
                  <div class="card-body">
                    <?php echo $fmsg; ?>
                  </div>
                </div><?php } ?>
            </div>

            <div class="col-lg-6">
              <div class="card shadow mb-4 ">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['title']; ?></h6>
                  </div>
                  <div class="card-body">
                  <form method="post" enctype='multipart/form-data'>
                      <div class="form-group">
                        <textarea class="form-control" rows="5" name="report" placeholder="Type Project Report..."><?php echo $row['report']; ?></textarea>
                      </div>
                      <input type="submit" class="btn btn-primary btn-block" value="Update Project report">
                  </form>
                  <div class="card-header py-3">
                      <a href="reports.php" class="btn btn-primary btn-block">Back to Project Report list</a>
                  </div>
              </div>
            </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

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
