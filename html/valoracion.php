<?php
// los resultados se calculan en informe.php antes de mostrar esta vista
if (!isset($indicadoresRiesgoDetectados)) {
    // si entramos directamente mostramos un enlace al informe
    echo '<p>Abre el informe desde <a href="../informe.php">Informe final</a>.</p>';
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
        <h2>Informe Final de Valoración VioGén (Simulación)</h2>
        
        <div class="card">
            <h3>Datos del Caso</h3>
            <p><strong>Víctima:</strong> <?= htmlspecialchars($ultimaVictimaRegistrada['nombre'] ?? 'No registrada') ?></p>
            <p><strong>Presunto Agresor:</strong> <?= htmlspecialchars($ultimoAgresorRegistrado['nombre'] ?? 'No registrado') ?></p>
            <p><strong>Última Incidencia:</strong> <?= htmlspecialchars($ultimaIncidenciaRegistrada['fecha'] ?? 'No registrada') ?> - <?= htmlspecialchars($ultimaIncidenciaRegistrada['descripcion'] ?? '') ?></p>
            <p><strong>Lugar:</strong> <?= htmlspecialchars($ultimaIncidenciaRegistrada['lugar'] ?? '') ?></p>
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
