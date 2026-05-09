<?php

/**
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora:  01:52:01 AM
 * Codificación: UTF-8
 */
class UsuarioModelo {

    /**
     * Define el ID con el que cuenta el usuario
     */
    private $idUsuario;

    /**
     * Define el nombre del usuario
     */
    private $nombreUsuario;

    /**
     * Define la contraseña del usuario
     */
    private $contrasena;

    /**
     * Define la fecha en la que se le actualizo la contraseña al usuario
     */
    private $fechaActualizacion;

    /**
     * Define el estado del usuario
     */
    private $activo;

    /**
     *  Correo electrónico del usuario
     */
    private $correo;

    /**
     * Asociación entre un usuario con un ROL
     */
    private $rol;

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombreUsuario() {
        return $this->nombreUsuario;
    }

    function getContrasena() {
        return $this->contrasena;
    }

    function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    function getActivo() {
        return $this->activo;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombreUsuario($nombreUsuario) {
        $this->nombreUsuario = $nombreUsuario;
    }

    function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    function setActivo($activo) {
        $this->activo = $activo;
    }

    function getRol() {
        return $this->rol;
    }

    function setRol(RolModelo $rol) {
        $this->rol = $rol;
    }
    
    public function getCorreo() {
        return $this->correo;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
