

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

        <!-- Funtion to insert new projects -->

        <?php
          require_once ('config/db.php');
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
          
              // Insert record
              $CreateSql = "INSERT INTO projects (title, description, prj_file, ministry_id, department_id, created_at, due_at, updated_at, reporter) VALUES ('$title', '$desc', '$target_file', '$ministry', '$department', now(), now() + interval 24 hour, now(), '$user_id')";
              $res = mysqli_query($conn, $CreateSql) or die(mysqli_error($conn));
          
              // Upload file
              move_uploaded_file($_FILES['prj_file']['tmp_name'],$target_dir.$name);

            }
          
            
            if($res){
              $smsg = "Project was successfully created.";
            }else{
              $fmsg = "Project creation failed.";
            }
          }
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#newProjectModal"><i class="fas fa-download fa-sm text-white-50"></i> New Project</a>
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
              <h6 class="m-0 font-weight-bold text-primary">My Projects</h6>
            </div>
            <?php
              $ReadSql = "SELECT * FROM users INNER JOIN projects ON users.uid = projects.reporter WHERE projects.reporter = $user_id";
              
              $res = mysqli_query($conn, $ReadSql);
            ?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Title</th>
                      <th>Time Reported</th>
                      <th>Time Due</th>
                      <th>Reporter</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S/N</th>
                      <th>Title</th>
                      <th>Time Reported</th>
                      <th>Time Due</th>
                      <th>Reporter</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    while($r = mysqli_fetch_assoc($res)){
                    ?>
                      <tr> 
                        <th scope="row"><?php echo $r['id']; ?></th> 
                        <td><?php echo $r['title']; ?></td> 
                        <?php 
                          $t1= $r['created_at'];
                          $t2= $r['due_at'];
                        ?> 
                        <td><?php echo Date("g:i a, D, M j, Y",strtotime($t1)); ?></td> 
                        <td><?php echo Date("g:i a, D, M j, Y",strtotime($t2)); ?></td> 
                        <td><?php echo $r['full_name'];?></td>
                        <td>
                          <a href="view.php?id=<?php echo $r['id']; ?>" class="btn btn-primary btn-circle" id="'.<?php $r["id"]; ?>'"><i class="fas fa-glasses"></i></a>
                          
                          <a href="update.php?id=<?php echo $r['id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-pen"></i></a>

                          <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal<?php echo $r['id']; ?>"><i class="fas fa-trash"></i></a>


                          <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog role="document>
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Project?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you want to permanently delete this project?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a href="delete.php?id=<?php echo $r['id']; ?>" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Yes!... Delete</span></a>
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

    <!-- New Project Modal-->
    
    <div class="modal fade" id="newProjectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Project</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" enctype='multipart/form-data'>
            <div class="form-group">
              <input type="text" class="form-control" name="title" placeholder="Project Title">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" name="desc" placeholder="Project Description..."></textarea>
            </div>
            <div class="form-group">
              <input type="file" class="form-control-file" name="prj_file">
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
            <input type="submit" class="btn btn-primary btn-block" value="Create Project">
            
            
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
  
  <script href="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script href="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script href="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

  <?php include 'jquery.php'; ?>


</body>

</html>
