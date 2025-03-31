<?php
session_start();

$user = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $user->login();
    } else if (isset($_POST['register'])) {
        $user->register();
    } else if (isset($_GET['logout'])) {
        $user->logout();
    }
}

class UserController
{
    public $username;
    public $password;
    public $name;

    public $conn;

    public function __construct()
    {
        $servername = "10.118.2.73";
        $username = "Admin";
        $password = "admin";
        $dbname = "auth_db";
        $port = 3306;

        $this->conn = new mysqli($servername, $username, $password, $dbname, $port);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
            echo 'Connection success';
        }
    }
    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $this->conn->prepare("SELECT name, password FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        if ($stmt->fetch()) {
            $_SESSION['username'] = $username;
            echo 'Login success';
        } else {
            echo 'Login failed';
        }
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        die("Error 405: Método no permitido");
    }

    session_start();
    require 'db_connection.php';

    // Capturar datos del formulario
    $name = trim($_POST['name']);
    $fecha_born = trim($_POST['fecha_born']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //  Imprimir datos para depuración
    echo "Nombre: $name <br>";
    echo "Fecha de nacimiento: $fecha_born <br>";
    echo "Correo: $email <br>";
    echo "Contraseña (sin hash): $password <br>";

    // Verificar que no estén vacíos
    if (empty($name) || empty($fecha_born) || empty($email) || empty($password)) {
        die('Error: Todos los campos son obligatorios.');
    }

    // Verificar si el correo ya existe
    $stmt = $this->conn->prepare("SELECT idusers FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die('Error: Este correo ya está registrado.');
    }
    $stmt->close();

    // Hashear la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    echo "Contraseña hasheada: $hashedPassword <br>";

    // Insertar usuario en la base de datos
    $stmt = $this->conn->prepare("INSERT INTO users (name, fecha_born, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssss', $name, $fecha_born, $email, $hashedPassword);

    if ($stmt->execute()) {
        echo 'Registro exitoso!';
        $stmt->close();
        $this->conn->close();
        header('Location: ../../html.html');
        exit();
    } else {
        $stmt->close();
        $this->conn->close();
        die('Error en el registro: ' . $stmt->error);
    }
}


    public function logout()
    {
        session_destroy();
        header('Location: <!-- página inicio -->');
    }
}
