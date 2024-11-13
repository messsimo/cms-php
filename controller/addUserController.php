<?php
    // Session start
    session_start();

    // Require user model
    require("/Users/danielmihai/Documents/code/cms_php/model/usersModel.php");

    // POST vars
    $login = $_POST["login"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $rePassword = $_POST["rePassword"];
    $access = $_POST["access"];

    // Function: Password validation
    function passwordValidation($password) {
        // Var
        $specialChars = '/[#$%&()*+,.?@^_|:!{}<>";\-]/';

        if (!preg_match($specialChars, $password)) {
            $_SESSION["error_addUser"] = "Password must have have special chars";
            return false;
        } else if (!preg_match('/[0-9]/', $password)) {
            $_SESSION["error_addUser"] = "Password must have have some numbers";
            return false;
        } else if (!preg_match('/[a-zA-Z]/', $password)) {
            $_SESSION["error_addUser"] = "Password must have have some letters";
            return false;
        }

        return true;
    }

    // Validation 
    if (empty($login) || empty($email) || empty($password) || empty($rePassword) || empty($access)) {
        $_SESSION["error_addUser"] = "Fill all the fields";
        header("Location: /view/staff_managment.php");
    } else if (strlen($login) < 2 || strlen($login) > 24) {
        $_SESSION["error_addUser"] = "Login must be under 2 and 24";
        header("Location: /view/staff_managment.php");
    } else if (strpos($email, "@") === false) {
        $_SESSION["error_addUser"] = "Add correct email. Example: cms@gmail.com";
        header("Location: /view/staff_managment.php");
    } else if (strlen($password) < 4 || strlen($password) > 12){
        $_SESSION["error_addUser"] = "Password must be under 4 and 12";
        header("Location: /view/staff_managment.php");
    } else if (!passwordValidation($password)) {
        header("Location: /view/staff_managment.php");
    } else if ($password != $rePassword) {
        $_SESSION["error_addUser"] = "Passwords are not mutch";
        header("Location: /view/staff_managment.php");
    } else if (empty($access)) {
        $_SESSION["error_addUser"] = "Chose role for the new user";
        header("Location: /view/staff_managment.php");
    }


    // Upload photo & validation
    // Default vars
    $upload_dir = "/Users/danielmihai/Documents/code/cms_php/view/src/avatars/";
    $default_photo = "no_avatar.png";
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
                    $_SESSION["error_addUser"] = "Failed to save uploaded file.";
                    header("Location: /view/staff_managment.php");
                }
            } else {
                $_SESSION["error_addUser"] = "Error uploading file.";
                header("Location: /view/staff_managment.php");
            }
        } else {
            $_SESSION["error_addUser"] = "Invalid file type. Only JPG, JPEG, PNG are allowed.";
            header("Location: /view/staff_managment.php");
        }
    }

    // Password hash
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Function add user
    addUser($login, $email, $password, $access, $saved_file_path);

    $_SESSION["success_addUser"] = "User was added";
    header("Location: /view/staff_managment.php");