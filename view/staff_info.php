<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Require CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/nav_block.css">
    <link rel="stylesheet" href="src/css/staff_info.css">

    <title>Staff Info - CMS</title>
</head>
<body><?php
        // Start session
        session_start();

        // Require users model
        require("/Users/danielmihai/Documents/code/cms_php/model/usersModel.php");
        // Require access model
        require("/Users/danielmihai/Documents/code/cms_php/model/accessModel.php");
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
                <a href="">Products managment</a>
            </nav>
        </div>

        <!-- Right container -->
        <div class="container-right">
            <h1><?= $staffInfo[0]["login"] ?> info</h1>

            <div class="container-staffInfo">
                <div class="user-image">
                    <img src="src/avatars/<?= $staffInfo[0]["photo"] ?>" alt="<?= $staffInfo[0]["login"] ?>">
                    <p><?= $staffInfo[0]["login"] ?></p>
                </div>

                <div class="user-form">
                    <h4>Edit user data</h4>
                    <form action="/controller/updateUserController.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" value="<?= $staffInfo[0]["id"] ?>" name="id">
                        <label for="login">Login</label>
                        <input type="text" value="<?= $staffInfo[0]["login"] ?>" name="login">
                        <label for="email">Email</label>
                        <input type="email" value="<?= $staffInfo[0]["email"] ?>" name="email">
                        <label for="password">Password</label>
                        <input type="text" value="<?= $staffInfo[0]["password"] ?>" name="password">
                        <label for="access">Access</label>
                        <select name="access" id="access">
                            <option value="<?= $staffInfo[0]["access"] ?>"><?= $staffInfo[0]["access"] ?> - Active</option>
                            <?php foreach ($access_info as $el) { ?>
                                <option value="<?= $el['access'] ?>"><?= $el["access"] ?></option>
                            <?php } ?>
                        </select>
                        <label for="photo">Photo</label>
                        <input type="file" value="<?= $staffInfo[0]["photo"] ?>" name="photo">

                        <div class="alert success">
                            <span>123</span>
                        </div>

                        <!-- Errors alert -->
                        <?php if (isset($_SESSION["error_editStaff"])) { ?>
                            <div class="alert">
                                <span><?= $_SESSION["error_editStaff"] ?></span>
                            </div>
                            <?php unset($_SESSION["error_editStaff"]); ?>
                        <?php } ?>

                        <!-- Success alert -->
                        <?php if (isset($_SESSION["success_editStaff"])) { ?>
                            <div class="alert success">
                                <span><?= $_SESSION["success_editStaff"] ?></span>
                            </div>
                            <?php unset($_SESSION["success_editStaff"]); ?>
                        <?php } ?>

                        <button type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>