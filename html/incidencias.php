<?php
// este archivo muestra el formulario y guarda sus datos
$mensajeCorrecto = '';
$mensajeError = '';

// solo procesamos los datos cuando se envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // comprobamos que los campos obligatorios no esten vacios
    if (trim($_POST['fecha'] ?? '') === '' || trim($_POST['lugar'] ?? '') === '' || trim($_POST['descripcion'] ?? '') === '') {
        $mensajeError = 'Completa todos los campos obligatorios.';
    } else {
        // leemos los registros que ya estan guardados
        $archivoDatosJson = __DIR__ . '/../datos/incidencias.json';
        $contenidoArchivoJson = file_get_contents($archivoDatosJson);
        $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);

        // si el archivo no contiene una lista valida empezamos vacios
        if (!is_array($registrosGuardados)) {
            $registrosGuardados = [];
        }

        // recogemos los campos del formulario en un array
        $nuevoRegistroIncidencia = [
            "id" => uniqid(),
            "fecha" => trim($_POST['fecha'] ?? ''),
            "lugar" => trim($_POST['lugar'] ?? ''),
            "descripcion" => trim($_POST['descripcion'] ?? ''),
            "violencia_fisica" => isset($_POST['violencia_fisica']),
            "amenazas_dano" => isset($_POST['amenazas_dano'])
        ];

        // anadimos el registro nuevo a los anteriores
        $registrosGuardados[] = $nuevoRegistroIncidencia;

        // convertimos los registros a json y los guardamos
        $datosConvertidosAJson = json_encode($registrosGuardados);
        $resultadoGuardado = file_put_contents($archivoDatosJson, $datosConvertidosAJson);

        // mostramos el resultado sin cambiar de pagina
        if ($resultadoGuardado === false) {
            $mensajeError = 'No se han podido guardar los datos.';
        } else {
            $mensajeCorrecto = 'Registro guardado correctamente.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Incidencias</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Incidencias/Agresiones</h2>
        <!-- mostramos un mensaje despues de enviar el formulario -->
        <?php if ($mensajeCorrecto !== ''): ?>
            <p class="success"><?= htmlspecialchars($mensajeCorrecto) ?></p>
        <?php endif; ?>
        <?php if ($mensajeError !== ''): ?>
            <p class="error"><?= htmlspecialchars($mensajeError) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label>Fecha del suceso:</label>
            <input type="date" name="fecha" value="<?= htmlspecialchars($mensajeError !== '' ? ($_POST['fecha'] ?? '') : '') ?>" required>
            
            <label>Lugar:</label>
            <input type="text" name="lugar" value="<?= htmlspecialchars($mensajeError !== '' ? ($_POST['lugar'] ?? '') : '') ?>" required>

            <label>Descripción de los hechos:</label>
            <textarea name="descripcion" rows="4" required><?= htmlspecialchars($mensajeError !== '' ? ($_POST['descripcion'] ?? '') : '') ?></textarea>

            <fieldset>
                <legend>Indicadores del episodio (VPR5.0-H)</legend>
                <label><input type="checkbox" name="violencia_fisica" <?= $mensajeError !== '' && isset($_POST['violencia_fisica']) ? 'checked' : '' ?>> Existencia de Violencia Física (Indicador 2)</label><br>
                <label><input type="checkbox" name="amenazas_dano" <?= $mensajeError !== '' && isset($_POST['amenazas_dano']) ? 'checked' : '' ?>> Existencia de amenazas o planes dirigidos a causar daño (Indicador 5)</label>
            </fieldset>

            <button type="submit">Guardar Incidencia</button>
        </form>
        <a href="../index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>