<?php
// leemos los datos guardados en los tres archivos json
$contenidoVictimasJson = file_get_contents(__DIR__ . '/datos/victimas.json');
$contenidoAgresoresJson = file_get_contents(__DIR__ . '/datos/agresores.json');
$contenidoIncidenciasJson = file_get_contents(__DIR__ . '/datos/incidencias.json');

$victimasRegistradas = json_decode($contenidoVictimasJson ?: '[]', true);
$agresoresRegistrados = json_decode($contenidoAgresoresJson ?: '[]', true);
$incidenciasRegistradas = json_decode($contenidoIncidenciasJson ?: '[]', true);

// comprobamos que los datos sean listas de registros
$victimasRegistradas = is_array($victimasRegistradas) ? $victimasRegistradas : [];
$agresoresRegistrados = is_array($agresoresRegistrados) ? $agresoresRegistrados : [];
$incidenciasRegistradas = is_array($incidenciasRegistradas) ? $incidenciasRegistradas : [];

// usamos los ultimos registros para generar un ejemplo de informe
$ultimaVictimaRegistrada = !empty($victimasRegistradas) ? end($victimasRegistradas) : null;
$ultimoAgresorRegistrado = !empty($agresoresRegistrados) ? end($agresoresRegistrados) : null;
$ultimaIncidenciaRegistrada = !empty($incidenciasRegistradas) ? end($incidenciasRegistradas) : null;

// preparamos los indicadores detectados y la puntuacion
$indicadoresRiesgoDetectados = [];
$puntuacionTotalRiesgo = 0;

// estos diez indicadores se han seleccionado para la simulacion de clase
$indicadoresEvaluados = [
    ['registro' => $ultimaIncidenciaRegistrada, 'campo' => 'violencia_fisica', 'nombre' => 'Violencia física', 'puntos' => 2],
    ['registro' => $ultimaIncidenciaRegistrada, 'campo' => 'amenazas_dano', 'nombre' => 'Amenazas de daño', 'puntos' => 2],
    ['registro' => $ultimoAgresorRegistrado, 'campo' => 'celos', 'nombre' => 'Celos exagerados', 'puntos' => 1],
    ['registro' => $ultimoAgresorRegistrado, 'campo' => 'control', 'nombre' => 'Conductas de control', 'puntos' => 1],
    ['registro' => $ultimoAgresorRegistrado, 'campo' => 'acoso', 'nombre' => 'Conductas de acoso', 'puntos' => 2],
    ['registro' => $ultimoAgresorRegistrado, 'campo' => 'antecedentes', 'nombre' => 'Antecedentes penales o policiales', 'puntos' => 1],
    ['registro' => $ultimoAgresorRegistrado, 'campo' => 'toxicos', 'nombre' => 'Abuso de tóxicos', 'puntos' => 1],
    ['registro' => $ultimaVictimaRegistrada, 'campo' => 'extranjera', 'nombre' => 'Víctima extranjera', 'puntos' => 1],
    ['registro' => $ultimaVictimaRegistrada, 'campo' => 'menores_cargo', 'nombre' => 'Menores a cargo', 'puntos' => 1],
    ['registro' => $ultimaVictimaRegistrada, 'campo' => 'temor_vida', 'nombre' => 'Temor por su vida', 'puntos' => 2]
];

// revisamos cada indicador y sumamos sus puntos si esta presente
foreach ($indicadoresEvaluados as $indicadorEvaluado) {
    if (!empty($indicadorEvaluado['registro'][$indicadorEvaluado['campo']])) {
        $indicadoresRiesgoDetectados[] = $indicadorEvaluado['nombre'];
        $puntuacionTotalRiesgo += $indicadorEvaluado['puntos'];
    }
}

// calculamos la categoria academica a partir de la puntuacion
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

// mostramos el informe con los resultados calculados
include __DIR__ . '/html/valoracion.php';
