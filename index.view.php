<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Gestión de Usuarios</h1>

<form id="formCreate">
  <input type="text" name="nombre" placeholder="Nombre" required>
  <input type="email" name="email" placeholder="Correo electrónico" required>
  <button type="submit">Agregar Usuario</button>
</form>

<input id="search" type="text" placeholder="Buscar por nombre o correo..." />

<h2>Lista de Usuarios</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>Correo</th>
    <th>Acciones</th>
  </tr>
  <tbody id="tbody"></tbody>
</table>

<dialog id="dlg">
  <form id="formEdit" method="dialog">
    <input type="hidden" name="id">
    <input type="text" name="nombre" required>
    <input type="email" name="email" required>
    <button type="submit">Guardar</button>
  </form>
</dialog>

<script src="app.js"></script>
</body>
</html>
