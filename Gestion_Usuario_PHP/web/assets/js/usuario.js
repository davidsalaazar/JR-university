function usuarioController($scope) {
    rellenaInputs($scope);
    $("#up").hide();
    $("#del").hide();
    $("#pdf").hide();
    $("#activo").bootstrapToggle('on');
    $scope.aDato = new Array();
    $scope.aDato.activo = true;

    $("#activo").on('change', function () {
        if ($scope.aDato.activo == false) {
            $scope.aDato.activo = true;
        } else {
            $scope.aDato.activo = false
        }
    });

    $scope.clear = function () {
        $scope.aDato.nombre = '';
        $scope.aDato.contrasena = '';
        $scope.aDato.correo = '';
        $scope.aDato.rol = '';
        $scope.aDato.activo = true;
        $("#nombre").val("");
        $("#rol").val("");
        $("#correo").val("");
        $("#activo").bootstrapToggle('on');
        $("#up").hide();
        $("#del").hide();
        $("#add").show();
        $("#pdf").hide();
        $("#divPass").show();
        $("#nombre").prop("disabled", false);
    }

    $scope.addUsuario = function () {
        if (validaDatos($scope, 0)) {
            $scope.aDato.push({'metodo': 'agregaUsuario', 'nombreUsuario': $scope.aDato.nombre,
                'correo': $scope.aDato.correo, 'contrasena': $scope.aDato.contrasena, 'rol': $scope.aDato.rol,
                'activo': $scope.aDato.activo});

            var dataString = JSON.stringify($scope.aDato);

            enviaDatos("Se ha agregado el usuario", 'No se pudo agregar el usuario', dataString, $scope);
        }
    }

    $scope.upUsuario = function () {
        if (validaDatos($scope, 1)) {
            $scope.aDato.push({'metodo': 'actualizaUsuario', 'nombreUsuario': $scope.aDato.nombre,
                'correo': $scope.aDato.correo, 'contrasena': '', 'rol': $scope.aDato.rol, 'activo': $scope.aDato.activo});

            var dataString = JSON.stringify($scope.aDato);

            enviaDatos("Se ha actualizado el usuario", 'No se pudo actualizar el usuario', dataString, $scope);
        }
    }

    $scope.delUsuario = function () {
        if (validaDatos($scope, 2)) {
            $scope.aDato.push({'metodo': 'eliminaUsuario', 'nombreUsuario': $scope.aDato.nombre,
                'correo': '', 'contrasena': '', 'rol': $scope.aDato.rol, 'activo': $scope.aDato.activo});

            var dataString = JSON.stringify($scope.aDato);

            enviaDatos("Se ha eliminado el usuario", 'No se pudo eliminar el usuario', dataString, $scope);
        }
    }

    $("#cerrar").on('click', function () {
        $scope.aDato.push({'metodo': 'cerrarsesion', 'nombreUsuario': '',
            'correo': '', 'contrasena': '', 'rol': '', 'activo': ''});

        var dataString = JSON.stringify($scope.aDato);

        enviaDatos("Cerrando...", "Cerrando...", dataString, $scope);
    });
}

function rellenaInputs($scope) {
    $("#dataTableUsuario").DataTable();

    $('#dataTableUsuario tbody').on('click', 'tr', function () {
        var numero = $('td', this).eq(0).text().trim();

        //Valida que hayan datos para colocarlos en la caja de texto
        if (numero != 'No existen datos a mostrar') {
            $("#divPass").hide();

            $("#add").hide();
            $("#up").show();
            $("#del").show();
            $("#pdf").show();

            var nombre = $('td', this).eq(1).text().trim();
            var correo = $('td', this).eq(2).html();
            var rol = $('td', this).eq(3).html();
            var activo = $('td', this).eq(4).html().trim();

            //Si es falso entrara...
            if (activo === '<i class="ti-na"></i>') {
                $("#activo").bootstrapToggle('off');
                activo = false;
            } else {
                $("#activo").bootstrapToggle('on');
                activo = true;
                $("#nombre").val(nombre);
                $("#rol").val(rol);
                $("#correo").val(correo);
                $("#nombre").prop("disabled", true);
            }

            $scope.aDato.nombre = nombre;
            $scope.aDato.correo = correo;
            $scope.aDato.rol = rol;
            $scope.aDato.activo = activo;

            $("#nombre").val(nombre);
            $("#rol").val(rol);
            $("#correo").val(correo);
            $("#nombre").prop("disabled", true);
        }
    });
}

function enviaDatos(mensajeExito, mensajeError, dataString) {
    $.ajax({
        url: "/usuario/web/redirecciona.php",
        data: {'dato': dataString},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'danger';
            var mensaje = mensajeExito;
            var refrescar = false;

            var json = JSON.parse(respuesta);
            var estado = json.estado;

            switch (estado) {
                case '0':
                    //Exito
                    tipo = 'success';
                    refrescar = true;
                    break;
                case '1':
                    mensaje = mensajeError;
                    break;
                case '2':
                    refrescar = true;
                    mensaje = "El usuario fúe alterado en otro proceso";
                    break;
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


function validaDatos($scope, accion) {
    if ($scope.aDato.nombre == null || $scope.nombre == '') {
        $.bootstrapGrowl(
                "Nombre Vacío",
                {
                    type: 'danger'
                });
        return false;
    }

    //Solo se valida si la accion es agregar
    if (accion == 0) {
        if ($scope.aDato.contrasena == null || $scope.aDato.contrasena == '') {
            $.bootstrapGrowl(
                    "Contraseña Vacía",
                    {
                        type: 'danger'
                    });
            return false;
        }
    }

    if ($scope.aDato.correo == null || $scope.correo == '') {
        $.bootstrapGrowl(
                "Correo Electrónico Vacío",
                {
                    type: 'danger'
                });
        return false;
    }

    if ($scope.aDato.rol == null || $scope.rol == '---Selecciona un Rol---') {
        $.bootstrapGrowl(
                "Indique el tipo de rol",
                {
                    type: 'danger'
                });
        return false;
    }
    return true;
}