<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <?php include("head_style.php")?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h4 class="text-center mb-5 text-uppercase">Sign In</h4>
                        <form method="POST" action="check_login.php">
                            <div class="mb-3">
                                <label for="Username" class="form-label">
                                    <i class="bi bi-person-fill"></i> Username
                                </label>
                                <input type="text" class="form-control" name="username" id="Username" placeholder="Enter Username" pattern="[a-zA-Z0-9]+" title="Only alphanumeric characters are allowed" required>
                            </div>

                            <div class="mb-3">
                                <label for="Password" class="form-label">
                                    <i class="bi bi-lock-fill"></i> Password
                                </label>
                                <input type="password" class="form-control" name="password" id="Password" placeholder="Enter Password" pattern=".{8,}" title="Password must be at least 8 characters long" maxlength="8" required>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-end">
                                    <!-- Simple link -->
                                    <a href="forgotpassword.php" class="text-right">Forgot password?</a>
                                </div>
                            </div>


                            <div class="d-grid py-3">
                                <button type="submit" name="login" class="btn btn-success text-uppercase">
                                    <i class="bi bi-unlock-fill me-3"></i>Sign in
                                </button>
                            </div>
                            <div class="d-grid py-2">
                                <a href="register.php" class="btn btn-pink text-uppercase fw-bold" type="button">
                                    <i class="bi bi-person-fill-add me-3"></i>Sign up
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("script.php")?>
</body>


</html>