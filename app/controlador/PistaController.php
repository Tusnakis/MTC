<?php

class PistaController
{
    public function mostrarPista()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            $params['resultado'] = Pista::listarPistas();
            $params['resultado2'] = TipoPista::listarTipoPista();
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
            Pista::añadirPista($_POST['numPista'],$_POST['tipoPista']);
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado'] = Pista::listarPistas();
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
            $params['resultado'] = Pista::listarPistaFiltradas($_POST['tipoPista']);
            $params['resultado2'] = TipoPista::listarTipoPista();
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
            Pista::actualizarPista($_POST['pista'],$_POST['numPista']);
            $params['resultado2'] = TipoPista::listarTipoPista();
            $params['resultado'] = Pista::listarPistas();
            require __DIR__ . '/../templates/mostrarPista.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>