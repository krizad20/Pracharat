<?php
include("./system/header.php");
if (!isset($_SESSION['seller']) || $_SESSION['permission'] == "2") {
  echo "<script>window.location.href='index.php';</script>";
}
?>

<body>

  <div class="container-fluid p-3">

    <div class="row">
      <div class="col">
        <div class="mb-2 row">
          <label class="col-form-label" style="width: 30%;">รหัสสินค้า</label>
          <div class="col" style="width: 70%;">
            <input type="text" class="form-control " id="pIDA2S" placeholder="รหัสสินค้า" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width: 30%;">รหัสบาร์โค้ด</label>
          <div class="col" style="width: 70%;">
            <input class="form-control" id="pBarA2S" placeholder="รหัสบาร์โค้ด" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width:30%;">ชื่อสินค้า</label>
          <div class="col" style="width:30%;">
            <input type="text" class="form-control " id="pNameA2S" placeholder="ชื่อสินค้า" disabled>
          </div>
        </div>



        <div class="mb-2 row">
          <label class="col-form-label" style="width:30%;">ราคาซื้อ</label>
          <div class="col" style="width:70%;">
            <input type="number" class="form-control " id="pBPA2S" placeholder="ราคาซื้อ" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="colcol-form-label" style="width:30%;">ราคาขาย</label>
          <div class="col" style="width:70%;">
            <input type="number" class="form-control " id="pSPA2S" placeholder="ราคาขาย" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width:30%;">คงเหลือ</label>
          <div class="col" style="width:70%;">
            <input type="number" class="form-control " id="pValA2S" placeholder="จำนวนคงเหลือ" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width:30%;">หมวดหมู่</label>
          <div class="col" style="width:70%;">
            <!-- <input type="text" class="form-control " id="pCateA2S" placeholder="หมวดหมู่" disabled> -->
            <input class="form-control" list="pCateDatalist" id="pCateA2S" placeholder="หมวดหมู่" disabled>
            <datalist id="pCateDatalist">
            </datalist>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width:30%;">หน่วยนับ</label>
          <div class="col" style="width:70%;">
            <!-- <input type="text" class="form-control " id="pUnitA2S" placeholder="หน่วยนับ" disabled> -->
            <input class="form-control" list="pUnitDatalist" id="pUnitA2S" placeholder="หน่วยนับ" disabled>
            <datalist id="pUnitDatalist">
            </datalist>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="mb-2 row">
          <table class="table table-bordered table-hover" id="addProductTable">
            <thead>
              <tr>
                <th scope="col">รหัสสินค้า</th>
                <th scope="col">บาร์โค้ดสินค้า</th>
                <th scope="col">ชื่อสินค้า</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="mb-2 row">
          <label class="col-form-label" style="width: 35%;">จำนวนที่จะเพิ่ม</label>
          <div class="col" style="width: 70%;">
            <input type="number" class="form-control " id="pAddVal" placeholder="จำนวนที่จะเพิ่ม" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width: 35%;">ราคาที่ซื้อมา</label>
          <div class="col" style="width: 70%;">
            <input type="float" class="form-control " id="pNowBP" placeholder="ราคาที่ซื้อมา" disabled>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="mb-2 row">
          <label class="col-form-label" style="width: 35%;">ราคาซื้อใหม่</label>
          <div class="col" style="width: 70%;">
            <input type="float" class="form-control " id="pNewBP" placeholder="ราคาที่ซื้อใหม่" disabled>
          </div>
        </div>

        <div class="mb-2 row">
          <label class="col-form-label" style="width: 35%;">ราคาขายใหม่</label>
          <div class="col" style="width: 70%;">
            <input type="float" class="form-control " id="pNewSP" placeholder="ราคาขายใหม่" disabled>
          </div>
        </div>
      </div>
    </div>

    <button type="button" class="btn btn-primary" id="saveAdd">บันทึก</button>

  </div>


  <script>
    $(document).ready(function() {
      //Add Product

      $.ajax({
        url: "./TabAddToStock/cate.php",
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
        url: "./TabAddToStock/unit.php",
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

      var addProductDataTable = $('#addProductTable').DataTable({
        "processing": true,
        "ajax": "./ajax/product.php",
        "columns": [{
            data: 'pID'
          },
          {
            data: 'pBar'
          },
          {
            data: 'pName'
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
        }
      });

      $('#addProductTable tbody').on('click', 'tr', function(row, data, index) {
        var pID = addProductDataTable.row(this).data()['pID'];
        $.ajax({
          url: 'TabManageProduct/selectedProduct.php',
          method: 'POST',
          data: {
            pID: pID
          },
          success: function(data) {
            var json = $.parseJSON(data)
            $('#pIDA2S').val(json[0].pID)
            $('#pIDA2S').attr("disabled", true);
            $('#pBarA2S').val(json[0].pBar)
            $('#pBarA2S').attr("disabled", false);
            $('#pNameA2S').val(json[0].pName)
            $('#pNameA2S').attr("disabled", false);
            $('#pBPA2S').val(json[0].pBP)
            $('#pBPA2S').attr("disabled", false);
            $('#pSPA2S').val(json[0].pSP)
            $('#pSPA2S').attr("disabled", false);
            $('#pValA2S').val(json[0].pVal)
            $('#pValA2S').attr("disabled", false);
            $('#pCateA2S').val(json[0].pCate)
            $('#pCateA2S').attr("disabled", false);
            $('#pUnitA2S').val(json[0].pUnit)
            $('#pUnitA2S').attr("disabled", false);
            $('#pAddVal').attr("disabled", false);
            $('#pNowBP').attr("disabled", false);
            $('#pNewSP').attr("disabled", false);
            $('#pNewBP').attr("disabled", false);
            $('#pAddVal').val("");
            $('#pNowBP').val("");
            $('#pNewSP').val("");
            $('#pNewBP').val("");
          }
        })
      });

      $('#pNowBP').keyup(function() {
        $pAddVal = parseInt($('#pAddVal').val())
        $pNowBP = parseFloat($('#pNowBP').val())
        $pBP = parseFloat($('#pBPA2S').val())
        $pVal = parseInt($('#pValA2S').val())


        $pNewBP = (($pBP * $pVal) + $pNowBP) / ($pVal + $pAddVal);
        if ($('#pNowBP').val() != "") {
          $('#pNewBP').val($pNewBP.toFixed(2));
        } else {
          $('#pNewBP').val("");
        }

        $('#pAddVal').keyup(function() {
          $pAddVal = parseInt($('#pAddVal').val())
          $pNowBP = parseFloat($('#pNowBP').val())
          $pBP = parseFloat($('#pBPA2S').val())
          $pVal = parseInt($('#pValA2S').val())

          $pNewBP = (($pBP * $pVal) + $pNowBP) / ($pVal + $pAddVal);
          if ($('#pNowBP').val() != "") {
            $('#pNewBP').val($pNewBP.toFixed(2));
          } else {
            $('#pNewBP').val("");
          }
        })
      })

      $('#saveAdd').click(function() {
        var isAdd = false;
        var pID = $('#pIDA2S').val();
        var pBar = $('#pBarA2S').val();
        var pName = $('#pNameA2S').val();
        var pBP = $('#pBPA2S').val();
        var pSP = $('#pSPA2S').val();
        var pVal = parseInt($('#pValA2S').val());
        var pCate = $('#pCateA2S').val();
        var pUnit = $('#pUnitA2S').val();

        if ($('#pNewBP').val() != "") {
          pBP = $('#pNewBP').val();
        }
        if ($('#pNewSP').val() != "") {
          pSP = $('#pNewSP').val();
        }

        var pAddVal = parseInt($('#pAddVal').val())

        pVal = pVal + pAddVal;

        if (pID == '' || pBar == '' || pName == '' || pBP == '' || pSP == '' || pVal == '' || pCate == '' || pUnit == '' || $('#pAddVal').val() == "") {
          alert("กรุณากรอกข้อมูลให้ครบ");
        } else {
          $.ajax({
            url: "./TabManageProduct/manageProduct.php",
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
              isAdd: isAdd,
              addToStock: true,
              pAddVal: pAddVal
            },
            success: function(data) {
              alert(data);
              $('#pIDA2S').val("");
              $('#pBarA2S').val("");
              $('#pNameA2S').val("");
              $('#pBPA2S').val("");
              $('#pSPA2S').val("");
              $('#pValA2S').val("");
              $('#pCateA2S').val("");
              $('#pUnitA2S').val("");
              $('#pAddVal').val("");
              $('#pNowBP').val("");
              $('#pNewSP').val("");
              $('#pNewBP').val("");
              $('#addProductTable').DataTable().ajax.reload();
            }
          });
        }
      })



    });
  </script>

</body>