<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/product_info.css">

    <title>Product info - CMS</title>
</head>
<body>
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
            <h1>Products Info#23</h1> 

            <div class="container-productInfo">
                <div class="product-info">
                    <img src="src/cover_images/no_image.png" alt="">
                    <div class="product-info--text">
                        <p><b>Product:</b> Iphone 11, 256gb, black</p>
                        <p><b>Price:</b> 500 $</p>
                        <p><b>Color:</b> Black</p>
                        <p><b>Memory:</b> 256gb</p>
                        <p><b>Model year:</b> 2020</p>
                    </div>
                </div>

                <div class="product-form--edit">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <h4>Update product info</h4>
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

                            <button type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>