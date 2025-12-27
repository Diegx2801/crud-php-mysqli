<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$cn = new mysqli("localhost", "root", "", "proyecto_final");
if ($cn->connect_error) die("Error de conexión: " . $cn->connect_error);
$cn->set_charset("utf8mb4");

$id = intval($_GET["id"] ?? 0);
if ($id <= 0) die("ID inválido.");

// Si viene POST → actualizar (UPDATE)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = trim($_POST["nombre"] ?? "");
  $email  = trim($_POST["email"] ?? "");

  $stmt = $cn->prepare("UPDATE usuarios SET nombre=?, email=? WHERE id=?");
  $stmt->bind_param("ssi", $nombre, $email, $id);
  $stmt->execute();
  $stmt->close();

  header("Location: index.php");
  exit;
}

// Si viene GET → traer datos del usuario (READ 1)
$stmt = $cn->prepare("SELECT id, nombre, email FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$usuario = $res->fetch_assoc();
$stmt->close();

if (!$usuario) die("Usuario no encontrado.");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Editar Usuario</h1>

  <form method="POST">
    <input type="text" name="nombre" value="<?= htmlspecialchars($usuario["nombre"]) ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario["email"]) ?>" required>
    <button type="submit">Guardar Cambios</button>
  </form>

  <a href="index.php">⬅ Volver</a>
</body>
</html>
