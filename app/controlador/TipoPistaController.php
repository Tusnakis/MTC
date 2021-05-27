<?php

class TipoPistaController
{
    public function mostrarTipoPista()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            if($_GET['pagina']) {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas($_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['paginas'] = ceil(count(TipoPista::listarTipoPista()) / 10);
            require __DIR__ . '/../templates/mostrarTipoPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirTipoPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            $params['tipoPistas'] = TipoPista::listarTipoPista();
            $arrayPistas = array();
            for($i = 0; $i < count($params['tipoPistas']); $i++) {
                array_push($arrayPistas,strtolower($params['tipoPistas'][$i]['nombre']));
            }
            if(in_array(strtolower($_POST['nombre']),$arrayPistas)) {
                $params['añadido'] = "El tipo de pista introducido ya existe.";
            } else {
                TipoPista::añadirTipoPista($_POST['nombre']);
            }
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(TipoPista::listarTipoPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(TipoPista::listarTipoPista()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTipoPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function actualizarTipoPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            TipoPista::actualizarTipoPista($_POST['tipoPista'], $_POST['nuevoTipoPista']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(TipoPista::listarTipoPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(TipoPista::listarTipoPista()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTipoPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarTipoPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            TipoPista::eliminarTipoPista($_POST['idTipoPista']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(TipoPista::listarTipoPistaFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(TipoPista::listarTipoPista()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTipoPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarTipoPistaFiltradas()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            if($_GET['pagina']) {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_GET['tipoPista'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradasPaginadas($_POST['tipoPista'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_GET['tipoPista'])) {
                $params['resultado3'] = $_GET['tipoPista'];
                $params['paginas'] = ceil(count(TipoPista::listarTipoPistaFiltradas($_GET['tipoPista'])) / 10);
            } else {
                $params['resultado3'] = $_POST['tipoPista'];
                $params['paginas'] = ceil(count(TipoPista::listarTipoPistaFiltradas($_POST['tipoPista'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarTipoPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>