let pID;
let pBar;
let pName;
let pBP;
let pSP;
let pVal;
let pCate;
let pUnit;
let imgFile;

let subID = ""
let subProductVal = ""
let perPack = ""
let paSP = ""
let paCate = ""

let productData = [];
let cateData = [];
let unitData = [];
let FetchData = ""


$(document).ready(function () {
    let defer1 = $.Deferred();
    let defer2 = $.Deferred();
    let defer3 = $.Deferred();



    SetupData.init(
        defer1, defer2, defer3
    );

    $.when(
        defer1, defer2, defer3
    ).done(function (
        result1, result2, result3
    ) {
        if (
            !result1 ||
            !result2 ||
            !result3
        ) {
            return;
        }
        RenderPage.init();
        productTable.init();
        productGrid.init();
        selectProductTablePackProduct.init()


    });
});

let SetupData = (function () {
    let loadProduct = function (defer1) {
        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "findAllProduct"
            },
            success: function (res) {

                if (res.status == 200) {
                    productData = res.data
                    for (let i = 0; i < productData.length; i++) {
                        productData[i].pBars = JSON.parse(productData[i].pBars)
                    }
                    defer1.resolve(true);
                } else {
                    // toastr.error(res.status.message);
                    defer1.resolve(false);
                }

            },
            error: function (res) {
                // toastr.error("ไม่สามารถดึงข้อมูลที่เก็บได้");
                defer1.resolve(false);
            }
        });
    };
    let loadCate = function (defer2) {
        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "findAllCate",
            },
            success: function (res) {
                if (res.status == 200) {
                    cateData = res.data
                    let strCateSelect = '<option value="" selected>ทั้งหมด</option>'; // variable to store the options
                    let strCateDatalist = ''; // variable to store the options
                    for (let i = 0; i < cateData.length; i++) {
                        //console.log(json[i].pCate);
                        strCateSelect += '<option value="' + cateData[i].pCate + '">' + cateData[i].pCate + '</option>';
                        strCateDatalist += '<option value="' + cateData[i].pCate + '" />';

                    }
                    $('#pCateSelect').html(strCateSelect)
                    $('#pCateDatalist').html(strCateDatalist)
                    defer2.resolve(true);
                } else {
                    // toastr.error(res.status.message);
                    defer2.resolve(false);
                }

            },
            error: function (res) {
                // toastr.error("ไม่สามารถดึงข้อมูลที่เก็บได้");
                defer2.resolve(false);
            }
        });
    };
    let loadUnit = function (defer3) {
        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "findAllUnit",
            },
            success: function (res) {
                if (res.status == 200) {
                    unitData = res.data
                    let strUnitSelect = ''; // variable to store the options

                    for (let i = 0; i < unitData.length; i++) {
                        //console.log(json[i].pCate);
                        strUnitSelect += '<option value="' + unitData[i].pUnit + '" />';
                    }
                    $('#pUnitDatalist').html(strUnitSelect)

                    defer3.resolve(true);
                } else {
                    // toastr.error(res.status.message);
                    defer3.resolve(false);
                }

            },
            error: function (res) {
                // toastr.error("ไม่สามารถดึงข้อมูลที่เก็บได้");
                defer3.resolve(false);
            }
        });
    };

    return {
        init: function (
            defer1, defer2, defer3
        ) {
            loadProduct(defer1);
            loadCate(defer2);
            loadUnit(defer3);
        },
    };
})();

