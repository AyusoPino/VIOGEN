<?php
// recibimos los datos de los otros formularios usando campos ocultos
// no se guarda ningun dato en los archivos json
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
$victima_nombre = $_POST['victima_nombre'] ?? '';
$victima_dni = $_POST['victima_dni'] ?? '';
$victima_extranjera = $_POST['victima_extranjera'] ?? '';
$victima_menores_cargo = $_POST['victima_menores_cargo'] ?? '';
$victima_temor_vida = $_POST['victima_temor_vida'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Datos de la Víctima</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<div class="container">
    <h2>Registro de Datos de la Víctima</h2>
    
    <!-- el formulario envia los datos con post a la pagina elegida -->
    <form action="" method="post">
        <!-- estos campos ocultos mantienen los datos de los otros formularios -->
        <input type="hidden" name="agresor_nombre" value="<?= htmlspecialchars($agresor_nombre) ?>">
        <input type="hidden" name="agresor_dni" value="<?= htmlspecialchars($agresor_dni) ?>">
        <input type="hidden" name="agresor_celos" value="<?= htmlspecialchars($agresor_celos) ?>">
        <input type="hidden" name="agresor_control" value="<?= htmlspecialchars($agresor_control) ?>">
        <input type="hidden" name="agresor_acoso" value="<?= htmlspecialchars($agresor_acoso) ?>">
        <input type="hidden" name="agresor_antecedentes" value="<?= htmlspecialchars($agresor_antecedentes) ?>">
        <input type="hidden" name="agresor_toxicos" value="<?= htmlspecialchars($agresor_toxicos) ?>">
        <input type="hidden" name="incidencia_fecha" value="<?= htmlspecialchars($incidencia_fecha) ?>">
        <input type="hidden" name="incidencia_lugar" value="<?= htmlspecialchars($incidencia_lugar) ?>">
        <input type="hidden" name="incidencia_descripcion" value="<?= htmlspecialchars($incidencia_descripcion) ?>">
        <input type="hidden" name="incidencia_violencia_fisica" value="<?= htmlspecialchars($incidencia_violencia_fisica) ?>">
        <input type="hidden" name="incidencia_amenazas_dano" value="<?= htmlspecialchars($incidencia_amenazas_dano) ?>">
        
        <!-- campos visibles del formulario actual -->
        <label for="victima_nombre">Nombre completo:</label>
        <input type="text" id="victima_nombre" name="victima_nombre" value="<?= htmlspecialchars($victima_nombre) ?>">
        <label for="victima_dni">DNI/NIE:</label>
        <input type="text" id="victima_dni" name="victima_dni" value="<?= htmlspecialchars($victima_dni) ?>">
        <fieldset>
            <legend>Indicadores de vulnerabilidad (VPR5.0-H)</legend>
            
            <!-- un campo hidden con valor cero permite enviar tambien las casillas sin marcar -->
            <input type="hidden" name="victima_extranjera" value="0">
            <label>
                <input type="checkbox" name="victima_extranjera" value="1" <?= $victima_extranjera == "1" ? "checked" : "" ?>> Víctima extranjera (Indicador 28)
            </label>
            
            <br>
            
            <input type="hidden" name="victima_menores_cargo" value="0">
            <label>
                <input type="checkbox" name="victima_menores_cargo" value="1" <?= $victima_menores_cargo == "1" ? "checked" : "" ?>> Tiene a su cargo menores de edad (Indicador 29)
            </label>
            
            <br>
            
            <input type="hidden" name="victima_temor_vida" value="0">
            <label>
                <input type="checkbox" name="victima_temor_vida" value="1" <?= $victima_temor_vida == "1" ? "checked" : "" ?>> Piensa que el agresor es capaz de matarla o agredirla gravemente (Indicador 35)
            </label>
            <br>
        </fieldset>
        
        <!-- cada boton envia todos los campos y permite cambiar de formulario libremente -->
        <div class="acciones">
            <button type="submit" formaction="agresores.php">Ir a Agresor</button>
            <button type="submit" formaction="incidencias.php">Ir a Incidencia</button>
            <button type="submit" formaction="../informe.php">Generar informe</button>
        </div>
    </form>
    <a href="../index.php" class="btn-back">Volver al inicio y empezar de nuevo</a>
</div>
</body>
</html>
