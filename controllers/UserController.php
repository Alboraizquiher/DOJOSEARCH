<?php
session_start();
require 'db_connection.php';

$user = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $user->login();
    } else if (isset($_POST['register'])) {
        $user->register();
        
    } else if (isset($_GET['logout'])) {
        $user->logout();
    } else if (isset($_POST['uploadPhoto'])) {
        $user->uploadPhoto();
        # code...
    }else if (isset($_GET['showPhoto'])) {
        $user->showPhoto();
    }
    
}

class UserController
{
    public $conn;

    public function __construct()
    {
        $servername = "10.118.4.144";
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            die('Error: Todos los campos son obligatorios.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Error: Formato de email inválido.');
        }

        $stmt = $this->conn->prepare("SELECT email, password, is_admin FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_password, $is_admin);
            $stmt->fetch();

            if (password_verify($password, $db_password)) {
                $_SESSION['email'] = $db_email;
                $_SESSION['is_admin'] = $is_admin;
                echo 'Login success';

                if ($is_admin == 1) {
                   
                    header('Location: ../views/html/userAdmin.html');
                } else if ($is_admin == 0) {
                    echo 'Login success - Eres Usuario Normal';
                    header('Location: ../views/html/userUser.html');
                    exit();
                }
            } else {
                echo 'Login failed';
            }

            $stmt->close();
        }
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die("Error 405: Método no permitido");
        }

        $name = trim($_POST['name']);
        $fecha_born = trim($_POST['fecha_born']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $username = trim($_POST['username']);

        if (empty($name) || empty($username) || empty($fecha_born) || empty($email) || empty($password)) {
            die('Error: Todos los campos son obligatorios.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            die('Error: Formato de email inválido.');
        }

        if (strlen($password) > 100) {
            die('Error: La contraseña debe tener menos de 100 caracteres.');
        }

        if (strlen($username) > 100) {
            die('Error: El nombre de usuario debe tener menos de 100 caracteres.');
        }

        // Resto del código...
        echo "Nombre: $name <br>";
        echo "Username: $username <br>";
        echo "Fecha de nacimiento: $fecha_born <br>";
        echo "Correo: $email <br>";
        echo "Contraseña (sin hash): $password <br>";

        // Validación de email existente
        $stmt = $this->conn->prepare("SELECT idusers FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            die('Error: Este correo ya está registrado.');
        }
        $stmt->close();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo "Contraseña hasheada: $hashedPassword <br>";

        $stmt = $this->conn->prepare("INSERT INTO users (name, username, fecha_born, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('sssss', $name, $username, $fecha_born, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo 'Registro exitoso!';
            $stmt->close();
            $this->conn->close();
            header('Location: ../views/html/login.html');
            exit();
        } else {
            $stmt->close();
            $this->conn->close();
            header('Location: ../views/html/register.html');
            exit();
        }
    }
    public function uploadPhoto()
    {
        if (!isset($_SESSION['email'])) {
            die('Error: No has iniciado sesión.');
        }
    
        if (!isset($_FILES['photo']) || $_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
            die('Error al subir la imagen.');
        }
    
        $photoData = file_get_contents($_FILES['photo']['tmp_name']);
        $email = $_SESSION['email'];  // usamos esto para identificar al usuario
    
        $stmt = $this->conn->prepare("UPDATE users SET photo = ? WHERE email = ?");
        $stmt->bind_param('bs', $null, $email);
    
        $null = null;
        $stmt->send_long_data(0, $photoData);
    
        if ($stmt->execute()) {
            echo 'Foto actualizada con éxito.';
            header('Location: ../views/html/userAdmin.html');
            exit();
        } else {
            echo 'Error al actualizar la foto.';
        }
    
        $stmt->close();
    }
    public function showPhoto()
{
    if (!isset($_SESSION['email'])) {
        die('No autorizado.');
    }

    $email = $_SESSION['email'];
    $stmt = $this->conn->prepare("SELECT photo FROM users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($photo);
        $stmt->fetch();

        header("Content-Type: image/jpeg");
        echo $photo;
    }

    $stmt->close();
    exit();
}





   
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /index.php');
        exit();
    }
}
