<?php 
    if(!isset($_SESSION['usuario'])){
        header('Location: ../login.php');
    }
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="registros.php">
        <img src="../images/logo.png" width="40" height="40" class="d-inline-block align-top" alt="">  PRODERE
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <div class="container"></div>
            <li class="nav-item active">
                <a class="nav-link" href="registros.php">Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Alumnos</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ver-alumnos.php">Ver todos los alumnos</a>
                    <a class="dropdown-item" href="agregar-alumnos.php">Agregar alumnos</a>
                    <a class="dropdown-item" href="modificar-alumnos.php">Modificar alumnos</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="eliminar-alumnos.php">Eliminar alumnos</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Libros</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ver-libros.php">Ver todos los libros</a>
                    <a class="dropdown-item" href="agregar-libros.php">Agregar libros</a>
                    <a class="dropdown-item" href="modificar-libros.php">Modificar libros</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="eliminar-libros.php">Eliminar libros</a>
                </div>
            </li>
            <?php
                if($_SESSION['usuario'] == 'admin' || $_SESSION['usuario'] === 'HecSupport'){
                    echo('
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Herramientas</a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="recuperar-registros-eliminados.php">Recuperar registros eliminados</a>
                                <a class="dropdown-item" href="recuperar-alumnos-eliminados.php">Recuperar alumnos eliminados</a>
                                <a class="dropdown-item" href="recuperar-libros-eliminados.php">Recuperar libros eliminados</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="eliminar-registros-definitivamente.php">Eliminar registros definitivamente</a>
                                <a class="dropdown-item" href="eliminar-alumnos-definitivamente.php">Eliminar alumnos definitivamente</a>
                                <a class="dropdown-item" href="eliminar-libros-definitivamente.php">Eliminar libros definitivamente</a>
                            </div>
                        </li>
                    ');
                }
            ?>
        </ul>
        <ul class="navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link active">Usuario: <?php echo $_SESSION['usuario']?></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cuenta</a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="configuracion.php">Configuración</a>
                    <?php
                        if($_SESSION['usuario'] == 'admin' || $_SESSION['usuario'] === 'HecSupport'){
                            if($_SESSION['usuario'] === 'HecSupport'){
                                echo ('<a class="dropdown-item" href="ver-usuarios.php">Ver todos los usuarios</a>');
                            }
                            echo ('
                                <a class="dropdown-item" href="agregar-usuarios.php">Agregar usuarios</a>
                                <a class="dropdown-item" href="eliminar-usuarios.php">Eliminar usuarios</a>
                            ');
                        }
                    ?>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="cerrar-sesion.php">Cerrar sesión</a>
                </div>
            </li>
        </ul>
    </div>
</nav>