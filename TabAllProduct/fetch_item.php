<?php

include(".././system/server.php");
session_start();
$menu = $_POST['menu'];
//order by pFav and pID
$query = "SELECT * FROM product WHERE pDel = 0 ORDER BY pFav=0, pFav  ASC,pID  ASC ";

$list = $conn->query($query);
$output = '';
while ($row = $list->fetch_assoc()) {
    if ($menu == "addCart") {
        $output .= '
        <div class="col-lg-2 col-md-3 col-sm-6 col-xs-2">
            <div class="card mt-2">
                <div class="card-body d-flex flex-column">
                    <h3 class="name" style="display: none;">' . $row["pName"] . '</h3>
                    <h3 class="cate" style="display: none;">' . $row["pCate"] . '</h3>
                    <img src="product_pic\/' . $row["img"] . '" width="auto" height="200" class="card-img-top" alt="P00000">
                    <p class="fs-7 fw-bolder text-primary text-wrap">' . $row["pName"] . '</p>
                    <h5 class="text-danger">฿ ' . $row["pSP"] . '</h5>
                    <input type="number" name="quantity" id="quantity' . $row["pID"] . '" class="form-control" value="1" />
                    <input type="hidden" name="hidden_name" id="name' . $row["pID"] . '" value="' . $row["pName"] . '" />
                    <input type="hidden" name="hidden_price" id="price' . $row["pID"] . '" value="' . $row["pSP"] . '" />
                    <button type="button" name="add_to_cart" id="' . $row["pID"] . '"class="btn btn-success add_to_cart mt-2">ใส่ตะกร้า</button>
                </div>
                <div class="card-footer d-flex bd-highlight">
                    <span class="ms-auto bd-highlight">เหลืออยู่ ' . $row["pVal"] . '</span>
                </div>
            </div>
        </div>
        ';
    } else if ($menu == "manageProduct") {
        $output .= '
            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-2">
                <div class="card mt-2">
                    <div class="card-body d-flex flex-column p-0">
                        <span class="id" style="display: none;">' . $row["pID"] . '</span>  
                        <span class="name" style="display: none;">' . $row["pName"] . '</span>
                        <span class="bar" style="display: none;">' . $row["pBar"] . '</span>
                        <span class="bp" style="display: none;">' . $row["pBP"] . '</span>
                        <span class="sp" style="display: none;">' . $row["pSP"] . '</span>
                        <span class="unit" style="display: none;">' . $row["pUnit"] . '</span>
                        <span class="cate" style="display: none;">' . $row["pCate"] . '</span>
                        <span class="val" style="display: none;">' . $row["pVal"] . '</span>
                        <span class="isPacked" style="display: none;">' . $row["isPacked"] . '</span>
                        <span class="bars" value = "' . $row["pID"] . '" style="display: none;">' . $row["pBars"] . '</span>
                        <span class="position-relative">
                            <img src="product_pic\/' . $row["img"] . '" width="auto" height="120" class="card-img-top">
                            
                        </span>
                        <span class="fs-10 fw-bolder text-primary text-wrap p-1">' . $row["pName"] . '</span>
                        <div class="d-flex justify-content-center me-2">
                            <button type="button" name="edit" id="pEditGrid" class="btn btn-warning btn-xs edit" data-bs-toggle="modal" data-bs-target="#editProductModal">แก้ไข</button>
                            <button type="button" name="delete" id="pDelGrid" class="btn btn-danger btn-xs delete">ลบ</button>
                        </div>
                        
                        			
                    </div>
                    <div class="card-footer d-flex bd-highlight p-1">          
                        <span class="ms-auto d-flex align-items-center">เหลืออยู่ ' . $row["pVal"] . '</span>
                    </div>
                </div>
            </div>
            ';
    } else if ($menu == "tabPOS") {

        $pValText = $row["pVal"];
        if (isset($_SESSION['product'])) {
            if ($row['isPacked'] == '1') {
                $sql = "SELECT pa.paPerPack,pa.paID,pa.pID,p.pVal FROM packproduct pa, product p WHERE paID = '" . $row["pID"] . "' AND pa.pID = p.pID";
                $result = $conn->query($sql);
                $rowPack = $result->fetch_assoc();
                $perPack = $rowPack["paPerPack"];
                $pID = $rowPack["pID"];
                $sumProduct = $rowPack["pVal"];
            }
            foreach ($_SESSION['product'] as $keys => $values) {
                foreach ($values as $key => $value) {
                    if ($row["pID"] == $key || str_contains($key, "pack" . $row["pID"])) {
                        $pValText = $pValText - $value['pQuantity'];
                    }
                    if ($row['isPacked'] == '1') {
                        if (str_contains($key, $pID)) {
                            $sumProduct = $sumProduct - $value['pQuantity'];
                        }
                    }
                }
            }
            if ($row['isPacked'] == '1') {
                $pValText = intval(($sumProduct) / $perPack);
            }
        }

        $button =       '<button type="button" name="add_to_cart" id="' . $row["pID"] . '"class="btn btn-success add_to_cart btn-xs" value = "' . $pValText . '">ใส่ตะกร้า</button>';
        if ($pValText <= 0) {
            $button =   '<button type="button" name="add_to_cart" id="' . $row["pID"] . '"class="btn btn-success add_to_cart d-none btn-sm" value = "' . $pValText . '">ใส่ตะกร้า</button>' .
                        '<button type="button" name="add_to_cart" id="' . $row["pID"] . '"class="btn btn-danger add_to_stock btn-xs" value = "' . $pValText . '">เพิ่มสต็อค</button>';
        }

        $favButton = '<span type="button" class="position-absolute top-0 end-0 ms-auto btn btn-secondary btn-xs add_fav" value = "' . $row["pID"] . '">
                        <i class="far fa-star"></i>
                        </span>';
        if ($row["pFav"] > 0) {
            $favButton = '<span type="button" class="position-absolute top-0 end-0 ms-auto btn btn-primary btn-xs add_fav " value = "' . $row["pID"] . '">
                        <i class="fas fa-star"></i>
                        </span>';
        }

        $output .= '
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-2">
                <div class="card mt-2">
                    <div class="card-body d-flex flex-column p-0">
                        <span class="name" style="display: none;">' . $row["pName"] . '</span>
                        <span class="bar" style="display: none;">' . $row["pBar"] . '</span>
                        <span class="bp" style="display: none;">' . $row["pBP"] . '</span>
                        <span class="sp" style="display: none;">' . $row["pSP"] . '</span>
                        <span class="cate" style="display: none;">' . $row["pCate"] . '</span>
                        <span class="bars" value = "' . $row["pID"] . '" style="display: none;">' . $row["pBars"] . '</span>
                        <span class="position-relative">
                            <img src="product_pic\/' . $row["img"] . '" width="auto" height="120" class="card-img-top">
                            ' . $favButton .
            '
                        </span>
                        <span class="fs-10 fw-bolder text-primary text-wrap p-1">' . $row["pName"] . '</span>
                        				
                        ' . $button . '
                    </div>
                    <div class="card-footer d-flex bd-highlight p-1">
                        <span class="fs-6 fw-bolder text-danger d-flex align-items-center">฿ ' . $row["pSP"] . '</span>            
                        <span class="ms-auto d-flex align-items-center pValText" value = "' . $pValText . '" id = "' . $row["pID"] . 'Text">เหลืออยู่ ' . $pValText . '</span>
                    </div>
                </div>
            </div>
            ';
    }
}

echo $output;
