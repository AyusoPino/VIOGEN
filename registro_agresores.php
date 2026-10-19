<?php
$archivo_json = 'datos/agresores.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos_actuales = file_exists($archivo_json) ? json_decode(file_get_contents($archivo_json), true) : [];
    
    $nuevo_agresor = [
        "id" => uniqid(),
        "nombre" => $_POST['nombre'] ?? '',
        "dni" => $_POST['dni'] ?? '',
        "celos" => isset($_POST['celos']) ? true : false,
        "control" => isset($_POST['control']) ? true : false,
        "acoso" => isset($_POST['acoso']) ? true : false,
        "antecedentes" => isset($_POST['antecedentes']) ? true : false,
        "toxicos" => isset($_POST['toxicos']) ? true : false
    ];

    $datos_actuales[] = $nuevo_agresor;
    file_put_contents($archivo_json, json_encode($datos_actuales, JSON_PRETTY_PRINT));
    $mensaje = "Agresor registrado correctamente.";
}

include 'html/agresores.php';
