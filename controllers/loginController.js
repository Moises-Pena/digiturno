function Login() {
     var usuariologin = document.getElementsByName('usuariologin')[0].value;
      var passwordlogin = document.getElementsByName('passwordlogin')[0].value;
    if(usuariologin == "" || usuariologin == null || usuariologin == undefined ||
    passwordlogin == "" || passwordlogin == null || passwordlogin == undefined){
        Swal.fire({
            title: 'Notificacion!',
            position: 'center',
            icon: 'info',
            text: 'Por Favor Ingrese Un Usuario Y una Contraseña',
            showConfirmButton: false,
            timer: 1500
        });
    } else {
        Swal.fire({
            title: 'Cargando',
        });
        Swal.showLoading();
        setTimeout(() => {
            $.ajax({
                method: 'POST',
                datatype: 'json',
                data: {
                    'accion': 'LoginUsuario',
                    'usuario': usuariologin,
                    'password': passwordlogin
                },
                url: '/digiturno/models/login.php',
            }).then(function (response) {
                var data = JSON.parse(response);
                if (data.codigo == 0) {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'success',
                        text:'Bienvenido '+data.mensaje,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    localStorage.setItem('usuario', data.usuario);
                    localStorage.setItem('servicio', data.servicio);
                    localStorage.setItem('modulo', data.modulo);
                    location.href = 'http://localhost/digiturno/views/inicio';
                } else if (data.codigo == 1){
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'error',
                        text: data.mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }else {
                    Swal.fire({
                        title: 'Notificacion!',
                        position: 'center',
                        icon: 'error',
                        text: data.mensaje,
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            });
        }, 1000);
    }
    }