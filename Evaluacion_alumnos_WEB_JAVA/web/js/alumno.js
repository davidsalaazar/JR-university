$(document).ready(function () {
    rellenaInputs();

    editaTablaCal();

    $("#hideFecha").show();
    $("#hideEdad").hide();
    $("#up").hide();
    $("#del").hide();
    $("#verCalificacion").hide();

    $('#cerrarModal').on('click', function () {
        cierraModal($('#modalcalificacion'));
    });

    $('#cerrarModal2').on('click', function () {
        cierraModal($('#modalCalEdit'));
    });

    $('#add').on('click', function () {
        addAlumno();
    });

    $('#up').on('click', function () {
        actualizaAlumno();
    });

    $('#del').on('click', function () {
        eliminaAlumno();
    });

    $('#clear').on('click', function () {
        limpiar();
    });

    $('#verCalificacion').on('click', function () {
        verCalificacion();
    });

    $('#upC').on('click', function () {
        actualizaCalificacion($('#infoCol').val(), iColumna);
    });

    $('#delC').on('click', function () {
        actualizaCalificacion(0, iColumna);
    });
});

var appP = "";
var appM = "";
var nombreN = "";
var carreraN = "";

function rellenaInputs() {
    var table = $("#tablaAlumno").DataTable({
        "scrollY": "200px",
        "scrollCollapse": true,
        "paging": false,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "bAutoWidth": false,

        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                        .appendTo($(column.footer()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                    );
                            column
                                    .search(val ? '^' + val + '$' : '', true, false)
                                    .draw();
                        });
                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        }
    });

    table.on('click', 'tbody tr', function () {
        var numero = $('td', this).eq(0).text().trim();

        //Valida que hayan datos para colocarlos en la caja de texto
        if (numero != 'No existen datos a mostrar') {
            $("#add").hide();
            $("#up").show();
            $("#del").show();
            $("#verCalificacion").show();

            //This igual a id de la tabla
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

            $("#hideFecha").hide();
            $("#hideEdad").show();
            $("#edadFecha").text("Edad");

            var appPa = $('td', this).eq(1).text().trim();
            var appMa = $('td', this).eq(2).html();
            var nombre = $('td', this).eq(3).html();
            var edad = $('td', this).eq(4).html().trim();
            var carrera = $('td', this).eq(5).html().trim();

            $("#appPa").val(appPa);
            $("#appMa").val(appMa);
            $("#nombre").val(nombre);
            $("#edad").val(edad);
            $("#edad").prop("disabled", true);
            $("#carrera").val(carrera);

            appP = appPa;
            appM = appMa;
            nombreN = nombre;
            carreraN = carrera;
        }
    });
}

function addAlumno() {
    var dataString = JSON.stringify(recogeDato());

    $.ajax({
        url: "controlador",
        data: {'opcion': 1, 'data': dataString},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'danger';
            var mensaje = "Error al procesar los datos";
            var refrescar = false;

            var json = JSON.parse(respuesta);

            if (json) {
                //Exito
                tipo = 'success';
                mensaje = "Registrando alumno...";
                refrescar = true;
            }

            $.bootstrapGrowl(mensaje, {type: tipo});

            if (refrescar) {
                window.setTimeout("window.location.reload()", 500);
            }
        },
        error: function () {
            $.bootstrapGrowl(
                    "Ocurrió un error en el servidor",
                    {
                        type: 'danger'
                    });
        }
    });
}

function actualizaAlumno() {
    var dato = [
        appP,
        appM,
        nombreN,
        '',
        carreraN
    ];

    var dataString = JSON.stringify(dato);

    var dataStringN = JSON.stringify(recogeDato());

    $.ajax({
        url: "controlador",
        data: {'opcion': 2, 'data': dataString, 'data2': dataStringN},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'danger';
            var mensaje = "Actualizando alumno...";
            var refrescar = false;

            var json = JSON.parse(respuesta);

            if (json) {
                //Exito
                tipo = 'success';
                mensaje = "Se ha actualizado el usuario";
                refrescar = true;
            }

            $.bootstrapGrowl(mensaje, {type: tipo});

            if (refrescar) {
                window.setTimeout("window.location.reload()", 500);
            }
        },
        error: function () {
            $.bootstrapGrowl(
                    "Ocurrió un error en el servidor",
                    {
                        type: 'danger'
                    });
        }
    });
}

function eliminaAlumno() {
    var dataString = JSON.stringify(recogeDato());

    $.ajax({
        url: "controlador",
        data: {'opcion': 3, 'data': dataString},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'danger';
            var mensaje = "Error al eliminar el Alumno";
            var refrescar = false;

            var json = JSON.parse(respuesta);

            if (json) {
                //Exito
                tipo = 'success';
                mensaje = "Eliminando alumno...";
                refrescar = true;
            }

            $.bootstrapGrowl(mensaje, {type: tipo});

            if (refrescar) {
                window.setTimeout("window.location.reload()", 500);
            }
        },
        error: function () {
            $.bootstrapGrowl(
                    "Ocurrió un error en el servidor",
                    {
                        type: 'danger'
                    });
        }
    });
}

