<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $NumReg = $_POST['numreg'];
        $tabla = $_POST['tabla'];
        $errores = array();
        $datos = array();

        switch($tabla){
            case 0:
                $Modoficacion = "UPDATE PRESTAMOS_DE_LIBROS SET ELIMINADO = 0 WHERE NUMERO_DE_PRESTAMO_DE_LIBRO = '$NumReg'";
                break;
            case 1: 
                $Modoficacion = "UPDATE PRESTAMOS_DE_COMPUTADORAS SET ELIMINADO = 0 WHERE NUMERO_DE_PRESTAMO_DE_COMPU = '$NumReg'";
                break;
            default:
                $errores['tabla'] = "No modifique los valores de las opciones. Por favor, refresque la página.";
                break;
        }
        if(empty($errores)){
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Modoficacion);
            oci_execute($Query);
            if(!$Query){
                $errores['update'] = "Algo salió mal al momento de recuperar el registro.";
            }
        }
        
        if(empty($errores)){
            $datos['exito'] = true;
            $datos['mensaje'] = "El registro se ha recuperado exitosamente";
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