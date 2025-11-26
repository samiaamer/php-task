<?php require("classes/register.class.php");

if (isset($_POST['submit'])) {
    $user = new RegisterUser($_POST['username'], $_POST['password'], $_POST['country'], $_POST['email']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>signup</title>
    <link rel="stylesheet" href="styles/style1.css" />
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="control-label" for="username">Name:</label>
                            <input
                                id="username"
                                name="username"
                                class="username form-control"
                                type="text"
                                placeholder="username"
                                required
                                autocomplete="name" />

                            <label class="control-label" for="password"> Password: </label>
                            <input
                                id="password"
                                name="password"
                                class="password form-control"
                                type="password"
                                placeholder="Password"
                                required
                                autocomplete="new-password" />
                        </div>

                        <label class="control-label" for="country">Country:</label>
                        <select
                            id="country"
                            name="country"
                            class="country"
                            style="width: 70%; height: 25px"
                            autocomplete="country"
                            required>
                            <option>country</option>
                            <option>jordan</option>
                            <option>ksa</option>
                            <option>qatar</option>
                            <option>egypt</option>
                        </select>
                </div>
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input
                        id="email"
                        name="email"
                        class="email form-control"
                        type="email"
                        placeholder="email"
                        required
                        autocomplete="email" />
                </div>
                <div class="form-group">
                    <label class="control-label">Language:
                        <label><input
                                name="checkbox"
                                type="checkbox"
                                id="english"
                                value="english" />
                            English</label>
                        <label>
                            <input
                                name="checkbox"
                                type="checkbox"
                                id="nonEnglish"
                                value="nonEnglish" />
                            Non English</label>
                    </label>
                </div>

                <div class="invalid_feedback"><?php echo @$user->invalid_feedback ?></div>
                <div class="valid_feedback"><?php echo @$user->valid_feedback ?></div>

                <button
                    class="btn btn-primary"
                    name="submit"
                    type="submit"
                    value="submit">
                    Signup
                </button>
                </form>or<a href="login.php"><button style="border: #686767;">login</button></a>

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