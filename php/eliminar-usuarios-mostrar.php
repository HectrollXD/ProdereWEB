<?php
    session_start();
    if( (! empty($_POST)) && (isset($_SESSION['usuario']) && ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'HecSupport'))){
        include ('conexion-SQL.php');
        $Ordenar = $_POST['ordenar'];
        $tabla = "";
        $tabla.="
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Nombre de usuario</th>
                <th scope='col'>Correo electrónico</th>
                <th scope='col'></th>
                </tr>
            </thead>
            <tbody>
        ";
        if(empty($_POST['buscar'])){
            if($Ordenar == 0){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS ORDER BY USUARIO ASC";
            }
            else if($Ordenar == 1){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS ORDER BY USUARIO DESC";
            }
            else if($Ordenar == 2){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS ORDER BY CORREO ASC";
            }
            else if($Ordenar == 3){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS ORDER BY CORREO DESC";
            }
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
            if(mysqli_num_rows($Query)>2){
                while($rows = mysqli_fetch_assoc($Query)){
                    if($rows['USUARIO']==='HecSupport' || $rows['USUARIO']==='admin'){
                        continue;
                    }
                    else{
                        $tabla.="
                        <tr class='tr'>
                            <td>$rows[USUARIO]</td>
                            <td>$rows[CORREO]</td>
                            <td><button value='$rows[USUARIO]' class='btn btn-danger'>Eliminar</button></td>
                        </tr>
                        ";
                    }
                }
            }
            else{
                $tabla = "No hay usuarios agregados aún.";
            }
            $tabla.="
                </tbody>
            </table>";
            echo $tabla;
        }
        else{
            $Busqueda = $_POST['buscar'];

            if($Ordenar == 0){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY USUARIO ASC";
            }
            else if($Ordenar == 1){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY USUARIO DESC";
            }
            else if($Ordenar == 2){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY CORREO ASC";
            }
            else if($Ordenar == 3){
                $Consulta = "SELECT USUARIO, CORREO FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY CORREO DESC";
            }
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
            if(mysqli_num_rows($Query) > 0){
                while($rows = mysqli_fetch_assoc($Query)){
                    if($rows['USUARIO']==='HecSupport' || $rows['USUARIO']==='admin'){
                        continue;
                    }
                    else{
                        $tabla.="
                        <tr>
                            <td>$rows[USUARIO]</td>
                            <td>$rows[CORREO]</td>
                            <td><button value='$rows[USUARIO]' class='btn btn-danger'>Eliminar</button></td>
                        </tr>
                        ";
                    }
                }
            }
            else{
                $tabla = "No se han encontrado campos similares a la búsqueda realizada.";
            }
            $tabla.="
                </tbody>
            </table>";
            echo $tabla;
        }
    }
    else{
        header('Location: ../index.php');
    }
?>