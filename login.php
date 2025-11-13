<?php
session_start();
$nameErr = $emailErr = $passErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["email"])) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

        $password = $_POST["password"];

        $validUsername = "person1";
        $validEmail = "person1@ex.com";
        $validPasswordHash = password_hash("1234", PASSWORD_DEFAULT);

        if ($username == $validUsername && password_verify($password, $validPasswordHash) && $email == $validEmail) {

            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            $_SESSION["email"] = $email;
            header("Location: index.php");
        } else {
            if ($username == $validUsername)
                $nameErr = "check uername";
            elseif (!password_verify($password, $validPasswordHash))
                $passErr = "check password";
            elseif ($email == $validEmail)
                $emailErr = "check email";
        }

    } elseif (empty($_POST["username"]) || empty($_POST["password"]) || empty($_POST["email"])) {

        if (empty($_POST["username"]))
            $nameErr = "Name is required";

        elseif (empty($_POST["email"]))
            $emailErr = "Email is required";

        elseif (empty($_POST["password"]))
            $passErr = "password is required";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>login</title>
    <link rel="stylesheet" href="style.css" />
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
                    <form id="loginForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" onsubmit="return usersinfo()" >
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
                        <input name="login" type="submit" class="btn btn-primary" value="Login"> or <button>Sign up</button>
                    </form>
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