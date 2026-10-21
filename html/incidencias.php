<?php
// recibimos los datos de los otros formularios usando campos ocultos
// no se guarda ningun dato en los archivos json
$victima_nombre = $_POST['victima_nombre'] ?? '';
$victima_dni = $_POST['victima_dni'] ?? '';
$victima_extranjera = $_POST['victima_extranjera'] ?? '';
$victima_menores_cargo = $_POST['victima_menores_cargo'] ?? '';
$victima_temor_vida = $_POST['victima_temor_vida'] ?? '';
$agresor_nombre = $_POST['agresor_nombre'] ?? '';
$agresor_dni = $_POST['agresor_dni'] ?? '';
$agresor_celos = $_POST['agresor_celos'] ?? '';
$agresor_control = $_POST['agresor_control'] ?? '';
$agresor_acoso = $_POST['agresor_acoso'] ?? '';
$agresor_antecedentes = $_POST['agresor_antecedentes'] ?? '';
$agresor_toxicos = $_POST['agresor_toxicos'] ?? '';
$incidencia_fecha = $_POST['incidencia_fecha'] ?? '';
$incidencia_lugar = $_POST['incidencia_lugar'] ?? '';
$incidencia_descripcion = $_POST['incidencia_descripcion'] ?? '';
$incidencia_violencia_fisica = $_POST['incidencia_violencia_fisica'] ?? '';
$incidencia_amenazas_dano = $_POST['incidencia_amenazas_dano'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Incidencias/Agresiones</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<div class="container">
    <h2>Registro de Incidencias/Agresiones</h2>

    <!-- el formulario envia los datos con post a la pagina elegida -->
    <form action="" method="post">
        <!-- estos campos ocultos mantienen los datos de los otros formularios -->
        <input type="hidden" name="victima_nombre" value="<?= htmlspecialchars($victima_nombre) ?>">
        <input type="hidden" name="victima_dni" value="<?= htmlspecialchars($victima_dni) ?>">
        <input type="hidden" name="victima_extranjera" value="<?= htmlspecialchars($victima_extranjera) ?>">
        <input type="hidden" name="victima_menores_cargo" value="<?= htmlspecialchars($victima_menores_cargo) ?>">
        <input type="hidden" name="victima_temor_vida" value="<?= htmlspecialchars($victima_temor_vida) ?>">
        <input type="hidden" name="agresor_nombre" value="<?= htmlspecialchars($agresor_nombre) ?>">
        <input type="hidden" name="agresor_dni" value="<?= htmlspecialchars($agresor_dni) ?>">
        <input type="hidden" name="agresor_celos" value="<?= htmlspecialchars($agresor_celos) ?>">
        <input type="hidden" name="agresor_control" value="<?= htmlspecialchars($agresor_control) ?>">
        <input type="hidden" name="agresor_acoso" value="<?= htmlspecialchars($agresor_acoso) ?>">
        <input type="hidden" name="agresor_antecedentes" value="<?= htmlspecialchars($agresor_antecedentes) ?>">
        <input type="hidden" name="agresor_toxicos" value="<?= htmlspecialchars($agresor_toxicos) ?>">

        <!-- campos visibles del formulario actual -->
        <label for="incidencia_fecha">Fecha del suceso:</label>
        <input type="date" id="incidencia_fecha" name="incidencia_fecha" value="<?= htmlspecialchars($incidencia_fecha) ?>">
        
        <label for="incidencia_lugar">Lugar:</label>
        <input type="text" id="incidencia_lugar" name="incidencia_lugar" value="<?= htmlspecialchars($incidencia_lugar) ?>">
        
        <label for="incidencia_descripcion">Descripción de los hechos:</label>
        <textarea id="incidencia_descripcion" name="incidencia_descripcion" rows="4"><?= htmlspecialchars($incidencia_descripcion) ?></textarea>
        
        <fieldset>
            <legend>Indicadores del episodio (VPR5.0-H)</legend>
            <!-- un campo hidden con valor cero permite enviar tambien las casillas sin marcar -->
            <input type="hidden" name="incidencia_violencia_fisica" value="0">
            <label><input type="checkbox" name="incidencia_violencia_fisica" value="1" <?= $incidencia_violencia_fisica == "1" ? "checked" : "" ?>> Existencia de Violencia Física (Indicador 2)</label><br>
            <input type="hidden" name="incidencia_amenazas_dano" value="0">
            <label><input type="checkbox" name="incidencia_amenazas_dano" value="1" <?= $incidencia_amenazas_dano == "1" ? "checked" : "" ?>> Existencia de amenazas o planes dirigidos a causar daño (Indicador 5)</label><br>
        </fieldset>

        <!-- cada boton envia todos los campos y permite cambiar de formulario libremente -->
        <div class="acciones">
            <button type="submit" formaction="victimas.php">Ir a Víctima</button>
            <button type="submit" formaction="agresores.php">Ir a Agresor</button>
            <button type="submit" formaction="../informe.php">Generar informe</button>
        </div>
        
    </form>
    <a href="../index.php" class="btn-back">Volver al inicio y empezar de nuevo</a>
</div>
</body>
</html>
