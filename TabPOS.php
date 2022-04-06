<?php


include("system\header.php");
?>


<div class="container-fluid">
    <div class="card" style="height: 50%;">
        <div class="card-body">
            <div class="row d-flex justify-content-between align-items-end">
                <div class="col align-self-center">
                    <p id="bill" style="height: 5px;">เลขที่บิล : </p>
                    <p id="date" style="height: 5px;">วันที่ : </p>
                    <p id="customer" style="height: 5px;">ลูกค้า : </p>
                </div>
                <div class="col text-right">
                    <span class="display-6" id="discountPrice"></span>
                </div>
                <div class="col text-center">
                    <span class="display-6" id="totalPrice">0.00</span>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    รายการด่วน
                    <a href="#" data-bs-toggle="modal" data-bs-target="#quickList" style="text-align: end;">บันทึก</a>
                    <table class="table table-bordered table-hover display" id="quickListInPOS" style="width:100%;">
                        <thead>
                            <tr>
                                <th scope="col" style="display: none;">รหัสสินค้า</th>
                                <th scope="col">ชื่อสินค้า</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>

        <div class="col-sm-8">
            <div class="card">
                <div class="card-body" id="tableDiv">
                    <table class="table table-bordered table-hover display" id="posTable" style="width:100%">
                        <thead>
                            <th scope="col">
                                <center>รหัสสินค้า</center>
                            </th>
                            <th scope="col">
                                <center>บาร์โค้ดสินค้า</center>
                            </th>
                            <th scope="col">
                                <center>ชื่อสินค้า</center>
                            </th>
                            <th scope="col">
                                <center>ราคา</center>
                            </th>
                            <th scope="col">
                                <center>จำนวน</center>
                            </th>
                            <th scope="col">
                                <center>ราคารวม</center>
                            </th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <div class="col-sm-2">
            <div class="card">
                <div class="card-body">
                    <div class="div">
                        <div class=" form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saleID" id="s1" value="s1" checked>
                            <label class="form-check-label" for="s1">1</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saleID" id="s2" value="s2">
                            <label class="form-check-label" for="s2">2</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saleID" id="s3" value="s3">
                            <label class="form-check-label" for="s3">3</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saleID" id="s4" value="s4">
                            <label class="form-check-label" for="s4">4</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="saleID" id="s5" value="s5">
                            <label class="form-check-label" for="s5">แก้ไข</label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary mb-1" style="width: 10rem;" id="printBill">พิมพ์บิล</button>
                    <button type="button" class="btn btn-secondary mb-1" style="width: 10rem;" data-bs-toggle="modal" data-bs-target="#addNote">เพิ่มหมายเหตุ</button>
                    <button type="button" class="btn btn-secondary mb-1" style="width: 10rem;" data-bs-toggle="modal" data-bs-target="#addToStock">รับสินค้าเข้าสต็อก</button>
                    <button type="button" class="btn btn-primary mb-1" style="width: 10rem;" data-bs-toggle="modal" data-bs-target="#selectCustomer">เลือกรายชื่อลูกค้า</button>
                    <button type="button" class="btn btn-primary mb-1" style="width: 10rem;" data-bs-toggle="modal" data-bs-target="#selectProduct">เลือกรายการสินค้า</button>
                    <button type="button" class="btn btn-danger mb-1" style="width: 10rem;" id="clearPOS">เคลียร์บิล</button>
                    <button type="button" class="btn btn-success mb-1" style="width: 10rem;" id="cashier">ชำระเงิน</button>
                </div>
            </div>

        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-2">

                </div>

                <div class="col-sm-6">
                    <button type="button" class="btn btn-warning mx-2" id="sDiscount" disabled>ส่วนลด</button>
                    <button type="button" class="btn btn-secondary mx-2" id="sEditVal" disabled>แก้ไขจำนวนขาย</button>
                    <button type="button" class="btn btn-danger mx-2" id="sDel" disabled>ยกเลิกสินค้า</button>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" style="width: 15rem;" id="searchBarOrID" placeholder="รหัสสินค้า/บาร์โค้ดสินค้า" autofocus autocapitalize="characters">
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Add To Stock -->
<div class="modal fade" id="addToStock" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addToStockLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addToStockLabel">รับสินค้าเข้าสต๊อก</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
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
                                <input type="text" class="form-control " id="pCateA2S" placeholder="หมวดหมู่" disabled>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-form-label" style="width:30%;">หน่วยนับ</label>
                            <div class="col" style="width:70%;">
                                <input type="text" class="form-control " id="pUnitA2S" placeholder="หน่วยนับ" disabled>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveAdd">บันทึก</button>
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

