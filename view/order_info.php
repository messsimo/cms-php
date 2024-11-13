<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/orders_managment.css">
    <link rel="stylesheet" href="src/css/order_info.css">

    <title>Order Info - CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();

        // Require oreders model
        require("/Users/danielmihai/Documents/code/cms_php/model/ordersModel.php");
        // Require order delivery method model
        require("/Users/danielmihai/Documents/code/cms_php/model/order_statusModel.php");
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
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Order #<?= $orderInfo[0]["id"] ?></h1>

            <div class="container-orderInfo">
                <div class="orderInfo">
                    <h3>Order info:</h3>
                    <span>Customer: <i><?= $orderInfo[0]["customer"] ?></i></span>
                    <span>Status: <i><?= $orderInfo[0]["status"] ?></i></span>
                    <span>Order time: <i><?= $orderInfo[0]["order_time"] ?></i></span>
                    <span>Order item/s: <i><?= $orderInfo[0]["order_items"] ?></i></span>
                    <span>Amount price: <i><?= $orderInfo[0]["amount_price"] ?></i></span>
                    <span>Phone number: <i><?= $orderInfo[0]["phone_number"] ?></i></span>
                    <span>Delivery method: <i><?= $orderInfo[0]["delivery_method"] ?></i></span>
                    <span>Payment method: <i><?= $orderInfo[0]["payment"] ?></i></span>
                </div>

                <div class="chagheStatus">
                    <h3>Change status:</h3>
                    <form action="/controller/change_statusController.php" method="POST">
                        <label for="status">Status</label>
                        <select name="status">
                            <option value="<?= $orderInfo[0]["status"] ?>"><?= $orderInfo[0]["status"] ?> - Active</option>
                            <?php foreach ($order_status as $el) { ?>
                                <option value="<?= $el["status"] ?>"><?= $el["status"] ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="id" value="<?= $orderInfo[0]["id"] ?>">

                        <button type="submit">Change status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>