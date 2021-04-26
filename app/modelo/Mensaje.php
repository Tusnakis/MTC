<?php

class Mensaje
{
    public static function enviarMensaje($id_usuarioDe,$id_usuarioPara,$texto,$fecha)
    {
        $sql = "INSERT INTO mensaje (id_usuarioDe,id_usuarioPara,texto,fecha)
        VALUES ('$id_usuarioDe','$id_usuarioPara','$texto','$fecha')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarMensajes($id_usuarioPara)
    {
        $sql = "SELECT id, id_usuarioDe, id_usuarioPara, texto, fecha FROM mensaje
        WHERE id_usuarioPara = '$id_usuarioPara'
        AND archivado = 0";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function mensajesNoLeidos($id_usuarioPara)
    {
        $sql = "SELECT * FROM mensaje
        WHERE id_usuarioPara = '$id_usuarioPara'
        AND archivado = 0";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function archivarMensaje($id)
    {
        $sql = "UPDATE mensaje SET archivado = 1
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>