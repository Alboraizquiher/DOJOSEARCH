<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "dojosearch";
$port = 3306;
$connection = new mysqli($server, $user, $password, $database, $port);

if ($connection->connect_error) {
  die("No funciona na " . $connection->connect_error);
} else {
  echo "Conectado exitosamente";
}
