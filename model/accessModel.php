<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL
    $sql = "SELECT * FROM `access`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $access_info = $stmt->fetchAll(2);