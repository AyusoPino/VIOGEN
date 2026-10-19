<?php
$archivo_json = 'datos/incidencias.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos_actuales = file_exists($archivo_json) ? json_decode(file_get_contents($archivo_json), true) : [];
    
    $nueva_incidencia = [
        "id" => uniqid(),
        "fecha" => $_POST['fecha'] ?? '',
        "lugar" => $_POST['lugar'] ?? '',
        "descripcion" => $_POST['descripcion'] ?? '',
        "violencia_fisica" => isset($_POST['violencia_fisica']) ? true : false,
        "amenazas_dano" => isset($_POST['amenazas_dano']) ? true : false
    ];

    $datos_actuales[] = $nueva_incidencia;
    file_put_contents($archivo_json, json_encode($datos_actuales, JSON_PRETTY_PRINT));
    $mensaje = "Incidencia registrada correctamente.";
}

include 'html/incidencias.php';