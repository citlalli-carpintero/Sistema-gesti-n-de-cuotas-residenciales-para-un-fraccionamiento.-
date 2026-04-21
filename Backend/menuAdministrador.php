<?php
session_start();
// Si no hay sesión o el rol no es admin, regresa al login
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
    <title>Panel de Administración - ITZ</title>
    <link rel="stylesheet" href="css/menu.css">
    <style>
        :root { --accent-color: #2c3e50; }
        .dashboard-header { border-bottom: 4px solid var(--accent-color); }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <header class="dashboard-header">
            <div>
                <h1>Panel Administrativo</h1>
                <p>Bienvenida, <?php echo $_SESSION['username']; ?></p>
            </div>
            <button class="btn-logout" onclick="window.location.href='logout.php'">Salir del Sistema</button>
        </header>

        <div class="menu-grid">
            <div class="menu-card" onclick="window.location.href='registrarResidente.php'">
                <div class="icon">👤➕</div>
                <h3>Registrar Residente</h3>
                <p>Dar de alta a un nuevo habitante en el sistema.</p>
            </div>
            
            <div class="menu-card" onclick="window.location.href='listaPagados.php'">
                <div class="icon">✅</div>
                <h3>Residentes al Corriente</h3>
                <p>Ver lista de quienes ya pagaron sus servicios.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='listaDeudores.php'">
                <div class="icon">⚠️</div>
                <h3>Residentes con Adeudo</h3>
                <p>Ver lista de pagos pendientes o retrasados.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='autorizarAcceso.php'">
                <div class="icon">🔑</div>
                <h3>Autorizar Accesos</h3>
                <p>Dar acceso a residentes que solicitaron áreas comunes.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='validarComprobantes.php'">
                <div class="icon">📂</div>
                <h3>Validar pagos</h3>
                <p>Validar los pagos enviados por los residentes.</p>
            </div>

            <div class="menu-card" onclick="window.location.href='listaRegistrosResidentes.php'">
                <div class="icon">📇</div>
                <h3>Directorio de Residentes</h3>
                <p>Ver todos los residentes registrados y su fecha de alta.</p>
            </div>
        </div>
    </div>
</body>
</html>
