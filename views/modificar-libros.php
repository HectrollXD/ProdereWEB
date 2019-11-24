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
            <title>Modificar Libros</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ejecutarAjax()">
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Modificar Libros</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-6 col-12 barra-de-busqueda" style="display:block;">
                    <input type="text" id="buscar" placeholder="Buscar" class="form-control">
                </div>
                <div class="col-lg-2 col-12 text-center text-lg-right barra-de-busqueda" style="display:block;"><p class="font-weight-bold" style="font-size:22px;">Ordenar por:</p></div>
                <div class="col-lg-2 col-8 text-center barra-de-busqueda" style="display:block;">
                <select onchange="ejecutarAjax()" name="ordenar" id="ordenar" class="form-control text-center">
                        <option value="0">Código ascendente</option>
                        <option value="1">Código descendente</option>
                        <option value="2">Titulo A-Z</option>
                        <option value="3">Titulo Z-A</option>
                        <option value="4">Editorial A-Z</option>
                        <option value="5">Editorial Z-A</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4 barra-de-busqueda" style="display:block;">
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
                        <div class="col-lg-2 text-lg-right"><label for="titulo">Título del libro</label></div>
                        <div class="col-lg-10"><input type="text" id="titulo" placeholder="Título del libro" class="form-control" maxlength="100"></div>
                        <div class="col-lg-12 text-center"><label id="restitulo"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 text-lg-right"><label for="editorial">Editorial del libro</label></div>
                        <div class="col-lg-10"><input type="text" id="editorial" placeholder="Editorial del libro" class="form-control" maxlength="100"></div>
                        <div class="col-lg-12 text-center"><label id="reseditorial"></label></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 text-lg-right"><label for="ejemplar">Ejemplar del libro</label></div>
                        <div class="col-lg-4"><input type="text" id="ejemplar" placeholder="Ejemplar del libro" class="form-control" maxlength="10"></div>
                        <div class="col-lg-2 text-lg-right"><label for="codigo">Código del libro</label></div>
                        <div class="col-lg-4"><input type="text" id="codigo" placeholder="Código del libro" class="form-control" maxlength="20"></div>
                        <div class="col-lg-6 text-center"><label id="resejemplar"></label></div>
                        <div class="col-lg-6 text-center"><label id="rescodigo"></label></div>
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
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/modificar-libros.js"></script>
    </body>
</html>