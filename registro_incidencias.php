<?php
$archivoDatosJson = __DIR__ . '/datos/incidencias.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (trim($_POST['fecha'] ?? '') === '' || trim($_POST['lugar'] ?? '') === '' || trim($_POST['descripcion'] ?? '') === '') {
        header('Location: html/incidencias.php?error=campos');
        exit;
    }

    $contenidoArchivoJson = file_get_contents($archivoDatosJson);
    $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);
    if (!is_array($registrosGuardados)) {
        $registrosGuardados = [];
    }

    $nuevoRegistroIncidencia = [
        "id" => uniqid(),
        "fecha" => trim($_POST['fecha'] ?? ''),
        "lugar" => trim($_POST['lugar'] ?? ''),
        "descripcion" => trim($_POST['descripcion'] ?? ''),
        "violencia_fisica" => isset($_POST['violencia_fisica']),
        "amenazas_dano" => isset($_POST['amenazas_dano'])
    ];

    $registrosGuardados[] = $nuevoRegistroIncidencia;
    $datosConvertidosAJson = json_encode($registrosGuardados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $guardadoCorrecto = file_put_contents($archivoDatosJson, $datosConvertidosAJson, LOCK_EX);

    if ($guardadoCorrecto === false) {
        header('Location: html/incidencias.php?error=guardado');
    } else {
        header('Location: html/incidencias.php?guardado=1');
    }
    exit;
}

header('Location: html/incidencias.php');
exit;
