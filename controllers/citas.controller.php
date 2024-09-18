<?php
// Permitir el acceso desde cualquier origen y configurar los headers
header(header: "Access-Control-Allow-Origin: *");
header(header: "Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header(header: "Allow: GET, POST, OPTIONS, PUT, DELETE");

// Obtener el método de la solicitud
$method = $_SERVER["REQUEST_METHOD"];

// Finalizar si el método es OPTIONS (pre-flight de CORS)
if ($method == "OPTIONS") {
    die();
}

// Incluir el archivo del modelo de citas
require_once('../models/citas.model.php');

// Desactivar la notificación de errores (puede activarse para depuración)
error_reporting(error_level: 0);

// Instanciar el objeto Citas
$citas = new Citas;

// Switch para manejar las operaciones basadas en el parámetro "op"
switch ($_GET["op"]) {

    // Buscar una cita específica por texto (normalmente el ID o un campo identificador)
    case 'buscar': 
        if (!isset($_POST["texto"])) {
            echo json_encode(value: ["error" => "Appointment ID not specified."]);
            exit();
        }
        $texto = intval(value: $_POST["texto"]);
        $datos = $citas->buscar(textp: $texto);
        $todos = array();

        while ($row = mysqli_fetch_assoc(result: $datos)) {
            $todos[] = $row;
        }
        echo json_encode(value: $todos);
        break;

    // Obtener todas las citas registradas
    case 'todos': 
        $datos = $citas->todos();
        $todos = array();

        while ($row = mysqli_fetch_assoc(result: $datos)) {
            $todos[] = $row;
        }
        echo json_encode(value: $todos);
        break;

    // Obtener los detalles de una cita específica por ID
    case 'uno': 
        if (!isset($_POST["idcita"])) {
            echo json_encode(value: ["error" => "Appointment ID not specified."]);
            exit();
        }
        $idcita = intval(value: $_POST["idcita"]);
        $datos = $citas->uno(idcita: $idcita);
        $res = mysqli_fetch_assoc(result: $datos);
        echo json_encode(value: $res);
        break;

    // Insertar una nueva cita en la base de datos
    case 'insertar': 
        if (!isset($_POST["idpaciente"]) || !isset($_POST["iddoctor"]) || !isset($_POST["fecha_cita"]) || !isset($_POST["hora_cita"]) || !isset($_POST["descripcion"])) {
            echo json_encode(value: ["error" => "Missing required parameters."]);
            exit();
        }

        $idpaciente = $_POST["idpaciente"];
        $iddoctor = $_POST["iddoctor"];
        $fecha_cita = $_POST["fecha_cita"];
        $hora_cita = $_POST["hora_cita"];
        $descripcion = $_POST["descripcion"];

        $datos = $citas->insertar(idpaciente: $idpaciente, iddoctor: $iddoctor, fecha_cita: $fecha_cita, hora_cita: $hora_cita, descripcion: $descripcion);
        echo json_encode(value: $datos);
        break;

    // Actualizar los datos de una cita existente
    case 'actualizar': 
        if (!isset($_POST["idcita"]) || !isset($_POST["idpaciente"]) || !isset($_POST["iddoctor"]) || !isset($_POST["fecha_cita"]) || !isset($_POST["hora_cita"]) || !isset($_POST["descripcion"])) {
            echo json_encode(value: ["error" => "Missing required parameters."]);
            exit();
        }

        $idcita = intval(value: $_POST["idcita"]);
        $idpaciente = $_POST["idpaciente"];
        $iddoctor = $_POST["iddoctor"];
        $fecha_cita = $_POST["fecha_cita"];
        $hora_cita = $_POST["hora_cita"];
        $descripcion = $_POST["descripcion"];

        $datos = $citas->actualizar(idcita: $idcita, idpaciente: $idpaciente, iddoctor: $iddoctor, fecha_cita: $fecha_cita, hora_cita: $hora_cita, descripcion: $descripcion);
        echo json_encode($datos);
        break;

    // Eliminar una cita de la base de datos
    case 'eliminar': 
        if (!isset($_POST["idcita"])) {
            echo json_encode(value: ["error" => "Appointment ID not specified."]);
            exit();
        }
        $idcita = intval(value: $_POST["idcita"]);
        $datos = $citas->eliminar($idcita);
        echo json_encode(value: $datos);
        break;

    // Operación no válida
    default:
        echo json_encode(value: ["error" => "Invalid operation."]);
        break;
}

