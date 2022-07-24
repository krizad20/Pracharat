
let a2s = []
$(document).ready(function () {
  let defer1 = $.Deferred();


  SetupData1.init(
    defer1
  );

  $.when(
    defer1
  ).done(function (
    result1
  ) {
    if (
      !result1
    ) {
      return;
    }
    selectProductTableA2S.init()


  });
});

let SetupData1 = (function () {
  let loadProduct = function (defer1) {
    $.ajax({
      url: "./api/product.php",
      method: "POST",
      data: {
        mode: "findAllProduct"
      },
      success: function (res) {

        if (res.status == 200) {
          a2s = res.data
          for (let i = 0; i < a2s.length; i++) {
            a2s[i].pBars = JSON.parse(a2s[i].pBars)
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

  return {
    init: function (
      defer1
    ) {
      loadProduct(defer1);

    },
  };
})();


let selectProductTableA2S = (function () {
  let table
  let initTable = function () {
    table = $("#selectProductA2S").DataTable({
      fixedHeader: true,
      data: a2s,
      columns: [
        {
          data: "pID",
        },
        {
          data: "pName",
        },
        {
          data: "pSP",
        },
        {
          data: "pVal",
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
        },
      ],
      lengthChange: false,
      ordering: false,
      info: false,
      scrollY: 200,
      scrollCollapse: true,
      scroller: true,
      columnDefs: [
        {
          targets: [4],
          visible: false,
        },
      ],
      language: {
        emptyTable: "ไม่พบข้อมูล",
        search: "ค้นหา",
      },
      select: {
        style: "single",
        select: true,
        toggleable: false,
      },


    });
  };
  return {
    init: function () {
      initTable();

      //Table On Click
      let containerTable = $(table.table().container());
      //row on click
      table.on("select", function (e, dt, type, indexes) {
        let rowData = table.rows(indexes).data().toArray()[0];
        let data = {
          pID: rowData.pID,
          pName: rowData.pName,
          pBP: rowData.pBP,
          pSP: rowData.pSP,
          pVal: rowData.pVal,
          pBar: rowData.pBar,
        };

        selectProduct(data);
      });

      $("#addToStockAndSelect").on("shown.bs.modal", function (event) {
        //focus search
        if ($("#selectProductCol").is(":visible")) {
          $("#selectProductA2S_filter input").focus();
          table.columns.adjust().draw();
          table.search("").draw();
          table.row(".selected").deselect();
        }

        $("#selectProductA2S_filter input").on("keypress", function (e) {
          if (e.keyCode === 13 && $("#selectProductA2S tbody tr").length == 1) {
            let rowData = table.row(":eq(0)", {
              page: "current",
            }).data();

            let data = {
              pID: rowData.pID,
              pName: rowData.pName,
              pBP: rowData.pBP,
              pSP: rowData.pSP,
              pVal: rowData.pVal,
              pBar: rowData.pBar,
            };

            selectProduct(data);
          }
        });
      });

      $("#addToStockAndSelect").on("hidden.bs.modal", function (event) {
        $("#selectProductA2S_filter input").val("");
        table.search("").draw();
        table.row(".selected").deselect();
        clearInput();
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

// let selectProductTableA2S = $("#selectProductA2S").DataTable({
//   ajax: {
//     url: "./ajax/product.php",
//   },

//   columns: [
//     {
//       data: "pID",
//     },
//     {
//       data: "pName",
//     },
//     {
//       data: "pSP",
//     },
//     {
//       data: "pVal",
//     },
//     {
//       data: "pBars",
//       render: function (data, type) {
//         let json = JSON.parse(data);
//         let bars = "";
//         for (let i = 0; i < json.length; i++) {
//           bars += json[i].barcode + ",";
//         }

//         return bars;
//       },
//     },
//   ],
//   lengthChange: false,
//   ordering: false,
//   info: false,
//   scrollY: 200,
//   scrollCollapse: true,
//   scroller: true,
//   columnDefs: [
//     {
//       targets: [4],
//       visible: false,
//     },
//   ],
//   language: {
//     emptyTable: "ไม่พบข้อมูล",
//     search: "ค้นหา",
//   },
//   select: {
//     style: "single",
//     select: true,
//     toggleable: false,
//   },
// });



function selectProduct(data) {
  let pID = data.pID;
  let pStock = parseInt(data.pVal);
  let mode = "addToStock";

  let pBar = data.pBar;
  let pName = data.pName;
  let pBP = data.pBP;
  let pSP = data.pSP;

  $("#pIDA2S").val(data.pID);
  $("#pBarA2S").val(data.pBar);
  $("#pNameA2S").val(data.pName);
  $("#pBPA2S").val(data.pBP);
  $("#pSPA2S").val(data.pSP);
  $("#pValA2S").val(data.pVal);

  $("#pNowBP, #pAddVal, #pNewBP, #pNewSP").val("");

  $("#pAddVal").focus();

  $("#pBPA2S").css("background-color", "#f2f2f2");
  $("#pSPA2S").css("background-color", "#f2f2f2");
  $("#pValA2S").css("background-color", "#f2f2f2");
  $("#saveAddToStock").prop("disabled", false);

  let sumOldBP = parseFloat(pBP) * pStock;
  $("#pNowBP, #pAddVal").on("keyup", function () {
    if ($("#pNowBP").val() != "") {
      let totalBP = sumOldBP + parseFloat($("#pNowBP").val() - 0);
      let totalVal = pStock + parseInt($("#pAddVal").val());
      let sumNewBP = parseFloat(totalBP / totalVal).toFixed(2);
      $("#pNewBP").val(sumNewBP);
    } else {
      $("#pNewBP").val("");
    }
  });

  $("#saveAddToStock")
    .off()
    .on("click", function () {
      let askConfirm = "";
      // let newBP = parseFloat($("#pNewBP").val());
      // let newSP = parseFloat($("#pNewSP").val());
      let pValAdd = parseInt($("#pAddVal").val() - 0);
      let editBPOnly;
      let editSPOnly;
      let editBPAndSP;
      if ($("#pNewSP").val() != "" || $("#pNewBP").val() != "") {
        $("#pNewSP").val(parseFloat($("#pNewSP").val()).toFixed(2));
        $("#pNewBP").val(parseFloat($("#pNewBP").val()).toFixed(2));
        editBPOnly =
          $("#pNewBP").val() != "" && $("#pNewBP").val() != pBP;
        editSPOnly =
          $("#pNewSP").val() != "" && $("#pNewSP").val() != pSP;
        editBPAndSP = editBPOnly && editSPOnly;

        if (editBPAndSP) {
          askConfirm =
            "ยืนยันแก้ราคาซื้อจาก " +
            pBP +
            " เป็น " +
            $("#pNewBP").val() +
            "\n และราคาขายจาก " +
            pSP +
            " เป็น " +
            $("#pNewSP").val() +
            " ใช่หรือไม่";
          pBP = parseFloat($("#pNewBP").val() - 0);
          pSP = parseFloat($("#pNewSP").val() - 0);
        } else {
          if (editBPOnly) {
            askConfirm =
              "ยืนยันแก้ราคาซื้อจาก " +
              pBP +
              " เป็น " +
              $("#pNewBP").val() +
              " ใช่หรือไม่";
            pBP = parseFloat($("#pNewBP").val() - 0);
            pSP = data.pSP;
          }
          if (editSPOnly) {
            askConfirm =
              "ยืนยันแก้ราคาขายจาก " +
              pSP +
              " เป็น " +
              $("#pNewSP").val() +
              " ใช่หรือไม่";
            pSP = parseFloat($("#pNewSP").val() - 0);
            pBP = data.pBP;
          }
        }
      }

      //Not Change
      if (pValAdd <= 0 || pValAdd == "") {
        alert("กรุณากรอกจำนวนสินค้า");
        $("#pAddVal").focus();
        $("#pNowBP").val("");
        $("#pNewBP").val("");
        $("#pNewSP").val("");
      }
      //Add and Change BP SP
      else if (askConfirm != "") {
        if (confirm(askConfirm)) {
          $.ajax({
            url: "./api/product.php",
            type: "POST",
            data: {
              mode: mode,
              pID: pID,
              pName: pName,
              pQuantity: pValAdd,
              pNewBP: pBP,
              pNewSP: pSP,
            },
            success: function (result) {
              selectProductTableA2S.table().draw();
              // load_product();
              if (editBPOnly) {
                $("#pBPA2S").val(pBP.toFixed(2));
                $("#pBPA2S").css("background-color", "#dff0d8");
              }
              if (editSPOnly) {
                $("#pSPA2S").val(pSP.toFixed(2));
                $("#pSPA2S").css("background-color", "#dff0d8");
              }

              $("#pValA2S").val(
                parseInt(data.pVal) + parseInt(pValAdd)
              );
              $("#pValA2S").css("background-color", "#dff0d8");
              $("#saveAddToStock").prop("disabled", true);
              $("#selectProductA2S_filter input").val("");
              alert("เพิ่มสินค้าเรียบร้อยแล้ว");
            },
          });
        }
      }
      //Add Only
      else if (askConfirm == "") {
        $.ajax({
          url: "./api/product.php",
          type: "POST",
          data: {
            mode: mode,
            pID: pID,
            pName: pName,
            pQuantity: pValAdd,
            pNewBP: pBP,
            pNewSP: pSP,
          },
          success: function (result) {
            selectProductTableA2S.table().draw();

            // load_product();
            $("#pValA2S").val(parseInt(data.pVal) + parseInt(pValAdd));
            $("#pValA2S").css("background-color", "#dff0d8");
            $("#saveAddToStock").prop("disabled", true);
            alert("เพิ่มสินค้าเรียบร้อยแล้ว");

            // $("#pAddVal").prop("disabled", true);
            // $("#pNowBP").prop("disabled", true);
            // $("#pNewBP").prop("disabled", true);
            // $("#pNewSP").prop("disabled", true);

            // $("#addToStockAndSelect").modal("hide");
          },
        });
      } else {
        alert("กรุณากรอกราคาซื้อหรือราคาขายให้ถูกต้อง");
        $("#pNowBP").val("");
        $("#pNewBP").val("");
        $("#pNewSP").val("");
      }
    });
}

function clearInput() {
  $("#pAddVal").val("");
  $("#pNowBP").val("");
  $("#pNewBP").val("");
  $("#pNewSP").val("");

  $("#pIDA2S").val("");
  $("#pBarA2S").val("");
  $("#pNameA2S").val("");
  $("#pBPA2S").val("");
  $("#pSPA2S").val("");
  $("#pValA2S").val("");
}

function showModal(mode) {
  if (mode == "noSelect") {
    $("#selectProductCol").hide();
    $("#addToStockAndSelect").on("shown.bs.modal", function (event) {
      $("#pAddVal").focus();
    });

    $("#addToStockAndSelect").on("hidden.bs.modal", function (event) {
      // selectProductTable.draw();
      $("#selectProductA2S_filter input").val("");
      selectProductTableA2S.table().row(".selected").deselect();
      $("#selectProductCol").show();
      // clearInput();
      clearInput();
    });
    $("#addToStockAndSelect").modal("show");

  }
}
