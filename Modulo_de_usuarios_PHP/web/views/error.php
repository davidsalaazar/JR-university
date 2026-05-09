<?php
/* * ***********************************************
 * Autor: David Salazar Mejia
 * Fecha: 6/04/2018
 * Hora: 01:16:38 AM
 * Tipo: HTML
 * Codificación: UTF-8
 * Descripción:
 * ********************************************** */
?>
<html>
    <head>
        <link href="/usuario/web/assets/css/paper-dashboard.css" rel="stylesheet" type="text/css"/>

        <title><?php echo $tipoError ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <script type="text/javascript">
            function redirige() {
                window.location.reload();
            }
        </script>

        <style type="text/css">

            .logo h1{
                font-size: 1000%;
                color:#8F8E8C;
                margin-bottom:1px;
            }	
            .logo p{
                color:rgb(228, 146, 162);
                font-size:20px;
                margin-top:1px;
            }	

            .texto{
                text-align:center;
            }	
        </style>

        <!--  Paper Dashboard core CSS    -->

    </head>

    <body>
        <div class="texto">
            <div class="logo">
                <h1><?php echo $tipoError ?></h1>
                <p><?php echo $descripcion ?><br>
                    <?php echo $descripcion2 ?></p>
                <div class="sub">
                    <p><button href="#" onclick="javascript:redirige();" class="btn btn-primary"><i class="ti-reload"></i>  Volver a cargar</button></p>
                </div>
            </div>
        </div>
    </body>
</html>
