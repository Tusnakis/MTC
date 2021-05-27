<?php

class TarifaController
{
    public function mostrarTarifa()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            if (isset($_GET['pagina'])) {
                $params['resultado'] = Tarifa::listarTarifasPaginadas($_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Tarifa::listarTarifasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['paginas'] = ceil(count(Tarifa::listarTarifas()) / 10);
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirTarifa()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            $params['añadido'] = NULL;
            if (intval(ltrim(str_replace(":00","",$_POST['horaInicio']),"0")) > intval(ltrim(str_replace(":00","",$_POST['horaFin']),"0"))) {
                $params['añadido'] = "La hora de inicio no puede ser mayor que la hora de fin.";
            } elseif((intval(ltrim(str_replace(":00","",$_POST['horaInicio']),"0")) - intval(ltrim(str_replace(":00","",$_POST['horaFin']),"0"))) <> -1) {
                $params['añadido'] = "Solo puede haber un intervalo de una hora entre hora de inicio y hora de fin.";
            } else {
                $params['tarifas'] = Tarifa::listarTarifas();
                for ($i = 0; $i < count($params['tarifas']); $i++) {
                    if ($_POST['tipoPista'] == $params['tarifas'][$i]['tipoPista'] && $_POST['horaInicio'] == $params['tarifas'][$i]['hora_inicio'] && $_POST['horaFin'] == $params['tarifas'][$i]['hora_fin']) {
                        $params['añadido'] = "La hora de inicio y de fin ya existe en ese tipo de pista.";
                    }
                }
                if ($params['añadido'] == NULL) {
                    Tarifa::añadirTarifa($_POST['tipoPista'], $_POST['horaInicio'], $_POST['horaFin'], $_POST['precio']);
                }
            }
            if (isset($_POST['pagina']) && isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_POST['tipoPistaP'], $_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas(1, $_POST['tipoPistaP']);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPistaP'])) {
                $params['resultado'] = Tarifa::listarTarifasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Tarifa::listarTarifasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if (isset($_POST['tipoPistaP'])) {
                $params['resultado3'] = $_POST['tipoPistaP'];
                $params['paginas'] = ceil(count(Tarifa::listarTarifasFiltradas($_POST['tipoPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Tarifa::listarTarifas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function actualizarTarifa()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Tarifa::actualizarTarifa($_POST['tarifa'], $_POST['precio']);
            if (isset($_POST['pagina']) && isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_POST['tipoPista'], $_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_POST['tipoPista'], 1);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Tarifa::listarTarifasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if (isset($_POST['tipoPista'])) {
                $params['resultado3'] = $_POST['tipoPista'];
                $params['paginas'] = ceil(count(Tarifa::listarTarifasFiltradas($_POST['tipoPista'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Tarifa::listarTarifas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarTarifa()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Tarifa::eliminarTarifa($_POST['idTarifa']);
            if (isset($_POST['pagina']) && isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_POST['tipoPista'], $_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif (isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas(1, $_POST['tipoPista']);
                $params['paginaActual'] = 1;
            } elseif (isset($_POST['pagina']) && !isset($_POST['tipoPista'])) {
                $params['resultado'] = Tarifa::listarTarifasPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Tarifa::listarTarifasPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if (isset($_POST['tipoPista'])) {
                $params['resultado3'] = $_POST['tipoPista'];
                $params['paginas'] = ceil(count(Tarifa::listarTarifasFiltradas($_POST['tipoPista'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Tarifa::listarTarifas()) / 10);
            }
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarTarifasFiltradas()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            if (isset($_GET['pagina'])) {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_GET['tipoPista'], $_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Tarifa::listarTarifasFiltradasPaginadas($_POST['tipoPista'], 1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if (isset($_GET['tipoPista'])) {
                $params['resultado3'] = $_GET['tipoPista'];
                $params['paginas'] = ceil(count(Tarifa::listarTarifasFiltradas($_GET['tipoPista'])) / 10);
            } else {
                $params['resultado3'] = $_POST['tipoPista'];
                $params['paginas'] = ceil(count(Tarifa::listarTarifasFiltradas($_POST['tipoPista'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}
