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
    <?php   
        // Start session
        session_start(); 
        
        // Require products model
        require("/Users/danielmihai/Documents/code/cms_php/model/productsModel.php");
    ?>
    
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
            <h1>Products Info#<?= $productInfo[0]["id"] ?></h1> 

            <div class="container-productInfo">
                <div class="product-info">
                    <img src="src/cover_images/<?= $productInfo[0]["photo"] ?>" alt="<?= $productInfo[0]["name"] ?>">
                    <div class="product-info--text">
                        <p><b>Product:</b> <?= $productInfo[0]["name"] ?></p>
                        <p><b>Price:</b> <?= number_format($productInfo[0]["price"]) ?> $</p>
                        <p><b>Color:</b> <?= $productInfo[0]["color"] ?></p>
                        <p><b>Memory:</b> <?= $productInfo[0]["memory"] ?>gb</p>
                        <p><b>Model year:</b> <?= $productInfo[0]["model_year"] ?></p>
                    </div>
                </div>

                <div class="product-form--edit">
                    <form action="/controller/editProductController.php" method="POST" enctype="multipart/form-data">
                        <h4>Update product info</h4>
                            <input type="hidden" name="id" value="<?= $productInfo[0]["id"] ?>">
                            <label for="name">Product name</label>
                            <input type="text" name="name" value="<?= $productInfo[0]["name"] ?>">
                            <label for="price">Product price</label>
                            <input type="text" name="price" value="<?= $productInfo[0]["price"] ?>">
                            <label for="color">Product color</label>
                            <input type="text" name="color" value="<?= $productInfo[0]["color"] ?>">
                            <label for="memory">Product memory</label>
                            <input type="text" name="memory" value="<?= $productInfo[0]["memory"] ?>">
                            <label for="model_year">Model year</label>
                            <input type="text" name="model_year" value="<?= $productInfo[0]["model_year"] ?>">
                            <label for="photo">Upload image</label>
                            <input type="file" name="photo" value="<?= $productInfo[0]["photo"] ?>">

                            <!-- Errors alert -->
                            <?php if (isset($_SESSION["error_editProduct"])) { ?>
                                <div class="alert">
                                    <span><?= $_SESSION["error_editProduct"] ?></span>
                                </div>
                                <?php unset($_SESSION["error_editProduct"]); ?>
                            <?php } ?>

                            <!-- Success alert -->
                            <?php if (isset($_SESSION["success_editProduct"])) { ?>
                                <div class="alert success">
                                    <span><?= $_SESSION["success_editProduct"] ?></span>
                                </div>
                                <?php unset($_SESSION["success_editProduct"]); ?>
                            <?php } ?>

                            <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>