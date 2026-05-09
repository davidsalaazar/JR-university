<?php
include_once 'servicio/UsuarioServicio.php';
include_once 'dao/RolDAO.php';

$usuarioServicio = new UsuarioServicio();
$rolDao = new RolDAO();

include_once 'web/template/layout_header.php';
?>
<br><br><br>
<h2 class="alert-dismissible" id="titulo">Administración de Usuarios</h2>
<br>
<div class="panel panel-default" ng-controller="usuarioController">
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            Nombre Usuario
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control  border-input" id="nombre" ng-model="aDato.nombre">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>
                                            Correo
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control  border-input" id="correo" ng-model="aDato.correo">
                                    </div>
                                </div>
                                <div class="row" id="divPass">
                                    <br>
                                    <div class="col-md-6">
                                        <label>
                                            Contraseña
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input ng-model="aDato.contrasena" type="password" class="form-control  border-input" id="contrasena" ng-model="contrasena">
                                    </div>
                                </div>
                                <br>
                                <div class="row">

                                    <div class="col-md-6">
                                        <label>
                                            Rol
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form form-control border-input" id="rol" ng-model="aDato.rol">
                                            <option value="">---Selecciona un Rol---</option>
                                            <?php echo $rolDao->selectOption(); ?>
                                        </select>
                                    </div>
                                </div> 
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <input ng-model="aDato.activo" ng-value="aDato.activo" id="activo" checked data-toggle="toggle" data-width="100%" 
                                               data-on="ACTIVO" data-off="INACTIVO" data-onstyle="info" 
                                               data-offstyle="danger" type="checkbox">
                                    </div>
                                </div> 
                                <br>
                                <div class="row"> 
                                    <div class="col-md-3">
                                        <button id="pdf" ng-click="pdf()" class="btn btn-primary active">PDF   <i class="ti-wand"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="up" ng-click="upUsuario()" class="btn btn-success active">Actualizar   <i class="ti-reload"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="add" ng-submit="addUsuario()" ng-click="addUsuario()" class="btn btn-success active">Insertar   <i class="ti-plus"></i></button>
                                        <button id="del" ng-click="delUsuario()" class="btn btn-danger active">Eliminar   <i class="ti-trash"></i></button>
                                    </div>
                                    <div class="col-md-3">
                                        <button id="clear" ng-click="clear()" class="btn btn-info active">Limpiar   <i class="ti-brush"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6" id="tablaa">
                        <!--Comienza el div para el listado de los usuarios-->
                        <div id="contenidoTabla">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive ">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table class = 'table table-hover' id="dataTableUsuario">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>NOMBRE USUARIO</th>
                                                            <th>CORREO</th>
                                                            <th>ROL</th>
                                                            <th>ACTIVO</th>
                                                        </tr> 
                                                    </thead>
                                                    <?php echo $usuarioServicio->listaUsuario(); ?>
                                                    <tfoot>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>NOMBRE USUARIO</th>
                                                            <th>CORREO</th>
                                                            <th>ROL</th>
                                                            <th>ACTIVO</th>
                                                        </tr> 
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'web/template/layout_footer.php';
?>
<!--/**JS requeridos*/-->
<script src="/usuario/web/assets/js/usuario.js" type="text/javascript"></script>
