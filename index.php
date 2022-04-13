<?php
// session_start();
include("./system/header.php");

//check login
if (isset($_SESSION['seller'])) {
    echo "<script>window.location.href='TabSale.php';</script>";
}
?>



<!-- Register Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="">เพิ่มผู้ขาย</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">ชื่อผู้ขาย</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อ" required>
                    </div>
                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="รหัสผ่าน" required>
                    </div>
                    <div class="form-group">
                        <label for="password">รหัสยืนยันสมัคร</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="ยืนยันรหัสผ่าน" required>
                    </div>
                    <div class="form-group">
                        <label for="permission">ตำแหน่ง</label>
                        <select class="form-control" id="permission" name="permission" required>
                            <option value="1">ผู้จัดการ</option>
                            <option value="2">พนักงานขาย</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" name="register">ยืนยัน</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- login page -->
<div class="container-sm">
    <div class="row position-absolute top-50 start-50 translate-middle ">
        <div class="col">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title ">เข้าสู่ระบบ</h3>
                </div>
                <div class="panel-body">
                    <form action="login.php" method="post">
                        <div class="form-group mb-3">
                            <input class="form-control" placeholder="ชื่อผู้ขาย" name="username" autofocus>
                        </div>
                        <div class="form-group mb-3">
                            <input class="form-control" placeholder="รหัสผ่าน" name="password" type="password" value="">
                        </div>

                        <button type="submit" class="btn btn-lg btn-success btn-block" name="login">เข้าสู่ระบบ</button>
                        <a class="btn btn-lg btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#registerModal">สมัครสมาชิก</a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>