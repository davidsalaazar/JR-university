<?php

/**
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora:  10:35:54 PM
 * Codificación: UTF-8
 */
class RolModelo {
    
    /**
     *Indica el identificador del rol
     */
    private $id;
    
    /**
     *Nombre de usuario unico para el rol
     */
    private $nombre;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }    
}
