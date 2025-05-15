<?php
session_start();

$user = new UserController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $user->login();
    } elseif (isset($_POST['register'])) {
        $user->register();
    } elseif (isset($_POST['uploadPhoto'])) {
        $user->uploadPhoto();
    } elseif (isset($_GET['logout'])) {
        $user->logout();
    } elseif (isset($_GET['showPhoto'])) {
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

        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
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

        $stmt = $this->conn->prepare("SELECT email, password, is_admin FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];

                if ($user['is_admin'] == 1) {
                    header('Location: ../views/html/userAdmin.html');
                } else if ($user['is_admin'] == 0) {
                    echo 'Login success - Eres Usuario Normal';
                    header('Location: ../views/html/userUser.html');
                }
                exit();
            } else {
                echo 'Error: Contraseña incorrecta.';
            }
        } else {
            echo 'Error: El usuario no existe.';
        }
    }


    public function register()
    {
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

        if (strlen($password) > 100 || strlen($username) > 100) {
            die('Error: Nombre de usuario o contraseña demasiado largos.');
        }

        // Verificar si ya existe el email
        $stmt = $this->conn->prepare("SELECT idusers FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->fetch()) {
            die('Error: Este correo ya está registrado.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (name, username, fecha_born, email, password) VALUES (:name, :username, :fecha_born, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':fecha_born', $fecha_born);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);

        if ($stmt->execute()) {
            header('Location: ../views/html/login.html');
        } else {
            header('Location: ../views/html/register.html');
        }
        exit();
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
        $email = $_SESSION['email'];

        $stmt = $this->conn->prepare("UPDATE users SET photo = :photo WHERE email = :email");
        $stmt->bindParam(':photo', $photoData, PDO::PARAM_LOB);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            header('Location: ../views/html/userAdmin.html');
            exit();
        } else {
            echo 'Error al actualizar la foto.';
        }
    }

    public function showPhoto()
    {
        if (!isset($_SESSION['email'])) {
            die('No autorizado.');
        }

        $email = $_SESSION['email'];

        $stmt = $this->conn->prepare("SELECT photo FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            header("Content-Type: image/jpeg");
            echo $row['photo'];
        }

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
