<?php

require 'config.php';

use controller\Router;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header('Content-Type: application/json');

Router::registerStack([
    integrante\IntegranteAPI::class,
    evento\EventoAPI::class,
    asistencia\AsistenciaAPI::class,
    instrumento\InstrumentoAPI::class
        ]
);

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$pathParts = explode('/', $path);
$entityPath = implode('/', array_slice($pathParts, 1));

Router::resolve($_SERVER['REQUEST_METHOD'], $entityPath);
