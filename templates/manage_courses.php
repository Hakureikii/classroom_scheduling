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
   <title>ICAS - Manage Courses</title>
   <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
   <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
   <style>
      body {
         background-color: #f8f9fa;
      }

      .sidebar {
         position: fixed;
         top: 0;
         left: 0;
         height: 100vh;
         width: 250px;
         background-color: #212529;
         color: white;
         padding: 1rem;
      }

      .content {
         margin-left: 250px;
         flex-grow: 1;
         min-height: 100vh;
      }
   </style>
</head>

<body>
   <div class="d-flex">

      <!-- Sidebar -->
      <div class="sidebar">
         <h4 class="fw-bold">ICAS</h4>
         <hr class="border-light">
         <h1 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h1>
         <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
            <li class="nav-item"><a href="manage_users.php" class="nav-link text-white">👤 Manage Users</a></li>
            <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white">👥 Manage Sections</a></li>
            <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching
                  Assignments</a></li>
            <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white active">📖 Manage Courses</a>
            </li>
            <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a>
            </li>
            <li class="nav-item"><a href="classroom.php" class="nav-link text-white">🏛️ Classrooms</a></li>
         </ul>
         <hr class="border-light">
         <a href="../auth/php/logout_admin.php" class="btn btn-outline-light w-100">🚪 Logout</a>
      </div>

      <!-- Main Content -->
      <div class="content">

         <!-- Topbar -->
         <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white sticky-top">
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
               <h5 class="fw-bold">Courses</h5>
               <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal">✙ Add
                  Course</button>
            </div>

            <!-- Courses Table -->
            <div class="table-responsive">
               <table class="table table-bordered table-hover align-middle">
                  <thead class="table-dark">
                     <tr>
                        <th>No.</th>
                        <th>Course Code</th>
                        <th>Descriptive Title</th>
                        <th>Units</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody id="course_table">
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>

   <!-- Add Course Modal -->
   <div class="modal fade" id="addCourseModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Add Course</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <form id="form_add_course">
                  <div class="mb-3">
                     <label class="form-label">Course Code</label>
                     <input type="text" class="form-control" id="course_code" required>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Descriptive Title</label>
                     <input type="text" class="form-control" id="descriptive_title" required>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Units</label>
                     <input type="number" class="form-control" id="units" min="1" max="10" required>
                     <div id="add_courses_message"></div>
                  </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
               <button type="submit" form="form_add_course" class="btn btn-primary">Save</button>
            </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Edit Course Modal -->
   <div class="modal fade" id="editCourseModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit Course</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
               <form id="form_edit_course">
                  <input type="hidden" id="edit_course_id">
                  <div class="mb-3">
                     <label class="form-label">Course Code</label>
                     <input type="text" class="form-control" id="edit_course_code" required>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Descriptive Title</label>
                     <input type="text" class="form-control" id="edit_descriptive_title" required>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Units</label>
                     <input type="number" class="form-control" id="edit_units" min="1" max="10" required>
                     <div id="edit_courses_message"></div>
                  </div>
               </form>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Close </button>
               <button type="submit" form="form_edit_course" class="btn btn-success"> Save </button>
            </div>
         </div>
      </div>
   </div>


</body>

</html>

<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="../jquery.js"></script>
<script src="../crud/js/event_listeners.js"></script>
<script src="../crud/js/create.js"></script>
<script src="../crud/js/fetch.js"></script>
<script src="../crud/js/update.js"></script>

<script>
   //add courses form
   $("#form_add_course").submit(function (e) {
      e.preventDefault();
      let course_code = $("#course_code").val().trim();
      let descriptive_title = $("#descriptive_title").val().trim();
      let units = $("#units").val().trim();
      add_courses(course_code, descriptive_title, units);
   })

   //update courses form
   $("#form_edit_course").submit(function (e) {
      e.preventDefault();
      let course_id = $("#edit_course_id").val();
      let course_code = $("#edit_course_code").val().trim();
      let descriptive_title = $("#edit_descriptive_title").val().trim();
      let units = $("#edit_units").val().trim();

      update_courses(course_id, course_code, descriptive_title, units);
   })

   //display courses on the courses table
   fetch_courses();

   // prevent reload using back button after logout
   window.addEventListener("pageshow", function (event) {
      if (event.persisted) {
         window.location.reload();
      }
   });
</script>