<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $contra = $_POST['contra'];
        $min = 0;
        $max = 0;
        $iterador = 0;
        $datos = array();
        $Consulta = "SELECT * FROM ALUMNOS WHERE ELIMINADO = 0 ORDER BY CODIGO_DE_ALUMNO ASC";
     
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