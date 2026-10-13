<?php

require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/modelo/peliculaDao.php";
require_once __DIR__ . "/controlador/PeliculaController.php";

$database = new Database();
$conexion = $database->conectar();
$dao = new PeliculaDao($conexion);
$controlador = new PeliculaController($dao);

$accion = $_GET["accion"] ?? "index";

switch ($accion) {
    case "nuevo":
        $controlador->nuevo();
        break;
    case "guardar":
        $controlador->guardar();
        break;
    case "editar":
        $controlador->editar();
        break;
    case "actualizar":
        $controlador->actualizar();
        break;
    case "eliminar":
        $controlador->eliminar();
        break;
    default:
        $controlador->index();
        break;
}
