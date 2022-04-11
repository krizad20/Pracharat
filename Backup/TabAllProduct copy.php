<?php
include("./system\headerCustomer.php");
include("./system\server.php");
?>

<body>

  <div class="container-fluid">
    <div class="row">
      <div class="row mt-3">
        <div class="input-group col-8">
          <input class="form-control" type="text" id="searchVal" placeholder="ค้นหาสินค้า...">
          <button class="btn btn-outline-secondary" type="button" id="search">ค้นหา</button>
        </div>
        <select class="form-select flex-fill col-4" id="pCateSelect">
        </select>
      </div>
      <div class="row" id="cardRow">
      </div>

    </div>
  </div>



</body>
<script>
  $(document).ready(function() {
    var list = [];

    loadAjax()

    $('#pCateSelect').change(function() {
      $('.col-2').removeClass('d-none');
      $('.row .col-2 .card ').find('.card-header:not(:contains("' + $('#pCateSelect').val() + '"))').parent().parent().addClass('d-none');
      $('.row .col-2 .card ').find('.card-header:not(:contains("' + $('#searchVal').val() + '"))').parent().parent().addClass('d-none');

    })

    $('#search').on('click', function() {
      $('.row .col-2 .card ').find('.card-header:contains("' + $('#pCateSelect').val() + '")').parent().parent().removeClass('d-none');
      $('.row .col-2 .card ').find('.card-header:not(:contains("' + $('#searchVal').val() + '"))').parent().parent().addClass('d-none');
    })

    function loadAjax() {
      $.ajax({
        url: "./ajax/cate.php",
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

      $.ajax({
        url: "./TabAllProduct/showAllProduct.php",
        success: function(data) {
          $('#cardRow').html(data)

        }
      });
    }

  });
</script>