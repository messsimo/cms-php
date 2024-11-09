<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/staff_managment.css">

    <title>Staff managment - CMS</title>
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
                <a href="/view/dashboard.php">Dashboard</a>
                <a href="/view/orders_managment.php">Orders managment</a>
                <a href="">Staff managment</a>
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1>Staff Managment</h1>

            <table>
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Access</td>
                        <td>Details</td>
                    </tr>
                </thead>
                <tbody>
                   <tr>
                        <td>Daniel Mihai</td>
                        <td>danielmihai.it@mail.ru</td>
                        <td>Admin</td>
                        <td><a href="">More info</a></td>
                   </tr>
                   <tr>
                        <td>Daniel Mihai</td>
                        <td>danielmihai.it@mail.ru</td>
                        <td>Admin</td>
                        <td><a href="">More info</a></td>
                   </tr>
                   <tr>
                        <td>Daniel Mihai</td>
                        <td>danielmihai.it@mail.ru</td>
                        <td>Admin</td>
                        <td><a href="">More info</a></td>
                   </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>