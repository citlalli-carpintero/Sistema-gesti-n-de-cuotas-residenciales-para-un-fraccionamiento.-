<?php
session_start();
// Seguridad: Solo admin entra aquí
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nuevo Residente - ITZ</title>
    <link rel="stylesheet" href="css/registroResidente.css">
</head>
<body>

    <div class="main-fullscreen-container">
        <div class="content-wrapper">
            <div class="header">
                <span class="back-btn" onclick="window.location.href='menuAdministrador.php'">←</span>
                <h1>Registrar Residente</h1>
            </div>

            <form id="registroResidenteForm" action="procesarRegistro.php" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nombre(s)</label>
                        <input type="text" name="nombre" placeholder="Ej. Juan Carlos" required>
                    </div>

                    <div class="form-group">
                        <label>Apellido Paterno</label>
                        <input type="text" name="apellidoP" placeholder="Apellido" required>
                    </div>

                    <div class="form-group">
                        <label>Apellido Materno</label>
                        <input type="text" name="apellidoM" placeholder="Apellido" required>
                    </div>

                    <div class="form-group">
                        <label>Número de Teléfono</label>
                        <input type="tel" name="telefono" placeholder="10 dígitos" required>
                    </div>

                    <div class="form-group">
                        <label>Número de Residencia / Casa</label>
                        <input type="text" name="num_residencia" placeholder="Ej. A-12" required>
                    </div>

                    <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" name="correo" placeholder="correo@ejemplo.com" required>
                    </div>
                </div>

                <button type="submit" class="btn-registrar">Dar de Alta Residente</button>
            </form>
        </div>
    </div>
</body>
</html>
