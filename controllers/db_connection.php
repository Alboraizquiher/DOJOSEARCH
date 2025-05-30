<?php
$server = "127.0.0.1";
$user = "root";
$password = ""; // contraseña vacía
$database = "dojosearch";
$port = 3306;

try {
    $conn = new PDO("mysql:host=$server;port=$port;dbname=$database", $user, $password); // <-- CAMBIA $connection a $conn
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
    exit;
}
?>
