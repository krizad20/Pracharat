<?php
include("system\header.php");
if (!isset($_SESSION['seller']) || $_SESSION['permission'] == "2") {
    echo "<script>window.location.href='index.php';</script>";
}
?>

<div class="container-fluid">

    <div class="card">
        <div class="card-header p-1">
            <h3 class="card-title">เลือกเวลา</h3>
        </div>
        <div class="card-body p-2">
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

            <div class="d-flex ">
                <input class="search form-control form-control-sm me-2" type="search" id="searchBar" placeholder="ค้นหา..." aria-label="Search" autofocus>
                <button type="button" class="btn btn-success text-nowrap" onclick="" id="searchButton">ค้นหา</button>
                <button type="button" class="btn btn-success text-nowrap" onclick="" id="toExcelButton">พิมพ์ XLSX</button>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body p-2">
            <table id="allCustomerTable" class="table table-bordered display" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">รหัสลูกค้า</th>
                        <th scope="col">บ้านเลขที่</th>
                        <th scope="col">ชื่อ-นามสกุล</th>
                        <th scope="col">ยอดซื้อสินค้า</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        paginate: false,
        "language": {
            "lengthMenu": "แสดง _MENU_ รายการ",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "infoEmpty": "ไม่พบข้อมูล",
            "emptyTable": "เลือกเวลาเพื่อค้นหา...",
            "infoFiltered": "(กรองจาก _MAX_ รายการทั้งหมด)",
            "search": "",
        },
        "columnDefs": [{
            "targets": [0, 1, 2],
            "searchable": true,
        }, ]

    });

    $(document).ready(function() {
        var selectedDate;
        var dateFrom;
        var dateTo;
        var table;

        setDate();
        $('#allCustomerTable').DataTable();
        $('.dataTables_wrapper .dataTables_filter input').hide();

        $('#searchButton').on('click', function() {
            modeSelect($('input[type=radio][name=flexRadioDefault]:checked').val())
            $('#allCustomerTable').DataTable().destroy();
            table = $('#allCustomerTable').DataTable({
                "ajax": {
                    "url": "TabReport/allCus.php",
                    "method": "POST",
                    data: {
                        dateFrom: dateFrom,
                        dateTo: dateTo
                    }
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
                "order": [
                    [0, 'asc']
                ],
                "columnDefs": [{
                    "targets": [0, 1, 2],
                    "searchable": true,
                }, ],
                //sum

            });
            $('.dataTables_wrapper .dataTables_filter input').hide();

        })

        $('#searchBar').on('keyup search', function(e) {
            table.search(this.value).draw();
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

        function setDate() {
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
        }
    })
</script>