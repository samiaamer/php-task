<?php
require("login.class.php");
?>

<?php

if (isset($_POST['submit'])) {
    $user = new LoginUser($_POST['username'], $_POST['password'], $_POST['email']);
    
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" href="styles/style.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="scripts.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 left-box bg-primary" style="height: auto;">
                <h2>Sign Up</h2>
                <p>
                    Sign up with with your simple details it will be cross checked by the
                    adminstration
                </p>
                <h2>Sign In</h2>
                <p style="padding-bottom: 200px">
                    Sign In with with your username and password
                </p>
            </div>
            <div class="col d-flex align-items-center justify-content-center text-center  loginbox">
                <div class="loginForm">
                    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
                        <label for="username">Name:</label>
                        <input
                            id="username"
                            class="name form-control"
                            name="username"
                            type="text"
                            placeholder="username"
                            required
                            autocomplete="name" />
                        <span id="nameErr" class="error text-danger"></span><br><br>

                        <label for="email">Email:</label>
                        <input
                            id="email"
                            class="email form-control"
                            name="email"
                            type="email"
                            placeholder="email"
                            required
                            autocomplete="email" />
                        <span id="emailErr" class="error text-danger"></span><br><br>

                        <label for="password"> Password: </label>
                        <input
                            id="password"
                            class="pass form-control"
                            name="password"
                            type="password"
                            placeholder="*********"
                            required
                            autocomplete="new-password" />
                        <span id="passErr" class="error text-danger"></span><br><br>

                        <label style="font-size: x-small" for="agree">
                            <input
                                type="checkbox"
                                id="agree"
                                name="agree"
                                value="agree"
                                required
                                style="width: 10px" />
                            I agree with the terms and conditions</label>

                        <div class="invalid-feedback"></div>
                        <div class="valid-feedback"></div>
                        <input name="submit" type="submit" class="btn btn-primary" value="Login">
                    </form> or
                    <a href="signup.php"><button>signup</button></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        const form = document.querySelector("form");

        form.addEventListener("submit", (e) => {
            if (!form.checkValidity()) {
                e.preventDefault();
            }
            form.classList.add("was-validated");
        });
    </script>
</body>

</html>