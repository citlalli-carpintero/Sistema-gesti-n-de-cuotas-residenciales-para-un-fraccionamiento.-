<?php
session_start();
// Si no hay sesión o el rol no es residente, regresa al login
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'residente') {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Residente - ITZ</title>
    <link rel="stylesheet" href="css/menu.css">
</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <div>
                <h1>Bienvenido</h1>
                <p>Usuario: <?php echo $_SESSION['username']; ?></p>
            </div>
            <button class="btn-logout" onclick="window.location.href='logout.php'">Cerrar Sesión</button>
        </header>

        <div class="menu-grid">
            <div class="menu-card" onclick="window.location.href='registroPago.php'">
                <div class="icon">💰</div>
                <h3>Registrar Pago</h3>
                <p>Sube tu comprobante de mantenimiento o servicios.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='misPagos.php'">
                <div class="icon">📋</div>
                <h3>Mis Registros</h3>
                <p>Consulta el historial de tus pagos realizados.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='solicitarArea.php'">
                <div class="icon">🏘️</div>
                <h3>Acceso a Áreas Comunes</h3>
                <p>Solicita el uso de alberca, canchas o salón.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='misSolicitudes.php'">
                <div class="icon">⏳</div>
                <h3>Estatus de Áreas</h3>
                <p>Revisa si tus solicitudes fueron aprobadas o rechazadas.</p>
            </div>
        </div>
    </div>
</body>
</html> 
