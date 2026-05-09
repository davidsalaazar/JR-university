<?php

$slash = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
include ("{$base_dir}Configuracion{$slash}ConexionMySql.php");

/**
 * Autor: David Salazar Mejia
 * Fecha: Feb 17, 2018
 * Hora:  1:01:29 PM
 * Codificación: UTF-8
 */
abstract class DAOAbstracto {

    /**
     * Variable que almacena la conexion hacia la BD
     */
    private $conexionBD = null;

    /**
     * Constructor que inicializa la conexion hacia la BD
     */
    function __construct() {
        $instancia = ConexionMySql::getInstance();

        $this->conexionBD = $instancia->getConexion();
    }

    /**
     * Este metodo realiza un registro en la BD de una tabla
     * @param type $query
     * @return type
     */
    public function create($query) {
        //Se verifica que el query tenga datos
        if (is_null($query) || $query == "") {
            exit("La consulta viene vacia");
            return;
        }

        //Se concatena el insert
        $query = "INSERT INTO " . $this->nombreTabla . $query;

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>' ;

        //Se prepara la consulta pasando el query
        $sentencia = $this->conexionBD->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

    /**
     * Este metodo consulta los datos de varias tablas
     * @param cadena $nombreCampo columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return arreglo de datos encontrados
     */
    public function readJoin($nombreCampo, $id) {
        $query = 'SELECT * FROM ' . $this->join;

        if (!is_null($id)) {
            $query = $query . "WHERE " . $nombreCampo . " = '" . $id . "';";
        }

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->conexionBD->prepare($query);

        $sentencia->execute();

        return $sentencia;
    }

    /**
     * Este metodo consulta los datos de una tabla
     * @param cadena $nombreCampo columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return arreglo de datos encontrados
     */
    public function readTabla($nombreCampo, $id) {
        $query = 'SELECT * FROM ' . $this->nombreTabla;

        if (!is_null($id)) {
            $query = $query . " WHERE " . $nombreCampo . " = '" . $id . "';";
        }

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->conexionBD->prepare($query);

        $sentencia->execute();

        return $sentencia;
    }

    /**
     * Este metodo actualiza uno o varios valores de una tabla
     * @param cadena $valor datos que se actualizaran
     * @param cadena $nombreCampo columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return boolean de la ejecucion del metodo
     */
    public function update($valor, $nombreCampo, $id) {
        $query = "UPDATE " . $this->nombreTabla . " SET " . $valor .
                " WHERE " . $nombreCampo . " = " . $id;

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->conexionBD->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

    /**
     * Este metodo elimina uno o varios registros de una tabla
     * @param cadena $nombreCampo columna de la tabla
     * @param cadena $id dato a comparar con la columna
     * @return type
     */
    public function delete($nombreCampo, $id) {
        $query = "DELETE FROM " . $this->nombreTabla . " WHERE " . $nombreCampo . " = " . $id;

        //Se imprime la consulta a ejecutar (SOLO EN PRUEBAS)
//        echo '<script type="text/javascript"> console.log("' . $query . '");</script>';

        $sentencia = $this->conexionBD->prepare($query);

        //Dependiendo de la inserccion se retorna true o false
        return $sentencia->execute();
    }

}
