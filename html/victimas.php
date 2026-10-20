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
        $archivoDatosJson = __DIR__ . '/../datos/victimas.json';
        $contenidoArchivoJson = file_get_contents($archivoDatosJson);
        $registrosGuardados = json_decode($contenidoArchivoJson ?: '[]', true);

        // si el archivo no contiene una lista valida empezamos vacios
        if (!is_array($registrosGuardados)) {
            $registrosGuardados = [];
        }

        // recogemos los campos del formulario en un array
        $nuevoRegistroVictima = [
            "id" => uniqid(),
            "nombre" => trim($_POST['nombre'] ?? ''),
            "dni" => trim($_POST['dni'] ?? ''),
            "extranjera" => isset($_POST['extranjera']),
            "menores_cargo" => isset($_POST['menores_cargo']),
            "temor_vida" => isset($_POST['temor_vida'])
        ];

        // añadimos el registro nuevo a los anteriores
        $registrosGuardados[] = $nuevoRegistroVictima;

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
    <title>Registro de Víctimas</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

    <div class="container">
        <h2>Registro de Datos de la Víctima</h2>

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
                <legend>Indicadores de vulnerabilidad (VPR5.0-H)</legend>
                <label>
                    <input type="checkbox" name="extranjera" <?= $mensajeError !== '' && isset($_POST['extranjera']) ? 'checked' : '' ?>> Víctima extranjera (Indicador 28)
                </label>
                
                <br>
                
                <label>
                    <input type="checkbox" name="menores_cargo" <?= $mensajeError !== '' && isset($_POST['menores_cargo']) ? 'checked' : '' ?>> Tiene a su cargo menores de edad (Indicador 29)
                </label>
                
                <br>
                
                <label>
                    <input type="checkbox" name="temor_vida" <?= $mensajeError !== '' && isset($_POST['temor_vida']) ? 'checked' : '' ?>> Piensa que el agresor es capaz de matarla o agredirla gravemente (Indicador 35)
                </label>
            </fieldset>

            <button type="submit">Guardar Víctima</button>
        </form>
        <a href="../index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>