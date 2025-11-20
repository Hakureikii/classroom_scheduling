<?php
session_start();
if (!isset($_SESSION["studentID"]) || !isset($_SESSION["studentName"])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICAS - Student Dashboard</title>
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
            <h4 class="fw-bold">ICAS</h4>
            <hr class="border-light">
            <h6 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h6>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="student_dashboard.php" class="nav-link text-white">
                        <i class="bi-house me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="student_courses.php" class="nav-link text-white active">
                        <i class="bi-journal-bookmark me-2"></i> My Courses
                    </a>
                </li>
                <li class="nav-item">
                    <a href="student_schedules.php" class="nav-link text-white">
                        <i class="bi-calendar me-2"></i> My Schedules
                    </a>
                </li>
                <li class="nav-item">
                    <a href="student_classroom.php" class="nav-link text-white">
                        <i class="bi-building me-2"></i> Classrooms
                    </a>
                </li>
                <li class="nav-item">
                    <a href="student_sessions.php" class="nav-link text-white">
                        <i class="bi-people me-2"></i> Sessions
                    </a>
                </li>
            </ul>
            <hr class="border-light">
            <a href="../auth/php/logout.php" class="btn btn-outline-light w-100"><i class="bi-arrow-bar-left"></i>
                Logout</a>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white">
                <h4 class="mb-0">Welcome <?php echo $_SESSION["studentName"]; ?>!</h4>
                <div class="d-flex align-items-center gap-2">
                    <img src="../assets/icons/user.png" alt="Profile" class="rounded-circle" width="40">
                    <span><?php echo $_SESSION["studentName"]; ?></span>
                    <a href="../auth/php/logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold">Courses</h5>

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th> Course Code </th>
                                <th> Descriptive Title </th>
                                <th> Instructor </th>
                            </tr>
                        </thead>
                        <tbody id="section_courses_table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</body>

</html>

<script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
<script src="../jquery.js"></script>
<script src="../crud/js/fetch.js"></script>
<script>
    fetch_student_courses();


    // Reload when back button is pressed
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>