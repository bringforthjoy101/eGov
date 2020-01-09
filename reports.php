

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
            $project = $_POST['project'];
            $report = $_POST['report'];
            $rand = random_int(100000, 999999);
            $const = 'POP';
            $report_id = $rand.$const;

            // Insert record
            $CreateSql = "INSERT INTO reports (project_id, report_id, report, time_created, reporter) VALUES ('$project', '$report_id', '$report', now(), '$user_id')";
            $res = mysqli_query($conn, $CreateSql) or die(mysqli_error($conn));
          
            if($res){
              $smsg = "Report was successfully Sent.";
            }else{
              $fmsg = "Report Sending failed.";
            }
          }
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-4 text-gray-800">All Reports</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#newReportModal"><i class="fas fa-download fa-sm text-white-50"></i> New Report</a>
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
              <h6 class="m-0 font-weight-bold text-primary">My Reports</h6>
            </div>
            <?php

                if ($role_id == "1") {
                  $ReadSql = "SELECT * FROM reports LEFT JOIN projects ON reports.project_id = projects.id LEFT JOIN users ON reports.reporter = users.uid WHERE reports.reporter = $user_id ";
                  $res = mysqli_query($conn, $ReadSql);
                } elseif ($role_id == "2") {
                  $ReadSql = "SELECT * FROM reports LEFT JOIN projects ON reports.project_id = projects.id LEFT JOIN users ON reports.reporter = users.uid WHERE projects.ministry_id = $ministry_id ";
                  $res = mysqli_query($conn, $ReadSql);
                } elseif ($role_id == "3") {
                  $ReadSql = "SELECT * FROM reports LEFT JOIN projects ON reports.project_id = projects.id LEFT JOIN users ON reports.reporter = users.uid  ";
                  $res = mysqli_query($conn, $ReadSql);
                } else {
                  $ReadSql = "SELECT * FROM reports LEFT JOIN projects ON reports.project_id = projects.id LEFT JOIN users ON reports.reporter = users.uid WHERE reports.reporter = $user_id ";
                  $res = mysqli_query($conn, $ReadSql);
                }

            ?>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Project</th>
                      <th>Report</th>
                      <th>Time Reported</th>
                      <th>Reporter</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Project</th>
                      <th>Report</th>
                      <th>Time Reported</th>
                      <th>Reporter</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php 
                    while($r = mysqli_fetch_assoc($res)){
                    ?>
                      <tr> 
                        <th scope="row"><?php echo $r['report_id']; ?></th> 
                        <td><?php echo $r['title']; ?></td>
                        <td><?php echo $r['report']; ?></td> 
                        <?php 
                          $t1= $r['time_created'];
                        ?> 
                        <td><?php echo Date("g:i a, D, M j, Y",strtotime($t1)); ?></td>
                        <td><?php echo $r['full_name'];?></td>
                        <td>
                          <a href="view_report.php?rep_id=<?php echo $r['rep_id']; ?>" class="btn btn-primary btn-circle" id="'.<?php $r["rep_id"]; ?>'"><i class="fas fa-glasses"></i></a>
                          
                          <a href="update_report.php?rep_id=<?php echo $r['rep_id']; ?>" class="btn btn-info btn-circle"><i class="fas fa-pen"></i></a>

                          <a href="#" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#deleteModal<?php echo $r['rep_id']; ?>"><i class="fas fa-trash"></i></a>


                          <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal<?php echo $r['rep_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog role="document>
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Delete Project Report?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure you want to permanently delete this Project Report?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a href="delete_report.php?rep_id=<?php echo $r['rep_id']; ?>" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span><span class="text">Yes!... Delete</span></a>
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
    
    <div class="modal fade" id="newReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create New Report</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" enctype='multipart/form-data'>
            <div class="form-group">
            <?php
                //include database
                include_once('config/dbase.php');
                
                //get all ministry data
                $query = $db->query("SELECT * FROM projects ORDER BY id ASC");

                //counts total numbers of rows
                $rowCount = $query->num_rows;
              ?>
                <select name="project" id="project" class="form-control custom-select mb-3">
                  <option selected>Select Project</option>
                  <?php
                    if($rowCount > 0){
                        while($row = $query->fetch_assoc()){ 
                            echo '<option value="'.$row['id'].'">'.$row['title'].'</option>';
                        }
                    }else{
                        echo '<option value="">Category not available</option>';
                    }
                  ?>
                </select>
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="5" name="report" placeholder="Type Report..."></textarea>
            </div>
            
            <input type="submit" class="btn btn-primary btn-block" value="Make Report">
            
            
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
