<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User-Index</title>
    <?php include("head_style.php") ?>
    <style>

    </style>
</head>

<body>
    <?php include 'topmenu.php'; ?>
    <div class="container">
        <div class="row ">
            <div class=" col-lg-6 mx-auto">
                <div class="card border-0 shadow rounded-3 my-5">
                    <div class="card-body">
                        <h5 class=" text-center">แจ้งรายละเอียดการซ่อม</h5>
                        <form id="fix_form" action="../db/insert_fix.php" method="POST">
                            <div class="mb-3 my-4">
                                <i class="fa fa-laptop"><label for="fixname" class="px-2">เลือกอุปกรณ์ที่ต้องการซ่อม</label>
                                    <span class="msg" id="count_msg"></span></i>
                            </div>
                            <div class="mb-3" style=" margin-left: 30px;">
                                <table>
                                    <tr style="height: 40px;">
                                        <td style="width: 30%;">
                                            <input class="form-check-input" type="checkbox" name="checkname[]" value="เครื่องคอมพิวเตอร์">
                                            <label class="form-check-label" for="checkmodel[]">เครื่องคอมพิวเตอร์
                                        </td>
                                        <td>
                                            <input type="text" size="45" name="checkmodel[]" placeholder="ป้อนข้อมูลชื่อยี่ห้อและรุ่น">
                                        </td>
                                    </tr>
                            </div>
                            <div class="mb-3" style=" margin-left: 30px;">
                                <tr style="height: 50px;">
                                    <td>
                                        <input class="form-check-input" type="checkbox" name="checkmodel[]" value="เครื่องพิมพ์">
                                        <label class="form-check-label" for="checkmodel">เครื่องพิมพ์
                                    </td>
                                    <td>
                                        <input type="text" size="45" name="printer_name" placeholder="ป้อนข้อมูลชื่อยี่ห้อและรุ่น">
                                    </td>
                                </tr>
                                </table>
                            </div>
                            <div class="mb-3">
                                <i class="fa fa-pencil"><label for="detail" class="px-2">รายละเอียดเพิ่มเติม</label></i>
                            </div>
                            <div class="mb-3" style=" margin-left: 30px;">
                                <textarea placeholder="ป้อนข้อมูลรายละเอียดเพิ่มเติม" rows=3 cols=70 id="detail" name="detail"></textarea>
                            </div>
                            <div class=" text-center">
                                <button type="submit" id="btn-login" class="btn btn-primary" name="insert-fix">
                                    <i class="fa fa-check me-1"></i>ยืนยัน</button>
                                <button type="reset" class="btn btn-danger">
                                    <i class="fa fa-refresh px-1"></i>ยกเลิก</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("#fix_form").addEventListener("submit", function(evt) {
            let count = document.querySelectorAll('input[type="checkbox"]:checked').length;
            if (count == 0) {
                document.getElementById("count_msg").innerHTML = "*เลือกอย่างน้อย 1 รายการ";
                event.preventDefault();
            } else {
                document.getElementById("count_msg").innerHTML = "";
                if (document.querySelector("#detail").value == "") {
                    document.getElementById("count_msg").innerHTML = "*detail";
                    event.preventDefault();
                } else {
                    document.getElementById("count_msg").innerHTML = "";
                }
            }
        });
    </script>
    <?php include("script.php") ?>
</body>

</html>