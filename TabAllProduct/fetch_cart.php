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
			<tr style="position:sticky;top: 0;background: white;height: 0;">
				<th width="1%" class="text-center text-nowrap">รหัสสินค้า</th>  
				<th width="auto" class="text-center">ชื่อสินค้า</th>  
				<th width="1%" class="text-center text-nowrap">จำนวน</th>  
				<th width="1%" class="text-center text-nowrap">ราคา</th>  
				<th width="1%" class="text-center text-nowrap">ราคารวม</th>  
				<th width="1%" class="text-center text-nowrap">ลบ</th>  
			</tr>
		</thead>
		<tbody class="overflow-auto">
';
if (!empty($_SESSION['product'][$sID])) {

	foreach ($_SESSION['product'][$sID] as $keys => $values) {
		//to string
		if (!str_contains($keys, "pack")) {
			$output .= '
		<tr id="' . $values["pID"] . '" style="height: 0;">
			<td class="p-1 id" align="left">' . $values["pID"] . '</td>
			<td class="p-1 name" align="left">' . $values["pName"] . '</td>
			<td class="p-1" align="center"><input class="form-control form-control-sm quantity p-0 text-center"  type="number" onkeydown="return event.keyCode !== 69" name="' . $values['pQuantity'] . '" value="' . $values['pQuantity'] . '" min="1"/></td>
			<td class="p-1" align="center"> ' . $values["pSP"] . '</td>
			<td class="p-1" align="center"> ' . number_format($values["pTotal"], 2) . '</td>
			<td class="p-1" align="center"><button name="delete" class="btn btn-danger btn-sm p-0 delete" style="width:100%">ลบ</button></td>
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



echo json_encode($data, JSON_UNESCAPED_UNICODE);
