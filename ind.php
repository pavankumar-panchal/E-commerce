<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

//Created token 
$token = md5(uniqid(rand(), true));
$_SESSION['csrf_token'] = $token;
// print_r($_SESSION);
//validation of csrf token 
if (isset($_POST) && !empty($_POST)) {
  if (isset($_POST['csrf_token'])) {
    if ($_POST['csrf_token'] === $_SESSION['csrf_token']) {
      echo "<script> alert('CSRF token validation success');</script>";
    } else {
      echo "Problem with CSRF token";
    }
  }
}
// require "save_data.php";

if (isset($_GET['error'])) {
  $error_message = $_GET['error'];
  echo "<script> alert('Unable to delete')</script>";
}

if (isset($_GET['error'])) {
  $error_message = $_GET['error'];
  echo "<script> alert('" . $error_message . "')</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
  <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
  <link rel="stylesheet" href="style.css" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
    integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
    crossorigin="anonymous"></script>

</head>

<?php
require 'nav.php';
?>

<style>
  .container {
    width: 500px;
    padding: 30px 50px 30px 50px;
    height: 600px;
    border-radius: 20px;
    box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);

  }

  label {
    margin-top: 10px;
  }

  input[type="submit"],
  input[type="reset"] {
    float: left;
    width: 100px;
    margin-top: 30px;
  }

  input {
    box-shadow: 1px 2px 2px 0px rgba(0, 0, 0, 0.45);
    padding: 10px;
    border: none;
    height: 45px;
  }
</style>


<div class="container">
  <form id="customerForm" method="post" action="save_data.php?action=save">
    <input type="hidden" id="customer_id" name="customer_id" required />
    <div>
      <label for="name">Full Name</label>
      <input type="text" id="name" name="customer_name" placeholder="Enter your name" required />
    </div>
    <div>
      <label for="address">Address</label>
      <input type="text" id="address" name="address" placeholder="Enter your address" required />
    </div>
    <div>
      <label for="number">Mobile number</label>
      <input type="tel" id="number" name="mobile_number" placeholder="Enter your mobile number" pattern="[0-9]{10}"
        required />
    </div>
    <div>
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="example@gmail.com" required />
    </div>
    <div>
      <label for="contact_person">Contact Person Name</label>
      <input type="text" id="contact_person" name="contact_person" placeholder="Contact person name" required />
    </div>
    <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
    <div>
      <input type="submit" id="saveButton" value="Save" onclick="saveData()" name="save"
        style="background-color:#065F46;" />
      <input type="reset" id="newButton" value="New" style="background-color:#065F46;" />
    </div>
  </form>
</div>
<div id="wrapper" class="table-container"></div>
<?php
require 'con.php';
$query = 'SELECT * from Customers';
$result = mysqli_query($con, $query);
$phpData = array();
while ($row = mysqli_fetch_assoc($result)) {
  $phpData[] = array(
    $row["customer_id"],
    $row["customer_name"],
    $row["address"],
    $row["mobile_number"],
    $row["email"],
    $row["contact_person"]
  );
}
$jsonData = json_encode($phpData);
$_SESSION['jsonData'] = $jsonData;
?>
<script>
  function updateCustomer(customer_id) {
    const customer = jsonData.find((item) => item[0] === customer_id);

    var id = document.getElementById("customer_id").value = customer[0];
    var name = document.getElementById("name").value = customer[1];
    document.getElementById("address").value = customer[2];
    document.getElementById("number").value = customer[3];
    document.getElementById("email").value = customer[4];
    document.getElementById("contact_person").value = customer[5];
  }
  var jsonData = <?php echo $_SESSION['jsonData']; ?>;

  new gridjs.Grid({
    columns: [
      "ID",
      {
        name: 'Customer_name',
        attributes: (cell, row) => ({ onclick: () => updateCustomer(row.cells[0].data), style: 'cursor: pointer;' })
      },
      {
        name: 'Address',
        attributes: (cell, row) => ({ onclick: () => updateCustomer(row.cells[0].data), style: 'cursor: pointer;' })
      },
      {
        name: 'Mobile number',
        attributes: (cell, row) => ({ onclick: () => updateCustomer(row.cells[0].data), style: 'cursor: pointer;' })
      },
      {
        name: 'Email',
        attributes: (cell, row) => ({ onclick: () => updateCustomer(row.cells[0].data), style: 'cursor: pointer;' })
      },
      {
        name: 'Contact person',
        attributes: (cell, row) => ({ onclick: () => updateCustomer(row.cells[0].data), style: 'cursor: pointer;' })
      },
      {
        name: 'Delete',
        formatter: (_, row) => {
          const customerId = row.cells[0].data;
          return gridjs.html(`<a href='save_data.php?action=del&customer_id=${customerId}') class="a"">Delete</a>`);
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

</script>
<style>
  .a {
    background-color: rgba(189, 100, 100, 0.8);
  }
</style>
</body>

</html>