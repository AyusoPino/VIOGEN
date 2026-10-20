<?php
// este archivo muestra el formulario y guarda sus datos
$mensajeCorrecto = '';
$mensajeError = '';

// solo procesamos los datos cuando se envia el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // comprobamos que los campos obligatorios no esten vacios
    if (trim($_POST['nombre'] ?? '') === '' || trim($_POST['dni'] ?? '') === '') {
        $mensajeError = 'Completa todos los campos obligatorios.';
    } else {
        // leemos los registros que ya estan guardados
        $archivoDatosJson = __DIR__ . '/../datos/agresores.json';
        $contenidoArchivoJson = file_get_contents($archivoDatosJson);
        $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);

        // si el archivo no contiene una lista valida empezamos vacios
        if (!is_array($registrosGuardados)) {
            $registrosGuardados = [];
        }

        // recogemos los campos del formulario en un array
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

        // anadimos el registro nuevo a los anteriores
        $registrosGuardados[] = $nuevoRegistroAgresor;

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
    <title>Registro de Agresores</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Datos del Presunto Agresor</h2>
        <!-- mostramos un mensaje despues de enviar el formulario -->
        <?php if ($mensajeCorrecto !== ''): ?>
            <p class="success"><?= htmlspecialchars($mensajeCorrecto) ?></p>
        <?php endif; ?>
        <?php if ($mensajeError !== ''): ?>
            <p class="error"><?= htmlspecialchars($mensajeError) ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($mensajeError !== '' ? ($_POST['nombre'] ?? '') : '') ?>" required>
            
            <label>DNI/NIE:</label>
            <input type="text" name="dni" value="<?= htmlspecialchars($mensajeError !== '' ? ($_POST['dni'] ?? '') : '') ?>" required>

            <fieldset>
                <legend>Indicadores de riesgo del agresor (VPR5.0-H)</legend>
                <label><input type="checkbox" name="celos" <?= $mensajeError !== '' && isset($_POST['celos']) ? 'checked' : '' ?>> Muestra celos exagerados o sospechas de infidelidad (Indicador 7)</label><br>
                <label><input type="checkbox" name="control" <?= $mensajeError !== '' && isset($_POST['control']) ? 'checked' : '' ?>> Muestra conductas de control (Indicador 8)</label><br>
                <label><input type="checkbox" name="acoso" <?= $mensajeError !== '' && isset($_POST['acoso']) ? 'checked' : '' ?>> Muestra conductas de acoso (Indicador 9)</label><br>
                <label><input type="checkbox" name="antecedentes" <?= $mensajeError !== '' && isset($_POST['antecedentes']) ? 'checked' : '' ?>> Existen antecedentes penales y/o policiales (Indicador 15)</label><br>
                <label><input type="checkbox" name="toxicos" <?= $mensajeError !== '' && isset($_POST['toxicos']) ? 'checked' : '' ?>> Presenta adicción o abuso de tóxicos (alcohol/drogas) (Indicador 21)</label>
            </fieldset>

            <button type="submit">Guardar Agresor</button>
        </form>
        <a href="../index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>