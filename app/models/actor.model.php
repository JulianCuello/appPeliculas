<?php
require_once './app/models/model.php';
//modelo de actores
class actormodel extends model{
    
    //consulta todas las actores
    public function obtener_actor(){
        $query = $this->db->prepare('SELECT * FROM `actor`');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);       
    }
    
    //consulta actor segun id
    public function obtener_actor_id($id){
        $query = $this->db->prepare('SELECT * FROM `actor` WHERE id_actor=?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);       
    }
    
    //inserta nueva actor
    public function insertar_actor($nombre_actor, $fecha_nacimiento, $edad, $nacionalidad){
    $query = $this->db->prepare('INSERT INTO actor (nombre_actor, fecha_nacimiento, edad, nacionalidad) VALUES (?, ?, ?, ?)');
    $query->execute([$nombre_actor, $fecha_nacimiento, $edad, $nacionalidad]);
    return $this->db->lastInsertId();
    }

    //elimina actor
    public function eliminar_actor($id){
        $query = $this->db->prepare('DELETE FROM actor WHERE id_actor = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //modifica actor
    public function modificar_pelicula($id_actor, $nombre_actor, $fecha_nacimiento, $edad, $nacionalidad){
    $query = $this->db->prepare('UPDATE actor SET nombre_actor=?,fecha_nacimiento=?,edad=?,nacionalidad=? WHERE id_actor=?');
    $query->execute([$nombre_actor, $fecha_nacimiento, $edad, $nacionalidad, $id_actor]);
    return $query->rowCount();
    }

    //consulta para mostrar las actores disponibles cuando se quiere modificar un producto o actor
    public function obtener_id_actor(){ 
        $query = $this->db->prepare('SELECT id_actor, nombre_actor FROM actor;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function obtener_id_pelicula(){ 
    $query = $this->db->prepare('SELECT id_pelicula, nombre_pelicula FROM pelicula');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
}

}
