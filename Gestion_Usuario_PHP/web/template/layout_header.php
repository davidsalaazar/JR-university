<!--/*************************************************
* Autor: David Salazar Mejia
* Fecha: 16/03/2018
* Hora: 08:18:51 PM
* Tipo: <!DOCTYPE html>
* Codificación: UTF-8
* Descripción: Plantilla para construir el encabezado 
* de la vista y mantener un orden en las hojas de estilo que utilizara la aplicación
************************************************/-->
<html lang="es" ng-app="">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $page_title ?></title>

        <!--Hojas de estilo*/-->
        <link href="/usuario/web/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/usuario/web/assets/css/paper-dashboard.css" rel="stylesheet" type="text/css"/>
        <link href="/usuario/web/assets/css/themify-icons.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
        <link href="/usuario/web/assets/css/bootstrap-toggle.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container container-fluid">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">KNOWLEDGE TI</a>
                </div>

                <div>
                    <ul class="nav navbar-nav mr-auto">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-file-pdf-o"></i>
                                    <p><i class="ti-agenda"></i>   Reportería<b class="caret"></b></p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" id="cerrar">Reporte de Usuarios</a></li>
                                    <li><a href="#" id="cerrar">Reporte de Accesos</a></li>
                                </ul>
                            </li>
                        </ul>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-file-pdf-o"></i>
                                <p><i class="ti-user"></i>   <?php echo $usuario ?><b class="caret"></b></p>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#" id="cerrar">Cerrar Sesión</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

