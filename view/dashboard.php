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
                <a href="">Dashboard</a>
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
                        <td>Unsuccessul sales</td>
                        <td>Expenses</td>
                        <td>Income</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>January 2023</td>
                        <td>764</td>
                        <td class="successful_sales">500</td>
                        <td class="unsuccessful_sales">264</td>
                        <td class="expenses">- 94.321$</td>
                        <td class="income">+ 111.441$</td>
                    </tr>
                    <tr>
                        <td>January 2023</td>
                        <td>764</td>
                        <td class="successful_sales">500</td>
                        <td class="unsuccessful_sales">264</td>
                        <td class="expenses">- 94.321$</td>
                        <td class="income">+ 111.441$</td>
                    </tr>
                    <tr>
                        <td>January 2023</td>
                        <td>764</td>
                        <td class="successful_sales">500</td>
                        <td class="unsuccessful_sales">264</td>
                        <td class="expenses">- 94.321$</td>
                        <td class="income">+ 111.441$</td>
                    </tr>
                    <tr>
                        <td>January 2023</td>
                        <td>764</td>
                        <td class="successful_sales">500</td>
                        <td class="unsuccessful_sales">264</td>
                        <td class="expenses">- 94.321$</td>
                        <td class="income">+ 111.441$</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>