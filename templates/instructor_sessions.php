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
    <title>ICAS - Instructor Sessions</title>
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* Fixed Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #212529;
            color: white;
            overflow-y: auto;
            z-index: 1000;
        }

        /* Content beside sidebar */
        .content-area {
            margin-left: 250px;
            width: calc(100% - 250px);
        }

        /* Mobile responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
            }

            .content-area {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
</head>

<body class="bg-light">

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="fw-bold">ICAS</h4>
        <hr class="border-light">
        <h6 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h6>

        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="instructor_dashboard.php" class="nav-link text-white">
                    <i class="bi-house me-2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="instructor_schedules.php" class="nav-link text-white">
                    <i class="bi-calendar me-2"></i> My Schedules
                </a>
            </li>
            <li class="nav-item">
                <a href="section_schedules.php" class="nav-link text-white">
                    <i class="bi-diagram-3 me-2"></i> Section Schedules
                </a>
            </li>
            <li class="nav-item">
                <a href="instructor_classroom.php" class="nav-link text-white">
                    <i class="bi-building me-2"></i> Classrooms
                </a>
            </li>
            <li class="nav-item">
                <a href="instructor_sessions.php" class="nav-link text-white active">
                    <i class="bi-people me-2"></i> Sessions
                </a>
            </li>
            <li class="nav-item">
                <a href="session_history.php" class="nav-link text-white">
                    <i class="bi-clock-history me-2"></i> Session History
                </a>
            </li>
        </ul>

        <hr class="border-light">
        <a href="../auth/php/logout.php" class="btn btn-outline-light w-100">
            <i class="bi-arrow-bar-left"></i> Logout
        </a>
    </div>

    <!-- Main Content -->
    <div class="content-area">

        <!-- Topbar -->
        <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white">
            <h4 class="mb-0">Welcome <?php echo $_SESSION["instructorName"]; ?>!</h4>
            <div class="d-flex align-items-center gap-2">
                <img src="" alt="Profile" class="rounded-circle" width="40">
                <span><?php echo $_SESSION["instructorName"]; ?></span>
                <a href="../auth/php/logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold">Sessions</h5>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No.</th>
                            <th>Day</th>
                            <th>Date</th>
                            <th>Room No.</th>
                            <th>Year & Section</th>
                            <th>Session Type</th>
                            <th>Course</th>
                            <th>Instructor</th>
                            <th>Time Start</th>
                            <th>Time End</th>
                            <th>Type</th>
                        </tr>
                    </thead>
                    <tbody id="instructor_session_table"></tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery.js"></script>
    <script src="../crud/js/create.js"></script>
    <script src="../crud/js/fetch.js"></script>
    <script src="../crud/js/delete.js"></script>

    <script>
        archive_sessions();

        fetch_sessions();

        // Reload on back button
        window.addEventListener("pageshow", function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>

</body>

</html>
