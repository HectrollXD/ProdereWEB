<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $nombres = strtoupper($_POST['nombres']);
        $apellidop = strtoupper($_POST['apellidop']);
        $apellidom = strtoupper($_POST['apellidom']);
        $nombre = $apellidop.' '.$apellidom.' '.$nombres;
        $codigo = $_POST['codigo'];
        $carrera = $_POST['carrera'];
        $errores = array();
        $datos = array();
        $validar = false;
        
        $Consulta="SELECT CODIGO_DE_ALUMNO FROM ALUMNOS WHERE CODIGO_DE_ALUMNO = '$codigo'";
        $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
        oci_execute($Query);
        while($row = oci_fetch_assoc($Query)){
            if($row['CODIGO_DE_ALUMNO'] == $codigo){
                $errores['codigo'] = 'Este código de alumno ya está siendo  utilizado.';
                $validar = true;
            }
        }
        
        if($validar == false){
            $Inyeccion = "INSERT INTO ALUMNOS(CODIGO_DE_ALUMNO,  NOMBRE, CARRERA) VALUES ('$codigo','$nombre','$carrera')";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Inyeccion);
            oci_execute($Query);
            if($Query == false){
                $errores['fallo'] = 'Algo salió mal al insertar al nuevo alumno a las base de datos.';
            }
        }
        if(empty($errores)){
            $datos['exito'] = true;
            $datos['mensaje'] = "El alumno ".ucwords(strtolower($nombre)).' se ha insertado correctamente.';
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