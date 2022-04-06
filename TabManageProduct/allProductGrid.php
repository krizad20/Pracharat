<div class="d-flex" style="width: 100%;" id="items">
  <div class="card" style="width: 100%;">
    <div class="card-header">
      <div class="row mt-2">
        <div class="col-md-6 d-flex me-auto">
          <div class="d-flex">
            <input class="search form-control me-2" type="search" id="searchBar" placeholder="ค้นหาสินค้า" aria-label="Search" autofocus>
            <button class="sort btn btn-success text-nowrap" type="button" data-sort="name" style="width: fit-content;font-size: 50%;"> เรียงตามชื่อ</button>
          </div>

        </div>
        <div class="col-md-6 d-flex justify-content-center">
          <select class="form-select form-select-sm" name="cate" id="pCateSelect">
          </select>
        </div>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto position-sticky">
      <div class="list row overflow-auto" id="display_item" style="height: 60vh;">
      </div>
    </div>

    <div class="card-footer position-sticky fixed-bottom">
      <div class="d-flex justify-content-center " style="font-size: medium;">
        <ul class="pagination"></ul>
      </div>
    </div>

  </div>
</div>
