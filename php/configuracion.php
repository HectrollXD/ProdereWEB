<?php
    session_start();
    include ('conexion-SQL.php');
    $datos = array();
    $errores = array();

    if(isset($_SESSION['usuario']) && (! empty($_POST)) ){
        $concontra = $_POST['concontra'];
        $contra = $_POST['contra'];
        $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL,"SELECT CONTRASENIA FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'");
        while($row = mysqli_fetch_assoc($Query)){
            if($concontra != $row['CONTRASENIA']){
                $errores['concontra'] = 'La contraseña introducida no coincide con la contraseña actual.';
            }
        }

        if(empty($errores)){
            mysqli_query($Conexion_a_la_base_de_datos_MySQL, "UPDATE CUENTAS SET CONTRASENIA = '$contra' WHERE USUARIO = '$_SESSION[usuario]'");
            $datos['exito'] = true;
            $datos['mensaje'] = 'La contraseña ha sido modificada exitosamente, deberá de iniciar sesión nuevamente.';
            unset($_SESSION['ususario']);
            session_destroy();
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