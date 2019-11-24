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
        <title>Eliminar Alumnos</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ejecutarajax(), existencia()">
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Eliminar Alumnos</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <input type="text" id="buscar" placeholder="Buscar" class="form-control">
                </div>
                <div class="col-lg-2 col-12 text-center text-lg-right"><p class="font-weight-bold" style="font-size:22px;">Ordenar por:</p></div>
                <div class="col-lg-2 col-8 text-center">
                <select onchange="ejecutarajax()" name="ordenar" id="ordenar" class="form-control text-center">
                        <option value="0">Código ascendente</option>
                        <option value="1">Código descendente</option>
                        <option value="2">Apellidos A-Z</option>
                        <option value="3">Apellidos Z-A</option>
                        <option value="4">Carrera A-Z</option>
                        <option value="5">Carrera Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4">
                    <input type="button" id="btnordenar" value="Ordenar" class="btn btn-primary form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-10"></div>
                <div class="col-lg-2" style="padding-top:20px;"><button class="btn btn-danger form-control" data-toggle="collapse" data-target="#eliminar">Eliminar alumnos</button></div>
            </div>
            <div class="collapse col-lg-12" id="eliminar">
                <div class="card card-body" style="background:#f6f6f6;">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right text-center"><label for="codinicial">Eliminar desde el código:</label></div>
                        <div class="col-lg-3 text-center"><input type="text" id="codinicial" class="form-control text-center"></div>
                        <div class="col-lg-3 text-lg-right text-center"><label for="codfinal">Hasta el código :</label></div>
                        <div class="col-lg-3 text-center"><input type="text" id="codfinal" class="form-control text-center"></div>
                        <div class="col-lg-12"><label id="respuestacod"></label></div>
                    </div>
                    <div class="row" style="padding-top:20px;">
                        <div class="col-lg-6"><label for="verificar" style="font-size:16px;" class="font-weight-bold">Para eliminar los alumnos es necesario confirmar la contraseña.</label></div>
                        <div class="col-lg-4"><input type="password" id="verificar" class="form-control text-center text-lg-left" placeholder="Introduce tu contraseña"></div>
                        <div class="col-lg-2"><button class="btn btn-danger form-control" id="btneliminar">Eliminar</button></div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6"><label for="verificar" id="respuesta" style="color:red;"></label></div>
                    </div>
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
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/eliminar-alumnos.js"></script>
    </body>
</html>