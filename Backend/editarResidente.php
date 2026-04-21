<?php
include 'db.php';
session_start();

if (!isset($_GET['id'])) {
    header("Location: listaRegistrosResidentes.php");
    exit();
}

$id = $_GET['id'];

// Lógica para actualizar cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apPaterno = $_POST['apellidoPaterno'];
    $apMaterno = $_POST['apellidoMaterno'];
    $numRes = $_POST['num_residencia'];
    $tel = $_POST['telefono'];
    $correo = $_POST['correo'];

    $update = "UPDATE Residente SET 
                nombre='$nombre', 
                apellidoPaterno='$apPaterno', 
                apellidoMaterno='$apMaterno', 
                num_residencia='$numRes', 
                telefono='$tel', 
                correo='$correo' 
               WHERE id_residente = $id";

    if (mysqli_query($conexion, $update)) {
        echo "<script>alert('Datos actualizados correctamente'); window.location.href='listaRegistrosResidentes.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conexion);
    }
}

// Consultar datos actuales para llenar el formulario
$query = "SELECT * FROM Residente WHERE id_residente = $id";
$res = mysqli_query($conexion, $query);
$row = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Residente</title>
    <link rel="stylesheet" href="css/listaRegistro.css">
    <style>
        .form-editar { background: white; padding: 25px; border-radius: 12px; max-width: 500px; margin: auto; }
        .input-group { margin-bottom: 15px; }
        .input-group label { display: block; margin-bottom: 5px; font-weight: bold; }
        .input-group input { width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .btn-save { background: #27ae60; color: white; border: none; padding: 12px; width: 100%; border-radius: 5px; cursor: pointer; font-size: 16px; }
        .btn-save:hover { background: #219150; }
    </style>
</head>
<body>
    <div class="main-fullscreen-container">
        <div class="header">
            <span class="back-btn" onclick="window.location.href='listaRegistrosResidentes.php'">← Cancelar</span>
            <h1>Editar Información</h1>
        </div>

        <div class="form-editar">
            <form method="POST">
                <div class="input-group">
                    <label>Nombre(s)</label>
                    <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                </div>
                <div class="input-group">
                    <label>Apellido Paterno</label>
                    <input type="text" name="apellidoPaterno" value="<?php echo $row['apellidoPaterno']; ?>" required>
                </div>
                <div class="input-group">
                    <label>Apellido Materno</label>
                    <input type="text" name="apellidoMaterno" value="<?php echo $row['apellidoMaterno']; ?>" required>
                </div>
                <div class="input-group">
                    <label>N° Residencia</label>
                    <input type="text" name="num_residencia" value="<?php echo $row['num_residencia']; ?>" required>
                </div>
                <div class="input-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" value="<?php echo $row['telefono']; ?>">
                </div>
                <div class="input-group">
                    <label>Correo</label>
                    <input type="email" name="correo" value="<?php echo $row['correo']; ?>" required>
                </div>
                <button type="submit" class="btn-save">Guardar Cambios</button>
            </form>
        </div>
    </div>
</body>
</html>
