<?php
include("system\header.php");
if (!isset($_SESSION['seller'])) {
    echo "<script>window.location.href='index.php';</script>";
}

?>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="row overflow-auto" style="height: 90%;">
    <div class="d-flex col-md-6">
        <?php include("TabManageProduct/allProductGrid.php"); ?>
    </div>
    <div class="d-flex col-md-6">
        <div class="card" style="width: 100%;">
            <div class="card-header sticky-top" style="height: fit-content;">
                <div class="row d-flex justify-content-between align-items-end">
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
            <!-- /.card-header -->
            <div class="card-body overflow-auto position-sticky">
                <div id="cart_details"></div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer position-sticky fixed-bottom" style="height: fit-content;">
                <div class="d-flex btn-group">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#selectCustomer">
                        <i class="fa fa-shopping-cart">เลือกลูกค้า</i>
                    </button>
                    <button type="button" class="btn btn-danger" id="clearCart">
                        <i class="fa fa-shopping-cart">เคลียร์บิล</i>
                    </button>
                    <button type="button" class="btn btn-success" id="note" data-bs-toggle="modal" data-bs-target="#addNote">
                        <i class="fa fa-shopping-cart">เพิ่มโน๊ต</i>
                    </button><button type="button" class="btn btn-success" id="checkBill">
                        <i class="fa fa-shopping-cart">ชำระเงิน</i>
                    </button>
                </div>
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
                            <th scope="col">บ้านเลขที่</th>
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
                    <input type="number" onkeydown="return event.keyCode !== 69" class="form-control text-right income" style="width: 60%; font-size:30px" id="receivePrice">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">บัตรประชารัฐ</label>
                    <input type="number" onkeydown="return event.keyCode !== 69" class="form-control text-right income" style="width: 60%; font-size:30px" id="receivePricePra">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">คนละครึ่ง</label>
                    <input type="number" onkeydown="return event.keyCode !== 69" class="form-control text-right income" style="width: 60%; font-size:30px" id="receivePriceHalf">
                </div>

                <div class="mb-2 row">
                    <label class="display-6" style="width: 40%; color:black;">เงินทอน</label>
                    <label class="col-form-label text-right" id="changePrice" style="width: 60%; font-size:30px;background-color: lightgray;"></label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add To Stock -->
