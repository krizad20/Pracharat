<?php
include("./system/header.php");
if (!isset($_SESSION['seller']) || $_SESSION['permission'] == "2") {
    echo "<script>window.location.href='index.php';</script>";
}
?>

<div class="card">
    <div class="card-header p-1 text-center">
        <h3 class="card-title">สินค้าถึงจุดสั่งซื้อ</h3>
    </div>
    <div class="card-body p-2">
        <table id="needToBuyTable" class="table table-bordered display" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">รหัสสินค้า</th>
                    <th scope="col">ชื่อสินค้า</th>
                    <th scope="col">คงเหลือ</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": true,
        "lengthChange": false,
        "language": {
            "lengthMenu": "แสดง _MENU_ รายการ",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
            "infoEmpty": "ไม่พบข้อมูล",
            "emptyTable": "ไม่ม่สินค้าถึงจุดสั่งซื้อ",
            "infoFiltered": "(กรองจาก _MAX_ รายการทั้งหมด)",
            "search": "ค้นหา",
            "paginate": {
                "next": "ถัดไป",
                "previous": "ย้อนกลับ"
            }

        },
    });

    $(document).ready(function() {

        table = $('#needToBuyTable').DataTable({
            "ajax": {
                "url": "./TabReport/needToBuy.php",
                "method": "POST",

            },
            "columns": [{
                    data: 'pID'
                },
                {
                    data: 'pName'
                },
                {
                    data: 'pVal'
                }
            ],
            "dom": 'Bfrtip',
            "buttons": [{
                extend: 'excelHtml5',
                autoFilter: false,
                sheetName: 'รายงานกำไรขาดทุน',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                },
                //filename
                filename: function() {
                    var d = new Date();
                    var n = d.getTime();
                    return 'รายงานกำไรขาดทุน' + n;
                },
                title: "รายงานกำไรขาดทุน"

            }]


        });

    })
</script>