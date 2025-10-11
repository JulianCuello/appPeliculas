<?php

class PeliculaModelo {
    private function obtenerConexion() {
        return new PDO('mysql:host=localhost;dbname=app_peliculas;charset=utf8', 'root', '');
    }

    public function mostrar_peliculas() {
        $db = $this->obtenerConexion();
        $query = $db->prepare('SELECT * FROM pelicula');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function seleccionar_pelicula($id) {
        $db = $this->obtenerConexion();
        $query = $db->prepare('SELECT * FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function agregar_pelicula($nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img) {
        $db = $this->obtenerConexion();
        $query = $db->prepare("INSERT INTO pelicula (nombre_pelicula, duracion, genero, descripcion, fecha_estreno, publico, img) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $query->execute([$nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img]);
        return $db->lastInsertId();
    }
 public function eliminar_pelicula($id) {
    $db = $this->obtenerConexion(); // CORRECTO: se crea la conexión localmente
    $query = $db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
    $query->execute([$id]);
    return $query->rowCount();
}


}
