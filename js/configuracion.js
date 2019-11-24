$(document).ready(funcionprincipal);

function funcionprincipal() {
    $('#btncambiar').click(cambiarcontraseña);
    $('#eliminar').click(funcionborrar);
}

function cambiarcontraseña(){
    var datos = {
        'concontra': $('#concontra').val(),
        'contra': $('#contra').val(),
        'contra2': $('#contra2').val()
    };
    var errores = false;
    if(datos['concontra']==''){
        $('#respuestaconcontra').text('Para cambiar la contraseña del usuario es necesario colocar tu contraseña actual.');
        errores = true;
    }else
        $('#respuestaconcontra').text('');

    if(datos['contra']==''){
        $('#respuestacontra').text('Este espacio no puede quedar vacío.');
        errores = true;
    }else
        $('#respuestacontra').text('');

    if(datos['contra2']==''){
        $('#respuestacontra2').text('Este espacio no puede quedar vacío.');
        errores = true;
    }else
        $('#respuestacontra2').text('');
    
    if(datos['concontra'].length < 8 && datos['concontra']!=''){
        $('#respuestaconcontra').text('La contraseña debe de tener como mínimio 8 caracteres, actualmente estás utilizando '+datos['contra'].length+' caracteres.');
        errores = true;
    }
    
    if(datos['contra'].length < 8 && datos['contra']!=''){
        $('#respuestacontra').text('La contraseña debe de tener como mínimio 8 caracteres, actualmente estás utilizando '+datos['contra'].length+' caracteres.');
        errores = true;
    }
    
    if(datos['contra'] != datos['contra2']){
        $('#respuestacontra2').text('La contraseña de confirmación no coincide con la contraseña introducida.');
        errores = true;
    }

    if(errores == false){
        $.ajax({
            type: 'POST',
            url: '../php/configuracion.php',
            data: datos,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                if(data.exito == true){
                    alert(data.mensaje);
                    location.reload();
                }
                else{
                    $('#respuestaconcontra').text(data.errores.concontra);
                }
            }
        );
    }
}

function funcionborrar(){
    var eliminar={
        'contraeliminar': $('#confirmar').val()
    };

    if(eliminar['contraeliminar'] == ''){
        $('#confirmarlbl').css('display', 'block');
        $('#confirmar').css('display', 'block');
    }
    else{
        $.ajax({
            type: 'POST',
            url: '../php/configuracion-eliminar.php',
            data: eliminar,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                if(data.exito == true){
                    alert(data.mensaje);
                    location.reload();
                }
                else{
                    $('#confirmarlbl').css('color', 'red');
                    $('#confirmarlbl').text(data.errores.contra);
                }
            }
        );
    }
}