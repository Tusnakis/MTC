<?php

class ReservaController
{
    public function mostrarReservaPistas()
    {
        session_start();
        if ($_SESSION['rol'] == 'user') {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Reserva::listarPistasReservaPaginadas($_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Reserva::listarPistasReservaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado3'] = Reserva::listarReservasHechas(date("Y-m-d"));
            $params['resultado5'] = Pista::listarNumPistas();
            $params['paginas'] = ceil(count(Reserva::listarPistasReserva()) / 10);
            require __DIR__ . '/../templates/mostrarReservaPistas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarReservasFiltradas()
    {
        session_start();
        if ($_SESSION['rol'] == 'user') {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Reserva::listarReservasFiltradasPaginadas($_GET['tipoPista'],$_GET['numPista'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Reserva::listarReservasFiltradasPaginadas($_POST['tipoPista'],$_POST['numPista'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            if(isset($_GET['pagina'])) {
                $params['resultado3'] = Reserva::listarReservasHechas($_GET['fecha']);
            } else {
                $params['resultado3'] = Reserva::listarReservasHechas($_POST['fecha']);
            }
            if(isset($_GET['pagina'])) {
                $params['resultado4'] = array($_GET['fecha'],$_GET['numPista'],$_GET['tipoPista']);
            } else {
                $params['resultado4'] = array($_POST['fecha'],$_POST['numPista'],$_POST['tipoPista']);
            }
            $params['resultado5'] = Pista::listarNumPistas();
            if(isset($_GET['tipoPista']) && $_GET['numPista'] && $_GET['fecha']) {
                $params['resultado6'] = array($_GET['tipoPista'],$_GET['numPista'],$_GET['fecha']);
                $params['paginas'] = ceil(count(Reserva::listarReservasFiltradas($_GET['tipoPista'],$_GET['numPista'])) / 10);
            } else {
                $params['resultado6'] = array($_POST['tipoPista'],$_POST['numPista'],$_POST['fecha']);
                $params['paginas'] = ceil(count(Reserva::listarReservasFiltradas($_POST['tipoPista'],$_POST['numPista'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarReservaPistas.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function reservarPista()
    {
        session_start();
        if ($_SESSION['rol'] == 'user') {
            Reserva::reservarPista($_POST['usuario'],$_POST['pista'],$_POST['tarifa'],$_POST['fecha']);
            if(isset($_POST['pagina']) && isset($_POST['tipoPistaP']) && isset($_POST['numPistaP'])) {
                $params['resultado'] = Reserva::listarReservasFiltradasPaginadas($_POST['tipoPistaP'],$_POST['numPistaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['tipoPistaP']) && isset($_POST['numPistaP'])) {
                $params['resultado'] = Reserva::listarReservasFiltradasPaginadas($_POST['tipoPistaP'],$_POST['numPistaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['tipoPistaP']) && !isset($_POST['numPistaP'])) {
                $params['resultado'] = Reserva::listarPistasReservaPaginadas($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Reserva::listarPistasReservaPaginadas(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado3'] = Reserva::listarReservasHechas($_POST['fecha']);
            if(isset($_POST['fechaP'])) {
                $params['resultado4'] = array($_POST['fechaP'],$_POST['numPistaP'],$_POST['tipoPistaP']);
            }
            $params['resultado5'] = Pista::listarNumPistas();
            if(isset($_POST['tipoPistaP']) && isset($_POST['numPistaP'])) {
                $params['resultado6'] = array($_POST['tipoPistaP'],$_POST['numPistaP'],$_POST['fechaP']);
                $params['paginas'] = ceil(count(Reserva::listarReservasFiltradas($_POST['tipoPistaP'],$_POST['numPistaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Reserva::listarPistasReserva()) / 10);
            }
            require __DIR__ . '/../templates/mostrarReservaPistas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarReservasHechas()
    {
        session_start();
        if($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin') {
            if(isset($_POST['fecha'])) {
                $params['resultado'] = Reserva::listarReservasHechas($_POST['fecha']);
                $params['resultado4'] = $_POST['fecha'];
            } else {
                $params['resultado'] = Reserva::listarReservasHechas(date("Y-m-d"));
            }
            require __DIR__ . '/../templates/mostrarReservasHechas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarReserva()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            Reserva::eliminarReserva($_POST['idReserva']);
            $params['resultado'] = Reserva::listarReservasHechas($_POST['fecha']);
            $params['resultado4'] = $_POST['fecha'];
            require __DIR__ . '/../templates/mostrarReservasHechas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}
