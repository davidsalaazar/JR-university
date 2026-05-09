<?php

$slash = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
include_once ("{$base_dir}dao{$slash}UsuarioDAO.php");
include_once ("{$base_dir}dao{$slash}RolDAO.php");

/**
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora:  02:59:22 AM
 * Codificación: UTF-8
 */
class UsuarioServicio {

    /**
     * Instancia hacia UsuarioDAO
     * @var UsuarioDAO 
     */
    private $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDao();
    }

    /**
     * Este metodo pinta el cuerpo de una tabla y mostrarla en PHP
     * @return type
     */
    public function listaUsuario() {
        return $this->usuarioDao->tablaHtml();
    }

    /**
     * Este metodo busca a un usuario o a varios
     * @param $nombreUsuario 
     * @return UsuarioModelo
     */
    public function buscaUsuarioPorNombre($nombreUsuario) {
        //Se inicializa en null el objeto usuario
        $usuario = null;

        //Se ejecuta la consulta del usuario indicado
        $lFila = $this->usuarioDao->readTabla('nombreusuario', $nombreUsuario);

        if ($lFila->rowCount() > 0) {
            while ($columna = $lFila->fetch(PDO::FETCH_ASSOC)) {
                //Objeto que guardara los datos de un usuario
                $usuario = new UsuarioModelo();
                
                //Objeto que guardara los datos de un Rol
                $rol = new RolModelo();

                //Asignacion de datos de usuario
                $usuario->setNombreUsuario($columna['nombreusuario']);
                $usuario->setContrasena($columna['contrasena']);

                //Se asigna el id al objero de rol
                $rol->setId($columna['rol_id']);

                //Se asigna el objeto de rol al usuario
                $usuario->setRol($rol);
                $usuario->setFechaActualizacion($columna['fecha_actualizacion']);
                $usuario->setActivo($columna['activo']);
                $usuario->setIdUsuario($columna['id']);
                $usuario->setCorreo($columna['correo']);

                //Solo se requiere a un usuario entonces se rompe el ciclo
                break;
            }
        }
        return $usuario;
    }

    /**
     * Este metodo valida los datos de un usuario para guardarlo
     * @param UsuarioModelo $usuario
     * @return boolean ejecucion del metodo
     */
    public function agregaUsuario(UsuarioModelo $usuario) {
        if (is_null($usuario)) {
            return false;
        }
        //Se extrae el nombre que viene en el objeto de usuario
        $nombre = $usuario->getNombreUsuario();

        //Se hace una busqueda con el usuario que se quiere agregar
        $usuarioN = $this->buscaUsuarioPorNombre($nombre);

        //Solo si es null el usuario
        if (!is_null($usuarioN)) {
            return false;
        } else {
            //Extraccion de datos del usuario
            $contrasena = $usuario->getContrasena();
            $correo = $usuario->getCorreo();
            $rol = $usuario->getRol()->getNombre();
            $activo = $usuario->getActivo();

            //Creacion de cadena para ejecutar en SQL
            $valor = "(nombreusuario, contrasena, correo, fecha_actualizacion, activo, rol_id)"
                    . " values ('" . $nombre . "', '" . $contrasena . "', '" . $correo . "', '" . date('Y/m/d') . "', " . $activo . ", "
                    . "(select rol_id from rol where nombre = '" . $rol . "'));";

            return $this->usuarioDao->create($valor);
        }
    }

    /**
     * Este metodo actualiza los datos de un usuario
     * @param UsuarioModelo Objeto de usuarioModelo
     * @return boolean ejecucion del metodo
     */
    public function actualizaUsuario(UsuarioModelo $usuario) {
        if (is_null($usuario)) {
            return false;
        }

        //Extraccion de datos del usuario
        $nombre = $usuario->getNombreUsuario();
        $contrasena = $usuario->getContrasena();
        $correo = $usuario->getCorreo();
        $rol = $usuario->getRol()->getNombre();
        $activo = $usuario->getActivo();

        //Creacion de cadena para ejecutar en SQL
        $valor = "nombreusuario = '" . $nombre . "', contrasena = '" . $contrasena
                . "', fecha_actualizacion = '" . date('Y/m/d')
                . "', correo = '" . $correo
                . "', rol_id = (select rol_id from rol where nombre = '" . $rol . "'), "
                . "activo = '" . $activo . "'";

        return $this->usuarioDao->update($valor, "id", $usuario->getIdUsuario());
    }

    /**
     * Este metodo elimina a un usuario
     * @param type $nombreUsuario
     * @return boolean indica la ejecucion del metodo
     */
    public function eliminaUsuario($nombreUsuario) {
        if ($nombreUsuario != "") {
            //Se busca el usuario para extraer su ID
            $usuario = $this->buscaUsuarioPorNombre($nombreUsuario);

            //Se verifica si se encontro el usuario
            if (is_null($usuario)) {
                return false;
            } else {
                return $this->usuarioDao->delete("id", $usuario->getIdUsuario());
            }
        }
    }

}
