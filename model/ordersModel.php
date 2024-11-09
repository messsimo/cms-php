<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // Fields pre page
    $fieldsPrePage = 15; // Need to change value of var, if you want to change amout of fields pre page
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * $fieldsPrePage;

    // Amount pf fields
    $sql = "SELECT count(*) FROM `orders`";
    $totalFieldsPrepare = $pdo->prepare($sql); 
    $totalFieldsPrepare->execute();
    $totalFields = $totalFieldsPrepare->fetchColumn();
    $totalPages = ceil($totalFields / $fieldsPrePage);

    // SQL 
    $sql = "SELECT * FROM `orders` ORDER BY `id` DESC LIMIT $offset, $fieldsPrePage";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $ordersInfo = $stmt->fetchAll(2);

    
    // Order ifno SQL
    if (isset($_GET["id"])) {
        // Var
        $id = $_GET["id"];

        // SQL
        $sql = "SELECT * FROM `orders` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $orderInfo = $stmt->fetchAll(2);
    }