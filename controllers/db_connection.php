<?php

  $server = "10.118.2.73";
  $user = "Admin";
<<<<<<< HEAD
$password = "admin < bm,bv.¬kjlm n5";
=======
$password = "admin";
>>>>>>> dd70019a02fc74086957fc34c2d04faf08e246d1
$database = "auth_db";
$port = "3306";

$connection = new mysqli($server, $user, $password, $database,$port);

if ($connection->connect_error) {
    die("No funciona na " . $connection->connect_error);
}else{
    echo "Conectado exitosamente";
}
?>