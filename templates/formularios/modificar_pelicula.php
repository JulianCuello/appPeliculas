<?php
require_once 'templates/mostrar/header.phtml';
?>

<div class="container mt-1">
    <h2>Modificación de datos película</h2>
    <form action="modificar_pelicula" method="POST">
        <!-- Selector de actor -->
        <div class="mb-3">
            <label for="id_actor" class="form-label">Actor</label>
            <select class="form-select" id="id_actor" name="id_actor" required>
                <?php foreach ($actor as $act): ?>
                    <option value="<?= htmlspecialchars($act->id_actor) ?>" 
                        <?= ($act->id_actor == $item[0]->id_actor) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($act->actor ?? $act->id_actor) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Campo oculto para id_actor (puede no ser necesario si ya lo seleccionás arriba) -->
        <input type="hidden" name="id_actor_hidden" value="<?= htmlspecialchars($item[0]->id_actor) ?>">

        <!-- Nombre de la película -->
        <div class="mb-3">
            <label for="nombre_pelicula" class="form-label">Nombre película</label>
            <input type="text" class="form-control" id="nombre_pelicula" name="nombre_pelicula" value="<?= htmlspecialchars($item[0]->nombre_pelicula) ?>" required>
        </div>

        <!-- Duración -->
        <div class="mb-3">
            <label for="duracion" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" id="duracion" name="duracion" value="<?= htmlspecialchars($item[0]->duracion) ?>" min="1" required>
        </div>

        <!-- Género -->
        <div class="mb-3">
            <label for="genero" class="form-label">Género</label>
            <input type="text" class="form-control" id="genero" name="genero" value="<?= htmlspecialchars($item[0]->genero) ?>" required>
        </div>

        <!-- Fecha de estreno -->
        <div class="mb-3">
            <label for="fecha_estreno" class="form-label">Fecha de estreno</label>
            <input type="date" class="form-control" id="fecha_estreno" name="fecha_estreno" value="<?= htmlspecialchars($item[0]->fecha_estreno) ?>" required>
        </div>

        <!-- Público -->
        <div class="mb-3">
            <label for="publico" class="form-label">Público</label>
            <input type="text" class="form-control" id="publico" name="publico" value="<?= htmlspecialchars($item[0]->publico) ?>" required>
        </div>

        <!-- URL de la Imagen -->
        <div class="mb-3">
            <label for="img" class="form-label">URL de la Imagen</label>
            <input type="url" class="form-control" id="img" name="img" value="<?= htmlspecialchars($item[0]->img) ?>" required>
        </div>

        <button type="submit" class="btn btn-primary">Modificar</button>
    </form>
</div>

<?php
require_once 'templates/mostrar/footer.phtml';
?>
