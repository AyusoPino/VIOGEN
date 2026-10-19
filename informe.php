<?php
// Lectura de datos
$victimas = file_exists('datos/victimas.json') ? json_decode(file_get_contents('datos/victimas.json'), true) : [];
$agresores = file_exists('datos/agresores.json') ? json_decode(file_get_contents('datos/agresores.json'), true) : [];
$incidencias = file_exists('datos/incidencias.json') ? json_decode(file_get_contents('datos/incidencias.json'), true) : [];

// Tomamos los últimos registros para la simulación
$ultima_victima = end($victimas) ?: null;
$ultimo_agresor = end($agresores) ?: null;
$ultima_incidencia = end($incidencias) ?: null;

$indicadores_activos = [];
$puntuacion_riesgo = 0;

// Evaluación de 10 indicadores (basados en GUIA PROCEDIMIENTO VPER 4.1.pdf)
if ($ultima_incidencia) {
    if ($ultima_incidencia['violencia_fisica']) { $indicadores_activos[] = "Violencia física (Ind. 2)[cite: 23]"; $puntuacion_riesgo += 2; }
    if ($ultima_incidencia['amenazas_dano']) { $indicadores_activos[] = "Amenazas de daño (Ind. 5)[cite: 25]"; $puntuacion_riesgo += 2; }
}

if ($ultimo_agresor) {
    if ($ultimo_agresor['celos']) { $indicadores_activos[] = "Celos exagerados (Ind. 7)[cite: 27]"; $puntuacion_riesgo += 1; }
    if ($ultimo_agresor['control']) { $indicadores_activos[] = "Conductas de control (Ind. 8)[cite: 28]"; $puntuacion_riesgo += 1; }
    if ($ultimo_agresor['acoso']) { $indicadores_activos[] = "Conductas de acoso (Ind. 9)[cite: 28]"; $puntuacion_riesgo += 2; }
    if ($ultimo_agresor['antecedentes']) { $indicadores_activos[] = "Antecedentes penales/policiales (Ind. 15)[cite: 32]"; $puntuacion_riesgo += 1; }
    if ($ultimo_agresor['toxicos']) { $indicadores_activos[] = "Abuso de tóxicos (Ind. 21)[cite: 34]"; $puntuacion_riesgo += 1; }
}

if ($ultima_victima) {
    if ($ultima_victima['extranjera']) { $indicadores_activos[] = "Víctima extranjera (Ind. 28)[cite: 37]"; $puntuacion_riesgo += 1; }
    if ($ultima_victima['menores_cargo']) { $indicadores_activos[] = "Menores a cargo (Ind. 29)[cite: 37]"; $puntuacion_riesgo += 1; }
    if ($ultima_victima['temor_vida']) { $indicadores_activos[] = "Temor por su vida (Ind. 35)[cite: 40]"; $puntuacion_riesgo += 2; }
}

// Cálculo del nivel de riesgo
$nivel_riesgo = "NO APRECIADO";
$clase_riesgo = "riesgo-bajo";

if ($puntuacion_riesgo >= 7) {
    $nivel_riesgo = "ALTO / EXTREMO";
    $clase_riesgo = "riesgo-alto";
} elseif ($puntuacion_riesgo >= 4) {
    $nivel_riesgo = "MEDIO";
    $clase_riesgo = "riesgo-medio";
} elseif ($puntuacion_riesgo >= 1) {
    $nivel_riesgo = "BAJO";
    $clase_riesgo = "riesgo-bajo";
}

include 'html/valoracion.php';