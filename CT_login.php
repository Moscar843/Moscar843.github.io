<?php
session_start();

// Datos de conexión
$servidor = 'localhost';
$usuario = 'root';
$contrasena_db = '';
$baseDeDatos = 'registro';

$conexion = mysqli_connect($servidor, $usuario, $contrasena_db, $baseDeDatos);

// Verificar conexión
if (!$conexion) {
    die("❌ Error de conexión: " . mysqli_connect_error());
}

// Si se envió el formulario
if (isset($_POST['iniciar'])) {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $contrasena = mysqli_real_escape_string($conexion, $_POST['contrasena']);

    // Buscar usuario con ese correo
    $consulta = "SELECT * FROM datos WHERE correo = '$correo'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);

        // Si estás usando password_hash en el registro, usa password_verify aquí:
        // if (password_verify($contrasena, $usuario['contrasena'])) {
        if ($usuario['contrasena'] === $contrasena) {
            $_SESSION['usuario'] = $usuario['nombre']; // Guardas el nombre del usuario
            header("Location: ConsultaTE.html"); // Página protegida o principal
            exit();
        } else {
            echo "<h1>❌ Contraseña incorrecta.</h1>";
        }
    } else {
        echo "❌ Usuario no encontrado con ese correo.";
    }

    mysqli_close($conexion);
}

?>