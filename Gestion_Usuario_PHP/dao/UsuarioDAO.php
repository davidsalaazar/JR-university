<?php

include_once 'DAOAbstracto.php';

/**
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora:  01:59:49 AM
 * Codificación: UTF-8
 */
class UsuarioDao extends DAOAbstracto {

    /**
     * Nombre de la tabla para poder lanzar las consultas hacia la BD
     */
    protected $join = 'usuario u join rol using(rol_id)';
    protected $nombreTabla = 'usuario';

    /**
     * Este metodo Construye una tabla de usuarios registrados en el sistema
     * @return string
     */
    public function tablaHtml() {
        $tabla = "<tbody>";

        //Se ejecuta la busqueda pasando null y null (VER DOC)
        $lFila = $this->readJoin(null, null);

        //Contador para mostrar el número de fila en la tabla
        $contador = 1;

        if ($lFila->rowCount() > 0) {
            while ($renglon = $lFila->fetch(PDO::FETCH_ASSOC)) {
                //Se indica el estado del usuario
                $activo = "check";

                //Se verifica si es falso el estado
                if ($renglon['activo'] == 0) {
                    $activo = "na";
                }

                //Se genera cada renglon de la tabla con los datos de BD
                $tabla = $tabla . "<tr>
                                <td>" . $contador . "</td>
                                <td>" . $renglon['nombreusuario'] . "</td>
                                <td>" . $renglon['correo'] . "</td>
                                <td>" . $renglon['nombre'] . "</td>
                                <td><i class='ti-";
                
                //Se incrementa el contador para indicar el numero de fila
                $contador++;

                //Se cierra el renglon
                $tabla = $tabla . $activo . "'></i> </tr>";
            }

            //Se cierra el cuerpo de la tabla
            $tabla = $tabla . "</tbody>";
        }
        return $tabla;
    }

}
