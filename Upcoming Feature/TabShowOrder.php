<?php
include("./system/header.php");
?>

<div class="container-fluid">

    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <table id="allOrder" class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ชื่อผู้สั่ง</th>
                                <th scope="col">รายการสินค้า</th>
                                <th scope="col">จำนวน</th>
                                <th scope="col">ราคารวม</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
</div>

<script>
    // $.extend(true, $.fn.dataTable.defaults, {
    //     "info": false,
    //     "lengthChange": false,
    //     //"paging": false
    // });

    $(document).ready(function() {


        $('#allOrder').DataTable({
            "processing": true,
            "ajax": {
                "url": "./TabGetOrder/getOrder.php"
            },
            "columns": [{
                    data: 'pID'
                },
                {
                    data: 'pVal'
                },
                {
                    data: 'pVal'
                },
                {
                    data: 'pVal'
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
                dataSrc: 'pID',
                startRender: function(rows, group) {
                    return $('<tr/>')
                        .append('<td>' + group + '</td>')
                        .append('<td colspan=100%><button type="button" class="btn btn-success mx-3" id ="edit' + group + '">แก้ไขบิล<button type="button" class="btn btn-danger mx-3" id ="del' + group + '">ลบบิล</button></td>')
                }
            }
        });

        $(document).on("click", "#allBillTable tbody tr td button.btn", function() { // any button
            sendBID(this.id)
        });

        function sendBID(bID) {
            let text = bID
            if (text.includes("edit")) {
                $.ajax({
                    url: "./TabReport/billEdit.php",
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