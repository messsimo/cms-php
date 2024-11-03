<?php
    // Параметры для подключения
    $host = "localhost";
    $db = "cms-php";
    $user = "root";
    $password = "root";

    // Подключение
    try {
        $pdo = new PDO("mysql:host=$host; dbname=$db", $user, $password);
    } catch (PDOException $error) {
        echo "Error in conection to Database. " . $error->getMessage();
    }