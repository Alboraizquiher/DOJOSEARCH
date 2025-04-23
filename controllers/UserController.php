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

        // Consulta para obtener el hash de la contraseña de la base de datos
        $stmt = $this->conn->prepare("SELECT email, password, is_admin FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);  // No necesitas pasar la contraseña en esta consulta
        $stmt->execute();
        $stmt->store_result();

        // Verifica si se encontró un usuario con el email proporcionado
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_password, $is_admin);  // Asigna el resultado a las variables
            $stmt->fetch();

            // Verifica si la contraseña ingresada coincide con el hash almacenado
            if (password_verify($password, $db_password)) {
                // Si las contraseñas coinciden, inicia sesión
                $_SESSION['email'] = $db_email;
                $_SESSION['is_admin'] = $is_admin;
                echo 'Login success';

                if ($is_admin == 1) {
                    echo 'Login success - Eres Administrador';
                    header(header: 'Location: ../views/html/userAdmin.html');
                } elseif ($is_admin == 0) {
                    echo 'Login success - Eres Usuario Normal';
                    header(header: 'Location: ../views/html/userUser.html');
                    exit();
                }
            } else {
                // Si no se encuentra un usuario con ese email
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

        // Capturar datos del formulario
        $name = trim($_POST['name']);
        $username = trim($_POST['username']);
        $fecha_born = trim($_POST['fecha_born']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        //  Imprimir datos para depuración
        echo "Nombre: $name <br>";
        echo "Fecha de nacimiento: $fecha_born <br>";
        echo "Correo: $email <br>";
        echo "Contraseña (sin hash): $password <br>";

        // Verificar que no estén vacíos
        if (empty($name) ||empty($username) || empty($fecha_born) || empty($email) || empty($password)) {
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
        $stmt = $this->conn->prepare("INSERT INTO users (name,username, fecha_born, email, password) VALUES (?, ?, ?, ?)");
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

    public function logout()
    {
        // Destroy all session data
        session_unset();
        session_destroy();

        // Redirect to the homepage or login page
        header('Location: /index.php');
        exit();
    }
}
