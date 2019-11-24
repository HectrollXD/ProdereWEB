<?php
    $Host_de_la_base_de_datos_MySQL = "localhost";
    $Usuario_de_la_base_de_datos_MySQL = "root";
    $Contrasenia_de_la_base_de_datos_MySQL = "";
    $Tabla_de_la_base_de_datos_MySQL = "PRODERE";

    $Conexion_a_la_base_de_datos_MySQL = mysqli_connect(
        $Host_de_la_base_de_datos_MySQL,
        $Usuario_de_la_base_de_datos_MySQL,
        $Contrasenia_de_la_base_de_datos_MySQL,
        $Tabla_de_la_base_de_datos_MySQL
    )
    or die(
        "<h3>No se puede conectar a la base de datos de MySQL</h3>"
    );
?>