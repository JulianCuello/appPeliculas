<?php
require_once './app/models/model.php';

//modelo de productos
class listamodel extends model{

    //consulta todos los productos CON sus actores
    public function obtener_lista(){ 
        $query = $this->db->prepare('SELECT pelicula.*, actor.nombre_actor, actor.id_actor 
                                     FROM pelicula 
                                     LEFT JOIN actor ON pelicula.id_pelicula = actor.id_pelicula 
                                     ORDER BY pelicula.id_pelicula');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //consulta producto segun id
    public function obtener_lista_por_id($id) {
        $query = $this->db->prepare('SELECT pelicula.*, actor.nombre_actor, actor.id_actor 
                                     FROM pelicula 
                                     LEFT JOIN actor ON pelicula.id_pelicula = actor.id_pelicula 
                                     WHERE pelicula.id_pelicula = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //consulta películas con sus actores
    public function obtener_pelicula_con_actores($id){
        $query = $this->db->prepare('SELECT pelicula.*, actor.nombre_actor, actor.id_actor 
                                     FROM pelicula 
                                     LEFT JOIN actor ON pelicula.id_pelicula = actor.id_pelicula 
                                     WHERE pelicula.id_pelicula = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //consulta por actor incluyendo las películas
    public function obtener_pelicula_actor_por_id($id){
        $query = $this->db->prepare('SELECT pelicula.*, actor.nombre_actor 
                                     FROM actor 
                                     JOIN pelicula ON actor.id_pelicula = pelicula.id_pelicula 
                                     WHERE actor.id_actor = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
   
    //eliminar producto
    public function eliminar_pelicula($id){
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //insertar película
    public function insertar_pelicula($id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img){
        $query = $this->db->prepare('INSERT INTO pelicula (id_pelicula, nombre_pelicula, duracion, genero, descripcion, fecha_estreno, publico, img) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img]);
        return $this->db->lastInsertId();
    }

    //modifica producto
    public function modificar_pelicula($id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img){
        $query = $this->db->prepare('UPDATE pelicula SET nombre_pelicula = ?, duracion = ?, genero = ?, descripcion = ?, fecha_estreno = ?, publico = ?, img = ? WHERE id_pelicula = ?');
        $query->execute([$nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_pelicula]);
        return $query->rowCount();
    }

    //obtener solo películas (sin JOIN con actores) para los dropdowns
public function obtener_lista_solo_peliculas(){ 
    $query = $this->db->prepare('SELECT id_pelicula, nombre_pelicula FROM pelicula ORDER BY nombre_pelicula');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}
}