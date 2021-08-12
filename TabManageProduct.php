<?php
include("system\header.php")
?>

<body>

  <div class="container-fluid">
    <div class="row">
      <ul class="nav nav-tabs justify-content-center" id="productTypeTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">สินค้าเดี่ยว</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="packed-tab" data-bs-toggle="tab" data-bs-target="#packed" type="button" role="tab" aria-controls="packed" aria-selected="false">สินค้าแพ็ค</button>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <!-- Unpacked Product Tab -->
        <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
          <div class="row">
            <!-- Detail -->
            <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h5>
                    <center>รายละเอียดสินค้า</center>
                  </h5>

                  <form method='post' id="myForm" enctype="multipart/form-data" target="dummyframe">
                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">รหัสสินค้า</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="pID" id="pID" placeholder="" disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">บาร์โค้ดสินค้า</label>
                      <div class="col" style="width: 70%;">
                        <div class="input-group mb-3">
                          <input class="col form-control" type="text" autocomplete="chrome-off" name="pBar" id="pBar" placeholder="" aria-describedby="button-addon2" disabled>
                          <button class="btn btn-outline-secondary" type="button" id="button-addon2">จัดการ</button>
                        </div>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">ชื่อสินค้า</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="pName" id="pName" placeholder="" disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">ราคาซื้อ</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="pBP" id="pBP" placeholder="" disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">ราคาขาย</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="pSP" id="pSP" placeholder="" disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">คงเหลือ</label>
                      <div class="col" style="width: 70%;">
                        <input class="form-control" type="number" autocomplete="chrome-off" name="pVal" id="pVal" placeholder="" disabled>
                      </div>

                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">หมวดหมู่</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" list="pCateDatalist" type="text" autocomplete="chrome-off" name="pCate" id="pCate" placeholder="" disabled>
                        <datalist id="pCateDatalist">
                        </datalist>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 30%;">หน่วยนับ</label>
                      <div class="col" style="width: 70%;">
                        <input class="col form-control" list="pUnitDatalist" type="text" autocomplete="chrome-off" name="pUnit" id="pUnit" placeholder="" disabled>
                        <datalist id="pUnitDatalist">
                        </datalist>
                      </div>
                    </div>

                    <div class="row mb-1 ">
                      <div class="col">
                        <button class="btn btn-primary" type="button" name="managePack" id="managePack" data-bs-toggle="modal" data-bs-target="#managePackModal">จัดการแพ็คสินค้า</button>
                      </div>
                      <div class="col d-flex align-items-center">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="isPacked">
                          <label class="form-check-label" for="isPacked">
                            สินค้าแพ็ค
                          </label>
                        </div>
                      </div>

                    </div>

                    <div class="mb-1 row">
                      <input class="form-control" type="file" name="file" id="formFile">

                      <input type="submit" name="submit" value="Upload" id="subBut" style="display: none;">
                    </div>
                  </form>

                  <div class="mt-3 row">
                    <button class="col btn btn-primary mx-3" name="pAdd" id="pAdd"">เพิ่มสินค้า</button>
                    <button class=" col btn btn-success mx-3" name="pSave" id="pSave" disabled>บันทึก</button>
                    <button class="col btn btn-danger mx-3" name="pDel" id="pDel" disabled>ลบสินค้า</button>
                    <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

                  </div>
                </div>
              </div>
            </div>

            <!-- Table -->
            <div class="col-9">
              <div class="card">
                <div class="card-body">
                  <table class="table table-bordered table-hover" id="productTable" style="width: 100%;">
                    <thead>
                      <tr>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">บาร์โค้ดสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">ราคาขาย</th>
                        <th scope="col">คงเหลือ</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Packed Product Tab -->
        <div class="tab-pane fade" id="packed" role="tabpanel" aria-labelledby="packed-tab">
          <div class="row">
            <!-- Detail -->
            <div class="col-3">
              <div class="card">
                <div class="card-body">
                  <h3>
                    <center>รายละเอียดสินค้า</center>
                  </h3>
                  <form method='post'>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">รหัสสินค้าแพ็ค</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paID" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">บาร์โค้ดสินค้าแพ็ค</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paBar" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">บาร์โค้ดสินค้าในแพ็ค</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paSubBar" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">ชื่อสินค้า</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paName" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">จำนวนชิ้นต่อแพ็ค</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="paPerPacked" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อชิ้น</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="paBPerOne" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อแพ็ต</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="paBPerPack" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">ราคาขายต่อแพ็ค</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="float" autocomplete="chrome-off" name="paSP" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">คงเหลือรายชิ้น</label>
                      <div class="col" style="width: 60%;">
                        <input class="form-control" type="number" autocomplete="chrome-off" name="paPdVal" placeholder="">
                      </div>

                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">หมวดหมู่</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paate" placeholder="">
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-form-label" style="width: 40%;">หน่วยนับ</label>
                      <div class="col" style="width: 60%;">
                        <input class="col form-control" type="text" autocomplete="chrome-off" name="paUnit" placeholder="">
                      </div>
                    </div>

                    <div class="mt-3 row">
                      <button class="col btn btn-primary mx-3" type="submit" name="paAdd">เพิ่มสินค้า</button>
                      <button class="col btn btn-success mx-3" type="submit" name="paSave">บันทึก</button>
                      <button class="col btn btn-danger mx-3" type="submit" name="paDel">ลบสินค้า</button>
                    </div>


                  </form>
                </div>
              </div>

            </div>

            <!-- Table -->
            <div class="col-9">
              <div class="card">
                <div class="card-body">
                </div>
              </div>

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>

  </div>
  </div>
  <!-- Manage Pack -->
  <div class="modal fade" id="managePackModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="managePackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="managePackModalLabel">จัดการแพ็คสินค้า</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">รหัสแพ็คสินค้า</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="text" autocomplete="chrome-off" name="ppaID" id="ppaID" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">รหัสสินค้าในแพ็ค</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="text" autocomplete="chrome-off" name="ppID" id="ppID" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">บาร์โค้ดสินค้าในแพ็ค</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="text" autocomplete="chrome-off" name="ppBar" id="ppBar" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">ชื่อสินค้า</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="text" autocomplete="chrome-off" name="ppaName" id="ppaName" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">จำนวนชิ้นต่อแพ็ค</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="number" autocomplete="chrome-off" name="ppaPerPacked" id="ppaPerPacked" placeholder="">
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อชิ้น</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="float" autocomplete="chrome-off" name="ppaBPerOne" id="ppaBPerOne" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อแพ็ค</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="float" autocomplete="chrome-off" name="ppaBPerPack" id="ppaBPerPack" placeholder="" disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-form-label" style="width: 40%;">ราคาขายต่อแพ็ค</label>
            <div class="col" style="width: 60%;">
              <input class="col form-control" type="float" autocomplete="chrome-off" name="ppaSP" id="ppaSP" placeholder="">
            </div>
          </div>

          <div class="mt-3 row">
            <button class="col btn btn-primary mx-3" type="submit" name="ppaAdd" data-bs-toggle="modal" data-bs-target="#selectProduct">เลือกสินค้า</button>
            <button class="col btn btn-success mx-3" type="submit" name="ppaSave" data-bs-dismiss="modal" aria-label="Close">บันทึก</button>
            <button class="col btn btn-danger mx-3" type="submit" name="ppaDel">ลบสินค้า</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Select Product -->
  <div class="modal fade" id="selectProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="selectProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content ">
        <div class="modal-header">
          <h5 class="modal-title" id="selectProductLabel">เลือกสินค้า</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered table-hover display" id="selectProductTable" style="width:100%;">
            <thead>
              <tr>
                <th scope="col">รหัสสินค้า</th>
                <th scope="col">บาร์โค้ดสินค้า</th>
                <th scope="col">ชื่อสินค้า</th>
                <th scope="col">ราคา</th>
                <th scope="col">คงเหลือ</th>
              </tr>
            </thead>
          </table>
        </div>
        <div class="modal-footer">
          <center>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          </center>

        </div>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
      var isAdd = false;
      var isAddPack = false;
      var pID = $('#pID').val();
      var pBar = $('#pBar').val();
      var pName = $('#pName').val();
      var pBP = $('#pBP').val();
      var pSP = $('#pSP').val();
      var pVal = $('#pVal').val();
      var pCate = $('#pCate').val();
      var pUnit = $('#pUnit').val();

      var subID = ""
      var subProductVal = ""
      var perPack = ""
      var paSP = ""

      var table = $('#productTable').DataTable({
        "ajax": {
          url: "ajax/product.php",
        },
        "columns": [{
            data: 'pID'
          },
          {
            data: 'pBar'
          },
          {
            data: 'pName'
          },
          {
            data: 'pSP'
          },
          {
            data: 'pVal'
          }
        ],
        select: {
          style: 'single',
          select: true,
          toggleable: false
        }
      });

      $.ajax({
        url: "TabAddToStock/cate.php",
        success: function(data) {

          var json = $.parseJSON(data)
          var str = ''; // variable to store the options

          for (let i = 0; i < json.length; i++) {
            //console.log(json[i].pCate);
            str += '<option value="' + json[i].pCate + '" />';
          }
          $('#pCateDatalist').html(str)

        }
      });

      $.ajax({
        url: "TabAddToStock/unit.php",
        success: function(data) {

          var json = $.parseJSON(data)
          var str = ''; // variable to store the options

          for (let i = 0; i < json.length; i++) {
            //console.log(json[i].pCate);
            str += '<option value="' + json[i].pUnit + '" />';
          }
          $('#pUnitDatalist').html(str)

        }
      });

      //row on click
      $('#productTable tbody').on('click', 'tr', function(row, data, index) {
        isAdd = false;
        pID = table.row(this).data()['pID'];
        $.ajax({
          url: 'TabManageProduct/selectedProduct.php',
          method: 'POST',
          data: {
            pID: pID
          },
          success: function(data) {
            var json = $.parseJSON(data)
            $('#pID').val(json[0].pID)
            $('#pID').attr("disabled", false);
            $('#pBar').val(json[0].pBar)
            $('#pBar').attr("disabled", false);
            $('#pName').val(json[0].pName)
            $('#pName').attr("disabled", false);
            $('#pBP').val(json[0].pBP)
            $('#pBP').attr("disabled", false);
            $('#pSP').val(json[0].pSP)
            $('#pSP').attr("disabled", false);
            $('#pVal').val(json[0].pVal)
            $('#pVal').attr("disabled", false);
            $('#pCate').val(json[0].pCate)
            $('#pCate').attr("disabled", false);
            $('#pUnit').val(json[0].pUnit)
            $('#pUnit').attr("disabled", false);
            $('#managePack').attr("disabled", true);

            $('#ppID').val("")
            $('#ppBar').val("")
            $('#ppaName').val("")
            $('#ppaPerPacked').val("")
            $('#ppaBPerOne').val("")
            $('#ppaBPerPack').val("")
            $('#ppaSP').val("")

            $('#isPacked').prop("checked", json[0].isPacked == 1);
            //console.log($('#isPacked').checked())
            if ($('#isPacked').is(':checked')) {
              $('#managePack').attr("disabled", false);
              $('#pBP').attr("disabled", true);
              $('#pSP').attr("disabled", true);
              $('#pVal').attr("disabled", true);
              $('#pCate').attr("disabled", true);
            }

            $('#pSave').attr("disabled", false);
            $('#pDel').attr("disabled", false);
          }
        })
      });

      //add onclick
      $('#pAdd').click(function(event) {
        {
          var newID = "";
          $.ajax({
            url: "TabManageProduct/addProduct.php",
            success: function(data) {
              newID = data;
              $('#pBar').attr("disabled", false);
              $('#pBar').focus();
              $('#pName').attr("disabled", false);
              $('#pBP').attr("disabled", false);
              $('#pSP').attr("disabled", false);
              $('#pVal').attr("disabled", false);
              $('#pCate').attr("disabled", false);
              $('#pUnit').attr("disabled", false);
              $('#pID').val(newID);
              $('#pBar').val("")
              $('#pName').val("")
              $('#pBP').val("")
              $('#pSP').val("")
              $('#pVal').val("")
              $('#pCate').val("")
              $('#pUnit').val("")
              $('#pSave').attr("disabled", false);
              isAdd = true;
            }
          });

        }
      });

      //save onclick
      $('#pSave').click(function(event) {
        pID = $('#pID').val();
        pBar = $('#pBar').val();
        pName = $('#pName').val();
        pBP = $('#pBP').val();
        pSP = $('#pSP').val();
        pVal = $('#pVal').val();
        pCate = $('#pCate').val();
        pUnit = $('#pUnit').val();

        subID = $('#ppID').val();
        perPack = $('#ppaPerPacked').val();
        paSP = $('#ppaSP').val();

        $('#subBut').click()



        if ($('#isPacked').is(':checked')) {
          if (pID == '' || pBar == '' || pName == '' || pBP == '' || pSP == '' || pVal == '' || pCate == '' || pUnit == '' || subID == '' || perPack == '' || paSP == '') {
            alert("กรุณากรอกข้อมูลให้ครบ");
          } else {
            $.ajax({
              url: "TabManageProduct/savePack.php",
              method: "POST",
              data: {
                paIDSave: pID,
                pIDSave: subID,
                paNameSave: pName,
                paPerPackSave: perPack
              },
              success: function(data) {
                alert(data);


              }
            });

            $.ajax({
              url: "TabManageProduct/saveProduct.php",
              method: "POST",
              data: {
                pIDSave: pID,
                pBarSave: pBar,
                pNameSave: pName,
                pBPSave: pBP,
                pSPSave: pSP,
                pValSave: pVal,
                pCateSave: pCate,
                pUnitSave: pUnit,
                isAdd: isAdd
              },
              success: function(data) {
                alert(data);
                $('#productTable').DataTable().ajax.reload();
                $('#pID').attr("disabled", true);
                $('#pBar').attr("disabled", true);
                $('#pName').attr("disabled", true);
                $('#pBP').attr("disabled", true);
                $('#pSP').attr("disabled", true);
                $('#pVal').attr("disabled", true);
                $('#pCate').attr("disabled", true);
                $('#pUnit').attr("disabled", true);
                $('#pID').val("")
                $('#pBar').val("")
                $('#pName').val("")
                $('#pBP').val("")
                $('#pSP').val("")
                $('#pVal').val("")
                $('#pCate').val("")
                $('#pUnit').val("")
                $('#pSave').attr("disabled", true);
                $('#pDel').attr("disabled", true);

              }
            });
          }
        } else {
          if (pID == '' || pBar == '' || pName == '' || pBP == '' || pSP == '' || pVal == '' || pCate == '' || pUnit == '') {
            alert("กรุณากรอกข้อมูลให้ครบ");
          } else {
            $.ajax({
              url: "TabManageProduct/saveProduct.php",
              method: "POST",
              data: {
                pIDSave: pID,
                pBarSave: pBar,
                pNameSave: pName,
                pBPSave: pBP,
                pSPSave: pSP,
                pValSave: pVal,
                pCateSave: pCate,
                pUnitSave: pUnit,
                isAdd: isAdd
              },
              success: function(data) {
                alert(data);
                $('#productTable').DataTable().ajax.reload();
                $('#pBar').attr("disabled", true);
                $('#pName').attr("disabled", true);
                $('#pBP').attr("disabled", true);
                $('#pSP').attr("disabled", true);
                $('#pVal').attr("disabled", true);
                $('#pCate').attr("disabled", true);
                $('#pUnit').attr("disabled", true);
                $('#pID').val("")
                $('#pBar').val("")
                $('#pName').val("")
                $('#pBP').val("")
                $('#pSP').val("")
                $('#pVal').val("")
                $('#pCate').val("")
                $('#pUnit').val("")
                $('#pSave').attr("disabled", true);
                $('#pDel').attr("disabled", true);

              }
            });
          }

        }



      })

      //del onclick
      $('#pDel').click(function(event) {
        {
          var pID = $('#pID').val();
          $.ajax({
            url: "TabManageProduct/delProduct.php",
            method: "POST",
            data: {
              pIDSave: pID,
            },
            success: function(data) {
              alert(data);
              $('#productTable').DataTable().ajax.reload();
              $('#productTable').DataTable().ajax.reload();
              $('#pBar').attr("disabled", true);
              $('#pName').attr("disabled", true);
              $('#pBP').attr("disabled", true);
              $('#pSP').attr("disabled", true);
              $('#pVal').attr("disabled", true);
              $('#pCate').attr("disabled", true);
              $('#pUnit').attr("disabled", true);
              $('#pID').val("")
              $('#pBar').val("")
              $('#pName').val("")
              $('#pBP').val("")
              $('#pSP').val("")
              $('#pVal').val("")
              $('#pCate').val("")
              $('#pUnit').val("")
              $('#pSave').attr("disabled", true);
              $('#pDel').attr("disabled", true);
            }
          });

        }
      });

      //Packed Product
      $('#isPacked').on('change', function() {
        if ($('#isPacked').is(':checked')) {
          $('#managePack').attr("disabled", false);
          $('#pBP').attr("disabled", true);
          $('#pSP').attr("disabled", true);
          $('#pVal').attr("disabled", true);
          $('#pCate').attr("disabled", true);
        } else {
          $('#managePack').attr("disabled", true);
          $('#pBP').attr("disabled", false);
          $('#pSP').attr("disabled", false);
          $('#pVal').attr("disabled", false);
          $('#pCate').attr("disabled", false);

        }
      });


      //add onclick
      $('#managePack').click(function(event) {
        {
          $('#ppaID').val($('#pID').val());
          $.ajax({
            url: 'TabManageProduct/selectedPack.php',
            method: 'POST',
            data: {
              pID: pID
            },
            success: function(data) {
              var json = $.parseJSON(data)
              $('#ppID').val(json[0].pID);
              $('#ppBar').val(json[0].pBar);
              $('#ppaName').val($('#pName').val());
              $('#ppaPerPacked').val(json[0].paPerPack)
              $('#ppaBPerOne').val(json[0].pBP);
              $('#ppaBPerPack').val($('#pBP').val());
              $('#ppaSP').val($('#pSP').val());



            }
          })
        }
      });

      //Select Product
      var selectDataProductTable = $('#selectProductTable').DataTable({
        "ajax": "ajax/product.php",
        "columns": [{
            data: 'pID'
          },
          {
            data: 'pBar'
          },
          {
            data: 'pName'
          },
          {
            data: 'pSP'
          },
          {
            data: 'pVal'
          },
        ],
        deferRender: true,
        scrollY: 300,
        scrollCollapse: true,
        scroller: true,
        select: {
          style: 'single',
          select: true,
          toggleable: false
        },
        // "paging": false
      });

      $('#selectProductTable tbody').on('dblclick', 'tr', function(row, data, index) {
        // selectedProduct(pID)
        subID = selectDataProductTable.row(this).data()['pID']
        if (subID == pID) {
          alert("เลือกสินค้าเดียวกันไม่ได้")
        } else {
          $('#ppID').val(selectDataProductTable.row(this).data()['pID']);
          $('#ppBar').val(selectDataProductTable.row(this).data()['pBar']);
          $('#ppaName').val(selectDataProductTable.row(this).data()['pName']);
          $('#ppaBPerOne').val(selectDataProductTable.row(this).data()['pBP']);
          $('#ppaBPerPack').val(selectDataProductTable.row(this).data()['pBP']);
          $('#ppaPerPacked').val("")
          subProductVal = selectDataProductTable.row(this).data()['pVal']
          $('#selectProduct').modal('hide');
        }

      });

      $('#selectProduct').on('shown.bs.modal', function() {
        selectDataProductTable.columns.adjust();
        $("#selectProduct [type='search']").focus();
        selectDataProductTable.on('search.dt', function() {
          selectDataProductTable.row(':eq(0)', {
            page: 'current'
          }).select();
        });

        $('#selectProduct').on('keyup', function(e) {
          if (e.keyCode === 13) {
            pID = selectDataProductTable.row('.selected').data()['pID']
            addToPOS(pID);
            $('#selectProduct').modal('hide');
          }
        })

      });

      $('#selectProduct').on('hide.bs.modal', function() {
        selectDataProductTable.row('.selected').deselect()
        $("#selectProduct [type='search']").val("");
        $('#selectProduct').off();

      });

      $('#ppaPerPacked').on('keyup', function() {
        $('#ppaBPerPack').val($('#ppaBPerOne').val() * $('#ppaPerPacked').val());
        $('#pBP').val($('#ppaBPerPack').val());
        $('#pVal').val((subProductVal / $('#ppaPerPacked').val()).toFixed(0));
      });

      $('#ppaSP').on('keyup', function() {
        $('#pSP').val($('#ppaSP').val());
      });




    });
  </script>

</body>

<?php
include("system\server.php");
if (isset($_POST["submit"])) {
  // File upload path
  $targetDir = "product_pic/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

  if (!empty($_FILES["file"]["name"])) {
    // Allow certain file formats
    $name = $_POST['pID'];
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
      $temp = explode(".", $_FILES["file"]["name"]);
      $newfilename = $name . '.' . end($temp);
      move_uploaded_file($_FILES["file"]["tmp_name"], "product_pic/" . $newfilename);
    }
  }
}

?>