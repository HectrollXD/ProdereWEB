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
            <title>Modificar Alumnos</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ejecutarAjax()">
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Modificar alumnos</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-12 barra-de-busqueda" style="display: block;">
                    <input type="text" id="buscar" placeholder="Buscar" class="form-control">
                </div>
                <div class="col-lg-2 col-12 text-center text-lg-right barra-de-busqueda" style="display: block;"><p class="font-weight-bold" style="font-size:22px;">Ordenar por:</p></div>
                <div class="col-lg-2 col-8 text-center barra-de-busqueda" style="display: block;">
                <select onchange="ejecutarAjax()" name="ordenar" id="ordenar" class="form-control text-center">
                        <option value="0">Código ascendente</option>
                        <option value="1">Código descendente</option>
                        <option value="2">Apellidos A-Z</option>
                        <option value="3">Apellidos Z-A</option>
                        <option value="4">Carrera A-Z</option>
                        <option value="5">Carrera Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4 barra-de-busqueda" style="display: block;">
                    <input type="button" id="btnordenar" value="Ordenar" class="btn btn-primary form-control">
                </div>
            </div>
            <br>
            <div class="row text-center">
                <div class="col-12 table-responsive" id='tabla'>
                </div>
            </div>
            <div class="container" style="display:none; background:#f6f6f6; padding:20px;" id="mod">
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
                <div class="row">
                    <div class="col-lg-6"><label for="contra">Es necesario colocar la contraseña del usuario para modificar un alumno.</label></div>
                    <div class="col-lg-6"><input type="password" id="contra" class="form-control" placeholder="Contraseña"></div>
                    <div class="col-lg-6"></div>
                    <div class="col-lg-6"><label for="contra" id="rescontra"></label></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-8"></div>
                    <div class="col-lg-2"><button class="btn btn-danger form-control" id="cancelar">Cancelar</button></div>
                    <div class="col-lg-2"><button class="btn btn-success form-control" id="modificar">Guardar cambios</button></div>
                </div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/modificar-alumnos.js"></script>
    </body>
</html>