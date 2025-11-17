<?php
session_start();
include_once("../connection.php");

if (!isset($_SESSION["instructorID"])) {
    header("Location: ../auth/index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICAS - Instructor Schedules</title>
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
            <h4 class="fw-bold">ICAS</h4>
            <hr class="border-light">
            <h1 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h1>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="instructor_dashboard.php" class="nav-link text-white">🏠 Dashboard</a>
                </li>
                <li class="nav-item"><a href="instructor_schedules.php" class="nav-link text-white active">🗓️ My Schedules</a>
                </li>
                <li class="nav-item"><a href="instructor_classroom.php" class="nav-link text-white">🏛️ Classrooms</a>
                </li>
            </ul>
            <hr class="border-light">
            <a href="../auth/php/logout_admin.php" class="btn btn-outline-light w-100">🚪 Logout</a>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">

            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white">
                <h4 class="mb-0">Welcome <?php echo $_SESSION["instructorName"]; ?>!</h4>
                <div class="d-flex align-items-center gap-2">
                    <img src="" alt="Profile" class="rounded-circle" width="40">
                    <span><?php echo $_SESSION["instructorName"]; ?></span>
                    <a href="../auth/php/logout_admin.php" class="btn btn-outline-dark btn-sm">Logout</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold">Instructor Schedules</h5>

                    <div class="d-flex align-items-center">
                        Select Sections:
                        <select id="assignment" class="ms-2 form-select-sm">
                            <option value=""> - Select Sections -</option>
                        </select>
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

    <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery.js"></script>
    <script src="../crud/js/create.js"></script>
    <script src="../crud/js/fetch.js"></script>

    <script>

        // Populate sections dropdown
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

        // Fetch schedules when section is selected
        $(document).on('change', '#assignment', function () {
            fetch_instructor_schedules();
        });

        fetch_instructor_schedules();

        // Reload on back button
        window.addEventListener("pageshow", function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });

    </script>

</body>

</html>