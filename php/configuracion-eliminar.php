<?php
    session_start();
    include ('conexion-SQL.php');
    $datos = array();
    $errores = array();

    if(isset($_SESSION['usuario']) && (! empty($_POST)) ){
        $contra = $_POST['contraeliminar'];
        $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL,"SELECT CONTRASENIA FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'");
        while($row = mysqli_fetch_assoc($Query)){
            if($contra != $row['CONTRASENIA']){
                $errores['contra'] = 'La contraseña introducida no coincide con la contraseña actual.';
            }
        }

        if(empty($errores)){
            mysqli_query($Conexion_a_la_base_de_datos_MySQL, "DELETE FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'");
            $datos['exito'] = true;
            $datos['mensaje'] = 'Su cuenta PRODERE ha sido eliminada satisfactoriamente.';
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