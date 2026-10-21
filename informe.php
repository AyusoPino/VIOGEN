<?php
// recibimos los datos de los formularios a traves de post
// solo guardamos los registros cuando se genera el informe

$informeEnviado = $_SERVER['REQUEST_METHOD'] === 'POST';
// recuperamos los campos enviados y asignamos un texto por defecto si faltan
$victima_nombre = $_POST['victima_nombre'] ?? '';
$victima_dni = $_POST['victima_dni'] ?? '';
$victima_extranjera = $_POST['victima_extranjera'] ?? '';
$victima_menores_cargo = $_POST['victima_menores_cargo'] ?? '';
$victima_temor_vida = $_POST['victima_temor_vida'] ?? '';
$agresor_nombre = $_POST['agresor_nombre'] ?? '';
$agresor_dni = $_POST['agresor_dni'] ?? '';
$agresor_celos = $_POST['agresor_celos'] ?? '';
$agresor_control = $_POST['agresor_control'] ?? '';
$agresor_acoso = $_POST['agresor_acoso'] ?? '';
$agresor_antecedentes = $_POST['agresor_antecedentes'] ?? '';
$agresor_toxicos = $_POST['agresor_toxicos'] ?? '';
$incidencia_fecha = $_POST['incidencia_fecha'] ?? '';
$incidencia_lugar = $_POST['incidencia_lugar'] ?? '';
$incidencia_descripcion = $_POST['incidencia_descripcion'] ?? '';
$incidencia_violencia_fisica = $_POST['incidencia_violencia_fisica'] ?? '';
$incidencia_amenazas_dano = $_POST['incidencia_amenazas_dano'] ?? '';

// iniciamos los indicadores y la puntuacion de la simulacion
$indicadoresRiesgoDetectados = [];
$puntuacionTotalRiesgo = 0;

// estos indicadores siguen las preguntas de los tres formularios
$indicadoresEvaluados = [
    ['campo' => 'incidencia_violencia_fisica', 'nombre' => 'Violencia física', 'puntos' => 2],
    ['campo' => 'incidencia_amenazas_dano', 'nombre' => 'Amenazas de daño', 'puntos' => 2],
    ['campo' => 'agresor_celos', 'nombre' => 'Celos exagerados', 'puntos' => 1],
    ['campo' => 'agresor_control', 'nombre' => 'Conductas de control', 'puntos' => 1],
    ['campo' => 'agresor_acoso', 'nombre' => 'Conductas de acoso', 'puntos' => 2],
    ['campo' => 'agresor_antecedentes', 'nombre' => 'Antecedentes penales o policiales', 'puntos' => 1],
    ['campo' => 'agresor_toxicos', 'nombre' => 'Abuso de tóxicos', 'puntos' => 1],
    ['campo' => 'victima_extranjera', 'nombre' => 'Víctima extranjera', 'puntos' => 1],
    ['campo' => 'victima_menores_cargo', 'nombre' => 'Menores a cargo', 'puntos' => 1],
    ['campo' => 'victima_temor_vida', 'nombre' => 'Temor por su vida', 'puntos' => 2],
];

// sumamos la puntuacion de los indicadores marcados
foreach ($indicadoresEvaluados as $indicadorEvaluado) {
    if (($_POST[$indicadorEvaluado['campo']] ?? '0') == '1') {
        $indicadoresRiesgoDetectados[] = $indicadorEvaluado['nombre'];
        $puntuacionTotalRiesgo += $indicadorEvaluado['puntos'];
    }
}

// obtenemos una clasificacion orientativa y solo academica
$nivelRiesgoOrientativo = 'SIN INDICADORES DETECTADOS';
$claseVisualRiesgo = 'riesgo-bajo';
if ($puntuacionTotalRiesgo >= 7) {
    $nivelRiesgoOrientativo = 'NUMEROSOS INDICADORES';
    $claseVisualRiesgo = 'riesgo-alto';
} elseif ($puntuacionTotalRiesgo >= 4) {
    $nivelRiesgoOrientativo = 'VARIOS INDICADORES';
    $claseVisualRiesgo = 'riesgo-medio';
} elseif ($puntuacionTotalRiesgo >= 1) {
    $nivelRiesgoOrientativo = 'ALGUNOS INDICADORES';
}

