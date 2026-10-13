<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de películas</title>
    <link rel="stylesheet" href="public/css/estilos.css">
</head>
<body>

<div class="contenedor">
    <div class="encabezado">
        <h1>Gestión de películas</h1>
        <button type="button" class="btn btn-nuevo" onclick="abrirModal()">
            + Nueva película
        </button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Género</th>
                <th>Duración (minutos)</th>
                <th>Imagen de portada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($peliculas)): ?>
                <tr>
                    <td colspan="6" class="sin-Peliculas">
                        No existen películas registradas.
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($peliculas as $pelicula): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $pelicula->getId(), ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($pelicula->getNombre(), ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($pelicula->getGenero(), ENT_QUOTES, "UTF-8") ?></td>
                        <td><?= htmlspecialchars($pelicula->getDuracion(), ENT_QUOTES, "UTF-8") ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($pelicula->getImagenportada(), ENT_QUOTES, "UTF-8") ?>"
                                 alt="Portada de <?= htmlspecialchars($pelicula->getNombre(), ENT_QUOTES, "UTF-8") ?>"
                                 style="width: 80px; height: 120px; object-fit: cover;">
                        </td>
                        <td>
                            <a href="index.php?accion=editar&id=<?= urlencode((string) $pelicula->getId()) ?>"
                               class="btn btn-editar">Editar</a>
                            <a href="index.php?accion=eliminar&id=<?= urlencode((string) $pelicula->getId()) ?>"
                               class="btn btn-eliminar"
                               onclick="return confirm('¿Está seguro de eliminar esta película?');">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div id="modalPelicula" class="modal">
    <div class="modal-contenido">
        <div class="modal-encabezado">
            <h2>Nueva película</h2>
            <button type="button" class="cerrar" onclick="cerrarModal()">&times;</button>
        </div>
        <form method="POST" action="index.php?accion=guardar">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" maxlength="100" required>

            <label for="genero">Género:</label>
            <input type="text" id="genero" name="genero" maxlength="50" required>

            <label for="duracion">Duración (minutos):</label>
            <input type="number" id="duracion" name="duracion" min="0" max="2147483647" step="1" required>

<label for="imagenportada">Imagen de portada (nombre o ruta del archivo):</label>
            <input type="text" id="imagenportada" name="imagenportada" maxlength="255" required>

            <div class="acciones-formulario">
                <button type="button" class="btn btn-cancelar" onclick="cerrarModal()">
                    Cancelar
                </button>
                <button type="submit" class="btn btn-guardar">Guardar película</button>
            </div>
        </form>
    </div>
</div>

<script>
    function abrirModal() {
        document.getElementById("modalPelicula").style.display = "flex";
        document.getElementById("nombre").focus();
    }

    function cerrarModal() {
        document.getElementById("modalPelicula").style.display = "none";
    }

    window.onclick = function(event) {
        const modal = document.getElementById("modalPelicula");
        if (event.target === modal) {
            cerrarModal();
        }
    };
</script>

</body>
</html>
