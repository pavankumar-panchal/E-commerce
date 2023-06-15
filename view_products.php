<?php
// Connect to the MySQL database
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'con.php';
$query = "SELECT * FROM products";
$result = $con->query($query);
$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = array_values($row);
  }
}
$con->close();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Product Data</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gridjs/dist/gridjs.production.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/gridjs/dist/theme/mermaid.min.css" />
  <style>
    .print-button {
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div class="print-button">
    <button onclick="printTable()">Print</button>
  </div>
  <div id="wrapper"></div>

  <script>
    function enableEdit(product_id) {
      const product = jsonData.find((item) => item[0] === product_id);

      var id = document.getElementById("product_id").value = product[0];
      var name = document.getElementById("product_name").value = product[1];
      document.getElementById("product_type").value = product[2];
      document.getElementById("rate").value = product[3];
      document.getElementById("product_item").value = product[4];
    }

    var jsonData = <?php echo json_encode($data); ?>;

    const grid = new gridjs.Grid({
      columns: [
        "ID",
        {
          name: 'Product Name',
          attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
        },
        {
          name: 'Product Type',
          attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
        },
        {
          name: 'Rate',
          attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
        },
        {
          name: 'Product Item',
          attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
        },
        {
          name: 'Delete',
          formatter: (_, row) => {
            const productId = row.cells[0].data;
            return gridjs.html(`<a href='delete_products.php?action=del&product_id=${productId}' class="del">Delete</a>`);
          }
        },
      ],
      data: jsonData,
      pagination: { limit: 5 },
      search: true,
      sort: true,
      language: {
        "search": { "placeholder": "Search..." },
        "pagination": { "previous": "⬅️", "next": "➡️", "results": () => "Records" }
      }
    }).render(document.getElementById("wrapper"));

    function printTable() {
      const printWindow = window.open('', '', 'width=800,height=600');
      const tableHTML = grid.table().element.outerHTML;
      printWindow.document.open();
      printWindow.document.write("
        <html>
        <head>
          <title>Print</title>
          <style>
            table {
              border-collapse: collapse;
              width: 100%;
            }
            th, td {
              border: 1px solid black;
              padding: 8px;
              text-align: left;
            }
            th {
              background-color: #f2f2f2;
            }
          </style>
        </head>
        <body>
          ${tableHTML}
          <script>
            window.onload = function() {
              window.print();
              window.onafterprint = function() {
                window.close();
              }
            };
          </script>
        </body>
        </html>
        ");
      
      printWindow.document.close();
    }
  </script>
</body>
</html>
