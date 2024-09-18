<?php
// TODO: Clase de Doctores
require_once('../config/config.php');

class Doctores
{
    // Método para buscar un doctor por un texto (nombre, apellido, etc.)
    public function buscar($textp) 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `doctores` WHERE `nombre` = '$textp' OR `apellido` = '$textp";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener todos los doctores
    public function todos() 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `doctores`";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para obtener un doctor por su iddoctor
    public function uno($iddoctor) 
    {
        $con = new ClaseConectar();
        $con = $con->ProcedimientoParaConectar();
        $cadena = "SELECT * FROM `doctores` WHERE `iddoctor` = $iddoctor";
        $datos = mysqli_query($con, $cadena);
        $con->close();
        return $datos;
    }

    // Método para insertar un nuevo doctor
    public function insertar($nombre, $apellido, $especialidad,$telefono) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "INSERT INTO `doctores`(`nombre`, `apellido`, `especialidad`) 
                       VALUES ('$nombre', '$apellido', '$especialidad','$telefono')";
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

    // Método para actualizar los datos de un doctor
    public function actualizar($iddoctor, $nombre, $apellido, $especialidad,$telefono) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "UPDATE `doctores` SET 
                       `nombre`='$nombre',
                       `apellido`='$apellido',
                       `especialidad`='$especialidad'
                       `telefono`='$telefono' 
                       WHERE `iddoctor` = $iddoctor";
            if (mysqli_query($con, $cadena)) {
                return $iddoctor; // Retorna el ID del doctor actualizado
            } else {
                return $con->error;
            }
        } catch (Exception $th) {
            return $th->getMessage();
        } finally {
            $con->close();
        }
    }

    // Método para eliminar un doctor
    public function eliminar($iddoctor) 
    {
        try {
            $con = new ClaseConectar();
            $con = $con->ProcedimientoParaConectar();
            $cadena = "DELETE FROM `doctores` WHERE `iddoctor`= $iddoctor";
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
