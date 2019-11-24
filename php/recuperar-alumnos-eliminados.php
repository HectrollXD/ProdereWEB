<?php
    session_start();
    include ('conexion-Oracle.php');
    if( (! empty($_POST)) && isset($_SESSION['usuario']) ){
        $busqueda = strtoupper($_POST['buscar']);
        $tabla = "";
        $tabla.='
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope="col">Código</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Carrera</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
        ';
        if(empty($busqueda)){
            $Consulta = "SELECT * FROM ALUMNOS WHERE ELIMINADO = 1 ORDER BY CODIGO_DE_ALUMNO ASC";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $nombre = ucwords(strtolower($rows[1]));
                $tabla.="
                        <tr>
                            <th scope='row'>$rows[0]</th>
                            <td>$nombre</td>
                            <td>$rows[2]</td>
                            <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                        </tr>
                ";
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No hay alumnos por recuperar.";
            }
        }
        else{
            $Consulta = "SELECT * FROM ALUMNOS WHERE ELIMINADO = 1 AND (CODIGO_DE_ALUMNO LIKE '%$busqueda%' OR NOMBRE LIKE '%$busqueda%' OR CARRERA LIKE '%$busqueda%')";
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS)){
                $nombre = ucwords(strtolower($rows[2]));
                $tabla.="
                        <tr>
                            <th scope='row'>$rows[0]</th>
                            <td>$nombre</td>
                            <td>$rows[1]</td>
                            <td><button class='btn btn-success' value='$rows[0]'>Recuperar</button></td>
                        </tr>
                ";
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No hay resultados similares a la búsqueda realizada.";
            }
        }
        echo $tabla;
    }
    else{
        header('Location: ../index.php');
    }
?>