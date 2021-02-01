<?php

class UsuarioController
{
    //Función muestra pantalla login
    public function mostrarLogin()
    {
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarRegistro()
    {
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarRegistro.php';
        }
    }

    public function registro()
    {
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else if(empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['email'])){
            require __DIR__ . '/../templates/mostrarRegistro.php';
        } else {
            Usuario::registroUsuario($_POST['usuario'],$_POST['contrasena'],$_POST['email']);
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function inicio()
    {
        session_start();
        if(isset($_SESSION['usuario']))
        {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            if(empty($_POST['usuario']) && empty($_POST['contrasena'])) {
                require __DIR__ . '/../templates/mostrarLogin.php';
            } else {
                $params['resultado'] = Usuario::loginUsuario($_POST['usuario'], $_POST['contrasena']);
                $_SESSION['usuario'] = $params['resultado'][0]['nombre'];
                $_SESSION['email'] = $params['resultado'][0]['email'];
                $_SESSION['rol'] = $params['resultado'][0]['rol'];
                if(empty($params['resultado'])) {
                    $params['resultado'] = "Datos incorrectos";
                    require __DIR__ . '/../templates/mostrarLogin.php';
                } else if(empty($_SESSION['usuario'])) {
                    require __DIR__ . '/../templates/mostrarLogin.php';
                } else {
                    require __DIR__ . '/../templates/inicio.php';
                }
            }
        }
    }

    public function logout()
    {
        session_start();

        if (isset($_SESSION['usuario'])) {
            $_SESSION = array();
            unset($_SESSION["usuario"]);
            session_destroy();
        }

        require __DIR__ . '/../templates/mostrarLogin.php';
    }
}
