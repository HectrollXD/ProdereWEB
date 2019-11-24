<!DOCTYPE html>
<html lang="es">
    <head>
        <?php 
            session_start(); 
            include ('../php/verificar-inicio-login.php');
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" type="image/x-icon" href="../images/logo.png"/>
        <title>Iniciar Sesión</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <?php include ("shared/header.php"); ?>
        </header>
        <div class="container">
            <div class="row" style="padding-top: 100px;">
                <div class="col-sm-3 col-1"></div>
                <div class="col-sm-6 col-10  text-center">
                    <form method="post">
                        <div class="form-group">
                            <label for="usuario" class="h5">Ingresa nombre usuario o correo electróncio</label>
                            <input name="usuario" id="usuario" type="text" class="form-control text-center" aria-describedby="emailHelp" placeholder="Usuario o correo" maxlength=100>
                            <label for="usuario" id="Respuestausuario" style="color: red;"></label>
                        </div>
                        <div class="form-group">
                            <label for="contra" class="h5">Ingresa tu contraseña</label>
                            <input name="contra" id="contra" type="password" class="form-control text-center" placeholder="Contraseña" maxlength=20>
                            <label for="contra" id="Respuestacontra" style="color: red;"></label>
                        </div>
                        <input type="submit" id="enviar" class="btn btn-primary" value="Iniciar Sesión">
                    </form>
                </div>
                <div class="col-sm-3 col-1"></div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js" ></script>
        <script src="../js/validar-inicio-de-sesion.js"></script>
    </body>
</html>