<?php
session_start();
include_once("../connection.php");

if (!isset($_SESSION["instructorID"])) {
  header("Location: ../index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ICT Building</title>
  <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
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
      <li class="nav-item"><a href="instructor_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
      <li class="nav-item"><a href="instructor_schedules.php" class="nav-link text-white">🗓️ My Schedules</a></li>
      <li class="nav-item"><a href="instructor_classroom.php" class="nav-link text-white active">🏛️ Classrooms </a></li>
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
            <div class="room room_11" id="Room 11" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 11</div>
            <div class="room room_10" id="Room 10" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 10</div>
            <div class="room room_9" id="Room 9" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 9</div>
            <div class="room room_8" id="Room 8" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 8</div>
            <div class="staircase-box">Staircase</div>
            <div class="office bg-primary text-white">MIS Office</div>
          </div>
          <div class="hallway-box">Hallway</div>
        </div>

        <div class="building-section shadow-sm p-4 rounded-4">
          <h5 class="text-center fw-bold mb-3">Second Floor</h5>
          <div class="floor-layout">
            <div class="staircase-box">Staircase</div>
            <div class="room room_7" id="Room 7" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 7</div>
            <div class="room room_6" id="Room 6" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 6</div>
            <div class="room room_5" id="Room 5" style="background-color: rgb(11, 162, 11); color: white"
              data-bs-toggle="modal" data-bs-target="#room_schedules">RM 5</div>
            <div class="office bg-primary text-white">Faculty Room</div>
            <div class="staircase-box">Staircase</div>
            <div class="office bg-primary text-white">ICT Office</div>
          </div>
          <div class="hallway-box">Hallway</div>
        </div>
      </div>
    </div>
  </div>

  <!-- ROOM SCHEDULES MODAL -->
  <div class="modal modal-xl fade" id="room_schedules" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Room Schedules</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <p id="current_schedule"></p>

          <div class="table-responsive">

            <!-- OPEN ADD SESSION MODAL BUTTON -->
            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addSessionModal">
              Add Session
            </button>

            <table class="table table-bordered table-hover align-middle">
              <thead class="table-dark">
                <tr>
                  <th>No.</th>
                  <th>Day</th>
                  <th>Room No.</th>
                  <th>Year & Section</th>
                  <th>Course</th>
                  <th>Instructor</th>
                  <th>Time Start</th>
                  <th>Time End</th>
                </tr>
              </thead>
              <tbody id="room_table_schedule"></tbody>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- ADD SESSION MODAL -->
  <div class="modal fade" id="addSessionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Add Session</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">


          <form id="form_add_session">

            <div class="row g-3">

              <!-- ROOM ID (hidden) -->
              <input type="text" id="room_id" hidden>

              <!-- DATE -->
              <div class="col-md-6">
                <label class="form-label">Date</label>
                <input type="date" id="session_date" class="form-control" required>
              </div>

              <!-- SESSION TYPE -->
              <div class="col-md-6">
                <label class="form-label">Session Type</label>
                <select id="session_type" class="form-select" required>
                  <option value="">- Select Type -</option>
                  <option value="Advanced">Advanced</option>
                  <option value="Remedial">Remedial</option>
                </select>
              </div>

              <!-- TIME START -->
              <div class="col-md-6">
                <label class="form-label">Time Start</label>
                <select id="time_start" class="form-select" required></select>
              </div>

              <!-- TIME END -->
              <div class="col-md-6">
                <label class="form-label">Time End</label>
                <select id="time_end" class="form-select" required></select>
              </div>

              <!-- COURSE / ASSIGNMENT -->
              <div class="col-md-12">
                <label class="form-label">Subject and Section</label>
                <select id="assignment" class="form-select" required></select>
              </div>

            </div>

          </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" form="form_add_session" class="btn btn-primary">Save Session</button>
        </div>

      </div>
    </div>
  </div>

  </div>
</body>

</html>

<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="../jquery.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>

<script>
  //CLASSROOM EVENT LISTENERS
  $(document).on('click', '.room_11', function () {
    fetch_room_schedules("Room 11");
    fetch_current_schedule("Room 11");
    $("#room_id").val(7);

  });

  $(document).on('click', '.room_10', function () {
    fetch_room_schedules("Room 10");
    fetch_current_schedule("Room 10");
    $("#room_id").val(6);
  });

  $(document).on('click', '.room_9', function () {
    fetch_room_schedules("Room 9");
    fetch_current_schedule("Room 9");
    $("#room_id").val(5);
  });

  $(document).on('click', '.room_8', function () {
    fetch_room_schedules("Room 8");
    fetch_current_schedule("Room 8");
    $("#room_id").val(4);
  });

  $(document).on('click', '.room_7', function () {
    fetch_room_schedules("Room 7");
    fetch_current_schedule("Room 7");
    $("#room_id").val(3);
  });

  $(document).on('click', '.room_6', function () {
    fetch_room_schedules("Room 6");
    fetch_current_schedule("Room 6");
    $("#room_id").val(2);
  });

  $(document).on('click', '.room_5', function () {
    fetch_room_schedules("Room 5");
    fetch_current_schedule("Room 5");
    $("#room_id").val(1);
  });

  // SUBMIT SESSION
  $("#form_add_session").submit(function (e) {
    e.preventDefault();

    let room = $("#room_id").val().trim();
    let date = $("#session_date").val().trim();
    let assignment = $("#assignment").val().trim();
    let session_type = $("#session_type").val().trim();
    let time_start = $("#time_start").val().trim();
    let time_end = $("#time_end").val().trim();

    add_session(room, date, assignment, session_type, time_start, time_end);
  });

  // DROPDOWN SUBJECT AND SECTION
  $.get("../crud/php/fetch_instructor_subject_section.php", function (response) {
    const subject_section = document.getElementById("assignment");
    let sub_sec = JSON.parse(response);
    if (sub_sec.length > 0) {
      for (let i = 0; i < sub_sec.length; i++) {
        let option = new Option(sub_sec[i].sub_sec, sub_sec[i].assignment_id);
        subject_section.add(option);
      }
    } else {
      let no_option = new Option("No Assigned Instructors", "null");
      subject_section.add(no_option);
    }
  });

  // time dropdowns
  const start_time = document.getElementById("time_start");
  for (let h = 7; h < 18; h++) {
    for (let m of [0, 30]) {
      let hour = String(h);
      let minute = String(m).padStart(2, '0');
      let time = `${hour}:${minute}`;
      let option = new Option(time, time);
      start_time.add(option);
    }
  }


  const end_time = document.getElementById("time_end");
  for (let h = 7; h < 18; h++) {
    for (let m of [0, 30]) {
      let hour = String(h);
      let minute = String(m).padStart(2, '0');
      let time = `${hour}:${minute}`;
      let option = new Option(time, time);
      end_time.add(option);
    }
  }

  //refresh classroom status every 7 seconds
  setInterval(fetch_room_status, 7000);
  fetch_room_status();

  window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
      window.location.reload();
    }
  });
</script>