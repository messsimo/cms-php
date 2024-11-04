<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include CSS -->
    <link rel="stylesheet" href="src/css/index.css">
    <link rel="stylesheet" href="src/css/login.css">
    <title>CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();
    ?>
    <!-- LogIn form -->
    <div class="login-container">
    <form action="/controller/loginController.php" method="POST">
        <h2>LogIn</h2>
        <label for="login">Login</label>
        <input type="text" placeholder="Carlos Sainz" name="login">
        <label for="password">Password</label>
        <input type="password" placeholder="********" name="password">

        <!-- Errors alert -->
        <?php if (isset($_SESSION["error"])) { ?>
            <div class="alert">
                <span><?= $_SESSION["error"] ?></span>
            </div>
            <?php unset($_SESSION["error"]); ?>
        <?php } ?>

        <button type="submit">LogIn</button>
    </form>
    </div>  
</body>
</html>