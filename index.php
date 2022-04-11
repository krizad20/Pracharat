<?php
// session_start();
include("./system\header.php");

//check login
if (isset($_SESSION['seller'])) {
    echo "<script>window.location.href='TabSale.php';</script>";
} 
?>



<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">เพิ่มผู้ขาย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="login.php" method="post">
                    <div class="form-group">
                        <label for="username">ชื่อผู้ขาย</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="password">รหัสผ่าน</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="password">ยืนยันรหัสผ่าน</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password">
                    </div>
                    <div class="form-group">
                        <label for="permission">Permission</label>
                        <select class="form-control" id="permission" name="permission">
                            <option value="1">Admin</option>
                            <option value="2">Seller</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- login page -->
<div class="container-sm">
    <div class="row position-absolute top-50 start-50 translate-middle">
        <div class="col">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">เข้าสู่ระบบ</h3>
                </div>
                <div class="panel-body">
                    <form action="login.php" method="post">
                        <div class="form-group">
                            <input class="form-control" placeholder="ชื่อผู้ขาย" name="username" autofocus>
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="รหัสผ่าน" name="password" type="password" value="">
                        </div>
                        <!-- register -->
                        <div class="form-group">
                            <a href="" class="btn btn-lg btn-success btn-block" data-bs-toggle="modal" data-bs-target="#registerModal">สมัครสมาชิก</a>
                        </div>
                        <button type="submit" class="btn btn-lg btn-success btn-block" name="login">เข้าสู่ระบบ</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
