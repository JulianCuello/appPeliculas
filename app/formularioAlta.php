<?php
function FormularioAlta() {
    require_once 'templates/header.php';
    ?>

    <div class="container mt-5">
        <h2>Carga de película</h2>

        <form action="agregar_pelicula" method="POST">
            <div class="mb-3">
                <label for="nombre_pelicula" class="form-label">Pelicula</label>
                <input type="text" class="form-control" id="nombre_pelicula" name="nombre_pelicula" required>
            </div>
            <div class="mb-3">
                <label for="duracion" class="form-label">Duración</label>
                <input type="number" class="form-control" id="duracion" name="duracion" required>
            </div>
            <div class="mb-3">
                <label for="genero" class="form-label">Género</label>
                <input type="text" class="form-control" id="genero" name="genero" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
            </div>
            <div class="mb-3">
                <label for="fecha_estreno" class="form-label">Fecha de estreno</label>
                <input type="number" class="form-control" id="fecha_estreno" name="fecha_estreno" required>
            </div>
            <div class="mb-3">
                <label for="publico" class="form-label">Público</label>
                <input type="text" class="form-control" id="publico" name="publico" required>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Imagen (URL)</label>
                <input type="text" class="form-control" id="img" name="img" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Película</button>
        </form>
    </div>

    <?php
    require_once 'templates/footer.php';
}
