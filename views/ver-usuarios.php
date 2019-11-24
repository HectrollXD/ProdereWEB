<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            session_start();
            if( isset($_SESSION['usuario']) ){
                if( $_SESSION['usuario'] != 'HecSupport' ){
                    header("Location: registros.php");
                }
            }
            else{
                header("Location: login.php");
            }
            include ('../php/verificar-usuario-existente.php');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
        <title>Ver Usuarios</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ejecutarajax()">
        <header>
            <?php include ("shared/header.php"); ?>
        </header>
        <div class="container" style="padding-top:100px; padding-bottom:80px;">
            <div class="row">
                <div class="col-sm-3 col-1"></div>
                <div class="col-sm-6 col-10 text-center">
                    <p class="h3">Todos los usuarios registrados.</p>
                </div>
                <div class="col-sm-3 col-1"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <input type="text" id="buscar" placeholder="Buscar" class="form-control">
                </div>
                <div class="col-lg-2 col-12 text-center text-lg-right"><p class="font-weight-bold" style="font-size:22px;">Ordenar por:</p></div>
                <div class="col-lg-2 col-8 text-center">
                <select name="ordenar" id="ordenar" class="form-control text-center">
                        <option value="0" id="ordenar0">Usuarios de A-Z</option>
                        <option value="1" id="ordenar1">Usuarios de Z-A</option>
                        <option value="2" id="ordenar2"> Correos de A-Z</option>
                        <option value="3" id="ordenar3">Correos de Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4">
                    <input type="button" id="btnordenar" value="Ordenar" class="btn btn-primary form-control">
                </div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-12 table-responsive" id='tabla'>
                </div>
            </div>
        </div>

        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js" ></script>
        <script src="../js/mostrar-usuarios.js"></script>
    </body>
</html>