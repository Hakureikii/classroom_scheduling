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
    <style>
        /* Keep sidebar fixed like admin layout */
        body {
            overflow-x: hidden;
        }

        /* Uniform cell sizing */
        table.fixed-table {
            table-layout: fixed;
            width: 100%;
        }

        table.fixed-table th,
        table.fixed-table td {
            text-align: left;
            vertical-align: middle;
            word-wrap: break-word;
        }

        table.fixed-table th {
            background-color: #212529;
            color: #fff;
        }

        /* Match admin layout spacing (small padding on sides) */
        .content-wrapper {
            padding: 2rem 2rem; /* only a bit of space on sides */
        }
    </style>
</head>

<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar (Fixed) -->
        <div class="bg-dark text-white p-3 position-fixed" style="width:250px; height:100vh; left:0; top:0;">
            <h4 class="fw-bold">ICAS</h4>
            <hr class="border-light">
            <h6 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h6>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="student_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="student_courses.php" class="nav-link text-white">📚 My Courses</a></li>
                <li class="nav-item"><a href="student_schedules.php" class="nav-link text-white active">🗓️ My Schedules</a></li>
                <li class="nav-item"><a href="student_classroom.php" class="nav-link text-white">🏛️ Classrooms</a></li>
            </ul>
            <hr class="border-light">
            <a href="../../auth/php/logout.php" class="btn btn-outline-light w-100">🚪 Logout</a>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 d-flex flex-column" style="margin-left:250px;">
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
            <div class="content-wrapper">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold">Schedules</h5>
                    <div class="d-flex align-items-center">
                        Select Day:
                        <select name="" id="select_day" class="ms-2 me-2 form-select-sm">
                            <option value=""> - Select Day -</option>
                            <option value=""> Monday </option>
                            <option value=""> - Select Day -</option>
                            <option value=""> - Select Day -</option>
                            <option value=""> - Select Day -</option>
                            <option value=""> - Select Day -</option>
                            <option value=""> - Select Day -</option>
                        </select>
                    </div>
                </div>

                <!-- Schedule Table -->
                <div class="table-responsive mt-3">
                    <table class="table table-bordered table-hover align-middle fixed-table">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No.</th>
                                <th style="width: 10%;">Day</th>
                                <th style="width: 10%;">Room No.</th>
                                <th style="width: 15%;">Year & Section</th>
                                <th style="width: 20%;">Course</th>
                                <th style="width: 20%;">Instructor</th>
                                <th style="width: 10%;">Time Start</th>
                                <th style="width: 10%;">Time End</th>
                            </tr>
                        </thead>
                        <tbody id="student_schedule_table"></tbody>
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
    fetch_students_schedules();

    // Reload when back button is pressed
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>
