<?php
// los resultados se calculan en informe.php antes de mostrar esta vista
if (!$informeEnviado) {
    // si entramos directamente mostramos un enlace al informe
    echo '<p>Primero completa los formularios desde <a href="html/victimas.php">registro de victimas</a>.</p>';
} else {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Valoración de Riesgo</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Informe Final de Valoración VioGén</h2>
        <?php if ($datosGuardados): ?>
            <p class="card">Los datos de victima, agresor e incidencia se han guardado en sus archivos json al generar el informe.</p>
        <?php elseif ($mensajeError != ''): ?>
            <p class="card"><?= htmlspecialchars($mensajeError) ?></p>
        <?php endif; ?>
        
        <div class="card">
            <h3>Datos del Caso</h3>
            <p><strong>Víctima:</strong> <?= htmlspecialchars($victima_nombre ?: 'No registrada') ?></p>
            <p><strong>Presunto Agresor:</strong> <?= htmlspecialchars($agresor_nombre ?: 'No registrado') ?></p>
            <p><strong>Última Incidencia:</strong> <?= htmlspecialchars($incidencia_fecha ?: 'No registrada') ?> - <?= htmlspecialchars($incidencia_descripcion) ?></p>
            <p><strong>Lugar:</strong> <?= htmlspecialchars($incidencia_lugar) ?></p>
        </div>

        <div class="card">
            <h3>Indicadores de riesgo detectados (10 considerados)</h3>
            <?php if (empty($indicadoresRiesgoDetectados)): ?>
                <p>No se han detectado indicadores de riesgo activos.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($indicadoresRiesgoDetectados as $nombreIndicadorDetectado): ?>
                        <li><?= htmlspecialchars($nombreIndicadorDetectado) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="card alert <?= htmlspecialchars($claseVisualRiesgo) ?>">
            <h3>Valoración Orientativa del Riesgo: <?= $nivelRiesgoOrientativo ?></h3>
            <p><strong>Justificación:</strong> La valoración se ha realizado computando la presencia de <?= count($indicadoresRiesgoDetectados) ?> indicadores de riesgo y vulnerabilidad. Esta clasificación se obtiene con una puntuación creada únicamente para esta práctica y no equivale a una valoración policial oficial. Los indicadores no permiten por sí solos determinar el peligro real.</p>
        </div>

        <a href="./index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>
<?php
// termina la comprobacion del informe
}
?>
