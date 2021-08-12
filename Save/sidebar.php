<body class="sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <p>
                                    Dashboard
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>> Dashboard v1</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>> Dashboard v2</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <p>> Dashboard v3</p>
                                    </a>
                                </li>
                            </ul>
                        </li> -->

                        <li class="nav-item">
                            <a href="TabReportByBill.php" class="nav-link" id="reportByBill">
                                <p>แสดงบิลทั้งหมด
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="TabReportByCustomer.php" class="nav-link" id="reportByCustomer">
                                <p>แสดงรายการลูกค้า</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="TabReportAddtoStock.php" class="nav-link" id="reportAddtoStock">
                                <p>รายงานสินค้าเข้า
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="TabReportByProduct.php" class="nav-link" id="reportByProduct">
                                <p>รายงานแยกตามสินค้า
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
<script>
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

        var url = window.location.href;
        if (url.includes(reportByCustomer)) {
            $('#reportByCustomer').addClass('active');
        } else if (url.includes(reportByBill)) {
            $('#reportByBill').addClass('active');
        } else if (url.includes(reportAddtoStock)) {
            $('#reportAddtoStock').addClass('active');
        } else if (url.includes(reportByProduct)) {
            $('#reportByProduct').addClass('active');
        }
    })
</script>