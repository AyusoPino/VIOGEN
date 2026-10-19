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
            <p><strong>Víctima:</strong> <?= $ultima_victima['nombre'] ?? 'No registrada' ?></p>
            <p><strong>Presunto Agresor:</strong> <?= $ultimo_agresor['nombre'] ?? 'No registrado' ?></p>
            <p><strong>Última Incidencia:</strong> <?= $ultima_incidencia['fecha'] ?? 'No registrada' ?> - <?= htmlspecialchars($ultima_incidencia['descripcion'] ?? '') ?></p>
        </div>

        <div class="card">
            <h3>Indicadores de Riesgo Detectados (Mínimo 10 evaluados)</h3>
            <?php if (empty($indicadores_activos)): ?>
                <p>No se han detectado indicadores de riesgo activos.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($indicadores_activos as $ind): ?>
                        <li><?= $ind ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="card alert <?= $clase_riesgo ?>">
            <h3>Valoración Orientativa del Riesgo: <?= $nivel_riesgo ?></h3>
            <p><strong>Justificación:</strong> La valoración se ha realizado computando la presencia de <?= count($indicadores_activos) ?> indicadores empíricos de riesgo y vulnerabilidad. Una evaluación del riesgo de violencia no es una predicción del futuro, sino una estimación técnico-profesional en términos probabilísticos[cite: 1]. Las medidas de protección policial deben ser proporcionales a este nivel detectado[cite: 9].</p>
        </div>

        <a href="index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>