<?php
include("./system/header.php");
?>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">รายงานสินค้าเข้า</h1>
        </div>
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
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        //"paging": false
    });

    $(document).ready(function() {
        $('#addToStockTable').DataTable()
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
            $('#addToStockTable').DataTable().destroy();
            $('#addToStockTable').DataTable({
                "processing": true,
                "ajax": {
                    "url": "./TabReport/addToStock.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    },
                },
                dom: 'Bfrtip',
                buttons: [
                    'print'
                ],
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
        })
        console.log(dateFrom)



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
    })
</script>