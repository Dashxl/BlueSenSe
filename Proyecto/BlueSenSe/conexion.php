<?php
// Conexion a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bluesense";

// Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexion
if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}

