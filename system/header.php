<?php
session_start();
include('server.php');

?>

<head>
	<title>Pracharat</title>
	<meta property="og:title" content="Pracharat" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/scroller/2.0.4/css/scroller.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/rowgroup/1.1.3/css/rowGroup.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/rowreorder/1.2.8/css/rowReorder.dataTables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="img/logo.jpg">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

	<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
	<script src="https://cdn.datatables.net/scroller/2.0.5/js/dataTables.scroller.min.js"></script>
	<script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>
	<script src="https://cdn.datatables.net/rowgroup/1.1.3/js/dataTables.rowGroup.min.js"></script>
	<script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
	<script src="https://cdn.datatables.net/rowreorder/1.2.8/js/dataTables.rowReorder.min.js"></script>

	<script src="js/list.js"></script>


</head>


<body style="font-size:80%;">

	<!-- Add To Stock -->
	<div class="modal fade" id="addToStockAndSelect" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="addToStockAndSelectLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="addToStockLabel">รับสินค้าเข้าสต๊อก</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col">
							<div class="mb-2 row">
								<label class="col-form-label" style="width: 30%;">รหัสสินค้า</label>
								<div class="col" style="width: 70%;">
									<input type="text" class="form-control " id="pIDA2S" placeholder="รหัสสินค้า" disabled>
								</div>
							</div>

							<div class="mb-2 row">
								<label class="col-form-label" style="width: 30%;">รหัสบาร์โค้ด</label>
								<div class="col" style="width: 70%;">
									<input class="form-control" id="pBarA2S" placeholder="รหัสบาร์โค้ด" disabled>
								</div>
							</div>

							<div class="mb-2 row">
								<label class="col-form-label" style="width:30%;">ชื่อสินค้า</label>
								<div class="col" style="width:30%;">
									<input type="text" class="form-control " id="pNameA2S" placeholder="ชื่อสินค้า" disabled>
								</div>
							</div>



							<div class="mb-2 row">
								<label class="col-form-label" style="width:30%;">ราคาซื้อ</label>
								<div class="col" style="width:70%;">
									<input type="number" class="form-control " id="pBPA2S" placeholder="ราคาซื้อ" disabled>
								</div>
							</div>

							<div class="mb-2 row">
								<label class="colcol-form-label" style="width:30%;">ราคาขาย</label>
								<div class="col" style="width:70%;">
									<input type="number" class="form-control " id="pSPA2S" placeholder="ราคาขาย" disabled>
								</div>
							</div>

							<div class="mb-2 row">
								<label class="col-form-label" style="width:30%;">คงเหลือ</label>
								<div class="col" style="width:70%;">
									<input type="number" class="form-control " id="pValA2S" placeholder="จำนวนคงเหลือ" disabled>
								</div>
							</div>
						</div>

						<div class="col" id="selectProductCol">
							<div class="mb-2 row">
								<table class="table table-bordered table-hover" id="selectProductA2S">
									<thead>
										<tr>
											<th scope="col">รหัสสินค้า</th>
											<th scope="col">ชื่อสินค้า</th>
											<th scope="col">ราคาขาย</th>
											<th scope="col">คงเหลือ</th>
											<th scope="col">บาร์โค้ดสินค้า</th>
										</tr>
									</thead>
								</table>
							</div>
						</div>

					</div>

					<div class="row">
						<div class="col">
							<div class="mb-2 row">
								<label class="col-form-label" style="width: 35%;">จำนวนที่จะเพิ่ม</label>
								<div class="col" style="width: 70%;">
									<input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pAddVal" placeholder="จำนวนที่จะเพิ่ม">
								</div>
							</div>

							<div class="mb-2 row">
								<label class="col-form-label" style="width: 35%;">ราคาที่ซื้อมา</label>
								<div class="col" style="width: 70%;">
									<input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNowBP" placeholder="ราคาที่ซื้อมา">
								</div>
							</div>
						</div>

						<div class="col">
							<div class="mb-2 row">
								<label class="col-form-label" style="width: 35%;">ราคาซื้อใหม่</label>
								<div class="col" style="width: 70%;">
									<input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNewBP" placeholder="ราคาที่ซื้อใหม่">
								</div>
							</div>

							<div class="mb-2 row">
								<label class="col-form-label" style="width: 35%;">ราคาขายใหม่</label>
								<div class="col" style="width: 70%;">
									<input type="number" onkeydown="return event.keyCode !== 69" class="form-control " id="pNewSP" placeholder="ราคาขายใหม่">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
					<button type="button" class="btn btn-primary" id="saveAddToStock">บันทึก</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Report Per Day -->
	<div class="modal fade" id="reportPerDay" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="reportPerDayLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="reportPerDayLabel">สรุปยอดขายรายวัน</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body overflow-auto">
					<table id="reportPerDayTable" class="table table-bordered display" style="height: 0;width:100%">
						<thead>
							<tr>
								<th width="1%" class="text-center text-nowrap" scope="col">วันที่ขาย</th>
								<th width="1%" class="text-center text-nowrap" scope="col">เลขที่บิลขาย</th>
								<th width="1%" class="text-center text-nowrap" scope="col">รหัสสินค้า</th>
								<th class="text-center text-nowrap" scope="col">ชื่อสินค้า</th>
								<th width="1%" class="text-center text-nowrap" scope="col">จำนวน</th>
								<th width="1%" class="text-center text-nowrap" scope="col">ราคา</th>
								<th width="1%" class="text-center text-nowrap" scope="col">ราคารวม</th>
							</tr>
						</thead>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
				</div>
			</div>
		</div>
	</div>


	<nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">Pracharat</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<?php
					if (isset($_SESSION['seller'])) {
						echo '<li class="nav-item"><a class="nav-link" href="./TabSale.php">หน้าจอขาย</a></li>';
					}

					if (isset($_SESSION['seller']) && $_SESSION['permission'] == 1) {
						echo '
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									จัดการสินค้า
								</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="./TabManageProduct.php">จัดการสินค้า</a></li>
										<li><a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#addToStockAndSelect">รับสินค้าเข้าสต็อค</a></li>
									</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="./TabManageCustomer.php">จัดการลูกค้า</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									รายงานการขาย
								</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
										<li><a class="dropdown-item" href="./TabReportByBill.php">แยกตามบิล</a></li>
										<li><a class="dropdown-item" href="./TabReportByCustomer.php">แยกตามลูกค้า</a></li>
										<li><a class="dropdown-item" href="./TabReportByProduct.php">แยกตามสินค้า</a></li>
										<li><a class="dropdown-item" href="./TabReportProfit.php">กำไร-ขาดทุน</a></li>
									</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="./TabReportAddToStock.php">รายงานสินค้าเข้าสต็อค</a></li>
							<li class="nav-item"><a class="nav-link" href="./TabReportNeedToBuy.php">รายงานสินค้าถึงจุดสั่งซื้อ</a></li>

							
							';
					}

					if (isset($_SESSION['seller'])) {
						echo '
						<li class="nav-item"><a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#reportPerDay">สรุปยอดขายรายวัน</a></li>
						
						</ul>
						<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown d-flex">
						<a class="nav-link dropdown-toggle me-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $_SESSION['seller'] . '</a>
							<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
								<li><a class="dropdown-item" href="#">แก้ไขข้อมูล</a></li>
								<li><form action="login.php" method="post">
								<button type="submit" class="dropdown-item" name="logout">ออกจากระบบ</form></li>
								</button>
							</ul>
					</li>
						</ul>
						
						';
					}
					?>


			</div>
		</div>
	</nav>
	<div class="container-fluid mt-2 overflow-auto">



