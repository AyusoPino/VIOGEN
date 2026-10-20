<?php
$archivoDatosJson = __DIR__ . '/datos/agresores.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (trim($_POST['nombre'] ?? '') === '' || trim($_POST['dni'] ?? '') === '') {
        header('Location: html/agresores.php?error=campos');
        exit;
    }

    $contenidoArchivoJson = file_get_contents($archivoDatosJson);
    $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);
    if (!is_array($registrosGuardados)) {
        $registrosGuardados = [];
    }

    $nuevoRegistroAgresor = [
        "id" => uniqid(),
        "nombre" => trim($_POST['nombre'] ?? ''),
        "dni" => trim($_POST['dni'] ?? ''),
        "celos" => isset($_POST['celos']),
        "control" => isset($_POST['control']),
        "acoso" => isset($_POST['acoso']),
        "antecedentes" => isset($_POST['antecedentes']),
        "toxicos" => isset($_POST['toxicos'])
    ];

    $registrosGuardados[] = $nuevoRegistroAgresor;
    $datosConvertidosAJson = json_encode($registrosGuardados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $guardadoCorrecto = file_put_contents($archivoDatosJson, $datosConvertidosAJson, LOCK_EX);

    if ($guardadoCorrecto === false) {
        header('Location: html/agresores.php?error=guardado');
    } else {
        header('Location: html/agresores.php?guardado=1');
    }
    exit;
}

header('Location: html/agresores.php');
exit;