let RenderPage = (function () {
    return {
        init: function () {

            $('#searchBarManage').on('keyup search', function (e) {
                productTable.table().search(this.value).draw();
                productGrid.search()
            });

            $('#pCateSelect').change(function () {
                var selection = this.value;
                if (selection) {
                    userList.filter(function (item) {
                        return (item.values().cate == selection);
                    });
                } else {
                    userList.filter();
                }
            })

            $('#pCateSelect').change(function () {
                var selection = this.value;
                table.column(5).search(selection).draw();
            })

            //Add Product
            //Add on Click
            $('#pAdd').click(function (event) {
                {
                    var newID = "";
                    productTable.table().row('.selected').deselect()
                    detailBox("disable", "EditTable");
                    detailBox("disable", "EditGrid");
                    $('#pIDEditTable').val("");
                    $('#pBarEditTable').val("")
                    $('#pNameEditTable').val("")
                    $('#pBPEditTable').val("")
                    $('#pSPEditTable').val("")
                    $('#pValEditTable').val("")
                    $('#pCateEditTable').val("")
                    $('#pUnitEditTable').val("")
                    $('#isPackedEditTable').prop('checked', false);
                    $('#isPackedAdd').prop('checked', false);
                    $.ajax({
                        url: "./api/product.php",
                        method: "POST",
                        data: {
                            mode: "getNewID"
                        },
                        success: function (res) {
                            if (res.status == 200) {
                                newID = res.data;
                                $('#pBarAdd').focus();
                                detailBox("enable", "Add");
                                $('#pIDAdd').val(newID);
                                $('#pBarAdd').val("")
                                $('#pNameAdd').val("")
                                $('#pBPAdd').val("")
                                $('#pSPAdd').val("")
                                $('#pValAdd').val("")
                                $('#pCateAdd').val("")
                                $('#pUnitAdd').val("")
                                pID = newID;
                            }

                        }
                    });

                }
            });
            //Save Add
            $('#pSaveAdd').click(function (event) {
                pID = $('#pIDAdd').val();
                pBar = $('#pBarAdd').val();
                pName = $('#pNameAdd').val();
                pBP = $('#pBPAdd').val();
                pSP = $('#pSPAdd').val();
                pVal = $('#pValAdd').val();
                pCate = $('#pCateAdd').val();
                pUnit = $('#pUnitAdd').val();

                subID = $('#ppID').val();
                perPack = $('#ppaPerPacked').val();
                paSP = $('#ppaSP').val();
                isPacked = $('#isPackedAdd').is(':checked');


                data = {
                    pID: pID,
                    pBar: pBar,
                    pName: pName,
                    pBP: pBP,
                    pSP: pSP,
                    pVal: pVal,
                    pCate: pCate,
                    pUnit: pUnit,
                    subID: subID,
                    perPack: perPack,
                    paSP: paSP,
                    isPacked: isPacked

                }
                if ($('#isPackedAdd').is(':checked')) {
                    addPack(data)
                } else {
                    addProduct(data)
                }
            })
            //End Add

            //Tab Table
            //Save
            $('#pSaveEditTable').click(function (event) {
                event.preventDefault();

                pID = $('#pIDEditTable').val();
                pBar = $('#pBarEditTable').val();
                pName = $('#pNameEditTable').val();
                pBP = $('#pBPEditTable').val();
                pSP = $('#pSPEditTable').val();
                pVal = $('#pValEditTable').val();
                pCate = $('#pCateEditTable').val();
                pUnit = $('#pUnitEditTable').val();

                subID = $('#ppID').val();
                perPack = $('#ppaPerPacked').val();
                paSP = $('#ppaSP').val();
                isPacked = $('#isPackedEditTable').is(':checked') ? 1 : 0;
                data = {
                    pID: pID,
                    pBar: pBar,
                    pName: pName,
                    pBP: pBP,
                    pSP: pSP,
                    pVal: pVal,
                    pCate: pCate,
                    pUnit: pUnit,
                    subID: subID,
                    perPack: perPack,
                    paSP: paSP,
                    isPacked: isPacked
                }




                if ($('#isPackedEditTable').is(':checked')) {
                    editPack(data);
                } else {
                    editProduct(data);

                }
            })
            //DELETE
            $('#pDelTable').click(function (event) {
                event.preventDefault();
                var pID = $('#pIDEditTable').val();
                console.log(pID);
                delProduct(pID);
            });
            //End Tab Table

            //Tab Grid
            //Save
            $('#pSaveEditGrid').click(function (event) {
                event.preventDefault();

                pID = $('#pIDEditGrid').val();
                pBar = $('#pBarEditGrid').val();
                pName = $('#pNameEditGrid').val();
                pBP = $('#pBPEditGrid').val();
                pSP = $('#pSPEditGrid').val();
                pVal = $('#pValEditGrid').val();
                pCate = $('#pCateEditGrid').val();
                pUnit = $('#pUnitEditGrid').val();

                subID = $('#ppID').val();
                perPack = $('#ppaPerPacked').val();
                paSP = $('#ppaSP').val();
                isPacked = $('#isPackedEditGrid').is(':checked') ? 1 : 0;

                data = {
                    pID: pID,
                    pBar: pBar,
                    pName: pName,
                    pBP: pBP,
                    pSP: pSP,
                    pVal: pVal,
                    pCate: pCate,
                    pUnit: pUnit,
                    subID: subID,
                    perPack: perPack,
                    paSP: paSP,
                    isPacked: isPacked
                }

                if ($('#isPackedEditGrid').is(':checked')) {
                    editPack(data);
                } else {
                    editProduct(data);
                }


            })
            //Delete
            $('#pDelGrid').on('click', function (event) {
                event.preventDefault();
                var pID = $(this).parent().parent().find('.id').text();
                delProduct(pID);
            });
            //End Tab Grid

            //Packed Product
            $('#isPackedEditTable,#isPackedEditGrid, #isPackedAdd').on('change', function () {

                if ($('#isPackedEditTable').is(':checked') && $(this).attr("id") == "isPackedEditTable") {
                    $('#managePackEditTable').attr("disabled", false);
                    $('#isPackedEditGrid').attr("checked", false);
                    $('#managePackEditGrid').attr("disabled", true);
                    $('#isPackedAdd').attr("checked", false);
                    $('#manageAdd').attr("disabled", true);

                    $('#pBPEditTable').attr("disabled", true);
                    $('#pSPEditTable').attr("disabled", true);
                    $('#pValEditTable').attr("disabled", true);
                    $('#pCateEditTable').attr("disabled", true);
                } else if ($(this).attr("id") == "isPackedEditTable") {
                    $('#managePackEditTable').attr("disabled", true);
                    $('#pBPEditTable').attr("disabled", false);
                    $('#pSPEditTable').attr("disabled", false);
                    $('#pValEditTable').attr("disabled", false);
                    $('#pCateEditTable').attr("disabled", false);

                }

                if ($('#isPackedAdd').is(':checked') && $(this).attr("id") == "isPackedAdd") {
                    $('#managePackAdd').attr("disabled", false);
                    $('#isPackedEditGrid').attr("checked", false);
                    $('#managePackEditGrid').attr("disabled", true);
                    $('#isPackedEditTable').attr("checked", false);
                    $('#managePackEditTable').attr("disabled", true);

                    $('#pBPAdd').attr("disabled", true);
                    $('#pSPAdd').attr("disabled", true);
                    $('#pValAdd').attr("disabled", true);
                    $('#pCateAdd').attr("disabled", true);
                } else if ($(this).attr("id") == "isPackedAdd") {
                    $('#managePackAdd').attr("disabled", true);
                    $('#pBPAdd').attr("disabled", false);
                    $('#pSPAdd').attr("disabled", false);
                    $('#pValAdd').attr("disabled", false);
                    $('#pCateAdd').attr("disabled", false);

                }

                if ($('#isPackedEditGrid').is(':checked') && $(this).attr("id") == "isPackedEditGrid") {
                    console.log("Edit Grid");
                    $('#managePackEditGrid').attr("disabled", false);
                    $('#isPackedEditTable').attr("checked", false);
                    $('#managePackEditTable').attr("disabled", true);
                    $('#isPackedAdd').attr("checked", false);
                    $('#manageAdd').attr("disabled", true);

                    $('#pBPEditGrid').attr("disabled", true);
                    $('#pSPEditGrid').attr("disabled", true);
                    $('#pValEditGrid').attr("disabled", true);
                    $('#pCateEditGrid').attr("disabled", true);
                } else if ($(this).attr("id") == "isPackedEditGrid") {
                    $('#managePackEditGrid').attr("disabled", true);
                    $('#pBPEditGrid').attr("disabled", false);
                    $('#pSPEditGrid').attr("disabled", false);
                    $('#pValEditGrid').attr("disabled", false);
                    $('#pCateEditGrid').attr("disabled", false);

                }

            });

            $('#managePackEditTable,#managePackEditGrid,#managePackAdd').click(function (event) {
                $('#ppaID').val(pID);
                let id = $(this).attr("id");

                // $.ajax({
                //   url: 'TabManageProduct/selectedPack.php',
                //   method: 'POST',
                //   data: {
                //     pID: pID
                //   },
                //   success: function(data) {
                //     var json = $.parseJSON(data)
                //     $('#ppaID').val(json[0].paID);
                //     $('#ppID').val(json[0].pID);
                //     $('#ppBar').val(json[0].pBar);
                //     $('#ppaPerPacked').val(json[0].paPerPack)
                //     $('#ppaBPerOne').val(json[0].pBP);
                //     subProductVal = json[0].pVal;
                //     if (id == "managePackEditTable") {
                //       $('#ppaID').val(pID);
                //       $('#ppaName').val($('#pNameEditTable').val());
                //       $('#ppaBPerPack').val($('#pBPEditTable').val());
                //       $('#ppaSP').val($('#pSPEditTable').val());
                //       paCate = $('#pCateEditTable').val();

                //     } else if (id == "managePackEditGrid") {
                //       $('#ppaID').val(pID);
                //       $('#ppaName').val($('#pNameEditGrid').val());
                //       $('#ppaBPerPack').val($('#pBPEditGrid').val());
                //       $('#ppaSP').val($('#pSPEditGrid').val());
                //       paCate = $('#pCateEditGrid').val();

                //     }

                //   }
                // })
            });

            $('#managePackAdd').click(function (event) {
                $('#ppaID').val(pID);
            });
            //End Packed Product

            //Sub barcode
            $('#subBarcode').on('shown.bs.modal', function () {
                //Table List
                $('#subBarcodeTable').DataTable({
                    "destroy": true,
                    "ajax": {
                        url: "barcodeTable.php",
                        method: "POST",
                        data: {
                            pID: pID
                        }
                    },
                    "columns": [{
                        data: 'barcode'
                    },
                    {
                        data: 'detail'
                    },
                    {
                        //delete button
                        "render": function (data, type, row, meta) {
                            return '<button type="button" class="btn btn-danger delete"></button>';
                        }
                    }
                    ],
                });

                //Add Barcode
                $('#addSubBarcode').on('click', function () {
                    $.ajax({
                        url: 'api/product.php',
                        method: 'POST',
                        data: {
                            mode: 'addSubBarcode',
                            pID: pID,
                            barcode: $('#subBarcodeBarcode').val(),
                            detail: $('#subBarcodeDetail').val()
                        },
                        success: function (data) {
                            console.log(data)
                            if (data.includes("success")) {
                                alert("เพิ่มบาร์โค้ดสำเร็จ")
                                $('#subBarcodeTable').DataTable().ajax.reload();
                                table.ajax.reload();

                            } else {
                                alert("บาร์โค้ดมีในระบบแล้ว")
                            }
                        }
                    });
                });

                //Delete Barcode
                $('#subBarcode').on('click', 'button.delete', function () {
                    var data = $('#subBarcodeTable').DataTable().row($(this).parents('tr')).data();
                    //check row size
                    if (data['detail'] != "บาร์โค้ดหลัก" && data['detail'] != "รหัสสินค้า") {
                        $.ajax({
                            url: 'TabManageProduct/deleteSubBarcode.php',
                            method: 'POST',
                            data: {
                                mode: 'delSubBarcode',
                                pID: pID,
                                barcode: data['barcode']
                            },
                            success: function (data) {
                                $('#subBarcodeTable').DataTable().ajax.reload();
                                console.log(data)
                            }
                        });
                    } else {
                        alert("ไม่สามารถลบข้อมูลได้")
                    }

                });
            });

            //upload img
            $('#selectImg').change(function (e) {
                imgFile = e.target.files[0];
                var reader = new FileReader();
                reader.onloadend = function () {
                    $('#pImgEditTable').attr('src', reader.result);
                }
                reader.readAsDataURL(imgFile);

            });

            $('#managePackModal').on('show.bs.modal', function () {
                if ($('#addProductModal').hasClass('show')) {
                    $('#ppaID').val("");
                    $('#ppID').val("");
                    $('#ppBar').val('');
                    $('#ppaPerPacked').val('')
                    $('#ppaBPerOne').val('');
                    $('#ppaID').val('');
                    $('#ppaName').val('');
                    $('#ppaBPerPack').val('');
                    $('#ppaSP').val('');
                }

            });
        }
    };
})();

