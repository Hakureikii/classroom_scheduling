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
   <title>ICAS - Manage Schedules</title>
   <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
   <div class="d-flex">

      <!-- Sidebar -->
      <div class="bg-dark text-white p-3 position-fixed" style="width:250px; height:100vh;">
         <h4 class="fw-bold">ICAS</h4>
         <hr class="border-light">
         <h1 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h1>
         <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
            <li class="nav-item"><a href="manage_users.php" class="nav-link text-white">👤 Manage Users</a></li>
            <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white">👥 Manage Sections</a></li>
            <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching
                  Assignments</a></li>
            <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white">📖 Manage Courses</a></li>
            <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white active">🗓️ Manage
                  Schedules</a></li>
            <li class="nav-item"><a href="classroom.php" class="nav-link text-white">🏛️ Classrooms</a></li>
            
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
         <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
               <h5 class="fw-bold">Schedules</h5>
               <div class="d-flex">
                  Select Instructors:
                  <select name="" id="select_instructors" class="ms-2 me-2 form-select-sm">
                     <option value=""> - Select Instructor -</option>
                  </select>
                  <!-- Open Modal Button -->
                  <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addScheduleModal">✙ Add
                     Schedule</button>
               </div>

            </div>

            <!-- Schedule Table -->
            <div class="table-responsive">
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
                  <tbody id="schedule_table"></tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- Add Schedule Modal -->
   <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Schedule</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <form id="form_add_schedule">
                  <div class="row g-3">
                     <div class="col-md-6">
                        Day:
                        <select name="" id="day" class="form-select">
                           <option value="Monday">Monday</option>
                           <option value="Tuesday">Tuesday</option>
                           <option value="Wednesday">Wednesday</option>
                           <option value="Thursday">Thursday</option>
                           <option value="Friday">Friday</option>
                           <option value="Saturday">Saturday</option>
                        </select>
                     </div>
                     <div class="col-md-6">
                        Room:
                        <select name="" id="room_no" class="form-select"></select>
                     </div>
                     <div class="col-md-6">
                        Time Start:
                        <select name="" id="start_time" class="form-select"></select>
                     </div>
                     <div class="col-md-6">
                        Time End:
                        <select name="" id="end_time" class="form-select"></select>
                     </div>
                     <div class="col-md-12">
                        Assignments:
                        <select name="" id="course_assignment" class="form-select"></select>
                     </div>
                  </div>
                  <div id="message" class="mt-2"></div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" form="form_add_schedule" class="btn btn-primary">Save</button>
            </div>
         </div>
      </div>
   </div>

   <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
   <script src="../jquery.js"></script>
   <script src="../crud/js/create.js"></script>
   <script src="../crud/js/fetch.js"></script>

   <script>
      // time dropdowns
      const start_time = document.getElementById("start_time");
      for (let h = 7; h < 18; h++) {
         for (let m of [0, 30]) {
            let hour = String(h);
            let minute = String(m).padStart(2, '0');
            let time = `${hour}:${minute}`;
            let option = new Option(time, time);
            start_time.add(option);
         }
      }


      const end_time = document.getElementById("end_time");
      for (let h = 7; h < 18; h++) {
         for (let m of [0, 30]) {
            let hour = String(h);
            let minute = String(m).padStart(2, '0');
            let time = `${hour}:${minute}`;
            let option = new Option(time, time);
            end_time.add(option);
         }
      }


      // room dropdown from DB
      $.get("../crud/php/fetch_rooms.php", function (response) {
         const rooms = document.getElementById("room_no");
         let room = JSON.parse(response);
         for (let i = 0; i < room.length; i++) {
            let option = new Option(room[i].room_name, room[i].room_id);
            rooms.add(option);
         }
      });


      // course assignments dropdown from DB
      $.get("../crud/php/fetch_assignments.php", function (response) {
         const course_assignments = document.getElementById("course_assignment");
         let assignments = JSON.parse(response);
         if (assignments.length > 0) {
            for (let i = 0; i < assignments.length; i++) {
               let option = new Option(assignments[i].course_section, assignments[i].assignment_id);
               course_assignments.add(option);
            }
         } else {
            let no_option = new Option("No Assigned Instructors", "null");
            course_assignments.add(no_option);
         }
      });

      //display schedules by instructors
      $.get("../crud/php/fetch_instructors.php", function (response) {
         const instructors = document.getElementById("select_instructors");
         let instructor = JSON.parse(response);
         for (let i = 0; i < instructor.length; i++) {
            let option = new Option(instructor[i].instructor_name, instructor[i].instructor_id);
            instructors.add(option);
         }
      });


      $(document).on('change', '#select_instructors', function () {
         fetch_schedules();
      })
      fetch_schedules();


      // submit schedule
      $("#form_add_schedule").submit(function (e) {
         e.preventDefault();
         let day = $("#day").val();
         let start_time = $("#start_time").val();
         let end_time = $("#end_time").val();
         let room_no = $("#room_no").val();
         let course_assignment = $("#course_assignment").val();
         form_add_new_schedules(day, start_time, end_time, room_no, course_assignment);
      });


      // reload on back button
      window.addEventListener("pageshow", function (event) {
         if (event.persisted) {
            window.location.reload();
         }
      });
   </script>
</body>

</html>