<?php
// Mostrar errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión mysqli
$cn = new mysqli("localhost", "root", "", "proyecto_final");
if ($cn->connect_error) {
  die("Error de conexión: " . $cn->connect_error);
}
$cn->set_charset("utf8mb4");

// CREATE
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = trim($_POST["nombre"] ?? "");
  $email  = trim($_POST["email"] ?? "");

  $stmt = $cn->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
  $stmt->bind_param("ss", $nombre, $email);
  $stmt->execute();
  $stmt->close();
}

// READ
$res = $cn->query("SELECT * FROM usuarios ORDER BY id DESC");
$usuarios = $res->fetch_all(MYSQLI_ASSOC);

// Cargar vista
require "index.view.php";
