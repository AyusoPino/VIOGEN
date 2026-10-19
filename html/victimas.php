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
        <?php if(isset($mensaje)) echo "<p class='success'>$mensaje</p>"; ?>
        <form method="POST" action="../registro_victimas.php">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" required>
            
            <label>DNI/NIE:</label>
            <input type="text" name="dni" required>

            <fieldset>
                <legend>Indicadores de vulnerabilidad (VPR5.0-H)</legend>
                <label><input type="checkbox" name="extranjera"> Víctima extranjera (Indicador 28)</label><br>
                <label><input type="checkbox" name="menores_cargo"> Tiene a su cargo menores de edad (Indicador 29)</label><br>
                <label><input type="checkbox" name="temor_vida"> Piensa que el agresor es capaz de matarla o agredirla gravemente (Indicador 35)</label>
            </fieldset>

            <button type="submit">Guardar Víctima</button>
        </form>
        <a href="../index.php" class="btn-back">Volver al Inicio</a>
    </div>
</body>
</html>