<?php
    session_start();
    include ("conexion-Oracle.php");
    $tabla = "";
    if(isset($_SESSION['usuario']) && (! empty($_POST)) ){
        $tablaseleccionada = $_POST['tabla'];
        $Bus = strtoupper(strtolower($_POST['buscar']));
        switch($tablaseleccionada){
            case 0:
                $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 1";
                $base = 'libros';
                $tabla.='
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th colspan="10" class="h3">Registros de prestamos de libros</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Ejemplar</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Salida</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                break;
            case 1:
                $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE ELIMINADO = 1";
                $base = 'compus';
                $tabla.='
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th colspan="10" class="h3">Registros de prestamos de computadoras</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No. computadora</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Salida</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                break;
            default:
                $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 1";
                $base = 'libros';
                $tabla.='
                    <table class="table table-striped table-dark">
                        <thead>
                            <tr>
                                <th colspan="10" class="h3">Registros de prestamos de libros</th>
                            </tr>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Título</th>
                                <th scope="col">Ejemplar</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Entrada</th>
                                <th scope="col">Salida</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                ';
                break;
        }
        if(empty($Bus)){
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
                if($base === 'libros'){
                    $nombre_alumno = ucwords(strtolower($rows[4]));
                    $titulo = ucfirst(strtolower($rows[1]));
                    $tabla.="
                            <tr>
                                <th scope='row'>$rows[0]</th>
                                <td>$titulo</td>
                                <td>$rows[2]</td>
                                <td>$rows[3]</td>
                                <td>$nombre_alumno</td>
                                <td>$rows[5]</td>
                                <td>$rows[6]</td>
                                <td>$rows[7]</td>
                                <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                            </tr>
                    ";
                }
                elseif($base === 'compus'){
                    $nombre_alumno = ucwords(strtolower($rows[3]));
                    $tabla.="
                            <tr>
                                <th scope='row'>$rows[0]</th>
                                <td>$rows[1]</td>
                                <td>$rows[2]</td>
                                <td>$nombre_alumno</td>
                                <td>$rows[4]</td>
                                <td>$rows[5]</td>
                                <td>$rows[6]</td>
                                <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                            </tr>
                    ";
                }
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No hay registros por recuperar.";
            }
        }
        else{
            $Consulta .= " AND (CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
                if($base === 'libros'){
                    $nombre_alumno = ucwords(strtolower($rows[4]));
                    $titulo = ucfirst(strtolower($rows[1]));
                    $tabla.="
                            <tr>
                                <th scope='row'>$rows[0]</th>
                                <td>$titulo</td>
                                <td>$rows[2]</td>
                                <td>$rows[3]</td>
                                <td>$nombre_alumno</td>
                                <td>$rows[5]</td>
                                <td>$rows[6]</td>
                                <td>$rows[7]</td>
                                <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                            </tr>
                    ";
                }
                elseif($base === 'compus'){
                    $nombre_alumno = ucwords(strtolower($rows[3]));
                    $tabla.="
                            <tr>
                                <th scope='row'>$rows[0]</th>
                                <td>$rows[1]</td>
                                <td>$rows[2]</td>
                                <td>$nombre_alumno</td>
                                <td>$rows[4]</td>
                                <td>$rows[5]</td>
                                <td>$rows[6]</td>
                                <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                            </tr>
                    ";
                }
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No se encuantran resultados similares a la búsqueda realizada.";
            }
        }
        echo $tabla;
    }
    else{
        header("Location: ../index.php");
    }
?>