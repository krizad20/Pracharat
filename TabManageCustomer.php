<?php
include("system\header.php")
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
                  <input class="col form-control" type="text" autocomplete="chrome-off" name="cID" id="cID" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">ชื่อ</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="text" autocomplete="chrome-off" name="cName" id="cName" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">นามสกุล</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="text" autocomplete="chrome-off" name="cSer" id="cSer" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">บ้านเลขที่</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="float" autocomplete="chrome-off" name="cHouse" id="cHouse" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row">
                <label class="col-form-label" style="width: 30%;">หมู่ที่</label>
                <div class="col" style="width: 70%;">
                  <input class="col form-control" type="float" autocomplete="chrome-off" name="cMoo" id="cMoo" placeholder="" disabled>
                </div>
              </div>

              <div class="mb-1 row mt-3">
                <label class="col-form-label" style="width: 30%;">การเป็นสมาชิก</label>
                <div class="col" style="width: 70%;">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cMem" disabled checked>
                    <label class="form-check-label" for="cMem">
                      เป็นสมาชิก
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="cNotMem" disabled>
                    <label class="form-check-label" for="cNotMem">
                      ไม่เป็นสมาชิก
                    </label>
                  </div>
                </div>

              </div>

              <div class="mt-3 row">
                <button class="col btn btn-primary mx-3" type="" id="cAdd"">เพิ่มลูกค้า</button>
                <button class=" col btn btn-success mx-3" id="cSave" disabled>บันทึก</button>
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
        "ajax": "ajax/customer.php",
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
          url: 'TabMaganeCustomer/selectedCustomer.php',
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
            } else {
              $('#cNotMem').prop("checked", true);
            }

            $('#cSave').attr("disabled", false);
            $('#cMem').attr("disabled", false);
            $('#cNotMem').attr("disabled", false);
          }
        })
      });

      //add onclick
      $('#cAdd').click(function(event) {
        {
          event.preventDefault();


        }
      });

      //save onclick
      $('#cSave').click(function(event) {
        event.preventDefault();
      })



    });
  </script>

</body>