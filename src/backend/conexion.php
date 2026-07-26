<?php
/**
 * Conexion a la base de datos - Tienda E-commerce
 * Configuracion para entorno local XAMPP
 */

$host = 'localhost';
$dbName = 'control_comercio_electronico';
$usuario = 'root';
$password = '';

try {
    $conexion = new PDO(
        "mysql:host={$host};dbname={$dbName};charset=utf8mb4",
        $usuario,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Error de conexion: ' . $e->getMessage());
}