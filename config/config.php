<?php

class ClaseConectar
{

    public $conexion;
    protected $db;
    private $host = "localhost";
    private $usuario = "root";
    private $pass = "";
    private $base = "examen2";

    public function ProcedimientoParaConectar()
    {
        $this->conexion = mysqli_connect(hostname: $this->host, username: $this->usuario, password: $this->pass, database: $this->base);
        mysqli_query(mysql: $this->conexion, query: "SET NAMES 'utf8'");
        if ($this->conexion->connect_error) {
            die("Error al conectar con el servidor: " . $this->conexion->connect_error);
        }
        $this->db = $this->conexion;
        if ($this->db == 0) die("Error al conectar con la base de datos: " . $this->conexion->connect_error);

        return $this->conexion;
    }
}
