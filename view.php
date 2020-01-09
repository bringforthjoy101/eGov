

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
            // require_once('config/db.php');
            // $id = $_GET['id'];
            // $ReadSql = "SELECT * FROM users INNER JOIN projects ON users.id = projects.user_id WHERE id = '$id' ";
            // if($res = mysqli_query($conn, $ReadSql)) {
            //     $r = mysqli_fetch_assoc($res);
            // }
            
            
        ?>

        <?php
            // Check existence of id parameter before processing further
            if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
                // Include config file
                require_once('config/db.php');
                $id = $_GET['id'];
                // Prepare a select statement
                $sql = "SELECT * FROM users INNER JOIN projects ON users.uid = projects.reporter WHERE projects.id = ?";
                
                if($stmt = mysqli_prepare($conn, $sql)){
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($stmt, "i", $param_id);
                    
                    // Set parameters
                    $param_id = trim($_GET["id"]);
                    
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
                
                // Close statement
                //mysqli_stmt_close($stmt);
                
                // Close connection
                mysqli_close($conn);
            } else{
                // URL doesn't contain id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        ?>

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Project Details</h1>

            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><?php echo $row['title']; ?></h6>
                </div>
                <div class="card-body">
                    <div>
                        <blockquote><i><?php echo $row['description']; ?></i></blockquote>
                    </div>
                    
                    <?php 
                        $t1= $row['created_at'];
                        $t2= $row['due_at'];
                    ?>
                    <div>
                        <b>Time Reported : </b><?php echo Date("g:i a, D, M j, Y",strtotime($t1)); ?><br>
                    </div>
                    <div>
                        <b>Time Due : </b><?php echo Date("g:i a, D, M j, Y",strtotime($t2)); ?><br>
                    </div>
                    <div>
                        
                        <b>Reported By : </b><?php echo $row['full_name']; ?><br>
                    </div>
                    <div>
                        <a href="<?php echo $row['prj_file']; ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" ><i class="fas fa-download fa-sm text-white-50"></i> Download project file</a>
                    </div>
                </div>
                <div class="card-header py-3">
                    <a href="projects.php" class="btn btn-primary btn-block">Back to Project list</a>
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
