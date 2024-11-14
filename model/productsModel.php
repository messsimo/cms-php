<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // Fields pre page
    $fieldsPrePage = 10; // Need to change value of var, if you want to change amout of fields pre page
    $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
    $offset = ($page - 1) * $fieldsPrePage;

    // Amount pf fields
    $sql = "SELECT count(*) FROM `products`";
    $totalFieldsPrepare = $pdo->prepare($sql); 
    $totalFieldsPrepare->execute();
    $totalFields = $totalFieldsPrepare->fetchColumn();
    $totalPages = ceil($totalFields / $fieldsPrePage);

    // SQL 
    $sql = "SELECT * FROM `products` ORDER BY `id` DESC LIMIT $offset, $fieldsPrePage";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $productsInfo = $stmt->fetchAll(2);