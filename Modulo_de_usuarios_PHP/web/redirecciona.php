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

$usuarioServicio = new UsuarioServicio();

/* * ***********************************************
 * Autor: David Salazar Mejia
 * Fecha: 17/03/2018
 * Hora: 04:38:25 AM
 * Tipo: HTML
 * Codificación: UTF-8
 * Descripción: Se utiliza con un LISTENER donde cualquier Archivo PHP o llamada
 * AJAX puede ingresar, siempre y cuando sea llamada indirectamente
 * ********************************************** */

//Se valida que los datos sean POST
if (!isset($_POST['dato']) && empty($_POST['dato'])) {
    //Se asigna el error 
    $tipoError = "Error 401";
    $descripcion = "Vaya que estamos teniendo problemas";
    $descripcion2 = "Ha ingresado a un sitio donde no parece tener permisos";
    //Mensaje en el servidor de error
    include_once ("views/error.php");
} else {
    //Indica la respuesta de la ejecucion del metodo
    $jsonRes = array();

    //Objeto tipo rol para asignarlo al usuario
    $rolN = new RolModelo();

    //Se descompone el JSON
    $json = json_decode($_POST['dato']);

    //Se leen los datos que trae el objeto JSON
    foreach ($json as $dato) {
        //Se extrae el nombre del metodo que viene en el arreglo
        $metodo = $dato->metodo;
        $nombre = $dato->nombreUsuario;
        $correo = $dato->correo;
        $contrasena = $dato->contrasena;
        $rol = $dato->rol;
        $activo = $dato->activo;

        //Se verifica que este completa la variable sino se inicializa
        if ($activo == '') {
            $activo = 0;
        }

        switch ($metodo) {
            case 'login':
                /* Se verifica que el correo este completo ya que ahi se guardan 
                  los datos del RE CAPTCHA DE GOOGLEE */
                if ($correo != '') {
                    //Se retorna el resultado
                    $jsonRes['estado'] = hash("sha256", "david");
                    echo json_encode($jsonRes);
                    break;
                }

                //Lave con la que puede autenticarse el recaptcha
                //Ojo debe de estar en BD
                $secret = "6LcpklQUAAAAAOGv-KbIItoJG4v6NWD0l5ZFxwAr";

                //Instancia hacia la clase Recaptcha pasando la llave en el constructor
                $reCaptcha = new ReCaptcha($secret);

                //Dependiendo de la ejecucion, se inicializa el objeto
                $response = $reCaptcha->verifyResponse($_SERVER["REMOTE_ADDR"], $correo);

                //Si es null entonces es un robot
                if (is_null($response)) {
                    $jsonRes['estado'] = '1';
                    echo json_encode($jsonRes);
                    break;
                }

                //Se verifica la existencia del usuario
                $usuario = $usuarioServicio->buscaUsuarioPorNombre($nombre);

                if (is_null($usuario)) {
                    //Se retorna el resultado
                    $jsonRes['estado'] = '1';
                } else {
                    //Se verifica si las contraseñas coinciden
                    if (SessionServicio::validaUsuario($usuario, hash("sha256", $contrasena))) {
                        //Se inicia la sesion al ser correctas
                        $_SESSION['user'] = $usuario->getNombreUsuario();
                        $jsonRes['estado'] = '0';
                        CorreoServicio::enviaCorreo($usuario, "ACCESSO AL SISTEMA");
                    } else {
                        //Se retorna el resultados
                        $jsonRes['estado'] = "1";
                    }
                }
                echo json_encode($jsonRes);
                break;
            case 'cerrarsesion':
                //Se verifica si la sesion esta en uso para poder cerrarla
                if (isset($_SESSION['user'])) {
                    session_destroy();
                    $jsonRes['estado'] = '0';
                }

                //Se indica el resultado
                echo json_encode($jsonRes);
                break;
            case 'agregaUsuario':
                //Se busca el usuario antes de agregar
                $usuario = $usuarioServicio->buscaUsuarioPorNombre($nombre);

                //Solo se agregara el usuario si este no existe
                if (!is_null($usuario)) {
                    //Se retorna el resultado, usuario existente
                    $jsonRes['estado'] = '2';
                } else {
                    //El usuario no existe entonces se puede registrar
                    $usuario = new UsuarioModelo();

                    $usuario->setNombreUsuario($nombre);
                    $usuario->setContrasena(hash("sha256", $contrasena));
                    $rolN->setNombre($rol);
                    $usuario->setRol($rolN);
                    $usuario->setActivo($activo);

                    //Se verifica la ejecucion del metodo
                    if ($usuarioServicio->agregaUsuario($usuario)) {
                        //Indica exito
                        $jsonRes['estado'] = '0';
                    } else {
                        //Indica error en la ejecucion
                        $jsonRes['estado'] = '1';
                    }
                }
                //Se indica el resultado
                echo json_encode($jsonRes);
                break;
            case 'actualizaUsuario':
                //Se busca el usuario antes de actualizar
                $usuario = $usuarioServicio->buscaUsuarioPorNombre($nombre);

                if (is_null($usuario)) {
                    //Indica error en la ejecucion
                    $jsonRes['estado'] = '2';
                } else {
                    $rolN->setNombre($rol);
                    $usuario->setActivo($activo);
                    $usuario->setCorreo($correo);
                    $usuario->setRol($rolN);

                    if ($usuarioServicio->actualizaUsuario($usuario)) {
                        //Indica exito
                        $jsonRes['estado'] = '0';
                    } else {
                        //Indica error en la ejecucion
                        $jsonRes['estado'] = '1';
                    }
                }
                //Se indica el resultado
                echo json_encode($jsonRes);
                break;
            case 'eliminaUsuario':
                if ($usuarioServicio->eliminaUsuario($nombre)) {
                    //Indica exito
                    $jsonRes['estado'] = '0';
                } else {
                    //Indica exito
                    $jsonRes['estado'] = '1';
                }
                //Se indica el resultado
                echo json_encode($jsonRes);
                break;
        }
        //Se vacia de memoria
        exit();
    }
}

    