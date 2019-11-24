<?php
    if( isset($_SESSION['usuario']) ){
        if(! ($_SESSION['usuario'] === 'admin' || $_SESSION['usuario'] === 'HecSupport')){
            header("Location: registros.php");
        }
    }
    else{
        header("Location: login.php");
    }
?>