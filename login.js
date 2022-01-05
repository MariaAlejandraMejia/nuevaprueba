/* obtiene la contraseña de los puntos */
   var login = document.getElementById('login');
    login.addEventListener('submit', function nuevo(e){
        e.preventDefault();
        var datos = new FormData(login);
        var pass = datos.get('contraseña');
    }) 
    
function revisarusuario(){

    var usuario = $('#usuario').textbox('getText');
    console.log(usuario);
    if(usuario.length === 0){
        console.log("el usuario es vacio"); 
        $.messager.alert('El Usuario esta Vacio','por favor ingrese un usuario antes de ingresar'); 
        respuesta =0;
    }else{
        console.log("el usuario es: ",usuario);
        respuesta =1;
    }
    return respuesta;
}

function revisarcontraseña(){
    var contraseña = $('#contraseña').textbox('getText');
    console.log(contraseña);
    if(contraseña.length === 0){
        console.log("el contraseña es vacio"); 
        $.messager.alert('La contraseña esta Vacia','por favor ingrese una contraseña antes de ingresar'); 
        respuesta =0;
    }else{
        console.log("La contraseña es: ",contraseña);
        respuesta =1;
    }
    return respuesta;
}

var myFuncCalls = 0;
console.log(myFuncCalls);

function validar(){
    var login = document.getElementById('login');
    var datos = new FormData(login);
    var pass = datos.get('contraseña');
    
    console.log(pass);
    
    var usuario=revisarusuario();
    console.log(usuario);
    var contraseña=revisarcontraseña();
    console.log(contraseña);
    var usuariotext = $('#usuario').textbox('getText');

    if(usuario==1 && contraseña ==1){
        console.log('inicia validacion')
        
        $.ajax({
            url: 'http://localhost:3000/usuario/obtener/numerodeusuarioncoincide/'+ usuariotext,
            type: 'GET',
            async: false,
            cache: false,
            success: function (respuesta) {
            console.log(respuesta);
            usuarioexiste = respuesta.usuariocoincide;
            console.log('prueba',usuarioexiste);
            },
            error: function (respuesta) {
            console.log('fallo obtenerUsuarioSesion');
            }
            });
        if(usuarioexiste==1){
            if(myFuncCalls <3){
                $.ajax({
                    url: 'http://localhost:3000/usuario/obtener/numerodepasswordcoincide/'+usuariotext+'/'+pass,
                    type: 'GET',
                    async: false,
                    cache: false,
                    success: function (respuesta) {
                    console.log(respuesta);
                    pass = respuesta.usuariocoincide;
                    console.log('prueba',pass);
                    },
                    error: function (respuesta) {
                    console.log('fallo obtenerUsuarioSesion');
                    }
                    });
                if(pass== 1){
                    $.ajax({
                        url: 'http://localhost:3000/usuario/obtener/idUsuario/'+ usuariotext,
                        type: 'GET',
                        async: false,
                        cache: false,
                        success: function (respuesta) {
                        console.log(respuesta);
                        ID_USUARIO = respuesta.ID_USUARIO;
                        console.log('prueba',ID_USUARIO);
                        },
                        error: function (respuesta) {
                        console.log('fallo obtenerUsuarioSesion');
                        }
                        });
                        $.ajax({
                            url: 'http://localhost:3000/usuario/obtener/TIPOUUSUARIO/'+ ID_USUARIO,
                            type: 'GET',
                            async: false,
                            cache: false,
                            success: function (respuesta) {
                            console.log(respuesta);
                            ID_TIPO_US = respuesta.ID_TIPO_US;
                            console.log('prueba',ID_TIPO_US);
                            },
                            error: function (respuesta) {
                            console.log('fallo obtenerUsuarioSesion');
                            }
                            });
                            if(ID_TIPO_US==1){
                                window.location.href ="http://localhost:81/login/admin.php";
                                console.log('ingreso como administrador')
                            }else if(ID_TIPO_US==2){
                                
                                window.location.href ="http://localhost:81/login/operador.php";
                                console.log('ingreso como operador')
                            }else{
                                
                                window.location.href ="http://localhost:81/login/invitado.php";
                                console.log('ingreso como invitado')
                            }

                }else{
                    myFuncCalls++;
                    console.log('intento no: ',myFuncCalls);
                    $.messager.alert('Contraseña Incorecta','La contraseña es incorrecta para este usuario por favor revise');
                }
            }else{
                $.ajax({
                    url: 'http://localhost:3000/usuario/obtener/idUsuario/'+ usuariotext,
                    type: 'GET',
                    async: false,
                    cache: false,
                    success: function (respuesta) {
                    console.log(respuesta);
                    ID_USUARIO = respuesta.ID_USUARIO;
                    console.log('prueba',ID_USUARIO);
                    },
                    error: function (respuesta) {
                    console.log('fallo obtenerUsuarioSesion');
                    }
                    });
                    $.ajax({
                        url: 'http://localhost:3000/usuario/editar/bloquear/'+ ID_USUARIO,
                        type: 'GET',
                        async: false,
                        cache: false,
                        success:
                        console.log('Usuario Bloqueado satisfatoriamente'),
                        error: function (respuesta) {
                        console.log('fallo bloquear usuario');
                        }
                        });
                
                $.messager.alert('Bloque de usuario','El usuario ha sido boqueao, Pida ayuda al usuario Administrador para desbloquearo');
            }
        }else{
            $.messager.alert('El Usuario inexistente','Elusuario ingresado no existe en la base de datos por favor compruebe'); 
        }
    }else{
        console.log('hubo un error') 
    }
    
}




    