<?php
session_start();
// Conectar a la base de datos (cambia las credenciales según tu configuración)
$conexion = new mysqli("localhost", "usuario_db", "contraseña_db", "nombre_db");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario de inicio de sesión
$nombre_usuario = $_POST["nombre_usuario"];
$contraseña = $_POST["contraseña"];

// Buscar al usuario en la base de datos
$consulta = "SELECT id, nombre_usuario, contraseña FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows == 1) {
    $fila = $resultado->fetch_assoc();
    if (password_verify($contraseña, $fila["contraseña"])) {
        // Inicio de sesión exitoso
        $_SESSION["usuario"] = $nombre_usuario;
        header("Location: panel.php"); // Redirige a una página de panel o dashboard
    } else {
        echo "Contraseña incorrecta.";
    }
} else {
    echo "Nombre de usuario no encontrado.";
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
