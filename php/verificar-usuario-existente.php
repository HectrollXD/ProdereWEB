<?php
    include ('conexion-SQL.php');
    $usuarios = 0;
    $Seleccion = "SELECT USUARIO FROM CUENTAS WHERE USUARIO = '$_SESSION[usuario]'";
    $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Seleccion);
    while($row = mysqli_fetch_assoc($Query)){
        if($row['USUARIO'] === $_SESSION['usuario']){
            $usuarios++;
        }
    }
    
    if($usuarios == 0){
        unset($_SESSION['usuario']);
        session_destroy();
        header('Location: ../index.php');
    }
?>