function recogeDato() {
    var dato = [
        $("#appPa").val(),
        $("#appMa").val(),
        $("#nombre").val(),
        $("#fechaNacimiento").val(),
        $("#carrera").val()
    ];
    return dato;
}


function verCalificacion() {
    var datatable = $("#tablaCalificacion").DataTable();

    var dataString = JSON.stringify(recogeDato());

    $.ajax({
        url: "controlador",
        data: {'opcion': 4, 'data': dataString},
        type: 'POST',
        success: function (respuesta) {
            try {
                var json = JSON.parse(respuesta);

                //Se limpian los datos de la tabla de beneficiarios
                datatable.clear().draw();

                $("#calUsuario").text(appP + " " + appM + " " + nombreN);

                if (json.length == 0) {
                    $.bootstrapGrowl(
                            "No hay registro de calificacion",
                            {
                                type: 'danger'
                            });
                } else {
                    var promedio = 0;

                    for (var i = 0; i < json.length; i++) {
                        //Se agregan las filas que sean convenientes
                        datatable.row.add([
                            [i + 1],
                            [json[i][0]],
                            [json[i][1]],
                            [json[i][2]],
                            [json[i][3]],
                            [json[i][4]],
                            [json[i][5]],
                            [json[i][6]],
                            [json[i][7]],
                        ]).draw();

                        promedio = promedio + parseInt([json[i][5]]);
                    }

                    promedio = promedio / json.length;

                    $("#promedio").text("Promedio: " + promedio);
                }
            } catch (e) {
                console.log(e);
            }

            $("#modalcalificacion").show();
        },
        error: function () {
            $.bootstrapGrowl(
                    "Ocurrió un error en el servidor",
                    {
                        type: 'danger'
                    });
        }
    });
}

function editaTablaCal() {
    var nombreColumna = "";
    var valorRow = 0;
    var mostrar = true;

    $("#tablaCalificacion").on('click', 'tbody tr', function () {
        //Recolect Math name 
        nombreMateria = $('td', this).eq(1).text().trim();
    });


    $("#tablaCalificacion").on('click', 'tbody td', function () {
        mostrar = true;

        var indiceColumna = $(this).index();

        iColumna = indiceColumna - 1;

        switch (indiceColumna) {
            case 2:
                nombreColumna = "Calificación 1";
                break;
            case 3:
                nombreColumna = "Calificación 2";
                break;
            case 4:
                nombreColumna = "Calificación 3";
                break;
            case 5:
                nombreColumna = "Calificación 4";
                break;
            default :
                mostrar = false;
        }

        if (mostrar) {
            valorRow = $(this).text().trim();
            mostrarDi(nombreColumna, valorRow);
        }
    }
    );

    function mostrarDi() {
        $("#nCol").text(nombreColumna);
        $("#infoCol").val(valorRow);
        $("#modalCalEdit").show();
    }
}

function cierraModal(nombreModal) {
    nombreModal.hide();
}

var nombreMateria = "";
var iColumna = 0;

function actualizaCalificacion(calificacion, indiceColumna) {
    if (nombreMateria == "") {
        $.bootstrapGrowl(
                "No se seleccionó correctamente la materia",
                {
                    type: 'danger'
                });
        return;
    }

    var valorCal = $("#infoCol").val();

    if (valorCal < 1 || valorCal > 10) {
        $.bootstrapGrowl(
                "Calificación no valida",
                {
                    type: 'danger'
                });
        return;
    }

    var dataString = JSON.stringify(recogeDato());

    var dataString2 = JSON.stringify([calificacion, indiceColumna, nombreMateria]);

    $.ajax({
        url: "controlador",
        data: {'opcion': 5, 'data': dataString, 'data2': dataString2},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'danger';
            var mensaje = "Error al cambiar la calificacion";
            var refrescar = false;

            var json = JSON.parse(respuesta);

            if (json) {
                cierraModal($("#modalCalEdit"));
                verCalificacion();
            } else {
                $.bootstrapGrowl(
                        "No se pudo actualizar la calificacion",
                        {
                            type: 'danger'
                        });
            }
        },
        error: function () {
            $.bootstrapGrowl(
                    "Ocurrió un error en el servidor",
                    {
                        type: 'danger'
                    });
        }
    });
}

function limpiar() {
    $("#appPa").val("");
    $("#appMa").val("");
    $("#nombre").val("");
    $("#edad").val("");
    $("#carrera").val("");

    $("#hideFecha").show();
    $("#hideEdad").hide();
    $("#edadFecha").text("Fecha Nacimiento");

    $("#up").hide();
    $("#del").hide();
    $("#add").show();
    $("#verCalificacion").hide();
}