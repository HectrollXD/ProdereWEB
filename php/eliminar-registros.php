<?php
    session_start();
    include ('conexion-SQL.php');
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario'])){
        $contra = $_POST['confirmacion'];
        $idinicial = $_POST['idinicial'];
        $idfinal = $_POST['idfinal'];
        $nomreg = $_POST['nomreg'];
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
            if($nomreg === "libros"){
                $Upgrade = "UPDATE PRESTAMOS_DE_LIBROS SET ELIMINADO = 1 WHERE NUMERO_DE_PRESTAMO_DE_LIBRO >= $idinicial AND NUMERO_DE_PRESTAMO_DE_LIBRO <= $idfinal";
            }
            else if($nomreg === "computadoras"){
                $Upgrade = "UPDATE PRESTAMOS_DE_COMPUTADORAS SET ELIMINADO = 1 WHERE NUMERO_DE_PRESTAMO_DE_COMPU >= $idinicial AND NUMERO_DE_PRESTAMO_DE_COMPU <= $idfinal";
            }
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Upgrade);
            oci_execute($Query);
            $datos['exito'] = true;
            $datos['mensaje'] = 'Los registros se han eliminado correctamente';
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