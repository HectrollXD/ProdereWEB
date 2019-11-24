$(document).ready(funcionPrincipal);

function funcionPrincipal(){
    $('#guardar').click(verificar);
    $('#limpiar').click(
        function(){
            $('#nombres').val('');
            $('#apellidop').val('');
            $('#apellidom').val('');
            $('#codigo').val('');
            $('#repuestaapellido').text('');
            $('#repuestanombres').text('');
            $('#repuestacodigo').text('');
        }
    );
}

function verificar(){
    var error_de_verificacion = false;
    var verificar_campos_numericos = /^[0-9]+$/;
    var verificar_campos_alfanumericos = /^[A-Za-zÑñ\s]+$/;
    var datos = {
        'nombres': $('#nombres').val(),
        'apellidop': $('#apellidop').val(),
        'apellidom': $('#apellidom').val(),
        'codigo': $('#codigo').val(),
        'carrera': $('#carrera').val(),
    };
    if(datos['apellidop'] == ''){
        $('#repuestaapellido').text('El campo del apellido paterno no puede quedar vacío.').css('color', 'red');
        $('#apellidop').focus();
        error_de_verificacion = true;
        goto: error;
    }
    else{
        $('#repuestaapellido').text('');
    }
    if(datos['apellidom'] == ''){
        $('#repuestaapellido').text('El campo del apellido materno no puede quedar vacío.').css('color', 'red');
        $('#apellidom').focus();
        error_de_verificacion = true;
        goto: error;
    }
    else{
        $('#repuestaapellido').text('');
    }
    if(datos['nombres'] == ''){
        $('#repuestanombres').text('El campo de el/los nombre(s) no puede quedar vacío.').css('color', 'red');
        $('#nombres').focus();
        error_de_verificacion = true;
        goto: error;
    }
    else{
        $('#repuestanombres').text('');
    }
    if(datos['codigo'] == ''){
        $('#repuestacodigo').text('El campo del código del alumno no debe de quedar vacío.').css('color', 'red');
        $('#codigo').focus();
        error_de_verificacion = true;
        goto: error;
    }
    else{
        $('#repuestacodigo').text('');
    }

    if(!verificar_campos_alfanumericos.test(datos['apellidop'])){
        $('#repuestaapellido').text('El campo del apellido paterno no admite números, letras con tildes ni caracteres especiales.').css('color', 'red');
        $('#apellidop').focus().val('');
        error_de_verificacion = true;
        goto: error;
    }
    if(!verificar_campos_alfanumericos.test(datos['apellidom'])){
        $('#repuestaapellido').text('El campo del apellido materno no admite números, letras con tildes ni caracteres especiales.').css('color', 'red');
        $('#apellidom').focus().val('');
        error_de_verificacion = true;
        goto: error;
    }
    if(!verificar_campos_alfanumericos.test(datos['nombres'])){
        $('#repuestanombres').text('El campo de/los nombre(s) no admite números, letras con tildes ni caracteres especiales.').css('color', 'red');
        $('#nombres').focus().val('');
        error_de_verificacion = true;
        goto: error;
    }
    if(!verificar_campos_numericos.test(datos['codigo'])){
        $('#repuestacodigo').text('El campo del código del estudiante solo admite números.').css('color', 'red');
        $('#codigo').focus().val('');
        error_de_verificacion = true;
        goto: error;
    }
    if(datos['codigo'].length < 9 ){
        $('#repuestacodigo').text('El campo del código debe de llevar mínimo 9 caracteres.').css('color', 'red');
        $('#codigo').focus().val('');
        error_de_verificacion = true;
        goto: error;
    }

    error:
    if(error_de_verificacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/agregar-alumnos.php',
            data: datos,
            dataType: 'json',
            encode: true
        }).done(
            function(data){
                if(data.exito){
                    alert(data.mensaje);
                    $('#nombres').val('');
                    $('#apellidop').val('');
                    $('#apellidom').val('');
                    $('#codigo').val('');
                    $('#repuestaapellido').text('');
                    $('#repuestanombres').text('');
                    $('#repuestacodigo').text('');
                }
                else{
                    if(data.errores.codigo){
                        $('#repuestacodigo').text(data.errores.codigo).css('color', 'red');
                        $('#codigo').focus();
                    }
                    if(data.errores.fallo){
                        alert(data.errores.fallo);
                    }
                }
            }
        );
    }
}