<?php

class ListaJugar
{
    public static function listarUsuariosLista()
    {
        $fecha = date('Y-m-d');
        $sql = "SELECT * FROM lista_jugar
        WHERE fecha = '$fecha'";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarUsuariosListaPaginados($pagina)
    {
        $fecha = date('Y-m-d');
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT * FROM lista_jugar
        WHERE fecha = '$fecha'
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function añadirListaJugar($usuario_p,$fecha,$hora_desde,$hora_hasta,$categoria,$idTipoPista)
    {
        $sql = "INSERT INTO lista_jugar (id_usuario_a,fecha,hora_desde,hora_hasta,categoria,id_tipo_pista)
        VALUES ('$usuario_p','$fecha','$hora_desde','$hora_hasta',$categoria,$idTipoPista)";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarUsuariosListaFiltrados($fecha,$categoria)
    {
        $sql = "SELECT * FROM lista_jugar
        WHERE fecha = '$fecha'
        AND categoria = $categoria";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarUsuariosListaFiltradosPaginados($fecha,$categoria,$pagina)
    {
        $pagina = $pagina * 10 - 10;
        $sql = "SELECT * FROM lista_jugar
        WHERE fecha = '$fecha'
        AND categoria = $categoria
        LIMIT $pagina,10";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function elegirUsuarioLista($id,$usuario,$numPista,$hora_inicio)
    {
        $sql = "UPDATE lista_jugar SET id_usuario_e = '$usuario', num_pista = $numPista, hora_inicio = '$hora_inicio'
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function eliminarUsuarioLista($id)
    {
        $sql = "DELETE FROM lista_jugar
        WHERE id = $id";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarNoConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }

    public static function listarTodosUsuariosLista()
    {
        $sql = "SELECT * FROM lista_jugar";
        $con = new Conexion(Config::$mvc_bd_hostname, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_nombre);
        $resultado = $con->ejecutarConsulta($sql);
        $con->cerrarConexion();
        return $resultado;
    }
}

?>