<?php
// Datos de conexión
$host = "localhost"; // Puede ser "127.0.0.1" o "localhost"
$usuario = "root"; // Cambia esto por tu usuario de MySQL (por defecto es "root")
$contraseña = ""; // Cambia esto por tu contraseña de MySQL (si no tienes, déjalo vacío)
$base_datos = "db_helpdesk";

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

// Verificar si la conexión es exitosa
/*
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos '$base_datos'";
}*/
