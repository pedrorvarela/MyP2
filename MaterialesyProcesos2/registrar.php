<?php
// Conectar a la base de datos (cambia las credenciales según tu configuración)
$conexion = new mysqli(
    "localhost", 
    "root", 
    "", 
    "myp2");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Recibir datos del formulario de registro
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);
$email = $_POST["email"];
$deporte_favorito = $_POST["deporte_favorito"];


// Insertar datos en la base de datos
$insertar = "INSERT INTO usuarios (nombre, apellido, email, password, deporte_favorito) VALUES ('$nombre', '$apellido', '$password', '$email', '$deporte_favorito')";
if ($conexion->query($insertar) === TRUE) {
    echo "Registro exitoso.";
} else {
    echo "Error: " . $insertar . "<br>" . $conexion->error;
}

// Cerrar la conexión a la base de datos
$conexion->close();
?>
