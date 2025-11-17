<?php
session_start();
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
    <title>ICAS - Instructor Dashboard</title>
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
</head>

<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width:250px; height:100vh;">
            <h4 class="fw-bold">ICAS</h4>
            <hr class="border-light">
            <h6 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h6>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="instructor_dashboard.php" class="nav-link text-white active">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="instructor_schedules.php" class="nav-link text-white">🗓️ My Schedules</a></li>
                <li class="nav-item"><a href="instructor_classroom.php" class="nav-link text-white">🏛️ Classrooms </a></li>
            </ul>
            <hr class="border-light">
            <a href="../../auth/php/logout.php" class="btn btn-outline-light w-100">🚪 Logout</a>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="d-flex justify-content-between align-items-center border-bottom py-3 px-4 bg-white">
                <h4 class="mb-0">Welcome <?php echo $_SESSION["instructorName"]; ?>!</h4>
                <div class="d-flex align-items-center gap-2">
                    <img src="../assets/icons/user.png" alt="Profile" class="rounded-circle" width="40">
                    <span><?php echo $_SESSION["instructorName"]; ?></span>
                    <a href="../auth/php/logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="p-4">
                <p class="lead">This is your dashboard. Use the menu on the left to navigate.</p>
            </div>
        </div>
    </div>

    <script src="../styles/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../jquery.js"></script>
    <script>
        // Reload when back button is pressed
        window.addEventListener("pageshow", function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>

</html>
