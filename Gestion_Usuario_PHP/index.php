<?php

session_start();

/* * ***********************************************
 * Autor: David Salazar Mejia
 * Fecha: 16/03/2018
 * Hora: 08:41:41 PM
 * Tipo: HTML
 * Codificación: UTF-8
 * Descripción:
 * ********************************************** */

$page_title = 'Inicio';

if (isset($_SESSION['user'])) {
    $usuario = $_SESSION['user'];

    if (isset($usuario)) {
        include_once 'web/views/usuario.php';
    }
} else {
    $page_title = 'Iniciar Sesión';
    include_once 'web/views/login.php';
}
?>

<a  target="_blank" href="http://www.google.com" >CONSULTA TU PAGO EN LINEA</a>

