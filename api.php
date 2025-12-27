<?php
header("Content-Type: application/json; charset=utf-8");

$cn = new mysqli("localhost", "root", "", "proyecto_final");
if ($cn->connect_error) {
  http_response_code(500);
  echo json_encode(["ok" => false, "msg" => "Error conexión BD"]);
  exit;
}
$cn->set_charset("utf8mb4");

$action = $_GET["action"] ?? "";

if ($action === "read") {
  $q = trim($_GET["q"] ?? "");

  if ($q !== "") {
    $like = "%$q%";
    $stmt = $cn->prepare("SELECT id,nombre,email FROM usuarios WHERE nombre LIKE ? OR email LIKE ? ORDER BY id DESC");
    $stmt->bind_param("ss", $like, $like);
  } else {
    $stmt = $cn->prepare("SELECT id,nombre,email FROM usuarios ORDER BY id DESC");
  }

  $stmt->execute();
  $res = $stmt->get_result();
  $data = $res->fetch_all(MYSQLI_ASSOC);
  $stmt->close();

  echo json_encode(["ok" => true, "data" => $data]);
  exit;
}

if ($action === "create" && $_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = trim($_POST["nombre"] ?? "");
  $email  = trim($_POST["email"] ?? "");

  $stmt = $cn->prepare("INSERT INTO usuarios (nombre, email) VALUES (?, ?)");
  $stmt->bind_param("ss", $nombre, $email);
  $stmt->execute();
  $stmt->close();

  echo json_encode(["ok" => true]);
  exit;
}

if ($action === "update" && $_SERVER["REQUEST_METHOD"] === "POST") {
  $id     = intval($_POST["id"] ?? 0);
  $nombre = trim($_POST["nombre"] ?? "");
  $email  = trim($_POST["email"] ?? "");

  $stmt = $cn->prepare("UPDATE usuarios SET nombre=?, email=? WHERE id=?");
  $stmt->bind_param("ssi", $nombre, $email, $id);
  $stmt->execute();
  $stmt->close();

  echo json_encode(["ok" => true]);
  exit;
}

if ($action === "delete" && $_SERVER["REQUEST_METHOD"] === "POST") {
  $id = intval($_POST["id"] ?? 0);

  $stmt = $cn->prepare("DELETE FROM usuarios WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $stmt->close();

  echo json_encode(["ok" => true]);
  exit;
}

http_response_code(404);
echo json_encode(["ok" => false, "msg" => "Acción no encontrada"]);
