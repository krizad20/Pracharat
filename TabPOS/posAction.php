<?php
include(".././system/server.php");
session_start();
// session_unset();
if (isset($_POST["action"])) {
    date_default_timezone_set("Asia/Bangkok");
    if ($_POST["action"] == "setCustomer") {
        //query Product
        $sID = $_POST["sID"];
        $cID = $_POST["cID"];

        //Add Customer To Session
        $queryCustomer = "SELECT * FROM `customer` WHERE `cID` = '$cID'";
        $resultCustomer = mysqli_query($conn, $queryCustomer);


        //Add to cart
        if ($resultCustomer) {
            $rowCustomer = mysqli_fetch_array($resultCustomer);
            $cID = $rowCustomer["cID"];
            $cName = $rowCustomer["cName"];
            $cSer = $rowCustomer["cSer"];
            $cHouse = $rowCustomer["cHouse"];
            $cMoo = $rowCustomer["cMoo"];

            $customerArray = array(
                'cID' => $cID,
                'cName' => $cName . "  " . $cSer,
                'cHouse' => $cHouse,
                'cMoo' => $cMoo

            );

            if (isset($_SESSION['customer'][$sID])) {
                $_SESSION['customer'][$sID] = $customerArray;
            } else {
                $_SESSION['customer'][$sID] = $customerArray;
            }
        }
    }

    if ($_POST["action"] == "add") {
        //query Product
        $sID = $_POST["sID"];
        $cID = $_POST["cID"];
        $pID = $_POST["pID"];

        //Add Customer To Session
        $queryCustomer = "SELECT * FROM `customer` WHERE `cID` = '$cID'";
        $resultCustomer = mysqli_query($conn, $queryCustomer);

        //Add Product To Session
        $queryProduct = "SELECT * FROM `product` WHERE `pID` = '$pID'";
        $resultProduct = mysqli_query($conn, $queryProduct);

        //Add to cart
        if ($resultCustomer && $resultProduct) {
            $rowCustomer = mysqli_fetch_array($resultCustomer);
            $cID = $rowCustomer["cID"];
            $cName = $rowCustomer["cName"];
            $cSer = $rowCustomer["cSer"];
            $cHouse = $rowCustomer["cHouse"];
            $cMoo = $rowCustomer["cMoo"];

            $customerArray = array(
                'cID' => $cID,
                'cName' => $cName . "  " . $cSer,
                'cHouse' => $cHouse,
                'cMoo' => $cMoo

            );

            $rowProduct = mysqli_fetch_array($resultProduct);
            $pID = $rowProduct["pID"];
            $pName = $rowProduct["pName"];
            $pPrice = $rowProduct["pSP"];
            $pQuantity = 1;
            $pTotal = $pPrice * $pQuantity;
            $productArray = array(
                'pID' => $pID,
                'pName' => $pName,
                'pSP' => $pPrice,
                'pQuantity' => $pQuantity,
                'pTotal' => $pTotal
            );



            //Second Time
            if (isset($_SESSION['product'][$sID])) {

                if (isset($_SESSION['product'][$sID][$pID])) {
                    $_SESSION['product'][$sID][$pID]['pQuantity'] += 1;
                    $_SESSION['product'][$sID][$pID]['pTotal'] = $_SESSION['product'][$sID][$pID]['pQuantity'] * $_SESSION['product'][$sID][$pID]['pSP'];
                } else {
                    $_SESSION['product'][$sID][$pID] = $productArray;
                }
            } else {
                $_SESSION['product'][$sID][$pID] = $productArray;
            }

            if ($rowProduct['isPacked'] == '1') {
                $queryPackProduct = "SELECT * FROM `packproduct` WHERE `paID` = '$pID'";
                $resultPackProduct = mysqli_query($conn, $queryPackProduct);
                $rowPackProduct = mysqli_fetch_array($resultPackProduct);

                $paID = $rowPackProduct["paID"] . "pack" . $rowPackProduct["pID"];
                $pQuantity = $rowPackProduct['paPerPack'];
                $packProductArray = array(
                    'pID' => $rowPackProduct["pID"],
                    'pQuantity' => $pQuantity,
                );

                if (isset($_SESSION['product'][$sID])) {
                    if (isset($_SESSION['product'][$sID][$paID])) {
                        $_SESSION['product'][$sID][$paID]['pQuantity'] += $pQuantity;
                        $_SESSION['product'][$sID][$paID]['pTotal'] = $_SESSION['product'][$sID][$paID]['pQuantity'] * $_SESSION['product'][$sID][$paID]['pSP'];
                    } else {
                        $_SESSION['product'][$sID][$paID] = $packProductArray;
                    }
                } else {
                    $_SESSION['product'][$sID][$paID] = $packProductArray;
                }
            }

            if (isset($_SESSION['customer'][$sID])) {
                $_SESSION['customer'][$sID] = $customerArray;
            } else {
                $_SESSION['customer'][$sID] = $customerArray;
            }
        }
    }

    

    if ($_POST["action"] == "quantity_change") {
        $sID = $_POST["sID"];
        $pID = $_POST["pID"];
        $pQuantity = $_POST["quantity"];

        $sql = "SELECT pVal FROM `product` WHERE `pID` = '$pID'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $pVal = $row["pVal"];

        foreach ($_SESSION['product'] as $keys => $values) {
            if ($keys != $sID) {
                foreach ($values as $key => $value) {
                    if ($key == $pID) {
                        $pVal = $pVal - $value['pQuantity'];
                    }
                }
            }
        }

        if ($pVal >= $pQuantity) {
            $pTotal = $pQuantity * $_SESSION['product'][$sID][$pID]['pSP'];
            $_SESSION['product'][$sID][$pID]['pQuantity'] = $pQuantity;
            $_SESSION['product'][$sID][$pID]['pTotal'] = $pTotal;
            echo "success";
        } else {
            //alert
            echo "สินค้าหมด";
        }
    }

    if ($_POST["action"] == 'remove') {
        foreach ($_SESSION['product'][$_POST["sID"]] as $key => $value) {
            if ($key == $_POST["pID"]) {
                unset($_SESSION['product'][$_POST["sID"]][$key]);
            }
            if (str_contains($key, $_POST["pID"] . "pack")) {
                unset($_SESSION['product'][$_POST["sID"]][$key]);
            }
        }
    }

    if ($_POST["action"] == 'empty') {
        unset($_SESSION['product'][$_POST["sID"]]);
        unset($_SESSION['customer'][$_POST["sID"]]);
    }

 

    if ($_POST["action"] == "checkBill") {
        date_default_timezone_set("Asia/Bangkok");
        $genID = "";
        $sql = "SELECT * FROM `bill`";
        $res = mysqli_query($conn, $sql);
        $rowcount = mysqli_affected_rows($conn);


        //No Data
        if ($rowcount <= 0) {
            $genID = "B00001";
        }
        //Have Data
        else {
            $sql = "SELECT `bID` FROM `bill` ORDER BY `bID` DESC LIMIT 1";
            $getLast = mysqli_query($conn, $sql);
            $last = mysqli_fetch_array($getLast, MYSQLI_ASSOC);
            $genID = $last['bID'];
            ++$genID;
        }

        $sID =  $_POST['sID'];
        $cID = $_POST['cID'];
        $bDate = $_POST['bDate'];
        $bMoney = $_POST['bMoney'];
        $bPra = $_POST['bPra'];
        $bHalf = $_POST['bHalf'];
        $bDis = $_POST['bDis'];
        $bTotal = $_POST['bTotal'];
        $bNote = $_POST['bNote'];
        $detail = [];
        if (isset($_SESSION['product'][$sID])) {
            foreach ($_SESSION['product'][$sID] as $keys => $values) {
                //Normal Product
                if (!str_contains($keys, "pack")) {
                    $sql = "SELECT * FROM product WHERE pID = '$values[pID]'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $detail[] = array(
                        'pID' => $values["pID"],
                        //replace ' with /'
                        'pName' => str_replace("'", "", $row["pName"]),
                        'pQuantity' => $values["pQuantity"],
                        'pBP' => $row["pBP"],
                        'pSP' => $row["pSP"]
                    );

                    //UPDATE PRODUCT
                    $sql = "UPDATE product SET pVal = pVal - '$values[pQuantity]' WHERE pID = '$values[pID]'";
                    $result = mysqli_query($conn, $sql);

                    if ($row['hasPacked'] == '1') {
                        $sql = "UPDATE product p,packproduct pa SET p.pVal= FLOOR((SELECT pVal FROM product WHERE pID = pa.pID)/(pa.paPerPack)) 
                                WHERE p.pID = (SELECT paID FROM packproduct WHERE pID = '" . $row['pID'] . "')";
                        $result = mysqli_query($conn, $sql);
                    }
                }
                //Pack Product
                else {
                    $sql = "UPDATE product SET pVal = pVal - '$values[pQuantity]' WHERE pID = '$values[pID]'";
                    $result = mysqli_query($conn, $sql);
                }
            }
        }

        $json_detail =  json_encode($detail, JSON_UNESCAPED_UNICODE);

        //get last bID



        $sql = "INSERT INTO `bill`(`bID`, `cID`, `bDate`, `bDetail`, `bMoney`, `bPra`, `bHalf`, `bDis`, `bTotal`, `bNote`) 
        VALUES ('$genID','$cID','$bDate','$json_detail','$bMoney','$bPra','$bHalf','$bDis','$bTotal','$bNote')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            unset($_SESSION['product'][$sID]);
            unset($_SESSION['customer'][$sID]);
            echo $genID;;
        } 
        else {
            echo "fail";
        }
    }
}
