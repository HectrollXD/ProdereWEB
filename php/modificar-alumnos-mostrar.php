<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $busqueda = strtoupper($_POST['buscar']);
        $ordenar = $_POST['ordenar'];
        $tabla = "
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Código</th>
                <th scope='col'>Nombre</th>
                <th scope='col'>Carrera</th>
                <th scope='col'></th>
                </tr>
            </thead>
            <tbody>
        ";
        switch($ordenar){
            case 0:
                $Ordenar = " ORDER BY CODIGO_DE_ALUMNO ASC";
                break;
            case 1:
                $Ordenar = " ORDER BY CODIGO_DE_ALUMNO DESC";
                break;
            case 2:
                $Ordenar = " ORDER BY NOMBRE ASC";
                break;
            case 3:
                $Ordenar = " ORDER BY NOMBRE DESC";
                break;
            case 4:
                $Ordenar = " ORDER BY CARRERA ASC";
                break;
            case 5:
                $Ordenar = " ORDER BY CARRERA DESC";
                break;
            default:
                $Ordenar = " ORDER BY CODIGO_DE_ALUMNO ASC";
                break;
        }
        if($busqueda == ''){
            $Consulta = "SELECT * FROM ALUMNOS WHERE ELIMINADO = 0".$Ordenar;
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $nombre = ucwords(strtolower($rows[1]));
                $tabla.="
                        <tr>
                            <td>$rows[0]</td>
                            <td>$nombre</td>
                            <td>$rows[2]</td>
                            <td><button class='btn btn-warning' value='$rows[0]'>Modificar</button></td>
                        </tr>
                ";
            }
            $tabla.="
                </tbody>
            </table>";
            if(oci_num_rows($Query) == 0){
                $tabla = "No hay alumnos para modificar.";
            }
            echo $tabla;
        }
        else{
            $Consulta = "SELECT * FROM ALUMNOS WHERE ELIMINADO = 0 AND (CODIGO_DE_ALUMNO LIKE '%$busqueda%' OR NOMBRE LIKE '%$busqueda%' OR CARRERA LIKE '%$busqueda%')".$Ordenar;
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $nombre = ucwords(strtolower($rows[1]));
                $tabla.="
                        <tr>
                            <td>$rows[0]</td>
                            <td>$nombre</td>
                            <td>$rows[2]</td>
                            <td><button class='btn btn-warning' value='$rows[0]'>Modificar</button></td>
                        </tr>
                ";
            }
            $tabla.="
                </tbody>
            </table>";
            if(oci_num_rows($Query) == 0){
                $tabla = "No se encuentran resultados similares a la búsqueda realizada";
            }
            echo $tabla;
        }
    }
    else{
        header('Location: ../index.php');
    }
?>