

<?php
   include('session.php');
   if($role_id != "4") {
    header("404.html");
   }
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

        <!-- Funtion to insert new projects -->

        <?php
          require_once ('config/db.php');
          if(isset($_POST) & !empty($_POST)){
            $full_name = $_POST['full_name'];
            $email = $_POST['email'];
            $password = $_POST['password'] ;
            $phone = $_POST['phone'];
            $sex = $_POST['sex'];
            $role = $_POST['role'];
            $ministry = $_POST['ministry'];
            $department = $_POST['department'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $rand = random_int(1000, 9999);
            $state = 'OS';
            $staff_id = $state.$rand;

            // Insert record
            $CreateSql = "INSERT INTO users (full_name, email, password, phone, sex, staff_id, role_id, ministry_id, department_id, created_at, updated_at) VALUES ('$full_name', '$email', '$password_hash', '$phone', '$sex', '$staff_id', '$role', '$ministry', '$department', now(), now())";
            $res = mysqli_query($conn, $CreateSql) or die(mysqli_error($conn));
            
                // $sex = $_FILES['prj_file']['name'];
                // $target_dir = "upload/";
                // $target_file = $target_dir . basename($_FILES["prj_file"]["name"]);

                // // Select file type
                // $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                // // Valid file extensions
                // $extensions_arr = array("jpg","jpeg","png","gif","doc","docx","xls");

                // // Check extension
                // if( in_array($FileType,$extensions_arr) ){
            
                // // Insert record
                // $CreateSql = "INSERT INTO projects (title, description, prj_file, ministry_id, department_id, created_at, due_at, updated_at, reporter) VALUES ('$title', '$desc', '$target_file', '$ministry', '$department', now(), now() + interval 24 hour, now(), '$user_id')";
                // $res = mysqli_query($conn, $CreateSql) or die(mysqli_error($conn));
            
                // // Upload file
                // move_uploaded_file($_FILES['prj_file']['tmp_name'],$target_dir.$name);

                // }
          
            
            if($res){
              $smsg = "Staff Created Successfully .";
            }else{
              $fmsg = "Staff Creation Failed.";
            }
          }
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Staffs</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#newStaffModal"><i class="fas fa-download fa-sm text-white-50"></i> New Staff</a>
            </div>
            <div>
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

            <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Staffs</h6>
            </div>
            <?php
              $ReadSql = "SELECT * FROM users LEFT JOIN roles ON users.role_id = roles.id LEFT JOIN ministries ON users.u_ministry_id = ministries.min_id LEFT JOIN departments ON users.u_department_id = departments.id LEFT JOIN statuses ON users.status_id = statuses.id ";
              $res = mysqli_query($conn, $ReadSql);
            ?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Ministry</th>
                      <th>Department</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Full Name</th>
                      <th>Ministry</th>
                      <th>Department</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    while($r = mysqli_fetch_assoc($res)){
                    ?>
                      <tr> 
                        <th scope="row"><?php echo $r['staff_id']; ?></th> 
                        <td><?php echo $r['full_name']; ?></td> 
                        <td><?php echo $r['ministry']; ?></td> 
                        <td><?php echo $r['department']; ?></td> 
                        <td><?php echo $r['role']; ?></td>
                        <td><?php echo $r['status_name']; ?></td>
                        <td>
                          <a href="view.php?id=<?php echo $r['uid']; ?>" class="btn btn-primary btn-circle btn-sm" id="'.<?php $r["uid"]; ?>'"><i class="fas fa-glasses"></i></a>
                          
                          <a href="update.php?id=<?php echo $r['uid']; ?>" class="btn btn-info btn-circle btn-sm"><i class="fas fa-pen"></i></a>

                          <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal<?php echo $r['uid']; ?>"><i class="fas fa-trash"></i></a>


                          <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $r['uid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog role="document>
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Staff?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you want to permanently delete this Staff?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a href="delete_staff.php?uid=<?php echo $r['uid']; ?>" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Yes!... Delete</span></a>
                                  </div>
                                </div>
                                
                              </div>
                            </div>

                          

                        </td>
                      </tr> 
                    <?php } ?>
                  </tbody>
                </table>
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
  <?php
    include('layouts/logoutModal.php')
  ?>

    <!-- New Staff Modal-->
    
    <div class="modal fade" id="newStaffModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Staff</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" enctype='multipart/form-data'>
            <div class="form-group">
              <input type="text" class="form-control" name="full_name" placeholder="Full Name">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control" name="password" placeholder="Password" value="000000" readonly>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="phone" placeholder="Phone Number">
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <select name="sex" id="sex" class="form-control custom-select mb-3">
                    <option selected>Select Sex</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-sm-6">
                <?php
                        //include database
                        include_once('config/dbase.php');
                        
                        //get all ministry data
                        $query = $db->query("SELECT * FROM roles ORDER BY id ASC");

                        //counts total numbers of rows
                        $rowCount = $query->num_rows;
                    ?>
                        <select name="role" id="role" class="form-control custom-select mb-3">
                        <option selected>Role</option>
                        <?php
                            if($rowCount > 0){
                                while($row = $query->fetch_assoc()){ 
                                    echo '<option value="'.$row['id'].'">'.$row['role'].'</option>';
                                }
                            }else{
                                echo '<option value="">Category not available</option>';
                            }
                        ?>
                        </select>
              </div>
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
                    <option selected>Ministry</option>
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
                <select name="department" id="department" class="form-control custom-select mb-3">
                    <option selected>Select Department</option>
                </select>
              </div>
            </div>
            <input type="submit" class="btn btn-primary btn-block" value="Create Staff">
            
            
          </form>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
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
