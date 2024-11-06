<?php    
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL
    $sql = "SELECT * FROM `sales`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $salesChart = $stmt->fetchAll(2);
    
    // Empty arrays for data from table
    $labels = [];
    $unsuccessful_sales = [];
    $successful_sales = [];
    $expenses = [];
    $income = [];

    // Cycle 
    foreach ($salesChart as $el) {
        $labels[] = $el["date"];
        $unsuccessful_sales[] = $el["unsuccessful_sales"];
        $successful_sales[] = $el["successful_sales"];
    }

    foreach ($salesChart as $el) {
        $expenses[] = $el["expenses"];
        $income[] = $el["income"];
    }