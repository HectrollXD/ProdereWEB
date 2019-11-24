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
        <title>Inicio</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css">
    </head>
    <body onload="ejecutarAjax(), vernumreg()">
        <header>
            <?php include "shared/header.php"; ?>
        </header>
        <div class="container" style="padding-top:100px; padding-bottom:80px;">
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"><h2 class="h2 text-center">Registros actuales</h2></div>
                <div class="col-lg-2"></div>
            </div>
            <hr>
            <div class="row" style="background:#f1f1f1; padding-top:10px; padding-bottom:10px;">
                <div class="col-lg-4 col-12" style="padding-bottom:20px;"><input type="text" name="buscar" id="buscar" placeholder="Buscar" class="form-control text-center"></div>
                <div class="col-lg-2 col-4"><h4 class="text-center font-weight-bold">Mostrar:</h4></div>
                <div class="col-lg-2 col-8">
                    <select name="prestamo" id="prestamos" class="form-control text-center">
                        <option onclick="ejecutarAjax()" value="libros">Libros</option>
                        <option onclick="ejecutarAjax()" value="computadoras">Computadoras</option>
                    </select>
                </div>
                <div class="col-lg-2 col-4"><h4 class="text-center font-weight-bold">Estatus:</h4></div>
                <div class="col-lg-2 col-8">
                    <select name="estatus" id="estatus" class="form-control text-center">
                        <option onclick="ejecutarAjax()" value="todos">Todos</option>
                        <option onclick="ejecutarAjax()" value="entregados">Entregados</option>
                        <option onclick="ejecutarAjax()" value="noentregados">Sin entregar</option>
                    </select>
                </div>
            </div>
            <div class="row" style="background:#f1f1f1; padding-top:10px; padding-bottom:10px;">
                <div class="col-lg-2 col-12"><h4 class="text-center font-weight-bold">Ordenar por:</h4></div>
                <div class="col-lg-6 col-6">
                    <select name="ordenar" id="ordenar" class="form-control text-center">
                        <option onclick="ejecutarAjax()" value="1">Números de Registros ascendente.</option>
                        <option onclick="ejecutarAjax()" value="2">Números de Registros descendente.</option>
                        <option onclick="ejecutarAjax()" value="3">Fecha de registro ascendente.</option>
                        <option onclick="ejecutarAjax()" value="4">Fecha Descendente.</option>
                        <option onclick="ejecutarAjax()" value="5">Nombre de alumno A-Z</option>
                        <option onclick="ejecutarAjax()" value="6">Nombre de alumno Z-A</option>
                        <option onclick="ejecutarAjax()" value="7">Código de alumno ascendente</option>
                        <option onclick="ejecutarAjax()" value="8">Código de alumno descendente</option>
                    </select>
                </div>
                <div class="col-lg-4 col-6"><button class="btn btn-primary form-control" id="btnbuscar">Buscar y ordenar</button></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-8"></div>
                <div class="col-lg-2" style="padding-top:20px;"><button class="btn btn-primary form-control" data-toggle="collapse" data-target="#btnreporte">Generar reporte</button></div>
                <div class="col-lg-2" style="padding-top:20px;"><button class="btn btn-danger form-control" data-toggle="collapse" data-target="#eliminar">Eliminar registros</button></div>
            </div>
            <div class="collapse col-lg-12" id="btnreporte">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5"><button class="btn btn-primary form-control" id="reporte-libros">Generar reporte de prestamos de libros</button></div>
                        <div class="col-lg-5"><button class="btn btn-primary form-control" id="reporte-compus">Generar reporte de prestamos de computadoras</button></div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>
            <div class="collapse col-lg-12" id="eliminar">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-lg-3 text-lg-right text-center"><label for="idinicial">Eliminar desde el registro:</label></div>
                        <div class="col-lg-2 text-center"><input type="text" id="idinicial" class="form-control text-center"></div>
                        <div class="col-lg-2 text-lg-right text-center"><label for="idfinal" >Hasta el registro:</label></div>
                        <div class="col-lg-2 text-center"><input type="text" id="idfinal" class="form-control text-center"></div>
                        <div class="col-lg-1 text-lg-right text-center"><label for="idfinal" >Registro:</label></div>
                        <div class="col-lg-2 text-lg-right text-center">
                            <select onchange="vernumreg()" id="nomreg" class="form-control text-center">
                                <option value="libros">Libros</option>
                                <option value="computadoras">Computadoras</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5"></div>
                        <div class="col-lg-7">
                            <label id="respuestaid"></label>
                        </div>
                    </div>
                    <div class="row" style="padding-top:20px;">
                        <div class="col-lg-6"><label for="verificar" style="font-size:16px;" class="font-weight-bold">Para eliminar los registros es necesario confirmar la contraseña.</label></div>
                        <div class="col-lg-4"><input type="password" id="verificar" class="form-control text-center text-lg-left" placeholder="Introduce tu contraseña"></div>
                        <div class="col-lg-2"><button class="btn btn-danger form-control" id="btneliminar">Eliminar</button></div>
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6"><label for="verificar" id="respuesta" style="color:red;"></label></div>
                    </div>
                </div>
            </div>
            <div class="row text-center" style="padding-top:20px;">
                <div class="col-lg-12 table-responsive" id="tabla"></div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/registros.js"></script>
    </body>
</html>