function loginController($scope) {
    $scope.aDato = new Array();

    $scope.login = function () {
//        if (grecaptcha.getResponse() == null || grecaptcha.getResponse() == '') {
//        $.bootstrapGrowl("Complete el CAPTCHA", {type: 'danger'});
//        return;
//    }

        if ($scope.aDato.usuario == null || $scope.aDato.usuario == '') {
            $.bootstrapGrowl("Nombre de usuario vacío", {type: 'danger'});
            return;
        }

        if ($scope.aDato.contrasena == null || $scope.aDato.contrasena == '') {
            $.bootstrapGrowl("Contrasena vacía", {type: 'danger'});
            return;
        }

        $scope.aDato.push({'metodo': 'login', 'nombreUsuario': $scope.aDato.usuario,
            'correo': '', 'contrasena': $scope.aDato.contrasena, 'rol': '', 'activo': ''});

        var dataString = JSON.stringify($scope.aDato);

        $.ajax({
            url: "/usuario/web/redirecciona.php",
            data: {'dato': dataString},
            type: 'POST',
            success: function (respuesta) {
                var tipo = 'success';
                var mensaje = 'Usuario Correcto';

                try {
                    var json = JSON.parse(respuesta);
                    var estado = json.estado;

                    if (estado == 0) {
                        window.setTimeout("window.location.reload()", 500);
                    } else {
                        limpiaPantalla($scope);
                        tipo = 'danger';
                        mensaje = 'Usuario o contraseña incorrectos';
                    }
                } catch (e) {
                    tipo = 'danger';
                    mensaje = 'Usuario o contraseña incorrectos';
                    limpiaPantalla($scope);
                }

                $.bootstrapGrowl(mensaje, {type: tipo});
            },
            error: function () {
                $.bootstrapGrowl("Ocurrió un error en el servidor", {type: 'danger'});
            }
        });
    }

    $scope.recupera = function () {
        $("#enviarClaveAcceso").modal();
    }

    $scope.enviaCorreo = function () {
//        $("#recuperaContrasena").modal();
    }

}

function block() {
    $.blockUI({
        message: '<img src="../assets/img/user.png" id="user"/><br/><h3>Cargando...</h3>',
        css: {
            border: 'none',
            padding: '15px',
            backgroundColor: '#EFE4A8',
            '-webkit-border-radius': '10px',
            '-moz-border-radius': '10px',
            opacity: 0.6,
            color: '#000000'
        }
    });
}

function unBlock() {
    $.unblockUI();
}

function enviaDatos(mensajeExito, mensajeError, dataString) {
    $.ajax({
        url: "../../redirecciona.php",
        data: {'dato': dataString},
        type: 'POST',
        success: function (respuesta) {
            var tipo = 'success';
            var mensaje = mensajeExito;

            if (respuesta == 0) {
                window.setTimeout("window.location.reload()", 500);
            } else {
                tipo = 'danger';
                mensaje = mensajeError;
            }
            $.bootstrapGrowl(mensaje, {type: tipo});
        },
        error: function () {
            $.bootstrapGrowl("Ocurrió un error en el servidor", {type: 'danger'});
        }
    });

}


function limpiaPantalla($scope) {
    $scope.aDato.usuario = '';
    $scope.aDato.contrasena = '';
    $("#usuario").val("");
    $("#contrasena").val("");
}
