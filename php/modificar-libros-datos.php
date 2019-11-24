<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $codigo = $_POST['codigo'];
        $datos = array();
        $Consulta = "SELECT * FROM LIBROS WHERE CODIGO_DE_LIBRO = '$codigo'";
        $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
        oci_execute($Query);
        while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
            $datos['codigolibro'] = $rows[0];
            $datos['titulo'] = ucwords(strtolower($rows[1]));
            $datos['editorial'] = $rows[2];
            $datos['ejemplar'] = $rows[3];
        }
        echo json_encode($datos);
    }
    else{
        header('Location: ../index.php');
    }
?>