<div class="modal fade" id="addToStock" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="addToStockLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
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
                    </div>

                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-2 row">
                            <label class="col-form-label" style="width: 35%;">จำนวนที่จะเพิ่ม</label>
                            <div class="col" style="width: 70%;">
                                <input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pAddVal" placeholder="จำนวนที่จะเพิ่ม">
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-form-label" style="width: 35%;">ราคาที่ซื้อมา</label>
                            <div class="col" style="width: 70%;">
                                <input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNowBP" placeholder="ราคาที่ซื้อมา">
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="mb-2 row">
                            <label class="col-form-label" style="width: 35%;">ราคาซื้อใหม่</label>
                            <div class="col" style="width: 70%;">
                                <input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNewBP" placeholder="ราคาที่ซื้อใหม่">
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label class="col-form-label" style="width: 35%;">ราคาขายใหม่</label>
                            <div class="col" style="width: 70%;">
                                <input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNewSP" placeholder="ราคาขายใหม่">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" id="saveAddToStock">บันทึก</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $.fn.dataTable.ext.errMode = 'throw';

        var userList;
        var sID = $("input[type=radio][name=saleID]:checked").val()
        var cID = "";
        var totalPrice = 0;
        var date = getThaiDate();
        $('input[type=radio][name=saleID]').change(function() {
            sID = this.value;
            load_cart_data();
        });


        load_product();

        loadCate()

        load_cart_data();


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


        $('#date').text("วันที่ : " + getThaiDate());


        $(document).on('click', '.add_to_cart', function() {

            var product_id = $(this).attr("id");
            var product_quantity = 1;
            var pStock = parseInt($('#' + product_id).attr("value"));
            var action = "add";



            if (product_quantity > 0 && product_quantity <= pStock) {
                $.ajax({
                    url: "TabPOS/posAction.php",
                    method: "POST",
                    data: {
                        sID: sID,
                        cID: "C0001",
                        pID: product_id,
                        quantity: product_quantity,
                        action: action
                    },
                    success: function(data) {
                        load_cart_data();
                        load_product();
                        $('#searchBar').val('');
                    }
                });
            } else {
                alert("จำนวนสินค้าไม่พอ");
            }
        });

        $(document).on('click', '.add_fav', function() {
            //No Fav -> Fav
            var product_id = $(this).attr("value");
            if ($(this).hasClass('btn-secondary')) {
                $(this).children().toggleClass('far fas');
                $(this).toggleClass('btn-primary btn-secondary');
                var action = "addFav";

                $.ajax({
                    url: "TabPOS/posAction.php",
                    method: "POST",
                    data: {
                        pID: product_id,
                        action: action
                    },
                    success: function(data) {
                        load_product();
                    }
                });
            }
            //Fav -> No Fav
            else {
                $(this).children().toggleClass('fas far');
                $(this).toggleClass('btn-secondary btn-primary');

                var action = "removeFav";
                $.ajax({
                    url: "TabPOS/posAction.php",
                    method: "POST",
                    data: {
                        pID: product_id,
                        action: action
                    },
                    success: function(data) {
                        load_product();

                    }
                });
            }


        });

        $(document).on('click', '.delete', function() {
            var product_id = $(this).parent().parent().attr("id");
            var action = 'remove';
            $.ajax({
                url: "TabPOS/posAction.php",
                method: "POST",
                data: {
                    sID: sID,
                    pID: product_id,
                    action: action
                },
                success: function() {
                    load_cart_data();
                    load_product();
                }
            })
        });

        $(document).on('click', '#clearCart', function() {
            var action = 'empty';
            $.ajax({
                url: "TabPOS/posAction.php",
                method: "POST",
                data: {
                    sID: sID,
                    action: action
                },
                success: function() {
                    load_cart_data();
                    load_product();
                    cID = "";

                }
            });
        });

        $(document).on('change', '.quantity', function() {

            //get old value
            var old_quantity = $(this).attr("name");
            var product_id = $(this).parent().parent().attr("id");
            var quantity = parseInt($(this).val());
            var action = 'quantity_change';
            var pStock = parseInt($('#' + product_id).attr("value"));

            if (quantity > 0) {
                $.ajax({
                    url: "TabPOS/posAction.php",
                    method: "POST",
                    data: {
                        sID: sID,
                        pID: product_id,
                        quantity: quantity,
                        action: action
                    },
                    success: function(data) {
                        if (data == 'success') {
                            load_cart_data();
                            load_product();
                        } else {
                            alert("จำนวนสินค้าไม่พอ");
                            $('#' + product_id).val(old_quantity);
                        }
                    }
                });

            } else if (quantity != '' && quantity <= 0) {
                alert("จำนวนสินค้าต้องมากกว่า 0");
                $(this).val(old_quantity);
            }
        });

        $('#searchBar').off().on('keypress', function(e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                var search = $('#searchBar').val() + '"';
                var isHave = false;

                ThaiToEng(search);

                $('.bars').each(function() {
                    if ($(this).text().toLowerCase().indexOf(search.toLowerCase()) > -1) {
                        id = $(this).attr("value");
                        $('#' + id).click();
                        $('#searchBar').val('');
                        isHave = true;
                    }
                });

                if (!isHave) {
                    alert("ไม่พบสินค้า");
                    $('#searchBar').select();

                }
            }
        });

        $(document).on('keypress', function(e) {
            // e.preventDefault();
            //modol show check
            if ($('.modal').is(':visible')) {

            } else {
                $('#searchBar').focus();
                if ($('#searchBar').focus() != true) {
                    $('#searchBar').focus();
                }
            }

        });

        //Thai-English Keyboard Mapping
        function ThaiToEng(string) {

            let eng = "";
            let mapKeyBoardJSON = {
                'ๅ': '1',
                '+': '!',
                '1': '@',
                '/': '2',
                '-': '3',
                '2': '#',
                'ภ': '4',
                '3': '$',
                'ถ': '5',
                '4': '%',
                'ุ': '6',
                'ู': '^',
                'ึ': '7',
                '฿': '&',
                'ค': '8',
                '5': '*',
                'ต': '9',
                '6': '(',
                'จ': '0',
                '7': ')',
                'ข': '-',
                '8': '_',
                'ช': '=',
                '9': '+',
                'ๆ': 'q',
                '0': 'Q',
                'ไ': 'w',
                '"': 'W',
                'ำ': 'e',
                'ฎ': 'E',
                'พ': 'r',
                'ฑ': 'R',
                'ะ': 't',
                'ธ': 'T',
                'ั': 'y',
                'ํ': 'Y',
                'ี': 'u',
                '๊': 'U',
                'ร': 'i',
                'ณ': 'I',
                'น': 'o',
                'ฯ': 'O',
                'ย': 'p',
                'ญ': 'P',
                'บ': '[',
                'ฐ': '{',
                'ล': ']',
                '`': '`',
                'ฃ': '\\',
                'ฅ': '`',
                'ฟ': 'a',
                'ฤ': 'A',
                'ห': 's',
                'ฆ': 'S',
                'ก': 'd',
                'ฏ': 'D',
                'ด': 'f',
                'โ': 'F',
                'เ': 'g',
                'ฌ': 'G',
                '้': 'h',
                '็': 'H',
                '่': 'j',
                '๋': 'J',
                'า': 'k',
                'ษ': 'K',
                'ส': 'l',
                'ศ': 'L',
                'ว': ';',
                'ซ': ':',
                'ง': "'",
                '.': '"',
                'ผ': 'z',
                '(': 'Z',
                'ป': 'x',
                ')': 'X',
                'แ': 'c',
                'ฉ': 'C',
                'อ': 'v',
                'ฮ': 'V',
                'ิ': 'b',
                'ฺ': 'B',
                'ท': 'n',
                '์': 'N',
                'ท': 'm',
                '?': 'M',
                'ม': '`',
                'ฒ': '<',
                'ใ': '.',
                'ฬ': '>',
                'ฝ': '/',
                'ฦ': '?',
            }

            for (let index = 0; index < string.length; index++) {
                const element = string[index];
                if (mapKeyBoardJSON[element] != undefined && 'กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯ/-ขช'.includes(element)) {
                    eng += mapKeyBoardJSON[element];
                } else {
                    eng += element;
                }

            }


            return eng;
        }


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
                    $('#selectCustomer').modal('hide');
                }
            })
        });

        $('#selectCustomer').on('hide.bs.modal', function() {
            selectDataCustomerTable.row('.selected').deselect()
            $("#selectCustomer [type='search']").val("");
        });


        //Note
        $('#addNote').on('shown.bs.modal', function() {
            $('#addNoteVal').focus();
        });

        //checkBill
        $('#checkBill').on('click', function() {
            if (cID == "") {
                alert("กรุณาเลือกลูกค้า");
            } else if (totalPrice == 0) {
                alert("กรุณาเลือกสินค้า");
            } else if (totalPrice < 0) {
                alert("ยอดรวมเป็นลบไม่ได้");
            } else {
                $('#change').modal('show');
            }


        });
        $("#change").on('shown.bs.modal', function() {
            let price = totalPrice;
            let sale = 0;
            let total = (price - (0 - sale)).toFixed(2);
            let change;
            let totalReceive;

            $('#price').html(price);
            $('#salePrice').html(sale);
            $('#totalPriceChange').html(total);
            $('#receivePrice').val("");
            $('#receivePricePra').val("");
            $('#receivePriceHalf').val("");

            $('#receivePrice').focus();
            $("#change").on('keyup', function(e) {
                if (e.keyCode === 13) {
                    bMoney = parseFloat($('#receivePrice').val() - 0);
                    bPra = parseFloat($('#receivePricePra').val() - 0);
                    bHalf = parseFloat($('#receivePriceHalf').val() - 0);
                    totalReceive = parseFloat(bMoney + bPra + bHalf).toFixed(2);
                    $('#receivePrice').val(bMoney.toFixed(2));
                    $('#receivePricePra').val(bPra.toFixed(2));
                    $('#receivePriceHalf').val(bHalf.toFixed(2));
                    change = parseFloat(totalReceive - total).toFixed(2);
                    $('#changePrice').css("color", "black");
                    if (change < 0) {
                        $('#receivePrice').select();
                        $('#changePrice').css("color", "red");
                        $('#changePrice').html(change);
                    } else if (change == $('#changePrice').html()) {
                        let action = 'checkBill';
                        $.ajax({
                            url: "TabPOS/posAction.php",
                            type: "POST",
                            data: {
                                action: action,
                                sID: sID,
                                cID: cID,
                                bDate: getDateTime(),
                                bMoney: bMoney,
                                bPra: bPra,
                                bHalf: bHalf,
                                bDis: 0,
                                bTotal: totalPrice,
                                bNote: $('#addNoteVal').val(),
                            },
                            success: function(result) {
                                if (result.includes("B")) {
                                    $('#changePrice').html(change);
                                    $('#change').modal('hide');
                                    $('#totalPrice').html((-change).toFixed(2) + '฿');
                                    $('#totalPrice').css("color", "red");
                                    $('#discountPrice').css("color", "red");
                                    $('#bill').html("เลขที่บิล : " + result);
                                    $('#checkBill').prop('disabled', true);
                                    $('#note').prop('disabled', true);
                                    load_product();

                                } else {
                                    alert(result);
                                }
                            }
                        });

                    } else {
                        $('#changePrice').html(change);
                    }
                }
            })

        });
        $("#change").on('hide.bs.modal', function() {
            $('#receivePrice').val("");
            $('#receivePricePra').val("");
            $('#receivePriceHalf').val("");
            $('#changePrice').html("");
            $('#change').off('keyup');
        });

        //Add To Stock
        $(document).on('click', '.add_to_stock', function() {

            var product_id = $(this).attr("id");
            var product_quantity = 0;
            var pStock = parseInt($('#' + product_id).attr("value"));
            var action = "addToStock";

            var product_bar = $(this).parent().find('.bar').text()
            var product_name = $(this).parent().find('.name').text()
            var product_BP = $(this).parent().find('.bp').text()
            var product_SP = $(this).parent().find('.sp').text()




            showModal("noSelect");


            let data = {
                pID: product_id,
                pName: product_name,
                pBP: product_BP,
                pSP: product_SP,
                pVal: pStock,
                pBar: product_bar,
            };

            selectProduct(data);
            load_product();


        });

        function getDateTime() {
            var date = new Date();
            var hour = date.getHours();
            hour = (hour < 10 ? "0" : "") + hour;
            var min = date.getMinutes();
            min = (min < 10 ? "0" : "") + min;
            var sec = date.getSeconds();
            sec = (sec < 10 ? "0" : "") + sec;
            var year = date.getFullYear();
            var month = date.getMonth() + 1;
            month = (month < 10 ? "0" : "") + month;
            var day = date.getDate();
            day = (day < 10 ? "0" : "") + day;
            return year + "-" + month + "-" + day + " " + hour + ":" + min + ":" + sec;
        }

        function loadCate() {
            $.ajax({
                url: "TabAddToStock/cate.php",
                success: function(data) {

                    var json = $.parseJSON(data)
                    var str = '<option value="" selected>ทั้งหมด</option>'; // variable to store the options

                    for (let i = 0; i < json.length; i++) {
                        //console.log(json[i].pCate);
                        str += '<option value="' + json[i].pCate + '">' + json[i].pCate + '</option>';
                    }
                    $('#pCateSelect').html(str)

                }
            });
        }

        function load_product() {
            $.ajax({
                url: "TabAllProduct/fetch_item.php",
                method: "POST",
                data: {
                    menu: 'tabPOS'
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

        function load_cart_data() {
            $.ajax({
                url: "TabAllProduct/fetch_cart.php",
                method: "POST",
                data: {
                    sID: sID
                },
                dataType: "json",
                success: function(data) {
                    //console.log(data);
                    $('#cart_details').html(data.cart_details);
                    $('#totalPrice').text(data.total_price + '฿');
                    $('#total').text(data.total_item);
                    $('#bill').text("เลขที่บิล :");
                    $('#customer').text("ลูกค้า : " + data.customer_name);
                    cID = data.customer_id;
                    totalPrice = data.total_price;

                    $('#totalPrice').css("color", "black");
                    $('#discountPrice').css("color", "black");
                    $('#checkBill').prop('disabled', false);
                    $('#note').prop('disabled', false);

                }
            });
        }

        function setCustomer(sID, cID) {
            $.ajax({
                url: "TabPOS/posAction.php",
                method: "POST",
                data: {
                    sID: sID,
                    cID: cID,
                    action: 'setCustomer'
                },
                success: function(data) {}
            });
        }

        function getThaiDate() {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear() + 543;

            if (dd < 10) {
                dd = '0' + dd
            }

            if (mm < 10) {
                mm = '0' + mm
            }

            today = dd + '/' + mm + '/' + yyyy;

            return today;
        }
    });

    //Function dont input Text in thai--
    function isEng(e) {
        //alert(String.fromCharCode(e.keyCode));
        key = e.keyCode;
        e.returnValue = false;
        if ((key > 64 && key < 91) || key == 32 || key == 46) {
            e.returnValue = true;
        } else if ((key > 96 && key < 123) || key == 32 || key == 46) {
            e.returnValue = true;
        } else if (key > 47 && key < 58) {
            e.returnValue = true;
        }
    }
</script>