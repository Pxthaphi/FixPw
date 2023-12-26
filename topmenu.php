<?php

session_start();
$user = $_SESSION['user'];
?>

<style>
    a{
      color: #1B1B1B;  
    }
</style>

<div class="row py-3"></div>
<div class="row px-5 text-center">
    <div class="col-6"></div>
    <div class="col-2">
        <h6 class="py-2 fw-bold"><a href="#">แจ้งซ่อม</a></h6>
    </div>
    <div class="col-2">
        <h6 class="py-2 fw-bold"><a href="#">ตรวจสอบสถานะการซ่อม</a></h6>
    </div>
    <div class="col-2">
        <h6 class="py-2 fw-bold"><a href="logout.php">ออกจากระบบ</a></h6>
    </div>
</div>

<div class="row px-5 text-center">
    <div class="col-10"></div>
    <div class="col-2">
        <h6 style="color:#161616">สวัสดี คุณ <?= $user ?></h6>
    </div>
</div>