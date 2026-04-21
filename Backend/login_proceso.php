<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $user = mysqli_real_escape_string($conexion, $_POST['username']);
    $pass = mysqli_real_escape_string($conexion, $_POST['password']);

   
    $query = "SELECT * FROM usuario WHERE username = '$user' AND password = '$pass'";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) > 0) {
        $datos = mysqli_fetch_assoc($resultado);
        
        // Guardamos los datos básicos en la sesión
        $_SESSION['id_usuario'] = $datos['id_usuario'];
        $_SESSION['rol'] = $datos['rol'];
        $_SESSION['username'] = $datos['username'];

        // Si es residente, guardamos su id_residente para poder registrar sus pagos después
        if ($datos['rol'] == 'residente') {
            $_SESSION['id_residente'] = $datos['id_residente'];
            header("Location: menuResidente.php");
        } else {
            // Si es admin, guardamos su id_admin si lo necesitas
            $_SESSION['id_admin'] = $datos['id_admin'];
            header("Location: menuAdministrador.php");
        }
        exit(); // Siempre usar exit después de un header Location
        
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos'); window.history.back();</script>";
    }
}
?>
