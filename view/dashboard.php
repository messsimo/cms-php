<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Include CSS -->
    <link rel="stylesheet" href="src/css/dashboard.css">
    <title>CMS</title>
</head>
<body>
    <?php
        // Start session
        session_start();
    ?>

    <p><?= $_SESSION["user"][0]["login"] ?></p>
</body>
</html>