let productTable = (function () {
    let table
    let initTable = function () {

        table = $("#productTable").DataTable({
            fixedHeader: true,
            data: productData,
            responsive: true,
            columns: [{
                data: 'pID'
            },
            {
                data: 'pBar'
            },
            {
                data: 'pName'
            },
            {
                data: 'pSP'
            },
            {
                data: 'pVal'
            },
            {
                data: 'pCate'
            },
            {
                data: 'pBars',
                render: function (data, type) {
                    let bars = "";
                    for (let i = 0; i < data.length; i++) {
                        bars += data[i].barcode + ",";
                    }

                    return bars;
                }
            }

            ],
            order: [[0, "asc"]],
            select: {
                style: 'single',
                select: true,
                toggleable: false
            },
            columnDefs: [{
                "targets": [5, 6],
                "visible": false,
                "searchable": true
            },

            ],
            language: {
                "lengthMenu": "",
                "zeroRecords": "ไม่พบข้อมูล",
                "info": "แสดงหน้าที่ _PAGE_ จาก _PAGES_",
                "infoEmpty": "ไม่มีข้อมูล",
                "infoFiltered": "(ค้นหาจาก _MAX_ total รายการ)",
                "search": "",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ถัดไป",
                    "previous": "ก่อนหน้า"
                },
            },


        });
    };
    return {
        init: function () {
            initTable();
            $('#productTable_filter').find('input[type="search"]').hide()

            //Table On Click
            let containerTable = $(table.table().container());
            //row on click
            table.table().on('select', function (e, dt, type, indexes) {
                let rowData = table.rows(indexes).data().toArray();
                pID = rowData[0].pID;
                let isPacked = 0
                $.ajax({
                    url: 'api/product.php',
                    method: 'POST',
                    data: {
                        mode: 'findProductBypID',
                        pID: pID
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            let product = res.data[0]
                            $('#pIDEditTable').val(product.pID)
                            $('#pBarEditTable').val(product.pBar)
                            $('#pNameEditTable').val(product.pName)
                            $('#pBPEditTable').val(product.pBP)
                            $('#pSPEditTable').val(product.pSP)
                            $('#pValEditTable').val(product.pVal)
                            $('#pCateEditTable').val(product.pCate)
                            $('#pUnitEditTable').val(product.pUnit)
                            $('#pImgEditTable').attr('src', './product_pic/' + product.img)

                            isPacked = product.isPacked
                            $('#isPackedEditTable').prop("checked", product.isPacked == 1);
                            $('#managePackEditTable').attr("disabled", product.isPacked != 1);

                            detailBox("enable", "EditTable");

                            $('#ppID').val("")
                            $('#ppBar').val("")
                            $('#ppaName').val("")
                            $('#ppaPerPacked').val("")
                            $('#ppaBPerOne').val("")
                            $('#ppaBPerPack').val("")
                            $('#ppaSP').val("")


                            if ($('#isPackedEditTable').is(':checked')) {
                                $('#isPackedEditTable').attr("disabled", true);
                                $('#pBPEditTable').attr("disabled", true);
                                $('#pSPEditTable').attr("disabled", true);
                                $('#pValEditTable').attr("disabled", true);
                                $('#pCateEditTable').attr("disabled", true);
                                $('#ppaID').val(pID);
                                $.ajax({
                                    url: 'api/packproduct.php',
                                    method: 'POST',
                                    data: {
                                        mode: "findPackProductBypID",
                                        pID: pID
                                    },
                                    success: function (res) {
                                        if (res.status == 200) {
                                            let packProduct = res.data
                                            $('#ppaID').val(packProduct.paID);
                                            $('#ppID').val(packProduct.pID);
                                            $('#ppBar').val(packProduct.pBar);
                                            $('#ppaPerPacked').val(packProduct.paPerPack)
                                            $('#ppaBPerOne').val(packProduct.pBP);

                                            subProductVal = packProduct.pVal;
                                            $('#ppaID').val(pID);
                                            $('#ppaName').val($('#pNameEditTable').val());
                                            $('#ppaBPerPack').val($('#pBPEditTable').val());
                                            $('#ppaSP').val($('#pSPEditTable').val());
                                            paCate = $('#pCateEditTable').val();
                                        }
                                    }
                                })
                            }

                            $('#pSaveEditTable').attr("disabled", false);
                            $('#pDelTable').attr("disabled", false);
                        }

                    }
                })

            });

        },
        data: function (data) {
            table.clear();
            table.rows.add(data);
            table.draw(false);
        },
        getData: function () {
            return table.rows().data().toArray()
        },
        table: function () {
            return table
        },
    };
})();

