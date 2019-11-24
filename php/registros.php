<?php
    session_start();
    include ("conexion-Oracle.php");
    $tabla = "";
    if(isset($_SESSION['usuario']) && (! empty($_POST)) ){
        //muestra la tabla de los registros de libros
        if($_POST['mostrar']==="libros"){
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
                        <th scope="col">Firma</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
            ';
            switch($_POST['ordenar']){
                case 1:
                    $auxcon = " ORDER BY NUMERO_DE_PRESTAMO_DE_LIBRO ASC";
                    break;
                case 2:
                    $auxcon = " ORDER BY NUMERO_DE_PRESTAMO_DE_LIBRO DESC";
                    break;
                case 3:
                    $auxcon = " ORDER BY FECHA ASC";
                    break;
                case 4:
                    $auxcon = " ORDER BY FECHA DESC";
                    break;
                case 5:
                    $auxcon = " ORDER BY NOMBRE_DEL_ALUMNO ASC";
                    break;
                case 6:
                    $auxcon = " ORDER BY NOMBRE_DEL_ALUMNO DESC";
                    break;
                case 7:
                    $auxcon = " ORDER BY CODIGO_DEL_ALUMNO ASC";
                    break;
                case 8:
                    $auxcon = " ORDER BY CODIGO_DEL_ALUMNO DESC";
                    break;
            }
            if($_POST['buscar'] === ""){
                switch($_POST['status']){
                    case "todos":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 0".$auxcon;
                        break;
                    case "entregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE STATUS = 1 AND ELIMINADO = 0".$auxcon;
                        break;
                    case "noentregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE STATUS = 0 AND ELIMINADO = 0".$auxcon;
                        break;
                }
            }
            else{
                $Bus = strtoupper($_POST['buscar']);
                switch($_POST['status']){
                    case "todos":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE ELIMINADO = 0 AND (TITULO_DEL_LIBRO LIKE '%$Bus%' OR CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                    case "entregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE STATUS = 1 AND ELIMINADO = 0 AND (TITULO_DEL_LIBRO LIKE '%$Bus%' OR CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                    case "noentregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_LIBROS WHERE STATUS = 0 AND ELIMINADO = 0 AND (TITULO_DEL_LIBRO LIKE '%$Bus%' OR CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                }
            }
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
                $imagen = base64_encode($rows[8]);
                $nombre_alumno = ucwords(strtolower($rows[4]));
                $titulo = ucfirst(strtolower($rows[1]));
                if($imagen == null){ $imagen = ""; }
                else{ $imagen = "<img height='40px' src='data:image/png;base64,$imagen'/>"; }
                if($rows[9]==1){ $status="Entregado"; }
                else{ $status=""; }
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
                            <td>$imagen</td>
                            <td>$status</td>
                        </tr>
                ";
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No se encuentran resultados similares a la búsqueda realizada";
            }
        }
        //muestra la tabla del registro de las computadoras
        else if($_POST['mostrar']==="computadoras"){
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
                        <th scope="col">Firma</th>
                        <th scope="col">Estatus</th>
                    </tr>
                </thead>
                <tbody>
            ';
            switch($_POST['ordenar']){
                case 1:
                    $auxcon = " ORDER BY NUMERO_DE_PRESTAMO_DE_COMPU ASC";
                    break;
                case 2:
                    $auxcon = " ORDER BY NUMERO_DE_PRESTAMO_DE_COMPU DESC";
                    break;
                case 3:
                    $auxcon = " ORDER BY FECHA ASC";
                    break;
                case 4:
                    $auxcon = " ORDER BY FECHA DESC";
                    break;
                case 5:
                    $auxcon = " ORDER BY NOMBRE_DEL_ALUMNO ASC";
                    break;
                case 6:
                    $auxcon = " ORDER BY NOMBRE_DEL_ALUMNO DESC";
                    break;
                case 7:
                    $auxcon = " ORDER BY CODIGO_DEL_ALUMNO ASC";
                    break;
                case 8:
                    $auxcon = " ORDER BY CODIGO_DEL_ALUMNO DESC";
                    break;
            }
            if($_POST['buscar'] === ""){
                switch($_POST['status']){
                    case "todos":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE ELIMINADO = 0".$auxcon;
                        break;
                    case "entregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE STATUS = 1 AND ELIMINADO = 0".$auxcon;
                        break;
                    case "noentregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE STATUS = 0 AND ELIMINADO = 0".$auxcon;
                        break;
                }
            }
            else{
                $Bus = strtoupper($_POST['buscar']);
                switch($_POST['status']){
                    case "todos":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE ELIMINADO = 0 AND (CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                    case "entregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE STATUS = 1 AND ELIMINADO = 0 AND (CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                    case "noentregados":
                        $Consulta = "SELECT * FROM PRESTAMOS_DE_COMPUTADORAS WHERE STATUS = 0 AND ELIMINADO = 0 AND (CODIGO_DEL_ALUMNO LIKE '%$Bus%' OR NOMBRE_DEL_ALUMNO LIKE '%$Bus%' OR FECHA LIKE '%$Bus%')".$auxcon;
                        break;
                }
            }       
            $Query = oci_parse($Conexion_a_la_base_de_datos_Oracle, $Consulta);
            oci_execute($Query);
            while($rows = oci_fetch_array($Query, OCI_NUM + OCI_RETURN_NULLS + OCI_RETURN_LOBS)){
                $imagen = base64_encode($rows[7]);
                $nombre_alumno = ucwords(strtolower($rows[3]));
                if($imagen == null){ $imagen = ""; }
                else{ $imagen = "<img height='40px' src='data:image/png;base64,$imagen'/>"; }
                if($rows[8]==1){ $status="Entregado"; }
                else{ $status=""; }
                $tabla.="
                        <tr>
                            <th scope='row'>$rows[0]</th>
                            <td>$rows[1]</td>
                            <td>$rows[2]</td>
                            <td>$nombre_alumno</td>
                            <td>$rows[4]</td>
                            <td>$rows[5]</td>
                            <td>$rows[6]</td>
                            <td>$imagen</td>
                            <td>$status</td>
                        </tr>
                ";
            }
            $tabla.='
                </tbody>
            </table>
            ';
            if(oci_num_rows($Query) === 0){
                $tabla = "No se encuentran resultados similares a la búsqueda realizada";
            }
        }
        echo $tabla;
    }
    else{
        header("Location: ../index.php");
    }
?>