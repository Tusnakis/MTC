<?php

class MensajeController
{
    public function mostrarMensajes()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            $params['resultado'] = Mensaje::listarMensajes($_SESSION['usuario']);
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarMensajesFiltrados()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            $params['resultado'] = Mensaje::listarMensajesFiltrados($_SESSION['usuario'],$_POST['archivado'],$_POST['mensajeFecha']);
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['resultado3'] = [$_POST['archivado'],$_POST['mensajeFecha']];
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function archivarMensaje()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            Mensaje::archivarMensaje($_POST['mensaje']);
            $params['resultado'] = Mensaje::listarMensajes($_SESSION['usuario']);
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function enviarMensaje()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            Mensaje::enviarMensaje($_SESSION['usuario'],$_POST['usuarioPara'],$_POST['texto'],date("Y-m-d"));
            $params['resultado'] = Mensaje::listarMensajes($_SESSION['usuario']);
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>