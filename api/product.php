<?php
include(".././system/server.php");
// $mode = $_POST['mode'];
$mode = trim($_POST['mode']);

if ($mode == "findAllProduct") {
    $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ค้นหาสินค้าสำเร็จ",
            "data" => $arr
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ค้นหาสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
if ($mode == "findProductBypID") {
    $pID = $_POST['pID'];
    $sql = "SELECT * FROM `product` WHERE pID = '$pID' AND pDel = 0 ORDER BY `pID` ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ค้นหาสินค้าสำเร็จ",
            "data" => $arr
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "ค้นหาสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//ADD
if ($mode == "add") {
    $pID = $_POST["pID"];
    $pBar = $_POST["pBar"];
    $pName = $_POST["pName"];
    $pBP = $_POST["pBP"];
    $pSP = $_POST["pSP"];
    $pVal = $_POST["pVal"];
    $pCate = $_POST["pCate"];
    $pUnit = $_POST["pUnit"];
    if (isset($_POST["isPacked"])) {
        $isPacked = $_POST["isPacked"];
    } else {
        $isPacked = 0;
    }
    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product` WHERE `pID` != '$pID' AND `pDel` != '1' AND `pBars` LIKE '%" . '"' . $pBar . '"' . "%'";
    $list = $conn->query($query);

    if ($list->num_rows > 0) {
        //$isDuplicate = true;
        $respond = array(
            "status" => 400,
            "message" => "สินค้าซ้ำ บันทึกสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
    //If gen ID is from del -> UPDATE
    $pBars = '[{"detail":"รหัสสินค้า","barcode":"' . $pID . '"},{"detail":"บาร์โค้ดหลัก","barcode":"' . $pBar . '"}]';
    $sql = "INSERT INTO product(pID, pBar,pBars, pName, pBP, pSP, pVal, pCate, pUnit, isPacked) 
            VALUES ('$pID','$pBar','$pBars','$pName',$pBP,$pSP,$pVal,'$pCate','$pUnit',$isPacked)
            ON DUPLICATE KEY UPDATE pBar='$pBar',pBars = '$pBars',pName='$pName',pBP=$pBP,pSP=$pSP,pVal=$pVal,pCate='$pCate',pUnit='$pUnit',pDel = 0,isPacked=$isPacked";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $product[] = $row;
        }
        $respond = array(
            "status" => 200,
            "message" => "บันทึกสินค้าสำเร็จ",
            "data" => $product
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "สินค้าซ้ำ บันทึกสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//EDIT
if ($mode == "edit") {
    $pID = $_POST["pID"];
    $pBar = $_POST["pBar"];
    $pName = $_POST["pName"];
    $pBP = $_POST["pBP"];
    $pSP = $_POST["pSP"];
    $pVal = $_POST["pVal"];
    $pCate = $_POST["pCate"];
    $pUnit = $_POST["pUnit"];
    if (isset($_POST["isPacked"])) {
        $isPacked = $_POST["isPacked"];
    } else {
        $isPacked = 0;
    }
    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product` WHERE `pID` != '$pID' AND `pDel` != '1' AND `pBars` LIKE '%" . '"' . $pBar . '"' . "%'";
    $list = $conn->query($query);

    if ($list->num_rows > 0) {
        //$isDuplicate = true;
        $respond = array(
            "status" => 400,
            "message" => "สินค้าซ้ำ บันทึกสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $query = "SELECT pBars FROM `product` WHERE `pID` = '$pID' AND `pDel` != '1'";
        $list = $conn->query($query);
        $row = $list->fetch_assoc();
        $pBars = $row["pBars"];
        $pBars = json_decode($pBars, true);
        $pBars[1]["barcode"] = $pBar;
        $pBars = json_encode($pBars, JSON_UNESCAPED_UNICODE);
    }

    $sql = "UPDATE product SET pBar='$pBar',pBars = '$pBars',pName='$pName',pBP=$pBP,pSP=$pSP,pVal=$pVal,pCate='$pCate',pUnit='$pUnit',isPacked = $isPacked WHERE pID='$pID'";
    $result = mysqli_query($conn, $sql);

    $sql1 = "SELECT pa.paID, FLOOR(p.pVal/(pa.paPerPack*1.0)) as newVal ,pa.paPerPack
            FROM product p, packproduct pa 
            WHERE p.pID = '$pID'  AND pa.pID = p.pID";
    $result1 = mysqli_query($conn, $sql1);
    while ($row1 = $result1->fetch_assoc()) {
        $paID = $row1["paID"];
        $paPerPack = $row1["paPerPack"];
        $nVal = $row1["newVal"];
        $sql2 = "UPDATE product SET pVal = $nVal, pBP = $pBP*$paPerPack WHERE pID = '$paID' and isPacked = 1";
        mysqli_query($conn, $sql2);
    }

    if ($result) {
        $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $product[] = $row;
        }
        $respond = array(
            "status" => 200,
            "message" => "บันทึกสินค้าสำเร็จ",
            "data" => $product
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 400,
            "message" => "บันทึกสินค้าไม่สำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//DELETE
if ($mode == "del") {
    $pID = $_POST["pID"];

    $sql = "SELECT isPacked,hasPacked FROM `product` WHERE `pID` = '$pID' AND pDel = 0";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $isPacked = $row["isPacked"];
    $hasPacked = $row["hasPacked"];

    if ($isPacked == 1 && $hasPacked == 0) {
        $sql = "UPDATE product SET pDel = 1 WHERE pID='$pID'";
        $result = mysqli_query($conn, $sql);

        $sql1 = "DELETE FROM packproduct WHERE paID = '$pID'";
        $result1 = mysqli_query($conn, $sql1);


        if ($result && $result1) {
            $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $product[] = $row;
            }
            $respond = array(
                "status" => 200,
                "message" => "ลบสินค้าสำเร็จ",
                "data" => $product
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            $respond = array(
                "status" => 400,
                "message" => "ลบสินค้าไม่สำเร็จ",
                "data" => []
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        }
    } else if ($isPacked == 0 && $hasPacked == 0) {
        $sql = "UPDATE product SET pDel = 1 WHERE pID='$pID'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $product[] = $row;
            }
            $respond = array(
                "status" => 200,
                "message" => "ลบสินค้าสำเร็จ",
                "data" => $product
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            $respond = array(
                "status" => 400,
                "message" => "ลบสินค้าไม่สำเร็จ",
                "data" => []
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        }
    } else if ($isPacked == 0 && $hasPacked == 1) {
        $sql = "UPDATE product SET pDel = 1 WHERE pID='$pID'";
        $result = mysqli_query($conn, $sql);

        //All pack that has this product
        $sql1 = "SELECT * FROM packproduct WHERE pID = '$pID'";
        $result1 = mysqli_query($conn, $sql1);
        while ($row1 = $result1->fetch_assoc()) {
            $paID = $row1["paID"];
            $sql2 = "UPDATE product SET pDel = 1 WHERE pID = '$paID'";
            $result2 = mysqli_query($conn, $sql2);
        }

        $sql3 = "DELETE FROM packproduct WHERE pID = '$pID'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result && $result1 && $result2 && $result3) {
            $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $product[] = $row;
            }
            $respond = array(
                "status" => 200,
                "message" => "ลบสินค้าสำเร็จ",
                "data" => $product
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        } else {
            $respond = array(
                "status" => 400,
                "message" => "ลบสินค้าไม่สำเร็จ",
                "data" => []
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
//Ask Delete
if ($mode == "askDel") {
    $pID = $_POST["pID"];

    $sql = "SELECT isPacked,hasPacked FROM `product` WHERE `pID` = '$pID' AND pDel = 0";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_assoc();
    $isPacked = $row["isPacked"];
    $hasPacked = $row["hasPacked"];

    if ($isPacked == 0 && $hasPacked == 1) {
        $text = "หากลบแล้วสินค้าแพ็คจะถูกลบไปด้วย\n";
        //All pack that has this product
        $sql1 = "SELECT * FROM packproduct WHERE pID = '$pID'";
        $result1 = mysqli_query($conn, $sql1);
        while ($row1 = $result1->fetch_assoc()) {
            $paID = $row1["paID"];
            $paName = $row1["paName"];
            $text .=  $paID . " " . $paName . "\n";
        }
        $respond = array(
            "status" => 200,
            "message" => $text,
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    } else {
        $respond = array(
            "status" => 200,
            "message" => "คุณต้องการลบสินค้านี้หรือไม่",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
//Get ID
if ($mode == "getNewID") {
    $genID = "";

    $sql = "SELECT `pID` FROM `product` WHERE `pDel` = 1 ORDER BY `pID` LIMIT 1";
    $getDel = mysqli_query($conn, $sql);
    $del = mysqli_fetch_array($getDel, MYSQLI_ASSOC);

    if (!$del) {
        $sql = "SELECT `pID` FROM `product` ORDER BY `pID` DESC LIMIT 1";
        $getLast = mysqli_query($conn, $sql);
        $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);

        $genID = $last['pID'];
        ++$genID;
    } else {
        $genID = $del['pID'];
    }
    $respond = array(
        "status" => 200,
        "message" => "",
        "data" => $genID
    );
    header("Content-Type:application/json");
    echo json_encode($respond, JSON_UNESCAPED_UNICODE);
    exit();
}
//Add Sub Barcode
if ($mode == "addSubBarcode") {
    $pID = $_POST["pID"];
    $barcode = $_POST["barcode"];
    $detail = $_POST["detail"];

    //check duplicate barcode in product
    $query = "SELECT pBars FROM `product`";
    $list = $conn->query($query);
    $output = [];
    $isDuplicate = false;
    $msg = "";

    while ($row = $list->fetch_assoc()) {
        $output[] = $row['pBars'];
    }
    foreach ($output as $key => $value) {
        $json_arr = json_decode($value, true);
        foreach ($json_arr as $key => $value) {
            if ($value['barcode'] == $barcode) {
                $isDuplicate = true;
                $respond = array(
                    "status" => 400,
                    "message" => "บาร์โค้ดซ้ำ",
                    "data" => []
                );
                header("Content-Type:application/json");
                echo json_encode($respond, JSON_UNESCAPED_UNICODE);
                exit();
            }
        }
    }

    if ($isDuplicate == false) {
        $query1 = "SELECT pBars FROM `product` WHERE pID = '$pID'";

        $list1 = $conn->query($query1);
        $output1;
        while ($row = $list1->fetch_assoc()) {
            $output1 = $row['pBars'];
        }
        //parse to array
        $json_arr1 = json_decode($output1, true);
        //new arr
        $new_arr1[] = array('detail' => $detail, 'barcode' => $barcode);
        //add new
        $json_arr1[] = $new_arr1[0];


        $newJson1 = json_encode($json_arr1, JSON_UNESCAPED_UNICODE);

        $sql = "UPDATE `product` SET `pBars`='$newJson1' WHERE pID = '$pID'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $product[] = $row;
            }
            $respond = array(
                "status" => 200,
                "message" => "เพิ่มบาร์โค้ดสำเร็จ",
                "data" => $product
            );
            header("Content-Type:application/json");
            echo json_encode($respond, JSON_UNESCAPED_UNICODE);
            exit();
        }
    }
}
//Del Sub Barcode
if ($mode == "delSubBarcode") {
    //delete sub barcode
    $barcode = $_POST['barcode'];
    $pID = $_POST['pID'];

    $sql = "SELECT pBars FROM product WHERE pID = '$pID'";
    $list = $conn->query($sql);

    $output = "";
    while ($row = $list->fetch_assoc()) {
        $output = $row['pBars'];
    }
    //parse to json
    $json_arr = json_decode($output, true);
    //edit
    $newArr = [];
    foreach ($json_arr as $key => $value) {
        if ($json_arr[$key]['barcode'] != $barcode) {
            $newArr[] = $json_arr[$key];
        }
    }

    $json = json_encode($newArr, JSON_UNESCAPED_UNICODE);
    $sql = "UPDATE product SET pBars = '$json' WHERE pID = '$pID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $sql = "SELECT * FROM `product` WHERE pDel = 0 ORDER BY `pID` ASC";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $product[] = $row;
        }
        $respond = array(
            "status" => 200,
            "message" => "ลบบาร์โค้ดสำเร็จ",
            "data" => $product
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if ($mode == "addToStock") {
    //get Bangkok time
    $time = date("Y-m-d H:i:s");
    $pID = $_POST["pID"];
    $pName = $_POST["pName"];
    $pQuantity = $_POST["pQuantity"];
    $pNewBP = $_POST["pNewBP"];
    $pNewSP = $_POST["pNewSP"];

    // $sql = "UPDATE product SET pVal = pVal + $pQuantity,pBP = '$pNewBP', pSP = '$pNewSP' WHERE pID = '$pID'";
    // $result = mysqli_query($conn, $sql);    

    $sql = "INSERT INTO `addtostock`(`aDate`, `apID`, `apName`, `aBP`, `aSP`, `aVal`) 
            VALUES ('$time','$pID','$pName','$pNewBP','$pNewSP','$pQuantity')";
    $result = mysqli_query($conn, $sql);
    updateStock($conn, $pID, $pQuantity, $pNewBP, $pNewSP);
    updateForPack($conn, $pID, $pQuantity, $pNewBP);
}

if ($mode == "findAllUnit") {
    $sql = "SELECT `pUnit` FROM `product` GROUP BY `pUnit` ORDER BY `pUnit` ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "",
            "data" => $arr
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if ($mode == "findAllCate") {
    $sql = "SELECT `pCate` FROM `product` GROUP BY `pCate` ORDER BY `pCate` ASC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $arr[] = $row;
    }
    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "",
            "data" => $arr
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if ($mode == "uploadImage") {
    $pID = $_POST['pID'];
    $dir = ".././product_pic/";
    move_uploaded_file($_FILES["image"]["tmp_name"], $dir . $pID . ".png");

    $sql = "UPDATE product SET img = '$pID.png' WHERE pID = '$pID'";
    $result = mysqli_query($conn, $sql);
}

if ($mode == "getProductsGrid") {
    $response['code'] = '0';
    $filters['query'] = isset($_REQUEST['s']) ? filter_var(trim($_REQUEST['s'])) : "";

    /* pagination logic start */
    $items_count = count(getProducts(array('pID'), $filters, 0, -1));

    $items_per_page = isset($_REQUEST['per_page']) ? $_REQUEST['per_page'] : 24;
    $items_per_page = $items_per_page > 50 ? 50 : $items_per_page;

    $max_pages = intval($items_count / $items_per_page + 1);

    $current_page = !isset($_REQUEST['paged']) || intval($_REQUEST['paged']) < 1 ? 1 : filter_var(trim($_REQUEST['paged']), FILTER_SANITIZE_NUMBER_INT);
    $current_page = $current_page > $max_pages ? $max_pages : $current_page;

    $offset = $items_per_page * $current_page - $items_per_page;
    /* pagination logic end */

    $order_by = (isset($_REQUEST['order_by']) && in_array(trim($_REQUEST['order_by']), array("pID", "pName", "pFav"))) ? trim($_REQUEST['order_by']) : 'pID';
    $order = (isset($_REQUEST['order']) && in_array(trim($_REQUEST['order']), array("ASC", "DESC"))) ? trim($_REQUEST['order']) : 'ASC';

    $pagination_html = '
	';

    $total_links = $max_pages;

    $previous_link = '';

    $next_link = '';

    $page_link = '';

    if ($total_links > 4) {
        if ($current_page < 5) {
            for ($count = 1; $count <= 5; $count++) {
                $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
        } else {
            $end_limit = $total_links - 5;

            if ($current_page > $end_limit) {
                $page_array[] = 1;

                $page_array[] = '...';

                for ($count = $end_limit; $count <= $total_links; $count++) {
                    $page_array[] = $count;
                }
            } else {
                $page_array[] = 1;

                $page_array[] = '...';

                for ($count = $current_page - 1; $count <= $current_page + 1; $count++) {
                    $page_array[] = $count;
                }

                $page_array[] = '...';

                $page_array[] = $total_links;
            }
        }
    } else {
        for ($count = 1; $count <= $total_links; $count++) {
            $page_array[] = $count;
        }
    }

    for ($count = 0; $count < count($page_array); $count++) {
        if ($current_page == $page_array[$count]) {
            $page_link .= '
            <li class="page-item active">
                <a href="javascript:;" page="' . $page_array[$count] . '" class="page-link">' . $page_array[$count] . ' </a>
              </li>

			';

            $previous_id = $page_array[$count] - 1;

            if ($previous_id > 0) {
                $previous_link = '
                    <li class="page-item">
                        <a href="javascript:;" page="' . $previous_id . '" class="page-link">
                        <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    ';
            } else {
                $previous_link = '
				<li class="page-item">
                    <a href="#" class="page-link">
                    <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
				';
            }

            $next_id = $page_array[$count] + 1;

            if ($next_id >= $total_links) {
                $next_link = '
				<li class="page-item">
                    <a href="#" class="page-link">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
				';
            } else {
                $next_link = '
				<li class="page-item">
                    <a href="javascript:;" page="' . $next_id . '" class="page-link">
                    <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>';
            }
        } else {
            if ($page_array[$count] == '...') {
                $page_link .= '
				<li class="page-item">
                    <a href="" class="page-link">...</a>
                </li>
				';
            } else {
                $page_link .= '
				<li class="page-item">
                    <a href="javascript:;" page="' . $page_array[$count] . '" class="page-link">' . $page_array[$count] . ' </a>
                </li>
				';
            }
        }
    }

    $pagination_html .= $previous_link . $page_link . $next_link;

    $response['products'] = getProducts(array(), $filters, $offset, $items_per_page, $order_by, $order);
    $response['page'] = $current_page;
    $response['pages'] = $max_pages;
    $response['pagination'] = $pagination_html;
    $response['msg'] = "success";

    header("Content-Type:application/json");
    echo json_encode($response);
    exit();
}

if ($mode == 'addFavProduct') {
    $pID = $_POST["pID"];
    //get last fav number 
    $queryFav = "SELECT pFav FROM `product` ORDER BY `pFav` DESC LIMIT 1";
    $resultFav = mysqli_query($conn, $queryFav);
    $rowFav = mysqli_fetch_array($resultFav);
    $favID = $rowFav["pFav"];
    $favID = $favID + 1;
    $sql = "UPDATE `product` SET `pFav` = '$favID' WHERE `pID` = '$pID'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "เพิ่มรายการโปรดสำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}

if ($mode == 'removeFavProduct') {
    $pID = $_POST["pID"];
    $sql = "UPDATE `product` SET `pFav` = '0' WHERE `pID` = '$pID'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $respond = array(
            "status" => 200,
            "message" => "ลบรายการโปรดสำเร็จ",
            "data" => []
        );
        header("Content-Type:application/json");
        echo json_encode($respond, JSON_UNESCAPED_UNICODE);
        exit();
    }
}
