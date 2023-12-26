<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <?php include("head_style.php") ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h4 class="text-center mb-5 text-uppercase">Sign Up</h4>
                        <form id="registrationForm" action="insert.php" method="POST">
                            <div class="mb-3">
                                <label for="Username" class="form-label">
                                    <i class="bi bi-person-fill">
                                    </i> Username <span class="msg" id="username_msg" style="color: red;"></span>
                                </label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" pattern="[a-zA-Z0-9]+" title="Only alphanumeric characters are allowed" maxlength="8" required>
                            </div>

                            <div class="mb-3">
                                <label for="Password" class="form-label">
                                    <i class="bi bi-lock-fill"></i> Password <small id="passwordMatchStatus1"></small>
                                </label>
                                <input type="password" id="Password" name="password" class="form-control" placeholder="Enter Password" aria-describedby="passwordHelpBlock" pattern=".{8,}" title="Password must be at least 8 characters long" maxlength="8" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    <p class="form-text text-muted">
                                        Password must be at least 8 characters long
                                    </p>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="Confirm_password" class="form-label">
                                    <i class="bi bi-lock-fill"></i> Confirm Password <small id="passwordMatchStatus2"></small>
                                </label>
                                <input type="password" id="Confirm_password" name="cpassword" class="form-control" placeholder="Enter Confirm Password" aria-describedby="passwordHelpBlock" pattern=".{8,}" title="Password must be at least 8 characters long" maxlength="8" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    <p class="form-text text-muted">
                                        Password must be at least 8 characters long
                                    </p>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">
                                    <i class="bi bi-telephone-fill"></i> Telephone <small id="phoneStatus"></small>
                                </label>
                                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter PhoneNumber" pattern="[0-9]{10}" title="Phone Number must be exactly 10 digits" maxlength="10" required>
                                <div id="phoneHelpBlock" class="form-text">
                                    <p class="form-text text-muted">
                                        Phone Number must be exactly 10 digits
                                    </p>
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="Password" class="form-label">
                                    <i class="bi bi-envelope-at-fill"></i> E-mail
                                </label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" pattern=".{8,}" title="Password must be at least 8 characters long" required>
                            </div>

                            <div class="py-3 text-center">
                                <button type="submit" class="btn btn-success text-uppercase" name="insert_user">
                                    <i class="bi bi-send-fill me-2"></i>Submit
                                </button>
                                <button type="reset" class="btn btn-danger text-uppercase">
                                    <i class="bi bi-arrow-clockwise me-2 "></i>reset
                                </button>
                            </div>
                            <div class="d-grid py-2">
                                <p class="text-center text-muted mt-2 mb-0">Have already an account? <a href="index.php"><u>Login here</u></a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("script.php") ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>

    <script>
        document.querySelector("#username").addEventListener("change", function(event) {
            $.post('check_username.php', {
                username: $("#username").val()
            }, function(data) {
                if (data == 1) {
                    document.querySelector("#username_msg").innerHTML = "*Duplicated username";
                    username_check = false;
                } else {
                    document.querySelector("#username_msg").innerHTML = "";
                    username_check = true;
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('Password');
            const confirmPasswordInput = document.getElementById('Confirm_password');
            const passwordMatchStatus1 = document.getElementById('passwordMatchStatus1');
            const passwordMatchStatus2 = document.getElementById('passwordMatchStatus2');
            const phoneInput = document.getElementById('phone');
            const phoneStatus = document.getElementById('phoneStatus');

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (password === '' && confirmPassword === '') {
                    passwordMatchStatus1.textContent = '** Passwords are empty!!';
                    passwordMatchStatus1.style.color = 'red';
                    passwordMatchStatus2.textContent = '** Passwords are empty!!';
                    passwordMatchStatus2.style.color = 'red';
                } else if (password === confirmPassword) {
                    passwordMatchStatus1.textContent = 'Passwords match';
                    passwordMatchStatus1.style.color = 'green';
                    passwordMatchStatus2.textContent = 'Passwords match';
                    passwordMatchStatus2.style.color = 'green';
                } else {
                    passwordMatchStatus1.textContent = '** Passwords do not match!!';
                    passwordMatchStatus1.style.color = 'red';
                    passwordMatchStatus2.textContent = '** Passwords do not match!!';
                    passwordMatchStatus2.style.color = 'red';
                }
            }

            function checkPhoneNumber() {
                const phonePattern = /^(0(2|3|4|5|7|8|9)(\d{8})|0([6])(\d{8}))$/;
                const phoneNumber = phoneInput.value;
                const phoneStatus = document.getElementById('phoneStatus');

                if (!phoneNumber.trim()) {
                    phoneStatus.textContent = 'กรุณากรอกเบอร์โทรศัพท์!!';
                    phoneStatus.style.color = 'red';
                    return false; // ไม่ส่งข้อมูลเมื่อเบอร์โทรศัพท์ว่าง
                }
                if (!phonePattern.test(phoneNumber)) {
                    phoneStatus.textContent = 'กรุณากรอกหมายเลขโทรศัพท์ให้ถูกต้อง!';
                    phoneStatus.style.color = 'red';
                    return false; // ไม่ส่งข้อมูลหากหมายเลขโทรศัพท์ไม่ตรงกับเงื่อนไข
                } else {
                    phoneStatus.textContent = 'หมายเลขโทรศัพท์ถูกต้อง';
                    phoneStatus.style.color = 'green';
                    return true; // ส่งข้อมูลเมื่อหมายเลขโทรศัพท์ตรงกับเงื่อนไข
                }
            }

            passwordInput.addEventListener('input', checkPasswordMatch);
            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
            phoneInput.addEventListener('input', checkPhoneNumber);
        });
    </script>
</body>

</html>