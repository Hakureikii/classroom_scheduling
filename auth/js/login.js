function login(email, password, role) {
    let empty = "";
    let email_clear = $("#email").val(empty);
    let password_clear = $("#password").val(empty);

    if (!role) {
        alert("Select a role!");
    } else {
        //student login
        if (role === "student") {
            $.post("auth/php/studentlogin.php",
                {
                    email: email,
                    password: password,

                },
                function (response) {
                    if (response === "err") {
                        email_clear;
                        password_clear;
                        let err = document.getElementById("error-message");
                        err.innerHTML = '<p class="text-danger fs-6 fw-light"> Invalid email or password!<p>';
                    } else {
                        window.location.href = "templates/students/student_dashboard.php";
                    };
                })
            //instructor login
        } else {
            $.post("auth/php/instructorlogin.php",
                {
                    email: email,
                    password: password,

                },
                function (response) {
                    if (response === "err") {
                        email_clear;
                        password_clear;
                        let err = document.getElementById("error-message");
                        err.innerHTML = '<p class="text-danger fs-6 fw-light"> Invalid email or password!<p>';
                    } else {
                        window.location.href = "templates/instructors/instructor_dashboard.php";
                    };
                })
        }
    }
}

//admin login
function admin(username, password) {
    let empty = "";
    let user_clear = $("#username").val(empty);
    let password_clear = $("#password").val(empty);

    $.post("php/admin_login.php",
        {
            username: username,
            password: password,
        },
        function (response) {
            if (response === "err") {
                user_clear;
                password_clear;
                let err = document.getElementById("error-message");
                err.innerHTML = '<p class="text-danger fs-6 fw-light"> Invalid username or password!<p>';
            } else {
                window.location.href = "../templates/admin_dashboard.php";
            };
        })
}