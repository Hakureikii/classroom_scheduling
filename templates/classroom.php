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
  <style>
    body {
      overflow-x: hidden;
    }

    /* Fixed sidebar */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 250px;
      background-color: #212529;
      color: white;
      overflow-y: auto;
    }

    /* Push content area beside sidebar */
    .main-content {
      margin-left: 250px;
      padding: 20px;
      min-height: 100vh;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
      }

      .main-content {
        margin-left: 0;
      }
    }
  </style>
</head>

<body class="bg-light">

  <div class="sidebar p-3">
    <h4 class="fw-bold">ICAS</h4>
    <hr class="border-light">
    <h6 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h6>
    <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
      <li class="nav-item"><a href="manage_users.php" class="nav-link text-white">👤 Manage Users</a></li>
      <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white">👥 Manage Sections</a></li>
      <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching Assignments</a></li>
      <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white">📖 Manage Courses</a></li>
      <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a></li>
      <li class="nav-item"><a href="classroom.php" class="nav-link text-white active">🏛️ Classrooms</a></li>
    </ul>
    <hr class="border-light">
    <a href="../auth/php/logout.php" class="btn btn-outline-light w-100">🚪 Logout</a>
  </div>

  <div class="main-content">
    <h2 class="text-center mb-5 mt-4 fw-bold">ICT BUILDING</h2>
    <div class="row justify-content-center g-2 px-3">
      <div class="col-md-3 mb-4">
        <div class="legend-card p-3 shadow-sm bg-white rounded-3">
          <h5 class="fw-bold text-center mb-3">Legend</h5>
          <div class="d-flex align-items-center mb-2"><span class="legend-box occupied me-2"></span>Occupied</div>
          <div class="d-flex align-items-center mb-2"><span class="legend-box vacant me-2"></span>Vacant</div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="building-section shadow-sm p-4 rounded-4 mb-4">
          <h5 class="text-center fw-bold mb-3">Third Floor</h5>
          <div class="floor-layout">
            <div class="staircase-box">Staircase</div>
            <div class="room" id="Room 11" style="background-color: rgb(11, 162, 11); color: white">RM 11</div>
            <div class="room" id="Room 10" style="background-color: rgb(11, 162, 11); color: white">RM 10</div>
            <div class="room" id="Room 9" style="background-color: rgb(11, 162, 11); color: white">RM 9</div>
            <div class="room" id="Room 8" style="background-color: rgb(11, 162, 11); color: white">RM 8</div>
            <div class="staircase-box">Staircase</div>
            <div class="office bg-primary text-white">MIS Office</div>
          </div>
          <div class="hallway-box">Hallway</div>
        </div>

        <div class="building-section shadow-sm p-4 rounded-4">
          <h5 class="text-center fw-bold mb-3">Second Floor</h5>
          <div class="floor-layout">
            <div class="staircase-box">Staircase</div>
            <div class="room" id="Room 7" style="background-color: rgb(11, 162, 11); color: white">RM 7</div>
            <div class="room" id="Room 6" style="background-color: rgb(11, 162, 11); color: white">RM 6</div>
            <div class="room" id="Room 5" style="background-color: rgb(11, 162, 11); color: white">RM 5</div>
            <div class="office bg-primary text-white">Faculty Room</div>
            <div class="staircase-box">Staircase</div>
            <div class="office bg-primary text-white">ICT Office</div>
          </div>
          <div class="hallway-box">Hallway</div>
        </div>
      </div>
    </div>
  </div>

  <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener("pageshow", function (event) {
      if (event.persisted) {
        window.location.reload();
      }
    });
  </script>
</body>
</html>

<script src="../jquery.js"></script>
<script src="../crud/js/fetch.js"></script>
<script>
  setInterval(fetch_room_status, 7000);
  fetch_room_status();
</script>