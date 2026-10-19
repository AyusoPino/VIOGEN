<?php
$archivo_json = 'datos/victimas.json';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $datos_actuales = file_exists($archivo_json) ? json_decode(file_get_contents($archivo_json), true) : [];
    
    $nueva_victima = [
        "id" => uniqid(),
        "nombre" => $_POST['nombre'] ?? '',
        "dni" => $_POST['dni'] ?? '',
        "extranjera" => isset($_POST['extranjera']) ? true : false,
        "menores_cargo" => isset($_POST['menores_cargo']) ? true : false,
        "temor_vida" => isset($_POST['temor_vida']) ? true : false
    ];

    $datos_actuales[] = $nueva_victima;
    file_put_contents($archivo_json, json_encode($datos_actuales, JSON_PRETTY_PRINT));
    $mensaje = "Víctima registrada correctamente.";
}

include 'html/victimas.php';