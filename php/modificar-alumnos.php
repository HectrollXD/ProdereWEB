<?php
    session_start();
    include ('conexion-Oracle.php');
    include ('conexion-SQL.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $contra = $_POST['contra'];
        $nombres = strtoupper($_POST['nombres']);
        $apellidop = strtoupper($_POST['apellidop']);
        $apellidom = strtoupper($_POST['apellidom']);
        $nombre = $apellidop.' '.$apellidom.' '.$nombres;
        $codigo = $_POST['codigo'];
        $carrera = $_POST['carrera'];
        $errores = array();
        $datos = array();

        $Consulta = "SELECT CONTRASENIA FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'";
        $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
        while($row = mysqli_fetch_assoc($Query)){
            if($row['CONTRASENIA'] != $contra ){
                $errores['contra'] = 'La contraseña introducida no coincide con la contraseña del usuario.';
            }
        }
        if(empty($errores)){
            $Modificacion = "UPDATE ALUMNOS SET NOMBRE = '$nombre', CARRERA = '$carrera' WHERE CODIGO_DE_ALUMNO = '$codigo'";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Modificacion);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = "El alumno con el código $codigo se ha modificado satisfactoriamente.";
        }
        else{
            $datos['exito'] = false;
            $datos['errores'] = $errores;
        }
        echo json_encode($datos);
    }
    else{
        header ('Location: ../index.php');
    }
?>