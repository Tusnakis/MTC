<?php

class Tarifa
{
    public static function listarTarifas()
    {
        $sql = "SELECT t.id, tp.nombre, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function añadirTarifa($idTipoPista,$horaInicio,$horaFin,$precio)
    {
        $sql = "INSERT INTO tarifa (id_tipo_pista,hora_inicio,hora_fin,precio)
        VALUES ($idTipoPista,'$horaInicio','$horaFin',$precio)";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function actualizarTarifa($id,$precio)
    {
        $sql = "UPDATE tarifa SET
        precio = $precio
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarTarifa($id)
    {
        $sql = "DELETE FROM tarifa
        WHERE id=$id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarTarifasFiltradas($tipoPista)
    {
        $sql = "SELECT t.id, tp.nombre, t.hora_inicio, t.hora_fin, t.precio FROM tarifa t
        INNER JOIN tipo_pista tp ON t.id_tipo_pista = tp.id
        WHERE t.id_tipo_pista = $tipoPista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>