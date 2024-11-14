<?php
    // Session start
    session_start();

    // Require user model
    require("/Users/danielmihai/Documents/code/cms_php/model/productsModel.php");

    // POST vars
    $name = $_POST["name"];
    $price = $_POST["price"];
    $memory = $_POST["memory"];
    $color = $_POST["color"];
    $model_year = $_POST["model_year"];

    // Validation 
    if (empty($login) || empty($email) || empty($password) || empty($rePassword) || empty($access)) {
        $_SESSION["error_addProduct"] = "Fill all the fields";
        header("Location: /view/products_managment.php");
    } else if (!is_int($price) || !is_int($memory) || !is_int($model_year)) {
        $_SESSION["error_addProduct"] = "Price, memory and model year of product must be numeric";
        header("Location: /view/products_managment.php");
    } else if (!is_string($color)) {
        $_SESSION["error_addProduct"] = "Color shouldn't has any numbers";
        header("Location: /view/products_managment.php");
    }


    // Upload photo & validation
    // Default vars
    $upload_dir = "/Users/danielmihai/Documents/code/cms_php/view/src/cover_images/";
    $default_photo = "no_image.png";
    $saved_file_path = $default_photo;

    // Create upload directory if not exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Validation for upload photo
    if (isset($_FILES["photo"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        $upload_photo = $_FILES["photo"];
        $photo = uniqid() . "-" . basename($upload_photo["name"]);
        $target_file = $upload_dir . $photo;
        $photo_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ["jpg", "jpeg", "png"];

        if (in_array($photo_type, $allowed_types)) {
            if ($upload_photo["error"] === UPLOAD_ERR_OK) {
                if (move_uploaded_file($upload_photo["tmp_name"], $target_file)) {
                    $saved_file_path = $photo;
                } else {
                    $_SESSION["error_addProduct"] = "Failed to save uploaded file.";
                    header("Location: /view/products_managment.php");
                }
            } else {
                $_SESSION["error_addProduct"] = "Error uploading file.";
                header("Location: /view/products_managment.php");
            }
        } else {
            $_SESSION["error_addProduct"] = "Invalid file type. Only JPG, JPEG, PNG are allowed.";
            header("Location: /view/products_managment.php");
        }
    }

    // Function add user
    addProduct($name, $price, $saved_file_path, $color, $memory, $model_year);

    $_SESSION["success_addProduct"] = "User was added";
    header("Location: /view/products_managment.php");