<?php

class Horario
{
    public static function añadirHorario($puesto)
    {
        $sql = "INSERT INTO horario (puesto)
        VALUES ('$puesto')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function asignarHorario($usuario,$horario,$fecha,$turno)
    {
        $sql = "INSERT INTO asignacion (usuario,id_horario,fecha,turno)
        VALUES ('$usuario',$horario,'$fecha',$turno)";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function actualizarHorario($usuario,$horario,$fecha,$turno)
    {
        $sql = "UPDATE asignacion SET usuario = '$usuario', id_horario = $horario, fecha = '$fecha', turno = $turno
        WHERE usuario = '$usuario'
        AND fecha = '$fecha'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarHorarios()
    {
        $sql = "SELECT * FROM horario";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarAsignacionesUsuario($usuario)
    {
        $sql = "SELECT a.id, a.usuario, h.puesto, a.fecha, a.turno FROM asignacion a
        INNER JOIN horario h ON a.id_horario = h.id
        WHERE usuario = '$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function meses()
    {
        $meses = [
            1 => ["January","Enero"],
            2 => ["February","Febrero"],
            3 => ["March","Marzo"],
            4 => ["April","Abril"],
            5 => ["May","Mayo"],
            6 => ["June","Junio"],
            7 => ["July","Julio"],
            8 => ["August","Agosto"],
            9 => ["September","Septiembre"],
            10 => ["October","Octubre"],
            11 => ["November","Noviembre"],
            12 => ["December","Diciembre"]
        ];

        return $meses;
    }
}

?>