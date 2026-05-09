<?php
/* * ***********************************************
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora: 08:41:49 PM
 * Tipo: HTML
 * Codificación: UTF-8
 * Descripción:
 * ********************************************** */
?>
<html ng-app="">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Iniciar Sesión</title>
        <link href="/usuario/web/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/usuario/web/assets/css/app.css" rel="stylesheet" type="text/css"/>
        <link href="/usuario/web/assets/css/paper-dashboard.css" rel="stylesheet" type="text/css"/>

        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body ng-controller="loginController">
        <div id="contenido">
            <div id="mainWrapper">
                <div class="login-container">
                    <div class="login-card">
                        <div class="login-form">
                            <img src="/usuario/web/assets/img/user.png" id="user"/>
                            <div class="input-group input-sm ">
                                <input type="password" class="form-control" id="usuario" placeholder="Usuario" required ng-model="aDato.usuario">
                                <label class="input-group-addon" for="nick"><i class="fa fa-user border-input"></i></label>   
                            </div>
                            <div class="input-group input-sm">
                                <input type="password" class="form-control" id="contrasena" placeholder="Contraseña" required ng-model="aDato.contrasena">
                                <label class="input-group-addon border-input" for="contrasena"><i class="fa fa-lock"></i></label> 
                            </div>

                            <a href="#" ng-click="recupera()">¿Olvido su contraseña?</a>
                            <br/>
                            <br/>

                            <div class="form-actions">
                                <button type="submit" ng-click="login()"
                                        class="btn btn-block btn-info active">Continuar</button>
                            </div>
                            <br/>

                            <div class="form-actions">
                                <div class="g-recaptcha" data-sitekey="6LcpklQUAAAAAEfcGh1jHUiWwv5tZ_9MivEVhy0H"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="enviarClaveAcceso" class="modal fadeInLeft" data-backdrop="static" data-keyboard="false">
            <!-- Modal content-->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center;" class="modal-title">Ingrese su correo electrónico</h3>
                    </div>

                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="email" id="correoEnvio" class="form-control border-input" required>
                                </div>
                            </div>
                        </div>
                        <br/>

                        <input class="btn btn-lg btn-primary btn-block" ng-click="enviaCorreo()" value="Enviar">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="recuperaContrasena" class="modal fadeInLeft" data-backdrop="static" data-keyboard="false">
            <!-- Modal content-->
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center;" class="modal-title">Se ha enviado una clave de acceso</h3>
                    </div>

                    <div class="modal-body">
                        <h5 style="text-align: center;">Ingrese la clave que se le ha enviado    <i  class="ti-arrow-down"></i></h5>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="password" id="claveAutentica" class="form-control border-input" maxlength="7" placeholder="CLAVE" required>
                            </div>
                        </div>
                        <br/>

                        <input class="btn btn-lg btn-primary btn-block" onclick="javascript:validaClaveContrasena();" value="Continuar">
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <!--Ventana modal para establecer la nueva contraseña del usuario que desea reestablecerla-->
        <div id="reiniciaContrasena" class="modal fade" data-backdrop="static" data-keyboard="false">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center;" class="modal-title">CAMBIE SU CONTRASEÑA</h3>
                    </div>

                    <div class="modal-body">
                        <div class="panel panel-default">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <label class="form-control">Nueva Contraseña</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" id="contrasenaNueva" class="form-control border-input" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-5">
                                        <label class="form-control">Repita su contraseña</label>
                                    </div>
                                    <div class="col-md-7">
                                        <input type="password" id="contrasenaNueva2" class="form-control border-input" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br/>
                        <input class="btn btn-lg btn-primary btn-block" onclick="javascript:actualizaContrasena();" value="Actualizar">
                    </div>

                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <script src="/usuario/web/assets/js/angular.min.js" type="text/javascript"></script>
        <script src="/usuario/web/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
        <script src="/usuario/web/assets/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/usuario/web/assets/js/notificacion.js" type="text/javascript"></script>
        <script src="/usuario/web/assets/js/login.js" type="text/javascript"></script>
    </body>
</html>