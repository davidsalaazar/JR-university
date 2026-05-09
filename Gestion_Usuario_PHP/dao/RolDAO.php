<?php

include_once 'DAOAbstracto.php';

/**
 * Autor: David Salazar Mejia
 * Fecha: 17/03/2018
 * Hora:  12:38:28 AM
 * Codificación: UTF-8
 */
class RolDAO extends DAOAbstracto {

    /**
     * Nombre de la tabla para poder lanzar las consultas hacia la BD
     */
    protected $nombreTabla = 'rol';

    /**
     * Nombre de la tabla
     */
    protected $join = 'rol';

    /**
     * Este metodo busca los roles que estan en la BD y arroja una lista de 
     * opciones para un select de HTML
     */
    function selectOption() {
        $opcionSelect = '';

        //Se guarda el resultado de la consulta
        $lFila = $this->readTabla(null, null);

        //Se verifica si hay fila disponibles
        if ($lFila->rowCount() > 0) {
            while ($renglon = $lFila->fetch(PDO::FETCH_ASSOC)) {
                $opcionSelect = $opcionSelect .
                        "<option value='" . $renglon['nombre'] . "'>" . $renglon['nombre'] . "</option>";
            }
        }
        return $opcionSelect;
    }

    /**
     * Este metodo busca los roles que estan en la BD y arroja una lista de 
     * opciones para un select de HTML
     */
    function buscaRol($rol) {

        if (!$rol == '') {
            $this->readTabla(null, null);
        }
        
        $rol = '';

        //Se guarda el resultado de la consulta
        $lFila = $this->readTabla(null, null);

        //Se verifica si hay fila disponibles
        if ($lFila->rowCount() > 0) {
            while ($renglon = $lFila->fetch(PDO::FETCH_ASSOC)) {
                $opcionSelect = $opcionSelect .
                        "<option value='" . $renglon['nombre'] . "'>" . $renglon['nombre'] . "</option>";
            }
        }
        return $opcionSelect;
    }

}
