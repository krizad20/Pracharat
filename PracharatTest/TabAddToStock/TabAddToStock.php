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

<script src="./TabAddToStock/TabAddToStock.js"></script>