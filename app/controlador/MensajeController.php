<?php

class MensajeController
{
    public function mostrarMensajes()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['paginas'] = ceil(count(Mensaje::listarMensajes($_SESSION['usuario'])) / 10);
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarMensajesFiltrados()
    {
        session_start();
        if(isset($_SESSION['usuario'])) {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_GET['archivado'],$_GET['mensajeFecha'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_POST['archivado'],$_POST['mensajeFecha'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            if(isset($_GET['archivado']) && isset($_GET['mensajeFecha'])) {
                $params['resultado3'] = [$_GET['archivado'],$_GET['mensajeFecha']];
                $params['paginas'] = ceil(count(Mensaje::listarMensajesFiltrados($_SESSION['usuario'],$_GET['archivado'],$_GET['mensajeFecha'])) / 10);
            } else {
                $params['resultado3'] = [$_POST['archivado'],$_POST['mensajeFecha']];
                $params['paginas'] = ceil(count(Mensaje::listarMensajesFiltrados($_SESSION['usuario'],$_POST['archivado'],$_POST['mensajeFecha'])) / 10);
            }
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
            if(isset($_POST['pagina']) && isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['archivadoP']) && !isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            if(isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado3'] = [$_POST['archivadoP'],$_POST['mensajeFechaP']];
                $params['paginas'] = ceil(count(Mensaje::listarMensajesFiltrados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Mensaje::listarMensajes($_SESSION['usuario'])) / 10);
            }
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
            if(isset($_POST['pagina']) && isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesFiltradosPaginados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['archivadoP']) && !isset($_POST['mensajeFechaP'])) {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = Mensaje::listarMensajesPaginados($_SESSION['usuario'],1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['enviado'] = $_POST['enviar'];
            if(isset($_POST['archivadoP']) && isset($_POST['mensajeFechaP'])) {
                $params['resultado3'] = [$_POST['archivadoP'],$_POST['mensajeFechaP']];
                $params['paginas'] = ceil(count(Mensaje::listarMensajesFiltrados($_SESSION['usuario'],$_POST['archivadoP'],$_POST['mensajeFechaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(Mensaje::listarMensajes($_SESSION['usuario'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarMensajes.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>