let productGrid = (function () {
    let grid
    let initGrid = function (page) {
        var data = new FormData();
        // data.append("s", );
        data.append("s", "");
        data.append("s", $("#searchBarManage").val());
        data.append("mode", "getProductsGrid");
        data.append("paged", page);
        data.append("order_by", "pID");
        data.append("order", "ASC");

        $.ajax({
            url: "./api/product.php",
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.code === '0') {
                    $('#products-list').find('.col').remove();
                    for (var i = 0; i < data.products.length; i++) {
                        var template = $('#product-template').text();
                        // var imgsrc = data.products[i].photo ? data.products[i].photo : "http://placehold.it/220x220";
                        template = template.replace('%%img%%', data.products[i].img);
                        template = template.replace('%%pID%%', data.products[i].pID);
                        template = template.replace('%%pIDValue%%', data.products[i].pID);
                        // template = template.replace('%%alt%%', data.products[i].pName);
                        template = template.replace('%%pName%%', data.products[i].pName);
                        template = template.replace('%%pValText%%', data.products[i].pVal);
                        template = template.replace('%%pValValue%%', data.products[i].pVal);
                        template = template.replace('%%pSP%%', data.products[i].pSP);
                        $('#products-list').append(template);
                    }

                    $(".pagination").empty()
                    $(".pagination").append(data.pagination);


                }
            },
            error: function (data) {
                //any message
            }
        })
    }

    return {
        init: function () {
            initGrid(1);

            //Edit modal on Show
            $('#editProductModal').on('show.bs.modal', function (event) {
                $('#pIDEditGrid').val("")
                $('#pBarEditGrid').val("")
                $('#pNameEditGrid').val("")
                $('#pBPEditGrid').val("")
                $('#pSPEditGrid').val("")
                $('#pValEditGrid').val("")
                $('#pCateEditGrid').val("")
                $('#pUnitEditGrid').val("")

                var button = $(event.relatedTarget) // Button that triggered the modal
                pID = button.val()
                $.ajax({
                    url: 'api/product.php',
                    method: 'POST',
                    data: {
                        mode: 'findProductBypID',
                        pID: pID
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            let product = res.data[0]
                            $('#pIDEditGrid').val(pID);
                            $('#pBarEditGrid').val(product.pBar);
                            $('#pNameEditGrid').val(product.pName);
                            $('#pBPEditGrid').val(product.pBP);
                            $('#pSPEditGrid').val(product.pSP);
                            $('#pValEditGrid').val(product.pVal);
                            $('#pCateEditGrid').val(product.pCate);
                            $('#pUnitEditGrid').val(product.pUnit);

                            $('#isPackedEditGrid').prop("checked", product.isPacked == '1');
                            $('#managePackEditGrid').attr("disabled", product.isPacked != '1');


                            $('#ppID').val("")
                            $('#ppBar').val("")
                            $('#ppaName').val("")
                            $('#ppaPerPacked').val("")
                            $('#ppaBPerOne').val("")
                            $('#ppaBPerPack').val("")
                            $('#ppaSP').val("")


                            if ($('#isPackedEditGrid').is(':checked')) {

                                $('#pBPEditGrid').attr("disabled", true);
                                $('#pSPEditGrid').attr("disabled", true);
                                $('#pValEditGrid').attr("disabled", true);
                                $('#pCateEditGrid').attr("disabled", true);
                                $('#ppaID').val(pID);
                                $.ajax({
                                    url: 'api/packproduct.php',
                                    method: 'POST',
                                    data: {
                                        mode: "findPackProductBypID",
                                        pID: pID
                                    },
                                    success: function (res) {
                                        if (res.status == 200) {
                                            let packProduct = res.data
                                            $('#ppaID').val(packProduct.paID);
                                            $('#ppID').val(packProduct.pID);
                                            $('#ppBar').val(packProduct.pBar);
                                            $('#ppaPerPacked').val(packProduct.paPerPack)
                                            $('#ppaBPerOne').val(packProduct.pBP);
                                            subProductVal = packProduct.pVal;

                                            $('#ppaID').val(pID);
                                            $('#ppaName').val($('#pNameEditGrid').val());
                                            $('#ppaBPerPack').val($('#pBPEditGrid').val());
                                            $('#ppaSP').val($('#pSPEditGrid').val());
                                            paCate = $('#pCateEditGrid').val();
                                        }
                                    }
                                })

                            }

                            $("#editProductModal").modal('show')
                        }

                    }
                })
            });

            $(".pagination").on("click", "a", function () {
                initGrid($(this).attr("page"));
                $("html, body").animate({ scrollTop: 0 }, "medium");
                // $(this).addClass('pagination-item--active')
            });
        },
        search: function () {
            initGrid(1)
        },
        getData: function () {
            return table.rows().data().toArray()
        },
        table: function () {
            return table
        },
    };
})();

