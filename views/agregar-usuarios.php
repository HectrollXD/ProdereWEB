<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            session_start();
            include ("../php/verificar-inicio-de-sesion-admin.php");
            include ('../php/verificar-usuario-existente.php');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
        <title>Agregar Usuarios</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <?php include ("shared/header.php"); ?>
        </header>
        <div class="container" style="padding-top: 100px; padding-bottom: 80px;">
            <div class="row">
                <div class="col-1 col-sm-2"></div>
                <div class="col-10 col-sm-8 text-center"><p class="h2">Agregar nuevo usuario.</p></div>
                <div class="col-1 col-sm-2"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 text-md-right text-center ">
                    <label for="usuario" class="h5">Nombre del nuevo usuario</label>
                </div>
                <div class="col-sm-6 text-center">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" maxlength=10 class="form-control text-center">
                    <label for="usuario" id="Respuestausuario" style="color: red;"></label>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 text-md-right text-center">
                    <label for="correo" class="h5">Correo electrónico</label>
                </div>
                <div class="col-sm-6 text-center">
                    <input type="text" name="correo" id="correo" placeholder="Correo electrónico" maxlength=100 class="form-control text-center">
                    <label for="correo" id="Respuestacorreo" style="color: red;"></label>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 text-md-right text-center">
                    <label for="contra" class=" h5">Ingrese una contraseña</label>
                </div>
                <div class="col-sm-6 text-center">
                    <input type="password" name="contra" id="contra" placeholder="Contraseña" maxlength=20 class="form-control text-center">
                    <label for="contra" id="Respuestacontra" style="color: red;"></label>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 text-md-right text-center">
                    <label for="contra2" class="h5">Confirme la contraseña</label>
                </div>
                <div class="col-sm-6 text-center">
                    <input type="password" name="contra2" id="contra2" placeholder="Contraseña" maxlength=20 class="form-control text-center">
                    <label for="contra2" id="Respuestacontra2" style="color: red;"></label>
                </div>
                <div class="col-sm-1"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-4 "></div>
                <div class="col-sm-6 text-md-right text-center">
                    <input type="submit" name="agregar" id="agregar" value="Agregar nuevo usuario" class="btn btn-success">
                </div>
                <div class="col-sm-1"></div>
            </div>
        </div>

        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js" ></script>
        <script src="../js/agregar-usuarios.js"></script>
    </body>
</html>