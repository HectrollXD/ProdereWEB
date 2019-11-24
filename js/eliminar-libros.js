$(document).ready(FuncionPrincipal);

var codigo;

function FuncionPrincipal(){
    $('#buscar').keyup(buscar);
    $('#tabla').on('click','.btn-danger', eliminar);
    $('#eliminar').click(validarparaeliminar);
    $('#cancelar').click(
        function(){
            $('.eliminar').css('display','none');
            $('#tabla').css('display','block');
            $('#contra').val('');
            $('#rescontra').text('Introduce la contraseña para eliminar.').css('color','black');
        }
    );
}

function buscar(){
    var datos = {
        'buscar': $('#buscar').val(),
        'ordenar': $('#ordenar').val()
    }
    $.ajax({
        type: 'POST',
        url: '../php/eliminar-libros-mostrar.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function eliminar(){
    $('.eliminar').css('display','block');
    $('#tabla').css('display','none');
    codigo = $(this).attr('value');
}

function validarparaeliminar(){
    var datos_para_eliminar = {
        'contra': $('#contra').val(),
        'codigo': codigo
    };
    var error_de_validacion = false;
    if(datos_para_eliminar['contra'] == ''){
        $('#rescontra').text('Este campo no puede quedar vacío.').css('color','red');
        $('#contra').focus();
        error_de_validacion = true;
    }
    else{
        $('#rescontra').text('Introduce la contraseña para eliminar.').css('color','black');
    }
    if(error_de_validacion == false){
        var confirmacion = confirm('¿Estás seguro de eliminar el libro con el código '+datos_para_eliminar['codigo']+'?');
        if(confirmacion == true){
            $.ajax({
                type: 'POST',
                url: '../php/eliminar-libros.php',
                data: datos_para_eliminar,
                dataType: 'json',
                encode: true
            }).done(
                function(datos_de_eliminacion){
                    if(datos_de_eliminacion.exito){
                        alert(datos_de_eliminacion.mensaje);
                        location.reload();
                    }
                    else{
                        $('#rescontra').text(datos_de_eliminacion.errores.contra).css('color','red');
                    }
                }
            );
        }
        else{
            $('.eliminar').css('display','none');
            $('#tabla').css('display','block');
            $('#contra').val('');
            $('#rescontra').text('Introduce la contraseña para eliminar.').css('color','black');
        }
    }
}