$(document).ready(funcionPrincipal);
function funcionPrincipal() {
    $('#enviar').click(ejecutarAjax);
}
function ejecutarAjax(event) {
    var datosEnviados = {
        'usuario': $('#usuario').val(),
        'contra': $('#contra').val()
    };
    $.ajax({
        type: 'POST',
        url: '../php/verificar-inicio-de-sesion.php',
        data: datosEnviados,
        dataType: 'json',
        encode: true
    }).done(
        function (data){
            if(datosEnviados['usuario'] == "" || datosEnviados['contra'] == ""){
                if(datosEnviados['usuario'] == "")
                    $('#Respuestausuario').text("El espacio de usuario no debe de quedar vacío.");
                else
                    $('#Respuestausuario').text("");
                if(datosEnviados['contra'] == "")
                    $('#Respuestacontra').text("El espacio de contraseña no debe de quedar vacío.");
                else
                    $('#Respuestacontra').text("");
            }
            else{
                if(datosEnviados['usuario'].length < 5 || datosEnviados['contra'].length < 8){
                    if(datosEnviados['usuario'].length < 5)
                        $('#Respuestausuario').text("Este campo debe de contener mínimo 5 carácteres, actualmente estás utilizando "+datosEnviados['usuario'].length+".");
                    else
                        $('#Respuestausuario').text("");
                    if(datosEnviados['contra'].length < 8)
                        $('#Respuestacontra').text("Este campo debe de contener mínimo 8 carácteres, actualmente estás utilizando "+datosEnviados['contra'].length+"."); 
                    else
                        $('#Respuestacontra').text("");
                }
                else{
                    if(data.exito){
                        $(location).attr('href','registros.php');
                    }
                    else{
                        if(data.errores.usuario){
                            $('#Respuestausuario').text(data.errores.usuario);
                        }
                        else{
                            $('#Respuestausuario').text(' '); 
                        }
                        if(data.errores.contra){
                            $('#Respuestacontra').text(data.errores.contra);
                        }
                        else{
                            $('#Respuestacontra').text(' ');
                        }
                    }
                }
            }
        }
    );
    event.preventDefault();
}