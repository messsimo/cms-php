<?php
    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");

    // SQL
    $sql = "SELECT * FROM `orders_status`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $order_status = $stmt->fetchAll(2);

    // Change status
    function change_status($status, $id) {
        // Global var
        global $pdo;

        // SQL
        $sql = "UPDATE `orders` SET `status` = :status WHERE `id` = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":status", $status);
        $stmt->execute();
        $status = $stmt->fetchAll(2);

        return $status;
    }