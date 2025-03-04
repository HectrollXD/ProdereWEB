<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            session_start();
            include ('../php/verificar-inicio.php');
            include ('../php/verificar-usuario-existente.php');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
        <title>Eliminar Libros</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="buscar()">
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Eliminar Libros</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <input type="text" id="buscar" placeholder="Buscar" class="form-control">
                </div>
                <div class="col-lg-2 col-12 text-center text-lg-right"><p class="font-weight-bold" style="font-size:22px;">Ordenar por:</p></div>
                <div class="col-lg-2 col-8 text-center">
                <select onchange="buscar()" id="ordenar" class="form-control text-center">
                        <option value="0">Código ascendente</option>
                        <option value="1">Código descendente</option>
                        <option value="2">Título A-Z</option>
                        <option value="3">Título Z-A</option>
                        <option value="4">Editorial A-Z</option>
                        <option value="5">Editorial Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4">
                    <input type="button" id="btnordenar" value="Ordenar" class="btn btn-primary form-control">
                </div>
            </div>
            <br>
            <div class="row" >
                <div class="col-lg-4 eliminar" style="display:none;"><label for="contra" id="rescontra">Introduce la contraseña para eliminar.</label></div>
                <div class="col-lg-4 eliminar" style="display:none;"><input type="password" id="contra" class="form-control" placeholder="Introduce la contraeña"></div>
                <div class="col-lg-2 eliminar" style="display:none;"><button class="btn btn-warning form-control" id="cancelar">Cancelar</button></div>
                <div class="col-lg-2 eliminar" style="display:none;"><button class="btn btn-danger form-control" id="eliminar">Eliminar</button></div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-12 table-responsive" id='tabla'>
                </div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/eliminar-libros.js"></script>
    </body>
</html>