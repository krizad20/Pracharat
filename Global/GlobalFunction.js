function findAllProduct() {
    let product = []
    $.ajax({
        url: "./api/product.php",
        method: "POST",
        data: {
            mode: "findAllProduct",
        },
        success: function (data) {
            product = JSON.parse(data)
            console.log(product)
            for (let i = 0; i < product.length; i++) {
                product[i].pBars = JSON.parse(product[i].pBars)
            }
            console.log(product)

        }
    });
}

function findAllCustomer() {
    let customer = []
    $.ajax({
        async: false,
        url: "./api/customer.php",
        method: "POST",
        data: {
            mode: "findAllCustomer",
        },
        success: function (res) {
            res = JSON.parse(res)
            customer = res.data
        }
    });

    return customer

}