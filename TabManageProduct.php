<?php
include("./system/header.php");
if (!isset($_SESSION['seller']) || $_SESSION['permission'] == "2") {
  echo "<script>window.location.href='index.php';</script>";
}
?>

<div class="container-fluid" id="items">
  <div class="d-flex">
    <div class="d-flex me-auto mb-2" id="searchAndCate">
      <input class="search form-control me-2" type="search" id="searchBarManage" placeholder="ค้นหาสินค้า" aria-label="Search" autofocus>
      <button class="sort btn btn-success text-nowrap me-2" type="button" data-sort="name" style="width: fit-content;font-size: 50%;"> เรียงตามชื่อ</button>
      <select class="form-select form-select-sm me-2" name="cate" id="pCateSelect">
      </select>
      <button class="btn btn-primary text-nowrap" name="pAdd" id="pAdd" data-bs-toggle="modal" data-bs-target="#addProductModal">เพิ่มสินค้า</button>

    </div>
    <ul class="nav nav-tabs d-flex me-2" id="productTypeTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="product-tab" data-bs-toggle="tab" data-bs-target="#product" type="button" role="tab" aria-controls="product" aria-selected="true">
          <i class="fa fa-list"></i>
        </button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="packed-tab" data-bs-toggle="tab" data-bs-target="#packed" type="button" role="tab" aria-controls="packed" aria-selected="false">
          <i class="fa fa-th-large"></i>
        </button>
      </li>
    </ul>
  </div>

  <div class="tab-content" id="myTabContent">
    <!-- Table Product Tab -->
    <div class="tab-pane fade show active" id="product" role="tabpanel" aria-labelledby="product-tab">
      <div class="row">
        <!-- Detail -->
        <div class="col-3">
          <div class="card">
            <div class="card-body p-2">
              <h5>
                <center>รายละเอียดสินค้า</center>
              </h5>

              <div>
                <div class="mb-1 row">
                  <label class="col-sm-4 col-form-label">รหัสสินค้า</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" autocomplete="off" name="pIDEditTable" id="pIDEditTable" placeholder="รหัสสินค้า" readonly required>
                  </div>
                </div>

                <div class="mb-1 row">
                  <label class="col-sm-4 col-form-label">บาร์โค้ดสินค้า</label>
                  <div class="col-sm-8">
                    <div class="input-group">
                      <input class="form-control form-control-sm" type="text" autocomplete="off" name="pBarEditTable" id="pBarEditTable" placeholder="บาร์โค้ดสินค้า" disabled required>
                      <button class="btn btn-sm btn-outline-secondary" type="button" id="barManage" data-bs-toggle="modal" data-bs-target="#subBarcode" disabled>จัดการ</button>
                    </div>
                  </div>
                </div>

                <div class="mb-1 row">
                  <label class="col-sm-4 col-form-label">ชื่อสินค้า</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" type="text" autocomplete="off" name="pNameEditTable" id="pNameEditTable" placeholder="ชื่อสินค้า" disabled required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-8">
                    <div class="mb-1 row">
                      <label class="col-sm-6 col-form-label">ราคาซื้อ</label>
                      <div class="col-sm-6">
                        <input class="form-control form-control-sm" type="float" autocomplete="off" name="pBPEditTable" id="pBPEditTable" placeholder="ราคาซื้อ" required disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-sm-6 col-form-label">ราคาขาย</label>
                      <div class="col-sm-6">
                        <input class="form-control form-control-sm" type="float" autocomplete="off" name="pSPEditTable" id="pSPEditTable" placeholder="ราคาขาย" required disabled>
                      </div>
                    </div>

                    <div class="mb-1 row">
                      <label class="col-sm-6 col-form-label">คงเหลือ</label>
                      <div class="col-sm-6">
                        <input class="form-control form-control-sm" type="number" autocomplete="off" name="pValEditTable" id="pValEditTable" placeholder="คงเหลือ" required disabled>
                      </div>

                    </div>

                    <div class="mb-1 row">
                      <label class="col-sm-6 col-form-label">หน่วยนับ</label>
                      <div class="col-sm-6">
                        <input class="form-control form-control-sm" list="pUnitDatalist" type="text" autocomplete="off" name="pUnitEditTable" id="pUnitEditTable" placeholder="หน่วยนับ" required disabled>
                        <datalist id="pUnitDatalist">
                        </datalist>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-4 align-self-center">
                    <img class="img" id="pImgEditTable" src="./product_pic/P00000.png" alt="" width="100px" height="100px">
                  </div>
                </div>


                <div class="mb-1 row">
                  <label class="col-sm-4 col-form-label">หมวดหมู่</label>
                  <div class="col-sm-8">
                    <input class="form-control form-control-sm" list="pCateDatalist" type="text" autocomplete="off" name="pCateEditTable" id="pCateEditTable" placeholder="หมวดหมู่" required disabled>
                    <datalist id="pCateDatalist">
                    </datalist>
                  </div>
                </div>



                <div class="mb-1 row">
                  <div class="col-sm-4 d-flex">
                    <button class="btn btn-sm btn-primary text-nowrap" type="button" name="managePackEditTable" id="managePackEditTable" data-bs-toggle="modal" data-bs-target="#managePackModal" disabled>จัดการแพ็คสินค้า</button>
                  </div>
                  <div class="col-sm-8 d-flex align-items-center">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="isPackedEditTable" disabled>
                      <label class="form-check-label" for="isPackedEditTable">
                        สินค้าแพ็ค
                      </label>
                    </div>
                  </div>
                </div>

                <div class="mb-1 row">
                  <div class="col d-flex">
                    <input class="form-control form-control-sm image" type="file" name="image" id="selectImg">
                  </div>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                  <button class="btn btn-success mx-3" name="pSaveEditTable" id="pSaveEditTable" disabled>บันทึก</button>
                  <button class="btn btn-danger mx-3" name="pDelTable" id="pDelTable" disabled>ลบสินค้า</button>
                </div>
              </div>


            </div>
          </div>
        </div>

        <!-- Table -->
        <div class="col-9">
          <div class="card">
            <div class="card-body p-2">
              <table class="table table-bordered table-hover" id="productTable" style="width: 100%;">
                <thead>
                  <tr>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">บาร์โค้ดสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">ราคาขาย</th>
                    <th scope="col">คงเหลือ</th>
                    <th scope="col">หมวดหมู่</th>
                    <th scope="col">ชุดบาร์โค้ด</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Grid Product Tab -->
    <div class="tab-pane fade mb-2" id="packed" role="tabpanel" aria-labelledby="packed-tab">
      <div class="d-flex" style="width: 100%;">
        <div class="card" style="width: 100%;">
          <div class="card-body overflow-auto position-sticky">
            <div class="list row overflow-auto" id="display_item" style="height: 60vh;">
            </div>
          </div>

          <div class="card-footer position-sticky fixed-bottom">
            <div class="d-flex justify-content-center " style="font-size: medium;">
              <ul class="pagination"></ul>
            </div>
          </div>

        </div>
      </div>
    </div>

  </div>