<!-- Select Customer -->
<div class="modal fade" id="selectCustomer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="selectCustomerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="selectCustomerLabel">เลือกสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover display" id="selectCustomerTable" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">บ้านาเลขที่</th>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">นามสกุล</th>
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

<!-- Edit Val-->
<div class="modal fade" id="editVal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editValLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="editValLabel">แก้ไขจำนวนสินค้า</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" class="form-control" id="editValInput" placeholder="ระบุจำนวนสินค้า">
            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-success" id="editSubmit">ตกลง</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
                </center>

            </div>
        </div>
    </div>
</div>

<!-- Add Note -->
<div class="modal fade" id="addNote" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteLabel">เพิ่มหมายเหตุ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="addNoteVal" rows="3" placeholder="เพิ่มหมายเหตุ..."></textarea>

            </div>
            <div class="modal-footer">
                <center>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">ตกลง</button>
                </center>

            </div>
        </div>
    </div>
</div>

<!-- Change Modal -->
<div class="modal fade" id="change" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="changeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="changeLabel">ชำระเงิน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">ยอดรวม</label>
                    <label class="col-form-label bg-light text-right" id="price" style="width: 60%; font-size:30px"></label>
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">ส่วนลด</label>
                    <label class="col-form-label bg-light text-right" id="salePrice" style="width: 60%; font-size:30px"></label>
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:red;">ยอดสุทธิ</label>
                    <label class="col-form-label bg-light text-right" id="totalPriceChange" style="width: 60%; font-size:30px"></label>
                </div>

                <hr>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">เงินสด</label>
                    <input type="number" class="form-control text-right" style="width: 60%; font-size:30px" id="receivePrice">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">บัตรประชารัฐ</label>
                    <input type="number" class="form-control text-right" style="width: 60%; font-size:30px" id="receivePricePra">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">คนละครึ่ง</label>
                    <input type="number" class="form-control text-right" style="width: 60%; font-size:30px" id="receivePriceHalf">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">เงินทอน</label>
                    <label class="col-form-label bg-light text-right" id="changePrice" style="width: 60%; font-size:30px"></label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick List -->
