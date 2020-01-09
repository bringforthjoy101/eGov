<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">e-Gov <sup>v 1.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">
          <?php
            if ($role_id == "1") {
              echo '<li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="projects.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Projects</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assignments.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Assignment</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Reports</span></a>
            </li>';
            }
            elseif ($role_id == "2") {
              echo '<li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assignments.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Assignment</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="projects.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Projects</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Reports</span></a>
            </li>';
            } elseif ($role_id == "3") {
              echo '<li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assignments.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Approved Projects</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Reports</span></a>
            </li>';
            } else {
              echo '<li class="nav-item">
              <a class="nav-link" href="dashboard.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assignments.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Assignment</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="projects.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Projects</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="reports.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>My Reports</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="staffs.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Staff Management</span></a>
            </li>';
            }
          ?>

      <!-- Nav Item - Dashboard -->
      <!-- <li class="nav-item">
        <a class="nav-link" href="dashboard.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="assignments.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Assignment</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="projects.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>My Projects</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reports.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>My Reports</span></a>
      </li> -->

      

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>