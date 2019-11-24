<?php
    session_start();
    if( (! empty($_POST)) && (isset($_SESSION['usuario']) && ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'HecSupport') )){
        include ('conexion-SQL.php');
        if( ! (empty($_POST['usuario_eliminar'])) ){
            $datos = array();
            $Usuario_a_eliminar = $_POST['usuario_eliminar'];
            $Eliminar = "DELETE FROM CUENTAS WHERE USUARIO = '$Usuario_a_eliminar'";
            $query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Eliminar);
            if($query == true){
                $datos['exito'] = true;
                $datos['mensaje'] = "El ususario $Usuario_a_eliminar se ha eliminado exitosamente.";
            }
            else{
                $datos['exito'] = false;
                $datos['mensaje'] = "El ususario $Usuario_a_eliminar no se ha podido eliminar.";
            }
            echo json_encode($datos);
        }
    }
    else{
        header('Location: ../index.php');
    }
?>