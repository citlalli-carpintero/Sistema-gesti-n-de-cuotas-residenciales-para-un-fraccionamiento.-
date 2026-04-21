<?php
include 'db.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: listaRegistrosResidentes.php");
    exit();
}

$id = $_GET['id'];
// Buscamos los datos completos del residente
$query = "SELECT r.*, a.nombre AS admin_n FROM Residente r 
          LEFT JOIN Administrador a ON r.id_admin_registro = a.id_admin 
          WHERE r.id_residente = $id";
$res = mysqli_query($conexion, $query);
$residente = mysqli_fetch_assoc($res);

if (!$residente) {
    die("Residente no encontrado.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalles del Residente</title>
    <link rel="stylesheet" href="css/listaRegistro.css"> <style>
        .detalle-container { background: white; padding: 30px; border-radius: 15px; max-width: 600px; margin: 20px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .info-row { margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 5px; }
        .info-row label { font-weight: bold; color: #2c3e50; display: block; font-size: 0.9em; }
        .info-row span { font-size: 1.1em; color: #555; }
    </style>
</head>
<body>
    <div class="main-fullscreen-container">
        <div class="header">
            <span class="back-btn" onclick="window.location.href='listaRegistrosResidentes.php'">← Volver</span>
            <h1>Expediente del Residente</h1>
        </div>

        <div class="detalle-container">
            <div class="info-row">
                <label>Nombre Completo</label>
                <span><?php echo $residente['nombre'] . " " . $residente['apellidoPaterno'] . " " . $residente['apellidoMaterno']; ?></span>
            </div>
            <div class="info-row">
                <label>Número de Residencia</label>
                <span class="tag tag-blue"><?php echo $residente['num_residencia']; ?></span>
            </div>
            <div class="info-row">
                <label>Correo Electrónico</label>
                <span><?php echo $residente['correo']; ?></span>
            </div>
            <div class="info-row">
                <label>Teléfono</label>
                <span><?php echo $residente['telefono']; ?></span>
            </div>
            <div class="info-row">
                <label>Fecha de Alta</label>
                <span><?php echo date('d/m/Y H:i', strtotime($residente['fecha_registro'])); ?></span>
            </div>
            <div class="info-row">
                <label>Registrado por</label>
                <span><?php echo $residente['admin_n']; ?></span>
            </div>
        </div>
    </div>
</body>
</html>
