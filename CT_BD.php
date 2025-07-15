<?php
// Conexión a la base de datos
$servidor = 'localhost';
$usuario = 'root';
$contrasena_db = '';
$baseDeDatos = 'registro';

$enlace = mysqli_connect($servidor, $usuario, $contrasena_db, $baseDeDatos);

if (!$enlace) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}

// Verificar si se envió el formulario
if (isset($_POST['enviar'])) {
    // Obtener datos del formulario
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $correo = mysqli_real_escape_string($enlace, $_POST['correo']);
    $contrasena_usuario = mysqli_real_escape_string($enlace, $_POST['contrasena']);

    // Consulta SQL
    $insertar = "INSERT INTO datos (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena_usuario')";

    if (mysqli_query($enlace, $insertar)) {
        echo "<h2>✅ Registro exitoso. ¡Bienvenido, $nombre!</h2>";
    } else {
        echo "❌ Error al insertar datos: " . mysqli_error($enlace);
    }

    mysqli_close($enlace);
}
?>

