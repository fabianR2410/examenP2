<?php
// TODO: Clase de Citas
require_once('../config/config.php');

class Citas
{
    // Método para buscar una cita por un texto (fecha, descripción, etc.)
    public function buscar($textp) 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `citas` WHERE `descripcion` ='$textp' OR `fecha_cita` = '$textp'";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener todas las citas
    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `citas`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener una cita por su idcita
    public function uno($idcita) 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `citas` WHERE `idcita` = $idcita";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar una nueva cita
    public function insertar($idpaciente, $iddoctor, $fecha_cita, $hora_cita, $descripcion) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `citas`(`PACIENTES_idpaciente`, `DOCTORES_iddoctor`, `fecha_cita`, `hora_cita`, `descripcion`) 
                       VALUES ('$idpaciente', '$iddoctor', '$fecha_cita', '$hora_cita', '$descripcion')";
            if (mysqli_query($con, $cadena)) {
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

    // Método para actualizar los datos de una cita
    public function actualizar($idcita, $idpaciente, $iddoctor, $fecha_cita, $hora_cita, $descripcion) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `citas` SET 
                       `PACIENTES_idpaciente` = '$idpaciente',
                       `DOCTORES_iddoctor` = '$iddoctor',
                       `fecha_cita` = '$fecha_cita',
                       `hora_cita` = '$hora_cita',
                       `descripcion` = '$descripcion'
                       WHERE `idcita` = $idcita";
            if (mysqli_query($con, $cadena)) {
                return $idcita; // Retorna el ID de la cita actualizada
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar una cita
    public function eliminar($idcita) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `citas` WHERE `idcita` = $idcita";
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
