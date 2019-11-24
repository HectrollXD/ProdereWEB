<?php
    session_start();
    include ('conexion-Oracle.php');
    include ('conexion-SQL.php');
    if( (!empty($_POST)) && isset($_SESSION['usuario']) ){
        $tabla = $_POST['tabla'];
        $contra = $_POST['contra'];
        $errores = array();
        $datos = array();
        $Upgrade = '';
        $mensaje = '';

        $Consulta = "SELECT CONTRASENIA FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'";
        $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
        while($row = mysqli_fetch_assoc($Query)){
            if($row['CONTRASENIA'] != $contra ){
                $errores['contra'] = 'La contraseña introducida no coincide con la contraseña del usuario.';
            }
        }
        if(empty($errores)){
            switch($tabla){
                case 0:
                    $Upgrade = "DELETE FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 1";
                    $mensaje = 'Los registros de los prestamos de libros se han eliminado correctamente.';
                    break;
                case 2:
                    $Upgrade = "DELETE FROM PRESTAMOS_DE_COMPUTADORAS WHERE ELIMINADO = 1";
                    $mensaje = 'Los registros de los prestamos de computadoras se han eliminado correctamente.';
                    break;
                default:
                    $Upgrade = "DELETE FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 1";
                    $mensaje = 'Los registros de los prestamos de libros se han eliminado correctamente.';
                    break;
            }
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Upgrade);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = $mensaje;
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