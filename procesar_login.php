<?php
include 'funciones.php';
include 'cifrador.php';

$clave = "clave_sergio";
$cifrador = new Cipher($clave);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dni = $_POST['dni'];//extraemos dni y contraseña
    $contrasena = $_POST['contrasena'];

    $usuarios = obtenerUsuarios();//obtenemos todo el array de usuarios

    if (!isset($usuarios[$dni])) {//si no existe entra aqui
        $_SESSION['mensaje_error'] = "DNI incorrecto. Por favor, verifica tu DNI.";
        header('Location: index.php');
    } else {//si existe el dni
        $usuario = $usuarios[$dni];
        $contrasenaDescifrada = $cifrador->decrypt($usuario['contrasena']);//desciframos  la contraseña con la clave

        if (isset($usuarios[$dni]) && $contrasenaDescifrada == $contrasena) {//vemos si el usuario esta en el array y si la contraseña descifrada coincide con la que mete el usuario
            header('Location: pagina_protegida.php?dni=' . $dni);//de ser afirmativo, lo llevamos a pagina protegida
            exit;
        } else {//si no es asi, mandamos al index, con un mensaje de contraseña incorrecta en la sesion
            $_SESSION['mensaje_error'] = "Contraseña incorrecta.";
            header('Location: index.php');
        }
    }
} else {//si quieren entrar sin autorarizacion
    $_SESSION['mensaje_error'] = "Acceso no permitido";
    header('Location: index.php');
    exit;
}
?>
