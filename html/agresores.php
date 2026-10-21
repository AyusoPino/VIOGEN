<?php
// recibimos los datos de los otros formularios usando campos ocultos
// no se guarda ningun dato en los archivos json
$victima_nombre = $_POST['victima_nombre'] ?? '';
$victima_dni = $_POST['victima_dni'] ?? '';
$victima_extranjera = $_POST['victima_extranjera'] ?? '';
$victima_menores_cargo = $_POST['victima_menores_cargo'] ?? '';
$victima_temor_vida = $_POST['victima_temor_vida'] ?? '';
$incidencia_fecha = $_POST['incidencia_fecha'] ?? '';
$incidencia_lugar = $_POST['incidencia_lugar'] ?? '';
$incidencia_descripcion = $_POST['incidencia_descripcion'] ?? '';
$incidencia_violencia_fisica = $_POST['incidencia_violencia_fisica'] ?? '';
$incidencia_amenazas_dano = $_POST['incidencia_amenazas_dano'] ?? '';
$agresor_nombre = $_POST['agresor_nombre'] ?? '';
$agresor_dni = $_POST['agresor_dni'] ?? '';
$agresor_celos = $_POST['agresor_celos'] ?? '';
$agresor_control = $_POST['agresor_control'] ?? '';
$agresor_acoso = $_POST['agresor_acoso'] ?? '';
$agresor_antecedentes = $_POST['agresor_antecedentes'] ?? '';
$agresor_toxicos = $_POST['agresor_toxicos'] ?? '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Datos del Presunto Agresor</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
<div class="container">
    <h2>Registro de Datos del Presunto Agresor</h2>

    <!-- el formulario envia los datos con post a la pagina elegida -->
    <form action="" method="post">
        
        <!-- estos campos ocultos mantienen los datos de los otros formularios -->
        <input type="hidden" name="victima_nombre" value="<?= htmlspecialchars($victima_nombre) ?>">
        <input type="hidden" name="victima_dni" value="<?= htmlspecialchars($victima_dni) ?>">
        <input type="hidden" name="victima_extranjera" value="<?= htmlspecialchars($victima_extranjera) ?>">
        <input type="hidden" name="victima_menores_cargo" value="<?= htmlspecialchars($victima_menores_cargo) ?>">
        <input type="hidden" name="victima_temor_vida" value="<?= htmlspecialchars($victima_temor_vida) ?>">
        <input type="hidden" name="incidencia_fecha" value="<?= htmlspecialchars($incidencia_fecha) ?>">
        <input type="hidden" name="incidencia_lugar" value="<?= htmlspecialchars($incidencia_lugar) ?>">
        <input type="hidden" name="incidencia_descripcion" value="<?= htmlspecialchars($incidencia_descripcion) ?>">
        <input type="hidden" name="incidencia_violencia_fisica" value="<?= htmlspecialchars($incidencia_violencia_fisica) ?>">
        <input type="hidden" name="incidencia_amenazas_dano" value="<?= htmlspecialchars($incidencia_amenazas_dano) ?>">
       
        <!-- campos visibles del formulario actual -->
        <label for="agresor_nombre">Nombre completo:</label>
        <input type="text" id="agresor_nombre" name="agresor_nombre" value="<?= htmlspecialchars($agresor_nombre) ?>">
        
        <label for="agresor_dni">DNI/NIE:</label>
        <input type="text" id="agresor_dni" name="agresor_dni" value="<?= htmlspecialchars($agresor_dni) ?>">
        
        <fieldset>
            <legend>Indicadores de riesgo del agresor (VPR5.0-H)</legend>
            
            <!-- un campo hidden con valor cero permite enviar tambien las casillas sin marcar -->
            <input type="hidden" name="agresor_celos" value="0">
            <label>
                <input type="checkbox" name="agresor_celos" value="1" <?= $agresor_celos == "1" ? "checked" : "" ?>> Muestra celos exagerados o sospechas de infidelidad (Indicador 7)
            </label>
            
            <br>
            
            <input type="hidden" name="agresor_control" value="0">
            <label>
                <input type="checkbox" name="agresor_control" value="1" <?= $agresor_control == "1" ? "checked" : "" ?>> Muestra conductas de control (Indicador 8)
            </label>
            
            <br>
            
            <input type="hidden" name="agresor_acoso" value="0">
            <label>
                <input type="checkbox" name="agresor_acoso" value="1" <?= $agresor_acoso == "1" ? "checked" : "" ?>> Muestra conductas de acoso (Indicador 9)
            </label>
            
            <br>
            
            <input type="hidden" name="agresor_antecedentes" value="0">
            <label>
                <input type="checkbox" name="agresor_antecedentes" value="1" <?= $agresor_antecedentes == "1" ? "checked" : "" ?>> Existen antecedentes penales y/o policiales (Indicador 15)
            </label>
            
            <br>
            
            <input type="hidden" name="agresor_toxicos" value="0">
            <label>
                <input type="checkbox" name="agresor_toxicos" value="1" <?= $agresor_toxicos == "1" ? "checked" : "" ?>> Presenta adicción o abuso de tóxicos (alcohol/drogas) (Indicador 21)
            </label>
            
            <br>
        </fieldset>
        <!-- cada boton envia todos los campos y permite cambiar de formulario libremente -->
        <div class="acciones">
            <button type="submit" formaction="victimas.php">Ir a Víctima</button>
            <button type="submit" formaction="incidencias.php">Ir a Incidencia</button>
            <button type="submit" formaction="../informe.php">Generar informe</button>
        </div>
    </form>
    <a href="../index.php" class="btn-back">Volver al inicio y empezar de nuevo</a>
</div>
</body>
</html>
