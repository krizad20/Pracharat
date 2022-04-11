<?php
include("./system\headerCustomer.php");
include("./system\server.php");
//session_start()
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" disable>ร้านค้าประชารัฐ</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a href="#" class="nav-link" id="salePage" data-bs-toggle="modal" data-bs-target="#enterPassModal">
            หน้าจอขาย
          </a>
        </li>

        <li class="nav-item">
          <a href="index.php" class="nav-link">
            สินค้าทั้งหมด
          </a>
        </li>
      </ul>

    </div>
  </div>
</nav>

<?php
$menu = "sale";
?>
<?php


$query_product = " SELECT * FROM product " or die("Error : " . mysqlierror($query_product));
$rs_product = mysqli_query($conn, $query_product);

// $query_product = " SELECT * FROM tbl_product ORDER BY rand()" or die
// ("Error : ".mysqlierror($query_product));
// $rs_product = mysqli_query($condb, $query_product);
//echo $rs_product;


?>

<?php

$query = mysqli_query($conn, "SELECT COUNT(pID) FROM `product`");

$row = mysqli_fetch_row($query);

$rows = $row[0];
$page_rows = 6;  //จำนวนข้อมูลที่ต้องการให้แสดงใน 1 หน้า  ตย. 5 record / หน้า 
$last = ceil($rows / $page_rows);
if ($last < 1) {
  $last = 1;
}
$pagenum = 1;
if (isset($_GET['pn'])) {
  $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
}
if ($pagenum < 1) {
  $pagenum = 1;
} else if ($pagenum > $last) {
  $pagenum = $last;
}
$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows . ',' . $page_rows;
$nquery = mysqli_query($conn, "SELECT * from  product ORDER BY pID DESC $limit");

$paginationCtrls = '';
if ($last != 1) {
  if ($pagenum > 1) {
    $previous = $pagenum - 1;
    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $previous . '" class="btn btn-info">Previous</a> &nbsp; ';


    for ($i = $pagenum - 4; $i < $pagenum; $i++) {
      if ($i > 0) {
        $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
      }
    }
  }


  //$paginationCtrls .= ''.$pagenum.' &nbsp; ';


  $paginationCtrls .= '<a href=""class="btn btn-danger">' . $pagenum . '</a> &nbsp; ';




  for ($i = $pagenum + 1; $i <= $last; $i++) {
    $paginationCtrls .= '<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $i . '" class="btn btn-primary">' . $i . '</a> &nbsp; ';
    if ($i >= $pagenum + 4) {
      break;
    }
  }


  if ($pagenum != $last) {
    $next = $pagenum + 1;


    $paginationCtrls .= ' &nbsp;<a href="' . $_SERVER['PHP_SELF'] . '?pn=' . $next . '" class="btn btn-info">Next</a> ';
  }
}




?>


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <h1>ขายสินค้า</h1>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <div class="card card-gray">
    <div class="card-header ">
      <h3 class="card-title">สินค้า IN STOCK</h3>
    </div>
    <br>



    <div class="card-body">

      <div class="col-md-12">

        <div class="row">

          <div class="col-md-7">
            <form action="list_l.php" method="GET">
              <div class="input-group">
                <input type="text" name="pID" class="form-control" placeholder="Scan Barcode" autofocus>
                <!-- <span class="input-group-append">
                     <button class="btn btn-outline-success" type="submit">ค้นหา</button>
                     </span> -->
              </div>




            </form>
            <br>
            <?php if ($row > 0) { ?>
              <div class="row">


                <?php while ($rs_prd = mysqli_fetch_array($nquery)) { ?>

                  <div class="col-md-4">

                    <div class="card" style="">
                      <img width="100%" src="product_pic/<?php echo $rs_prd['img']; ?>" class="card-img-top" alt="<?php echo $rs_prd['pName']; ?>" title="<?php echo $rs_prd['pName']; ?>">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $rs_prd['pName']; ?></h5>
                        <p class="card-text"><?php echo number_format($rs_prd['pSP'], 2); ?> Baht</p>


                        <?php if ($rs_prd['pVal'] > 0) { ?>
                          <center>



                            <br>

                            <a href="list_l.php?pID=<?php echo $rs_prd['pID']; ?>&act=add" class="btn btn-success" target=""><i class="fa fa-shopping-cart"></i> หยิบลงตระกร้า</a>
                          </center>
                        <?php } else { ?>
                          <button class="btn btn-danger" disabled> สินค้าหมด !</button>
                        <?php } ?>



                      </div>
                    </div>


                  </div>
                <?php } ?>


              </div>

            <?php } else { ?>
            <?php } ?>
          </div>


          <div class="col-md-5">
            <?php include('cart_a_2.php'); ?>
          </div>

        </div>


      </div>

    </div>










    <div class="card-footer">
      <center>
        <div id="pagination_controls">

          <?php echo $paginationCtrls; ?>

        </div>
      </center>
    </div>




