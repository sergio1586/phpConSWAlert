<?php
include 'funciones.php';

if (isset($_GET['dni'])) {
    $dni = $_GET['dni'];
    $usuarios = obtenerUsuarios();
    if (isset($usuarios[$dni])) {//si el usuario existe entramos aqui
        $usuario = $usuarios[$dni];
        $nombre = $usuario['nombre'];
        $color=$usuario['color'];//extrahemos el codigo hexadecimal del color
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Página Protegida</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        </head>
        <body class="container mt-5" style="background-color: <?php echo $color; ?>"><!-- Añadimos el color de fondo de la sesion al body -->
            <h1 class="text-center">Bienvenido, <?php echo $nombre; ?>. Esta página está protegida.</h1>
            <br>
            <!--script para mostrar una alerta de confirmación antes de eliminar la cuenta -->
            <script type="text/javascript">
                function confirmarEliminarCuenta() {
                    Swal.fire({//desclogamos el sweet alert
                        title: '¿Estás seguro?',
                        text: 'Una vez eliminada, no podrás recuperar tu cuenta.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar cuenta'
                    }).then((decision) => {//valoramos el resultado de la decision
                        if (decision.isConfirmed) {// Redirige al script que elimina la cuenta si se confirma
                            window.location.href = 'eliminar_cuenta.php?dni=<?php echo $dni; ?>';
                        }
                    });
                }
            </script>
            <button class="btn btn-danger" onclick="confirmarEliminarCuenta()">Eliminar Cuenta</button><!--botón para evento de eliminar cuenta-->
        </body>
        </html>

        <?php
    } else {
        echo "Usuario no encontrado";
    }
} else {//por si quieren entrar con acceso no autorizado, cargamos esta pagina
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error de Acceso</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script type="text/javascript">
                document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Acceso no autorizado',
                    icon: 'error',
                    confirmButtonText: 'OK',
                    target: document.body,
                    didClose: () => {//cuando cierre la ventana, llevara al index
                        window.location.href='index.php'; 
                    }
                });
            });
        </script>
    </head>
    <body class="container mt-5">
    </body>
    </html>
    <?php
}
?>
