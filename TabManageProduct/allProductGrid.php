<style>
  .item-container {
    display: grid;
    padding: 1rem;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    grid-gap: 1rem;
  }

  .item {
    display: grid;
  }

  .card .button {
    align-self: end;
  }
</style>


<div class="d-flex" style="width: 100%;" id="items">
  <div class="card" style="width: 100%;">
    <div class="card-header">
      <div class="d-flex justify-content-between">
        <div class="d-flex">
          <input class="search form-control me-2" type="search" id="searchBar" placeholder="ค้นหาสินค้า" aria-label="Search" autofocus>
          <button class="sort btn btn-success text-nowrap" type="button" data-sort="name" style="width: fit-content;font-size: 50%;"> เรียงตามชื่อ</button>
        </div>
        <div class="d-flex">
          <select class="form-select form-select-sm" name="cate" id="pCateSelect">
          </select>
        </div>


      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body overflow-auto position-sticky p-0">
      <div class="list item-container" id="display_item" style="height: 60vh;">
      </div>
    </div>

    <div class="card-footer position-sticky fixed-bottom">
      <div class="d-flex justify-content-center " style="font-size: medium;">
        <ul class="pagination"></ul>
      </div>
    </div>

  </div>
</div>