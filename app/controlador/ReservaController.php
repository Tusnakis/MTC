<?php

class ReservaController
{
    public function mostrarReservaPistas()
    {
        session_start();
        if ($_SESSION['rol'] == 'user') {
            $params['resultado'] = Reserva::listarPistasReserva();
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado3'] = Reserva::listarReservasHechas(date("Y-m-d"));
            $params['resultado4'] = array();
            require __DIR__ . '/../templates/mostrarReservaPistas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarReservasFiltradas()
    {
        session_start();
        if ($_SESSION['rol'] == 'user') {
            $params['resultado'] = Reserva::listarReservasFiltradas($_POST['tipoPista'],$_POST['numPista']);
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado3'] = Reserva::listarReservasHechas($_POST['fecha']);
            $params['resultado4'] = $_POST['fecha'];
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
            $params['resultado'] = Reserva::listarPistasReserva();
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado3'] = Reserva::listarReservasHechas($_POST['fecha']);
            $params['resultado4'] = $_POST['fecha'];
            require __DIR__ . '/../templates/mostrarReservaPistas.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarReservasHechas()
    {
        session_start();
        if($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin') {
            $params['resultado'] = Reserva::listarReservasHechas(date("Y-m-d"));
            $params['resultado4'] = $_POST['fecha'];
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
