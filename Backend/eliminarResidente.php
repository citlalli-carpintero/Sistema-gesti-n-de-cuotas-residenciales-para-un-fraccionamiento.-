<?php
include 'db.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminamos de la tabla Residente
    $query = "DELETE FROM Residente WHERE id_residente = $id";

    if (mysqli_query($conexion, $query)) {
        echo "<script>
                alert('Residente eliminado correctamente');
                window.location.href='listaRegistrosResidentes.php';
              </script>";
    } else {
        echo "Error al eliminar: " . mysqli_error($conexion);
    }
}
?>
