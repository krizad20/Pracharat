<?php

//fetch_cart.php

session_start();

if (!function_exists('str_contains')) {
	function str_contains($haystack, $needle)
	{
		return $needle !== '' && mb_strpos($haystack, $needle) !== false;
	}
}

$total_price = 0;
$total_item = 0;
$customer_name = "";
$sID = $_POST["sID"];

$output = '
<div class="table-responsive" style="height:50vh;">
	<table class="table table-bordered table-striped" id="order_table" > 
		<thead>
			<tr style="position:sticky;top: 0;background: white;">  
				<th width="40%">ชื่อสินค้า</th>  
				<th width="10%">จำนวน</th>  
				<th width="20%">ราคา</th>  
				<th width="15%">ราคารวม</th>  
				<th width="5%">ลบ</th>  
			</tr>
		</thead>
		<tbody class="overflow-auto">
';
if (!empty($_SESSION['product'][$sID])) {

	foreach ($_SESSION['product'][$sID] as $keys => $values) {
		//to string
		if (!str_contains($keys, "pack")) {
			$output .= '
		<tr id="' . $values["pID"] . '">
			<td>' . $values["pName"] . '</td>
			<td align="center"><input class="form-control form-control-sm quantity"  type="number" onkeydown="return event.keyCode !== 69" name="' . $values['pQuantity'] . '" value="' . $values['pQuantity'] . '" size="2" min="1"max="100"/></td>
			<td align="right">฿ ' . $values["pSP"] . '</td>
			<td align="right">฿ ' . $values["pTotal"] . '</td>
			<td><button name="delete" class="btn btn-danger btn-xs delete">ลบ</button></td>
		</tr>
		';
			$total_price = $total_price + ($values["pQuantity"] * $values["pSP"]);
			$total_item = $total_item + 1;
		}
	}
} else {
	$output .= '
    <tr>
    	<td colspan="5" align="center">
    		ไม่มีสินค้าที่เลือก เลือกสินค้าได้เลย!
    	</td>
    </tr>
    ';
}

if (!empty($_SESSION['customer'][$sID])) {
	$customer_name = $_SESSION['customer'][$sID]['cName'];
	$customer_id = $_SESSION['customer'][$sID]['cID'];
} else {
	$customer_name = "";
	$customer_id = "";
}


$output .= '</table></div>';
$data = array(
	'cart_details'		=>	$output,
	'total_price'		=>	number_format($total_price, 2),
	'total_item'		=>	$total_item,
	'customer_name'    =>  $customer_name,
	'customer_id'		=>	$customer_id
);



echo json_encode($data);