let selectProductTablePackProduct = (function () {
    let table
    let initTable = function () {
        table = $("#selectProductTable").DataTable({
            fixedHeader: true,
            data: productData,
            responsive: true,
            columns: [{
                data: 'pID'
            },
            {
                data: 'pBar'
            },
            {
                data: 'pName'
            },
            {
                data: 'pSP'
            },
            {
                data: 'pVal'
            },
            ],
            scrollY: 300,
            scrollCollapse: true,
            scroller: true,
            order: [[0, "asc"]],
            select: {
                style: 'single',
                select: true,
                toggleable: false
            },
            language: {
                "lengthMenu": "",
                "zeroRecords": "ไม่พบข้อมูล",
                "infoEmpty": "ไม่มีข้อมูล",
                "search": "ค้นหา"
            },


        });
    };
    return {
        init: function () {
            initTable();

            //Table On Click
            let containerTable = $(table.table().container());
            //row on click
            table.table().on('select', function (e, dt, type, indexes) {
                let rowData = table.rows(indexes).data().toArray()[0];
                subID = rowData['pID']
                if (subID == pID) {
                    alert("เลือกสินค้าเดียวกันไม่ได้")
                } else {
                    $('#ppID').val(rowData['pID']);
                    $('#ppBar').val(rowData['pBar']);
                    $('#ppaName').val(rowData['pName']);
                    $('#ppaBPerOne').val(rowData['pBP']);
                    $('#ppaBPerPack').val(rowData['pBP']);
                    $('#ppaPerPacked').val("")
                    subProductVal = rowData['pVal']
                    paCate = rowData['pCate']

                    $('#selectProduct').modal('hide');
                }
            });

            $('#selectProduct').on('shown.bs.modal', function () {
                table.columns.adjust();
                $("#selectProduct [type='search']").focus();
                table.on('search.dt', function () {
                    table.row(':eq(0)', {
                        page: 'current'
                    }).select();
                });

                $('#selectProduct').on('keyup', function (e) {
                    if (e.keyCode === 13) {
                        pID = table.row('.selected').data()['pID']
                        $('#selectProduct').modal('hide');
                    }
                })

            });

            $('#selectProduct').on('hide.bs.modal', function () {
                table.row('.selected').deselect()
                $("#selectProduct [type='search']").val("");
                $('#selectProduct').off();

            });

            $('#ppaPerPacked').on('keyup', function () {
                $('#ppaBPerPack').val($('#ppaBPerOne').val() * $('#ppaPerPacked').val());
            });

            $('#ppaSP').on('keyup', function () {
                $('#pSP').val($('#ppaSP').val());
            });

            $('#ppaSave').on('click', function () {
                if ($('#isPackedAdd').is(':checked')) {
                    $('#pBPAdd').val($('#ppaBPerPack').val());
                    $('#pSPAdd').val($('#ppaSP').val());
                    $('#pValAdd').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
                    $('#pCateAdd').val(paCate);
                } else if ($('#isPackedEditTable').is(':checked')) {
                    $('#pBPEditTable').val($('#ppaBPerPack').val());
                    $('#pSPEditTable').val($('#ppaSP').val());
                    $('#pValEditTable').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
                    $('#pCateEditTable').val(paCate);
                } else if ($('#isPackedEditGrid').is(':checked')) {
                    $('#pBPEditGrid').val($('#ppaBPerPack').val());
                    $('#pSPEditGrid').val($('#ppaSP').val());
                    $('#pValEditGrid').val(Math.floor(subProductVal / $('#ppaPerPacked').val()).toFixed(0));
                    $('#pCateEditGrid').val(paCate);
                }



            });



        },
        data: function (data) {
            table.clear();
            table.rows.add(data);
            table.draw(false);
        },
        getData: function () {
            return table.rows().data().toArray()
        },
        table: function () {
            return table
        },
    };
})();

