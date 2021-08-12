<?php
include("system\header.php");
?>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">แสดงบิลทั้งหมด</h1>
        </div>
        <!-- /.col -->
    </div>

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">เลือกเวลา</h3>
                </div>
                <div class="card-body">
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

                    <div class="row mb-2 mt-3">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input my-2" type="radio" name="flexRadioDefault" id="byRange" value="byRange">
                                <label class="form-check-label" for="byRange">ช่วงเวลา ตั้งแต่</label>
                                <input type="date" size="10" id="datepicker_day_from" name="">
                                <label class="form-check-label" for="byRange">ถึง</label>
                                <input type="date" size="10" id="datepicker_day_to" name="">
                            </div>
                        </div>

                        <div class="col text-right">
                            <button type="button" class="btn btn-success mx-3" onclick="" id="searchButton">ค้นหา</button>
                            <button type="button" class="btn btn-success mx-3" onclick="" id="toExcelButton">พิมพ์ XLSX</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <table id="allBillTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">วันที่ขาย</th>
                                <th scope="col">เลขที่บิลขาย</th>
                                <th scope="col">บ้านเลขที่</th>
                                <th scope="col">ชื่อลูกค้า</th>
                                <th scope="col">รหัสสินค้า</th>
                                <th scope="col">ชื่อสินค้า</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">ราคาขาย</th>
                                <th scope="col">ต้นทุน</th>
                                <th scope="col">กำไร</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="d-flex flex-column align-items-end">
                        <div class="row" id="totalCost">ต้นทุนรวม : </div>
                        <div class="row" id="totalSale">ยอดขายทั้งหมด : </div>
                        <div class="row" id="totalProfit">กำไรรวม : </div>
                    </div>

                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        //"paging": false
    });

    $(document).ready(function() {

        $('#allBillTable').DataTable()
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
        var selectedDate;
        var dateFrom;
        var dateTo;
        $('#searchButton').on('click', function() {
            modeSelect($('input[type=radio][name=flexRadioDefault]:checked').val())
            $('#allBillTable').DataTable().destroy();
            $('#allBillTable').DataTable({
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
                    }
                ],
                scrollY: 400,
                scroller: true,

                "language": {
                    "infoEmpty": " ",
                    "loadingRecords": " ",
                    "processing": " ",
                    "emptyTable": " ",
                },
                rowGroup: {
                    dataSrc: 'bID',
                    startRender: function(rows, group) {
                        return $('<tr/>')
                            .append('<td>' + group + '</td>')
                            .append('<td colspan=100%><button type="button" class="btn btn-success mx-3" id ="edit' + group + '">แก้ไขบิล</button><button type="button" class="btn btn-warning mx-3" id ="print' + group + '">พิมพ์บิล</button><button type="button" class="btn btn-danger mx-3" id ="del' + group + '">ลบบิล</button></td>')
                    }
                },
                "footerCallback": function(row, data, start, end, display) {
                    var api = this.api(),
                        data;

                    let bp = api
                        .column(8)
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);
                    let sp = api
                        .column(7)
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);

                    let profit = api
                        .column(9)
                        .data()
                        .reduce(function(a, b) {
                            return parseFloat(a) + parseFloat(b);
                        }, 0);

                    $('#totalCost').html("ต้นทุนรวม : " + bp.toFixed(2));
                    $('#totalSale').html("ยอดขายทั้งหมด : " + sp.toFixed(2));
                    $('#totalProfit').html("กำไรรวม : " + profit.toFixed(2));
                }
            });
        })

        $(document).on("click", "#allBillTable tbody tr td button.btn", function() { // any button
            sendBID(this.id)
        });


        function modeSelect(mode) {
            //byDay
            //byMonth
            //byYear
            //byRange
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
        }

        function sendBID(bID) {
            let text = bID
            if (text.includes("edit")) {
                $.ajax({
                    url: "TabReport/billEdit.php",
                    method: "POST",
                    data: {
                        bID: text.slice(4),
                    },
                    success: function(data) {
                        window.location.href = 'TabPOS.php';
                    }
                });
            } else if (text.includes("print")) {
                console.log(text.slice(5))
            } else if (text.includes("del")) {
                console.log(text.slice(3))
            }

        }
    })
</script>