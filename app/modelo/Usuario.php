<?php

class Usuario
{
    
    public static function loginUsuario($nombre,$contrasena)
    {
        $sql = "SELECT * FROM usuario 
        WHERE nombre = '$nombre' 
        AND contrasena = '$contrasena'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function datosUsuario($nombre)
    {
        $sql = "SELECT * FROM usuario 
        WHERE nombre = '$nombre'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function registroUsuario($nombre,$contrasena,$email)
    {
        $sql = "INSERT INTO usuario (nombre,contrasena,email)
        VALUES ('$nombre','$contrasena','$email')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>