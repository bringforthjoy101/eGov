

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
            $id = $_GET['id'];
            $sql = "SELECT * FROM users INNER JOIN projects ON users.uid = projects.reporter LEFT JOIN ministries ON projects.ministry_id = ministries.min_id LEFT JOIN departments ON projects.department_id = departments.id WHERE projects.id = ?";
            $res = mysqli_query($conn, $sql);
            //$row = mysqli_fetch_array($res);
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
            
            if(isset($_POST) & !empty($_POST)){
            $title = $_POST['title'];
            $desc = $_POST['desc'];
            $ministry = $_POST['ministry'];
            $department = $_POST['department'];
            $name = $_FILES['prj_file']['name'];
            $target_dir = "upload/";
            $target_file = $target_dir . basename($_FILES["prj_file"]["name"]);

            // Select file type
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Valid file extensions
            $extensions_arr = array("jpg","jpeg","png","gif","doc","docx","xls");

            // Check extension
            if( in_array($FileType,$extensions_arr) ){
          
              
          
              // Upload file
              move_uploaded_file($_FILES['prj_file']['tmp_name'],$target_dir.$name);

              
            }
            // Insert record
            $UpdateSql = "UPDATE projects SET title='$title', description='$desc', prj_file='$target_file', ministry_id='$ministry', department_id='$department', updated_at=now() WHERE id=$id";
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
            <h1 class="h3 mb-4 text-gray-800">Update Project</h1>

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
                      <input type="text" class="form-control" name="title" placeholder="Project Title" value="<?php echo $row['title']; ?>">
                      </div>
                      <div class="form-group">
                      <textarea class="form-control" rows="5" name="desc" placeholder="Project Description..."><?php echo $row['description']; ?></textarea>
                      </div>
                      <div class="form-group">
                      <input type="file" class="form-control-file" name="prj_file" value="<?php echo $row['prj_file']; ?>">
                      </div>
                      <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                            <?php
                              //include database
                              include_once('config/dbase.php');
                              
                              //get all ministry data
                              $query = $db->query("SELECT * FROM ministries ORDER BY min_id ASC");

                              //counts total numbers of rows
                              $rowCount = $query->num_rows;
                            ?>
                          <select name="ministry" id="ministry" class="form-control custom-select mb-3">
                          <option selected><?php echo $row['ministry']; ?></option>
                          <?php
                            if($rowCount > 0){
                                while($row = $query->fetch_assoc()){ 
                                    echo '<option value="'.$row['min_id'].'">'.$row['ministry'].'</option>';
                                }
                            }else{
                                echo '<option value="">Category not available</option>';
                            }
                          ?>
                          </select>
                      </div>
                      <div class="col-sm-6">
                      <?php
                        //include database
                        include_once('config/dbase.php');
                        
                        //get all ministry data
                        $query = $db->query("SELECT * FROM departments ORDER BY id ASC");

                        //counts total numbers of rows
                        $rowCount = $query->num_rows;
                      ?>
                      <select name="department" id="department" class="form-control custom-select mb-3">
                          <option selected><?php echo $row['department']; ?></option>
                      </select>
                      </div>
                      </div>
                      <input type="submit" class="btn btn-primary btn-block" value="Update Project">
                  </form>
                  <div class="card-header py-3">
                      <a href="projects.php" class="btn btn-primary btn-block">Back to Project list</a>
                  </div>
              </div>
            </div>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include('layouts/footer.php'); ?>
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

  <?php include 'jquery.php'; ?>

</body>

</html>
