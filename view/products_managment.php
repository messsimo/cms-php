<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/products_managment.css">

    <title>Products managment - CMS</title>
</head>
<body>
    <?php   
        // Start session
        session_start(); 
        
        // Require products model
        require("/Users/danielmihai/Documents/code/cms_php/model/productsModel.php");
    ?>

    <!-- Overlay -->
    <div class="overlay"></div>
    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navigation block -->
        <div class="nav">
            <div class="user-info">
                <h2>Admin Panel (CMS)</h2>
                <img src="src/avatars/<?= $_SESSION["user"][0]["photo"] ?>" alt="<?= $_SESSION["user"][0]["login"] ?? '' ?>">
                <p><?= $_SESSION["user"][0]["login"] ?? '' ?></p>
            </div>

            <nav>
                <a href="/view/dashboard.php">Dashboard</a>
                <a href="/view/orders_managment.php">Orders managment</a>
                <a href="/view/staff_managment.php">Staff managment</a>
                <a href="/view/products_managment.php">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Products Managment</h1> 
            
            <?php if ($_SESSION["user"][0]["access"] == "Admin" || $_SESSION["user"][0]["access"] == "Manager") { ?>
            <div class="create-product">
                <button id="openForm-btn--product">Create new product</button>

                <div class="create-product--form">
                    <form action="/controller/addProductController.php" method="POST" enctype="multipart/form-data">
                        <div class="svg">
                            <svg id="closeForm-btn--product" version="1.0" xmlns="http://www.w3.org/2000/svg" width="8.000000pt" height="8.000000pt" viewBox="0 0 512.000000 512.000000" preserveAspectRatio="xMidYMid meet"><g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" fill="#000000" stroke="none"><path d="M245 5111 c-92 -24 -173 -90 -215 -176 -35 -71 -35 -198 -1 -270 19 -40 223 -249 1050 -1078 l1026 -1027 -1026 -1028 c-1115 -1116 -1066 -1062 -1077 -1188 -10 -126 53 -240 168 -303 61 -33 71 -36 150 -35 68 0 95 5 135 24 41 19 244 217 1078 1049 l1027 1026 1028 -1026 c833 -832 1036 -1030 1077 -1049 40 -19 67 -24 135 -24 78 -1 90 2 148 33 70 38 100 70 140 145 36 71 38 196 2 271 -19 41 -217 244 -1049 1077 l-1026 1028 1026 1028 c832 833 1030 1036 1049 1077 19 40 24 67 24 135 1 78 -2 90 -33 148 -38 70 -70 100 -145 140 -71 36 -196 38 -271 2 -41 -19 -244 -217 -1077 -1049 l-1028 -1026 -1027 1026 c-838 837 -1037 1030 -1077 1048 -53 24 -161 36 -211 22z"/></g></svg>
                        </div>
                        <h3>Create new product</h3>
                        <label for="name">Product name</label>
                        <input type="text" name="name" placeholder="Iphone 11, 256gb, black">
                        <label for="price">Product price</label>
                        <input type="text" name="price" placeholder="489">
                        <label for="color">Product color</label>
                        <input type="text" name="color" placeholder="Gold">
                        <label for="memory">Product memory</label>
                        <input type="text" name="memory" placeholder="128">
                        <label for="model_year">Model year</label>
                        <input type="text" name="model_year" placeholder="2024">
                        <label for="photo">Upload image</label>
                        <input type="file" name="photo">

                        <button type="submit">Create</button>
                    </form>
                </div>
            </div>
            <?php } ?>

            <!-- Delete item alert -->
            <?php if (isset($_SESSION["delete_item"])) { ?>
                <div class="alert success">
                    <span><?= $_SESSION["delete_item"] ?></span>
                </div>
                <?php unset($_SESSION["delete_item"]); ?>
            <?php } ?>

            <!-- Errors alert -->
            <?php if (isset($_SESSION["error_addProduct"])) { ?>
                <div class="alert">
                    <span><?= $_SESSION["error_addProduct"] ?></span>
                </div>
                <?php unset($_SESSION["error_addProduct"]); ?>
            <?php } ?>

            <!-- Success alert -->
            <?php if (isset($_SESSION["success_addProduct"])) { ?>
                <div class="alert success">
                    <span><?= $_SESSION["success_addProduct"] ?></span>
                </div>
                <?php unset($_SESSION["success_addProduct"]); ?>
            <?php } ?>

            <table>
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Details</td>
                        <td>Remove</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productsInfo as $el) { ?>
                   <tr>
                        <td><?= $el["id"] ?></td>
                        <td><?= $el["name"] ?></td>
                        <td><?= number_format($el["price"]) ?>$</td>
                        <td><a href="">More info</a></td>
                        <td><a class="remove-btn" href="/view/products_managment.php?remove=<?= $el["id"]?>">Remove</a></td>
                   </tr>
                   <?php } ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) {
                     if ($i == $page) {
                        echo '<strong>' . $i . '</strong> ';
                    } else {
                        echo '<a href="/view/products_managment.php?page=' . $i . '">' . $i . '</a> ';
                    }
                } ?>
            </div>
        </div>
    </div>

    <!-- Require JS -->
    <script src="src/js/modelWindowProduct.js"></script>
</body>
</html>