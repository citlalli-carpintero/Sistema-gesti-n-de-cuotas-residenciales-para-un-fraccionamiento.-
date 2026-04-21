<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $ap_paterno = $_POST['apellidoP']; // En tu HTML es 'apellidoP'
    $ap_materno = $_POST['apellidoM']; // En tu HTML es 'apellidoM'
    $tel = $_POST['telefono'];
    $residencia = $_POST['num_residencia']; 
    $correo = $_POST['correo'];
    
    $id_admin = isset($_SESSION['id_admin']) ? $_SESSION['id_admin'] : 1;

    $sql_residente = "INSERT INTO residente (nombre, apellidoPaterno, apellidoMaterno, num_residencia, telefono, correo, id_admin_registro) 
                      VALUES ('$nombre', '$ap_paterno', '$ap_materno', '$residencia', '$tel', '$correo', $id_admin)";

    if (mysqli_query($conexion, $sql_residente)) {
        $id_nuevo = mysqli_insert_id($conexion);

        $sql_usuario = "INSERT INTO usuario (username, password, rol, id_residente) 
                        VALUES ('$correo', '1234', 'residente', $id_nuevo)";
        
        mysqli_query($conexion, $sql_usuario);
        echo "<script>alert('Registro exitoso'); window.location.href='listaRegistrosResidentes.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}
?>
