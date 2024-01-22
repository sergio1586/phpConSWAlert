<?php

function obtenerUsuarios() {
    $usuarios = [];
    $archivo = 'usuarios.txt';
    if (file_exists($archivo)) {//si el archivo existe, lo abre en modo escritura
        $contenidoArchivo = fopen($archivo, 'r+');
        if ($contenidoArchivo) {//comprovamos si el archivo  ha sido abierto
            $tamañoArchivo = filesize($archivo);//obtenemos el tamaño del fichero, para quie no falle si el tamaño es 0
            if ($tamañoArchivo > 0) {//Si el tamaño es mayor a 0 entra aqui
                $contenido = fread($contenidoArchivo, $tamañoArchivo);//sacamos el contenido hasta el tamaño del archivo
                fclose($contenidoArchivo);
                $usuarios = unserialize($contenido);
                if ($usuarios !== false) {//miramos si el array de usuario tiene algo y lo devolvemos
                    return $usuarios;
                } else {//si algo falla, devolvemos un array vacio
                    return [];
                }
            } else {//si no tiene nada cierra el archivo y devuelve un array vacio
                fclose($contenidoArchivo);
                return [];
            }
        }
    }

    return $usuarios;
}
//Funcion para guardar los usuarios
function guardarUsuarios($usuarios) {
    $archivo = 'usuarios.txt';
    $contenido = fopen($archivo, 'w');//obtenemos el contenido en modo escritura
    if ($contenido) {
        fwrite($contenido, serialize($usuarios));//metemos el array de usuarios modificado
        fclose($contenido);
    }
}
//Funcion para eliminar usuarios
function eliminarUsuario($dni){
    $usuarios=obtenerUsuarios();//obtenemos todos los usuarios

    $usuario=$usuarios[$dni];//obtenemos el usuario que queremos borrar
    if(isset($usuario)){//si existe lo borramos
        unset($usuarios[$dni]);
        $usuarios=array_values($usuarios);//adaptamos el tamaño del array al nuevo contenido
        guardarUsuarios($usuarios);
    }
}
//Funcion para añadir usuarios
function añadirUsuario($usuario,$dni){
    $usuarios=obtenerUsuarios();//obtenemos los usuarios
    $usuarios[$dni]=$usuario;//guardamos el nuevo usuario en el array con la clave dni
    guardarUsuarios($usuarios);
}
?>