// let selectDataProductTable = $('#selectProductTable').DataTable({
//     "ajax": "./ajax/product.php",
//     "columns": [{
//         data: 'pID'
//     },
//     {
//         data: 'pBar'
//     },
//     {
//         data: 'pName'
//     },
//     {
//         data: 'pSP'
//     },
//     {
//         data: 'pVal'
//     },
//     ],
//     deferRender: true,
//     scrollY: 300,
//     scrollCollapse: true,
//     scroller: true,
//     select: {
//         style: 'single',
//         select: true,
//         toggleable: false
//     },
//     // "paging": false
// });

function detailBox(mode, type) {
    if (mode == "enable") {
        $('#pBar' + type).attr("disabled", false);
        $('#pName' + type).attr("disabled", false);
        $('#pBP' + type).attr("disabled", false);
        $('#pSP' + type).attr("disabled", false);
        $('#pVal' + type).attr("disabled", false);
        $('#pCate' + type).attr("disabled", false);
        $('#pUnit' + type).attr("disabled", false);
        $('#barManage' + type).attr("disabled", false);

        $('#isPacked' + type).attr("disabled", false);
        $('#formFile' + type).attr("disabled", false);



    } else {
        $('#pID' + type).attr("disabled", true);
        $('#pBar' + type).attr("disabled", true);
        $('#pName' + type).attr("disabled", true);
        $('#pBP' + type).attr("disabled", true);
        $('#pSP' + type).attr("disabled", true);
        $('#pVal' + type).attr("disabled", true);
        $('#pCate' + type).attr("disabled", true);
        $('#pUnit' + type).attr("disabled", true);
        $('#barManage' + type).attr("disabled", true);
        $('#managePack' + type).attr("disabled", true);
        $('#isPacked' + type).attr("disabled", true);
        $('#formFile' + type).attr("disabled", true);

    }
}

