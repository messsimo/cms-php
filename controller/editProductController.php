<?php
    // Session start
    session_start();

    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");
    // Require user model
    require("/Users/danielmihai/Documents/code/cms_php/model/productsModel.php");

    // POST vars
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $memory = $_POST["memory"];
    $color = $_POST["color"];
    $model_year = $_POST["model_year"];

    // Validation 
    if (empty($name) || empty($price) || empty($memory) || empty($color) || empty($model_year)) {
        $_SESSION["error_editProduct"] = "Fill all the fields";
        header("Location: /view/product_info.php?id=$id");
    } else if (is_int($price) || is_int($memory) || is_int($model_year)) {
        $_SESSION["error_editProduct"] = "Price, memory and model year of product must be numeric";
        header("Location: /view/product_info.php?id=$id");
    } else if (!ctype_alpha($color)) {
        $_SESSION["error_editProduct"] = "Color shouldn't contain any numbers or special characters";
        header("Location: /view/product_info.php?id=$id");
    }

    // User info by ID
    $sql = "SELECT * FROM `products` WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $productInfo = $stmt->fetchAll(2);

    // Existing photo
    $existing_photo = $productInfo[0]["photo"];

    // Upload photo & validation
    // Default vars
    if (isset($_FILES["photo"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        // PATH
        $upload_dir = "/Users/danielmihai/Documents/code/cms_php/view/src/cover_images/";

        // Create upload directory if not exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

         // Data about photo
        $upload_photo = $_FILES["photo"];
        $photo = uniqid() . "-" . basename($upload_photo["name"]);
        $target_file = $upload_dir . $photo;
        $photo_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png"];

        // Vailidation format photo
        if (in_array($photo_type, $allowed_types)) {
            if ($upload_photo["error"] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($upload_photo["tmp_name"], $target_file)) {
                    $saved_file_path = $photo;
                } else {
                    $_SESSION["error_editProduct"] = "Failed to save uploaded file.";
                    header("Location: /view/product_info.php?id=$id");
                    exit();
                }
            } else {
                $_SESSION["error_editProduct"] = "Error uploading file.";
                header("Location: /view/product_info.php?id=$id");
                exit();
            }
        } else {
            $_SESSION["error_editProduct"] = "Invalid file type. Only JPG, JPEG, PNG are allowed.";
            header("Location: /view/product_info.php?id=$id");
            exit();
        }
    } else {
        $saved_file_path = $existing_photo;
    }

    // Update user
    updateProduct($id, $name, $price, $saved_file_path, $color, $memory, $model_year);

    $_SESSION["success_editProduct"] = "Data was updtated successful";
    header("Location: /view/product_info.php?id=$id");