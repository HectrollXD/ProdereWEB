<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && (isset($_SESSION['usuario'])) ){ 
        $titulo = strtoupper($_POST['titulo']);
        $editorial = strtoupper($_POST['editorial']);
        $ejemplar = $_POST['ejemplar'];
        $codigo = $_POST['codigo'];
        $errores = array();
        $datos = array();

        $Consulta = "SELECT CODIGO_DE_LIBRO FROM LIBROS WHERE CODIGO_DE_LIBRO = '$codigo'";
        $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
        oci_execute($Query);
        while($row = oci_fetch_assoc($Query)){
            if($row['CODIGO_DE_LIBRO'] == $codigo){
                $errores['codigo'] = 'Este código de libro ya está en uso.';
            }
        }
        if(empty($errores)){
            $Insercion = "INSERT INTO LIBROS(CODIGO_DE_LIBRO, TITULO, EDITORIAL, EJEMPLAR) VALUES('$codigo','$titulo','$editorial','$ejemplar')";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Insercion);
            oci_execute($Query);
            if(!$Query){
                $errores['insersion'] = 'Algo salió mal al momento de insertar el nuevo libro.';
            }
        }
        if(empty($errores)){
            $datos['exito'] = true;
            $datos['mensaje'] = 'El libro se ha agregado correctamente.';
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