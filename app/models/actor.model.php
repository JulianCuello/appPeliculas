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
    public function insertar_actor($nombre_actor , $fecha_nacimiento, $edad, $nacionalidad){
        $query = $this->db->prepare('INSERT INTO actor ($nombre_actor , $fecha_nacimiento, $edad, $nacionalidad) VALUES(?,?,?,?)');
        $query->execute([$nombre_actor , $fecha_nacimiento, $edad, $nacionalidad]);
        return $this->db->lastInsertId();
    }

    //elimina actor
    public function eliminar_actor($id){
        $query = $this->db->prepare('DELETE FROM actor WHERE id_actor = ?');
        $query->execute([$id]);
        return $query->rowCount();
    }

    //modifica actor
    public function modificar_pelicula($nombre_actor , $fecha_nacimiento, $edad, $nacionalidad){
        $query = $this->db->prepare('UPDATE actor SET nombre_actor=?,fecha_nacimiento=?,edad=?,nacionalidad=? WHERE id_actor=?');
        $query->execute([$nombre_actor , $fecha_nacimiento, $edad, $nacionalidad]);
        return $query->rowCount();
    }

    //consulta para mostrar las actores disponibles cuando se quiere modificar un producto o actor
    public function obtener_id_actor(){ 
        $query = $this->db->prepare('SELECT actor.id_actor,actor.actor FROM actor;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}
