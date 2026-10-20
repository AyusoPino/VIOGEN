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
        <?php if (isset($_GET['guardado'])): ?>
            <p class="success">Agresor registrado correctamente.</p>
        <?php elseif (isset($_GET['error'])): ?>
            <p class="error">No se ha podido guardar el registro. Comprueba los datos e inténtalo de nuevo.</p>
        <?php endif; ?>
        <form method="POST" action="../registro_agresores.php">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" required>
            
            <label>DNI/NIE:</label>
            <input type="text" name="dni" required>

            <fieldset>
                <legend>Indicadores de riesgo del agresor (VPR5.0-H)</legend>
                <label><input type="checkbox" name="celos"> Muestra celos exagerados o sospechas de infidelidad (Indicador 7)</label><br>
                <label><input type="checkbox" name="control"> Muestra conductas de control (Indicador 8)</label><br>
                <label><input type="checkbox" name="acoso"> Muestra conductas de acoso (Indicador 9)</label><br>
                <label><input type="checkbox" name="antecedentes"> Existen antecedentes penales y/o policiales (Indicador 15)</label><br>
                <label><input type="checkbox" name="toxicos"> Presenta adicción o abuso de tóxicos (alcohol/drogas) (Indicador 21)</label>
            </fieldset>

            <button type="submit">Guardar Agresor</button>
        </form>
        <a href="../index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>