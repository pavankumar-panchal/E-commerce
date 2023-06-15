<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

    <style>
        input[type='number'] {
            width: 100%;
            height: 40Px;
            border-radius: 5px;
            border: none;
            padding: 10px;

        }

        input[type="submit"],
        input[type="reset"] {
            float: left;
            position: relative;

        }

        select {
            width: 100%;
            height: 45px;
            border-radius: 10px;
            background-color: white;
            border: none;
            padding: 10px;
        }

        .product_name {
            width: 300px;
        }

        .prd {
            display: flex;
            flex-direction: row;
            justify-content: space-between;

        }

        .quantity {
            width: 300px;
            border-radius: 10px;
            border: none;
        }

        #total {
            position: absolute;
            margin-left: 320px;
            margin-top: -40px;
            border: none;

        }

        .rate {
            position: absolute;
            margin-left: 320px;
            margin-top: 40px;
            border: none;
        }

        .container {
            width: 650px;
            padding: 30px 50px 100px 50px;
            border: none;

            box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);

        }

        .but {
            margin-top: 10px;
            position: Fixed;
        }

        select,
        input {
            box-shadow: 1px 2px 2px 0px rgba(0, 0, 0, 0.45);

        }

        label {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <?php
    require 'con.php';
    if (isset($_POST['buy'])) {

        $customer_name = $_POST['customer_name'];
        $product_name = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $purchase_date = date('Y-m-d');

        $query = "SELECT * FROM Customers WHERE customer_name = '$customer_name'";
        $result = $con->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $customer_name = $row['customer_name'];

            $query = "SELECT * FROM products WHERE product_name = '$product_name'";
            $result = $con->query($query);

            if ($result->num_rows > 0) {
                $query = "INSERT ignore INTO purchase (customer_name, product_name, quantity, purchase_date)
                      VALUES ('$customer_name', '$product_name', '$quantity', '$purchase_date')";

                if ($con->query($query) === TRUE) {
                    echo "  <script> alert('Purchase data saved successfully!');</script>";
                } else {
                    echo "Error: " . $query . "<br>";
                }
            } else {
                echo " <script> alert('Product not found!');</script>";
            }
        } else {
            echo "<script>alert('Customer not found!');</script>";
        }
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Smog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
    <div class="title">

    </div>
    <div class="container" style="height:500px; border-radius:10px; width:500px;  ">
        <center>
            <h1> BUY NOW</h1>
        </center>
        <form id="customerForm" method="post" action="">
            <input type="hidden" id="purchase_id" name="purchase_id" required />
            <div>
                <label for="customer">Customer</label>
                <select id="customer_name" name="customer_name" required>
                    <?php
                    $query = "SELECT customer_name FROM Customers";
                    $result = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<option value="' . $row['customer_name'] . '">' . $row['customer_name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div id="productRate" class="rate"></div>
            <div class="prd">
                <div>
                    <label for="customer">Customer</label> <br>
                    <select id="product_name" name="product_name" required class="product_name">
                        <?php
                        $query = "SELECT product_name FROM products";
                        $result = mysqli_query($con, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row['product_name'] . '">' . $row['product_name'] . '</option>';
                        }
                        mysqli_close($con);
                        ?>
                    </select>
                </div>
            </div>
            <div class="quantity">
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" placeholder="e.g:10" required class="input" />
            </div>
            <div id="total"></div>
            <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
            <div class="but"><br>
                <input type="submit" id="saveButton" value="Buy Now" name="buy" style="background-color:#065F46;" />
                <input type="reset" id="newButton" value="New" style="background-color:#065F46;" />
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#product_name').change(function () {
                var productName = $(this).val();
                $.ajax({
                    url: 'data.php',
                    method: 'POST',
                    data: { productName: productName },
                    success: function (response) {
                        $('#productRate').text('Rate: ' + response);
                    }
                });
            });
        });
        $(document).ready(function () {
            $('#quantity').change(function () {
                Total();
            });
        });
        function Total() {
            var quantity = $('#quantity').val();
            var rate = $('#productRate').text().replace('Rate: ', '');
            var total = parseFloat(quantity) * parseFloat(rate);
            $('#total').text('Total: ' + total.toFixed(2));
        }
    </script>
</body>

</html>