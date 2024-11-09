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
    ?>

    <!-- Wrapper -->
    <div class="wrapper">
        <!-- Navigation block -->
        <div class="nav">
            <div class="user-info">
                <h2>Admin Panel (CMS)</h2>
                <img src="src/images/anton.png" alt="<?= $_SESSION["user"][0]["login"] ?? '' ?>">
                <p><?= $_SESSION["user"][0]["login"] ?? '' ?></p>
            </div>

            <nav>
                <a href="/view/dashboard.php">Dashboard</a>
                <a href="/view/orders_managment.php">Orders managment</a>
                <a href="">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Order #1</h1>

            <div class="container-orderInfo">
                <div class="orderInfo">
                    <h3>Order info:</h3>
                    <span>Customer: <i>Jack Jhonson</i></span>
                    <span>Status: <i>Not Sent</i></span>
                    <span>Order time: <i>07.07.2007 07:07</i></span>
                    <span>Order item/s: <i>Iphone 4, black, 16gb</i></span>
                    <span>Amount price: <i>457$</i></span>
                    <span>Phone number: <i>069118014</i></span>
                    <span>Delivery method: <i>To the door</i></span>
                    <span>Payment method: <i>Card</i></span>
                </div>

                <div class="chagheStatus">
                    <h3>Change status:</h3>
                    <form action="" method="POST">
                        <label for="">Status</label>
                        <select name="" id="">
                            <option value="">Sent</option>
                            <option value="">Not sent</option>
                        </select>

                        <button>Change status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>