<?php
$archivoDatosJson = __DIR__ . '/datos/victimas.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (trim($_POST['nombre'] ?? '') === '' || trim($_POST['dni'] ?? '') === '') {
        header('Location: html/victimas.php?error=campos');
        exit;
    }

    $contenidoArchivoJson = file_get_contents($archivoDatosJson);
    $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);
    if (!is_array($registrosGuardados)) {
        $registrosGuardados = [];
    }

    $nuevoRegistroVictima = [
        "id" => uniqid(),
        "nombre" => trim($_POST['nombre'] ?? ''),
        "dni" => trim($_POST['dni'] ?? ''),
        "extranjera" => isset($_POST['extranjera']),
        "menores_cargo" => isset($_POST['menores_cargo']),
        "temor_vida" => isset($_POST['temor_vida'])
    ];

    $registrosGuardados[] = $nuevoRegistroVictima;
    $datosConvertidosAJson = json_encode($registrosGuardados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $guardadoCorrecto = file_put_contents($archivoDatosJson, $datosConvertidosAJson, LOCK_EX);

    if ($guardadoCorrecto === false) {
        header('Location: html/victimas.php?error=guardado');
    } else {
        header('Location: html/victimas.php?guardado=1');
    }
    exit;
}

header('Location: html/victimas.php');
exit;
