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
        <title>Configuración</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body>
        <header>
            <?php include ("shared/header.php"); ?>
        </header>
        <div class="container" style="padding-top:100px; padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6 text-center"><h2>Configuración</h2></div>
                <div class="col-lg-3"></div>
            </div>
            <hr>
            <div class="container" style="background: #f7f7f7; border-radius:20px;">
                <div class="row">
                    <div class="col-lg-12 text-left" style="padding:20px;"><h3 class="h3">Seguridad</h3></div>
                </div>
                <div class="row">
                    <div class="col-lg-12 text-center"><label class="h4">Cambiar contraseña</label></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 text-center"><label for="concontra" class="h4">Contraseña actual</label></div>
                    <div class="col-lg-5">
                        <input type="password" name="concontra" id="concontra" class="form-control" placeholder="Ingrese la contraseña actual">
                        <label for="concontra" style="color:red;" id="respuestaconcontra"></label>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 text-center"><label for="contra" class="h4">Contraseña nueva</label></div>
                    <div class="col-lg-5">
                        <input type="password" name="contra" id="contra" class="form-control" placeholder="Ingrese la contraseña nueva">
                        <label for="contra" style="color:red;" id="respuestacontra"></label>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 text-center"><label for="contra2" class="h4">Confirmar la nueva contraseña</label></div>
                    <div class="col-lg-5">
                        <input type="password" name="contra2" id="contra2" class="form-control" placeholder="Confirme la nueva contraseña">
                        <label for="contra2" style="color:red;" id="respuestacontra2"></label>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <br>
                <div class="row" style="padding-bottom:20px;">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-5 text-center"></div>
                    <div class="col-lg-5">
                        <button class="btn btn-primary form-control" id="btncambiar">Cambiar contraseña</button>
                    </div>
                    <div class="col-lg-1"></div>
                </div>
                <br>
            </div>
            
            <?php
                if($_SESSION['usuario'] != 'admin' && $_SESSION['usuario'] != 'HecSupport'){
                    echo'
                    <hr>
                    <div class="container" style="background: #f7f7f7; border-radius:20px;">
                        <div class="row">
                            <div class="col-lg-12 text-left" style="padding:20px;"><h3 class="h3">Herramientas</h3></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center"><label class="h4">Eliminar cuenta</label></div>
                        </div>
                        <br>
                        <div class="row" style="padding-bottom:20px;">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"><button class="btn btn-danger form-control" id="eliminar">Eliminar mi cuenta PRODERE</button></div>
                            <div class="col-lg-4"></div>
                        </div>
                        <br>
                        <div class="row" style="padding-bottom:20px;">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8 text-center"><label for="confirmar" id="confirmarlbl" style="display:none;">Para eliminar la cuneta es necesario ingresar la contraseña actual.</label></div>
                            <div class="col-lg-2"></div>
                        </div>
                        <div class="row" style="padding-bottom:20px;">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8 text-center"><input type="password" name="confirmar" id="confirmar"class="form-control text-center" placeholder="Ingrese su contraseña actual" style="display:none;"></div>
                            <div class="col-lg-2"></div>
                        </div>
                    </div>';
                }
            ?>
        
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/configuracion.js"></script>
    </body>
</html>