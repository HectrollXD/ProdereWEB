$(document).ready(funcionprincipal);

function funcionprincipal(){
    $('#buscar').keyup(ImprimirTabla);
    $('#btnbuscar').click(ImprimirTabla);
    $('#tabla').on('click','.btn-danger', eliminar);
}

function ImprimirTabla(){
    var datos = { 'buscar': $('#buscar').val() };
    $.ajax({
        type: 'POST',
        url: '../php/eliminar-libros-definitivamente.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function eliminar(){
    var datos = {
        'codigo': $(this).attr('value'),
        'contra': $('#contra').val()
    };
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
        $.ajax({
            type: 'POST',
            url: '../php/eliminar-libros-def.php',
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