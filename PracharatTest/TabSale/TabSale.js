let userList;
let sID = $("input[type=radio][name=saleID]:checked").val()
let cID = "";
let totalPrice = 0;
let date = getThaiDate();

let cateData = []
let customerData = []
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
        // productTable.init();
        productGrid.init();
        selectCustomerTable.init()
        // selectProductTablePackProduct.init()


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

    let loadCustomer = function (defer3) {
        $.ajax({
            url: "./api/customer.php",
            method: "POST",
            data:
                { mode: "findAllCustomer" }
            ,
            success: function (res) {
                res = JSON.parse(res)
                if (res.status == 200) {
                    customerData = res.data
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
            loadCustomer(defer3)
        },
    };
})();

let RenderPage = (function () {
    return {
        init: function () {
            $.fn.dataTable.ext.errMode = 'throw';

            $(document).on('keypress', function (e) {
                // e.preventDefault();
                //modol show check
                if ($('.modal').is(':visible')) {

                } else if (($('.quantity').is(':focus'))) {

                } else {
                    $('#searchBar').focus();
                    if ($('#searchBar').focus() != true) {
                        $('#searchBar').focus();
                    }
                }

            });

            $('#date').text("วันที่ : " + getThaiDate());

            $('#searchBar').on('keyup search', function (e) {
                productGrid.search()
            });

            $('#searchBar').on('keypress', function (e) {
                if (e.keyCode == 13) {
                    e.preventDefault();
                    let search = $('#searchBar').val();
                    let isHave = false;

                    ThaiToEng(search);

                    productGrid.search(search)

                    let product = $("#productDiv").find('.product-item')
  
                    if (product.length <= 0) {
                        alert("ไม่พบสินค้า");
                        $('#searchBar').select();
                        return
                    }

                    product.find('button')[0].click()

                }
            });

            $('#pCateSelect').change(function () {
                // var selection = this.value;
                // if (selection) {
                //     userList.filter(function (item) {
                //         return (item.values().cate == selection);
                //     });
                // } else {
                //     userList.filter();
                // }
            })

            $('input[type=radio][name=saleID]').change(function () {
                sID = this.value;
                load_cart_data();
            });





            $("#cartDiv").on('click', '.delete', function () {
                var product_id = $(this).parent().parent().attr("id");
                var action = 'remove';
                let oldVal = $(this).parent().parent().find('input').val();
                deleteFromCart(product_id, oldVal);

            });

            $("#cartDiv").on('click', '#clearCart', function () {
                var action = 'empty';
                $.ajax({
                    url: "./TabPOS/posAction.php",
                    method: "POST",
                    data: {
                        sID: sID,
                        action: action
                    },
                    success: function () {
                        load_cart_data();
                        cID = "";

                    }
                });
            });

            $("#cartDiv").on('change', '.quantity', function () {
                //get old value
                var old_quantity = $(this).attr("name");
                var product_id = $(this).parent().parent().attr("id");
                var quantity = parseInt($(this).val());
                var action = 'quantity_change';
                var pStock = parseInt($('#' + product_id).attr("value"));

                if (quantity > 0) {
                    $.ajax({
                        url: "./TabPOS/posAction.php",
                        method: "POST",
                        data: {
                            sID: sID,
                            pID: product_id,
                            quantity: quantity,
                            action: action
                        },
                        success: function (data) {
                            if (data == 'success') {
                                load_cart_data();
                            } else {
                                alert("จำนวนสินค้าไม่พอ");
                                load_cart_data();

                                // $(this).val(old_quantity);
                            }
                        }
                    });

                } else if (quantity != '' || quantity <= 0) {
                    alert("จำนวนสินค้าต้องมากกว่า 0");
                    $(this).val(old_quantity);
                }
            });

            //Note
            $('#addNote').on('shown.bs.modal', function () {
                $('#addNoteVal').focus();
            });

            //checkBill
            $('#checkBill').on('click', function () {
                if (!cID || cID == "") {
                    alert("กรุณาเลือกลูกค้า");
                } else if (totalPrice == 0) {
                    alert("กรุณาเลือกสินค้า");
                } else if (totalPrice < 0) {
                    alert("ยอดรวมเป็นลบไม่ได้");
                } else {
                    $('#change').modal('show');
                }
            });
            $("#change").on('shown.bs.modal', function () {
                let price = totalPrice;
                let sale = 0;
                let total = (price - (0 - sale)).toFixed(2);
                let change;
                let totalReceive;

                $('#price').html(price);
                $('#salePrice').html(sale);
                $('#totalPriceChange').html(total);
                $('#receivePrice').val("");
                $('#receivePricePra').val("");
                $('#receivePriceHalf').val("");

                $('#receivePrice').focus();
                $("#change").on('keyup', function (e) {
                    if (e.keyCode === 13) {
                        bMoney = parseFloat($('#receivePrice').val() - 0);
                        bPra = parseFloat($('#receivePricePra').val() - 0);
                        bHalf = parseFloat($('#receivePriceHalf').val() - 0);
                        totalReceive = parseFloat(bMoney + bPra + bHalf).toFixed(2);
                        $('#receivePrice').val(bMoney.toFixed(2));
                        $('#receivePricePra').val(bPra.toFixed(2));
                        $('#receivePriceHalf').val(bHalf.toFixed(2));
                        change = parseFloat(totalReceive - total).toFixed(2);
                        $('#changePrice').css("color", "black");
                        if (change < 0) {
                            $('#receivePrice').select();
                            $('#changePrice').css("color", "red");
                            $('#changePrice').html(change);
                        } else if (change == $('#changePrice').html()) {
                            let action = 'checkBill';
                            $.ajax({
                                url: "./TabPOS/posAction.php",
                                type: "POST",
                                data: {
                                    action: action,
                                    sID: sID,
                                    cID: cID,
                                    bDate: getDateTime(),
                                    bMoney: bMoney,
                                    bPra: bPra,
                                    bHalf: bHalf,
                                    bDis: 0,
                                    bTotal: totalPrice,
                                    bNote: $('#addNoteVal').val(),
                                },
                                success: function (result) {
                                    if (result.includes("B")) {
                                        $('#changePrice').html(change);
                                        $('#change').modal('hide');
                                        $('#totalPrice').html((-change).toFixed(2) + '฿');
                                        $('#totalPrice').css("color", "red");
                                        $('#discountPrice').css("color", "red");
                                        $('#bill').html("เลขที่บิล : " + result);
                                        $('#checkBill').prop('disabled', true);
                                        $('#note').prop('disabled', true);

                                        $('#searchBar').val("");
                                        cID = ""
                                        $('#customer').text("ลูกค้า : ");

                                    } else {
                                        alert(result);
                                    }
                                }
                            });

                        } else {
                            $('#changePrice').html(change);
                        }
                    }
                })

            });
            $("#change").on('hide.bs.modal', function () {
                $('#receivePrice').val("");
                $('#receivePricePra').val("");
                $('#receivePriceHalf').val("");
                $('#changePrice').html("");
                $('#change').off('keyup');
            });







        }
    };
})();

let productGrid = (function () {
    let initGrid = function (page) {
        let data = new FormData();
        let searchVal = $("#searchBar").val() != "" ? $("#searchBar").val() : ""
        // data.append("s", );
        data.append("s", searchVal);
        data.append("mode", "getProductsGrid");
        data.append("paged", page);
        data.append("order_by", "pFav");
        data.append("order", "ASC");
        data.append("per_page", 30);


        $.ajax({
            url: "./api/product.php",
            type: 'POST',
            data: data,
            contentType: false,
            processData: false,
            success: function (data) {

                if (data.code === '0') {
                    $('#products-list').find('.col').remove();
                    for (let i = 0; i < data.products.length; i++) {
                        let template = $('#product-template').text();
                        // var imgsrc = data.products[i].photo ? data.products[i].photo : "http://placehold.it/220x220";
                        template = template.replaceAll('%%img%%', data.products[i].img);
                        template = template.replaceAll('%%pID%%', data.products[i].pID);
                        template = template.replaceAll('%%pBar%%', data.products[i].pBar);
                        template = template.replaceAll('%%pName%%', data.products[i].pName);
                        template = template.replaceAll('%%pSP%%', data.products[i].pSP);
                        template = template.replaceAll('%%pBP%%', data.products[i].pBP);
                        template = template.replaceAll('%%pVal%%', data.products[i].pVal);

                        if (data.products[i].pVal > 0) {
                            template = template.replaceAll('%%buttonClass%%', "btn-success add_to_cart");
                            template = template.replaceAll('%%buttonText%%', "ใส่ตะกร้า");

                        }
                        else {
                            template = template.replaceAll('%%buttonClass%%', "btn-danger add_to_stock");
                            template = template.replaceAll('%%buttonText%%', "เพิ่มสต็อค");
                        }

                        if (data.products[i].pFav > 0) {
                            template = template.replaceAll('%%iconClass%%', "fa-solid fa-heart text-danger");
                        }
                        else {
                            template = template.replaceAll('%%iconClass%%', "fa-regular fa-heart text-dark");

                        }
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
            $("#productDiv").on("click", ".pagination a", function () {
                initGrid($(this).attr("page"));
                $("html, body").animate({ scrollTop: 0 }, "medium");
                // $(this).addClass('pagination-item--active')
            });

            $("#productDiv").on('click', '.add_to_cart', function () {

                let product_id = $(this).attr("pID");
                let product_quantity = 1;
                let pStock = $(this).attr("value");

                if (product_quantity > 0 && product_quantity <= pStock) {
                    addToCart(product_id);
                } else {
                    alert("จำนวนสินค้าไม่พอ");
                }
            });

            $("#productDiv").on('click', '.add_fav', function () {
                //No Fav -> Fav
                let product_id = $(this).attr("pID");
                let mode = "";
                //No Fav -> Fav
                if ($(this).children().hasClass('fa-regular')) {

                    $(this).children().toggleClass('fa-solid fa-regular');
                    $(this).children().toggleClass('text-dark text-danger');

                    mode = "addFavProduct";
                }
                //Fav -> No Fav
                else {
                    $(this).children().toggleClass('fa-solid fa-regular');
                    $(this).children().toggleClass('text-dark text-danger');

                    mode = "removeFavProduct";

                }

                $.ajax({
                    url: "./api/product.php",
                    method: "POST",
                    data: {
                        pID: product_id,
                        mode: mode
                    },
                    success: function (res) {
                        if (res.status == 200) {
                            productGrid.search()
                        }
                    }
                });


            });
            //Add To Stock
            $("#productDiv").on('click', '.add_to_stock', function () {

                let pID = $(this).attr("pID");
                let pBar = $(this).attr("pBar");
                let pName = $(this).attr("pName");
                let pBP = $(this).attr("pBP");
                let pSP = $(this).attr("pSP");
                
                let data = {
                    pID: pID,
                    pName: pName,
                    pBP: pBP,
                    pSP: pSP,
                    pVal: 0,
                    pBar: pBar,
                };
                
                selectProduct(data);
                showModal("noSelect");



            });
        },
        search: function () {
            initGrid(1)
        }
    };
})();

let selectCustomerTable = (function () {
    let table
    let initTable = function () {
        table = $("#selectCustomerTable").DataTable({
            fixedHeader: true,
            data: customerData,
            columns: [{
                data: 'cHouse'
            },
            {
                data: 'cName'
            },
            {
                data: 'cSer'
            },
            ],
            deferRender: true,
            scrollY: 300,
            scrollCollapse: true,
            scroller: true,
            select: {
                style: 'single',
                select: true,
                toggleable: false
            }

        });
    };
    return {
        init: function () {
            initTable();

            //Table On Click
            // let containerTable = $(table.table().container());
            // table.table().on('select', function (e, dt, type, indexes) {
            //     isAdd = false;
            //     let rowData = table.rows(indexes).data().toArray();
            //     let cID = rowData[0].cID;
            //     $.ajax({
            //         url: 'api/customer.php',
            //         method: 'POST',
            //         data:
            //         {
            //             mode: "findCustomerBycID",
            //             cID: cID
            //         },
            //         success: function (res) {
            //             res = JSON.parse(res)
            //             let data = res.data[0]
            //             $('#cID').val(data.cID)
            //             $('#cID').attr("disabled", true);
            //             $('#cName').val(data.cName)
            //             $('#cName').attr("disabled", false);
            //             $('#cSer').val(data.cSer)
            //             $('#cSer').attr("disabled", false);
            //             $('#cHouse').val(data.cHouse)
            //             $('#cHouse').attr("disabled", false);
            //             $('#cMoo').val(data.cMoo)
            //             $('#cMoo').attr("disabled", false);
            //             if (data.cIsMem == "1") {
            //                 $('#cMem').prop("checked", true);
            //             } else if (data.cIsMem == "2") {
            //                 $('#cNotMem').prop("checked", true);
            //             } else if (data.cIsMem == "3") {
            //                 $('#cNotMoo').prop("checked", true);
            //             }

            //             $('#cSave').attr("disabled", false);
            //             $('#cDel').attr("disabled", false);
            //             $('#cMem').attr("disabled", false);
            //             $('#cNotMem').attr("disabled", false);
            //             $('#cNotMoo').attr("disabled", false);

            //         }
            //     })
            // });

            $('#selectCustomerTable tbody').on('dblclick', 'tr', function (row, data, index) {
                let rowData = table.row(this).data();
                cID = rowData.cID
                $('#customer').html("ลูกค้า : " + rowData.cName)
                setCustomer(sID, cID)
                $('#selectCustomer').modal('hide');

            });


            $('#selectCustomer').on('keyup', function (e) {
                e.preventDefault()
                if (e.keyCode == 13) {
                    cID = table.row('.selected').data()['cID']
                    $('#customer').html("ลูกค้า : " + table.row('.selected').data()['cName'])
                    setCustomer(sID, cID)
                    $('#selectCustomer').modal('hide');
                }
            })

            $('#selectCustomer').on('shown.bs.modal', function () {
                table.columns.adjust();
                $("#selectCustomer [type='search']").focus();
                $("#selectCustomer [type='search']").val("");

                table.on('search.dt', function () {
                    if ($("#selectCustomer [type='search']").val() != '') {
                        table.row(':eq(0)', {
                            page: 'current'
                        }).select();
                    }

                });

            });

            $('#selectCustomer').on('hide.bs.modal', function () {
                $("#selectCustomer [type='search']").val("");
                table.search('')
                table.row('.selected').deselect()
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


function getDateTime() {
    var date = new Date();
    var hour = date.getHours();
    hour = (hour < 10 ? "0" : "") + hour;
    var min = date.getMinutes();
    min = (min < 10 ? "0" : "") + min;
    var sec = date.getSeconds();
    sec = (sec < 10 ? "0" : "") + sec;
    var year = date.getFullYear();
    var month = date.getMonth() + 1;
    month = (month < 10 ? "0" : "") + month;
    var day = date.getDate();
    day = (day < 10 ? "0" : "") + day;
    return year + "-" + month + "-" + day + " " + hour + ":" + min + ":" + sec;
}

function load_cart_data() {

    $.ajax({
        url: "./TabAllProduct/fetch_cart.php",
        method: "POST",
        data: {
            sID: sID ? sID : 's1'
        },
        dataType: "json",
        success: function (data) {

            $('#cart_details').html(data.cart_details);
            $('#totalPrice').text(data.total_price + '฿');
            $('#total').text(data.total_item);
            $('#bill').text("เลขที่บิล :");
            $('#customer').text("ลูกค้า : " + data.customer_name);
            cID = data.customer_id;
            totalPrice = data.total_price;

            $('#totalPrice').css("color", "black");
            $('#discountPrice').css("color", "black");
            $('#checkBill').prop('disabled', false);
            $('#note').prop('disabled', false);

        }
    });
}

function addToCart(pID) {
    $.ajax({
        url: "./TabPOS/posAction.php",
        method: "POST",
        data: {
            sID: sID,
            cID: cID,
            pID: pID,
            quantity: 1,
            action: "add"
        },
        success: function (data) {
            load_cart_data();
            $('#searchBar').focus();
            $('.bars').each(function () {
                if ($(this).text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    let newVal = parseInt($('#' + id).attr("value")) - 1;
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (newVal == 0) {
                        $('#' + id).addClass("d-none");
                        let addToStockButton = '<button type="button" name="add_to_cart" id="' + id + '"class="btn btn-danger add_to_stock btn-sm" value = "' + newVal + '">เพิ่มสต็อค</button>'
                        $('#' + id).parent().append(addToStockButton);
                    }
                }

                if ($(this).parent().find('.hasPacked').text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    let newVal = parseInt($('#' + id).attr("value") - $(this).parent().find('.hasPacked').attr("value"));
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (newVal == 0) {
                        $('#' + id).addClass("d-none");
                        let addToStockButton = '<button type="button" name="add_to_cart" id="' + id + '"class="btn btn-danger add_to_stock btn-sm" value = "' + newVal + '">เพิ่มสต็อค</button>'
                        $('#' + id).parent().append(addToStockButton);
                    }
                }

                if ($(this).parent().find('.isPacked').text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    id2 = $(this).parent().find('.isPacked').text();
                    let newVal = Math.floor(($('#' + id2).attr("value") - 1) / $(this).parent().find('.isPacked').attr("value"));
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (newVal == 0 && $('#' + id).parent().find('.add_to_stock').length == 0) {
                        $('#' + id).addClass("d-none");
                        let addToStockButton = '<button type="button" name="add_to_cart" id="' + id + '"class="btn btn-danger add_to_stock btn-sm" value = "' + newVal + '">เพิ่มสต็อค</button>'
                        $('#' + id).parent().append(addToStockButton);
                    }
                }
            });


        }
    });
}

function deleteFromCart(pID, oldVal) {
    $.ajax({
        url: "./TabPOS/posAction.php",
        method: "POST",
        data: {
            sID: sID,
            pID: pID,
            action: "remove"
        },
        success: function () {
            load_cart_data();
            $('.bars').each(function () {
                if ($(this).text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    let newVal = parseInt($('#' + id).attr("value")) + parseInt(oldVal);
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (newVal == oldVal) {
                        $(this).parent().find('.add_to_stock').addClass("d-none");
                        $(this).parent().find('.add_to_cart').removeClass("d-none");

                    }
                }

                if ($(this).parent().find('.hasPacked').text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    let newVal = parseInt($('#' + id).attr("value")) + parseInt($(this).parent().find('.hasPacked').attr("value"));
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (newVal == $(this).parent().find('.hasPacked').attr("value")) {
                        $(this).parent().find('.add_to_stock').addClass("d-none");
                        $(this).parent().find('.add_to_cart').removeClass("d-none");
                    }
                }

                if ($(this).parent().find('.isPacked').text().toLowerCase().indexOf(pID.toLowerCase()) > -1) {
                    id = $(this).attr("value");
                    id2 = $(this).parent().find('.isPacked').text();
                    let newVal = Math.floor((parseInt($('#' + id2).attr("value")) + parseInt(oldVal)) / $(this).parent().find('.isPacked').attr("value"));
                    $('#' + id).attr("value", newVal);
                    $('#' + id + 'Text').text("เหลือ " + newVal);

                    if (Math.floor(oldVal / $(this).parent().find('.isPacked').attr("value")) == newVal) {
                        $(this).parent().find('.add_to_stock').addClass("d-none");
                        $(this).parent().find('.add_to_cart').removeClass("d-none");
                    }
                }
            });
        }
    })
}

function setCustomer(sID, cID) {
    $.ajax({
        url: "./TabPOS/posAction.php",
        method: "POST",
        data: {
            sID: sID,
            cID: cID,
            action: 'setCustomer'
        },
        success: function (data) { }
    });
}

function getThaiDate() {
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear() + 543;

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    today = dd + '/' + mm + '/' + yyyy;

    return today;
}

//Thai-English Keyboard Mapping
function ThaiToEng(string) {

    let eng = "";
    let mapKeyBoardJSON = {
        'ๅ': '1',
        '+': '!',
        '1': '@',
        '/': '2',
        '-': '3',
        '2': '#',
        'ภ': '4',
        '3': '$',
        'ถ': '5',
        '4': '%',
        'ุ': '6',
        'ู': '^',
        'ึ': '7',
        '฿': '&',
        'ค': '8',
        '5': '*',
        'ต': '9',
        '6': '(',
        'จ': '0',
        '7': ')',
        'ข': '-',
        '8': '_',
        'ช': '=',
        '9': '+',
        'ๆ': 'q',
        '0': 'Q',
        'ไ': 'w',
        '"': 'W',
        'ำ': 'e',
        'ฎ': 'E',
        'พ': 'r',
        'ฑ': 'R',
        'ะ': 't',
        'ธ': 'T',
        'ั': 'y',
        'ํ': 'Y',
        'ี': 'u',
        '๊': 'U',
        'ร': 'i',
        'ณ': 'I',
        'น': 'o',
        'ฯ': 'O',
        'ย': 'p',
        'ญ': 'P',
        'บ': '[',
        'ฐ': '{',
        'ล': ']',
        '`': '`',
        'ฃ': '\\',
        'ฅ': '`',
        'ฟ': 'a',
        'ฤ': 'A',
        'ห': 's',
        'ฆ': 'S',
        'ก': 'd',
        'ฏ': 'D',
        'ด': 'f',
        'โ': 'F',
        'เ': 'g',
        'ฌ': 'G',
        '้': 'h',
        '็': 'H',
        '่': 'j',
        '๋': 'J',
        'า': 'k',
        'ษ': 'K',
        'ส': 'l',
        'ศ': 'L',
        'ว': ';',
        'ซ': ':',
        'ง': "'",
        '.': '"',
        'ผ': 'z',
        '(': 'Z',
        'ป': 'x',
        ')': 'X',
        'แ': 'c',
        'ฉ': 'C',
        'อ': 'v',
        'ฮ': 'V',
        'ิ': 'b',
        'ฺ': 'B',
        'ท': 'n',
        '์': 'N',
        'ท': 'm',
        '?': 'M',
        'ม': '`',
        'ฒ': '<',
        'ใ': '.',
        'ฬ': '>',
        'ฝ': '/',
        'ฦ': '?',
    }

    for (let index = 0; index < string.length; index++) {
        const element = string[index];
        if (mapKeyBoardJSON[element] != undefined && 'กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯะัาำิีึืุูเเแโใไๅๆ฿เแใไๆกขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรลวศษสหฬอฮฯ/-ขช'.includes(element)) {
            eng += mapKeyBoardJSON[element];
        } else {
            eng += element;
        }

    }


    return eng;
}

//Function dont input Text in thai--
function isEng(e) {
    //alert(String.fromCharCode(e.keyCode));
    key = e.keyCode;
    e.returnValue = false;
    if ((key > 64 && key < 91) || key == 32 || key == 46) {
        e.returnValue = true;
    } else if ((key > 96 && key < 123) || key == 32 || key == 46) {
        e.returnValue = true;
    } else if (key > 47 && key < 58) {
        e.returnValue = true;
    }
}