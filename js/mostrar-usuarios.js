$(document).ready(FuncionPrincipal);

function FuncionPrincipal(){
    $('#buscar').keyup(ejecutarajax);
    $('#btnordenar').click(ejecutarajax);
    $('#ordenar0').click(ejecutarajax);
    $('#ordenar1').click(ejecutarajax);
    $('#ordenar2').click(ejecutarajax);
    $('#ordenar3').click(ejecutarajax);
}

function ejecutarajax(){
    var datos={
        'buscar': $('#buscar').val(),
        'ordenar': $('#ordenar').val()
    };
    //alert(typeof(datos.ordenar));
    $.ajax({
        type: 'POST',
        url: '../php/mostrar-usuarios.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(data){
            $('#tabla').html(data);
        }
    );
}