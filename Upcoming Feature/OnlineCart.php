<?php
include("./system/header.php");
//session_start()
?>

<div class="container-fluid">
  <div id="users">
    <form class="row g-3 mt-2">
      <div class="col-md-5 d-flex justify-content-center">
        <div class="row">
          <input class="search form-control me-2" type="search" placeholder="ค้นหาสินค้า" aria-label="Search" style="width: fit-content;">
          <button class="sort btn btn-success text-nowrap" type="button" data-sort="name" style="width: fit-content;font-size: 50%;"> เรียงตามชื่อ</button>
        </div>

      </div>
      <div class="col-md-5 d-flex justify-content-center">
        <select class="form-select form-select-sm" name="cate" id="pCateSelect" style="width: fit-content;">
        </select>
      </div>
      <div class="col-md-2 d-flex justify-content-center">
        <a class="btn p-2" data-bs-toggle="modal" data-bs-target="#cartModal">
          <span class="badge bg-success">
            สินค้าที่เลือก
          </span>
          <span class="badge bg-success" id="total_price">฿ 0.00</span>
          <span class="position-relative">
            <img src="img/cart.png" width="25" height="25">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="total"></span>
          </span>
        </a>
      </div>

    </form>

    <div class="list row" id="display_item">
    </div>
    <div class="d-flex justify-content-center mt-2" style="font-size: medium;">
      <ul class="pagination"></ul>
    </div>


  </div>
</div>

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
        data: {
          menu: 'addCart'
        },
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
        data: {
        },
        success: function() {
          // load_cart_data();
          // $('#cartModal').modal('hide');
          // alert("ล้างรายการที่เลือกทั้งหมดแล้ว");
        }
      });
    });

  });
</script>