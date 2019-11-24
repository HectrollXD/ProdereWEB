$(document).ready(funcionPrincipal);

function funcionPrincipal(){
    $('#buscar').keyup(ejecutarAjax);
    $('#btnordenar').click(ejecutarAjax);
    $('#tabla').on('click','.btn-warning', modificar);
    $('#cancelar').click(
        function(){
            $('.barra-de-busqueda').css('display','block');
            $('#tabla').css('display', 'block');
            $('#mod').css('display', 'none');
            $('#codigo').val('');
            $('#carrera').val('');
            $('#nombres').val('');
            $('#apellidop').val('');
            $('#apellidom').val('');
        }
    );
    $('#modificar').click(guardarcambios);
}

function ejecutarAjax(){
    var datos = {
        'buscar': $('#buscar').val(),
        'ordenar': $('#ordenar').val()
    };
    $.ajax({
        type: 'POST',
        url: '../php/modificar-libros-mostrar.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(data){
            $('#tabla').html(data);
        }
    );
}

function modificar(){
    var codigo = {'codigo': $(this).attr('value')};
    var modifi = confirm('¿Estás seguro de modificar al alumno con el código '+codigo['codigo']+'?');
    if(modifi == true){
        $.ajax({
            type: 'POST',
            url: '../php/modificar-libros-datos.php',
            data: codigo,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                $('.barra-de-busqueda').css('display','none');
                $('#tabla').css('display', 'none');
                $('#mod').css('display', 'block');
                $('#restitulo').text('');
                $('#reseditorial').text('');
                $('#resejemplar').text('');
                $('#titulo').val(data.titulo);
                $('#editorial').val(data.editorial);
                $('#ejemplar').val(data.ejemplar).attr('disabled', 'true');
                $('#codigo').val(data.codigolibro).attr('disabled', 'true');
            }
        );
    }
}

function guardarcambios(){
    var error_de_verificacion = false;
    var datos = {
        'titulo': $('#titulo').val(),
        'editorial': $('#editorial').val(),
        'codigo': $('#codigo').val(),
        'contra': $('#contra').val()
    };
    
    if(datos['titulo'] == ''){
        $('#restitulo').text('El campo del título no puede quedar vacío.').css('color','red');
        error_de_verificacion = true;
    }
    else{
        $('#restitulo').text('');
    }

    if(datos['editorial'] == ''){
        $('#reseditorial').text('El campo del editorial no puede quedar vacío.').css('color','red');
        error_de_verificacion = true;
    }
    else{
        $('#reseditorial').text('');
    }

    if(datos['contra'] == ''){
        $('#rescontra').text('Es necesario colocar la contraseña antes de modificar un alumno.').css('color','red');
        error_de_verificacion = true;
    }
    else{
        $('#rescontra').text('');
    }
    if(error_de_verificacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/modificar-libros.php',
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
                    $('#rescontra').text(data.errores.contra);
                    $('#contra').val('').focus();
                }
            }
        );
    }
}