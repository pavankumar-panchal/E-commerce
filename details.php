<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'con.php';
$query = "SELECT c.customer_name, p.product_name, pu.quantity, (p.rate * pu.quantity) AS total_price
          FROM purchase pu
          INNER JOIN Customers c ON pu.customer_name = c.customer_name
          INNER JOIN products p ON pu.product_name = p.product_name";
$result = $con->query($query);
$data = [];
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
}
$con->close();
?>
<!DOCTYPE html>
<html>

<head>
  <title>Customer and Product Data</title>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"
    integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
  <script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <style>
    table {
      border-collapse: collapse;
      width: 90%;
      margin: auto;
      box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);
      margin-top: 20px;

    }

    th,
    td {
      text-align: left;
      padding: 8px;
      border: 2px solid black;
    }

    th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Smog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="ind.php">Add Customers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="add.php">Add Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="purchase_data.php">Buy Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="details.php">View Sails</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
  <table id="tblCustomers" cellspacing="0" cellpadding="0">
    <tr>
      <th>Customer Name</th>
      <th>Product Name</th>
      <th>Quantity</th>
      <th>Total Price</th>
    </tr>
    <?php foreach ($data as $row): ?>
      <tr>
        <td>
          <?php echo $row['customer_name']; ?>
        </td>
        <td>
          <?php echo $row['product_name']; ?>
        </td>
        <td>
          <?php echo $row['quantity']; ?>
        </td>
        <td>
          <?php echo $row['total_price']; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <div class="print">
    <input type="button" id="btnExport" value="Print" onclick="Export()" />
  </div>
  <script type="text/javascript">
    function Export() {
      html2canvas(document.getElementById('tblCustomers'), {
        onrendered: function (canvas) {
          var data = canvas.toDataURL();
          var docDefinition = {
            content: [{
              image: data,
              width: 520
            }]
          };
          pdfMake.createPdf(docDefinition).download("Table.pdf");
        }
      });
    }
  </script>
  <style>
    .print {
      position: relative;
      margin: auto;
      top: 4vh;
      width: 100px;
      height: 55px;
    }

    .print_but {
      width: 100%;
      height: 45px;
      background-color: #065F46;
      color: white;
      font-weight: 600;
      border-radius: 10px;
    }

    input[type='button'] {
      background-color: #065F46;
      color: white;
      width: 100px;
      height: 45px;
      border: none;
      border-radius: 10px;
    }
  </style>
</body>

</html>