<?php

class Reserva
{
    public static function listarPistasReserva()
    {
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarPistasReservaPaginadas($pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasFiltradas($tipoPista,$numPista)
    {
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        WHERE tp.nombre = '$tipoPista'
        AND p.num_pista = $numPista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasFiltradasPaginadas($tipoPista,$numPista,$pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT t.id AS tarifa, p.id AS pista, tp.nombre, p.num_pista, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        INNER JOIN pista p ON tp.id = p.id_tipo_pista
        WHERE tp.nombre = '$tipoPista'
        AND p.num_pista = $numPista
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function reservarPista($usuario,$pista,$tarifa,$fecha)
    {
        $sql = "INSERT INTO reserva (usuario,id_pista,id_tarifa,fecha)
        VALUES ('$usuario',$pista,$tarifa,'$fecha')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarReservasHechas($fecha)
    {
        $sql = "SELECT r.id, tp.nombre, r.usuario, p.num_pista, r.fecha, t.hora_inicio, t.hora_fin, r.id_tarifa FROM reserva r
        INNER JOIN tarifa t ON r.id_tarifa = t.id
        INNER JOIN pista p ON r.id_pista = p.id
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE r.fecha = '$fecha'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarReserva($id)
    {
        $sql = "DELETE FROM reserva
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>