<?php
$usuario = "root";
$password = "";
$servidor = "localhost";
$basededatos = "bd_encuesta";

// Crear la conexión
$con = mysqli_connect($servidor, $usuario, $password, $basededatos);

// Verificar la conexión
if (!$con) {
    die("Error al conectar a la Base de Datos: " . mysqli_connect_error());
}

//echo "Conexión exitosa a la Base de Datos";