</section>
<!-- /.content -->

<script>
  $(function() {
    $(".datatable").DataTable();
    // $('#example2').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": false,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    // http://fordev22.com/
    // });
  });
</script>

<div class="modal fade" id="cartModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="cartModalLabel">รายการสินค้าที่เลือก</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="popover_content_wrapper" style="display: block">
          <span id="cart_details"></span>
          <div align="right">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="#" class="btn btn-primary" id="check_out_cart">
          <span class="glyphicon glyphicon-shopping-cart"></span> ส่งสินค้า
        </a>
        <a href="#" class="btn btn-danger" id="clear_cart">
          <span class="glyphicon glyphicon-trash"></span> ล้างสินค้าที่เลือก
        </a>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="enterPassModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="enterPassModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="enterPassModalLabel">กรอกรหัสเข้าหน้าขายสินค้า</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="./TabPOS.php" method="post" class="d-grid gap-2">
          <input name="password" class="form-control" placeholder="******" type="password">
          <div class="form-group">
            <button type="submit" name="login" class="btn btn-primary">เข้าสู่ระบบ</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>
</body>

<script>
  $(document).ready(function() {
    var userList;
    var options;
    var featureList;

    load_product();

    load_cart_data();

    loadCate()

    $('#pCateSelect').change(function() {
      var selection = this.value;
      if (selection) {
        userList.filter(function(item) {
          return (item.values().cate == selection);
        });
      } else {
        userList.filter();
      }
    })


    function loadCate() {
      $.ajax({
        url: "./TabAddToStock/cate.php",
        success: function(data) {

          var json = $.parseJSON(data)
          var str = '<option value="" selected>ทั้งหมด</option>'; // variable to store the options

          for (let i = 0; i < json.length; i++) {
            //console.log(json[i].pCate);
            str += '<option value="' + json[i].pCate + '">' + json[i].pCate + '</option>';
          }
          $('#pCateSelect').html(str)

        }
      });
    }

    function load_product() {
      $.ajax({
        url: "./TabAllProduct/fetch_item.php",
        method: "POST",
        success: function(data) {
          $('#display_item').html(data);
          options = {
            valueNames: ['name', 'cate']
          };
          userList = new List('users', {
            valueNames: ['name', 'cate'],
            page: 36,
            pagination: true
          });
        }
      });
    }

    function load_cart_data() {
      $.ajax({
        url: "./TabAllProduct/fetch_cart.php",
        method: "POST",
        dataType: "json",
        success: function(data) {
          $('#cart_details').html(data.cart_details);
          $('#total_price').text(data.total_price);
          $('#total').text(data.total_item);
        }
      });
    }


    $(document).on('click', '.add_to_cart', function() {
      var product_id = $(this).attr("id");
      var product_name = $('#name' + product_id + '').val();
      var product_price = $('#price' + product_id + '').val();
      var product_quantity = $('#quantity' + product_id).val();
      var action = "add";
      if (product_quantity > 0) {
        $.ajax({
          url: "./TabAllProduct/action.php",
          method: "POST",
          data: {
            product_id: product_id,
            product_name: product_name,
            product_price: product_price,
            product_quantity: product_quantity,
            action: action
          },
          success: function(data) {
            load_cart_data();
            // alert("Item has been Added into Cart");
          }
        });
      } else {
        alert("ระบุจำนวนสินค้า");
      }
    });

    $(document).on('click', '.delete', function() {
      var product_id = $(this).attr("id");
      var action = 'remove';
      if (confirm("ยืนยันที่จะลบสินค้าหรือไม่?")) {
        $.ajax({
          url: "./TabAllProduct/action.php",
          method: "POST",
          data: {
            product_id: product_id,
            action: action
          },
          success: function() {
            load_cart_data();
            $('#cart-popover').popover('hide');
            alert("ลบสินค้าเรียบร้อย");
          }
        })
      } else {
        return false;
      }
    });

    $(document).on('click', '#clear_cart', function() {
      var action = 'empty';
      $.ajax({
        url: "./TabAllProduct/action.php",
        method: "POST",
        data: {
          action: action
        },
        success: function() {
          load_cart_data();
          $('#cartModal').modal('hide');
          alert("ล้างรายการที่เลือกทั้งหมดแล้ว");
        }
      });
    });

    $(document).on('click', '#check_out_cart', function() {
      $.ajax({
        url: "./TabAllProduct/sendOrder.php",
        method: "POST",
        data: {},
        success: function() {
          // load_cart_data();
          // $('#cartModal').modal('hide');
          // alert("ล้างรายการที่เลือกทั้งหมดแล้ว");
        }
      });
    });

  });
</script>