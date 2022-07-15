let customer = []

$(document).ready(function () {
    let defer1 = $.Deferred();


    SetupData.init(
        defer1,
    );

    $.when(
        defer1,
    ).done(function (
        result1,
    ) {
        if (
            !result1
        ) {
            return;
        }
        RenderPage.init();


    });
});

let SetupData = (function () {
    let loadCustomer = function (defer1) {
        $.ajax({
            url: "./api/customer.php",
            method: "POST",
            data: {
                mode: "findAllCustomer",
            },
            success: function (res) {
                res = JSON.parse(res)
                if (res.status == 200) {
                    customer = res.data
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
    return {
        init: function (
            defer1,
        ) {
            loadCustomer(defer1);
        },
    };
})();

let RenderPage = (function () {
    return {
        init: function () {
            customerTable.init();
            customerTable.data(customer);
            //On click Function

            //add onclick
            $('#cAdd').click(function (event) {
                {
                    event.preventDefault();
                    var newID = "";
                    customerTable.table().row('.selected').deselect()
                    $('#cID').val("")
                    $('#cName').val("")
                    $('#cSer').val("")
                    $('#cHouse').val("")
                    $('#cMoo').val("")
                    $('#cMem').prop("checked", true);

                    $.ajax({
                        url: "./api/customer.php",
                        method: "POST",
                        data: {
                            mode: "getNewID"
                        },
                        success: function (data) {
                            newID = data;
                            $('#cID').val(newID)
                            $('#cName').val("").prop("disabled",false).focus()
                            $('#cSer').val("").prop("disabled",false)
                            $('#cHouse').val("").prop("disabled",false)
                            $('#cMoo').val("").prop("disabled",false)
                            $('.MemStatus').prop("disabled",false)
                            $('#cMem').prop("checked", true);
                            $('#cSave').prop("disabled",false)
                            $('#cDel').prop("disabled",true)

                        }
                    });


                }
            });

            //save onclick
            $('#cSave').click(function (event) {
                event.preventDefault();


                let cID = $('#cID').val()
                let cName = $('#cName').val()
                let cSer = $('#cSer').val()
                let cHouse = $('#cHouse').val()
                let cMoo = $('#cMoo').val()
                let cIsMem = 0;
                if ($('#cMem').prop("checked")) {
                    cIsMem = $('#cMem').val()
                } else if ($('#cNotMem').prop("checked")) {
                    cIsMem = $('#cNotMem').val()
                } else if ($('#cNotMoo').prop("checked")) {
                    cIsMem = $('#cNotMoo').val()
                }


                let data = {
                    cID: cID,
                    cName: cName,
                    cSer: cSer,
                    cHouse: cHouse,
                    cMoo: cMoo,
                    cIsMem: cIsMem
                }

                editCustomer(data)

            })

            //del onclick
            $('#cDel').click(function (event) {
                event.preventDefault();
                let cID = $('#cID').val()

                deleteCustomer(cID)

            })
        }
    };
})();

var customerTable = (function () {
    let table
    let initTable = function () {
        table = $("#customerTable").DataTable({
            fixedHeader: true,
            data: [],
            responsive: true,
            columns: [{
                data: 'cID'
            },
            {
                data: 'cHouse'
            },
            {
                data: 'cName'
            },
            {
                data: 'cSer'
            },

            {
                data: 'cMoo'
            }
            ],
            order: [[0, "asc"]],
            select: {
                style: 'single',
                select: true,
                toggleable: false
            },


        });
    };
    return {
        init: function () {
            initTable();
            //Table On Click
            let containerTable = $(table.table().container());
            table.table().on('select', function (e, dt, type, indexes) {
                isAdd = false;
                let rowData = table.rows(indexes).data().toArray();
                let cID = rowData[0].cID;
                $.ajax({
                    url: 'api/customer.php',
                    method: 'POST',
                    data: {
                        mode: "findCustomerBycID",
                        cID: cID
                    },
                    success: function (res) {
                        res = JSON.parse(res)
                        let data = res.data[0]
                        $('#cID').val(data.cID)
                        $('#cID').attr("disabled", true);
                        $('#cName').val(data.cName)
                        $('#cName').attr("disabled", false);
                        $('#cSer').val(data.cSer)
                        $('#cSer').attr("disabled", false);
                        $('#cHouse').val(data.cHouse)
                        $('#cHouse').attr("disabled", false);
                        $('#cMoo').val(data.cMoo)
                        $('#cMoo').attr("disabled", false);
                        if (data.cIsMem == "1") {
                            $('#cMem').prop("checked", true);
                        } else if (data.cIsMem == "2") {
                            $('#cNotMem').prop("checked", true);
                        } else if (data.cIsMem == "3") {
                            $('#cNotMoo').prop("checked", true);
                        }

                        $('#cSave').attr("disabled", false);
                        $('#cDel').attr("disabled", false);
                        $('#cMem').attr("disabled", false);
                        $('#cNotMem').attr("disabled", false);
                        $('#cNotMoo').attr("disabled", false);

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

function editCustomer(data) {
    if (data.cID == '' || data.cName == '') {
        alert("กรุณากรอกข้อมูลให้ครบ");
    } else {

        $.ajax({
            url: "./api/customer.php",
            method: "POST",
            data: {
                mode: "save",
                cID: data.cID,
                cName: data.cName,
                cSer: data.cSer,
                cHouse: data.cHouse,
                cMoo: data.cMoo,
                cIsMem: data.cIsMem

            },
            success: function (res) {
                res = JSON.parse(res)
                if (res.status = 200) {
                    alert(res.message);

                    customerTable.data(res.data)

                    $('#pSave').attr("disabled", true);
                    $('#pDel').attr("disabled", true);


                } else {
                    alert(res.message);
                }

            }
        });
    }


}

function deleteCustomer(cID) {
    if (confirm("ยืนยันลบรายชื่อลูกค้า")) {
        $.ajax({
            url: "./api/customer.php",
            method: "POST",
            data: {
                mode: "del",
                cID: cID
            },
            success: function (res) {
                res = JSON.parse(res)
                if (res.status == 200) {
                    customer = res.data
                    customerTable.data(customer)

                    alert(res.message);

                    $('#pDel').attr("disabled", true);
                    $('#pSave').attr("disabled", true);

                } else {
                    alert(res.message);
                }

            }
        });
    }

}