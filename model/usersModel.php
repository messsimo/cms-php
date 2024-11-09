<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL all fields
    $sql = "SELECT * FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(2);

    // Fields pre page
    $fieldsPrePage = 10; // Need to change value of var, if you want to change amout of fields pre page
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * $fieldsPrePage;
    
    // Amount pf fields
    $sql = "SELECT count(*) FROM `users`";
    $totalFieldsPrepare = $pdo->prepare($sql); 
    $totalFieldsPrepare->execute();
    $totalFields = $totalFieldsPrepare->fetchColumn();
    $totalPages = ceil($totalFields / $fieldsPrePage);
    
    // SQL 
    $sql = "SELECT * FROM `users` ORDER BY `id` DESC LIMIT $offset, $fieldsPrePage";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $usersInfo = $stmt->fetchAll(2);

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