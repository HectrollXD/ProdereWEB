<?php 
    if(isset($_SESSION['usuario']))
        include ("navbar-iniciado.php");
    else
        include ("navbar-no-iniciado.php");
?>
