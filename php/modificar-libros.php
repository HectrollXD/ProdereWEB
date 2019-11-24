<?php
    session_start();
    include ('conexion-Oracle.php');
    include ('conexion-SQL.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $titulo = strtoupper($_POST['titulo']);
        $editorial = strtoupper($_POST['editorial']);
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
            $Modificacion = "UPDATE LIBROS SET TITULO = '$titulo', EDITORIAL = '$editorial' WHERE CODIGO_DE_LIBRO = '$codigo'";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Modificacion);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = "El libro con el código $codigo se ha modificado satisfactoriamente.";
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