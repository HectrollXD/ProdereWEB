<?php
    session_start();

    if((isset($_SESSION['usuario']) && $_SESSION['usuario'] === 'HecSupport') && (! empty($_POST))){
        include ('conexion-SQL.php');
        $Ordenar = $_POST['ordenar'];
        $tabla = "";
        $tabla.="
        <table class='table'>
            <thead class='thead-dark'>
                <tr>
                <th scope='col'>Nombre de usuario</th>
                <th scope='col'>Correo electrónico</th>
                <th scope='col'>Contraseña</th>
                </tr>
            </thead>
            <tbody>
        ";
        if(empty($_POST['buscar'])){
            if($Ordenar == 0){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS ORDER BY USUARIO ASC";
            }
            else if($Ordenar == 1){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS ORDER BY USUARIO DESC";
            }
            else if($Ordenar == 2){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS ORDER BY CORREO ASC";
            }
            else if($Ordenar == 3){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS ORDER BY CORREO DESC";
            }
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
            while($rows = mysqli_fetch_assoc($Query)){
                $tabla.="
                <tr>
                    <td>$rows[USUARIO]</td>
                    <td>$rows[CORREO]</td>
                    <td>$rows[CONTRASENIA]</td>
                </tr>
                ";
            }
            $tabla.="
                </tbody>
            </table>";
            echo $tabla;
        }
        else{
            $Busqueda = $_POST['buscar'];

            if($Ordenar == 0){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY USUARIO ASC";
            }
            else if($Ordenar == 1){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY USUARIO DESC";
            }
            else if($Ordenar == 2){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY CORREO ASC";
            }
            else if($Ordenar == 3){
                $Consulta = "SELECT USUARIO, CORREO, CONTRASENIA FROM CUENTAS WHERE USUARIO LIKE '%$Busqueda%' OR CORREO LIKE '%$Busqueda%' ORDER BY CORREO DESC";
            }
            $Query = mysqli_query($Conexion_a_la_base_de_datos_MySQL, $Consulta);
            if(mysqli_num_rows($Query) > 0){
                while($rows = mysqli_fetch_assoc($Query)){
                    $tabla.="
                    <tr>
                        <td>$rows[USUARIO]</td>
                        <td>$rows[CORREO]</td>
                        <td>$rows[CONTRASENIA]</td>
                    </tr>
                    ";
                }
                $tabla.="
                    </tbody>
                </table>";
            }
            else{
                $tabla = "No se han encontrado campos similares a la búsqueda realizada.";
            }
            echo $tabla;
        }
    }
    else{
        header('Location: ../index.php');
    }
?>