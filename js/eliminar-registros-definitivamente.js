$(document).ready(funcionprincipal);

function funcionprincipal(){
    $('#buscar').keyup(ImprimirTabla);
    $('#ordenar').click(ImprimirTabla);
    $('.btn-danger').click(eliminar);
}

function ImprimirTabla(){
    var datos = {
        'buscar': $('#buscar').val(),
        'tabla': $('#prestamos').val()
    };
    $.ajax({
        type: 'POST',
        url: '../php/eliminar-registros-definitivamente.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            if(tabla == 'No hay registros por eliminar.'){
                $('.btn-danger').css('display','none');
            }
            else{
                $('.btn-danger').css('display','block');
            }
            $('#tabla').html(tabla);
        }
    );
}

function eliminar(){
    var datos = {
        'tabla': $('#prestamos').val(),
        'contra': $('#contra').val()
    };
    var mensaje = '';
    var error_de_validacion = false;
    if(datos['contra'] == ''){
        $('#rescontra').text('*Debes de confirmar la contraseña para eliminar.').css('color','red');
        $('#contra').focus();
        error_de_validacion = true;
    }
    else{
        $('#rescontra').text('Para eliminar algún alumno es necesario confirmar la contraseña.').css('color','black');
    }
    if(datos['contra'].length < 8 && datos['contra'] != ''){
        $('#rescontra').text('*La contraseña debe tener un mínimo de 8 caracteres.').css('color','red');
        $('#contra').val('').focus();
        error_de_validacion = true;
    }
    if(error_de_validacion == false){
        if(datos['tabla'] == 0){
            mensaje = '¿Estás seguro de eliminar todos los registros de los libros?';
        }
        else if(datos['tabla'] == 1){
            mensaje = '¿Estás seguro de eliminar todos los registros de las computadoras?';
        }
        else{
            mensaje = '¿Estás seguro de eliminar todos los registros de los libros?';
        }
        var con = confirm(mensaje);
        if(con){
            $.ajax({
                type: 'POST',
                url: '../php/eliminar-registros-def.php',
                data: datos,
                dataType: 'json',
                encode: true
            }).done(
                function(data){
                    if(data.exito){
                        alert(data.mensaje);
                        location.reload();
                    }
                    else{
                        $('#rescontra').text(data.errores.contra).css('color','red');
                        $('#contra').val('').focus();
                    }
                }
            );
        }
    }
}