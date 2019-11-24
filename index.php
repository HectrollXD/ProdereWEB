<?php
    session_start();
    if(isset($_SESSION['usuario']))
        header('Location: views/registros.php');
    else
        header('Location: views/login.php');
?>