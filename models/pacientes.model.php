<?php
// TODO: Clase de Pacientes
require_once('../config/config.php');

class Pacientes
{
    // Método para buscar un paciente por un texto (nombre, apellido, etc.)
    public function buscar($textp): bool|mysqli_result 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `pacientes` WHERE `nombre`= '$textp' OR `apellido` = '$textp'";
        $datos = mysqli_query(mysql: $con, query: $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener todos los pacientes
    public function todos(): bool|mysqli_result 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `pacientes`";
        $datos = mysqli_query(mysql: $con, query: $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener un paciente por su idpaciente
    public function uno($idpaciente): bool|mysqli_result 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `pacientes` WHERE `idpaciente` = $idpaciente";
        $datos = mysqli_query(mysql: $con, query: $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar un nuevo paciente
    public function insertar($nombre, $apellido, $fecha_nacimiento, $telefono): int|string 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `pacientes`(`nombre`, `apellido`, `fecha_nacimiento`, `telefono`) 
                       VALUES ('$nombre', '$apellido', '$fecha_nacimiento', '$telefono')";
            if (mysqli_query(mysql: $con, query: $cadena)) {
                return $con->insert_id; // Retorna el ID del registro insertado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para actualizar los datos de un paciente
    public function actualizar($idpaciente, $nombre, $apellido, $fecha_nacimiento, $telefono) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `pacientes` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `fecha_nacimiento`='$fecha_nacimiento',
                       `telefono`='$telefono' 
                       WHERE `idpaciente` = $idpaciente";
            if (mysqli_query(mysql: $con, query: $cadena)) {
                return $idpaciente; // Retorna el ID del paciente actualizado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar un paciente
    public function eliminar($idpaciente) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `pacientes` WHERE `idpaciente`= $idpaciente";
            if (mysqli_query($con, $cadena)) {
                return 1; // Éxito
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }
}
