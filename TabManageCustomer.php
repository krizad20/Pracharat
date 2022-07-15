<?php
include("./system/header.php");
if (!isset($_SESSION['seller']) || $_SESSION['permission'] == "2") {
  echo "<script>window.location.href='index.php';</script>";
}
?>

<body>

  <div class="container-fluid mt-3">

    <!-- Customer -->
    <div class="row">
      <!-- Detail -->
      <div class="col-3">
        <div class="card">
          <div class="card-body">
            <h3>
              <center>ข้อมูลลูกค้า</center>
            </h3>
            <form method='post'>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">รหัสลูกค้า</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="text" autocomplete="off" name="cID" id="cID" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">ชื่อ</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="text" autocomplete="off" name="cName" id="cName" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">นามสกุล</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="text" autocomplete="off" name="cSer" id="cSer" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">บ้านเลขที่</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="float" autocomplete="off" name="cHouse" id="cHouse" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">หมู่ที่</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="float" autocomplete="off" name="cMoo" id="cMoo" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row mt-3">
                <label class="col-form-label" style="width: 30%;">การเป็นสมาชิก</label>
                <div class="col" style="width: 70%;">
                  <div class="form-check">
                    <input class="form-check-input MemStatus" value="1" type="radio" name="flexRadioDefault" id="cMem" disabled checked>
                    <label class="form-check-label" for="cMem">
                      เป็นสมาชิกซื้อหุ้น
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input MemStatus" value="2" type="radio" name="flexRadioDefault" id="cNotMem" disabled>
                    <label class="form-check-label" for="cNotMem">
                      ไม่เป็นสมาชิกซื้อหุ้น
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input MemStatus" value="3" type="radio" name="flexRadioDefault" id="cNotMoo" disabled>
                    <label class="form-check-label" for="cNotMoo">
                      สมาชิกนอกหมู่บ้าน
                    </label>
                  </div>
                </div>

              </div>

              <div class="mt-3 row">
                <button class="col btn btn-primary mx-3" id="cAdd">เพิ่มลูกค้า</button>
                <button class="col btn btn-success mx-3" id="cSave" disabled>บันทึก</button>
                <button class="col btn btn-danger mx-3" id="cDel" disabled>ลบ</button>

              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Table -->
      <div class="col-9">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <table class="table table-bordered table-hover nowrap" id="customerTable">
                  <thead>
                    <tr>
                      <th scope="col">รหัสลูกค้า</th>
                      <th scope="col">บ้านเลขที่</th>
                      <th scope="col">ชื่อ</th>
                      <th scope="col">นามสกุล</th>
                      <th scope="col">หมู่ที่</th>
                    </tr>
                  </thead>
                  <tbody>
                </table>
              </div>
            </div>

          </div>
        </div>


      </div>
    </div>


  </div>
  <script src="./TabManageCustomer/TabManageCustomer.js"></script>



</body>