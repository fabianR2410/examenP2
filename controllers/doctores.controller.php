<?php
// Permitir el acceso desde cualquier origen y configurar los headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

// Obtener el método de la solicitud
$method = $_SERVER["REQUEST_METHOD"];

// Finalizar si el método es OPTIONS (pre-flight de CORS)
if ($method == "OPTIONS") {
    die();
}

// Incluir el archivo del modelo de doctores
require_once('../models/doctores.model.php');

// Desactivar la notificación de errores (puede activarse para depuración)
error_reporting(0);

// Instanciar el objeto Doctores
$doctores = new Doctores;

// Switch para manejar las operaciones basadas en el parámetro "op"
switch ($_GET["op"]) {

    // Buscar un doctor específico por texto (normalmente el ID o un campo identificador)
    case 'buscar': 
        if (!isset($_POST["texto"])) {
            echo json_encode(["error" => "Doctor ID not specified."]);
            exit();
        }
        $texto = intval($_POST["texto"]);
        $datos = $doctores->buscar($texto);
        $todos = array();

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // Obtener todos los doctores registrados
    case 'todos': 
        $datos = $doctores->todos();
        $todos = array();

        while ($row = mysqli_fetch_assoc($datos)) {
            $todos[] = $row;
        }
        echo json_encode($todos);
        break;

    // Obtener los detalles de un doctor específico por ID
    case 'uno': 
        if (!isset($_POST["idDoctor"])) {
            echo json_encode(["error" => "Doctor ID not specified."]);
            exit();
        }
        $idDoctor = intval($_POST["idDoctor"]);
        $datos = $doctores->uno($idDoctor);
        $res = mysqli_fetch_assoc($datos);
        echo json_encode($res);
        break;

    // Insertar un nuevo doctor en la base de datos
    case 'insertar': 
        if (!isset($_POST["Nombre"]) || !isset($_POST["Apellido"]) || !isset($_POST["Especialidad"]) || !isset($_POST["Telefono"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["Apellido"];
        $Especialidad = $_POST["Especialidad"];
        $Telefono = $_POST["Telefono"];

        $datos = $doctores->insertar($Nombre, $Apellido, $Especialidad,  $Telefono);
        echo json_encode($datos);
        break;

    // Actualizar los datos de un doctor existente
    case 'actualizar': 
        if (!isset($_POST["idDoctor"]) || !isset($_POST["Nombre"]) || !isset($_POST["Apellido"]) || !isset($_POST["Especialidad"]) || !isset($_POST["Telefono"])) {
            echo json_encode(["error" => "Missing required parameters."]);
            exit();
        }

        $idDoctor = intval($_POST["idDoctor"]);
        $Nombre = $_POST["Nombre"];
        $Apellido = $_POST["Apellido"];
        $Especialidad = $_POST["Especialidad"];
        $Telefono = $_POST["Telefono"];

        $datos = $doctores->actualizar($idDoctor, $Nombre, $Apellido, $Especialidad, $Telefono);
        echo json_encode($datos);
        break;

    // Eliminar un doctor de la base de datos
    case 'eliminar': 
        if (!isset($_POST["idDoctor"])) {
            echo json_encode(["error" => "Doctor ID not specified."]);
            exit();
        }
        $idDoctor = intval($_POST["idDoctor"]);
        $datos = $doctores->eliminar($idDoctor);
        echo json_encode($datos);
        break;

    // Operación no válida
    default:
        echo json_encode(["error" => "Invalid operation."]);
        break;
}

