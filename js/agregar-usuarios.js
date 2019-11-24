$(document).ready(FuncionPrincipal);


function FuncionPrincipal(){
    $('#agregar').click(EjecutarAjax);
}


function EjecutarAjax(event){
    var datosObtenidos = {
        'usuario': $('#usuario').val(),
        'correo': $('#correo').val(),
        'contra': $('#contra').val(),
        'contra2': $('#contra2').val()
    };
    var error_de_validacion = false;
    var validar_correos = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

    if(datosObtenidos['usuario'] == ""){
        $('#Respuestausuario').text("El campo usuario no debe quedar vacío.");
        error_de_validacion = true;
    }else{
        $('#Respuestausuario').text('');
    }
    if(datosObtenidos['correo'] == ""){
        $('#Respuestacorreo').text("El campo correo no debe quedar vacío.");
        error_de_validacion = true;
    }else{
        $('#Respuestacorreo').text('');
    }
    if(datosObtenidos['contra'] == ""){
        $('#Respuestacontra').text("El campo de la contraseña no debe quedar vacío.");
        error_de_validacion = true;
    }else{
        $('#Respuestacontra').text('');
    }
    if(datosObtenidos['contra2'] == ""){
        $('#Respuestacontra2').text("El campo de confirmar la contraseña no debe quedar vacío.");
        error_de_validacion = true;
    }else{
        $('#Respuestacontra').text('');
    }
    if(datosObtenidos['usuario'].length < 5 && datosObtenidos['usuario'] != ""){
        $('#Respuestausuario').text("El nombre de usuario debe de tener como mínimo 5 caracteres, actualmente estás utilizando "+datosObtenidos['usuario'].length+" caracteres.");
        $('#usuario').val('').focus();
        error_de_validacion = true;
    }
    if(validar_correos.test(datosObtenidos['correo']) == false && datosObtenidos['correo'] != ""){
        $('#Respuestacorreo').text("El dato ingresado no es una dirección de correo electrónico válido.");
        $('#correo').val('').focus();
        error_de_validacion = true;
    }
    if(datosObtenidos['contra'].length < 8 && datosObtenidos['contra'] != ""){
        $('#Respuestacontra').text("La contraseña debe de tener como mínimo 8 caracteres, actualmente estás utilizando "+datosObtenidos['contra'].length+" caracteres.");
        $('#contra').val('').focus();
        error_de_validacion = true;
    }
    if(datosObtenidos['contra2'].length < 8 && datosObtenidos['contra2'] != ""){
        $('#contra2').val('');
        error_de_validacion = true;
    }
    if(datosObtenidos['contra'] != datosObtenidos['contra2']){
        $('#Respuestacontra2').text("La contraseña de confirmacion no es igual a la contraseña ingresada.");
        $('#contra2').val('').focus();
        error_de_validacion = true;
    }else{
        $('#Respuestacontra2').text("");
    }
    if(error_de_validacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/agregar-usuarios.php',
            data: datosObtenidos,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                if(data.exito){
                    alert(data.mensaje);
                    $(location).attr('href','registros.php');
                }
                else{
                    if(data.errores.usuario){
                        $('#Respuestausuario').text(data.errores.usuario);
                        $('#usuario').val('').focus();
                    }
                    if(data.errores.correo){
                        $('#Respuestacorreo').text(data.errores.correo);
                        $('#correo').val('').focus();
                    }
                }
            }
        );
    }
    event.preventDefault();
}