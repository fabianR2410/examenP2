<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "OPTIONS") {
    die();
}

//TODO: controlador de clientes Tienda Cel@g

require_once('../models/pacientes.model.php');
error_reporting(0);
$pacientes = new Pacientes;

switch ($_GET["op"]) {
        //TODO: operaciones de pacientes
    case 'buscar': // Procedimiento para cargar todos los datos de los pacientes
        if (!isset($_POST["texto"])) {
            echo json_encode(value: ["error" => "Client ID not specified."]);
            exit();
        }
        $texto = intval(value: $_POST["texto"]);
        $datos = array();
        $datos = $pacientes->buscar(textp: $texto);
        while ($row = mysqli_fetch_assoc(result: $datos)) {
            $todos[] = $row;
        }
        echo json_encode(value: $todos);
        break;
    case 'todos': // Procedimiento para cargar todos los datos de los pacientes
        $datos = array();
        $datos = $pacientes->todos();
        while ($row = mysqli_fetch_assoc(result: $datos)) {
            $todos[] = $row;
        }
        echo json_encode(value: $todos);
        break;

    case 'uno': // Procedimiento para obtener un registro de la base de datos
        if (!isset($_POST["idpaciente"])) {
            echo json_encode(value: ["error" => "Paciente ID not specified."]);
            exit();
        }
        $idpaciente = intval(value: $_POST["idpaciente"]);
        $datos = array();
        $datos = $pacientes->uno(idpaciente: $idpaciente);
        $res = mysqli_fetch_assoc(result: $datos);
        echo json_encode(value: $res);
        break;

    case 'insertar': // Procedimiento para insertar un paciente en la base de datos

        if (!isset($_POST["Nombre"]) || !isset($_POST["Apellido"]) || !isset($_POST["Fecha_nacimiento"]) || !isset($_POST["telefono"]) || !isset($_POST["Correo"])) {
            echo json_encode(value: ["error" => "Missing required parameters."]);
            exit();
        }

        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["Apellido"];
        $Fecha_nacimiento = $_POST["Fecha_nacimiento"];
        $telefono = $_POST["telefono"];


        $datos = array();
        $datos = $pacientes->insertar(nombre: $Nombre,apellido: $Apellido,fecha_nacimiento: $Fecha_nacimiento,telefono: $telefono);
        echo json_encode(value: $datos);
        break;

    case 'actualizar': // Procedimiento para actualizar un paciente en la base de datos
        if (!isset($_POST["idpaciente"])|| !isset($_POST["Nombre"]) || !isset($_POST["apellido"]) || !isset($_POST["Fecha_nacimiendo"]) || !isset($_POST["telefono"])) {
            echo json_encode(value: ["error" => "Missing required parameters."]);
            exit();
        }

        $idpaciente = intval(value: $_POST["idpaciente"]);
        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["apellido"];
        $Fecha_nacimiento = $_POST["Fecha_nacimiendo"];
        $telefono = $_POST["telefono"];
        $datos = array();
        $datos = $pacientes->actualizar(idpaciente: $idpaciente, nombre: $Nombre, apellido: $Apellido, fecha_nacimiento: $Fecha_nacimiento, telefono: $telefono);
        echo json_encode(value: $datos);
        break;

    case 'eliminar': // Procedimiento para eliminar un paciente en la base de datos
        if (!isset($_POST["idpaciente"])) {
            echo json_encode(value: ["error" => "Paciente ID not specified."]);
            exit();
        }
        $idClientes = intval(value: $_POST["idpaciente"]);
        $datos = array();
        $datos = $pacientes->eliminar($idpaciente);
        echo json_encode(value: $datos);
        break;

    default:
        echo json_encode(value: ["error" => "Invalid operation."]);
        break;
}