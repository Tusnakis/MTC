<?php

class TarifaController
{
    public function mostrarTarifa()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            $params['resultado'] = Tarifa::listarTarifas();
            $params['resultado2'] = TipoPista::listarTipoPista();
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
            Tarifa::añadirTarifa($_POST['tipoPista'],$_POST['horaInicio'],$_POST['horaFin'],$_POST['precio']);
            $params['resultado'] = Tarifa::listarTarifas();
            $params['resultado2'] = TipoPista::listarTipoPista();
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
            Tarifa::actualizarTarifa($_POST['tarifa'],$_POST['precio']);
            $params['resultado'] = Tarifa::listarTarifas();
            $params['resultado2'] = TipoPista::listarTipoPista();
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
            $params['resultado'] = Tarifa::listarTarifas();
            $params['resultado2'] = TipoPista::listarTipoPista();
            require __DIR__ . '/../templates/mostrarTarifa.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>