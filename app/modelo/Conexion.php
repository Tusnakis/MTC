<?php

class Conexion
{
    private $conexion;

    //Esta función sólo conecta con la BD y se llama automáticamente al crear el objeto Model
    public function __construct($dbhost, $dbuser, $dbpass, $dbname) 
    { 
        $mvc_bd_conexion = new mysqli($dbhost, $dbuser, $dbpass, $dbname); 
        $error = $mvc_bd_conexion->connect_errno;
        if ($error != null) 
        {
            echo "<p>Error ".$error. "conectando a la base de datos: "; 
            echo $mvc_bd_conexion->connect_error."</p>"; 
            exit();
        } 
        $this->conexion = $mvc_bd_conexion;
    }

    //Esta función recibe por parámetro una sentencia SELECT y devuelve un array de alimentos
    //El array será accesible tanto con posiciones numéricas como asociativas, al ser fetch_array
    public function ejecutarConsulta($sql) 
    {
        $consulta = $this->conexion->query($sql); 
        $datos = array(); 
        while($resultado = $consulta->fetch_array()) 
        { 
            $datos[] = $resultado; 
        } 
        return $datos; 
    }

    //Esta función recibe por una sentencia que NO devuelve datos (insert, delete o update) y la ejecuta
    public function ejecutarNoConsulta($sql) 
    { 
        return $this->conexion->query($sql); 
    }

    //Esta función cierra la conexión
    public function cerrarConexion()
    {
        $this->conexion->close();
    }

}

?>