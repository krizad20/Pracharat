<?php
include("system\header.php");
?>

<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">สินค้าถึงจุดสั่งซื้อ</h1>
        </div>
        <!-- /.col -->
    </div>
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <table id="needToBuyTable" class="table table-bordered">
                        <thead>
                            <th scope="col">รหัสสินค้า</th>
                            <th scope="col">ชื่อสินค้า</th>
                            <th scope="col">จำนวนคงเหลือ</th>
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
</div>

<script>
    $.extend(true, $.fn.dataTable.defaults, {
        "info": false,
        "lengthChange": false,
        //"paging": false
    });

    $(document).ready(function() {

        $('#needToBuyTable').DataTable({
            //"processing": true,
            "ajax": {
                "url": "TabNeedToBuy/needToBuy.php",
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
            scrollY: 400,
            scroller: true,
            searching: false,

            "language": {
                "infoEmpty": " ",
                "loadingRecords": "",
                "processing": "",
                "emptyTable": " ",
            },
            dom: 'Bfrtip',
            buttons: [
                'excel',
            ]
        });


    })
</script>