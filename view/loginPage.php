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
    <!-- LogIn form -->
    <div class="login-container">
    <form action="" method="POST">
        <h2>LogIn</h2>
        <label for="login">Login</label>
        <input type="text" placeholder="Carlos Sainz" name="login">
        <label for="password">Password</label>
        <input type="password" placeholder="********" name="password">

        <!-- Errors alert -->
        <?php if (isset($_SESSION["error"])) { ?>
        <div class="alert">
            <ul>
                <li><?= $_SESSION["error"] ?? '' ?></li>
            </ul>
        </div>
        <?php } ?>

        <button type="submit">LogIn</button>
    </form>
    </div>  
</body>
</html>