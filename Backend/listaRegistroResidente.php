<?php
include 'db.php';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Directorio de Residentes</title>
    <link rel="stylesheet" href="css/listaRegistro.css">
    <style>
        /* Estilo rápido para el botón de eliminar */
        .btn-danger {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn-danger:hover { background-color: #c0392b; }
    </style>
</head>
<body>
    <div class="main-fullscreen-container">
        <div class="content-wrapper-xl">
            <div class="header">
                <span class="back-btn" onclick="window.location.href='menuAdministrador.php'">←</span>
                <h1>Directorio de Residentes</h1>
            </div>

            <div class="cards-container">
                <?php
                $query = "SELECT r.*, a.nombre AS admin_n FROM Residente r
                          LEFT JOIN Administrador a ON r.id_admin_registro = a.id_admin";
                $res = mysqli_query($conexion, $query);

                while($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id_residente']; // Guardamos el ID para usarlo en los botones
                ?>
                <div class="resident-card">
                    <div class="card-info">
                        <div class="user-header">
                            <span class="user-avatar-icon">👤</span>
                            <div>
                                <label>Residente:</label>
                                <span class="resident-name"><?php echo $row['nombre'] . " " . $row['apellidoPaterno']; ?></span>
                            </div>
                        </div>
                        <div class="card-grid">
                            <div class="info-item">
                                <label>N° Residencia:</label>
                                <span class="tag tag-blue"><?php echo $row['num_residencia']; ?></span>
                            </div>
                            <div class="info-item">
                                <label>Fecha Registro:</label>
                                <span class="data-text"><?php echo date('d/m/Y', strtotime($row['fecha_registro'])); ?></span>
                            </div>
                            <div class="info-item">
                                <label>Registrado por:</label>
                                <span class="data-text admin-name"><?php echo $row['admin_n']; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-actions">
                        <button class="btn-primary" onclick="window.location.href='detallesResidente.php?id=<?php echo $id; ?>'">Ver Detalles</button>
                        
                        <button class="btn-secondary" onclick="window.location.href='editarResidente.php?id=<?php echo $id; ?>'">Editar</button>
                        
                        <button class="btn-danger" onclick="confirmarEliminar(<?php echo $id; ?>, '<?php echo $row['nombre']; ?>')">Eliminar</button>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
    function confirmarEliminar(id, nombre) {
        if (confirm("¿Estás seguro de que deseas eliminar al residente " + nombre + "? Esta acción no se puede deshacer.")) {
            window.location.href = "eliminarResidente.php?id=" + id;
        }
    }
    </script>
</body>
</html>
