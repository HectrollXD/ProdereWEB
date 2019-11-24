<?php
    session_start();
    if( (!empty($_POST)) && (isset($_SESSION['usuario']) && ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'HecSupport')) ){
        $errores = array();
        $datos = array();
        $usuario = $_POST['usuario'];
        $correo = $_POST['correo'];
        $contra = $_POST['contra'];

        include ("conexion-SQL.php");
        $ConsultaSQL = "SELECT USUARIO, CORREO FROM CUENTAS WHERE USUARIO = '$usuario' OR CORREO = '$correo'";
        $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $ConsultaSQL);
        while( $Resultados = mysqli_fetch_assoc($Query) ){
            if( $Resultados['USUARIO'] === $usuario ){
                $errores['usuario'] = "El nombre de usuario ya está siendo utilizado";
            }
            if( $Resultados['CORREO'] === $correo ){
                $errores['correo'] = "El correo electrónico ya está siendo utilizado";
            }
        }
        if( empty($errores) ){
            $InsersionSQL = "INSERT INTO CUENTAS(USUARIO, CORREO, CONTRASENIA) VALUES('$usuario','$correo','$contra')";
            mysqli_query($Conexion_a_la_base_de_datos_MySQL, $InsersionSQL);
            $datos['exito'] = true;
            $datos['mensaje'] = "El nuevo usuario ha sido creado exitosamente.";
        }
        else{
            $datos['exito'] = false;
            $datos['errores'] = $errores;
        }
        echo json_encode($datos);
    }
    else{
        header("Location: ../index.php");
    }
?>