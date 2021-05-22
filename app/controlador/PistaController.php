<?php

class PistaController
{
    public function mostrarPista()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') { 
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Pista::listarPistasPaginadas($_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Pista::listarPistasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['paginas'] = ceil(count(Pista::listarPistas()) / 10);
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Pista::añadirPista($_POST['numPista'],$_POST['tipoPista'],$_POST['patrocinador']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Pista::listarPistasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(Pista::listarPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Pista::listarPistas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarPistaFiltradas()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_GET['tipoPista'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPista'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_GET['tipoPista'])) {
                $params['resultado3'] = $_GET['tipoPista'];
                $params['paginas'] = ceil(count(Pista::listarPistaFiltradas($_GET['tipoPista'])) / 10);
            } else {
                $params['resultado3'] = $_POST['tipoPista'];
                $params['paginas'] = ceil(count(Pista::listarPistaFiltradas($_POST['tipoPista'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function actualizarPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Pista::actualizarPista($_POST['pista'],$_POST['numPista'],$_POST['patrocinador']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Pista::listarPistasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(Pista::listarPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Pista::listarPistas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Pista::eliminarPista($_POST['idPista']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Pista::listarPistasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Pista::listarPistasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(Pista::listarPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Pista::listarPistas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>