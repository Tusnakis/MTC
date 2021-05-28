<?php

class ListaJugarController
{
    public function mostrarListaJugar()
    {
        session_start();
        if($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin') {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados($_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados(1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = date('Y-m-d');
            $params['tipoPista'] = TipoPista::listarTipoPista();
            $params['paginas'] = ceil(count(ListaJugar::listarUsuariosLista()) / 10);
            require __DIR__ . '/../templates/mostrarListaJugar.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirListaJugar()
    {
        session_start();
        if($_SESSION['rol'] == 'user') {
            if(intval(ltrim(str_replace(":00","",$_POST['horaInicio']),"0")) > intval(ltrim(str_replace(":00","",$_POST['horaFin']),"0")) || intval(ltrim(str_replace(":00","",$_POST['horaFin']),"0")) < date('G')) {
                $params['apuntado'] = "La hora de inicio no puede ser mayor que la hora de fin o la hora de fin menor que la hora actual";
                $aviso = "danger";
            } else {
                $params['apuntado'] = "Te has apuntado correctamente. Recibirás un mensaje del usuario que te haya elegido.";
                $aviso = "success";
                ListaJugar::añadirListaJugar($_SESSION['usuario'],$_POST['fecha'],$_POST['horaInicio'],$_POST['horaFin'],$_POST['categoria']);
            }
            if(isset($_POST['pagina']) && $_POST['fechaP'] && $_POST['categoriaP']) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['fechaP']) && !isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados(1);
                $params['paginaActual'] = 1;
            }
            $params['tipoPista'] = TipoPista::listarTipoPista();
            if(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado2'] = $_POST['fechaP'];
                $params['resultado3'] = $_POST['categoriaP'];
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosListaFiltrados($_POST['fechaP'],$_POST['categoriaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosLista()) / 10);
            }
            require __DIR__ . '/../templates/mostrarListaJugar.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarUsuariosListaFiltrados()
    {
        session_start();
        if($_SESSION['rol'] == 'user' || $_SESSION['rol'] == 'admin') {
            if(isset($_GET['pagina'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_GET['fecha'],$_GET['categoria'],$_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fecha'],$_POST['categoria'],1);
                $params['paginaActual'] = 1;
            }
            $params['tipoPista'] = TipoPista::listarTipoPista();
            if(isset($_GET['fecha']) && isset($_GET['categoria'])) {
                $params['resultado2'] = $_GET['fecha'];
                $params['resultado3'] = $_GET['categoria'];
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosListaFiltrados($_GET['fecha'],$_GET['categoria'])) / 10);
            } else {
                $params['resultado2'] = $_POST['fecha'];
                $params['resultado3'] = $_POST['categoria'];
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosListaFiltrados($_POST['fecha'],$_POST['categoria'])) / 10);
            }
            require __DIR__ . '/../templates/mostrarListaJugar.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function elegirUsuarioLista()
    {
        session_start();
        if($_SESSION['rol'] == 'user') {
            ListaJugar::elegirUsuarioLista($_POST['id'],$_SESSION['usuario'],$_POST['tipoPista'],$_POST['numPista'],$_POST['horaInicio']);
            if(isset($_POST['pagina']) && $_POST['fechaP'] && $_POST['categoriaP']) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['fechaP']) && !isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados(1);
                $params['paginaActual'] = 1;
            }
            $params['tipoPista'] = TipoPista::listarTipoPista();
            if(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado2'] = $_POST['fechaP'];
                $params['resultado3'] = $_POST['categoriaP'];
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosListaFiltrados($_POST['fechaP'],$_POST['categoriaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosLista()) / 10);
            }
            $tipoPista = "";
            for($i = 0; $i < count($params['tipoPista']); $i++) {
                if($params['tipoPista'][$i]['id'] == $_POST['tipoPista']) {
                    $tipoPista = $params['tipoPista'][$i]['nombre'];
                }
            }
            $mensaje = 'Has sido elegido por ' . $_SESSION['usuario'] . ' para jugar en la pista nº ' . $_POST['numPista'] . ' de ' . $tipoPista . ' a las ' . $_POST['horaInicio'] . ' horas el día ' . $params['resultado2'];
            Mensaje::enviarMensaje($_SESSION['usuario'],$_POST['usuarioA'],$mensaje,date('Y-m-d'));
            require __DIR__ . '/../templates/mostrarListaJugar.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarUsuarioLista()
    {
        session_start();
        if($_SESSION['rol'] == 'admin') {
            ListaJugar::eliminarUsuarioLista($_POST['id']);
            if(isset($_POST['pagina']) && $_POST['fechaP'] && $_POST['categoriaP']) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],$_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } elseif(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaFiltradosPaginados($_POST['fechaP'],$_POST['categoriaP'],1);
                $params['paginaActual'] = 1;
            } elseif(isset($_POST['pagina']) && !isset($_POST['fechaP']) && !isset($_POST['categoriaP'])) {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados($_POST['pagina']);
                $params['paginaActual'] = $_POST['pagina'];
            } else {
                $params['resultado'] = ListaJugar::listarUsuariosListaPaginados(1);
                $params['paginaActual'] = 1;
            }
            $params['tipoPista'] = TipoPista::listarTipoPista();
            if(isset($_POST['fechaP']) && isset($_POST['categoriaP'])) {
                $params['resultado2'] = $_POST['fechaP'];
                $params['resultado3'] = $_POST['categoriaP'];
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosListaFiltrados($_POST['fechaP'],$_POST['categoriaP'])) / 10);
            } else {
                $params['paginas'] = ceil(count(ListaJugar::listarUsuariosLista()) / 10);
            }
            require __DIR__ . '/../templates/mostrarListaJugar.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}

?>