

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
            <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">My Assignments (Departmental)</h6>
            </div>
            <?php
              if ($role_id == "1") {
                $ReadSql = "SELECT * FROM projects LEFT JOIN users ON projects.reporter = users.uid WHERE projects.reporter = $user_id";
                $res = mysqli_query($conn, $ReadSql);
              } elseif ($role_id == "2") {
                $ReadSql = "SELECT * FROM projects LEFT JOIN users ON projects.reporter = users.uid WHERE projects.department_id = $department_id ";
                $res = mysqli_query($conn, $ReadSql);
              } elseif ($role_id == "3") {
                $ReadSql = "SELECT * FROM projects LEFT JOIN users ON projects.reporter = users.uid WHERE projects.ministry_id = $ministry_id";
                $res = mysqli_query($conn, $ReadSql);
              } else {
                $ReadSql = "SELECT * FROM projects LEFT JOIN users ON projects.reporter = users.uid WHERE projects.department_id = $department_id";
                $res = mysqli_query($conn, $ReadSql);
              }
              
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
                      <th>Resolved</th>
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
                      <th>Resolved</th>
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
                          <a href="view.php?id=<?php echo $r['id']; ?>" class="btn btn-primary btn-circle" id="'.<?php $r["id"]; ?>'" alt="View Project"><i class="fas fa-glasses"></i></a>
                          
                          <a href="#" class="btn btn-success btn-circle" data-toggle="modal" data-target="#resolveModal<?php echo $r['id']; ?>" alt="Mark As Resolved"><i class="fas fa-check"></i></a>

                          


                          <!-- Resolve Modal -->
                            <div class="modal fade" id="resolveModal<?php echo $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog role="document>
                              
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Resolve Project?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Are you sure this project has been resolved?</p>
                                  </div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a href="resolve.php?id=<?php echo $r['id']; ?>" class="btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Yes!... Resolve</span></a>
                                  </div>
                                </div>
                                
                              </div>
                            </div>

                          

                        </td>
                        <td><?php echo $r['resolve']; ?></td>
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
