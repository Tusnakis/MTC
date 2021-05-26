<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marc Tennis Club</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon_io/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon_io/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon_io/favicon-16x16.png">
    <link rel="manifest" href="images/favicon_io/site.webmanifest">
    <link rel="stylesheet" href="<?php echo 'css/' . Config::$mvc_css ?>" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-light navLayout">
        <div class="container-md">
            <a class="navbar-brand text-white" href="<?php if (isset($_SESSION['usuario'])) {
                                                            echo 'index.php?ruta=inicio';
                                                        } else {
                                                            echo 'index.php?ruta=mostrarLogin';
                                                        } ?>"><img src="images/marc-1.1.png" alt="logo"></a>
            <?php if (isset($_SESSION['usuario'])) { ?>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <?php if ($_SESSION['rol'] == 'user') { ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarReservasHechas"><i class="fas fa-list-ol"></i>&nbsp;&nbsp;Reservas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarReservaPistas"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Reservar pista</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarListaJugar"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Lista jugadores</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo ucwords($_SESSION['usuario']) ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="index.php?ruta=mostrarPerfil"><i class="far fa-address-card"></i>&nbsp;&nbsp;Perfil</a>
                                    <a class="dropdown-item" href="index.php?ruta=mostrarMensajes"><i class="far fa-envelope"></i>&nbsp;&nbsp;Mensajes
                                        <?php if (count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) > 0) { ?>
                                            <span class="badge badge-danger"><?php echo count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) ?></span>
                                        <?php } ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?ruta=logout"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Cerrar sesión</a>
                                </div>
                            </li>
                        <?php } else if ($_SESSION['rol'] == 'emp') { ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarHorario"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Ver horario</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo ucwords($_SESSION['usuario']) ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="index.php?ruta=mostrarPerfil"><i class="far fa-address-card"></i>&nbsp;&nbsp;Perfil</a>
                                    <a class="dropdown-item" href="index.php?ruta=mostrarMensajes"><i class="far fa-envelope"></i>&nbsp;&nbsp;Mensajes
                                        <?php if (count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) > 0) { ?>
                                            <span class="badge badge-danger"><?php echo count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) ?></span>
                                        <?php } ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?ruta=logout"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Cerrar sesión</a>
                                </div>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarTipoPista"><i class="fas fa-table-tennis"></i>&nbsp;&nbsp;Tipo de pistas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarPista"><i class="fas fa-list-ol"></i>&nbsp;&nbsp;Pistas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarTarifa"><i class="fas fa-euro-sign"></i>&nbsp;&nbsp;Tarifas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarReservasHechas"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Reservas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarListaJugar"><i class="fas fa-clipboard-list"></i>&nbsp;&nbsp;Lista jugadores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarHorario"><i class="far fa-calendar-alt"></i>&nbsp;&nbsp;Horarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="index.php?ruta=mostrarUsuarios"><i class="fas fa-users"></i>&nbsp;&nbsp;Usuarios</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo ucwords($_SESSION['usuario']) ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="index.php?ruta=mostrarPerfil"><i class="far fa-address-card"></i>&nbsp;&nbsp;Perfil</a>
                                    <a class="dropdown-item" href="index.php?ruta=mostrarMensajes"><i class="far fa-envelope"></i>&nbsp;&nbsp;Mensajes
                                        <?php if (count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) > 0) { ?>
                                            <span class="badge badge-danger"><?php echo count(Mensaje::mensajesNoLeidos($_SESSION['usuario'])) ?></span>
                                        <?php } ?>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="index.php?ruta=logout"><i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;Cerrar sesión</a>
                                </div>
                            </li>
                    </ul>
                </div>
            <?php } ?>
        <?php } ?>
        </div>
    </nav>
    <main class="container-md mt-5">
        <?php echo $contenido; ?>
    </main>
    <footer class="footer mt-auto py-3 text-white">
        <div class="container-md">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-3 mx-auto text-center">
                    <p>Encuéntranos en Partida Salto del Agua s/n<br>
                    03503 Benidorm (Alicante)<br>
                    Teléfono: 636107109</p>
                </div>
                <div class="col-12 col-lg-3 mx-auto text-center">
                    <p class="mencion">&copy; 2021 MacWorks Dev S.L.</p>
                </div>
                <div class="col-12 col-lg-3 mx-auto text-center">
                    <p>Siguenos en Facebook <a href="#"><img src="images/fb.png" style="width: 30px; height: 30px;" alt="facebook"></a></p>
                    <p>Siguenos en Instagram <a href="#"><img src="images/insta.png" style="width: 30px; height: 30px;" alt="facebook"></a></p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    <script src="<?php echo 'js/' . Config::$mvc_js ?>"></script>
</body>

</html>