function addProduct(data) {
    let pID = data.pID;

    if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
    } else {
        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "add",
                pID: data.pID,
                pBar: data.pBar,
                pName: data.pName,
                pBP: data.pBP,
                pSP: data.pSP,
                pVal: data.pVal,
                pCate: data.pCate,
                pUnit: data.pUnit,
            },
            success: function (res) {
                if (res.status == 200) {
                    detailBox("disable", "Add");
                    $('#pSaveEditTable').attr("disabled", true);
                    $('#pDelTable').attr("disabled", true);

                    if (imgFile != undefined) {
                        formData = new FormData();
                        if (!!imgFile.type.match(/image.*/)) {
                            formData.append("image", imgFile);
                            formData.append("pID", pID);
                            $.ajax({
                                url: "./api/product.php",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {

                                }
                            });
                        } else {
                            alert('รูปภาพไม่ถูกต้อง');
                        }
                    }
                    alert(res.message)
                    productData = res.data
                    productTable.data(productData)
                    selectProductTablePackProduct.data(productData)

                }
                else {
                    alert(res.message)
                }
            }
        });
    }
}

function addPack(data) {
    if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '' || data.subID == '' || data.perPack == '' || data.paSP == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
    } else {
        $.ajax({
            url: "./api/packproduct.php",
            method: "POST",
            data: {
                mode: "savePack",
                paIDSave: pID,
                pIDSave: subID,
                paNameSave: pName,
                paPerPackSave: perPack
            },
            success: function (res) {
                if (res.status == 200) {
                    alert(res.message)
                }
            }
        });

        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "add",
                pID: data.pID,
                pBar: data.pBar,
                pName: data.pName,
                pBP: data.pBP,
                pSP: data.pSP,
                pVal: data.pVal,
                pCate: data.pCate,
                pUnit: data.pUnit,
                isPacked: 1,
            },
            success: function (data) {
                if (res.status == 200) {
                    detailBox("disable", "Add");
                    $('#pSaveEditTable').attr("disabled", true);
                    $('#pDelTable').attr("disabled", true);
                    $('#subButAdd').click()

                    alert(res.message)
                    productData = res.data
                    productTable.data(productData)
                    selectProductTablePackProduct.data(productData)
                }
                else {
                    alert(res.message)
                }

            }
        });


    }
}

