<?php

class UsuarioController
{
    //Función muestra pantalla login
    public function mostrarLogin()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarRegistro()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarRegistro.php';
        }
    }

    public function registro()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            require __DIR__ . '/../templates/inicio.php';
        } else if (empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email'])) {
            require __DIR__ . '/../templates/mostrarRegistro.php';
        } else {
            Usuario::registroUsuario($_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email']);
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function inicio()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            if (empty($_POST['usuario']) && empty($_POST['contrasena'])) {
                require __DIR__ . '/../templates/mostrarLogin.php';
            } else {
                $params['resultado'] = Usuario::loginUsuario($_POST['usuario'], $_POST['contrasena']);
                $_SESSION['usuario'] = $params['resultado'][0]['usuario'];
                $_SESSION['nombre'] = $params['resultado'][0]['nombre'];
                $_SESSION['apellidos'] = $params['resultado'][0]['apellidos'];
                $_SESSION['email'] = $params['resultado'][0]['email'];
                $_SESSION['rol'] = $params['resultado'][0]['rol'];
                if (empty($params['resultado'])) {
                    $params['resultado'] = "Datos incorrectos";
                    require __DIR__ . '/../templates/mostrarLogin.php';
                } else if (empty($_SESSION['usuario'])) {
                    require __DIR__ . '/../templates/mostrarLogin.php';
                } else {
                    require __DIR__ . '/../templates/inicio.php';
                }
            }
        }
    }

    public function mostrarPerfil()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            $_SESSION['usuario'] = $params['resultado'][0]['usuario'];
            $_SESSION['contrasena'] = $params['resultado'][0]['contrasena'];
            $_SESSION['nombre'] = $params['resultado'][0]['nombre'];
            $_SESSION['apellidos'] = $params['resultado'][0]['apellidos'];
            $_SESSION['email'] = $params['resultado'][0]['email'];
            require __DIR__ . '/../templates/mostrarPerfil.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function perfil()
    {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $tmp_name = $_FILES['imagen']["tmp_name"];
            $name = $_FILES['imagen']["name"];
            $nuevo_path = 'images/' . $name;
            move_uploaded_file($tmp_name, $nuevo_path);
            Usuario::actualizaUsuario($_SESSION['usuario'], $_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $nuevo_path);
            $_SESSION['usuario'] = $_POST['usuario'];
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            $_SESSION['usuario'] = $params['resultado'][0]['usuario'];
            $_SESSION['contrasena'] = $params['resultado'][0]['contrasena'];
            $_SESSION['nombre'] = $params['resultado'][0]['nombre'];
            $_SESSION['apellidos'] = $params['resultado'][0]['apellidos'];
            $_SESSION['email'] = $params['resultado'][0]['email'];
            $_SESSION['foto'] = $params['resultado'][0]['foto'];
            require __DIR__ . '/../templates/inicio.php';
        } else if (isset($_SESSION['usuario']) && (empty($_POST['usuario']) || empty($_POST['contrasena']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']))) {
            require __DIR__ . '/../templates/mostrarPerfil.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarUsuarios()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarUsuarios.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function mostrarUsuariosFiltrados()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            if (empty($_POST['usuario']) && empty($_POST['rol'])) {
                $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
                require __DIR__ . '/../templates/mostrarUsuarios.php';
            } else if (!empty($_POST['usuario']) && empty($_POST['rol'])) {
                if ($_POST['usuario'] == $_SESSION['usuario']) {
                    $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
                    require __DIR__ . '/../templates/mostrarUsuarios.php';
                } else {
                    $params['resultado'] = Usuario::listarUsuariosPorNombre($_POST['usuario']);
                    require __DIR__ . '/../templates/mostrarUsuarios.php';
                }
            } else if (empty($_POST['usuario']) && !empty($_POST['rol'])) {
                $params['resultado'] = Usuario::listarUsuariosPorRol($_POST['rol']);
                require __DIR__ . '/../templates/mostrarUsuarios.php';
            } else {
                $params['resultado'] = Usuario::listarUsuariosFiltrados($_POST['usuario'], $_POST['rol']);
                require __DIR__ . '/../templates/mostrarUsuarios.php';
            }
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirEmpleado()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Usuario::añadirEmpleado($_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['rol']);
            $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarUsuarios.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function actualizarUsuarios()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Usuario::actualizarUsuarios($_POST['usuario'], $_POST['nuevoUsuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'], $_POST['rol']);
            $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarUsuarios.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function eliminarUsuarios()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Usuario::eliminarUsuarios($_POST['usuario']);
            $params['resultado'] = Usuario::listarUsuarios($_SESSION['usuario']);
            require __DIR__ . '/../templates/mostrarUsuarios.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
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
