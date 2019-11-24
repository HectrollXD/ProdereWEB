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
            <title>Agregar Libros</title>
            <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <?php include ('shared/header.php'); ?>
        </header>
        <div class="container text-center" style="padding-top:100px;padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6"><h2>Agregar Libros</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="container" style="background:#f7f7f7; padding-top:20px;">
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
                    <div class="col-lg-4"><input type="text" id="codigo" placeholder="Ej. 1000A" class="form-control" maxlength="20"></div>
                    <div class="col-lg-6 text-center"><label id="resejemplar"></label></div>
                    <div class="col-lg-6 text-center"><label id="rescodigo"></label></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-8 text-left"><a href="como-saber-el-codigo-del-libro.php" target="_blank">¿Qué código debo de colocar para el libro?</a></div>
                <div class="col-lg-2 col-6"><button class="btn btn-primary form-control" id="limpiar">Limpiar campos</button></div>
                <div class="col-lg-2 col-6"><button class="btn btn-success form-control" id="guardar">Guardar</button></div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/agregar-libros.js"></script>
    </body>
</html>