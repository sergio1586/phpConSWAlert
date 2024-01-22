<?php
include 'funciones.php';

if (isset($_GET['dni'])) {
    $dni = $_GET['dni']; // Capturamos el DNI de la URL
    $usuarios = obtenerUsuarios();
    if (isset($usuarios[$dni])) {//si existe, llamamos a la funcion eliminar
        eliminarUsuario($dni);
        ?>

        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Eliminación de Cuenta</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        </head>
        <body class="container mt-5">
            <div class="alert alert-success" role="alert">
                Usuario eliminado exitosamente.
            </div>
            <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </body>
        </html>

        <?php
    } else {
        echo "Usuario no encontrado";
    }
} else {
    echo "Acceso no autorizado";
}
?>
