<?php
    session_start();
    include ('conexion-Oracle.php');
    include ('conexion-SQL.php');
    if( (!empty($_POST)) && isset($_SESSION['usuario']) ){
        $codigo = $_POST['codigo'];
        $contra = $_POST['contra'];
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
            $Upgrade = "DELETE FROM LIBROS WHERE CODIGO_DE_LIBRO = '$codigo' AND ELIMINADO = 1";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Upgrade);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = 'El libro se ha eliminado correctamente';
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