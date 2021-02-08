<?php 
// carga del modelo y los controladores 
require_once __DIR__ . '/../app/Config.php';
require_once __DIR__ . '/../app/modelo/Conexion.php';
require_once __DIR__ . '/../app/modelo/Usuario.php';
require_once __DIR__ . '/../app/controlador/UsuarioController.php';

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
    'añadirEmpleado' => array('controller' => 'UsuarioController', 'action' => 'añadirEmpleado')
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