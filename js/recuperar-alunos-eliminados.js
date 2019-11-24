$(document).ready(funcionPrincipal);

function funcionPrincipal(){
    $('#buscar').keyup(ImprimirTabla);
    $('#btnbuscar').click(ImprimirTabla);
    $('#tabla').on('click','.btn-success',recuperar);
}

function ImprimirTabla(){
    var datos = { 'buscar': $('#buscar').val() };
    $.ajax({
        type: 'POST',
        url: '../php/recuperar-alumnos-eliminados.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function recuperar(){
    var codigo = {'codigo': $(this).attr('value')};
    $.ajax({
        type: 'POST',
        url: '../php/recuperar-alumnos.php',
        data: codigo,
        dataType: 'json',
        encode: true
    }).done(
        function(data){
            if(data.exito){
                alert(data.mensaje);
                location.reload();
            }
            else{
                alert(data.errores.update);
            }
        }
    );
}