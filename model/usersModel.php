<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL all users
    $sql = "SELECT * FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(2);

    // Vars
    $label = ["Admin", "Manager", "Staff"];
    $adminsCount = 0;
    $managersCount = 0;
    $staffCount = 0;

    // Cycle: count each user access
    for ($i = 0; $i < count($users); $i++) {
        if ($users[$i]["access"] == "Admin") {
            $adminsCount++;
        } elseif ($users[$i]["access"] == "Manager") {
            $managersCount++;
        } elseif ($users[$i]["access"] == "Staff") {
            $staffCount++;
        }
    }

    // Prepare data for JavaScript
    $data = [$adminsCount, $managersCount, $staffCount];