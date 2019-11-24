$(document).ready(funcionprincipal);

var cod1 = 0, cod2 = 0;


function funcionprincipal(){
    $('#btneliminar').click(existencia, eliminar);
    $('#buscar').keyup(ejecutarajax);
    $('#btnordenar').click(ejecutarajax);
}

function ejecutarajax(){
    var datos = {
        'buscar': $('#buscar').val(),
        'ordenar': $('#ordenar').val()
    }
    $.ajax({
        type: 'POST',
        url: '../php/ver-alumnos.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function existencia(){
    var datos = {'contra': $('#verificar').val() };
    $.ajax({
        type: 'POST',
        url: '../php/numcod.php',
        data: datos,
        dataType: 'json',
        encode: true
    }).done(
        function(data){
            cod1 = data.min;
            cod2 = data.max;
        }
    );
}

function eliminar(){
    var datos = {
        'codini': $('#codinicial').val(),
        'codfin': $('#codfinal').val(),
        'contra': $('#verificar').val()
    }
    var error_de_validacion = false;
    var verificar_codigos = /^[0-9]+$/;
    if(datos['codini'] == '' || datos['codfin'] == ''){
        $('#respuestacod').text('Los campos de los códigos no pueden quedar vacíos.').css('color', 'red');
        if(datos['codini'] == ''){
            $('#codinicial').focus();
        }
        else if(datos['codfin'] == ''){
            $('#codfinal').focus();
        }
        error_de_validacion = true;
        goto: error;
    }
    else{
        $('#respuestacod').text('').css('color', 'red');
    }
    if(datos['codini'].length < 9 || datos['codfin'].length < 9 ){
        $('#respuestacod').text('Los campos de los códigos deben de llevar como mínimo 9 caracteres.').css('color', 'red');
        if( datos['codini'].length < 9 ){
            $('#codinicial').focus();
        }
        else if( datos['codfin'].length < 9 ){
            $('#codfinal').focus();
        }
        error_de_validacion = true;
        goto: error;
    }
    if( !verificar_codigos.test(datos['codini']) || !verificar_codigos.test(datos['codfin']) ){
        $('#respuestacod').text('Los campos de los códigos solo admiten datos numéricos.').css('color', 'red');
        if(!verificar_codigos.test(datos['codini'])){
            $('#codinicial').focus();
        }
        else if(!verificar_codigos.test(datos['codfin'])){
            $('#codfinal').focus();
        }
        error_de_validacion = true;
        goto: error;
    }
    if(datos['codfin'] < datos['codini']){
        $('#respuestacod').text('El segundo código debe de ser mayor o igual al primer código.').css('color', 'red');
        $('#codfinal').focus();
        error_de_validacion = true;
        goto: error;
    }
    if(cod1<=0 && cod2 <=0){
        $('#respuestacod').text('No hay mas registros por eliminar.').css('color','red');
        error_de_validacion = true;
        goto: error;
    }
    if(datos['codini'] < cod1){
        $('#respuestacod').text('El código inicial debe de ser mayor o igual al código '+cod1+'.').css('color', 'red');
        $('#codinicial').focus().val('');
        error_de_validacion = true;
        goto: error;
    }
    if(datos['codfin'] > cod2){
        $('#respuestacod').text('El código final debe de ser menor o igual al código '+cod2+'.').css('color', 'red');
        $('#codfinal').focus().val('');
        error_de_validacion = true;
        goto: error;
    }
    if(datos['contra'] == ""){
        $('#respuesta').text('Ingresa la contraseña para eliminar.').css('color', 'red');
        error_de_validacion = true;
        goto: error;
    }
    else{
        $('#respuesta').text('');
    }
    error:
    if(error_de_validacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/eliminar-alumnos.php',
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
                    $('#respuesta').text(data.errores.contra);
                    $('#verificar').val('').focus();
                }
            }
        );
    }
}