function editProduct(data) {
    let pID = data.pID;
    if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
    } else {

        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "edit",
                pID: data.pID,
                pBar: data.pBar,
                pName: data.pName,
                pBP: data.pBP,
                pSP: data.pSP,
                pVal: data.pVal,
                pCate: data.pCate,
                pUnit: data.pUnit,

            },
            success: function (res) {
                if (res.status == 200) {

                    detailBox("disable", "EditTable");
                    $('#pSaveEditTable').attr("disabled", true);
                    $('#Table').attr("disabled", true);

                    if (imgFile != undefined) {
                        formData = new FormData();
                        if (!!imgFile.type.match(/image.*/)) {
                            formData.append("image", imgFile);
                            formData.append("pID", pID);
                            $.ajax({
                                url: "./api/product.php",
                                type: "POST",
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function (data) {

                                }
                            });
                        } else {
                            alert('รูปภาพไม่ถูกต้อง');
                        }
                    }
                    alert(res.message)
                    productData = res.data
                    productTable.data(productData)
                    selectProductTablePackProduct.data(productData)
                    productGrid.search()
                    $('#editProductModal').modal('hide');

                } else {
                    alert(res.message);
                }

            }
        });
    }


}

function editPack(data) {
    if (data.pID == '' || data.pBar == '' || data.pName == '' || data.pBP == '' || data.pSP == '' || data.pVal == '' || data.pCate == '' || data.pUnit == '' || data.subID == '' || data.perPack == '' || data.paSP == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
    } else {
        $.ajax({
            url: "./api/packproduct.php",
            method: "POST",
            data: {
                mode: "savePack",
                paIDSave: pID,
                pIDSave: subID,
                paNameSave: pName,
                paPerPackSave: perPack
            },
            success: function (data) {
                if (res.status == 200) {
                    alert(res.message)
                }
            }
        });

        $.ajax({
            url: "./api/product.php",
            method: "POST",
            data: {
                mode: "edit",
                pID: data.pID,
                pBar: data.pBar,
                pName: data.pName,
                pBP: data.pBP,
                pSP: data.pSP,
                pVal: data.pVal,
                pCate: data.pCate,
                pUnit: data.pUnit,
                isPacked: 1,
            },
            success: function (res) {
                if (res.status == 200) {
                    // load_product();
                    detailBox("disable", "Add");
                    $('#pSaveEditTable').attr("disabled", true);
                    $('#pDelTable').attr("disabled", true);
                    $('#subButAdd').click()
                    alert(res.message)
                    productData = res.data
                    productTable.data(productData)
                    selectProductTablePackProduct.data(productData)
                } else {
                    alert(res.message);
                }

            }
        });


    }
}

function delProduct(id) {
    $.ajax({
        url: "./api/product.php",
        method: "POST",
        data: {
            mode: "askDel",
            pID: id,
        },
        success: function (res) {
            if (res.status == 200) {
                if (confirm(res.message)) {
                    $.ajax({
                        url: "./api/product.php",
                        method: "POST",
                        data: {
                            mode: "del",
                            pID: id,
                        },
                        success: function (res) {
                            detailBox("disable", "EditTable");

                            alert(res.message)
                            productData = res.data
                            productTable.data(productData)
                            selectProductTablePackProduct.data(productData)

                            $('#pIDEditTable').val("")
                            $('#pBarEditTable').val("")
                            $('#pNameEditTable').val("")
                            $('#pBPEditTable').val("")
                            $('#pSPEditTable').val("")
                            $('#pValEditTable').val("")
                            $('#pCateEditTable').val("")
                            $('#pUnitEditTable').val("")
                            $('#pImgEditTable').attr('src', './product_pic/P00000.png')
                        }
                    });
                } else {
                    alert("ยกเลิกการลบสินค้า");
                }
            }

        }
    });





}