</div>

<!-- Add Product -->
<div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">เพิ่มสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="addFrom">
          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">รหัสสินค้า</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" autocomplete="off" name="pID" id="pIDAdd" placeholder="รหัสสินค้า" readonly required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">บาร์โค้ดสินค้า</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input class="form-control form-control-sm" type="text" autocomplete="off" name="pBar" id="pBarAdd" placeholder="บาร์โค้ดสินค้า" disabled required>
              </div>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ชื่อสินค้า</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" autocomplete="off" name="pName" id="pNameAdd" placeholder="ชื่อสินค้า" disabled required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ราคาซื้อ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="float" autocomplete="off" name="pBP" id="pBPAdd" placeholder="ราคาซื้อ" required disabled> 
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ราคาขาย</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="float" autocomplete="off" name="pSP" id="pSPAdd" placeholder="ราคาขาย" required disabled>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">คงเหลือ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="number" autocomplete="off" name="pVal" id="pValAdd" placeholder="คงเหลือ" disabled required>
            </div>

          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">หมวดหมู่</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" list="pCateDatalist" type="text" autocomplete="off" name="pCate" id="pCateAdd" placeholder="หมวดหมู่" required disabled>
              <datalist id="pCateDatalist">
              </datalist>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">หน่วยนับ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" list="pUnitDatalist" type="text" autocomplete="off" name="pUnit" id="pUnitAdd" placeholder="หน่วยนับ" required disabled>
              <datalist id="pUnitDatalist">
              </datalist>
            </div>
          </div>

          <div class="mb-1 row">
            <div class="col-sm-4 d-flex">
              <button class="btn btn-sm btn-primary text-nowrap" type="button" name="managePackAdd" id="managePackAdd" data-bs-toggle="modal" data-bs-target="#managePackModal" disabled>จัดการแพ็คสินค้า</button>
            </div>
            <div class="col-sm-8 d-flex align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="isPackedAdd" disabled>
                <label class="form-check-label" for="isPackedAdd">
                  สินค้าแพ็ค
                </label>
              </div>
            </div>
          </div>

          <div class="mb-1 row">
            <div class="col d-flex">
              <input class="form-control form-control-sm" type="file" name="file" id="formFileAdd" disabled>
              <input class="d-none" type="submit" name="submit" value="Upload" id="subButAdd">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="pSaveAdd">บันทึก</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit Product -->
