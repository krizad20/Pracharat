<?php
include("system\header.php");

?>

<body>

    <div class="container-fluid">
        <h5>&nbsp;&nbsp;&nbsp;&nbsp;เลือกการค้นหา</h5>
        <div class="row mb-2">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input my-2" type="radio" name="flexRadioDefault" id="byDay" value="byDay" checked>
                    <label class="form-check-label" for="byDay">รายวัน</label>
                    <input type="date" size="10" id="datepicker_day" name="">
                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input my-2" type="radio" name="flexRadioDefault" id="byMonth" value="byMonth">
                    <label class="form-check-label" for="byMonth">รายเดือน</label>
                    <input type="month" size="10" id="datepicker_month" name="">
                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input my-2" type="radio" name="flexRadioDefault" id="byYear" value="byYear">
                    <label class="form-check-label" for="byYear">รายปี</label>
                    <input type="number" id="datepicker_year" style="width: fit-content;" value="">
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input my-2" type="radio" name="flexRadioDefault" id="byRange" value="byRange">
                    <label class="form-check-label" for="byRange">ช่วงเวลา ตั้งแต่</label>
                    <input type="date" size="10" id="datepicker_day_from" name="">
                    <label class="form-check-label" for="byRange">ถึง</label>
                    <input type="date" size="10" id="datepicker_day_to" name="">
                </div>
            </div>

        </div>

        <div class="row mb-2">
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tableType" id="allCustomer" value="allCustomer" checked>
                    <label class="form-check-label" for="allCustomer">แสดงรายการลูกค้า</label>

                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tableType" id="allBill" value="allBill">
                    <label class="form-check-label" for="allBill">แสดงบิลทั้งหมด</label>
                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tableType" id="addToStock" value="addToStock">
                    <label class="form-check-label" for="addToStock">รายงานสินค้าเข้า</label>
                </div>
            </div>

            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="tableType" id="productReport" value="productReport">
                    <label class="form-check-label" for="productReport">รายงานแยกตามสินค้า</label>
                </div>
            </div>

            <div class="col">
                <button type="button" class="btn btn-success mx-3" onclick="" id="searchButton">ค้นหา</button>
                <button type="button" class="btn btn-success mx-3" onclick="" id="toExcelButton">พิมพ์ XLSX</button>
            </div>

        </div>

        <div class="row mb-2" id="allBillRow" style="display: none;">
            <div class="row mb-2">
                <table id="allBillTable" class="table table-bordered">
                    <thead>
                        <th>วันที่ขาย</th>
                        <th>เลขที่บิลขาย</th>
                        <th>บ้านเลขที่</th>
                        <th ">ชื่อลูกค้า</th>
                        <th >รหัสสินค้า</th>
                        <th ">ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาขาย</th>
                        <th>ต้นทุน</th>
                        <th>กำไร</th>
                        <th>จัดการ</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>

            <div class="row">
                <p id="totalCost">ต้นทุนรวม</p>
                <p id="totalSale">ยอดขายทั้งหมด</p>
                <p id="totalProfit">กำไรรวม</p>
            </div>
        </div>

        <div class="row mb-2" id="allCustomerRow" style="display: none;">
            <div class="row mb-3">
                <table id="allCustomerTable" class="table table-bordered">
                    <thead>
                        <th style="width: 20%;">รหัสลูกค้า</th>
                        <th style="width: 20%;">บ้านเลขที่</th>
                        <th style="width: 40%;">ชื่อ-นามสกุล</th>
                        <th style="width: 20%;">ยอดซื้อสินค้า</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mb-2" id="addToStockRow" style="display: none;">
            <div class="row mb-3">
                <table id="addToStockTable" class="table table-bordered">
                    <thead>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">จำนวนนำเข้า</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mb-2" id="productReportRow" style="display: none;">
            <div class="row mb-3">
                <table id="productReportTable" class="table table-bordered">
                    <thead>
                        <th scope="col">รหัสสินค้า</th>
                        <th scope="col">ชื่อสินค้า</th>
                        <th scope="col">จำนวนที่ขายได้</th>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        "paging": false
    });

    $(document).ready(function() {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear() + 543;

        var date = yyyy + '-' + mm + '-' + dd;
        var month = yyyy + '-' + mm;
        var year = yyyy;
        $('#datepicker_day').val(date)
        $('#datepicker_month').val(month)
        $('#datepicker_year').val(year)
        $('#datepicker_day_from').val(date)
        $('#datepicker_day_to').val(date)

        $('#searchButton').on('click', function() {
            modeSelect($('input[type=radio][name=flexRadioDefault]:checked').val())
        })

    })

    function modeSelect(mode) {
        //byDay
        //byMonth
        //byYear
        //byRange
        let selectedDate;
        let dateFrom;
        let dateTo;
        if (mode == "byDay") {
            selectedDate = $('#datepicker_day').val().split("-");
            //console.log(selectedDate)
            dateFrom = selectedDate[0] - 543 + "-" + selectedDate[1] + "-" + selectedDate[2];
            dateTo = dateFrom;
        } else if (mode == "byMonth") {
            selectedDate = $('#datepicker_month').val().split("-");
            //console.log(selectedDate)
            dateFrom = selectedDate[0] - 543 + "-" + selectedDate[1] + "-01";
            dateTo = selectedDate[0] - 543 + "-" + selectedDate[1] + "-31";
        } else if (mode == "byYear") {
            selectedDate = $('#datepicker_year').val();
            //console.log(selectedDate)
            dateFrom = selectedDate - 543 + "-01-01";
            dateTo = selectedDate - 543 + "-12-31";
        } else if (mode == "byRange") {
            selectedDateFrom = $('#datepicker_day_from').val().split("-");
            selectedDateTo = $('#datepicker_day_to').val().split("-");
            //console.log(selectedDate)
            dateFrom = selectedDateFrom[0] - 543 + "-" + selectedDateFrom[1] + "-" + selectedDateFrom[2];
            dateTo = selectedDateTo[0] - 543 + "-" + selectedDateTo[1] + "-" + selectedDateTo[2];

        }


        console.log(mode)
        console.log(dateFrom)
        console.log(dateTo)
        tableSelect($('input[type=radio][name=tableType]:checked').val(), dateFrom, dateTo);

    }

    function tableSelect(table, dateFrom, dateTo) {
        //allCustomer
        //allBill
        if (table == "allBill") {
            $('#allBillRow').css("display", "block");
            $('#allCustomerRow').css("display", "none");
            $('#addToStockRow').css("display", "none");
            $('#productReportRow').css("display", "none");

            $('#allBillTable').DataTable().destroy();
            $('#allBillTable').DataTable({
                "serverSide": true,
                "processing": true,
                "ajax": {
                    "url": "TabReport/allBill.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    },
                },
                "columns": [{
                        data: 'bDate'
                    },
                    {
                        data: 'bID'
                    },
                    {
                        data: 'cHouse'
                    },
                    {
                        data: 'cName'
                    },
                    {
                        data: 'bpID'
                    },
                    {
                        data: 'bpName'
                    },
                    {
                        data: 'bpVal'
                    },
                    {
                        data: 'bpSP'
                    },
                    {
                        data: 'bpBP'
                    },
                    {
                        data: 'profit'
                    },
                    {
                        "data": null,
                        "defaultContent": "<button>แก้ไข</button>"
                    },
                ],
                scrollY: 400,
                scroller: true,

                "language": {
                    "infoEmpty": " ",
                    "loadingRecords": "",
                    "processing": "",
                    "emptyTable": " ",
                },
                rowGroup: {
                    dataSrc: 'bID'
                },
            });

            $('#allBillTable tbody').one('click', 'button', function() {
                //var data = table.row($(this).parents('tr')).data();
                alert("กดแล้ว");
            });

        } 
        else if(table == "allCustomer") {
            $('#allBillRow').css("display", "none");
            $('#allCustomerRow').css("display", "block");
            $('#addToStockRow').css("display", "none");
            $('#productReportRow').css("display", "none");

            $('#allCustomerTable').DataTable().destroy();
            $('#allCustomerTable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "allCus.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    },
                },
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
                        data: 'total'
                    }
                ],
                scrollY: 400,
                scroller: true,

                "language": {
                    "infoEmpty": " ",
                    "loadingRecords": "",
                    "processing": "",
                    "emptyTable": " ",
                },
            });
        }
        else if(table == "addToStock") {
            $('#allBillRow').css("display", "none");
            $('#allCustomerRow').css("display", "none");
            $('#addToStockRow').css("display", "block");
            $('#productReportRow').css("display", "none");

            $('#addToStockTable').DataTable().destroy();
            $('#addToStockTable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "addToStock.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    },
                },
                "columns": [{
                        data: 'apID'
                    },
                    {
                        data: 'apName'
                    },
                    {
                        data: 'aVal'
                    }
                ],
                scrollY: 400,
                scroller: true,

                "language": {
                    "infoEmpty": " ",
                    "loadingRecords": "",
                    "processing": "",
                    "emptyTable": " ",
                },
            });
        }
        else if(table == "productReport") {
            $('#allBillRow').css("display", "none");
            $('#allCustomerRow').css("display", "none");
            $('#addToStockRow').css("display", "none");
            $('#productReportRow').css("display", "block");

            $('#productReportTable').DataTable().destroy();
            $('#productReportTable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "productReport.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    },
                },
                "columns": [{
                        data: 'bpID'
                    },
                    {
                        data: 'bpName'
                    },
                    {
                        data: 'sCnt'
                    }
                ],
                scrollY: 400,
                scroller: true,

                "language": {
                    "infoEmpty": " ",
                    "loadingRecords": "",
                    "processing": "",
                    "emptyTable": " ",
                },
            });
        }

    }
</script>