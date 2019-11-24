$(document).ready(funcionPrincipal);

function funcionPrincipal(){
    $('#buscar').keyup(ImprimirTabla);
    $('btnbuscar').click(ImprimirTabla);
    $('#tabla').on('click','.btn-success',Recuperar);
}

function ImprimirTabla(){
    var datos = { 'busqueda': $('#buscar').val() };
    $.ajax({
        type: 'POST',
        url: '../php/recuperar-libros-eliminados.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}

function Recuperar(){
    var codigo = { 'codigo': $(this).attr('value') };
    $.ajax({
        type: 'POST',
        url: '../php/recuperar-libros.php',
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