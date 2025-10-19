<?php
require_once './app/models/model.php';

//modelo de productos
class listamodel extends model{

    //consulta todos los productos
    public function obtener_lista(){ 
        $query = $this->db->prepare('SELECT pelicula.*, actor.id_actor FROM pelicula JOIN actor ON pelicula.id_actor = actor.id_actor;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //consulta producto segun id
    public function obtener_lista_por_id($id) {
    $query = $this->db->prepare('SELECT * FROM pelicula JOIN actor ON pelicula.id_actor = actor.id_actor  WHERE pelicula.id_pelicula = ?');
    $query->execute([$id]);
    return $query->fetchAll(PDO::FETCH_OBJ);
}


    //consulta por producto incluyendo la actor a la que corresponde
    public function obtener_pelicula_actor_por_id($id){
        $query = $this->db->prepare('SELECT pelicula.*, actor.actor FROM pelicula JOIN actor ON pelicula.id_actor = actor.id_actor WHERE pelicula.id_actor=?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
        //var_dump($algo);
        //die();
        return $query;
    }

    //eliminar producto
    public function eliminar_pelicula($id){
        $query = $this->db->prepare('DELETE FROM pelicula WHERE id_pelicula = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //elimina producto
    public function insertar_pelicula($nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor){
        $query = $this->db->prepare('INSERT INTO pelicula (nombre_pelicula, duracion, genero, descripcion, fecha_estreno, publico, img, $id_actor) VALUES(?,?,?,?,?,?,?)');
        $query->execute([$nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor]);
        return $this->db->lastInsertId();
    }

    //modifica producto
    public function modificar_pelicula($id_pelicula,$nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor){
        $query = $this->db->prepare('UPDATE pelicula SET id_pelicula=?,nombre_pelicula=?,duracion=?,genero=?,descripcion=?,fecha_estreno=?,publico=?,img=?,id_actor=? WHERE id_pelicula=?');
        $query->execute([$id_pelicula, $nombre_pelicula, $duracion, $genero, $descripcion, $fecha_estreno, $publico, $img, $id_actor]);
        return $query->rowCount();
    }

}
