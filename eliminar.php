<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$cn = new mysqli("localhost", "root", "", "proyecto_final");
if ($cn->connect_error) die("Error de conexión: " . $cn->connect_error);

$id = intval($_GET["id"] ?? 0);
if ($id <= 0) die("ID inválido.");

$stmt = $cn->prepare("DELETE FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
exit;