</body>
<script src="./system/addToStock.js"></script>
<script>
	$(document).ready(function() {

		$('#reportPerDay').on('shown.bs.modal', function(e) {
			$('#reportPerDayTable').DataTable({
				"ajax": {
					"url": "./TabReport/todayReport.php",
					"method": "POST"
				},
				"columns": [{
						data: 'bDate'
					},
					{
						data: 'bID'
					},
					{
						data: 'pID'
					},
					{
						data: 'pName'
					},
					{
						data: 'pQuantity'
					},
					{
						data: 'pSP'
					},
					{
						data: 'pSum'
					}

				],
				"info": false,
				"lengthChange": false,
				paginate: false,
				"language": {
					"lengthMenu": "แสดง _MENU_ รายการ",
					"zeroRecords": "ไม่พบข้อมูล",
					"info": "แสดง _START_ ถึง _END_ จาก _TOTAL_ รายการ",
					"infoEmpty": "ไม่พบข้อมูล",
					"emptyTable": "เลือกเวลาเพื่อค้นหา...",
					"infoFiltered": "(กรองจาก _MAX_ รายการทั้งหมด)",
					"search": "",
				},
				"order": [],
				"columnDefs": [{
					"targets": [0, 1, 2, 3, 4, 5, 6],
					"searchable": false,
					"orderable": false

				}],


			});
			$('.dataTables_wrapper .dataTables_filter input').hide();
			$('.dt-button').hide();

		});

		$('#reportPerDay').on('hidden.bs.modal', function(e) {
			$('#reportPerDayTable').DataTable().destroy();
		})

	});
</script>