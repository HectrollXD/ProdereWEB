$(document).ready(funcionprincipal);


function funcionprincipal(){
    $('#buscar').keyup(funcionBuscar);
    $('#btnordenar').click(funcionBuscar);
    $('#ordenar0').click(funcionBuscar);
    $('#ordenar1').click(funcionBuscar);
    $('#ordenar2').click(funcionBuscar);
    $('#ordenar3').click(funcionBuscar);
    $('#tabla').on('click','.btn-danger',funcionBorrar);
}

function funcionBuscar(){
    var datos={
        'buscar': $('#buscar').val(),
        'ordenar': $('#ordenar').val()
    };
    $.ajax({
        type: 'POST',
        url: '../php/eliminar-usuarios-mostrar.php',
        data: datos,
        dataType: 'html'
    }).done(
        function(data){
            $('#tabla').html(data);
        }
    );
}

function funcionBorrar(){
    var ususario_a_eliminar = {'usuario_eliminar': $(this).attr('value')};
    var eliminar = confirm('¿Estás seguro de eliminar al usuario '+ususario_a_eliminar['usuario_eliminar']+'?');
    if(eliminar == true){
        $.ajax({
            type: 'POST',
            url: '../php/eliminar-usuarios.php',
            data: ususario_a_eliminar,
            dataType: 'json',
            encode: true
        }).done(
            function(data_eliminar){
                if(data_eliminar.exito){
                    alert(data_eliminar.mensaje);
                    funcionBuscar();
                }
                else{
                    alert(data_eliminar.mensaje);
                    funcionBuscar();
                }
            }
        );
    }
}