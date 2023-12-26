<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password Form</title>
    <?php include("head_style.php") ?>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body p-4 p-sm-5">
                        <h4 class="text-center mb-5 text-uppercase">Reset Password</h4>
                        <form method="POST" action="insert.php">
                            <div class="mb-3">
                                <label for="Password" class="form-label">
                                    <i class="bi bi-envelope-at-fill"></i> E-mail <span class="msg" id="email_msg"></span>
                                </label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" pattern=".{8,}" title="Password must be at least 8 characters long" required>
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
                                    <i class="bi bi-lock-fill"></i>New Password <small id="passwordMatchStatus1"></small>
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
                                    <i class="bi bi-lock-fill"></i>New Confirm Password <small id="passwordMatchStatus2"></small>
                                </label>
                                <input type="password" id="Confirm_password" name="cpassword" class="form-control" placeholder="Enter Confirm Password" aria-describedby="passwordHelpBlock" pattern=".{8,}" title="Password must be at least 8 characters long" maxlength="8" required>
                                <div id="passwordHelpBlock" class="form-text">
                                    <p class="form-text text-muted">
                                        Password must be at least 8 characters long
                                    </p>
                                </div>
                            </div>
                            <div class="py-3 text-center ">
                                <button type="submit" class="btn btn-success text-uppercase" name="resetpassword" id="resetButton">
                                    <i class="bi bi-send-fill me-2"></i>Reset Password
                                </button>
                                <button type="reset" class="btn btn-danger text-uppercase" id="reset-msg">
                                    <i class="bi bi-arrow-clockwise me-2 "></i>reset
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("script.php") ?>

    <script>
        let email_check = false; // Initialize the email_check variable

        document.querySelector("#email").addEventListener("change", function(event) {
            $.post('check_forgotpassword.php', {
                email: $("#email").val()
            }, function(data) {
                if (data == 0) {
                    document.querySelector("#email_msg").innerHTML = "<span style='color: red;'>Email is not found</span>";
                    email_check = false;
                } else {
                    document.querySelector("#email_msg").innerHTML = "<span style='color: green;'>Email is found</span>";
                    email_check = true;
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
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

            document.getElementById("resetButton").addEventListener("click", function() {
                var emailInputValue = document.getElementById("email").value; // Corrected variable name
                var phoneInputValue = document.getElementById("phone").value;
                var passwordInputValue = document.getElementById("password").value;
                var confirmpasswordInputValue = document.getElementById("password").value;

                if (emailInputValue.trim() !== "" && phoneInputValue.trim() !== "" && email_check) {} else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Please enter a valid email address or Phone Number, or Email is not found"
                    });
                }
            });
            document.querySelector("#reset-msg").addEventListener("click", function(event) {
                document.querySelector("#email_msg").innerHTML = "";
                document.querySelector("#phoneStatus").innerHTML = "";
                document.querySelector("#passwordMatchStatus1").innerHTML = "";
                document.querySelector("#passwordMatchStatus2").innerHTML = "";
            });

        });
    </script>



</body>


</html>