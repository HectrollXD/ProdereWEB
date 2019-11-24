$(document).ready(funcionprincipal);

var id1 = 0;
var id2 = 0;

function funcionprincipal(){
    $('#buscar').keyup(ejecutarAjax);
    $('#btnbuscar').click(ejecutarAjax);
    $('#btneliminar').click(borrarRegistros);
    $('#reporte-libros').click(reportel);
    $('#reporte-compus').click(reportec);
}

function ejecutarAjax(){
    var datos = {
        'buscar': $('#buscar').val(),
        'mostrar': $('#prestamos').val(),
        'status': $('#estatus').val(),
        'ordenar': $('#ordenar').val()
    }

    $.ajax({
        type: 'POST',
        url: '../php/registros.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(data){
            $('#tabla').html(data);
        }
    );
}


function borrarRegistros(){
    var datos = {
        'idinicial': $('#idinicial').val(),
        'idfinal': $('#idfinal').val(),
        'confirmacion': $('#verificar').val(),
        'nomreg': $('#nomreg').val()
    };
    var error_de_validacion = false;
    var validarid = /^[0-9]+$/;
    if(datos['confirmacion'] == ''){
        $('#respuesta').text('*Para eliminar losregistros es necesario introducir tu contraseña.');
        $('#verificar').focus();
        error_de_validacion = true;
    }
    else{
        $('#respuesta').text('');
    }
    if(datos['confirmacion'].length < 8 && datos['confirmacion'] != ""){
        $('#respuesta').text('*Este campo requiere por lo mínimo 8 carácteres.');
        $('#verificar').focus();
        error_de_validacion = true;
    }

    if(datos['idinicial'] == '' || datos['idfinal'] == '' ){
        $('#respuestaid').text('Los campos no pueden quedar vacíos.').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    else{
        $('#respuestaid').text('');
    }
    if( ( ! validarid.test(datos['idinicial']) || ! validarid.test(datos['idfinal']) ) && datos['idinicial'] != '' && datos['idfinal'] != '' ){
        $('#respuestaid').text('Los campos solo admite datos numéricos.').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    if(datos['idinicial'] > datos['idfinal'] && ( datos['idinicial'] != '' && datos['idfinal'] != '' )){
        $('#respuestaid').text('El número de registro final debe de ser mayor o igual al número de registro inicial.').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    if(id1<=0 && id2 <=0){
        $('#respuestaid').text('No hay mas registros por eliminar').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    if(datos['idinicial'] < id1){
        $('#respuestaid').text('El numero de registro inicial debe ser mayor o igual a '+id1+'.').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    if(datos['idfinal'] > id2){
        $('#respuestaid').text('El numero de registro final debe ser menor o igual a '+id2+'.').css('color','red');
        error_de_validacion = true;
        goto: errores;
    }
    errores:
    if(error_de_validacion == false){
        $.ajax({
            type: 'POST',
            url: '../php/eliminar-registros.php',
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


function vernumreg(){
    var dato = {'tabla': $('#nomreg').val()};
    $.ajax({
        type: 'POST',
        url: '../php/numreg.php',
        data: dato,
        dataType: 'json',
        encode: true
    }).done(
        function(data){
            id1 = data.min;
            id2 = data.max;
        }
    );
}

function reportel(){
    window.location = 'reporte-de-prestamos-de-libros.php';
}

function reportec(){
    window.location = 'reporte-de-prestamos-de-computadoras.php';
}