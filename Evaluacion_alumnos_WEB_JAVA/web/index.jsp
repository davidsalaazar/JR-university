<%-- 
    Document   : index
    Created on : 12/07/2018, 04:05:01 PM
    Author     : David Salazar Mejia
--%>

<%@page import="java.text.DateFormat"%>
<%@page import="modelo.CarreraModelo"%>
<%@page import="service.CarreraService"%>
<%@page import="java.util.Date"%>
<%@page import="modelo.AlumnoModelo"%>
<%@page import="java.util.List"%>
<%@page import="service.AlumnoService"%>
<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Administracion de Usuarios</title>
    </head>
    <body>

        <%@include  file="template/header.jsp"%>

        <br><br><br>
        <h2 class="alert-dismissible" id="titulo">Administración de Alumnos</h2>
        <br>
        <div class="panel panel-default">
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
                                                    Apellido Paterno
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control  border-input" id="appPa">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    Apellido materno
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control  border-input" id="appMa">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    Nombre
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control  border-input" id="nombre">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label id="edadFecha">
                                                    Fecha Nacimiento
                                                </label>
                                            </div>
                                            <div class="col-md-6" id="hideFecha">
                                                <input type="date" class="form-control  border-input" id="fechaNacimiento" placeholder="1998-10-10">
                                            </div>
                                            <div class="col-md-6" id="hideEdad">
                                                <input type="numeric" class="form-control  border-input" id="edad" disabled="true">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>
                                                    Carrera
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                <select class="form form-control border-input" id="carrera">
                                                    <option value="">---Selecciona una Carrera---</option>
                                                    <%
                                                        List<CarreraModelo> lCarrera = new CarreraService().buscaCarrera();

                                                        for (CarreraModelo carrera : lCarrera) {
                                                            String nombreCarrera = carrera.getNombre();
                                                            out.println("<option value = '" + nombreCarrera + "'>");
                                                            out.println(nombreCarrera);
                                                            out.println("</option>");
                                                        }
                                                    %>
                                                </select>
                                            </div>
                                        </div> 
                                        <br>
                                        <div class="row"> 
                                            <div class="col-md-3">
                                                <button id="up" class="btn btn-success active">Actualizar   <i class="ti-reload"></i></button>
                                            </div>
                                            <div class="col-md-3">
                                                <button id="add" class="btn btn-success active">Insertar   <i class="ti-plus"></i></button>
                                                <button id="del"  class="btn btn-danger active">Eliminar   <i class="ti-trash"></i></button>
                                            </div>
                                            <div class="col-md-3">
                                                <button id="clear" class="btn btn-info active">Limpiar   <i class="ti-brush"></i></button>
                                            </div>
                                            <div class="col-md-3">
                                                <button id="verCalificacion" class="btn btn-success active">Calificaciones   <i class="ti-search"></i></button>
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

                                                        <table class="table table-hover" id="tablaAlumno">
                                                            <thead>
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Apellido paterno</td>
                                                                    <td>Apellido materno</td>
                                                                    <td>Nombre</td>
                                                                    <td>Edad</td>
                                                                    <td>Carrera</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <%
                                                                    AlumnoService alumnoService = new AlumnoService();

                                                                    List<AlumnoModelo> lAlumno = alumnoService.buscaAlumno();

                                                                    int con = 1;

                                                                    for (AlumnoModelo alumno : lAlumno) {

                                                                        int edad = new Date().getYear() - alumno.getFechaNacimiento().getYear();

                                                                        out.println("<tr>");
                                                                        out.println("<td>" + con++ + "</td>");
                                                                        out.println("<td>" + alumno.getAppPaterno() + "</td>");
                                                                        out.println("<td>" + alumno.getAppMaterno() + "</td>");
                                                                        out.println("<td>" + alumno.getNombreAlumno() + "</td>");
                                                                        out.println("<td>" + edad + "</td>");
                                                                        out.println("<td>" + alumno.getCarrera().getNombre() + "</td>");
                                                                        out.println("</tr>");
                                                                    }
                                                                %>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Apellido paterno</td>
                                                                    <td>Apellido materno</td>
                                                                    <td>Nombre</td>
                                                                    <td>Edad</td>
                                                                    <td>Carrera</td>
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


        <div id="modalcalificacion" class="modal fadeInLeft">
            <!-- Modal content-->
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 style="text-align: center;" class="modal-title alert-info" id="calUsuario"></h3>
                        <h4 style="text-align: right;" id="promedio"></h4>
                    </div>


                    <div class="modal-body">
                        <div class="col-md-12">
                            <!--Comienza el div para el listado de los usuarios-->
                            <div id="contenidoTabla">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="table-responsive ">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-wrapper-scroll-y">
                                                        <table class="table table-hover" id="tablaCalificacion">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Nombre Materia</th>
                                                                    <th>C 1</th>
                                                                    <th>C 2</th>
                                                                    <th>C 3</th>
                                                                    <th>C 4</th>
                                                                    <th>C F</th>
                                                                    <th>Periodo</th>
                                                                    <td>Año</td>
                                                                </tr>
                                                            </thead>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="cerrarModal">
                            Cerrar
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div id="modalCalEdit" class="modal fadeInLeft">
            <!-- Modal content-->
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-contro" id="nCol"></label>
                            </div>
                            <div class="col-md-8">
                                <input type="numeric" class="form-control  border-input" id="infoCol" placeholder="NUEVO VALOR">
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-4"></div>
                            <div class="col-md-3">
                                <button id="upC" class="btn btn-success active" title="ACTUALIZAR"><i class="ti-reload"></i></button>
                            </div>
                            <div class="col-md-2"></div>
                            <div class="col-md-3">
                                <button id="delC"  class="btn btn-danger active" title="ELIMINAR"><i class="ti-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="cerrarModal2">
                            Cerrar
                        </button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

    </body>
    <%@include  file="template/footer.jsp"%>
    <script src="js/alumno.js" type="text/javascript"></script>
</html>
