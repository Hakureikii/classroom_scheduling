<?php
session_start();
include_once("../connection.php");

if (!isset($_SESSION["admin_ID"]) || !isset($_SESSION["admin"])) {
  header("Location: ../auth/admin.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ICT Building</title>
  <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/classroom.css">

</head>

<body class="bg-light">
  <div class="d-flex">

    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
      <h4 class="fw-bold">ICAS</h4>
      <hr class="border-light">
      <h1 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h1>
      <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
        <li class="nav-item"><a href="manage_users.php" class="nav-link text-white">👤 Manage Users</a>
        </li>
        <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white">👥 Manage Sections</a>
        </li>
        <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching
            Assignments</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">📖 Manage Courses</a></li>
        <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a>
        </li>
        <li class="nav-item"><a href="classroom.php" class="nav-link text-white active">🏛️ Classrooms</a>
        </li>
      </ul>
      <hr class="border-light">
      <a href="../auth/php/logout_admin.php" class="btn btn-outline-light w-100">🚪 Logout</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1">

      <!-- Topbar -->
      <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white">
        <h4 class="mb-0">Welcome <?php echo $_SESSION["admin"]; ?>!</h4>
        <div class="d-flex align-items-center gap-2">
          <img src="" alt="Profile" class="rounded-circle" width="40">
          <span><?php echo $_SESSION["admin"]; ?></span>
          <a href="../auth/php/logout_admin.php" class="btn btn-outline-dark btn-sm">Logout</a>
        </div>
      </div>

      <!-- Content Area -->
      <h2 class="text-center mb-3 mt-2 fw-bold">ICT BUILDING</h2>

      <div class="row justify-content-center g-4">
        <div class="col-md-3">
          <div class="legend-card p-3 shadow-sm text-center">
            <h5 class="mb-2">LEGEND</h5>
            <div class="mb-2 text-start">
              <span class="legend-box occupied"></span> Occupied
            </div>
            <div class="text-start">
              <span class="legend-box vacant"></span> Vacant
            </div>
          </div>
        </div>

        <div class="col-md-9">

          <!-- Second Floor -->
          <div class="building-section mb-4">
            <h5 class="text-center mb-3 fw-bold">Second Floor</h5>
            <div class="row g-3 text-center">
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 7</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 6</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 5</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border bg-primary rounded border-2 border-dark text-white fw-bold">FACULTY ROOM</div>
              </div>
            </div>
          </div>

          <!-- Third Floor -->
          <div class="building-section mb-4">
            <h5 class="text-center mb-3 fw-bold">Third Floor</h5>
            <div class="row g-3 text-center">
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 11</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 10</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 9</div>
              </div>
              <div class="col-md-3">
                <div class="p-4 border rounded border-2 border-dark text-dark fw-bold">RM 8</div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
  // prevent reload using back button after logout
  window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
      window.location.reload();
    }
  });
</script>