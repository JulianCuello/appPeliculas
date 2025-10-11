<?php

class PeliculaVista {

    public function mostrarError($error) {
        echo "<h2>$error</h2>";
    }

    public function mostrar_peliculas($peliculas) {
        require_once "templates/header.php";
        ?>
        <main class="container my-4">
            <section class="peliculas">
                <div class="row">
                    <?php foreach ($peliculas as $pelicula): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="<?php echo htmlspecialchars($pelicula->img); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($pelicula->nombre_pelicula); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($pelicula->nombre_pelicula); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($pelicula->duracion); ?></p>
                                    <a href="pelicula/<?php echo $pelicula->id_pelicula; ?>" class="btn btn-outline-primary me-2">Leer más</a>
                                    <a href="actualizar_pelicula/<?php echo $pelicula->id_pelicula; ?>" class="btn btn-success me-2">Modificar</a>
                                    <a href="eliminar_pelicula/<?php echo $pelicula->id_pelicula; ?>" class="btn btn-danger">Eliminar</a>
                                    <a href="agregar_pelicula/<?php echo $pelicula->id_pelicula; ?>" class="btn btn-primary">Agregar</a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </main>
        <?php
        require_once "templates/footer.php";
    }

    public function mostrar_pelicula($pelicula) {
        require_once "templates/header.php";

        if (!$pelicula) {
            echo "<p>Película no encontrada.</p>";
            require_once "templates/footer.php";
            return;
        }
        ?>
        <main class="container my-4">
            <section class="pelicula">
                <div class="card" style="width: 18rem;">
                    <h1><?php echo htmlspecialchars($pelicula->nombre_pelicula); ?></h1>
                    <p class="lead mt-3"><?php echo htmlspecialchars($pelicula->duracion); ?></p>
                    <p><?php echo htmlspecialchars($pelicula->descripcion); ?></p>
                    <img class="pelicula-image img-fluid" src="<?php echo htmlspecialchars($pelicula->img); ?>" alt="Imagen de la película">
                </div>
            </section>
        </main>
        <?php
        require_once "templates/footer.php";
    }

}
