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
            $params['resultado'] = Usuario::datosUsuario($_POST['usuario']);
            if(empty($params['resultado'])) {
                Usuario::registroUsuario($_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email']);
                require __DIR__ . '/../templates/mostrarLogin.php';
            } else {
                $params['resultado'] = "El usuario ya existe";
                require __DIR__ . '/../templates/mostrarRegistro.php';
            }
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
                $params['resultado'] = Usuario::loginUsuario($_POST['usuario'], sha1($_POST['contrasena']));
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
            /*$_SESSION['usuario'] = $params['resultado'][0]['usuario'];
            $_SESSION['contrasena'] = $params['resultado'][0]['contrasena'];
            $_SESSION['nombre'] = $params['resultado'][0]['nombre'];
            $_SESSION['apellidos'] = $params['resultado'][0]['apellidos'];
            $_SESSION['email'] = $params['resultado'][0]['email'];*/
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
            $array = explode('.', $name);
            $ext = end($array);
            $nuevo_path = 'images/foto_' . $_SESSION['usuario'] . '.' . $ext;
            $arrayUsuario['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            if ($arrayUsuario['resultado'][0]['foto'] == $nuevo_path) {
                move_uploaded_file($tmp_name, $nuevo_path);
            } elseif(empty($ext)) {
                $nuevo_path = "";
            } else {
                unlink($arrayUsuario['resultado'][0]['foto']);
                move_uploaded_file($tmp_name, $nuevo_path);
            }
            Usuario::actualizaUsuario($_SESSION['usuario'], $_POST['usuario'], $_POST['contrasena'], $_POST['nombre'], $_POST['apellidos'], $_POST['email'],$_POST['categoria'], $nuevo_path);
            /*$_SESSION['usuario'] = $_POST['usuario'];
            $params['resultado'] = Usuario::datosUsuario($_SESSION['usuario']);
            $_SESSION['usuario'] = $params['resultado'][0]['usuario'];
            $_SESSION['contrasena'] = $params['resultado'][0]['contrasena'];
            $_SESSION['nombre'] = $params['resultado'][0]['nombre'];
            $_SESSION['apellidos'] = $params['resultado'][0]['apellidos'];
            $_SESSION['email'] = $params['resultado'][0]['email'];
            $_SESSION['foto'] = $params['resultado'][0]['foto'];*/
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
            if (isset($_GET['pagina'])) {
                $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], $_GET['pagina']);
                $params['paginaActual'] = $_GET['pagina'];
            } else {
                $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], 1);
                $params['paginaActual'] = 1;
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
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
            if (isset($_GET['pagina'])) {
                if (empty($_GET['usuario']) && empty($_GET['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], $_GET['pagina']);
                    $params['paginaActual'] = $_GET['pagina'];
                } else if (!empty($_GET['usuario']) && empty($_GET['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorNombrePaginados($_GET['usuario'], $_GET['pagina']);
                    $params['paginaActual'] = $_GET['pagina'];
                } else if (empty($_GET['usuario']) && !empty($_GET['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorRolPaginados($_GET['rol'], $_GET['pagina']);
                    $params['paginaActual'] = $_GET['pagina'];
                } else {
                    $params['resultado'] = Usuario::listarUsuariosFiltradosPaginados($_GET['usuario'], $_GET['rol'], $_GET['pagina']);
                    $params['paginaActual'] = $_GET['pagina'];
                }
            } else {
                if (empty($_POST['usuario']) && empty($_POST['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], 1);
                    $params['paginaActual'] = 1;
                } else if (!empty($_POST['usuario']) && empty($_POST['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorNombrePaginados($_POST['usuario'], 1);
                    $params['paginaActual'] = 1;
                } else if (empty($_POST['usuario']) && !empty($_POST['rol'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorRolPaginados($_POST['rol'], 1);
                    $params['paginaActual'] = 1;
                } else {
                    $params['resultado'] = Usuario::listarUsuariosFiltradosPaginados($_POST['usuario'], $_POST['rol'], 1);
                    $params['paginaActual'] = 1;
                }
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            if (isset($_GET['pagina'])) {
                $params['resultado3'] = $_GET['usuario'];
            } else {
                $params['resultado3'] = $_POST['usuario'];
            }
            if (isset($_GET['pagina'])) {
                $params['resultado4'] = $_GET['rol'];
            } else {
                $params['resultado4'] = $_POST['rol'];
            }
            if (isset($_GET['pagina'])) {
                if (empty($_GET['usuario']) && empty($_GET['rol'])) {
                    $params['resultado5'] = array($_GET['usuario'], $_GET['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
                } else if (!empty($_GET['usuario']) && empty($_GET['rol'])) {
                    $params['resultado5'] = array($_GET['usuario'], $_GET['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorNombre($_GET['usuario'])) / 10);
                } else if (empty($_GET['usuario']) && !empty($_GET['rol'])) {
                    $params['resultado5'] = array($_GET['usuario'], $_GET['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorRol($_GET['rol'])) / 10);
                } else {
                    $params['resultado5'] = array($_GET['usuario'], $_GET['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosFiltrados($_GET['usuario'], $_GET['rol'])) / 10);
                }
            } else {
                if (empty($_POST['usuario']) && empty($_POST['rol'])) {
                    $params['resultado5'] = array($_POST['usuario'], $_POST['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
                } else if (!empty($_POST['usuario']) && empty($_POST['rol'])) {
                    $params['resultado5'] = array($_POST['usuario'], $_POST['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorNombre($_POST['usuario'])) / 10);
                } else if (empty($_POST['usuario']) && !empty($_POST['rol'])) {
                    $params['resultado5'] = array($_POST['usuario'], $_POST['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorRol($_POST['rol'])) / 10);
                } else {
                    $params['resultado5'] = array($_POST['usuario'], $_POST['rol']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosFiltrados($_POST['usuario'], $_POST['rol'])) / 10);
                }
            }
            require __DIR__ . '/../templates/mostrarUsuarios.php';
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
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorNombrePaginados($_POST['usuarioP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorRolPaginados($_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else {
                    $params['resultado'] = Usuario::listarUsuariosFiltradosPaginados($_POST['usuarioP'], $_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                }
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['resultado3'] = $_POST['usuarioP'];
            $params['resultado4'] = $_POST['rolP'];
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorNombre($_POST['usuarioP'])) / 10);
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorRol($_POST['rolP'])) / 10);
                } else {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosFiltrados($_POST['usuarioP'], $_POST['rolP'])) / 10);
                }
            }
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
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorNombrePaginados($_POST['usuarioP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorRolPaginados($_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else {
                    $params['resultado'] = Usuario::listarUsuariosFiltradosPaginados($_POST['usuarioP'], $_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                }
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['resultado3'] = $_POST['usuarioP'];
            $params['resultado4'] = $_POST['rolP'];
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorNombre($_POST['usuarioP'])) / 10);
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorRol($_POST['rolP'])) / 10);
                } else {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosFiltrados($_POST['usuarioP'], $_POST['rolP'])) / 10);
                }
            }
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
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPaginados($_SESSION['usuario'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorNombrePaginados($_POST['usuarioP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado'] = Usuario::listarUsuariosPorRolPaginados($_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                } else {
                    $params['resultado'] = Usuario::listarUsuariosFiltradosPaginados($_POST['usuarioP'], $_POST['rolP'], $_POST['pagina']);
                    $params['paginaActual'] = $_POST['pagina'];
                }
            }
            $params['resultado2'] = Usuario::listarUsuarios($_SESSION['usuario']);
            $params['resultado3'] = $_POST['usuarioP'];
            $params['resultado4'] = $_POST['rolP'];
            if (isset($_POST['pagina'])) {
                if (empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuarios($_SESSION['usuario'])) / 10);
                } else if (!empty($_POST['usuarioP']) && empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorNombre($_POST['usuarioP'])) / 10);
                } else if (empty($_POST['usuarioP']) && !empty($_POST['rolP'])) {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosPorRol($_POST['rolP'])) / 10);
                } else {
                    $params['resultado5'] = array($_POST['usuarioP'], $_POST['rolP']);
                    $params['paginas'] = ceil(count(Usuario::listarUsuariosFiltrados($_POST['usuarioP'], $_POST['rolP'])) / 10);
                }
            }
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
