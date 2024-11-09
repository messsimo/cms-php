<?php
    // Start session
    session_start();

    // Require order status model
    require("/Users/danielmihai/Documents/code/cms_php/model/order_statusModel.php");

    // Vars
    $new_status = $_POST["status"];
    $id = $_POST["id"];

    // Validation
    if (empty($new_status)) {
        $_SESSION["error_orderInfo"] = "Fill the field";
        header("Location: /view/orders_managment.php");
    }

    // Call function to change status
    $status = change_status($new_status, $id);
    
    // Validation of status
    if ($status = $new_status) {
        $_SESSION["error_orderInfo"] = "The new status is the same as the old one";
        header("Location: /view/orders_managment.php");
    }

    $_SESSION["success_orderInfo"] = "Status was changed successful";
    header("Location: /view/orders_managment.php");