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
            <table class="table table-bordered table-hover" id="customerTable">
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
  <script>
    $(document).ready(function() {

      var table = $('#customerTable').DataTable({
        "processing": true,
        "ajax": "./ajax/customer.php",
        "columns": [{
            data: 'cID'
          },
          {
            data: 'cHouse'
          },
          {
            data: 'cName'
          },
          {
            data: 'cSer'
          },

          {
            data: 'cMoo'
          }
        ],
        select: {
          style: 'single',
          select: true,
          toggleable: false
        }
      });

      $('#customerTable tbody').on('click', 'tr', function(row, data, index) {
        isAdd = false;
        var cID = table.row(this).data()['cID'];
        $.ajax({
          url: 'TabManageCustomer/selectedCustomer.php',
          method: 'POST',
          data: {
            cID: cID
          },
          success: function(data) {
            var json = $.parseJSON(data)
            $('#cID').val(json[0].cID)
            $('#cID').attr("disabled", true);
            $('#cName').val(json[0].cName)
            $('#cName').attr("disabled", false);
            $('#cSer').val(json[0].cSer)
            $('#cSer').attr("disabled", false);
            $('#cHouse').val(json[0].cHouse)
            $('#cHouse').attr("disabled", false);
            $('#cMoo').val(json[0].cMoo)
            $('#cMoo').attr("disabled", false);
            console.log(json[0].cIsMem)
            if (json[0].cIsMem == "1") {
              $('#cMem').prop("checked", true);
            } else if (json[0].cIsMem == "2") {
              $('#cNotMem').prop("checked", true);
            } else if (json[0].cIsMem == "3") {
              $('#cNotMoo').prop("checked", true);
            }

            $('#cSave').attr("disabled", false);
            $('#cDel').attr("disabled", false);
            $('#cMem').attr("disabled", false);
            $('#cNotMem').attr("disabled", false);
            $('#cNotMoo').attr("disabled", false);

          }
        })
      });

      //add onclick
      $('#cAdd').click(function(event) {
        {
          event.preventDefault();
          var newID = "";
          table.row('.selected').deselect()
          $('#cID').val("")
          $('#cName').val("")
          $('#cSer').val("")
          $('#cHouse').val("")
          $('#cMoo').val("")
          $('#cMem').prop("checked", true);

          $.ajax({
            url: "./TabManageCustomer/manageCustomer.php",
            method: "POST",
            data: {
              mode: "getNewID"
            },
            success: function(data) {
              newID = data;
              $('#cID').val(newID)
              $('#cName').focus()
              $('#cName').val("")
              $('#cSer').val("")
              $('#cHouse').val("")
              $('#cMoo').val("")
              $('#cMem').prop("checked", true);
            }
          });


        }
      });

      //save onclick
      $('#cSave').click(function(event) {
        event.preventDefault();


        let cID = $('#cID').val()
        let cName = $('#cName').val()
        let cSer = $('#cSer').val()
        let cHouse = $('#cHouse').val()
        let cMoo = $('#cMoo').val()
        let cIsMem = 0;
        if ($('#cMem').prop("checked")) {
          cIsMem = $('#cMem').val()
        } else if ($('#cNotMem').prop("checked")) {
          cIsMem = $('#cNotMem').val()
        } else if ($('#cNotMoo').prop("checked")) {
          cIsMem = $('#cNotMoo').val()
        }
        

        let data = {
          cID: cID,
          cName: cName,
          cSer: cSer,
          cHouse: cHouse,
          cMoo: cMoo,
          cIsMem: cIsMem
        }

        editCustomer(data)

      })

      //save onclick
      $('#cDel').click(function(event) {
        event.preventDefault();
        let cID = $('#cID').val()

        deleteCustomer(cID)

      })


    });

    function editCustomer(data) {
      if (data.cID == '' || data.cName == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
      } else {

        $.ajax({
          url: "./TabManageCustomer/manageCustomer.php",
          method: "POST",
          data: {
            mode: "edit",
            cID: data.cID,
            cName: data.cName,
            cSer: data.cSer,
            cHouse: data.cHouse,
            cMoo: data.cMoo,
            cIsMem: data.cIsMem

          },
          success: function(data) {
            console.log(data);
            if (data.trim() == "success") {
              alert("บันทึกการแก้ไขเรียบร้อย");

              $('#customerTable').DataTable().ajax.reload(null, false);

              $('#pSave').attr("disabled", true);
              $('#pDel').attr("disabled", true);


            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("บันทึกการแก้ไขสินค้าไม่สำเร็จ");
            }

          }
        });
      }


    }

    function deleteCustomer(cID) {
      if (confirm("ยืนยันลบรายชื่อลูกค้า")) {
        $.ajax({
          url: "./TabManageCustomer/manageCustomer.php",
          method: "POST",
          data: {
            mode: "del",
            cID: cID
          },
          success: function(data) {
            console.log(data);
            if (data.trim() == "success") {
              alert("ลบรายชื่อลูกค้าเรียบร้อย");

              $('#customerTable').DataTable().ajax.reload(null, false);

              $('#pDel').attr("disabled", true);
              $('#pSave').attr("disabled", true);

            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("ลบรายชื่อลูกค้าไม่สำเร็จ");
            }

          }
        });
      }

    }
  </script>

</body>