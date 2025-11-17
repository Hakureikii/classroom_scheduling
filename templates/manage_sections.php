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
    <title>ICAS - Manage Sections</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
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
                <li class="nav-item"><a href="manage_users.php" class="nav-link text-white">👤 Manage Users</a></li>
                <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white active">👥 Manage
                        Sections</a></li>
                <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching
                        Assignments</a></li>
                <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white">📖 Manage Courses</a></li>
                <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a>
                </li>
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
                    <h5 class="fw-bold">Sections</h5>
                    <!-- Open Modal Button -->
                    <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addSectionModal">✙ Add
                        Sections</button>
                </div>

                <!-- Section Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Section</th>
                            </tr>
                        </thead>
                        <tbody id="section_table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addSectionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Section</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_section">
                        <div class="row g-3">
                            <input type="text" placeholder="Section Name" class="form-control" id="section-name" required>
                        </div>
                        <div id="message" class="mt-2"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form_add_section" class="btn btn-primary">Save</button>
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
    // add sections
    $("#form_add_section").submit(function(e) {
        e.preventDefault();

        let section_name = $("#section-name").val().trim();
        add_section(section_name);
    })

    //display sections on table
    fetch_sections();


    // reload on back button
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>