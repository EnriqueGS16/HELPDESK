<?php
include('../MODELO/conexion.php');
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener el nombre de usuario desde la sesión
$usuario = $_SESSION['usuario'];

// Consulta para obtener el `id_usuario` desde la tabla `tb_usuario`
$sqlUsuario = "SELECT id_usuario FROM tb_usuario WHERE usuario = ?";
$stmtUsuario = $conexion->prepare($sqlUsuario);
$stmtUsuario->bind_param("s", $usuario);
$stmtUsuario->execute();
$resultadoUsuario = $stmtUsuario->get_result();

if ($resultadoUsuario->num_rows > 0) {
    // Obtener el `id_usuario` correspondiente
    $filaUsuario = $resultadoUsuario->fetch_assoc();
    $id_usuario = $filaUsuario['id_usuario'];

    // Consulta para obtener `tecn_resp` y `tecn_espec` de la tabla `tb_tecnico`
    $sqlTecnico = "SELECT tecn_resp, tecn_espec FROM tb_tecnico WHERE id_usuario = ?";
    $stmtTecnico = $conexion->prepare($sqlTecnico);
    $stmtTecnico->bind_param("i", $id_usuario);
    $stmtTecnico->execute();
    $resultadoTecnico = $stmtTecnico->get_result();

    if ($resultadoTecnico->num_rows > 0) {
        // Obtener los valores de `tecn_resp` y `tecn_espec`
        $filaTecnico = $resultadoTecnico->fetch_assoc();
        $tecn_resp = $filaTecnico['tecn_resp'];
        $tecn_espec = $filaTecnico['tecn_espec'];
    } else {
        $_SESSION['usuario'] = "Responsable no encontrado";
    }
} else {
    $_SESSION['usuario'] = "Usuario no encontrado";
}

// Cerrar los statement
$stmtUsuario->close();
$stmtTecnico->close();
$conexion->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página principal</title>
    <link rel="stylesheet" href="styles1.css">
</head>

<body>
    <div class="barra-lateral">
        <div class="nombre-pagina">
            <ion-icon id="foto" name="person-circle-outline"></ion-icon>
            <div>
                <span><?php echo $tecn_resp; ?></span>
                <br>
                <span><?php echo $tecn_espec; ?></span>
            </div>
        </div>

        <button class="boton">
            <ion-icon name="ticket-outline"></ion-icon>
            <span>Nuevo Ticket</span>
        </button>
        <nav class="navegacion">
            <ul>
                <li>
                    <a href=""></a>
                    <ion-icon name="bar-chart-outline"></ion-icon>
                    <span>Dashboard</span>
                </li>
                <li>
                    <a href=""></a>
                    <ion-icon name="business-outline"></ion-icon>
                    <span>Departamentos</span>
                </li>
                <li>
                    <a href=""></a>
                    <ion-icon name="person-outline"></ion-icon>
                    <span>Trabajadores</span>
                </li>
                <li>
                    <a href=""></a>
                    <ion-icon name="calendar-outline"></ion-icon>
                    <span>Calendario</span>
                </li>
                <li>
                    <a href=""></a>
                    <ion-icon name="clipboard-outline"></ion-icon>
                    <span>Reportes</span>
                </li>
                <li>
                    <a href=""></a>
                    <ion-icon name="mail-unread-outline"></ion-icon>
                    <span>Mensajes</span>
                </li>
                <li style="margin-top: 80px">
                    <a href=""></a>
                    <ion-icon name="settings-outline"></ion-icon>
                </li>
            </ul>
        </nav>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Verificación en JS -->
    <script defer src="../CONTROLADOR/script.js"></script>
    </script>
</body>

</html>