<div class="modal fade" id="editProductModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="">แก้ไขสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="GridEditFrom">
          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">รหัสสินค้า</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" autocomplete="off" name="pIDEditGrid" id="pIDEditGrid" placeholder="รหัสสินค้า" readonly required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">บาร์โค้ดสินค้า</label>
            <div class="col-sm-8">
              <div class="input-group">
                <input class="form-control form-control-sm" type="text" autocomplete="off" name="pBarEditGrid" id="pBarEditGrid" placeholder="บาร์โค้ดสินค้า" required>
                <button class="btn btn-sm btn-outline-secondary" type="button" id="barManage" data-bs-toggle="modal" data-bs-target="#subBarcode" disabled>จัดการ</button>
              </div>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ชื่อสินค้า</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="text" autocomplete="off" name="pNameEditGrid" id="pNameEditGrid" placeholder="ชื่อสินค้า" required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ราคาซื้อ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="float" autocomplete="off" name="pBPEditGrid" id="pBPEditGrid" placeholder="ราคาซื้อ" required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">ราคาขาย</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="float" autocomplete="off" name="pSPEditGrid" id="pSPEditGrid" placeholder="ราคาขาย" required>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">คงเหลือ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" type="number" autocomplete="off" name="pValEditGrid" id="pValEditGrid" placeholder="คงเหลือ" required>
            </div>

          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">หมวดหมู่</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" list="pCateDatalist" type="text" autocomplete="off" name="pCateEditGrid" id="pCateEditGrid" placeholder="หมวดหมู่" required>
              <datalist id="pCateDatalist">
              </datalist>
            </div>
          </div>

          <div class="mb-1 row">
            <label class="col-sm-4 col-form-label">หน่วยนับ</label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm" list="pUnitDatalist" type="text" autocomplete="off" name="pUnitEditGrid" id="pUnitEditGrid" placeholder="หน่วยนับ" required>
              <datalist id="pUnitDatalist">
              </datalist>
            </div>
          </div>

          <div class="mb-1 row">
            <div class="col-sm-4 d-flex">
              <button class="btn btn-sm btn-primary text-nowrap" type="button" name="managePackEditGrid" id="managePackEditGrid" data-bs-toggle="modal" data-bs-target="#managePackModal" disabled>จัดการแพ็คสินค้า</button>
            </div>
            <div class="col-sm-8 d-flex align-items-center">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="isPackedEditGrid">
                <label class="form-check-label" for="isPackedEditGrid">
                  สินค้าแพ็ค
                </label>
              </div>
            </div>
          </div>

          <div class="mb-1 row">
            <div class="col d-flex">
              <input class="form-control form-control-sm" type="file" name="file" id="formFileEditGrid">
              <input class="d-none" type="submit" name="submit" value="Upload" id="subButEditGrid">
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
        <button type="button" class="btn btn-primary" id="pSaveEditGrid">บันทึก</button>
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
            <input class="col form-control" type="text" autocomplete="off" name="ppaID" id="ppaID" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">รหัสสินค้าในแพ็ค</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="text" autocomplete="off" name="ppID" id="ppID" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">บาร์โค้ดสินค้าในแพ็ค</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="text" autocomplete="off" name="ppBar" id="ppBar" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">ชื่อสินค้า</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="text" autocomplete="off" name="ppaName" id="ppaName" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">จำนวนชิ้นต่อแพ็ค</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="number" autocomplete="off" name="ppaPerPacked" id="ppaPerPacked" placeholder="">
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อชิ้น</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="float" autocomplete="off" name="ppaBPerOne" id="ppaBPerOne" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">ราคาซื้อต่อแพ็ค</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="float" autocomplete="off" name="ppaBPerPack" id="ppaBPerPack" placeholder="" disabled>
          </div>
        </div>

        <div class="mb-1 row">
          <label class="col-form-label" style="width: 40%;">ราคาขายต่อแพ็ค</label>
          <div class="col" style="width: 60%;">
            <input class="col form-control" type="float" autocomplete="off" name="ppaSP" id="ppaSP" placeholder="">
          </div>
        </div>

        <div class="mt-3 row">
          <button class="col btn btn-primary mx-3" type="submit" name="ppaAdd" data-bs-toggle="modal" data-bs-target="#selectProduct">เลือกสินค้า</button>
          <button class="col btn btn-success mx-3" type="submit" name="ppaSave" id="ppaSave" data-bs-dismiss="modal" aria-label="Close">บันทึก</button>
          <button class="col btn btn-danger mx-3" type="submit" name="ppaCancel" data-bs-dismiss="modal" aria-label="Close">ยกเลิก</button>
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

<!-- Manage Sub barcode -->
<div class="modal fade" id="subBarcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="subBarcodetLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="subBarcodeLabel">เลือกสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover display" id="subBarcodeTable" style="width:100%;">
          <thead>
            <tr>
              <th scope="col">บาร์โค้ดสินค้า</th>
              <th scope="col">รายละเอียด</th>
              <th scope="col">ลบ</th>

            </tr>
          </thead>
        </table>

        <!--- บาร์โค้ดสินค้า -->
        <div class="row">
          <div class="col-5">
            <div class="form-group">
              <label for="subBarcode">บาร์โค้ดสินค้า</label>
              <input type="text" class="form-control-sm" id="subBarcodeBarcode" placeholder="">
            </div>
          </div>
          <div class="col-5">
            <div class="form-group">
              <label for="subBarcode">รายละเอียด</label>
              <input type="text" class="form-control-sm" id="subBarcodeDetail" placeholder="">
            </div>
          </div>
          <!-- save sub barcode -->
          <div class="col-2">
            <button type="button" class="btn btn-success btn-sm" name="addSubBarcode" id="addSubBarcode">บันทึก</button>
          </div>

        </div>
        <div class="modal-footer">
          <center>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          </center>

        </div>
      </div>
    </div>
  </div>
</div>

</div>

