<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $tabla = $_POST['tabla'];
        $min = 0;
        $max = 0;
        $iterador = 0;
        $datos = array();
        if($tabla == 'libros'){
            $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS ORDER BY NUMERO_DE_PRESTAMO_DE_LIBRO ASC";
        }
        else if($tabla == 'computadoras'){
            $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE ELIMINADO = 0";
        }
        $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
        oci_execute($Query);
        while ($row = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)) {
            if($iterador == 0){
                $min = $row[0];
            }
            $max = $row[0];
            $iterador++;
        }
        $datos['min'] = $min;
        $datos['max'] = $max;

        echo json_encode($datos);
    }
    else{
        header('Location: ../index.php');
    }
?>