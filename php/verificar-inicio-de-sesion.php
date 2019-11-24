<?php
    session_start();
    include ("conexion-SQL.php");
    if( ! empty($_POST) ){
        $Cuenta = $_POST['usuario'];
        $Contrasenia = $_POST['contra'];
        $errores = array();
        $datos = array();
        //define si la cuenta es un correo electrónico
        if(substr(strstr($Cuenta,'@'),0,1) == '@'){
            $contador = 0;
            $SentenciaSQL = "SELECT CORREO FROM CUENTAS WHERE CORREO = '$Cuenta'";
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $SentenciaSQL);
            while($Resultado = mysqli_fetch_assoc($Query)){
                if($Resultado['CORREO'] === $Cuenta){
                    $contador++;
                }
            }
            #Define si existe el correo
            if($contador > 0){
                $SentenciaSQL = "SELECT USUARIO, CONTRASENIA FROM CUENTAS WHERE CORREO = '$Cuenta'";
                $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $SentenciaSQL);
                $Resultado = mysqli_fetch_assoc($Query);
                #Define si la contraseña es correcta
                if($Resultado['CONTRASENIA'] === $Contrasenia){
                    $_SESSION['usuario'] = $Resultado['USUARIO'];
                }
                #Define si la contraseña no es correcta
                else{
                    $errores['contra'] = "La contraseña no coincide con el correo electrónico.";
                }
            }
            #Define si no existe el correo
            else{
                $errores['usuario'] = "Correo electrónico no registrado.";
            }
        }
        //define si la cuenta es un usuario
        else{
            $contador = 0;
            $SentenciaSQL = "SELECT USUARIO FROM CUENTAS WHERE USUARIO = '$Cuenta'";
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $SentenciaSQL);
            while($Resultado = mysqli_fetch_assoc($Query)){
                if($Resultado['USUARIO'] === $Cuenta){
                    $contador++;
                }
            }
            #Define si existe el usuario
            if($contador > 0){
                $SentenciaSQL = "SELECT USUARIO, CONTRASENIA FROM CUENTAS WHERE USUARIO = '$Cuenta'";
                $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $SentenciaSQL);
                $Resultado = mysqli_fetch_assoc($Query);
                #Define si la contraseña es correcta
                if($Resultado['CONTRASENIA'] === $Contrasenia){
                    $_SESSION['usuario'] = $Resultado['USUARIO'];
                }
                #Define si la contraseña es incorrecta
                else{
                    $errores['contra'] = "La contraseña no coincide con el usuario.";
                }
            }
            #define si no existe el usuario
            else{
                $errores['usuario'] = "Usuario no registrado.";
            }
        }
        //Verifica si hay errores para enviar el mensaje mediante AJAX
        if(empty($errores)){
            $datos['exito'] = true;
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