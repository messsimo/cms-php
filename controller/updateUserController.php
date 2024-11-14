<?php
    // Session start
    session_start();

    // Require database
    require("/Users/danielmihai/Documents/code/cms_php/model/database.php");
    // Require user model
    require("/Users/danielmihai/Documents/code/cms_php/model/usersModel.php");

    // POST vars
    $id = $_POST["id"];
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $access = $_POST["access"];

    // User info by ID
    $sql = "SELECT * FROM `users` WHERE `id` = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $userPhoto = $stmt->fetchAll(2);

    // Existing photo
    $existing_photo = $userPhoto[0]["photo"];

    // Function: Password validation
    function passwordValidation($password) {
        // Var
        $specialChars = '/[#$%&()*+,.?@^_|:!{}<>";\-]/';

        if (!preg_match($specialChars, $password)) {
            $_SESSION["error_editStaff"] = "Password must have have special chars";
            return false;
        } else if (!preg_match('/[0-9]/', $password)) {
            $_SESSION["error_editStaff"] = "Password must have have some numbers";
            return false;
        } else if (!preg_match('/[a-zA-Z]/', $password)) {
            $_SESSION["error_editStaff"] = "Password must have have some letters";
            return false;
        }

        return true;
    }
    
    // Validation
    if (empty($login) || empty($email) || empty($password) || empty($access)) {
        $_SESSION["error_editStaff"] = "Fill all the fields";
        header("Location: /view/staff_info.php?id=$id");
    } else if (strlen($login) < 2 || strlen($login) > 24) {
        $_SESSION["error_editStaff"] = "Login must be under 2 and 24";
        header("Location: /view/staff_info.php?id=$id");
    } else if (strpos($email, "@") === false) {
        $_SESSION["error_editStaff"] = "Add correct email. Example: cms@gmail.com";
        header("Location: /view/staff_info.php?id=$id");
    } else if (strlen($password) < 4 || strlen($password) > 12){
        $_SESSION["error_editStaff"] = "Password must be under 4 and 12";
        header("Location: /view/staff_info.php?id=$id");
    } else if (!passwordValidation($password)) {
        header("Location: /view/staff_info.php?id=$id");
    } else if (empty($access)) {
        $_SESSION["error_editStaff"] = "Chose role for the new user";
        header("Location: /view/staff_info.php?id=$id");
    }

    // Upload photo & validation
    // Default vars
    if (isset($_FILES["photo"]) && is_uploaded_file($_FILES["photo"]["tmp_name"])) {
        // PATH
        $upload_dir = "/Users/danielmihai/Documents/code/cms_php/view/src/avatars/";

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
                    $_SESSION["error_addUser"] = "Failed to save uploaded file.";
                    header("Location: /view/staff_info.php?id=$id");
                    exit();
                }
            } else {
                $_SESSION["error_addUser"] = "Error uploading file.";
                header("Location: /view/staff_info.php?id=$id");
                exit();
            }
        } else {
            $_SESSION["error_addUser"] = "Invalid file type. Only JPG, JPEG, PNG are allowed.";
            header("Location: /view/staff_info.php?id=$id");
            exit();
        }
    } else {
        $saved_file_path = $existing_photo;
    }

    // Password hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Update user
    updateUser($id, $login, $email, $password, $access, $saved_file_path);
    $_SESSION["success_editStaff"] = "Data was updtated successful";
    header("Location: /view/staff_info.php?id=$id");