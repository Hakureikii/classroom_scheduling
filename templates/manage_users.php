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
    <title>ICAS - Manage Users</title>
    <link rel="stylesheet" href="../styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="icon" href="../assets/icons/web-icon.png" type="image/x-icon">
</head>

<body class="bg-light">
    <div class="d-flex">

        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width:265px; height:100vh;">
            <h4 class="fw-bold">ICAS</h4>
            <hr class="border-light">
            <h1 class="text-uppercase text-white small fw-bold mb-3">☰ Menu</h1>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link text-white">🏠 Dashboard</a></li>
                <li class="nav-item"><a href="manage_users.php" class="nav-link text-white active">👤 Manage Users</a>
                </li>
                <li class="nav-item"><a href="manage_sections.php" class="nav-link text-white">👥 Manage Sections</a>
                </li>
                <li class="nav-item"><a href="teaching_assignments.php" class="nav-link text-white">⚙️ Teaching
                        Assignments</a></li>
                <li class="nav-item"><a href="manage_courses.php" class="nav-link text-white">📖 Manage Courses</a></li>
                <li class="nav-item"><a href="manage_schedules.php" class="nav-link text-white">🗓️ Manage Schedules</a>
                </li>
                <li class="nav-item"><a href="classroom.php" class="nav-link text-white">🏛️ Classrooms</a>
                </li>
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
                    <h5 class="fw-bold">Users</h5>
                    <div class="d-flex">
                        Select Users:
                        <select name="" id="select_users" class="ms-2 me-2 form-select-sm">
                            <option value="Students"> Students </option>
                            <option value="Instructors"> Instructors </option>
                            <option value="Admin"> Admin </option>
                        </select>

                        <!-- Open Modal Button -->
                        <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#addUsersModal">✙Add
                            Users</button>
                    </div>
                </div>

                <!-- Users Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No.</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Email/Username</th>
                                <th>Password</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="user_table"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Add Users Modal -->
    <div class="modal fade" id="addUsersModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="form_add_users">
                        <div class="row g-3">
                            <div class="col-md-12">
                                Role:
                                <select name="" id="role" class="form-select">
                                    <option value="null"> -- Select Role -- </option>
                                    <option value="Student"> Student </option>
                                    <option value="Instructor"> Instructor </option>
                                    <option value="Admin"> Admin </option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                First Name: <input type="text" placeholder="First Name" id="first_name"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                Middle Name: <input type="text" placeholder="Middle Name" id="middle_name"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-4">
                                Last Name: <input type="text" placeholder="Last Name" id="last_name"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                Sex: <select name="" id="sex" class="form-select">
                                    <option value="Male"> Male </option>
                                    <option value="Female"> Female </option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                Section: <select name="" id="section" class="form-select"></select>
                            </div>

                            <div class="col-md-6">
                                Email: <input type="email" placeholder="Email" id="email" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                Password: <input type="password" placeholder="Password" id="password"
                                    class="form-control" required>
                            </div>

                            <div class="col-md-6" id="message">

                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="form_add_users" class="btn btn-primary">Save</button>
                </div>


            </div>
        </div>
    </div>

    <!-- Delete Users Modal -->
    <div class="modal fade" id="deleteUsersModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete User?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-footer">
                    <input type="text" id="user_id" hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="confirm_delete_student" class="btn btn-success">Yes</button>
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
<script src="../crud/js/delete.js"></script>

<script>
    //display initial user data
    fetch_students();

    //if dropdown changes value execute the function
    document.getElementById("select_users").addEventListener("change", display_users);
    document.getElementById("role").addEventListener("change", select_user);

    //select users to display
    function display_users() {
        let user = document.getElementById("select_users").value;
        if (user === "Students") {
            fetch_students();
        } else if (user === "Instructors") {
            fetch_instructors();
        } else {
            fetch_admin();
        }
    }

    function select_user() {
        let user = document.getElementById("role").value;
        if (user === "Student") {
            $("#section").prop("disabled", false);
        } else if (user === "Instructor") {
            $("#section").prop("disabled", true);
        } else if (user === "Admin"){
            $("#section").prop("disabled", true);
        } else {
            $("#section").prop("disabled", false);
            return;
        }
    }


    // section dropdown from DB
    $.get("../crud/php/fetch_sections.php", function (response) {
        const sections = document.getElementById("section");
        let section = JSON.parse(response);
        if (section.length > 0) {
            for (let i = 0; i < section.length; i++) {
                let option = new Option(section[i].section_name, section[i].section_id);
                sections.add(option);
            }
        } else {
            let no_option = new Option("No Assigned Instructors", "null");
            sections.add(no_option);
        }
    });


    //add users to database
    $("#form_add_users").submit(function (e) {

        e.preventDefault();
        let role = $("#role").val().trim();
        let first_name = $("#first_name").val().trim();
        let middle_name = $("#middle_name").val().trim();
        let last_name = $("#last_name").val().trim();
        let sex = $("#sex").val().trim();
        let section = $("#section").val().trim();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();

        add_users(first_name, middle_name, last_name, sex, section, email, password, role);
    })

    // prevent reload using back button after logout
    window.addEventListener("pageshow", function (event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
</script>