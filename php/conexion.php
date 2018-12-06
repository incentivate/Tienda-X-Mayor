<?php

$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = 'nacho';
$dbName = 'Test';

//Crea la conexion y elige la base de datos a usarse
$link = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($link->connect_error) {
    die("Falló la conexion con la base de datos: " . $link->connect_error);
}