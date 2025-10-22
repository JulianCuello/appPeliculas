<?php
//view de actores
class actorview{

    public function mostrar_actor($actores, $adm){
        require './templates/show/lista.actor.phtml';
    }

    public function mostrar_peliculas_actor_por_id($actor){
        require './templates/show/lista.actor_por_id.phtml';
    }
    
    public function mostrar_formulario_actor_modificacion($actor, $peliculas){
        require './templates/forms/modificar.actor.phtml';
    }
    
    public function mostrar_formulario_actor($peliculas){
        require './templates/forms/nuevo.actor.phtml';
    }
}

 


    