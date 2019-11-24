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
            <title>Agregar Alumnos</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Agregar Alumnos</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="container" style="background:#f7f7f7; padding-top:20px;">
                <div class="row">
                    <div class="col-lg-2 text-lg-right"><label for="apellidop">Apellido paterno</label></div>
                    <div class="col-lg-4"><input type="text" id="apellidop" placeholder="Apellido paterno" class="form-control" maxlength="25"></div>
                    <div class="col-lg-2 text-lg-right"><label for="apellidom">Apellido materno</label></div>
                    <div class="col-lg-4"><input type="text" id="apellidom" placeholder="Apellido materno" class="form-control" maxlength="25"></div>
                    <div class="col-lg-12 text-center"><label id="repuestaapellido"></label></div>
                </div>
                <div class="row">
                    <div class="col-lg-2 text-lg-right"><label for="nombres">Nombre(s)</label></div>
                    <div class="col-lg-10"><input type="text" id="nombres" placeholder="Nombre(s)" class="form-control" maxlength="50"></div>
                    <div class="col-lg-12 text-center"><label for="nombres" id="repuestanombres"></label></div>
                </div>
                <div class="row">
                    <div class="col-lg-2 text-lg-right"><label for="codigo">Código</label></div>
                    <div class="col-lg-4"><input type="text" id="codigo" placeholder="Código" class="form-control" maxlength="20"></div>
                    <div class="col-lg-1 text-lg-right"><label for="carrera">Carrera</label></div>
                    <div class="col-lg-5">
                        <select id="carrera" class="form-control text-center">
                            <option value="BGC">Bachillerato General por Competencias</option>
                            <option value="BTDS">Bachillerato Tecnológico en Desarrollo de Software</option>
                            <option value="BTDI">Bachillerato Tecnológico en Diseño Industrial</option>
                        </select>
                    </div>
                    <div class="col-lg-12"><label for="nombres" id="repuestacodigo"></label></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-2 col-6"><button class="btn btn-primary form-control" id="limpiar">Limpiar campos</button></div>
                <div class="col-lg-2 col-6"><button class="btn btn-success form-control" id="guardar">Guardar</button></div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/agregar-alumnos.js"></script>
    </body>
</html>