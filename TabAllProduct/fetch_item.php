<?php

include("..\system\server.php");

$query = "SELECT * FROM product ORDER BY pID ASC";

$list = $conn->query($query);
$output = '';
while ($row = $list->fetch_assoc()) {
    $output .= '
	<div class="col-lg-2 col-md-3 col-sm-6 col-xs-2">
        <div class="card mt-2">
            <div class="card-body d-flex flex-column">
                <h3 class="name" style="display: none;">' . $row["pName"] . '</h3>
                <h3 class="cate" style="display: none;">' . $row["pCate"] . '</h3>
                <img src="product_pic\\' . $row["img"] . '" class="card-img-top" alt="P00000">
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
}
echo $output;
