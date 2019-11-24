<?php
    $Usuario_Oracle = "PRODERE";
    $Contraseña_de_usuario_Oracle="Prodere!01001100";
    $Host_de_Oracle = "localhost/orcl"; 
    $Charset = "AL32UTF8";
    $Conexion_a_la_base_de_datos_Oracle = oci_connect($Usuario_Oracle, $Contraseña_de_usuario_Oracle, $Host_de_Oracle, $Charset);
?>