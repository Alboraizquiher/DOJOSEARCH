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
    private $conn;

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

    }
    public function logout()
    {
        session_destroy();
        header('Location: <!-- página inicio -->');
    }
}
