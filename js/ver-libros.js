$(document).ready(funcionPrincipal);

function funcionPrincipal(){
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
        url: '../php/ver-libros.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(tabla){
            $('#tabla').html(tabla);
        }
    );
}