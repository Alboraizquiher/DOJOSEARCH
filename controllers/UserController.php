<?php
session_start();

$user = new UserController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($_POST['username'] == '' || $_POST['password'] == '') {
        echo 'Username or password is empty';
        header('Location: ../../login.html');
    } else {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
    }

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

    public function __construct() {}
    public function login()
    {
        // Iniciar sesión para poder guardar los datos del usuario.
        // Devuelve un boolean en caso de que el login sea correcto o no.

        // Que el método reciba los datos del usuario y los compare con los datos de la base de datos.
        // Se utilizan variables fijas para probar el login antes de conectarlo con una base de datos.
        if ($this->username == 'admin' && $this->password == 'admin') {
            // En caso de crear clase User. Añadir un atributo boolean como 'admin' a la clase User.
            $_SESSION['username'] = $this->username;
            $_SESSION['password'] = $this->password;

            //$this->admin = true; --> Por default estará en false siempre. Se cambiará a true si el usuario es admin.
            return true;
        } else if ($this->username == 'user' && $this->password == 'user') {
            $_SESSION['username'] = $this->username;
            $_SESSION['password'] = $this->password;

            return true;
        } else {
            echo 'Login failed';
            header('Location: ../../login.html');
            return false;
        }
    }

    public function register()
    {
        session_start();//inicio de sesión para poder guardar los datos del usuario.
        
        require 'db_connection.php';  // Se utilizan variables fijas para probar el registro antes de conectarlo con una base de datos.
       
        // Que el método reciba los datos del usuario y los guarde en la base de datos.

        $name = trim($_POST['username']);
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
      $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        //Preparar la consulta 
        $stmt = $connection->prepare("INSERT INTO users (name, password) VALUES (?, ?)"); // Se prepara la consulta con los datos del usuario.
        $stmt->bind_param('ss', $this->name, $hashedPassword);

         // Si la consulta se ejecuta correctamente, se redirige a la página de inicio de sesión.
         
        if ($stmt->execute()) {
            $_SESSION['name'] = $name;
            echo 'Register success';
            header('Location: ../../html.html');
            exit();

        } else {
            error_log('Error en el registro: ' . $stmt->error);
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
        // Un session destroy y no hay más misterio.
        session_destroy();
        echo 'Logout success';
        header('Location: ../../html.html');
    }
}
