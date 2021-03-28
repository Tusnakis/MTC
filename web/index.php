<?php 
// carga del modelo y los controladores 
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/modelo/Conexion.php';
require_once __DIR__ . '/../app/modelo/Usuario.php';
require_once __DIR__ . '/../app/modelo/TipoPista.php';
require_once __DIR__ . '/../app/modelo/Pista.php';
require_once __DIR__ . '/../app/modelo/Tarifa.php';
require_once __DIR__ . '/../app/modelo/Reserva.php';
require_once __DIR__ . '/../app/modelo/Horario.php';
require_once __DIR__ . '/../app/controlador/UsuarioController.php';
require_once __DIR__ . '/../app/controlador/TipoPistaController.php';
require_once __DIR__ . '/../app/controlador/PistaController.php';
require_once __DIR__ . '/../app/controlador/TarifaController.php';
require_once __DIR__ . '/../app/controlador/ReservaController.php';
require_once __DIR__ . '/../app/controlador/HorarioController.php';

// RUTAS
// Este array asociativo se usa para saber qué acción (función del controlador) se debe disparar
$map = array( 
    'mostrarLogin' => array('controller' => 'UsuarioController', 'action' => 'mostrarLogin'),
    'inicio' => array('controller' => 'UsuarioController', 'action' => 'inicio'),
    'logout' => array('controller' => 'UsuarioController', 'action' => 'logout'),
    'mostrarRegistro' => array('controller' => 'UsuarioController', 'action' => 'mostrarRegistro'),
    'registro' => array('controller' => 'UsuarioController', 'action' => 'registro'),
    'mostrarPerfil' => array('controller' => 'UsuarioController', 'action' => 'mostrarPerfil'),
    'perfil' => array('controller' => 'UsuarioController', 'action' => 'perfil'),
    'mostrarUsuarios' => array('controller' => 'UsuarioController', 'action' => 'mostrarUsuarios'),
    'actualizarUsuarios' => array('controller' => 'UsuarioController', 'action' => 'actualizarUsuarios'),
    'eliminarUsuarios' => array('controller' => 'UsuarioController', 'action' => 'eliminarUsuarios'),
    'mostrarUsuariosFiltrados' => array('controller' => 'UsuarioController', 'action' => 'mostrarUsuariosFiltrados'),
    'añadirEmpleado' => array('controller' => 'UsuarioController', 'action' => 'añadirEmpleado'),
    'mostrarTipoPista' => array('controller' => 'TipoPistaController', 'action' => 'mostrarTipoPista'),
    'añadirTipoPista' => array('controller' => 'TipoPistaController', 'action' => 'añadirTipoPista'),
    'actualizarTipoPista' => array('controller' => 'TipoPistaController', 'action' => 'actualizarTipoPista'),
    'eliminarTipoPista' => array('controller' => 'TipoPistaController', 'action' => 'eliminarTipoPista'),
    'listarTipoPistaFiltradas' => array('controller' => 'TipoPistaController', 'action' => 'listarTipoPistaFiltradas'),
    'mostrarPista' => array('controller' => 'PistaController', 'action' => 'mostrarPista'),
    'añadirPista' => array('controller' => 'PistaController', 'action' => 'añadirPista'),
    'listarPistaFiltradas' => array('controller' => 'PistaController', 'action' => 'listarPistaFiltradas'),
    'actualizarPista' => array('controller' => 'PistaController', 'action' => 'actualizarPista'),
    'eliminarPista' => array('controller' => 'PistaController', 'action' => 'eliminarPista'),
    'mostrarTarifa' => array('controller' => 'TarifaController', 'action' => 'mostrarTarifa'),
    'añadirTarifa' => array('controller' => 'TarifaController', 'action' => 'añadirTarifa'),
    'actualizarTarifa' => array('controller' => 'TarifaController', 'action' => 'actualizarTarifa'),
    'eliminarTarifa' => array('controller' => 'TarifaController', 'action' => 'eliminarTarifa'),
    'listarTarifasFiltradas' => array('controller' => 'TarifaController', 'action' => 'listarTarifasFiltradas'),
    'mostrarReservaPistas' => array('controller' => 'ReservaController', 'action' => 'mostrarReservaPistas'),
    'listarReservasFiltradas' => array('controller' => 'ReservaController', 'action' => 'listarReservasFiltradas'),
    'reservarPista' => array('controller' => 'ReservaController', 'action' => 'reservarPista'),
    'mostrarReservasHechas' => array('controller' => 'ReservaController', 'action' => 'mostrarReservasHechas'),
    'eliminarReserva' => array('controller' => 'ReservaController', 'action' => 'eliminarReserva'),
    'mostrarHorario' => array('controller' => 'HorarioController', 'action' => 'mostrarHorario'),
    'listarHorarioFiltrado' => array('controller' => 'HorarioController', 'action' => 'listarHorarioFiltrado'),
    'añadirHorario' => array('controller' => 'HorarioController', 'action' => 'añadirHorario'),
    'asignarHorario' => array('controller' => 'HorarioController', 'action' => 'asignarHorario'),
    'actualizarHorario' => array('controller' => 'HorarioController', 'action' => 'actualizarHorario')
);

// Parseo de la ruta 
if (isset($_GET['ruta'])) 
{ 
    if (isset($map[$_GET['ruta']])) 
    { 
        $ruta = $_GET['ruta']; 
    } 
    else 
    { 
        //Este error saltará si no está definida la ruta arriba en el array asociativo
        header('Status: 404 Not Found'); 
        echo '<html><body><p style="color:red"><b>ERROR: No existe la ruta '.$_GET['ruta'].'</b></p></body></html>'; 
        exit; 
    } 
}
else 
{ 
    $ruta = 'mostrarLogin'; 
}

$controlador = $map[$ruta];

// Ejecucion del controlador asociado a la ruta 
if(method_exists($controlador['controller'], $controlador['action'])) 
{ 
    call_user_func(array(new $controlador['controller'], $controlador['action'])); 
}
else 
{
    //Este error saltará si no está definida la función asociada a la ruta en Controller.php
    header('Status: 404 Not Found'); 
    echo '<html><body><p style="color:red"><b>ERROR: El controlador '.$controlador['controller'].'->'.$controlador['action']. 'no existe</b></p></body></html>'; 
}
?>