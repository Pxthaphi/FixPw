<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.0"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<?php

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


class DBMethod {    
    public function check_tbl($tbl_name) {        
        require("connection.php"); 
        $check = 1; 
        try {
            $result = $conn->query("SELECT 1 FROM {$tbl_name} LIMIT 1");             
        } catch (Exception $e) { 
            $check = 0; 
        }
        return $check;    
    }    
    public function create_member($tbl_name) { 
        require("connection.php"); 
        $statements = [
            "CREATE TABLE ".$tbl_name." ( 
                username VARCHAR(8) NOT NULL,
                password  VARCHAR(8) NOT NULL, 
                phone VARCHAR(50) NULL, 
                email   VARCHAR(100) NULL,
                usertype INT(2) NOT NULL DEFAULT 2,
                PRIMARY KEY(username)
            );"];   
        
        // execute SQL statements
        foreach ($statements as $statement) {            
            $conn->exec($statement);
        }

        $username = "admin";
        $password = "admin123";
        $phone = "0811111122";
        $email = "admin@gmail.com";
        $usertype = 1;

        $sql = $conn->prepare("INSERT INTO {$tbl_name} (username, password, phone, email, usertype) VALUES(:username, :password, :phone, :email, :usertype)");
        $sql->bindParam(":username", $username);
        $sql->bindParam(":password", $password);
        $sql->bindParam(":phone", $phone);
        $sql->bindParam(":email", $email);    
        $sql->bindParam(":usertype", $usertype);        
        $sql->execute();
    }
}

// Make sure session is started
session_start();

if (isset($_POST['insert_user'])) {
    require("connection.php");
    $tbl_name = 'member';
    $db = new DBMethod();
    $check_tbl = $db->check_tbl($tbl_name);
    if (!$check_tbl) {
        $db->create_member($tbl_name);
    }
    if (
        isset($_POST['username'])  && isset($_POST['password']) &&
        isset($_POST['cpassword']) && isset($_POST['phone']) &&
        isset($_POST['email'])
    ) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $usertype = 2;

        // Prepare the SQL statement with placeholders
        $sql = "INSERT INTO $tbl_name (`username`, `password`, `phone`, `email`, `usertype`) VALUES (:username, :password, :phone, :email, :usertype)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(":usertype", $usertype);   
        // Execute the statement
        $stmtExec = $stmt->execute();

        echo("success");

        if ($stmtExec) {
            $_SESSION['success'] = "เพิ่มข้อมูลเรียบร้อยแล้ว";
?>

            <script>
                // SweetAlert2 for success
                console.log('Success alert triggered');
                Swal.fire({
                    icon: 'success',
                    title: 'สำเร็จ',
                    text: 'เพิ่มข้อมูลเรียบร้อยแล้ว',
                    timer: 2000,
                    showConfirmButton: true
                }).then(() => {
                    window.location.href = "index.php";
                });
            </script>
        <?php
        } else {
            $_SESSION['error'] = "เพิ่มข้อมูลไม่สำเร็จ";
        ?>
            <script>
                // SweetAlert2 for error
                console.log('Failed alert triggered');
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: 'เพิ่มข้อมูลไม่สำเร็จ',
                    timer: 2000,
                    showConfirmButton: true
                }).then(() => {
                    window.location.href = "register.php";
                });
            </script>
<?php
        }
    }
}


if (isset($_POST['resetpassword'])) {  
    require("connection.php");
    $tbl_name = 'member';    
    if (isset($_POST['phone'])  && isset($_POST['password']) &&
        isset($_POST['cpassword'])) {
            $phone = $_POST['phone'];
            $password = $_POST['password'];
             
            $sql = $conn->prepare("UPDATE {$tbl_name} SET password = :password WHERE phone = :phone");
            $sql->bindParam(":password", $password);
            $sql->bindParam(":phone", $phone);    
            $sql->execute();

            if ($sql) {
                $_SESSION['success'] = "ตั้งค่ารหัสผ่านสำเร็จ";
                echo "<script>
                        setTimeout(function() {
                            Swal.fire ({
                                icon: 'success',
                                title: 'สำเร็จ',
                                text: 'ตั้งค่ารหัสผ่านสำเร็จ',
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }, 500);
                    </script>";
                header("refresh:2; url=index.php");
            } else {
                $_SESSION['error'] = "ตั้งค่ารหัสผ่านไม่สำเร็จ";
                echo "<script>
                        setTimeout(function() {
                            Swal.fire ({
                                icon: error',
                                title: 'เกิดข้อผิดพลาด',
                                text: 'ตั้งค่ารหัสผ่านไม่สำเร็จ',
                                timer: 2000,
                                showConfirmButton: true
                            });
                        });
                    </script>";
                header("refresh:2; url=forgotpassword.php");
            }
    }
}
?>