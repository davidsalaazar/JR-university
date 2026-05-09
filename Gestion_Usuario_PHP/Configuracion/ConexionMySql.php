<?php

/**
 * Autor: David Salazar Mejia
 * Fecha: Feb 17, 2018
 * Hora:  11:58:48 AM
 * Codificación: UTF-8
 */
class ConexionMySql {

    /**
     * @var instance se utiliza para extraer la conexion de la base de datos 
     */
    private static $instance = null;
    private $host = null;
    private $database = null;
    private $user = null;
    private $password = null;
    private $conexion = null;

    /**
     * Constructor de la clase
     */
    function __construct() {
        try {
            //Se cargan los datos de la conexion 
            $this->cargaDatoConexion();

            //Se inicializa la conexion con los datos existenes
            $this->conexion = new PDO("mysql:host=" . $this->host . "; dbname="
                    . $this->database, $this->user, $this->password);
        } catch (Exception $ex) {
            //Se imprime el error
            echo $ex->getMessage();
        }
    }

    /**
     * Este metodo concede una instancia de la conexion a la BD
     * @return type
     */
    public static function getInstance() {
        //Se verifica que la instancia no este inicializada
        if (!(self::$instance instanceof ConexionMySql)) {
            //Se inicializa la conexion
            self::$instance = new ConexionMySql();
        }
        return self::$instance;
    }

    /**
     * Envia la conexion existente de la BD
     * @return type
     */
    public function getConexion() {
        return $this->conexion;
    }

    /**
     * Este metodo lee un XML que tiene los datos de conexion
     */
    protected function cargaDatoConexion() {
        $dato = __DIR__ . "/Config.xml";
        
        if (!file_exists($dato)) {
            exit("El archivo es invalido");
        } else {
            $datoConexion = simplexml_load_file($dato);

            //Se carga la conexion de la base de datos
            $this->host = $datoConexion->mysql[0]->host;
            $this->database = $datoConexion->mysql[0]->database;
            $this->user = $datoConexion->mysql[0]->user;
            $this->password = $datoConexion->mysql[0]->password;
        }
    }

}
