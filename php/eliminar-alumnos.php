<?php
    session_start();
    include ('conexion-SQL.php');
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario'])){
        $contra = $_POST['contra'];
        $codinicial = $_POST['codini'];
        $codfinal = $_POST['codfin'];
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
            $Upgrade = "UPDATE ALUMNOS SET ELIMINADO = 1 WHERE CODIGO_DE_ALUMNO >= $codinicial AND CODIGO_DE_ALUMNO <= $codfinal";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Upgrade);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = 'Los alumnos se han eliminado correctamente';
        }
        else{
            $datos['exito'] = false;
            $datos['errores'] = $errores;
        }
        echo json_encode($datos);
    }
    else{
        header('Location: ../index.php');
    }
?>