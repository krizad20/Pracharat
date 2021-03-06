let selectProductTable = $("#selectProductA2S").DataTable({
  ajax: {
    url: "./ajax/product.php",
  },

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
      data: "pBars",
      render: function (data, type) {
        let json = JSON.parse(data);
        let bars = "";
        for (let i = 0; i < json.length; i++) {
          bars += json[i].barcode + ",";
        }

        return bars;
      },
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

$("#addToStockAndSelect").on("shown.bs.modal", function (event) {
  //focus search
  if ($("#selectProductCol").is(":visible")) {
    $("#selectProductA2S_filter input").focus();
    selectProductTable.columns.adjust().draw();
    selectProductTable.search("").draw();
    selectProductTable.row(".selected").deselect();
    selectProductTable.ajax.reload();
  }

  $("#selectProductA2S_filter input").on("keypress", function (e) {
    if (e.keyCode === 13 && $("#selectProductA2S tbody tr").length == 1) {
      let rowData = selectProductTable
        .row(":eq(0)", {
          page: "current",
        })
        .data();
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

//dblclick
$("#selectProductA2S tbody").on("click", "tr", function () {
  let row = $("#selectProductA2S").DataTable().row(this).data();
  let data = {
    pID: row.pID,
    pName: row.pName,
    pBP: row.pBP,
    pSP: row.pSP,
    pVal: row.pVal,
    pBar: row.pBar,
  };

  selectProduct(data);
});

$("#addToStockAndSelect").on("hidden.bs.modal", function (event) {
  $("#selectProductA2S_filter input").val("");
  selectProductTable.search("").draw();
  selectProductTable.row(".selected").deselect();
  selectProductTable.ajax.reload();
  clearInput();
});

function selectProduct(data) {
  var product_id = data.pID;
  var product_quantity = 0;
  var pStock = parseInt(data.pVal);
  var action = "addToStock";

  var product_bar = data.pBar;
  var product_name = data.pName;
  var product_BP = data.pBP;
  var product_SP = data.pSP;

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

  let sumOldBP = parseFloat(product_BP) * pStock;
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
      let product_quantity = parseInt($("#pAddVal").val() - 0);
      let editBPOnly;
      let editSPOnly;
      let editBPAndSP;
      if ($("#pNewSP").val() != "" || $("#pNewBP").val() != "") {
        $("#pNewSP").val(parseFloat($("#pNewSP").val()).toFixed(2));
        $("#pNewBP").val(parseFloat($("#pNewBP").val()).toFixed(2));
        editBPOnly =
          $("#pNewBP").val() != "" && $("#pNewBP").val() != product_BP;
        editSPOnly =
          $("#pNewSP").val() != "" && $("#pNewSP").val() != product_SP;
        editBPAndSP = editBPOnly && editSPOnly;

        if (editBPAndSP) {
          askConfirm =
            "ยืนยันแก้ราคาซื้อจาก " +
            product_BP +
            " เป็น " +
            $("#pNewBP").val() +
            "\n และราคาขายจาก " +
            product_SP +
            " เป็น " +
            $("#pNewSP").val() +
            " ใช่หรือไม่";
          product_BP = parseFloat($("#pNewBP").val() - 0);
          product_SP = parseFloat($("#pNewSP").val() - 0);
        } else {
          if (editBPOnly) {
            askConfirm =
              "ยืนยันแก้ราคาซื้อจาก " +
              product_BP +
              " เป็น " +
              $("#pNewBP").val() +
              " ใช่หรือไม่";
            product_BP = parseFloat($("#pNewBP").val() - 0);
            product_SP = data.pSP;
          }
          if (editSPOnly) {
            askConfirm =
              "ยืนยันแก้ราคาขายจาก " +
              product_SP +
              " เป็น " +
              $("#pNewSP").val() +
              " ใช่หรือไม่";
            product_SP = parseFloat($("#pNewSP").val() - 0);
            product_BP = data.pBP;
          }
        }
      }

      //Not Change
      if (product_quantity <= 0 || product_quantity == "") {
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
            url: "./TabPOS/posAction.php",
            type: "POST",
            data: {
              action: action,
              pID: product_id,
              pName: product_name,
              pQuantity: product_quantity,
              pNewBP: product_BP,
              pNewSP: product_SP,
            },
            success: function (result) {
              selectProductTable.ajax.reload();
              // load_product();
              if (editBPOnly) {
                $("#pBPA2S").val(product_BP.toFixed(2));
                $("#pBPA2S").css("background-color", "#dff0d8");
              }
              if (editSPOnly) {
                $("#pSPA2S").val(product_SP.toFixed(2));
                $("#pSPA2S").css("background-color", "#dff0d8");
              }

              $("#pValA2S").val(
                parseInt(data.pVal) + parseInt(product_quantity)
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
          url: "./TabPOS/posAction.php",
          type: "POST",
          data: {
            action: action,
            pID: product_id,
            pName: product_name,
            pQuantity: product_quantity,
            pNewBP: product_BP,
            pNewSP: product_SP,
          },
          success: function (result) {
            selectProductTable.ajax.reload();
            // load_product();
            $("#pValA2S").val(parseInt(data.pVal) + parseInt(product_quantity));
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
    $("#addToStockAndSelect").modal("show");
    $("#addToStockAndSelect").on("shown.bs.modal", function (event) {
      $("#pAddVal").focus();
    });

    $("#addToStockAndSelect").on("hidden.bs.modal", function (event) {
      // selectProductTable.draw();
      $("#selectProductA2S_filter input").val("");
      selectProductTable.row(".selected").deselect();
      $("#selectProductCol").show();
      // clearInput();
      clearInput();
    });
  }
}
