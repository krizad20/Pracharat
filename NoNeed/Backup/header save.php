<? include("server.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pracharat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/scroller/2.0.4/css/scroller.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/adminlte.min.css">
    <link rel="icon" href="img/logo.jpg">


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/adminlte.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/scroller/2.0.4/js/dataTables.scroller.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.min.js" integrity="sha512-ZmglXekGlaYU2nhamWrS8oGQDJQ1UFpLvZxNGHwLfT0H17gXEqEk6oQBgAB75bKYnHVsKqLR3peLVqMDVJWQyA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.compatibility.js" integrity="sha512-YQRu5Y2eFL0L4LrZk2rGxCH5nD8G9ppSaQIqg5mmB/SLd8c0qTJ/cEua3ETXzXzWITvt4x1tiTXFC4M5bJBA4Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.compatibility.min.js" integrity="sha512-lDbkDq2ye0YC9a2tSXVSWDI+qH9BSyBuNCP0WSreQFvaIBOhJTz5GgkA0698hwltHNf0WE5/5Ryxr/tD+IBnPg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/scannerdetection/1.2.0/jquery.scannerdetection.js" integrity="sha512-ZkmasRE78xqpUOUil2ho4QHUWcRCUys1HoKK86VSYMb7oYX2VTNKT9jvsXDxVkOoPdso42isrmOOMHu+gGLQQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.4/JsBarcode.all.min.js" integrity="sha512-9KXy/GLQQ+pPW7VwnI74DzjzUix9GINtAAPwWl4vzaaEqgfOeDgkea6UWM4xAvCeoeiBxzYepep2xxbkX3w/pg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body class="sidebar-mini layout-fixed sidebar-closed sidebar-collapse">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                            <line x1="21" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="21" y1="18" x2="3" y2="18"></line>
                        </svg>
                    </a>
                </li> -->
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./TabPOS.php" class="nav-link">Home</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary elevation-4">
            <!-- Brand Logo -->
            <div class="brand-link text-center">
                <span class="brand-text font-weight-light ">ร้านค้าประชารัฐ</span>
            </div>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="./TabPOS.php" class="nav-link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="cash-register" x="0px" y="0px" viewBox="0 0 1010 959.6426" enable-background="new 0 0 1010 959.6426" xml:space="preserve">
                                    <g>
                                        <g id="cash-register-cash-register">
                                            <g>
                                                <path fill="#5C524C" d="M924.5303,187.7427H488.2231c-10.1411,0-18.3627-8.2134-18.3627-18.3638V18.3633     C469.8604,8.2129,478.082,0,488.2231,0h436.3072c10.1494,0,18.3623,8.2129,18.3623,18.3633v151.0156     C942.8926,179.5293,934.6797,187.7427,924.5303,187.7427L924.5303,187.7427z M506.5859,151.0151H906.166V36.7271H506.5859     V151.0151L506.5859,151.0151z" />
                                            </g>
                                            <g>
                                                <g>
                                                    <polygon fill="#5C524C" points="836.7646,113.4097 779.377,113.4097 779.377,76.6821 836.7646,76.6821 836.7646,113.4097           " />
                                                </g>
                                                <g>
                                                    <polygon fill="#5C524C" points="721.9922,113.4097 561.3096,113.4097 561.3096,76.6821 721.9922,76.6821 721.9922,113.4097           " />
                                                </g>
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M991.6357,959.6426H18.3643C8.2227,959.6426,0,951.4297,0,941.2793V823.8174     c0-10.1504,8.2227-18.3643,18.3643-18.3643h973.2714c10.1514,0,18.3643,8.2139,18.3643,18.3643v117.4619     C1010,951.4297,1001.7871,959.6426,991.6357,959.6426L991.6357,959.6426z M36.7271,922.9151h936.5463v-80.7344H36.7271V922.9151     L36.7271,922.9151z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M238.8442,632.4336h-67.1064c-10.1411,0-18.3643-8.2139-18.3643-18.3643v-67.123     c0-10.1514,8.2232-18.3643,18.3643-18.3643h67.1064c10.1412,0,18.3628,8.2129,18.3628,18.3643v67.123     C257.207,624.2197,248.9854,632.4336,238.8442,632.4336L238.8442,632.4336z M190.1011,595.7061h30.3794v-30.3975h-30.3794     V595.7061L190.1011,595.7061z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M406.6816,632.4336h-67.1699c-10.1411,0-18.3628-8.2139-18.3628-18.3643v-67.123     c0-10.1514,8.2217-18.3643,18.3628-18.3643h67.1699c10.1412,0,18.3628,8.2129,18.3628,18.3643v67.123     C425.0444,624.2197,416.8228,632.4336,406.6816,632.4336L406.6816,632.4336z M357.8755,595.7061h30.4419v-30.3975h-30.4419     V595.7061L357.8755,595.7061z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M574.4551,632.4336h-67.1143c-10.1421,0-18.3637-8.2139-18.3637-18.3643v-67.123     c0-10.1514,8.2216-18.3643,18.3637-18.3643h67.1143c10.1328,0,18.3642,8.2129,18.3642,18.3643v67.123     C592.8193,624.2197,584.5879,632.4336,574.4551,632.4336L574.4551,632.4336z M525.6953,595.7061h30.3975v-30.3975h-30.3975     V595.7061L525.6953,595.7061z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M238.8442,766.6631h-67.1064c-10.1411,0-18.3643-8.2129-18.3643-18.3633v-67.088     c0-10.1512,8.2232-18.3642,18.3643-18.3642h67.1064c10.1412,0,18.3628,8.213,18.3628,18.3642v67.088     C257.207,758.4502,248.9854,766.6631,238.8442,766.6631L238.8442,766.6631z M190.1011,729.9365h30.3794v-30.3613h-30.3794     V729.9365L190.1011,729.9365z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M406.6816,766.6631h-67.1699c-10.1411,0-18.3628-8.2129-18.3628-18.3633v-67.088     c0-10.1512,8.2217-18.3642,18.3628-18.3642h67.1699c10.1412,0,18.3628,8.213,18.3628,18.3642v67.088     C425.0444,758.4502,416.8228,766.6631,406.6816,766.6631L406.6816,766.6631z M357.8755,729.9365h30.4419v-30.3613h-30.4419     V729.9365L357.8755,729.9365z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M574.4551,766.6631h-67.1143c-10.1421,0-18.3637-8.2129-18.3637-18.3633v-67.088     c0-10.1512,8.2216-18.3642,18.3637-18.3642h67.1143c10.1328,0,18.3642,8.213,18.3642,18.3642v67.088     C592.8193,758.4502,584.5879,766.6631,574.4551,766.6631L574.4551,766.6631z M525.6953,729.9365h30.3975v-30.3613h-30.3975     V729.9365L525.6953,729.9365z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M842.9346,766.6631H675.1855c-10.1484,0-18.3642-8.2129-18.3642-18.3633v-67.088     c0-10.1512,8.2158-18.3642,18.3642-18.3642h167.7491c10.1494,0,18.3623,8.213,18.3623,18.3642v67.088     C861.2969,758.4502,853.084,766.6631,842.9346,766.6631L842.9346,766.6631z M693.5508,729.9365h131.0195v-30.3613H693.5508     V729.9365L693.5508,729.9365z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M842.9346,632.4336H675.1855c-10.1484,0-18.3642-8.2139-18.3642-18.3643v-67.123     c0-10.1514,8.2158-18.3643,18.3642-18.3643h167.7491c10.1494,0,18.3623,8.2129,18.3623,18.3643v67.123     C861.2969,624.2197,853.084,632.4336,842.9346,632.4336L842.9346,632.4336z M693.5508,595.7061h131.0195v-30.3975H693.5508     V595.7061L693.5508,595.7061z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M842.9346,464.6143H507.3408c-10.1421,0-18.3637-8.2134-18.3637-18.3638V345.5733     c0-10.1504,8.2216-18.3638,18.3637-18.3638h335.5938c10.1494,0,18.3623,8.2134,18.3623,18.3638v100.6772     C861.2969,456.4009,853.084,464.6143,842.9346,464.6143L842.9346,464.6143z M525.6953,427.8867h298.875v-63.9502h-298.875     V427.8867L525.6953,427.8867z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M434.5581,466.1738H139.1084c-10.1411,0-18.3638-8.2133-18.3638-18.3632V271.2759h36.7276v158.1714     h258.7226V271.2759h36.7276v176.5347C452.9224,457.9605,444.6992,466.1738,434.5581,466.1738L434.5581,466.1738z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M958.0645,833.8047c-10.1495,0-18.3643-8.2129-18.3643-18.3633v-518.647H410.187     c-10.1411,0-18.3638-8.2128-18.3638-18.3627c0-10.1504,8.2227-18.3643,18.3638-18.3643h547.8774     c10.1513,0,18.3643,8.2139,18.3643,18.3643v537.0097C976.4287,825.5918,968.2158,833.8047,958.0645,833.8047L958.0645,833.8047z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M51.9438,833.8047c-10.1416,0-18.3637-8.2129-18.3637-18.3633V278.4317     c0-10.1504,8.2221-18.3643,18.3637-18.3643h111.6163c10.1411,0,18.3637,8.2139,18.3637,18.3643     c0,10.1499-8.2226,18.3627-18.3637,18.3627h-93.253v518.647C70.3071,825.5918,62.085,833.8047,51.9438,833.8047L51.9438,833.8047     z" />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M699.0371,296.7944c-10.1494,0-18.3642-8.2128-18.3642-18.3627V177.7715     c0-10.1494,8.2148-18.3633,18.3642-18.3633c10.1514,0,18.3643,8.2139,18.3643,18.3633v100.6602     C717.4014,288.5816,709.1885,296.7944,699.0371,296.7944L699.0371,296.7944z" />
                                            </g>
                                            <g>
                                                <polygon fill="#5C524C" points="555.375,900.9121 454.6616,900.9121 454.6616,864.1846 555.375,864.1846 555.375,900.9121    " />
                                            </g>
                                            <g>
                                                <path fill="#5C524C" d="M391.7876,402.9414H181.9238c-9.1279,0-16.5254-7.4062-16.5254-16.5342V86.5816     c0-6.689,4.0254-12.7149,10.2037-15.2613c6.1694-2.6006,13.2709-1.1479,18.0146,3.5684l10.4995,10.5273l6.5278-8.7339     c2.8697-3.8374,7.2627-6.2407,12.0513-6.5815c4.7256-0.4658,9.4688,1.3989,12.8667,4.7881l10.5449,10.5449l6.5815-8.7695     c2.8696-3.8374,7.272-6.2407,12.0513-6.5635c4.9043-0.4658,9.4775,1.417,12.8667,4.8066l10.4737,10.4908l6.5273-8.7159     c2.8784-3.8374,7.272-6.2407,12.0601-6.5815c4.7256-0.4658,9.4687,1.3989,12.8667,4.8066l10.5093,10.5088l6.5542-8.7519     c3.1206-4.1602,8.0166-6.6172,13.226-6.6172l0,0c5.21,0,10.1143,2.457,13.2344,6.6352l6.5371,8.7339l10.5-10.5088     c4.7344-4.7529,11.8628-6.1338,18.0137-3.6049c6.1777,2.5644,10.2046,8.5903,10.2046,15.2793v299.8256     C408.3135,395.5352,400.9155,402.9414,391.7876,402.9414L391.7876,402.9414z M198.4487,369.8726h176.813V125.335     c-2.645,1.3452-5.6758,2.0268-8.6435,1.7402c-4.7881-0.3413-9.1817-2.7441-12.0601-6.582l-4.7436-6.3306l-4.7525,6.3482     c-2.8691,3.8203-7.2715,6.2231-12.0508,6.5644c-4.8955,0.376-9.4868-1.4175-12.8672-4.8066l-10.4995-10.5088l-6.5371,8.7334     c-2.8779,3.8379-7.2807,6.2407-12.0595,6.582c-4.9053,0.4658-9.4869-1.3994-12.876-4.8066l-10.4912-10.5088l-6.5723,8.751     c-2.8691,3.8378-7.2725,6.2231-12.0425,6.5644c-4.9497,0.376-9.4687-1.4175-12.8579-4.7886l-10.5185-10.5268l-6.5279,8.7334     c-2.8691,3.8379-7.2715,6.2407-12.0503,6.582c-3.0395,0.2686-6.0171-0.4131-8.6626-1.7402V369.8726L198.4487,369.8726z" />
                                            </g>
                                        </g>
                                    </g>
                                </svg>
                                <p>
                                    หน้าจอขาย
                                </p>
                            </a>
                        </li>

                        <!-- <li class="nav-header">จัดการ</li> -->
                        <li class="nav-item">
                            <a href="./TabManageProduct.php" class="nav-link">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p>
                                    จัดการสินค้า
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1">
                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                </svg>
                                <p>
                                    สินค้าทั้งหมด
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./TabManageCustomer.php" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/3126/3126649.png" alt="Customer free icon" title="Customer free icon" class="loaded">
                                <p>
                                    จัดการลูกค้า
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/2329/2329087.png" alt="Dashboard" title="Dashboard" class="loaded">
                                <p>
                                    รายงานการขาย
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="./TabReportByBill.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>แยกตามบิล</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./TabReportByCustomer.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>แยกตามลูกค้า</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="./TabReportByProduct.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>แยกตามสินค้า</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="./TabReportAddtoStock.php" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/2311/2311991.png" alt="Add free icon" title="Add free icon" class="loaded">
                                <p>
                                    รายงานสินค้าเข้า
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./TabAddToStock.php" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/2311/2311991.png" alt="Add free icon" title="Add free icon" class="loaded">
                                <p>
                                    รับสินค้าเข้าสต๊อค
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./TabPrintBarcode.php" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/2311/2311991.png" alt="Add free icon" title="Add free icon" class="loaded">
                                <p>
                                    พิมพ์บาร์โค้ด
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./TabNeedToBuy.php" class="nav-link">
                                <img width="24" height="24" src="https://image.flaticon.com/icons/png/512/2311/2311991.png" alt="Add free icon" title="Add free icon" class="loaded">
                                <p>
                                    สินค้าถึงจุดสั่งซื้อ
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
</body>