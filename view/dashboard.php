<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/dashboard.css">
    <title>CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();

        // Require Sales model
        require("/Users/danielmihai/Documents/code/cms_php/model/salesModel.php");
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
                <a href="">Orders managment</a>
                <a href="">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Table -->
        <div class="container-right">
            <h1>Dashboard</h1>
            <table>
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Amout of sales</td>
                        <td>Successful sales</td>
                        <td>Unsuccessful sales</td>
                        <td>Expenses</td>
                        <td>Income</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($salesInfo as $el) { ?>
                    <tr>
                        <td><?= $el["date"] ?></td>
                        <td><?= $el["amount_of_sales"] ?></td>
                        <td class="successful_sales"><?= $el["successful_sales"] ?></td>
                        <td class="unsuccessful_sales"><?= $el["unsuccessful_sales"] ?></td>
                        <td class="expenses">- <?= number_format($el["expenses"]) ?>$</td>
                        <td class="income">+ <?= number_format($el["income"]) ?>$</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>