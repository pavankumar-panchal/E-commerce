<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: rgba(255, 255, 255, 0.712);
            background-image: radial-gradient(at 40% 20%, rgba(250, 209, 199, 0.658) 0px, transparent 50%),
                radial-gradient(at 80% 10%, rgba(43, 40, 231, 0.582) 0px, transparent 50%),
                radial-gradient(at 40% 80%, rgba(231, 174, 179, 0.63) 0px, transparent 50%);
            min-height: 100vh;
        }

        .whole {
            margin: auto;
        }

        .card {
            position: relative;
            top: 60px;
            width: 65%;
            margin: auto;
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(146, 152, 224, 0.377);
            backdrop-filter: blur(9px);
            -webkit-backdrop-filter: blur(9px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .button {
            position: relative;
            top: 40px;

        }
    </style>
    <?php
    ?>

</head>

<body>
    <div class="whole">
        <div class="isolate px-6 py-24 sm:py-32 lg:px-8 card">
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
                <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Product
                            Name</label>
                        <div class="mt-2.5">
                            <input type="text" name="product_name" id="product_name" placeholder="Product name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="phone-number" class="block text-sm font-semibold leading-6 text-gray-900">Item
                            Type</label>
                        <div class="relative mt">
                            <div class="absolute inset-y-0 left-0 flex items-center">
                                <select id="product_type" name="product_type"
                                    class="h-full rounded-md border-0 bg-transparent bg-none py-0 pl-2 pr-1 text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm">
                                    <option name="opt">Item </option>
                                    <option name="opt">Service</option>
                                </select>
                            </div>
                            <input type="text" name="product_item" id="product_item" placeholder="Enter the Item name"
                                class="block w-full rounded-md border-0 px-3.5 py-2 pl-20 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                required>
                        </div>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="company" class="block text-sm font-semibold leading-6 text-gray-900">Price
                            (RS):</label>
                        <div class="mt-2.5">
                            <input type="number" name="rate" id="rate" placeholder=" ex:  100"
                                class="block w-full rounded-md border-0 px-3.5 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                                required>
                        </div>
                    </div>
                </div>
                <div class="button">
                    <a href="view_products.php"
                        class="text-white bg-green-700 float-right hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">view
                        Products
                    </a>
                    <button type="submit"
                        class="text-white bg-green-700 float-right hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">submit
                    </button>
                    <button type="reset"
                        class="text-white bg-green-700 float-right hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ">New
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>


    </script>
</body>

</html>