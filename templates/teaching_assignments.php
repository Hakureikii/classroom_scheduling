<?php
session_start();

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
   <title>ICAS - Teaching Assignments</title>
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
            <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white active">⚙️ Teaching Assignments</a></li>
            <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white">📖 Manage Courses</a></li>
            <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a></li>
            <li class="nav-item"><a href="classroom.php" class="nav-link text-white">🏛️ Classrooms</a></li>
         </ul>
         <hr class="border-light">
         <a href="../auth/php/logout_admin.php" class="btn btn-outline-light w-100">🚪 Logout</a>
      </div>

      <!-- Main Content -->
      <div class="flex-grow-1" style="margin-left:250px;">
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
               <h5 class="fw-bold">Teaching Assignments</h5>
               <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addAssignmentModal">
                  ✙ Add Assignment
               </button>
            </div>

            <!-- Teaching Assignments Table -->
            <div class="table-responsive">
               <table class="table table-bordered table-hover align-middle">
                  <thead class="table-dark">
                     <tr>
                        <th>No.</th>
                        <th>Instructor</th>
                        <th>Course Code</th>
                        <th>Descriptive Title</th>
                        <th>Section</th>
                     </tr>
                  </thead>
                  <tbody id="teaching_assignment_table"></tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- Add Assignment Modal -->
   <div class="modal fade" id="addAssignmentModal" tabindex="-1">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Teaching Assignment</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="form_add_teaching_assignments">
               <div class="modal-body">
                  <div class="mb-3">
                     <label class="form-label">Instructor</label>
                     <select class="form-select" id="instructor"></select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Course</label>
                     <select class="form-select" id="course"></select>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Section</label>
                     <select class="form-select" id="section"></select>
                  </div>
                  <div id="assignments_message"></div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
   <script src="../jquery.js"></script>
   <script src="../crud/js/create.js"></script>
   <script src="../crud/js/delete.js"></script>
   <script src="../crud/js/fetch.js"></script>
   <script>
      // instructor dropdown options
      $.get("../crud/php/fetch_instructors.php", function (response) {
         const instructors = document.getElementById("instructor");
         let instructor = JSON.parse(response);
         for (let i = 0; i < instructor.length; i++) {
            let option = new Option(instructor[i].instructor_name, instructor[i].instructor_id);
            instructors.add(option);
         }
      });

      // course dropdown options
      $.get("../crud/php/fetch_courses.php", function (response) {
         const courses = document.getElementById("course");
         let course = JSON.parse(response);
         for (let i = 0; i < course.length; i++) {
            let option = new Option(course[i].course_details, course[i].course_id);
            courses.add(option);
         }
      });

      // section dropdown options
      $.get("../crud/php/fetch_sections.php", function (response) {
         const sections = document.getElementById("section");
         let section = JSON.parse(response);
         for (let i = 0; i < section.length; i++) {
            let option = new Option(section[i].section_name, section[i].section_id);
            sections.add(option);
         }
      });

      // create teaching assignments
      $("#form_add_teaching_assignments").submit(function (e) {
         e.preventDefault();
         let instructor = $("#instructor").val();
         let course = $("#course").val();
         let section = $("#section").val();
         form_add_teaching_assignments(instructor, course, section);
      });

      // retrieve teaching assignments
      fetch_teaching_assignments();

      // prevent cached back button
      window.addEventListener("pageshow", function (event) {
         if (event.persisted) {
            window.location.reload();
         }
      });
   </script>
</body>

</html>
