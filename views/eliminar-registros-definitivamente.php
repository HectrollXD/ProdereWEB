<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            session_start();
            include ('../php/verificar-inicio-de-sesion-admin.php');
            include ('../php/verificar-usuario-existente.php');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
            <title>Eliminar Registros Definitivamente</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ImprimirTabla()">
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Eliminar registros definitivamente.</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="row" style="background:#f1f1f1; padding-top:10px; padding-bottom:10px;">
                <div class="col-lg-5"><input type="text" id="buscar" class="form-control text-center" placeholder="Buscar"></div>
                <div class="col-lg-2 text-center font-weight-bold h4"><label>Mostrar:</label></div>
                <div class="col-lg-3" style="padding-bottom:10px;">
                <select name="prestamos" id="prestamos" class="form-control text-center">
                        <option value="0" onclick="ImprimirTabla()">Libros</option>
                        <option value="1" onclick="ImprimirTabla()">Computadoras</option>
                    </select>
                </div>
                <div class="col-lg-2"><button class="btn btn-primary form-control" id="ordenar">Ordenar</button></div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-5 text-lg-right text-center"><label for="contra" id="rescontra">Para eliminar algún libro es necesario confirmar la contraseña.</label></div>
                <div class="col-lg-4" style="padding-bottom:20px;"><input type="password" id="contra" class="form-control" placeholder="Confirme la contraseña"></div>
                <div class="col-lg-3"><button class="btn btn-danger form-control" style="display:none;">Eliminar todos los registros</button></div>
            </div>
            <br>
            <div class="row text-center" style="padding-top:20px;">
                <div class="col-lg-12 table-responsive" id="tabla"></div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/eliminar-registros-definitivamente.js"></script>
    </body>
</html>