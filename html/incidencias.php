<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Incidencias</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Incidencias/Agresiones</h2>
        <?php if(isset($mensaje)) echo "<p class='success'>$mensaje</p>"; ?>
        <form method="POST" action="registro_incidencias.php">
            <label>Fecha del suceso:</label>
            <input type="date" name="fecha" required>
            
            <label>Lugar:</label>
            <input type="text" name="lugar" required>

            <label>Descripción de los hechos:</label>
            <textarea name="descripcion" rows="4" required></textarea>

            <fieldset>
                <legend>Indicadores del episodio (VPR5.0-H)</legend>
                <label><input type="checkbox" name="violencia_fisica"> Existencia de Violencia Física (Indicador 2)</label><br>
                <label><input type="checkbox" name="amenazas_dano"> Existencia de amenazas o planes dirigidos a causar daño (Indicador 5)</label>
            </fieldset>

            <button type="submit">Guardar Incidencia</button>
        </form>
        <a href="index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>