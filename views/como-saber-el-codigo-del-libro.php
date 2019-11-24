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
        <div class="container" style="padding-top:100px;padding-bottom:80px;">
            <div class="row text-center">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"><h2>¿Cómo puedo saber el código del libro?</h2></div>
                <div class="col-lg-2"></div>
            </div>
            <hr>
            <div class="row">
                <div class="col-lg-12 text-justify">
                    <p >
                        Para los libros, es necesario tener un ID único, ya que gracias a este se podrá identificar de manera fácil
                        entre muchos libros, a su vez, es clave fundamental al momento de los registros de ellos.
                    </p>
                    <p>
                        Es importante resaltar que habrá varios de ellos repetidos, clasificándose como ejemplares.
                        Estos ID podrán ser repetidos para algunos libros, más sin embargo, deberán tener un número
                        que los resalte de entre ellos mismos, ya que hay libros repetidos con el mismo código pero son
                        distintos ejemplares, esto quiere decir que, se puede colocar un mismo código para los mismos libros,
                        pero, deben de tener un diferenciador entre ellos; como ejemplo: 3 libros iguales (quiere decir que son 3 ejemplares),
                        todos con código 1234, pero esto dará un conflicto entre ID's, para solucionar esto, a cada uno hay que
                        colocarles después de su código su respectivo ejemplar asignado, ejemplo: 1234A (quiere decir que es el libro 1 de su mismo tipo).
                    </p>
                    <p>
                        Nótese que se coloca <b>A</b> para identificar su ejemplar después de su respectivo código. De esta manera, podemos
                        tener un slot de varios libros iguales, con el mismo código y resaltaremos su ejemplar.
                    </p>
                    <p>
                        En resumen. Si tengo 3 libros con el mismo título, a los tres se les colocará el mismo código, la diferencia es que a cada
                        código se le agregará su respectivo ejemplar. <br>
                        <b>Ejemplo:</b><br>
                        <b>1er slot de 3 libros iguales: Códigos:</b> 1000A(para el libro con ejemplar 1), 1000B(para el libro con ejemplar 2), 1000C(para el libro con ejemplar 3).<br>
                        <b>2do slot de 2 libros iguales: Códigos:</b> 1001A(para el libro con ejemplar 1), 1001B(para el libro con ejemplar 2).<br>
                        <b>3er slot de 5 libros iguales: Códigos:</b> 1002A(para el libro con ejemplar 1), 1002B(para el libro con ejemplar 2), 1002C(para el libro con ejemplar 3), 1002D(para el libro con ejemplar 4), 1002E(para el libro con ejemplar 5),<br>
                    </p>
                    <br>
                    <h3>Como puedo generar el código para el libro.</h3>
                    <p>
                        El código se puede generar manualmente, como el seguimiento de un patrón en específico y agregar la edición, pero,
                        para permitir el registro de esto, es necesario contar con el código de barras correspondiente a ese código.
                    </p>
                    <br>
                    <h3>Como genero el código de barras manualmente.</h3>
                    <p>
                        El código de barras se puede generar en Word o Excel del paquete Office de Microsoft, solo es necesario instalar la fuente
                        Bar-Code-39 y realizarlos propiamente.
                    </p>
                    <p>
                        Para poderlos realizar manualmente, puedes descargar la fuente -> <a href="../files/Bar-Code-39.ttf">Bar-Code-39</a><br>
                        Una vez descargada la fuente, procede a instalarla en tu máquina.<br>
                        Después de instalar la fuente, puedes realizar los códigos de los libros en Excel o Word.
                    </p>
                    <p>
                        Pasos para crear los códigos de barra.
                        <ol>
                            <li>Descarga la fuente.</li>
                            <li>Instala la fuente en tu máquina.</li>
                            <li>Abre el editor de textos que prefieras.</li>
                            <li>Escribe entre asteriscos el código del libro. Ejemplo: *123456B* (Es importante colocarlo de esta manera, ya que, si no se realiza
                                esto, el lector de códigos de barras no reconocerá dicho código).</li>
                            <li>Selecciona todo tu código y cambia la fuente por Bar-Code-39.</li>
                            <li>Realiza esto para todos tus códigos.</li>
                        </ol>
                    </p>
                </div>
            </div>
        </div>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap/pooper.min.js"></script>
        <script src="../js/bootstrap/bootstrap.min.js"></script>
        <script src="../js/agregar-libros.js"></script>
    </body>
</html>