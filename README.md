# crud-php-mysqli


Aplicativo web que implementa un CRUD (Create, Read, Update, Delete) para la gestión de usuarios, desarrollado con PHP y MySQLi.

## Logro de aprendizaje
Administrar la información de una base de datos a través de un aplicativo web generado con PHP, implementando un CRUD.

## Tecnologías utilizadas
- PHP 8.x
- MySQL / MariaDB
- MySQLi
- HTML5
- CSS3
- JavaScript (Fetch / AJAX)
- XAMPP

## Requisitos
- XAMPP instalado
- Apache y MySQL activos
## Instalación y configuración
1. Clonar o descargar el repositorio dentro de:
C:\xampp\htdocs\crud
2. Importar la base de datos:
- Abrir phpMyAdmin
- Importar el archivo `database.sql`
- Se creará automáticamente la base de datos `proyecto_final`

3. Configuración por defecto de la conexión:
- Host: `localhost`
- Usuario: `root`
- Contraseña: (vacía)

## Ejecución
Abrir en el navegador:
http://localhost/crud

## Funcionalidades
- Registrar usuarios
- Listar usuarios
- Editar usuarios
- Eliminar usuarios
- Búsqueda dinámica sin recargar la página

## Observaciones
El proyecto utiliza consultas preparadas mediante MySQLi para garantizar una correcta gestión de la información y mayor seguridad en el acceso a la base de datos.
