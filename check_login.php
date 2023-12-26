<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0"></script>
<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $check_data = $conn->prepare("SELECT * FROM member WHERE username = :username AND password = :password");
    $check_data->bindParam(":username", $username);
    $check_data->bindParam(":password", $password);
    $check_data->execute();
    $row = $check_data->fetch(PDO::FETCH_ASSOC);

    if ($check_data->rowCount() > 0) {
        echo "login success";
        $_SESSION['user'] = $row['username'];
        $_SESSION['usertype'] = $row['usertype'];
        if ($_SESSION['usertype'] == 1) {
?>
            <script>
                // SweetAlert2 for success
                Swal.fire({
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ',
                    text: 'กรุณารอสักครู่....',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "admin_index.php";
                });
            </script>
        <?php
        }
        if ($_SESSION['usertype'] == 2) {
        ?>
            <script>
                // SweetAlert2 for success
                Swal.fire({
                    icon: 'success',
                    title: 'เข้าสู่ระบบสำเร็จ',
                    text: 'กรุณารอสักครู่....',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "user_index.php";
                });
            </script>
        <?php
        }
        ?>
    <?php
    } else {
        echo "login failed";
    ?>
        <script>
            // SweetAlert2 for error
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง!!',
                timer: 2000,
                showConfirmButton: true
            }).then(() => {
                window.location.href = "index.php";
            });
        </script>
<?php
    }
}
?>