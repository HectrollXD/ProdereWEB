<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST) ) && isset($_SESSION['usuario']) ){
        $busqueda = strtoupper($_POST['buscar']);
        $ordenar = $_POST['ordenar'];
        $tabla = "
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Código</th>
                <th scope='col'>Título</th>
                <th scope='col'>Ejemplar</th>
                <th scope='col'>Editorial</th>
                </tr>
            </thead>
            <tbody>
        ";
        switch($ordenar){
            case 0:
                $ordenar = " ORDER BY CODIGO_DE_LIBRO ASC";
                break;
            case 1:
                $ordenar = " ORDER BY CODIGO_DE_LIBRO DESC";
                break;
            case 2:
                $ordenar = " ORDER BY TITULO ASC";
                break;
            case 3:
                $ordenar = " ORDER BY TITULO DESC";
                break;
            case 4:
                $ordenar = " ORDER BY EDITORIAL ASC";
                break;
            case 5:
                $ordenar = " ORDER BY EDITORIAL DESC";
                break;
            default:
                $ordenar = " ORDER BY CODIGO_DE_LIBRO ASC";
                break;
        }
        if($busqueda == ''){
            $Consulta = "SELECT * FROM LIBROS WHERE ELIMINADO = 0".$ordenar;
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $titulo = ucwords(strtolower($rows[1]));
                $tabla.="
                        <tr>
                            <td>$rows[0]</td>
                            <td>$titulo</td>
                            <td>$rows[3]</td>
                            <td>$rows[2]</td>
                        </tr>
                ";
            }
            $tabla.="
                </tbody>
            </table>";
            echo $tabla;
        }
        else{
            $Consulta = "SELECT * FROM LIBROS WHERE ELIMINADO = 0 AND (CODIGO_DE_LIBRO LIKE '%$busqueda%' OR TITULO LIKE '%$busqueda%' OR EDITORIAL LIKE '%$busqueda%')".$ordenar;
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $titulo = ucwords(strtolower($rows[1]));
                $tabla.="
                        <tr>
                            <td>$rows[0]</td>
                            <td>$titulo</td>
                            <td>$rows[3]</td>
                            <td>$rows[2]</td>
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