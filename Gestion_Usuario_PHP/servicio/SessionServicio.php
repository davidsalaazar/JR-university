<?php

$slash = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
include_once ("{$base_dir}servicio{$slash}UsuarioServicio.php");
include_once ("{$base_dir}dao{$slash}RolDAO.php");

/**
 * Autor: David Salazar Mejia
 * Fecha: 5/04/2018
 * Hora:  01:55:19 AM
 * Codificación: UTF-8
 */
class SessionServicio {

    /**
     * Indica la instancia hacia usuarioDAO
     * @var UsuarioDAO
     */
    private $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDao();
    }

    /**
     * Este metodo verifica si un usuario es autentico
     * @param UsuarioModelo $usuario Objeto con los datos de un usuario
     * @param String $contrasenaIngresada es ingresada por un usuario desde el LOGIN
     * @return boolean estado del metodo
     */
    public static function validaUsuario(UsuarioModelo $usuario, String $contrasenaIngresada) {
        //Se comparan las ocntraseñas
        return $usuario->getContrasena() == $contrasenaIngresada;
    }

}
