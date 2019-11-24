$(document).ready(funcionprincipal);

function funcionprincipal(){
    $('#buscar').keyup(ImprimirTabla);
    $('#ordenar').click(ImprimirTabla);
    $('#tabla').on('click','.btn-success',recuperar);
}

function ImprimirTabla(){
    var datos = {
        'tabla': $('#prestamos').val(),
        'buscar': $('#buscar').val()
    };
    $.ajax({
        type: 'POST',
        url: '../php/recuperar-registros-eliminados.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function recuperar(){
    var datos = {
        'numreg': $(this).attr('value'),
        'tabla': $('#prestamos').val()
    };
    $.ajax({
        type: 'post',
        url: '../php/recuperar-registros.php',
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
                if(data.errores.tabla){
                    alert(data.errores.tabla);
                }
                if(data.errores.update){
                    alert(data.errores.update);
                }
            }
        }
    );
}