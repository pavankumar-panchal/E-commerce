function enableEdit(product_id) {
    const customer = jsonData.find((item) => item[0] === product_id);
    var id = document.getElementById("product_id").value = customer[0];

    var name = document.getElementById("product_id").value = customer[1];
    var type = document.getElementById("product_type").value = customer[2];
    var rate = document.getElementById("rate").value = customer[3];
    var item = document.getElementById("product_item").value = customer[4];
}




