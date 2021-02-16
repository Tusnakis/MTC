<?php

class TipoPistaController
{
    public function mostrarTipoPista()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            $params['resultado'] = TipoPista::listarTipoPista();
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
            TipoPista::añadirTipoPista($_POST['nombre']);
            $params['resultado'] = TipoPista::listarTipoPista();
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
            TipoPista::actualizarTipoPista($_POST['idTipoPista'], $_POST['nuevoTipoPista']);
            $params['resultado'] = TipoPista::listarTipoPista();
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
            $params['resultado'] = TipoPista::listarTipoPista();
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
            if(empty($_POST['tipoPista'])) {
                $params['resultado'] = TipoPista::listarTipoPista();
                require __DIR__ . '/../templates/mostrarTipoPista.php';
            } else {
                $params['resultado'] = TipoPista::listarTipoPistaFiltradas($_POST['tipoPista']);
                require __DIR__ . '/../templates/mostrarTipoPista.php';
            }
            $params['resultado'] = TipoPista::listarTipoPista();
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>