<div class="modal fade" id="quickList" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="quickListLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="quickListLabel">เลือกสินค้ารายการด่วน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="height: 100%;">
                    <div class="col-5">
                        <table class="table table-bordered table-hover display" id="quickListInModal" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-2 align-self-center">
                        <div class="row">
                            <button type=" button" class="btn btn-success mb-3" id="addToQuickList">
                                << เพิ่ม << </button>
                                    <button type=" button" class="btn btn-danger mb-5" id="delFromQuickList">>> ลบ >> </button>
                                    <button type=" button" class="btn btn-warning mb-3" id="upQuickList">เลื่อนขึ้น</button>
                                    <button type=" button" class="btn btn-warning" id="downQuickList">เลื่อนลง</button>
                        </div>
                    </div>
                    <div class="col-5">
                        <table class="table table-bordered table-hover display" id="quickListSelectProduct" style="width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">รหัสสินค้า</th>
                                    <th scope="col">ชื่อสินค้า</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
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
</body>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        //"paging": false

    });
    $.fn.dataTable.isDataTable()
    $.fn.dataTable.ext.errMode = 'throw';

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear() + 543;

    today = dd + '/' + mm + '/' + yyyy;
    $('#date').html($('#date').html() + today);

    $(document).ready(function() {
        var sID = $("input[type=radio][name=saleID]:checked").val();
        var cID = "";
        var bMoney = "";
        var bPra = "";
        var bHalf = "";
        var bTotal = "";
        var bDis = "";
        var pID = "";
        var oldVal = "";
        var isCal = false;
        var productData;

        $('#searchBarOrID').focus();
        sendSaleSession(sID);
        getCustomer(sID);

        var check = "<?php echo (isset($_SESSION['fromEdit']));
                        //unset($_SESSION['fromEdit']); ?>";
        if (check) {
            $('input[type=radio][name=saleID][value=s5]').click();
            sID = $("input[type=radio][name=saleID]:checked").val();
            sendSaleSession(sID);
            getCustomer(sID)
            bIDEdit = "<?php if (isset($_SESSION['bIDEdit'])) {
                            echo $_SESSION['bIDEdit'];
                        } ?>";
            $('#cashier').html("บันทึกการแก้ไข")
            $('#bill').html("เลขที่บิล : " + bIDEdit);
        }

        //POS Table
        var posDataTable = $('#posTable').DataTable({
            "retrieve": true,
            "processing": true,
            "ajax": {
                "url": "TabPOS/nowBill.php"
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
                    data: 'pTotal'
                },
            ],

            deferRender: true,
            scrollY: 300,
            scrollCollapse: true,
            scroller: true,
            select: 'single',
            select: {
                toggleable: false
            },
            searching: false,

            "language": {
                "infoEmpty": " ",
                "loadingRecords": " ",
                "processing": " ",
                "zeroRecords": "ไม่มีสินค้า"
            },
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;

                bTotal = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        return parseInt(a) + parseInt(b);
                    }, 0);
                bDis = api
                    .column(5)
                    .data()
                    .reduce(function(a, b) {
                        let total = 0
                        if (parseInt(a) <= 0 && parseInt(b) <= 0) {
                            total = parseInt(a) + parseInt(b)
                        }
                        return total;
                    }, 0);

                $('#totalPrice').html(bTotal.toFixed(2));
                $('#discountPrice').html(bDis.toFixed(2));
                $('#sDiscount').attr("disabled", true);
                $('#sEditVal').attr("disabled", true);
                $('#sDel').attr("disabled", true);
                $('#searchBarOrID').focus();
            }
        });

        posDataTable.ajax.reload(function(json) {
            $('#searchBarOrID').focus();
        });

        $('input[type=radio][name=saleID]').change(function() {
            sID = this.value;
            sendSaleSession(sID)
            getCustomer(sID)
            $('#cashier').html("ชำระเงิน")
            if (sID == "s5") {
                $('#cashier').html("บันทึกการแก้ไข")
                var check1 = "<?php if (isset($_SESSION['bIDEdit'])) {
                                    echo 1;
                                } ?>";
                if (check1) {
                    bIDEdit = "<?php if (isset($_SESSION['bIDEdit'])) {
                                    echo $_SESSION['bIDEdit'];
                                } ?>";
                    $('#bill').html("เลขที่บิล : " + bIDEdit);
                } else {
                    $('#cashier').attr("disabled", true);

                }

            } else {
                $('#bill').html("เลขที่บิล : ");
            }
        });

        $('#posTable tbody').off().on('click', 'tr', function() {
            pID = posDataTable.row(this).data();
            oldVal = parseInt(posDataTable.row(this).data()['pVal']);
            $('#searchBarOrID').focus();

            if (!isCal) {
                $('#sDiscount').attr("disabled", false);
                $('#sEditVal').attr("disabled", false);
                $('#sDel').attr("disabled", false);
            }

            $('#sEditVal').on('click', function(e) {
                //console.log(pID['pID'])
                $('#editVal').modal('show');
                $("#editVal").on('shown.bs.modal', function() {

                    $('#editValInput').val("");
                    $('#editValInput').focus();
                });
                $('#sEditVal').off('click');
            });
            var first = true;
            if (first) {
                $('#editSubmit').one('click', function(e) {
                    first = false;
                    let newVal = parseInt($('#editValInput').val());
                    if (oldVal == newVal || $('#editValInput').val() == "") {
                        $('#editValInput').val("");
                        $('#editVal').modal('hide');
                    } else {
                        $('#editVal').modal('hide');
                        editVal(pID['pID'], newVal);
                    }
                })
            }
            $('#editValInput').on('keyup', function(e) {
                if (e.which == 13) {
                    $('#editSubmit').click();
                }
            });

            $('#sDel').click(function() {
                delPOS(pID['pID'])
            })
        });

        $('#searchBarOrID').off().on('keyup', function(e) {
            if (e.keyCode == 13) {
                //alert($('#searchBarOrID').val())
                addToPOS($('#searchBarOrID').val());
                $('#searchBarOrID').focus();
            }
        });

        $('#searchBarOrID').change(function() {
            $('#searchBarOrID').focus();
        })

        $('#clearPOS').on('click', function(e) {
            clearPOS()
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
            pID = selectDataProductTable.row(this).data()['pID'];
            //var pVal = selectDataProductTable.row(this).data()['pID'];
            addToPOS(pID);
            $('#selectProduct').modal('hide');

        });

        $('#selectProduct').on('shown.bs.modal', function() {
            selectDataProductTable.ajax.reload()
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

        //Select Customer
        var selectDataCustomerTable = $('#selectCustomerTable').DataTable({
            "ajax": "ajax/customer.php",
            "columns": [{
                    data: 'cHouse'
                },
                {
                    data: 'cName'
                },
                {
                    data: 'cSer'
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

        $('#selectCustomerTable tbody').on('dblclick', 'tr', function(row, data, index) {

            cID = selectDataCustomerTable.row(this).data()['cID']
            $('#customer').html("ลูกค้า : " + selectDataCustomerTable.row(this).data()['cName'])
            setCustomer(sID, cID)
            sendSaleSession(sID, cID)
            $('#selectCustomer').modal('hide');

        });

        $('#selectCustomer').on('shown.bs.modal', function() {
            selectDataCustomerTable.ajax.reload();
            selectDataCustomerTable.columns.adjust();
            $("#selectCustomer [type='search']").focus();
            selectDataCustomerTable.on('search.dt', function() {
                selectDataCustomerTable.row(':eq(0)', {
                    page: 'current'
                }).select();
            });

            $('#selectCustomer').on('keyup', function(e) {
                if (e.keyCode === 13) {
                    cID = selectDataCustomerTable.row('.selected').data()['cID']
                    $('#customer').html("ลูกค้า : " + selectDataCustomerTable.row('.selected').data()['cName'])
                    setCustomer(sID, cID)
                    sendSaleSession(sID, cID)
                    $('#selectCustomer').modal('hide');
                }
            })
        });

        $('#selectCustomer').on('hide.bs.modal', function() {
            selectDataCustomerTable.row('.selected').deselect()
            $("#selectCustomer [type='search']").val("");
        });

        //Add Product
        var addProductDataTable = $('#addProductTable').DataTable({
            "processing": true,
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

        $('#addToStock').on('shown.bs.modal', function() {
            addProductDataTable.columns.adjust();

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
                    url: "TabManageProduct/manageProduct.php",
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

        //Calculate
        $('#cashier').on('click', function() {
            if (sID === "s5") {
                editBill(posDataTable.rows().data())
            } else if (posDataTable.data().any() && !isCal) {
                if (bTotal < 0) {
                    alert("ไม่สามารถขายสินค้าติดลบได้")
                } else {
                    $('#change').modal('show');
                }

            }

            $("#change").on('shown.bs.modal', function() {
                let price = bTotal.toFixed(2);
                let sale = bDis.toFixed(2);
                let total = (price - (0 - sale)).toFixed(2);
                let change;
                let totalReceive;


                $('#price').html(price);
                $('#salePrice').html(sale);
                $('#totalPriceChange').html(total);
                $('#receivePrice').val("");
                $('#receivePrice').focus();
                $("#change").on('keyup', function(e) {
                    if (e.keyCode === 13) {
                        bMoney = parseFloat($('#receivePrice').val() - 0);
                        bPra = parseFloat($('#receivePricePra').val() - 0);
                        bHalf = parseFloat($('#receivePriceHalf').val() - 0);
                        totalReceive = (bMoney + bPra + bHalf).toFixed(2);
                        $('#receivePrice').val(bMoney.toFixed(2));
                        $('#receivePricePra').val(bPra.toFixed(2));
                        $('#receivePriceHalf').val(bHalf.toFixed(2));
                        change = (totalReceive - total).toFixed(2);
                        $('#changePrice').css("color", "black");
                        if (change < 0) {
                            $('#receivePrice').select();
                            $('#changePrice').css("color", "red");
                            $('#changePrice').html(change);
                        } else if (change == $('#changePrice').html()) {
                            $('#changePrice').html(change);
                            $('#change').modal('hide');
                            $('#totalPrice').html((-change).toFixed(2));
                            $('#totalPrice').css("color", "red");
                            $('#discountPrice').css("color", "red");
                            insertBill(posDataTable.rows().data())

                        } else {
                            $('#changePrice').html(change);
                        }
                    }
                })
            });
            $("#change").on('hide.bs.modal', function() {
                $('#changePrice').html("")
                $('#receivePrice').val("");
                $("#change").off();
            })


        })

        $('#printBill').on('click', function() {
            print()
        })

        //Quick List
        var quickListSelectProduct = $('#quickListSelectProduct').DataTable({
            "ajax": "ajax/product.php",
            "columns": [{
                    data: 'pID'
                },
                {
                    data: 'pName'
                }
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

        var quickListInModal = $('#quickListInModal').DataTable({
            "ajax": "TabPOS/quickList.php",
            "columns": [{
                    data: 'id'
                },
                {
                    data: 'pName'
                }
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
            "language": {
                "infoEmpty": " ",
                "loadingRecords": " ",
                "processing": " ",
                "zeroRecords": "ไม่มีสินค้า"
            },
            "stateSave": true,
            "searching": false,
            "ordering": false
        });

        var quickListInPOS = $('#quickListInPOS').DataTable({
            "ajax": "TabPOS/quickList.php",
            "columns": [{
                    data: 'pID'
                },
                {
                    data: 'pName'
                }
            ],
            "columnDefs": [{

                targets: 0,
                visible: false

            }],
            deferRender: true,
            scrollY: 300,
            scrollCollapse: true,
            scroller: true,
            select: {
                style: 'single',
                select: true,
                toggleable: false
            },
            "language": {
                "infoEmpty": " ",
                "loadingRecords": " ",
                "processing": " ",
                "zeroRecords": "ไม่มีสินค้า"
            },
            "stateSave": true,
            "searching": false,
            "ordering": false
        });

        $('#quickListInPOS tbody').on('dblclick', 'tr', function(row, data, index) {
            pID = quickListInPOS.row(this).data()['pID'];
            //var pVal = selectDataProductTable.row(this).data()['pID'];
            addToPOS(pID);

        });

        $('#addToQuickList').on('click', function() {
            let pID1 = quickListSelectProduct.row('.selected').data()['pID']
            addToQuickList(pID1)
        })

        $('#delFromQuickList').on('click', function() {
            let ID = quickListInModal.row('.selected').data()['id']
            delFromQuickList(ID)
        })

        $('#upQuickList').on('click', function() {
            let ID = quickListInModal.row('.selected').data()['id']
            if (ID != 1) {
                changeQuickList(ID, "up")
            }

        })

        $('#downQuickList').on('click', function() {
            let ID = quickListInModal.row('.selected').data()['id']
            if (ID != quickListInModal.rows().data().length) {
                changeQuickList(ID, "down")
            }

        })

        $('#quickList').on('shown.bs.modal', function() {
            quickListSelectProduct.columns.adjust();
            quickListInModal.columns.adjust();
            quickListInPOS.columns.adjust();
        });

        $('#quickList').on('hide.bs.modal', function() {
            quickListSelectProduct.row('.selected').deselect()
            quickListInModal.row('.selected').deselect()
        });

        function print() {
            var tr = ""
            for (let i = 0; i < posDataTable.rows().data().length; i++) {
                let data = posDataTable.rows(i).data()[0]
                let name = data.pName
                let val = data.pVal
                let price = data.pSP
                let total = data.pTotal
                tr = tr + '<tr>\
                            <td style="text-align:left">' + name + '</td>\
                            <td style="text-align:center">' + val + '</td>\
                            <td style="text-align:center">' + price + '</td>\
                            <td style="text-align:center">' + total + '</td>\
                        </tr>'

            }

            var str = ' <table class="table text-center" style="width:100%">\
                            <thead>\
                                <tr>\
                                <th>สินค้า</th>\
                                <th>จำนวน</th>\
                                <th>ราคาต่อชิ้น</th>\
                                <th>ราคารวม</th>\
                                </tr>\
                            </thead>\
                            <tbody>' + tr + '\
                            </tbody>\
                        </table>';

            //var divContents = document.getElementById("tableDiv").innerHTML;
            //var a = window.open('', '', 'height=500, width=500');
            var a = window.open('');
            a.document.write('<html>');
            a.document.write('<body style="width:200px"> ');
            a.document.write(str);
            a.document.write('</body></html>');
            a.print();
            a.document.close();
        }

        function addToPOS(pID) {
            $('#totalPrice').css("color", "black");
            console.log(isCal)
            if (isCal) {
                clearPOS();
            }
            $.ajax({
                url: "TabPOS/addToPOS.php",
                method: "POST",
                data: {
                    pIDAdd: pID, 
                    sIDNow: sID,
                },
                success: function(data) {
                    $('#posTable').DataTable().ajax.reload();
                    if (data == -1) {
                        alert("ไม่พบสินค้า");
                        $('#searchBarOrID').val("");
                    } else if (data == -2) {
                        alert("สินค้าไม่พอ");
                        $('#searchBarOrID').val("");
                    } else if (data == 2) {
                        alert("สินค้าถึงจุดสั่งซื้อ");
                        $('#searchBarOrID').val("");
                    }

                    //console.log(data)
                    $('#searchBarOrID').val("");
                    $('#searchBarOrID').focus();
                    setCustomer(sID, cID);

                }
            });
        }

        function editVal(pID, newVal) {
            $.ajax({
                url: "TabPOS/editValPOS.php",
                method: "POST",
                data: {
                    sID: sID,
                    pID: pID,
                    newVal: newVal
                },
                beforeSend: function() {
                    $('#editValInput').val("");
                    $('#editVal').modal('hide');
                },
                success: function(data) {
                    if (data == -2) {
                        alert("สินค้าไม่พอ");
                    }

                    $('#posTable').DataTable().ajax.reload();
                }
            });
        }

        function delPOS(pID) {
            $.ajax({
                url: "TabPOS/delPOS.php",
                method: "POST",
                data: {
                    sID: sID,
                    pID: pID,
                },
                success: function(data) {
                    $('#posTable').DataTable().ajax.reload();
                }
            });
        }

        function clearPOS() {
            $.ajax({
                url: "TabPOS/clearPOS.php",
                method: "POST",
                data: {
                    sID: sID
                },
                success: function(data) {
                    //$('#customer').html("ลูกค้า : " + "ลูกค้าทั่วไป ไม่ลงหุ้น")
                    getCustomer(sID);
                    $('#posTable').DataTable().ajax.reload();
                }
            });
        }

        function sendSaleSession(sID1) {
            $.ajax({
                url: "TabPOS/nowBill.php",
                method: "POST",
                data: {
                    sID: sID1
                },
                success: function(data) {
                    $('#posTable').DataTable().ajax.reload();
                }
            });

        }

        function getCustomer(sID) {

            $.ajax({
                url: "TabPOS/getcID.php",
                method: "POST",
                data: {
                    sID: sID,
                },
                success: function(data) {
                    cID = data
                    setCustomer(sID, cID)
                }
            });

        }

        function setCustomer(sID, cID) {

            $.ajax({
                url: "TabPOS/setCustomer.php",
                method: "POST",
                data: {
                    sID: sID,
                    cID: cID
                },
                success: function(data) {
                    isCal = false;
                    $('#customer').html("ลูกค้า : " + data)
                    //alert(data)
                }
            });
        }

        function insertBill(posArray) {
            //Insert Bill
            $.ajax({
                url: "TabPOS/insertBill.php",
                method: "POST",
                data: {
                    sID: sID,
                    cID: cID,
                    bMoney: bMoney,
                    bPra: bPra,
                    bHalf: bHalf,
                    bTotal: bTotal,
                    bDis: bDis,
                    note: $('#addNoteVal').val()
                },
                success: function(data) {
                    isCal = true;
                    $('#addNoteVal').val("")
                    $('#sDiscount').attr("disabled", true);
                    $('#sEditVal').attr("disabled", true);
                    $('#sDel').attr("disabled", true);
                    var bID = data.trim();
                    $('#bill').html("เลขที่บิล : " + data);

                    //Insert BillDetail And Restock
                    for (let i = 0; i < posArray.length; i++) {
                        let data = posDataTable.rows(i).data()[0]
                        $.ajax({
                            url: "TabPOS/insertBillDetail.php",
                            method: "POST",
                            data: {
                                bID: bID,
                                cID: cID,
                                bpID: data.pID,
                                bpName: data.pName,
                                bpVal: data.pVal,
                                bpSP: data.pSP,
                            },
                        });

                    }
                }
            });
        }

        function editBill(posArray) {
            //Insert Bill
            $.ajax({
                url: "TabPOS/billEditDelete.php",
                method: "POST",
                data: {
                    sID: sID,
                    cID: cID,
                    total: bTotal,
                    note: $('#addNoteVal').val()
                },
                success: function(data) {
                    isCal = true;
                    $('#addNoteVal').val("")
                    $('#sDiscount').attr("disabled", true);
                    $('#sEditVal').attr("disabled", true);
                    $('#sDel').attr("disabled", true);
                    var bID = data.trim();
                    $('#bill').html("เลขที่บิล : " + data);

                    //Insert BillDetail And Restock
                    for (let i = 0; i < posArray.length; i++) {
                        let data = posDataTable.rows(i).data()[0]
                        $.ajax({
                            url: "TabPOS/insertBillDetail.php",
                            method: "POST",
                            data: {
                                bID: bID,
                                cID: cID,
                                bpID: data.pID,
                                bpName: data.pName,
                                bpVal: data.pVal,
                                bpSP: data.pSP,
                            },
                        });

                    }

                    alert("แก้ไขสำเร็จ")
                    $('#cashier').attr("disabled", true);
                }
            });
        }

        function getProductArr() {
            $.ajax({
                url: "TabManageProduct/product.php",
                async: false,
                success: function(data) {
                    productData = data;
                }
            });

        }

        function addToQuickList(pID) {
            $.ajax({
                url: "TabPOS/addToQuickList.php",
                method: "POST",
                data: {
                    pID: pID,
                },
                success: function(data) {
                    quickListInModal.ajax.reload();
                    quickListInPOS.ajax.reload();
                }
            });
        }

        function delFromQuickList(ID) {
            $.ajax({
                url: "TabPOS/delFromQuickList.php",
                method: "POST",
                data: {
                    ID: ID,
                },
                success: function(data) {
                    quickListInModal.ajax.reload();
                    quickListInPOS.ajax.reload();
                }
            });
        }

        function changeQuickList(ID, status) {
            $.ajax({
                url: "TabPOS/changeQuickList.php",
                method: "POST",
                data: {
                    ID: ID,
                    status: status,
                },
                success: function(data) {
                    quickListInModal.ajax.reload(function() {
                        quickListInModal.row([data - 1]).select();
                        quickListInPOS.ajax.reload();
                    });


                }
            });
        }

    });
</script>