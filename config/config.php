<?php
// Cargar configuración de servidor
$serverConfig = include 'server_config.php';
$environment = $serverConfig['environment'];
$config = include __DIR__ . "/{$environment}.php";
return $config;
?>