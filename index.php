<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="icon" href="assets/icons/web-icon.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="background">
    <div class="flex-wrapper">
        <div class="custom-container container col-4 bg-white d-flex flex-column align-items-center">
            <p class="mt-5 mb-3"> LOGIN </p>
            <form id="login" class="form">
                <div>
                    <div class="input-holder d-flex">
                        <div class="icon mt-2 mb-2"> ✉ </div>
                        <input class="form-control mt-2 mb-2" type="email" placeholder="email" id="email" required>
                    </div>

                </div>

                <div>
                    <div class="input-holder d-flex">
                        <div class="icon"> 🔒 </div>
                        <input class="form-control" type="password" placeholder="password" id="password" required>
                    </div>

                </div>

                <div class="mt-3 mb-2">
                    <input type="radio" name="role" id="student" value="student" required>
                    <label for="student"> 🎓Student </label>
                </div>

                <div class="mt-2 mb-2">
                    <input type="radio" name="role" id="instructor" value="instructor" required>
                    <label for="instructor"> 👤Instructor </label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg fw-semibold col-12 mt-2 mb-1"> ➜] Login  </button>
                <a href="" class="text-decoration-none"> 🔑Forgot Password </a>

                <div id="error-message" class="mt-1 mb-5"> </div>
            </form>
        </div>
    </div>

</body>

</html>
<script src="jquery.js"></script>
<script src="auth/js/login.js"></script>
<script>
    $("#login").submit(function (e) {
        e.preventDefault();
        let email = $("#email").val().trim();
        let password = $("#password").val().trim();
        let role = $("input[name='role']:checked").val()
        login(email, password, role);
    })
</script>