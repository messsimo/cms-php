<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/orders_managment.css">

    <title>Order Managment - CMS</title>
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
                <a href="/view/staff_managment.php">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Orders Managment</h1>

            <div class="status-alert">
                <?php if (isset($_SESSION["error_orderInfo"])) { ?>
                    <span class="error">ALERT: <?= $_SESSION["error_orderInfo"] ?></span>
                    <?php unset($_SESSION["error_orderInfo"]); ?>
                <?php } else if (isset($_SESSION["success_orderInfo"])) { ?>
                    <span class="success">ALERT: <?= $_SESSION["success_orderInfo"] ?></span>
                    <?php unset($_SESSION["success_orderInfo"]); ?>
                <?php } ?>
            </div>

            <table>
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Customer</td>
                        <td>Status</td>
                        <td>Order time</td>
                        <td>Order items</td>
                        <td>Amout price</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ordersInfo as $el) { ?>
                    <tr>
                        <td><?= $el["id"] ?></td>
                        <td><?= $el["customer"] ?></td>
                        <?php if ($el["status"] == "Sent") { ?>
                            <td class="success"><b><?= $el["status"] ?></b></td>
                        <?php } else {?>
                            <td class="unsuccess"><b><?= $el["status"] ?></b></td>
                        <?php } ?>
                        <td><?= $el["order_time"] ?></td>
                        <td><?= $el["order_items"] ?></td>
                        <td><?= number_format($el["amount_price"]) ?>$</td>
                        <td><a href="/view/order_info.php?id=<?= $el["id"]?>">More info</a></td>
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
                        echo '<a href="/view/orders_managment.php?page=' . $i . '">' . $i . '</a> ';
                    }
                } ?>
            </div>            
        </div>
    </div>
</body>
</html>