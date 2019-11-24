$(document).ready(funcionPrincipal);

function funcionPrincipal(){
    $('#guardar').click(validar);
    $('#limpiar').click(
        function(){
            $('#titulo').val('');
            $('#editorial').val('');
            $('#ejemplar').val('');
            $('#codigo').val('');
            $('#restitulo').text('');
            $('#reseditorial').text('');
            $('#resejemplar').text('');
            $('#rescodigo').text('');
        }
    );
}

function validar(){
    var datos = {
        'titulo': $('#titulo').val(),
        'editorial': $('#editorial').val(),
        'ejemplar': $('#ejemplar').val(),
        'codigo': $('#codigo').val()
    };
    var error_de_validacion = false;
    var verificar_campos_numericos = /^[0-9-]+$/;
    var verificar_codigo = /^[0-9A-Z]+$/;

    if(datos['titulo'] == ''){
        $('#restitulo').text('El campo del título no puede quedar vacío.').css('color','red');
        error_de_validacion = true;
    }
    else{
        $('#restitulo').text('');
    }

    if(datos['editorial'] == ''){
        $('#reseditorial').text('El campo del editorial no puede quedar vacío.').css('color','red');
        error_de_validacion = true;
    }
    else{
        $('#reseditorial').text('');
    }

    if(datos['ejemplar'] == ''){
        $('#resejemplar').text('El campo del ejemplar no puede quedar vacío.').css('color','red');
        error_de_validacion = true;
    }
    else{
        $('#resejemplar').text('');
    }

    if(datos['codigo'] == ''){
        $('#rescodigo').text('El campo del código no puede quedar vacío.').css('color','red');
        error_de_validacion = true;
    }
    else{
        $('#rescodigo').text('');
    }

    if(!verificar_campos_numericos.test(datos['ejemplar']) && datos['ejemplar'] != '' ){
        $('#resejemplar').text('El campo del ejemplar solo admite datos numéricos.').css('color','red');
        error_de_validacion = true;
    }
    if(!verificar_codigo.test(datos['codigo']) && datos['codigo'] != '' ){
        $('#rescodigo').text('El campo del código solo admite letras y numeros.').css('color','red');
        error_de_validacion = true;
    }
    if(error_de_validacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/agregar-libros.php',
            data: datos,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                if(data.exito){
                    alert(data.mensaje);
                    $('#titulo').val('');
                    $('#editorial').val('');
                    $('#ejemplar').val('');
                    $('#codigo').val('');
                    $('#restitulo').text('');
                    $('#reseditorial').text('');
                    $('#resejemplar').text('');
                    $('#rescodigo').text('');
                }
                else{
                    if(data.errores.codigo){
                        $('#rescodigo').text(data.errores.codigo).css('color','red');
                        $('#codigo').focus().val('');
                    }
                    if(data.errores.insersion){
                        alert(data.errores.insersion);
                    }
                }
            }
        );
    }
}