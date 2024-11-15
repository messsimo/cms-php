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

    // Function add new product
    function addProduct($name, $price, $photo, $color, $memory, $model_year) {
        // global var
        global $pdo;
        // SQL
        $sql = "INSERT INTO `products` (`name`, `price`, `photo`, `color`, `memory`, `model_year`) VALUES (:name, :price, :photo, :color, :memory, :model_year)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":price", $price);
        $stmt->bindParam(":photo", $photo);
        $stmt->bindParam(":color", $color);
        $stmt->bindParam(":memory", $memory);
        $stmt->bindParam(":model_year", $model_year);
        $stmt->execute();
    }

    // Delete product
    if (isset($_GET["remove"])) {
        // Var
        $id = $_GET["remove"];

        // SQL
        $sql = "DELETE FROM `products` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $_SESSION["delete_item"] = "Product #$id was deleted";
    }

    // Show product info 
    if (isset($_GET["id"])) {
        // Var
        $id = $_GET["id"];

        // SQL
        $sql = "SELECT * FROM `products` WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        $productInfo = $stmt->fetchAll(2);
    }

    // Update product info
    function updateProduct($id, $name, $price, $saved_file_path, $color, $memory, $model_year) {
        // var
        global $pdo;
        // SQL
        $sql = "UPDATE `products` SET 
            `name` = :name,
            `price` = :price,
            `photo` = :photo,
            `color` = :color,
            `memory` = :memory,
            `model_year` = :model_year
            WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':photo', $saved_file_path); 
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':memory', $memory);
        $stmt->bindParam(":model_year", $model_year);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }