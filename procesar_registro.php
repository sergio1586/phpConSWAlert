<?php
include 'funciones.php';
include 'cifrador.php';

$clave = "clave_sergio";
$cifrador = new Cipher($clave);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $dni = $_POST['dni'];
    $contraseña = $_POST['contrasena'];
    $color=$_POST['color'];
    $contraseñaEncriptada = $cifrador->encrypt($contraseña);//cifgramos la contraseña

    $usuarios = obtenerUsuarios();//obtenemos todos los usuarios en array

    if (isset($usuarios[$dni])) {//si el dni existe ya registrado, redirigimos a la pagina de registro
        $_SESSION['mensaje_registro'] = "El DNI ya está registrado.";
        header('Location: registro.php');
    } else {
        $usuarios[$dni] = ['nombre' => $nombre, 'contrasena' => $contraseñaEncriptada,'color'=>$color];//guardamos con la clave de dni el usuario
        $usuario = $usuarios[$dni];//creamos el usuario
        añadirUsuario($usuario, $dni);
        guardarUsuarios($usuarios);
        $_SESSION['mensaje_registro'] = "Registro exitoso. Ahora puedes iniciar sesión.";//mandamos el mensaje al index para el sweet alert
        header('Location: index.php');
        exit;
    }
} else {
    $_SESSION['mensaje_registro'] = "Acceso no autorizado";
    header('Location: index.php');
    exit;
}
?>
