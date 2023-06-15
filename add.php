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
if (isset($_GET['error'])) {
    $e = $_GET['error'];
    echo "<script> alert('unable to delete')</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
    <style>
        .container {
            background-color: #f2f2f2;
            box-shadow: 1px 3px 2px 0px rgba(0, 0, 0, 0.45);
            margin: auto;
            border-radius: 10px;
            margin-top: 10px;
            width: 500px;
            padding: 30px 50px 80px 50px;
        }

        .delete-button {
            background-color: red;
            color: white;
        }

        input {
            box-shadow: 1px 2px 2px 0px rgba(0, 0, 0, 0.45);
        }
    </style>
</head>

<body>

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

    <div class="container">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
            aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">ADD PRODUCTS</h2>
        </div>
        <form action="insert_products.php" method="POST" class="mx-auto mt-16 max-w-xl sm:mt-10">
            <input type="hidden" id="product_id" name="product_id" required />
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="company" class="block ">Product
                        Name</label>
                    <div class="mt-2.5">
                        <input type="text" name="product_name" id="product_name" placeholder="Product name"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="phone-number" class="block ">Item
                        Type</label>
                    <div class="relative mt">
                        <div class="absolute inset-y-0 left-0 flex items-center">
                            <select id="product_type" name="product_type"
                                class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-2 pr-1 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                <option value="Item" selected>Item</option>
                                <option value="Service">Service</option>
                            </select>

                        </div>
                        <input type="text" name="product_item" id="product_item" placeholder="Enter the Item name"
                            class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
                <div class="sm:col-span-2">
                    <label for="company" class="block   ">Price
                        (RS):</label>
                    <div class="mt-2.5">
                        <input type="number" name="rate" id="rate" placeholder=" ex:  100"
                            class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            required>
                    </div>
                </div>
            </div> <br>
            <div class="button">

                <button type="submit"
                    class="text-white bg-green-700  hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">submit
                </button>
                <button type="reset"
                    class="text-white bg-green-700  hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">New
                </button>
            </div>
        </form>
    </div>
    <div id="wrapper" class="table-container"></div>
    <?php
    require 'con.php';
    $query = 'SELECT * from products';
    $result = mysqli_query($con, $query);
    $phpData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $phpData[] = array(
            $row["product_id"],
            $row["product_name"],
            $row["product_type"],
            $row["rate"],
            $row["product_item"]
        );
    }
    $jsonData = json_encode($phpData);
    $_SESSION['jsonData'] = $jsonData;
    ?>
    <script>
        function enableEdit(product_id) {
            const product = jsonData.find((item) => item[0] === product_id);

            var id = document.getElementById("product_id").value = product[0];
            var name = document.getElementById("product_name").value = product[1];
            document.getElementById("product_type").value = product[2];
            document.getElementById("rate").value = product[3];
            document.getElementById("product_item").value = product[4];
        }

        var jsonData = <?php echo $_SESSION['jsonData']; ?>;

        new gridjs.Grid({
            columns: [
                "ID",
                {
                    name: 'Product Name',
                    attributes: (cell, row) => ({ onclick: () => enableEdit(row.cells[0].data), style: 'cursor: pointer;' })
                },
                {
                    name: 'Product type',
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
                        return gridjs.html(`<a href='delete_products.php?action=del&product_id=${productId}  id="delete"' class="del")">Delete</a>`);
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
        .del {
            width: 100px;
            height: 30px;
            background-color: rgba(189, 100, 100, 0.8);
            padding: 10px;
            text-decoration: none;
            color: white;
            border-radius: 10px;
        }
    </style>
</body>

</html>