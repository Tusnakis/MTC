<?php

class Usuario
{
    
    public static function loginUsuario($usuario,$contrasena)
    {
        $sql = "SELECT * FROM usuario 
        WHERE usuario = '$usuario' 
        AND contrasena = '$contrasena'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function datosUsuario($usuario)
    {
        $sql = "SELECT * FROM usuario 
        WHERE usuario = '$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function registroUsuario($usuario,$contrasena,$nombre,$apellidos,$email)
    {
        $sql = "INSERT INTO usuario (usuario,contrasena,nombre,apellidos,email)
        VALUES ('$usuario','$contrasena','$nombre','$apellidos','$email')";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function actualizaUsuario($usuario,$nuevoUsuario,$contrasena,$nombre,$apellidos,$email)
    {
        $sql = "UPDATE usuario SET 
        usuario='$nuevoUsuario', 
        contrasena='$contrasena',
        nombre='$nombre',
        apellidos='$apellidos',
        email='$email'
        WHERE usuario='$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function actualizarUsuarios($usuario,$nuevoUsuario,$contrasena,$nombre,$apellidos,$email,$rol)
    {
        $sql = "UPDATE usuario SET 
        usuario='$nuevoUsuario', 
        contrasena='$contrasena',
        nombre='$nombre',
        apellidos='$apellidos',
        email='$email',
        rol='$rol'
        WHERE usuario='$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarUsuarios($usuario)
    {
        $sql = "DELETE FROM usuario
        WHERE usuario='$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarUsuarios($usuario)
    {
        $sql = "SELECT * FROM usuario
        WHERE usuario <> '$usuario'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>