// comprobamos que se hayan rellenado los datos necesarios
$datosCompletos = trim($victima_nombre) != '' && trim($agresor_nombre) != '' && trim($incidencia_fecha) != '' && trim($incidencia_lugar) != '';
$datosGuardados = false;
$mensajeError = '';

if ($informeEnviado && $datosCompletos) {
    // indicamos los archivos donde se guardara cada registro
    $archivoVictimas = __DIR__ . '/datos/victimas.json';
    $archivoAgresores = __DIR__ . '/datos/agresores.json';
    $archivoIncidencias = __DIR__ . '/datos/incidencias.json';

    // leemos los registros anteriores para no borrarlos
    $victimasGuardadas = json_decode(file_get_contents($archivoVictimas), true);
    $agresoresGuardados = json_decode(file_get_contents($archivoAgresores), true);
    $incidenciasGuardadas = json_decode(file_get_contents($archivoIncidencias), true);

    // si alguno de los archivos esta vacio empezamos con un array vacio
    if (!is_array($victimasGuardadas)) {
        $victimasGuardadas = [];
    }
    if (!is_array($agresoresGuardados)) {
        $agresoresGuardados = [];
    }
    if (!is_array($incidenciasGuardadas)) {
        $incidenciasGuardadas = [];
    }

    // preparamos los tres registros con los datos recibidos
    $nuevaVictima = [
        'id' => uniqid(),
        'nombre' => $victima_nombre,
        'dni' => $victima_dni,
        'extranjera' => $victima_extranjera == '1',
        'menores_cargo' => $victima_menores_cargo == '1',
        'temor_vida' => $victima_temor_vida == '1'
    ];
    $nuevoAgresor = [
        'id' => uniqid(),
        'nombre' => $agresor_nombre,
        'dni' => $agresor_dni,
        'celos' => $agresor_celos == '1',
        'control' => $agresor_control == '1',
        'acoso' => $agresor_acoso == '1',
        'antecedentes' => $agresor_antecedentes == '1',
        'toxicos' => $agresor_toxicos == '1'
    ];
    $nuevaIncidencia = [
        'id' => uniqid(),
        'fecha' => $incidencia_fecha,
        'lugar' => $incidencia_lugar,
        'descripcion' => $incidencia_descripcion,
        'violencia_fisica' => $incidencia_violencia_fisica == '1',
        'amenazas_dano' => $incidencia_amenazas_dano == '1'
    ];

    // agregamos los registros a los arrays correspondientes
    $victimasGuardadas[] = $nuevaVictima;
    $agresoresGuardados[] = $nuevoAgresor;
    $incidenciasGuardadas[] = $nuevaIncidencia;

    // convertimos los arrays a json y los guardamos al generar el informe
    $victimasEscritas = file_put_contents($archivoVictimas, json_encode($victimasGuardadas));
    $agresoresEscritos = file_put_contents($archivoAgresores, json_encode($agresoresGuardados));
    $incidenciasEscritas = file_put_contents($archivoIncidencias, json_encode($incidenciasGuardadas));

    // mostramos si los tres archivos se han guardado correctamente
    $datosGuardados = $victimasEscritas !== false && $agresoresEscritos !== false && $incidenciasEscritas !== false;
    if (!$datosGuardados) {
        $mensajeError = 'No se han podido guardar todos los datos. Comprueba los permisos de la carpeta datos.';
    }
} elseif ($informeEnviado) {
    // no guardamos registros incompletos
    $mensajeError = 'Completa al menos el nombre de la victima, el nombre del agresor, la fecha y el lugar de la incidencia antes de generar el informe.';
}

// mostramos la vista con el resultado
include __DIR__ . '/html/valoracion.php';
