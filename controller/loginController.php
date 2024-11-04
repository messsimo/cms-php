<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // Start session
    session_start();

    // POST data
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Validation
    if (empty($login) || empty($password)) {
        $_SESSION["error"] = "Fill all the fields";
        header("Location: /view/loginPage.php");
        exit;
    } else if (strlen($login) < 2 || strlen($login) > 24) {
        $_SESSION["error"] = "Your login must more then 2 chars and under 24 chars";
        header("Location: /view/loginPage.php");
        exit;
    } else if (strlen($password) < 4 || strlen($password) > 12) {
        $_SESSION["error"] = "Your password must more then 4 chars and under 12 chars";
        header("Location: /view/loginPage.php");
        exit;
    }

    // Find user
    $sql = "SELECT * FROM `users` WHERE `login` = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam("login", $login);
    $stmt->execute();

    // Find user
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION["user"] = $user;
        header("Location: http://localhost:4000/view/dashboard.php");
        exit;
    } else {
        $_SESSION["error"] = "User are not found or password and login are incorect";
        header("Location: /view/loginPage.php");
        exit;
    }