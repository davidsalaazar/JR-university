<?php

session_start();

$slash = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
include_once ("{$base_dir}servicio{$slash}UsuarioServicio.php");
include_once ("{$base_dir}modelo{$slash}UsuarioModelo.php");
include_once ("{$base_dir}modelo{$slash}RolModelo.php");
include_once ("{$base_dir}servicio{$slash}SessionServicio.php");
include_once ("{$base_dir}servicio{$slash}recaptchalib.php");
include_once ("{$base_dir}servicio{$slash}CorreoServicio.php");


$usuario = new UsuarioServicio();

$usuarioM = new UsuarioModelo();
$usuarioM->setCorreo("davidsm54@gmail.com");
$usuarioM->setNombreUsuario("davidsm54");

if (is_null($usuarioM)) {
    echo "EL usuario no ha sido encontrado";
} else {
    CorreoServicio::enviaCorreo($usuario, "ACCESSO AL SISTEMA");
}


