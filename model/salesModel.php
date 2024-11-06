<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL
    $sql = "SELECT * FROM `sales`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $salesInfo = $stmt->fetchAll(2);