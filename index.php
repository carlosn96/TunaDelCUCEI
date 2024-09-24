<?php

require 'config.php';

use controller\Router;
use integrante\IntegranteAPI;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header('Content-Type: application/json');

// Registrar las rutas de la API
IntegranteAPI::register();

// Obtener método HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Extraer el path y eliminar la cadena de consulta si existe
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$pathParts = explode('/', $path);

$entityPath = implode('/', array_slice($pathParts, 1));

// Resolver la ruta usando el enrutador
Router::resolve($method, $entityPath);
