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
        session_start(); //inicio de sesión para poder guardar los datos del usuario.

        // Mostrar errores en pantalla
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        require 'db_connection.php';  // Se utilizan variables fijas para probar el registro antes de conectarlo con una base de datos.

        // Que el método reciba los datos del usuario y los guarde en la base de datos.

        $name = trim($_POST['name']);
        $fecha_born = trim($_POST['fecha_born']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);


        //Verificar que esten vacios

        if (!empty($name)  && !empty($fecha_born) && !empty($email) && !empty($password)) {

            //Verificar que el correo no esté registrado

            $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo 'Error: Este correo ya está registrado.';
                header('Location: ../../registro_error.html');
                exit();
            }
            $stmt->close();


            // Verificar que el nombre de usuario no esté registrado

            $stmt = $connection->prepare("SELECT idusers FROM users WHERE name = ?");
            $stmt->bind_param('s', $name);
            $stmt->execute();
            $stmt->store_result();

            // Si el nombre de usuario ya está registrado, se redirige a la página de registro con un mensaje de error.
            if ($stmt->num_rows > 0) {
                echo 'Error: El nombre de usuario ya está registrado.';
                header('Location: ../../registro_nombre_existente.html');
                exit();
            }
            $stmt->close();

            //hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            //Preparar la consulta 
            $stmt = $connection->prepare("INSERT INTO users (name,fecha_born,email, password) VALUES (?, ?, ?, ?)"); // Se prepara la consulta con los datos del usuario.
            $stmt->bind_param('ssss', $name, $fecha_born, $email, $hashedPassword);

            // Si la consulta se ejecuta correctamente, se redirige a la página de inicio de sesión.

            if ($stmt->execute()) {
                $_SESSION['name'] = $name;
                echo 'Register success';
                header('Location: ../../html.html');
                exit();
            } else {
                error_log("Error en el registro: {$stmt->error}");
                echo 'Error en el registro';
            }
            $stmt->close();
            $connection->close();
        } else {
            echo 'Register failed';
            header('Location: ../../loginnoregr.html');
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
