<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="columna izquierda"></div>

        <div class="columna derecha">
            <div>
                <div class="subcolumna">
                    <div class="izquierda-subcolumna">
                        <img src="http://localhost/servicedesk/VISTA/img/insigniasb.png" alt="Imagen de insignia">
                    </div>
                    <!-- Subcolumna para el texto -->
                    <div class="derecha-subcolumna" style="color: #969493;">
                        <p>Institución Educativa Pública JEC Simón Bolívar</p>
                    </div>
                </div>
            </div>
            <div>
                <br><br><br>
                <h2>¡Bienvenido de vuelta!</h2><br>
            </div>

            <div class="form-container">
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <label for="username">Usuario:</label>
                    </div>
                    <div>
                        <input type="text" id="username" name="username" required autocomplete="off" placeholder="Ingrese su usuario">
                    </div>

                    <div class="form-group" style="margin-top: 10px;">
                        <label for="password">Contraseña:</label>
                    </div>
                    <div>
                        <input type="password" id="password" name="password" required autocomplete="off" placeholder="Ingrese su contraseña">
                    </div>

                    <div class="switch" style="margin-top: 10px; display: flex; align-items: center;">
                        <input type="checkbox" id="check">
                        <label for="check" style="margin-left: 5px;"></label>
                        <span class="texto-hola">¿Recordar contraseña?</span>
                        <a href="#" class="forgot-password" style="margin-left: 50px;">Olvidé mi contraseña</a>
                    </div>

                    <div class="button-container" style="margin-top: 30px;">
                        <button type="submit" name="login" style="width: 100%;">Iniciar Sesión</button>
                    </div>
                    <?php
                    include('../MODELO/conexion.php');

                    // Inicializamos la variable para controlar el mensaje de error
                    $error_message = '';

                    // Lógica para validar el login usando PHP
                    if (isset($_POST['login'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];

                        // Consulta para verificar las credenciales en la base de datos
                        $sql = "SELECT * FROM tb_usuario WHERE usuario = ? AND contraseña = ?";
                        $stmt = $conexion->prepare($sql);
                        $stmt->bind_param("ss", $username, $password);
                        $stmt->execute();
                        $resultado = $stmt->get_result();

                        // Si se encuentra un resultado, redirecciona a principal.php
                        if ($resultado->num_rows > 0) {
                            session_start(); // Iniciar sesión
                            $_SESSION['usuario'] = $username; // Guardar usuario en sesión
                            header("Location: principal.php"); //direccionar a principal.php
                            exit(); // Terminar el script después de la redirección
                        } else {
                            echo "<p style='text-align: center; font-style: italic; color: blue; font-size: 12px;'>Usuario o contraseña incorrectos.</p>";
                        }

                        // Cerrar recursos
                        $stmt->close();
                        $conexion->close();
                    }

                    /* Mostrar el mensaje de error solo si existe
                if ($error_message != '') {
                    echo "<p>$error_message</p>";
                }*/
                    ?>
                </form>
            </div>

            <div style="text-align: center;">
                <p class="texto-hola" style="margin-top: 30px;">¿No tienes una cuenta?</p>
                <span class="texto-hola" style="color: #007bff;">Conversa con un técnico</span>
            </div>

            <div style="text-align: right; margin-top:70px">
                <p class="texto-hola">Universidad Nacional de Cañete</p>
            </div>
            <?php
            // Mostrar mensaje de error si hay
            if (isset($error_message) && $error_message != '') {
                echo "<p>$error_message</p>";
            }
            ?>
        </div>


    </div>
</body>

</html>