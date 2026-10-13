<?php
$editar = $pelicula->getId() !== null;
$escapar = function ($valor) {
    return htmlspecialchars((string) $valor, ENT_QUOTES, "UTF-8");
};
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $editar ? "Editar película" : "Nueva película" ?></title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

<div class="contenedor formulario">
    <h1><?= $editar ? "Editar película" : "Nueva película" ?></h1>

    <form method="POST" action="index.php?accion=<?= $editar ? "actualizar" : "guardar" ?>">
        <?php if ($editar): ?>
            <input type="hidden" name="id" value="<?= $escapar($pelicula->getId()) ?>">
        <?php endif; ?>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" maxlength="100" required
               value="<?= $escapar($pelicula->getNombre()) ?>">

        <label for="genero">Género:</label>
        <input type="text" id="genero" name="genero" maxlength="50" required
               value="<?= $escapar($pelicula->getGenero()) ?>">

        <label for="duracion">Duración (minutos):</label>
        <input type="number" id="duracion" name="duracion" min="0" max="2147483647" step="1" required
               value="<?= $escapar($pelicula->getDuracion()) ?>">


        <label for="imagenportada">Imagen de portada (nombre o ruta del archivo):</label>
        <input type="text" id="imagenportada" name="imagenportada" maxlength="255" required
               value="<?= $escapar($pelicula->getImagenportada()) ?>">

        <div class="acciones-formulario">
            <a href="index.php" class="btn btn-cancelar">Cancelar</a>
            <button type="submit" class="btn btn-guardar">
                <?= $editar ? "Actualizar" : "Guardar" ?>
            </button>
        </div>
    </form>
</div>

</body>
</html>
