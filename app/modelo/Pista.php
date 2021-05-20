<?php

class Pista
{
    public static function listarPistas()
    {
        $sql = "SELECT p.id, tp.nombre, p.num_pista FROM pista p
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarPistasPaginadas($pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT p.id, tp.nombre, p.num_pista FROM pista p
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function añadirPista($numPista,$idTipoPista)
    {
        $sql = "INSERT into pista (num_pista,id_tipo_pista)
        VALUES ($numPista,$idTipoPista)";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarPistaFiltradas($id)
    {
        $sql = "SELECT p.id, tp.nombre, p.num_pista FROM pista p
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE tp.id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarPistaFiltradasPaginadas($id,$pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT p.id, tp.nombre, p.num_pista FROM pista p
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE tp.id = $id
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function actualizarPista($id,$numPista)
    {
        $sql = "UPDATE pista SET
        num_pista = $numPista
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarPista($id)
    {
        $sql = "DELETE FROM pista
        WHERE id=$id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarNumPistas()
    {
        $sql = "SELECT num_pista FROM pista
        GROUP BY num_pista";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function mostrarUnaPista($id)
    {
        $sql = "SELECT p.num_pista, tp.nombre FROM pista p
        INNER JOIN tipo_pista tp ON p.id_tipo_pista = tp.id
        WHERE p.id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>