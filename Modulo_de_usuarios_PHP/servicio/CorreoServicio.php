<?php

/**
 * Autor: David Salazar Mejia
 * Fecha: 6/04/2018
 * Hora:  02:42:11 AM
 * Codificación: UTF-8
 */
$slash = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $slash . '..') . $slash;
include_once ("{$base_dir}web{$slash}mail{$slash}PHPMailerAutoload.php");

class CorreoServicio {

    /**
     * Este metodo envia un correo electronico a traves del servidor google.com SMTP con SSL
     * @param UsuarioModelo $usuario
     * @param type $asunto
     * @return boolean 
     */
    public static function enviaCorreo(UsuarioModelo $usuario, $asunto) {
        //Indica la ejecución del metodo
        $estadoMetodo = false;

        //Se verifica si el usuario es diferente de null
        if (!is_null($usuario)) {
            //Se extrae el correo del usuario
            $destinatario = $usuario->getCorreo();

            //Se extrae el nombre del usuario
            $nombreUsuario = $usuario->getNombreUsuario();
            try {
                $estadoMetodo = CorreoServicio::enviar($destinatario, $nombreUsuario);
            } catch (Exception $ex) {
                //PINTAR UN ERROR
            }
        }
        return $estadoMetodo;
    }

    /**
     * Este metodo conecta con el servidor de google para enviar el correo
     * * @param $correo
     *  @param $nombreUsuario
     */
    public static function enviar($correo, $nombreUsuario) {
        //Instancia para inicializar los datos de conexion
        $mail = new PHPMailer();

        //Se indica a la clase que use SMTP
        $mail->IsSMTP();

//        permite modo debug para ver mensajes de las cosas que van ocurriendo
//        $mail->SMTPDebug = 2;
//        
        //Se indica que se debe de autenticar
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";

        //indico el servidor de Gmail para SMTP
        $mail->Host = "smtp.gmail.com";

        //indico el puerto que usa Gmail
        $mail->Port = 465;

        //indico un usuario / clave de un usuario de gmail
        $mail->Username = "reformaenlinea@gmail.com";
        $mail->Password = "reforma412R";
        $mail->SetFrom('reformaenlinea@gmail.com', 'David Salazar Mejia');

        //Se agrega el asunto
        $mail->Subject = "Acceso a KNOWLEWDGE detectado";

        //Cadena HTML para enviar en el contenido del correo
        $html = '<hr color = "#1F869B" size="7">                
        <div style="padding-right:15px;padding-left:15px;margin-right:10%;margin-left:10%">
                <div style="color: #ae5a48; border-style: solid; border-radius: 5px; text-align: center;" >
                            <h1>Hola ' . $nombreUsuario . '</h1>
                            <h3>Hemos registrado un acceso con tus datos <br>Fecha:' . date("Y-m-d") . '</h3>
<p>
     <h4>Atentamente soporte-knowledge</h4>   
</p>
</div>
</div>
<hr color = "#1F869B" size="7">';
        
         //Se indica que el cuerpo sera HTML
        $mail->MsgHTML($html);
    
        //Se agrega la direccion a la que se le enviara el correo
        $mail->addAddress($correo, $nombreUsuario);

        //Finalmente se envia el correo
        return $mail->send();
    }

}
