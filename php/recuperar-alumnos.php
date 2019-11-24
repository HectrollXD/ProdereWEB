<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $codigo = $_POST['codigo'];
        $errores = array();
        $datos = array();

        $Modificacion = "UPDATE ALUMNOS SET ELIMINADO = 0 WHERE CODIGO_DE_ALUMNO = '$codigo'";
        $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Modificacion);
        oci_execute($Query);
        if(!$Query){
            $errores['update'] = "Algo salió mal al momento de recuperar el registro.";
        }
        
        if(empty($errores)){
            $datos['exito'] = true;
            $datos['mensaje'] = "El alumnos se ha recuperado exitosamente";
        }
        else{
            $datos['extio'] = false;
            $datos['errores'] = $errores;
        }
        echo json_encode($datos);
    }
    else{
        header('Location: ../index.php');
    }
?>