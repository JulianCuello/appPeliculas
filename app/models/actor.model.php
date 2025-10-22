<?php
require_once './app/models/model.php';

//modelo de actores
class actormodel extends model{
    
    //consulta todos los actores
    public function obtener_actor(){
        $query = $this->db->prepare('SELECT actor.*, pelicula.nombre_pelicula FROM actor LEFT JOIN pelicula ON actor.id_pelicula = pelicula.id_pelicula');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);       
    }
    
    //consulta actor segun id
    public function obtener_actor_id($id){
        $query = $this->db->prepare('SELECT actor.*, pelicula.nombre_pelicula FROM actor LEFT JOIN pelicula ON actor.id_pelicula = pelicula.id_pelicula WHERE id_actor=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);       
    }
    
    //inserta nuevo actor (sin id_actor porque es AUTO_INCREMENT)
    public function insertar_actor($nombre_actor, $fecha_nacimiento, $edad, $nacionalidad, $id_pelicula){
        $query = $this->db->prepare('INSERT INTO actor (nombre_actor, fecha_nacimiento, edad, nacionalidad, id_pelicula) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nombre_actor, $fecha_nacimiento, $edad, $nacionalidad, $id_pelicula]);
        return $this->db->lastInsertId();
    }

    //elimina actor
    public function eliminar_actor($id){
        $query = $this->db->prepare('DELETE FROM actor WHERE id_actor = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //modifica actor
    public function modificar_actor($id_actor, $nombre_actor, $fecha_nacimiento, $edad, $nacionalidad, $id_pelicula){
        $query = $this->db->prepare('UPDATE actor SET nombre_actor=?, fecha_nacimiento=?, edad=?, nacionalidad=?, id_pelicula=? WHERE id_actor=?');
        $query->execute([$nombre_actor, $fecha_nacimiento, $edad, $nacionalidad, $id_pelicula, $id_actor]);
        return $query->rowCount();
    }

    //consulta para mostrar los actores disponibles
    public function obtener_id_actor(){ 
        $query = $this->db->prepare('SELECT id_actor, nombre_actor FROM actor');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