<script>
  $(document).ready(function() {
    var pID;
    var pBar;
    var pName;
    var pBP;
    var pSP;
    var pVal;
    var pCate;
    var pUnit;
    var imgFile;

    var subID = ""
    var subProductVal = ""
    var perPack = ""
    var paSP = ""
    var paCate = ""


    load_product();

    loadCateAndUnit()

    $('#pCateSelect').change(function() {
      var selection = this.value;
      if (selection) {
        userList.filter(function(item) {
          return (item.values().cate == selection);
        });
      } else {
        userList.filter();
      }
    })

    //Table Tab
    var table = $('#productTable').DataTable({
      "ajax": {
        url: "./ajax/product.php",
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
        },
        {
          data: 'pCate'
        },
        {
          data: 'pBars',
          render: function(data, type) {
            let json = JSON.parse(data);
            let bars = "";
            for (let i = 0; i < json.length; i++) {
              bars += json[i].barcode + ",";
            }

            return bars;
          }
        }

      ],
      select: {
        style: 'single',
        select: true,
        toggleable: false
      },
      //hide columns
      "columnDefs": [{
          "targets": [5, 6],
          "visible": false,
          "searchable": true
        },

      ],
      "language": {
        "lengthMenu": "",
        "zeroRecords": "ไม่พบข้อมูล",
        "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_",
        "infoEmpty": "ไม่มีข้อมูล",
        "infoFiltered": "(ค้นหาจาก _MAX_ total รายการ)",
        "search": "",
        "paginate": {
          "first": "หน้าแรก",
          "last": "หน้าสุดท้าย",
          "next": "ถัดไป",
          "previous": "ก่อนหน้า"
        },
      },





    });

    //Filter Table
    $('#pCateSelect').change(function() {
      var selection = this.value;
      table.column(5).search(selection).draw();
    })

    $('#searchBarManage').on('keyup', function() {
      $('#searchBar').val($(this).val());
    });

    //hide search box
    $('#productTable_filter').hide();

    //row on click
    $('#productTable tbody').on('click', 'tr', function(row, data, index) {
      pID = table.row(this).data()['pID'];
      $.ajax({
        url: 'TabManageProduct/selectedProduct.php',
        method: 'POST',
        data: {
          pID: pID
        },
        success: function(data) {
          var json = $.parseJSON(data)
          $('#pIDEditTable').val(json[0].pID)
          $('#pBarEditTable').val(json[0].pBar)
          $('#pNameEditTable').val(json[0].pName)
          $('#pBPEditTable').val(json[0].pBP)
          $('#pSPEditTable').val(json[0].pSP)
          $('#pValEditTable').val(json[0].pVal)
          $('#pCateEditTable').val(json[0].pCate)
          $('#pUnitEditTable').val(json[0].pUnit)
          $('#pImgEditTable').attr('src', './product_pic/' + json[0].img)


          $('#isPackedEditTable').prop("checked", json[0].isPacked == 1);
          $('#managePackEditTable').attr("disabled", json[0].isPacked != 1);

          detailBox("enable", "EditTable");

          $('#ppID').val("")
          $('#ppBar').val("")
          $('#ppaName').val("")
          $('#ppaPerPacked').val("")
          $('#ppaBPerOne').val("")
          $('#ppaBPerPack').val("")
          $('#ppaSP').val("")


          if ($('#isPackedEditTable').is(':checked')) {

            $('#pBPEditTable').attr("disabled", true);
            $('#pSPEditTable').attr("disabled", true);
            $('#pValEditTable').attr("disabled", true);
            $('#pCateEditTable').attr("disabled", true);
          }

          $('#pSaveEditTable').attr("disabled", false);
          $('#pDelTable').attr("disabled", false);
        }
      })
    });

    //Save EDIT
    $('#pSaveEditTable').click(function(event) {
      event.preventDefault();

      pID = $('#pIDEditTable').val();
      pBar = $('#pBarEditTable').val();
      pName = $('#pNameEditTable').val();
      pBP = $('#pBPEditTable').val();
      pSP = $('#pSPEditTable').val();
      pVal = $('#pValEditTable').val();
      pCate = $('#pCateEditTable').val();
      pUnit = $('#pUnitEditTable').val();

      subID = $('#ppID').val();
      perPack = $('#ppaPerPacked').val();
      paSP = $('#ppaSP').val();
      isPacked = $('#isPackedEditTable').is(':checked') ? 1 : 0;
      data = {
        pID: pID,
        pBar: pBar,
        pName: pName,
        pBP: pBP,
        pSP: pSP,
        pVal: pVal,
        pCate: pCate,
        pUnit: pUnit,
        subID: subID,
        perPack: perPack,
        paSP: paSP,
        isPacked: isPacked
      }




      if ($('#isPackedEditTable').is(':checked')) {
        editPack(data);
      } else {
        editProduct(data);

      }
    })

    //DELETE
    $('#pDelTable').click(function(event) {
      event.preventDefault();
      var pID = $('#pIDEditTable').val();
      console.log(pID);
      delProduct(pID);
    });


    //Grid Tab
    $('#searchBarManage').on('keyup search', function(e) {
      if (e.keyCode == 13) {
        var search = $('#searchBar').val() + '"';
        $('.bars').each(function() {

        });
      }
      table.search(this.value).draw();
    });

    //Edit modal on click
    $('#editProductModal').on('show.bs.modal', function(event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      let parents = button.parent().parent()
      pID = parents.find('.id').text();
      $('#pIDEditGrid').val(parents.find('.id').text());
      $('#pBarEditGrid').val(parents.find('.bar').text());
      $('#pNameEditGrid').val(parents.find('.name').text());
      $('#pBPEditGrid').val(parents.find('.bp').text());
      $('#pSPEditGrid').val(parents.find('.sp').text());
      $('#pValEditGrid').val(parents.find('.val').text());
      $('#pCateEditGrid').val(parents.find('.cate').text());
      $('#pUnitEditGrid').val(parents.find('.unit').text());

      $('#isPackedEditGrid').prop("checked", parents.find('.isPacked').text() == '1');
      $('#managePackEditGrid').attr("disabled", parents.find('.isPacked').text() != '1');


      $('#ppID').val("")
      $('#ppBar').val("")
      $('#ppaName').val("")
      $('#ppaPerPacked').val("")
      $('#ppaBPerOne').val("")
      $('#ppaBPerPack').val("")
      $('#ppaSP').val("")


      if ($('#isPackedEditGrid').is(':checked')) {

        $('#pBPEditGrid').attr("disabled", true);
        $('#pSPEditGrid').attr("disabled", true);
        $('#pValEditGrid').attr("disabled", true);
        $('#pCateEditGrid').attr("disabled", true);
      }

    });

    $('#editProductModal').on('hidden.bs.modal', function(event) {
      $('#pIDEditGrid').val("")
      $('#pBarEditGrid').val("")
      $('#pNameEditGrid').val("")
      $('#pBPEditGrid').val("")
      $('#pSPEditGrid').val("")
      $('#pValEditGrid').val("")
      $('#pCateEditGrid').val("")
      $('#pUnitEditGrid').val("")
    });

    //Save Edit
    $('#pSaveEditGrid').click(function(event) {
      event.preventDefault();

      pID = $('#pIDEditGrid').val();
      pBar = $('#pBarEditGrid').val();
      pName = $('#pNameEditGrid').val();
      pBP = $('#pBPEditGrid').val();
      pSP = $('#pSPEditGrid').val();
      pVal = $('#pValEditGrid').val();
      pCate = $('#pCateEditGrid').val();
      pUnit = $('#pUnitEditGrid').val();

      subID = $('#ppID').val();
      perPack = $('#ppaPerPacked').val();
      paSP = $('#ppaSP').val();
      isPacked = $('#isPackedEditGrid').is(':checked') ? 1 : 0;
      data = {
        pID: pID,
        pBar: pBar,
        pName: pName,
        pBP: pBP,
        pSP: pSP,
        pVal: pVal,
        pCate: pCate,
        pUnit: pUnit,
        subID: subID,
        perPack: perPack,
        paSP: paSP,
        isPacked: isPacked
      }

      if ($('#isPackedEditGrid').is(':checked')) {
        editPack(data);
      } else {
        editProduct(data);
      }


    })

    //Delete
    $('#display_item').on('click', '.delete', function(event) {
      event.preventDefault();
      var pID = $(this).parent().parent().find('.id').text();
      delProduct(pID);
    });


    //Add Product
    $('#pAdd').click(function(event) {
      {
        var newID = "";
        table.row('.selected').deselect()
        detailBox("disable", "EditTable");
        detailBox("disable", "EditGrid");
        $('#pIDEditTable').val("");
        $('#pBarEditTable').val("")
        $('#pNameEditTable').val("")
        $('#pBPEditTable').val("")
        $('#pSPEditTable').val("")
        $('#pValEditTable').val("")
        $('#pCateEditTable').val("")
        $('#pUnitEditTable').val("")
        $('#isPackedEditTable').prop('checked', false);
        $('#isPackedAdd').prop('checked', false);




        $.ajax({
          url: "./TabManageProduct/manageProduct.php",
          method: "POST",
          data: {
            mode: "getNewID"
          },
          success: function(data) {
            newID = data;
            $('#pBarAdd').focus();
            detailBox("enable", "Add");
            $('#pIDAdd').val(newID);
            $('#pBarAdd').val("")
            $('#pNameAdd').val("")
            $('#pBPAdd').val("")
            $('#pSPAdd').val("")
            $('#pValAdd').val("")
            $('#pCateAdd').val("")
            $('#pUnitAdd').val("")
            pID = newID;
          }
        });

      }
    });

    $('#pSaveAdd').click(function(event) {
      pID = $('#pIDAdd').val();
      pBar = $('#pBarAdd').val();
      pName = $('#pNameAdd').val();
      pBP = $('#pBPAdd').val();
      pSP = $('#pSPAdd').val();
      pVal = $('#pValAdd').val();
      pCate = $('#pCateAdd').val();
      pUnit = $('#pUnitAdd').val();

      subID = $('#ppID').val();
      perPack = $('#ppaPerPacked').val();
      paSP = $('#ppaSP').val();
      isPacked = $('#isPackedAdd').is(':checked');


      data = {
        pID: pID,
        pBar: pBar,
        pName: pName,
        pBP: pBP,
        pSP: pSP,
        pVal: pVal,
        pCate: pCate,
        pUnit: pUnit,
        subID: subID,
        perPack: perPack,
        paSP: paSP,
        isPacked: isPacked

      }
      if ($('#isPackedAdd').is(':checked')) {
        addPack(data)
      } else {
        addProduct(data)
      }
    })



    //Packed Product
    $('#isPackedEditTable,#isPackedEditGrid, #isPackedAdd').on('change', function() {

      if ($('#isPackedEditTable').is(':checked') && $(this).attr("id") == "isPackedEditTable") {
        $('#managePackEditTable').attr("disabled", false);
        $('#isPackedEditGrid').attr("checked", false);
        $('#managePackEditGrid').attr("disabled", true);
        $('#isPackedAdd').attr("checked", false);
        $('#manageAdd').attr("disabled", true);

        $('#pBPEditTable').attr("disabled", true);
        $('#pSPEditTable').attr("disabled", true);
        $('#pValEditTable').attr("disabled", true);
        $('#pCateEditTable').attr("disabled", true);
      } else if ($(this).attr("id") == "isPackedEditTable") {
        $('#managePackEditTable').attr("disabled", true);
        $('#pBPEditTable').attr("disabled", false);
        $('#pSPEditTable').attr("disabled", false);
        $('#pValEditTable').attr("disabled", false);
        $('#pCateEditTable').attr("disabled", false);

      }

      if ($('#isPackedAdd').is(':checked') && $(this).attr("id") == "isPackedAdd") {
        $('#managePackAdd').attr("disabled", false);
        $('#isPackedEditGrid').attr("checked", false);
        $('#managePackEditGrid').attr("disabled", true);
        $('#isPackedEditTable').attr("checked", false);
        $('#managePackEditTable').attr("disabled", true);

        $('#pBPAdd').attr("disabled", true);
        $('#pSPAdd').attr("disabled", true);
        $('#pValAdd').attr("disabled", true);
        $('#pCateAdd').attr("disabled", true);
      } else if ($(this).attr("id") == "isPackedAdd") {
        $('#managePackAdd').attr("disabled", true);
        $('#pBPAdd').attr("disabled", false);
        $('#pSPAdd').attr("disabled", false);
        $('#pValAdd').attr("disabled", false);
        $('#pCateAdd').attr("disabled", false);

      }

      if ($('#isPackedEditGrid').is(':checked') && $(this).attr("id") == "isPackedEditGrid") {
        console.log("Edit Grid");
        $('#managePackEditGrid').attr("disabled", false);
        $('#isPackedEditTable').attr("checked", false);
        $('#managePackEditTable').attr("disabled", true);
        $('#isPackedAdd').attr("checked", false);
        $('#manageAdd').attr("disabled", true);

        $('#pBPEditGrid').attr("disabled", true);
        $('#pSPEditGrid').attr("disabled", true);
        $('#pValEditGrid').attr("disabled", true);
        $('#pCateEditGrid').attr("disabled", true);
      } else if ($(this).attr("id") == "isPackedEditGrid") {
        $('#managePackEditGrid').attr("disabled", true);
        $('#pBPEditGrid').attr("disabled", false);
        $('#pSPEditGrid').attr("disabled", false);
        $('#pValEditGrid').attr("disabled", false);
        $('#pCateEditGrid').attr("disabled", false);

      }

    });

    $('#managePackEditTable,#managePackEditGrid,#managePackAdd').click(function(event) {
      $('#ppaID').val(pID);
      let id = $(this).attr("id");

      $.ajax({
        url: 'TabManageProduct/selectedPack.php',
        method: 'POST',
        data: {
          pID: pID
        },
        success: function(data) {
          var json = $.parseJSON(data)
          $('#ppaID').val(json[0].paID);
          $('#ppID').val(json[0].pID);
          $('#ppBar').val(json[0].pBar);
          $('#ppaPerPacked').val(json[0].paPerPack)
          $('#ppaBPerOne').val(json[0].pBP);
          subProductVal = json[0].pVal;
          if (id == "managePackEditTable") {
            $('#ppaID').val(pID);
            $('#ppaName').val($('#pNameEditTable').val());
            $('#ppaBPerPack').val($('#pBPEditTable').val());
            $('#ppaSP').val($('#pSPEditTable').val());
            paCate = $('#pCateEditTable').val();

          } else if (id == "managePackEditGrid") {
            $('#ppaID').val(pID);
            $('#ppaName').val($('#pNameEditGrid').val());
            $('#ppaBPerPack').val($('#pBPEditGrid').val());
            $('#ppaSP').val($('#pSPEditGrid').val());
            paCate = $('#pCateEditGrid').val();

          }

        }
      })
    });

    //Select Product For Pack
    var selectDataProductTable = $('#selectProductTable').DataTable({
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
        paCate = selectDataProductTable.row(this).data()['pCate']

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
    });

    $('#ppaSP').on('keyup', function() {
      $('#pSP').val($('#ppaSP').val());
    });

    $('#ppaSave').on('click', function() {
      if ($('#isPackedAdd').is(':checked')) {
        $('#pBPAdd').val($('#ppaBPerPack').val());
        $('#pSPAdd').val($('#ppaSP').val());
        $('#pValAdd').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
        $('#pCateAdd').val(paCate);
      } else if ($('#isPackedEditTable').is(':checked')) {
        $('#pBPEditTable').val($('#ppaBPerPack').val());
        $('#pSPEditTable').val($('#ppaSP').val());
        $('#pValEditTable').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
        $('#pCateEditTable').val(paCate);
      } else if ($('#isPackedEditGrid').is(':checked')) {
        $('#pBPEditGrid').val($('#ppaBPerPack').val());
        $('#pSPEditGrid').val($('#ppaSP').val());
        $('#pValEditGrid').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
        $('#pCateEditGrid').val(paCate);
      }



    });

    //Sub barcode
    $('#subBarcode').on('shown.bs.modal', function() {
      //Table List
      $('#subBarcodeTable').DataTable({
        "destroy": true,
        "ajax": {
          url: "barcodeTable.php",
          method: "POST",
          data: {
            pID: pID
          }
        },
        "columns": [{
            data: 'barcode'
          },
          {
            data: 'detail'
          },
          {
            //delete button
            "render": function(data, type, row, meta) {
              return '<button type="button" class="btn btn-danger delete"></button>';
            }
          }
        ],
      });

      //Add Barcode
      $('#addSubBarcode').on('click', function() {
        $.ajax({
          url: 'TabManageProduct/manageProduct.php',
          method: 'POST',
          data: {
            mode: 'addSubBarcode',
            pID: pID,
            barcode: $('#subBarcodeBarcode').val(),
            detail: $('#subBarcodeDetail').val()
          },
          success: function(data) {
            console.log(data)
            if (data.includes("success")) {
              alert("เพิ่มบาร์โค้ดสำเร็จ")
              $('#subBarcodeTable').DataTable().ajax.reload();
              table.ajax.reload();

            } else {
              alert("บาร์โค้ดมีในระบบแล้ว")
            }
          }
        });
      });

      //Delete Barcode
      $('#subBarcode').on('click', 'button.delete', function() {
        var data = $('#subBarcodeTable').DataTable().row($(this).parents('tr')).data();
        //check row size
        if (data['detail'] != "บาร์โค้ดหลัก" && data['detail'] != "รหัสสินค้า") {
          $.ajax({
            url: 'TabManageProduct/deleteSubBarcode.php',
            method: 'POST',
            data: {
              mode: 'delSubBarcode',
              pID: pID,
              barcode: data['barcode']
            },
            success: function(data) {
              $('#subBarcodeTable').DataTable().ajax.reload();
              console.log(data)
            }
          });
        } else {
          alert("ไม่สามารถลบข้อมูลได้")
        }

      });
    });

    //upload img
    $('#selectImg').change(function(e) {
      imgFile = e.target.files[0];
      var reader = new FileReader();
      reader.onloadend = function() {
        $('#pImgEditTable').attr('src', reader.result);
      }
      reader.readAsDataURL(imgFile);

    });


    function detailBox(mode, type) {
      if (mode == "enable") {
        $('#pBar' + type).attr("disabled", false);
        $('#pName' + type).attr("disabled", false);
        $('#pBP' + type).attr("disabled", false);
        $('#pSP' + type).attr("disabled", false);
        $('#pVal' + type).attr("disabled", false);
        $('#pCate' + type).attr("disabled", false);
        $('#pUnit' + type).attr("disabled", false);
        $('#barManage' + type).attr("disabled", false);

        $('#isPacked' + type).attr("disabled", false);
        $('#formFile' + type).attr("disabled", false);



      } else {
        $('#pID' + type).attr("disabled", true);
        $('#pBar' + type).attr("disabled", true);
        $('#pName' + type).attr("disabled", true);
        $('#pBP' + type).attr("disabled", true);
        $('#pSP' + type).attr("disabled", true);
        $('#pVal' + type).attr("disabled", true);
        $('#pCate' + type).attr("disabled", true);
        $('#pUnit' + type).attr("disabled", true);
        $('#barManage' + type).attr("disabled", true);
        $('#managePack' + type).attr("disabled", true);
        $('#isPacked' + type).attr("disabled", true);
        $('#formFile' + type).attr("disabled", true);

      }
    }

    function loadCateAndUnit() {
      //Load Cate
      $.ajax({
        url: "./ajax/cate.php",
        success: function(data) {

          var json = $.parseJSON(data)
          var strCateSelect = '<option value="" selected>ทั้งหมด</option>'; // variable to store the options
          var strCateDatalist = ''; // variable to store the options

          for (let i = 0; i < json.length; i++) {
            //console.log(json[i].pCate);
            strCateSelect += '<option value="' + json[i].pCate + '">' + json[i].pCate + '</option>';
            strCateDatalist += '<option value="' + json[i].pCate + '" />';

          }
          $('#pCateSelect').html(strCateSelect)
          $('#pCateDatalist').html(strCateDatalist)


        }
      });
      //Load unit
      $.ajax({
        url: "./ajax/unit.php",
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
    }

    function load_product() {
      $.ajax({
        url: "./TabAllProduct/fetch_item.php",
        method: "POST",
        data: {
          menu: 'manageProduct'
        },
        success: function(data) {
          $('#display_item').html(data);
          userList = new List('items', {
            valueNames: ['name', 'cate', 'bars'],
            page: 36,
            pagination: true
          });
        }
      });
    }

    function addProduct(data) {
      let pID = data.pID;

      if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
      } else {
        $.ajax({
          url: "./TabManageProduct/manageProduct.php",
          method: "POST",
          data: {
            mode: "add",
            pID: data.pID,
            pBar: data.pBar,
            pName: data.pName,
            pBP: data.pBP,
            pSP: data.pSP,
            pVal: data.pVal,
            pCate: data.pCate,
            pUnit: data.pUnit,
          },
          success: function(data) {
            if (data.trim() == "success") {
              // table.ajax.reload();
              // load_product();
              detailBox("disable", "Add");
              $('#pSaveEditTable').attr("disabled", true);
              $('#pDelTable').attr("disabled", true);

              if (imgFile != undefined) {
                formData = new FormData();
                if (!!imgFile.type.match(/image.*/)) {
                  formData.append("image", imgFile);
                  formData.append("pID", pID);
                  $.ajax({
                    url: "./TabManageProduct/uploadImg.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                    }
                  });
                } else {
                  alert('รูปภาพไม่ถูกต้อง');
                }
              }

            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("เพิ่มสินค้าไม่สำเร็จ");
            }

          }
        });
      }
    }

    function addPack(data) {
      if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '' || data.subID == '' || data.perPack == '' || data.paSP == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
      } else {
        $.ajax({
          url: "./TabManageProduct/savePack.php",
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
          url: "./TabManageProduct/manageProduct.php",
          method: "POST",
          data: {
            mode: "add",
            pID: data.pID,
            pBar: data.pBar,
            pName: data.pName,
            pBP: data.pBP,
            pSP: data.pSP,
            pVal: data.pVal,
            pCate: data.pCate,
            pUnit: data.pUnit,
            isPacked: 1,
          },
          success: function(data) {
            if (data.trim() == "success") {
              // table.ajax.reload();
              // load_product();
              detailBox("disable", "Add");
              $('#pSaveEditTable').attr("disabled", true);
              $('#pDelTable').attr("disabled", true);
              $('#subButAdd').click()

              alert("เพิ่มสินค้าเรียบร้อย");
            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("เพิ่มสินค้าไม่สำเร็จ");
            }

          }
        });


      }
    }

    function editProduct(data) {
      let pID = data.pID;
      if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
      } else {

        $.ajax({
          url: "./TabManageProduct/manageProduct.php",
          method: "POST",
          data: {
            mode: "edit",
            pID: data.pID,
            pBar: data.pBar,
            pName: data.pName,
            pBP: data.pBP,
            pSP: data.pSP,
            pVal: data.pVal,
            pCate: data.pCate,
            pUnit: data.pUnit,

          },
          success: function(data) {
            console.log(data);
            if (data.trim() == "success") {
              // table.ajax.reload();
              // load_product();
              $('#editProductModal').modal('hide');
              detailBox("disable", "EditTable");
              $('#pSaveEditTable').attr("disabled", true);
              $('#Table').attr("disabled", true);

              if (imgFile != undefined) {
                formData = new FormData();
                if (!!imgFile.type.match(/image.*/)) {
                  formData.append("image", imgFile);
                  formData.append("pID", pID);
                  $.ajax({
                    url: "./TabManageProduct/uploadImg.php",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {

                    }
                  });
                } else {
                  alert('รูปภาพไม่ถูกต้อง');
                }
              }

              alert("บันทึกการแก้ไขสินค้าเรียบร้อย");
            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("บันทึกการแก้ไขสินค้าไม่สำเร็จ");
            }

          }
        });
      }


    }

    function editPack(data) {
      if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '' || data.subID == '' || data.perPack == '' || data.paSP == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
      } else {
        $.ajax({
          url: "./TabManageProduct/savePack.php",
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
          url: "./TabManageProduct/manageProduct.php",
          method: "POST",
          data: {
            mode: "edit",
            pID: data.pID,
            pBar: data.pBar,
            pName: data.pName,
            pBP: data.pBP,
            pSP: data.pSP,
            pVal: data.pVal,
            pCate: data.pCate,
            pUnit: data.pUnit,
            isPacked: 1,
          },
          success: function(data) {
            if (data.trim() == "success") {
              // table.ajax.reload();
              // load_product();
              detailBox("disable", "Add");
              $('#pSaveEditTable').attr("disabled", true);
              $('#pDelTable').attr("disabled", true);
              $('#subButAdd').click()

              alert("เพิ่มสินค้าเรียบร้อย");
            } else if (data.trim() == "duplicate") {
              alert("บาร์โค้ดซ้ำ");
            } else {
              alert("เพิ่มสินค้าไม่สำเร็จ");
            }

          }
        });


      }
    }

    function delProduct(id) {
      $.ajax({
        url: "./TabManageProduct/manageProduct.php",
        method: "POST",
        data: {
          mode: "askDel",
          pID: id,
        },
        success: function(data) {
          if (confirm(data)) {
            $.ajax({
              url: "./TabManageProduct/manageProduct.php",
              method: "POST",
              data: {
                mode: "del",
                pID: id,
              },
              success: function(data) {
                table.ajax.reload();
                load_product();
                detailBox("disable", "EditTable");
                alert(data);

                $('#pIDEditTable').val("")
                $('#pBarEditTable').val("")
                $('#pNameEditTable').val("")
                $('#pBPEditTable').val("")
                $('#pSPEditTable').val("")
                $('#pValEditTable').val("")
                $('#pCateEditTable').val("")
                $('#pUnitEditTable').val("")
              }
            });
          } else {
            alert("ยกเลิกการลบสินค้า");
          }
        }
      });





    }



  });
</script>