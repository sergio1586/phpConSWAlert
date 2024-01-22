<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="container mt-5">
    <h1 class="text-center">Iniciar Sesión</h1>
    <?php
    if (isset($_SESSION['mensaje_error'])) {//vemos si en la sesion existe una variable que sea mensaje_error
        echo '<script type="text/javascript">';
        echo '    Swal.fire("Error", "' . $_SESSION['mensaje_error'] . '", "error");';//si es asi mostramos un sweet alert
        echo '</script>';
        unset($_SESSION['mensaje_error']); //eliminamos el mensaje de la sesion, para que no vuelva a salir constantemente
    }else if(isset($_SESSION['mensaje_registro'])){//miramos si existe en la sesion un mensaje de registro
        if($_SESSION['mensaje_registro']=='Acceso no autorizado'){//si el mensaje es de acceso no autorizado
            echo '<script type="text/javascript">';
            echo '    Swal.fire("Acceso no autorizado", "' . $_SESSION['mensaje_registro'] . '", "error");';//si es asi mostramos un sweet alert
            echo '</script>';
            unset($_SESSION['mensaje_registro']);
        }else{//si el mensaje de registro el bueno
            echo '<script type="text/javascript">';
            echo '    Swal.fire("Buen trabajo", ' . json_encode($_SESSION['mensaje_registro']) . ', "success");';//mostramos el sweet alert
            echo '</script>';
            unset($_SESSION['mensaje_registro']);//lo eliminamos para que no salga constantemente
        }
        
    }
    ?>
    <form class="mb-3" action="procesar_login.php" method="post">
        <div class="mb-3">
            <label for="dni" class="form-label">DNI:</label>
            <input type="text" class="form-control" id="dni" name="dni" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
    </form>
    <a href="registro.php" class="btn btn-primary">Registrarse</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
