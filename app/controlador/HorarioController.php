<?php

class HorarioController
{
    public function mostrarHorario()
    {
        session_start();
        if ($_SESSION['rol'] == 'emp' || $_SESSION['rol'] == 'admin') {
            $params['resultado'] = Usuario::listarEmpleados();
            $mes = Horario::meses();
            $params['resultado2'] = $this->generarMesHorario($mes[date('n')][0]);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $mes[date('n')][0];
            $params['resultado5'] = "";
            if($_SESSION['rol'] == 'emp') {
                $params['resultado5'] = $_SESSION['usuario'];
            } else {
                $params['resultado5'] = $params['resultado'][0]['usuario'];
            }
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function listarHorarioFiltrado()
    {
        session_start();
        if ($_SESSION['rol'] == 'emp' || $_SESSION['rol'] == 'admin') {
            $params['resultado'] = Usuario::listarEmpleados();
            $params['resultado2'] = $this->generarMesHorario($_POST['mes']);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $_POST['mes'];
            $params['resultado5'] = "";
            if($_SESSION['rol'] == 'emp') {
                $params['resultado5'] = $_SESSION['usuario'];
            } else {
                $params['resultado5'] = $_POST['usuario'];
            }
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function añadirHorario()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Horario::añadirHorario($_POST['puesto']);
            $params['resultado'] = Usuario::listarEmpleados();
            $mes = Horario::meses();
            $params['resultado2'] = $this->generarMesHorario($mes[date('n')][0]);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $mes[date('n')][0];
            $params['resultado5'] = $params['resultado'][0]['usuario'];
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function asignarHorario()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Horario::asignarHorario($_POST['usuario'], $_POST['horario'], $_POST['fecha'], $_POST['turno']);
            $params['resultado'] = Usuario::listarEmpleados();
            $params['resultado2'] = $this->generarMesHorario($_POST['mes']);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $_POST['mes'];
            $params['resultado5'] = $_POST['usuario'];
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function actualizarHorario()
    {
        session_start();
        if ($_SESSION['rol'] == 'admin') {
            Horario::actualizarHorario($_POST['usuario'], $_POST['horario'], $_POST['fecha'], $_POST['turno']);
            $params['resultado'] = Usuario::listarEmpleados();
            $params['resultado2'] = $this->generarMesHorario($_POST['mes']);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $_POST['mes'];
            $params['resultado5'] = $_POST['usuario'];
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }

    public function generarMesHorario($mesElegido)
    {
        $fecha = strtotime($mesElegido);
        $dia = date('d', $fecha);
        $mes = date('m', $fecha);
        $año = date('Y', $fecha);
        $primerDia = mktime(0, 0, 0, $mes, 1, $año);
        $titulo = strftime('%B', $primerDia);
        $diaSemana = date('D', $primerDia);
        $diasMes = cal_days_in_month(0, $mes, $año);
        // $timestamp = strtotime('next Monday');
        // $diasSemana = array();
        // for ($i = 0; $i < 7; $i++) {
        //     $diasSemana[] = strftime('%a', $timestamp);
        //     $timestamp = strtotime('+1 day', $timestamp);
        // }
        $vacio = null;
        if($mesElegido == 'August') {
            $vacio = date('w', strtotime("{$año}-{$mes}-01")) + 6;
        } else {
            $vacio = date('w', strtotime("{$año}-{$mes}-01")) - 1;
        }

        $datos = [
            "titulo" => $titulo,
            "dia" => $dia,
            "año" => $año,
            "diaSemana" => $diaSemana,
            "diasSemana" => ["Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo"],
            "diasMes" => $diasMes,
            "vacio" => $vacio
        ];

        return $datos;
    }

    public function solicitarVacaciones()
    {
        session_start();
        if ($_SESSION['rol'] == 'emp') {
            $texto = "El empleado " . $_SESSION['usuario'] . " ha solicitado vacaciones con fecha de inicio " . $_POST['fechaInicio'] . " y fecha de fin " . $_POST['fechaFin'];
            $params['usuarioPara'] = Usuario::listarUsuariosPorRol('admin');
            Mensaje::enviarMensaje($_SESSION['usuario'],$params['usuarioPara'][0]['usuario'],$texto,date("Y-m-d"));
            $params['resultado'] = Usuario::listarEmpleados();
            $mes = Horario::meses();
            $params['resultado2'] = $this->generarMesHorario($mes[date('n')][0]);
            $params['resultado3'] = Horario::listarHorarios();
            $params['resultado4'] = $mes[date('n')][0];
            $params['resultado5'] = $params['resultado'][0]['usuario'];
            $params['meses'] = Horario::meses();
            $params['resultado6'] = "";
            $params['resultado7'] = 1;
            for($i = 1; $i <= count($params['meses']); $i++) {
                if($params['meses'][$i][0] == $params['resultado2']['titulo']) {
                    $params['resultado6'] = $params['meses'][$i][1];
                    if($i < 10) {
                        $params['resultado7'] = "0" . $i;
                    } else {
                        $params['resultado7'] = $i;
                    }
                }
            }
            $params['asignacionesUsuario'] = Horario::listarAsignacionesUsuario($params['resultado5']);
            $params['resultado8'] = array();
            for($i = 0; $i < count($params['asignacionesUsuario']); $i++) {
                array_push($params['resultado8'], $params['asignacionesUsuario'][$i]['fecha']);
            }
            $params['enviado'] = $_POST['enviado'];
            require __DIR__ . '/../templates/mostrarHorario.php';
        } else if (isset($_SESSION['usuario'])) {
            require __DIR__ . '/../templates/inicio.php';
        } else {
            require __DIR__ . '/../templates/mostrarLogin.php';
        }
    }
}
